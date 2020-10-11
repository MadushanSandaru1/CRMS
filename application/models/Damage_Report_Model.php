<?php
        class Damage_Report_Model extends CI_Model
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