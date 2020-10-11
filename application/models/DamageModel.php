<?php
        class DamageModel extends CI_Model{

                public function getVehicleID()
                {
                        $query = $this->db->get('vehicle');

                        if($query->num_rows() > 0)
                        {
                                return $query->result();
                        }
                }

                public function getReservedID()
                {
                        $query =$this->db->get('reserved');

                        if($query->num_rows() > 0)
                        {
                                return $query->result();
                        }
                }

                public function insertDamage($data)
                {
                        //$date = now('Asia/Colombo');
                        $is_solved =(int)$this->input->post('is_solved', TRUE);
                        $is_deleted =0;
                        $values = array(
                                'vehicle_id' => $this->input->post('vehicle_id', TRUE),
                                'description' => $this->input->post('description', TRUE),
                                'date' => $this->input->post('d_date', TRUE),
                                'image'=> $data,
                                'reserved_id'=> $this->input->post('reserved_id', TRUE),
                                'fix_amount'=> $this->input->post('fix_amount', TRUE),
                                'is_solved'=> $is_solved,
                                'is_deleted'=> $is_deleted,
                        );

                        //print_r($values);
                        return $this->db->insert('damage', $values);
                }
        }

 ?>