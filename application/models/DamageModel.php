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
                        $reserved_id=0;
                        $vehicleReserved_id =(int)$this->input->post('c_vehicle_id',TRUE);
                        $customerReserved_id =(int)$this->input->post('c_customer_id',TRUE);

                        if($vehicleReserved_id >0)
                                $reserved_id = $vehicleReserved_id;
                        if($customerReserved_id >0)
                                $reserved_id = $customerReserved_id;
                        if($vehicleReserved_id == $customerReserved_id)
                                $reserved_id = $vehicleReserved_id;

                        $is_solved =(int)$this->input->post('is_solved', TRUE);
                        $is_deleted =0;
                        $values = array(
                                'vehicle_id' => $this->input->post('vehicle_id', TRUE),
                                'description' => $this->input->post('description', TRUE),
                                'd_date' => $this->input->post('d_date', TRUE),
                                'image'=> $data,
                                'reserved_id'=> $reserved_id,
                                'fix_amount'=> $this->input->post('fix_amount', TRUE),
                                'is_solved'=> $is_solved,
                                'is_deleted'=> $is_deleted,
                        );

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
                echo "ok";
                $reserved_id=0;
                $vehicleReserved_id =(int)$this->input->post('c_vehicle_id',TRUE);
                $customerReserved_id =(int)$this->input->post('c',TRUE);
                $is_solved =(int)$this->input->post('is_solved', TRUE);
                $is_deleted =0;

                if($vehicleReserved_id == $customerReserved_id && $vehicleReserved_id >0 && $path!="") {
                    $reserved_id = $vehicleReserved_id;
                    $values = array(
                        'vehicle_id' => $this->input->post('u_vehicle_id', TRUE),
                        'description' => $this->input->post('u_description', TRUE),
                        'd_date' => $this->input->post('u_reported_date', TRUE),
                        'image'=> $path,
                        'reserved_id'=> $reserved_id,
                        'fix_amount'=> $this->input->post('u_fix_amount', TRUE),
                        'is_solved'=> $is_solved,
                        'is_deleted'=> $is_deleted,
                    );

                }
                else if($vehicleReserved_id >0 && $path!="") {
                    $reserved_id = $vehicleReserved_id;
                    $values = array(
                        'vehicle_id' => $this->input->post('u_vehicle_id', TRUE),
                        'description' => $this->input->post('u_description', TRUE),
                        'd_date' => $this->input->post('u_reported_date', TRUE),
                        'image'=> $path,
                        'reserved_id'=> $reserved_id,
                        'fix_amount'=> $this->input->post('u_fix_amount', TRUE),
                        'is_solved'=> $is_solved,
                        'is_deleted'=> $is_deleted,
                    );
                }
                else if($customerReserved_id >0 && $path!="") {
                    $reserved_id = $customerReserved_id;
                    $values = array(
                        'vehicle_id' => $this->input->post('u_vehicle_id', TRUE),
                        'description' => $this->input->post('u_description', TRUE),
                        'd_date' => $this->input->post('u_reported_date', TRUE),
                        'image'=> $path,
                        'reserved_id'=> $reserved_id,
                        'fix_amount'=> $this->input->post('u_fix_amount', TRUE),
                        'is_solved'=> $is_solved,
                        'is_deleted'=> $is_deleted,
                    );
                }
                else
                {
                    $values = array(
                        'vehicle_id' => $this->input->post('u_vehicle_id', TRUE),
                        'description' => $this->input->post('u_description', TRUE),
                        'd_date' => $this->input->post('u_reported_date', TRUE),
                        'fix_amount'=> $this->input->post('u_fix_amount', TRUE),
                        'is_solved'=> $is_solved,
                        'is_deleted'=> $is_deleted,
                    );
                }
                $this->db->where('id', $this->input->post('damage_id'));
                return $this->db->update('damage', $values);
            }
        }

 ?>