<?php
        class Damage_Report_Model extends CI_Model
        {
            public function getVehicleID()
            {
                $this->db->select('*');
                $this->db->where('is_deleted=',0);
                $this->db->where('is_service_out=',0);
                $this->db->from('vehicle');
                $query = $this->db->get();
                return $query->result();
  
                        
            }

            public function getDamageDetails()
            {
                $this->db->select('*');
                $this->db->where('is_deleted=',0);
                $this->db->from('damage');
                $query = $this->db->get();
                return $query->result();
            }

            public function getCustomerID()
            {
                $this->db->select('*');
                $this->db->where('is_deleted=',0);
                $this->db->from('customer');
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

            // public function getDamages()
            // {
            //     $start_date="";
            //     $end_date="";
            //     $vehicle_id =$this->input->post('vehicle_id',TRUE);
            //     $get_time = $this->input->post('get_time',TRUE);
            //     $damage_pic =$this->input->post('is_include_damage_picture',TRUE);
            //     $solved_type =$this->input->post('is_solved_type',TRUE);

            //     //conditions
            //     if($get_time == "all")
            //     {
            //             if($damage_pic == "No")
            //             {
            //                     if($solved_type == "all")
            //                     {
            //                         echo "time-all pic-no is_solved-all";
            //                     }
            //                     if($solved_type == "solved")
            //                     {
            //                         echo "time-all pic-no is_solved-yes";
            //                     }
            //                     if($solved_type == "not_solved")
            //                     {
            //                         echo "time-all pic-no is_solved-no";
            //                     }
            //             }
            //             else
            //             {
            //                     if($solved_type == "all")
            //                     {
            //                         //echo "time-all pic-yes is_solved-all";
            //                         $this->db->where('vehicle_id',$vehicle_id);
            //                         $query = $this->db->get('damage');
            //                         return $query->result();
                                    
            //                     }
            //                     if($solved_type == "solved")
            //                     {
            //                         echo "time-all pic-yes is_solved-yes";
            //                     }
            //                     if($solved_type == "not_solved")
            //                     {
            //                         echo "time-all pic-yes is_solved-no";
            //                     }
            //             }
            //     }
            //     else
            //     {
            //             if($damage_pic == "No")
            //             {
            //                     if($solved_type == "all")
            //                     {
            //                         echo "time-custom pic-no is_solved-all";
            //                     }
            //                     if($solved_type == "solved")
            //                     {
            //                         echo "time-custom pic-no is_solved-yes";
            //                     }
            //                     if($solved_type == "not_solved")
            //                     {
            //                         echo "time-custom pic-no is_solved-no";
            //                     }
            //             }
            //             else
            //             {
            //                     if($solved_type == "all")
            //                     {
            //                         echo "time-custom pic-yes is_solved-all";
            //                     }
            //                     if($solved_type == "solved")
            //                     {
            //                         echo "time-custom pic-yes is_solved-yes";
            //                     }
            //                     if($solved_type == "not_solved")
            //                     {
            //                         echo "time-custom pic-yes is_solved-no";
            //                     }
            //             }
            //     }
            // }

            public function getDateSpecificDamages()
            {
                $start_date=$this->input->post('start_date',TRUE);
                $end_date=$this->input->post('end_date',TRUE);

                $this->db->select('*');
                $this->db->where('d_date >= ',$start_date);
                $this->db->where('d_date <= ',$end_date);
                $this->db->from('damage');
                $query = $this->db->get();
                return $query->result();
                
                               
            }
        }
 ?>