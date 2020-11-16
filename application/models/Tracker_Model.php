<?php
        class Tracker_Model extends CI_Model{


                public function getVehicles(){

                        $this->db->select('id');
                        $this->db->select('title');
                        $this->db->select('registered_number');
                        $this->db->where('is_deleted', 0);
                        $this->db->order_by('id', 'ASC');
                        $query = $this->db->get('vehicle');
                        //$query=$this->db->query("SELECT * FROM customer WHERE is_deleted=0 ORDER BY id ASC ");
                        return $query;
                    
                }
                
                
        }

 ?>

