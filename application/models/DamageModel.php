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
        }

 ?>