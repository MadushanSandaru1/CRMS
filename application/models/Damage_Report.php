<?php
        class Damage_Report extends CI_Model
        {
            public function getVehicleID()
            {
                $query = $this->db->get('vehicle');

                        if($query->num_rows() > 0)
                        {
                                return $query->result();
                        }
            }
        }
 ?>