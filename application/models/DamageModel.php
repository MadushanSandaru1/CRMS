<?php
        class DamageModel extends CI_Model{

                public function getVehicleID()
                {
                        $query = $this->db->get('vehicle');
                        return $query->result();
                        
                }

                public function getReservedID()
                {
                        $query =$this->db->get('reserved');
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
                                'date' => $this->input->post('d_date', TRUE),
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
                        $query =$this->db->get('damage');
                        return $query->result();
                        
                }

                public function getCustomerDetails()
                {
                        $query =$this->db->get('customer');
                        return $query->result();
                        
                }
                
        }

 ?>