<?php
        class DamageModel extends CI_Model{

                public function getVehicleID()
                {
                        $this->db->select('*');
                        $this->db->where('is_deleted=',0);
                        $this->db->where('is_service_out=',0);
                        $this->db->from('vehicle');
                        $query = $this->db->get();
                        return $query->result();
                        
                }

                public function getReservedID()
                {
                        $this->db->select('*');
                        $this->db->where('is_deleted=',0);
                        $this->db->from('reserved');
                        $query = $this->db->get();
                        return $query->result();
                        
                }

                public function insertDamage($data)
                {
                        //$date = now('Asia/Colombo');
                        $vehicleReserved_id =(int)$this->input->post('c_vehicle_id',TRUE);
                        $cus_pay =$this->input->post('fix_amount', TRUE);
                        $solved_pay = $this->input->post('solved_amount', TRUE);
                        $is_solved =(int)$this->input->post('is_solved', TRUE);
                        $is_deleted =0;
                        $values = array(
                                'vehicle_id' => $this->input->post('vehicle_id', TRUE),
                                'description' => $this->input->post('description', TRUE),
                                'd_date' => $this->input->post('d_date', TRUE),
                                'image'=> $data,
                                'reserved_id'=> $vehicleReserved_id,
                                'fix_amount'=> $cus_pay,
                                'is_solved'=> $is_solved,
                                'is_deleted'=> $is_deleted,
                        );

                        if($solved_pay > $cus_pay)
                        {
                            $total_ex = $solved_pay - $cus_pay;
                            $this->insertVehicleExpense($this->input->post('vehicle_id', TRUE),$total_ex);
                        }

                        if($solved_pay < $cus_pay)
                        {
                            $total_in = $cus_pay - $solved_pay;
                            $this->insertVehicleIncome($this->input->post('vehicle_id', TRUE),$total_in);
                        }
                        //print_r($values);
                        return $this->db->insert('damage', $values);
                }
                public function getDamageDetails()
                {
                        $this->db->select('*');
                        $this->db->where('is_deleted=',0);
                        $this->db->from('damage');
                        $query = $this->db->get();
                        return $query->result();
                        
                }

                public function getCustomerDetails()
                {
                        $this->db->select('*');
                        $this->db->where('is_deleted=',0);
                        $this->db->from('customer');
                        $query = $this->db->get();
                        return $query->result();
                        
                }
                
                public function filterDamagesDetails()
                {
                        $v_id = $this->input->post('vehicle_id',TRUE);
                        $this->db->select('*');
                        $this->db->where('id=',$v_id);
                        $this->db->from('damage');
                        $query = $this->db->get();
                        return $query->result();
                }

                public  function getDamageDetail($d_id)
                {
                    $this->db->select('*');
                    $this->db->where('id=',$d_id);
                    $this->db->from('damage');
                    $query = $this->db->get();
                    return $query->result();
                }

            public function deleteDamage(){

                $values = array( 'is_deleted' => '1');

                $this->db->where('id', $this->input->post('deldamageid'));
                return $this->db->update('damage',$values);
            }

            public function updateDamage($path)
            {
                $vehicleReserved_id =(int)$this->input->post('uc_vehicle_id',TRUE);
                $is_deleted =0;

                if($path!="") {
                    $reserved_id = $vehicleReserved_id;
                    $values = array(
                        'vehicle_id' => $this->input->post('u_vehicle_id', TRUE),
                        'description' => $this->input->post('u_description', TRUE),
                        'd_date' => $this->input->post('u_reported_date', TRUE),
                        'image'=> $path,
                        'reserved_id'=> $vehicleReserved_id,
                        'is_deleted'=> $is_deleted,
                    );

                }
                else
                {
                    $values = array(
                        'vehicle_id' => $this->input->post('u_vehicle_id', TRUE),
                        'description' => $this->input->post('u_description', TRUE),
                        'd_date' => $this->input->post('u_reported_date', TRUE),
                        'is_deleted'=> $is_deleted,
                    );
                }
                $this->db->where('id', $this->input->post('damage_id'));
                return $this->db->update('damage', $values);
            }

            public function insertVehicleExpense($vehicle_id,$payment){
                $vehicle_expense = array(
                    'vehicle_id' => $vehicle_id,
                    'type' => "E",
                    'date' => Date('Y-m-d\TH:i',time()),
                    'amount' => $payment
                );

                $this->db->insert('transaction',$vehicle_expense);
            }

            public function insertVehicleIncome($vehicle_id, $payment){
                $vehicle_expense = array(
                    'vehicle_id' => $vehicle_id,
                    'type' => "I",
                    'date' => Date('Y-m-d\TH:i',time()),
                    'amount' => $payment
                );

                $this->db->insert('transaction',$vehicle_expense);
            }

            public function damageSolved()
            {
                $result=false;
                $id=$this->input->post('soldamageid', TRUE);
                $cus_amount = $this->input->post('customer_paid', TRUE);
                $solved_amount = $this->input->post('solve_price', TRUE);

                if($cus_amount > $solved_amount)
                {
                    $total_in = $cus_amount - $solved_amount;
                    $values = array(
                        'is_solved' => 1,
                    );
                    $this->db->where('id', $this->input->post('soldid'));
                    $this->db->update('damage', $values);
                    $result =$this->insertVehicleIncome($id,$total_in);
                }

                if ($cus_amount < $solved_amount)
                {
                    $total_ex= $solved_amount - $cus_amount;
                    $values = array(
                        'is_solved' => 1,
                    );
                    $this->db->where('id', $this->input->post('soldid'));
                    $this->db->update('damage', $values);
                    $result =$this->insertVehicleExpense($id,$total_ex);
                }

                return $result;
            }
        }

 ?>