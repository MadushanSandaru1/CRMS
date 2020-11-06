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

            public function getDamageDetails()
            {
                        $query =$this->db->get('damage');

                        if($query->num_rows() > 0)
                        {
                                return $query->result();
                        }
            }

            public function getDamages()
            {
                $start_date="";
                $end_date="";
                $vehicle_id =$this->input->post('vehicle_id',TRUE);
                $get_time = $this->input->post('get_time',TRUE);
                $damage_pic =$this->input->post('is_include_damage_picture',TRUE);
                $solved_type =$this->input->post('is_solved_type',TRUE);

                //conditions
                if($get_time == "all")
                {
                        if($damage_pic == "No")
                        {
                                if($solved_type == "all")
                                {
                                    echo "time-all pic-no is_solved-all";
                                }
                                if($solved_type == "solved")
                                {
                                    echo "time-all pic-no is_solved-yes";
                                }
                                if($solved_type == "not_solved")
                                {
                                    echo "time-all pic-no is_solved-no";
                                }
                        }
                        else
                        {
                                if($solved_type == "all")
                                {
                                    //echo "time-all pic-yes is_solved-all";
                                    $query =$this->db->get('damage');

                                    if($query->num_rows() > 0)
                                    {
                                        return $query->result();
                                    }
                                }
                                if($solved_type == "solved")
                                {
                                    echo "time-all pic-yes is_solved-yes";
                                }
                                if($solved_type == "not_solved")
                                {
                                    echo "time-all pic-yes is_solved-no";
                                }
                        }
                }
                else
                {
                        if($damage_pic == "No")
                        {
                                if($solved_type == "all")
                                {
                                    echo "time-custom pic-no is_solved-all";
                                }
                                if($solved_type == "solved")
                                {
                                    echo "time-custom pic-no is_solved-yes";
                                }
                                if($solved_type == "not_solved")
                                {
                                    echo "time-custom pic-no is_solved-no";
                                }
                        }
                        else
                        {
                                if($solved_type == "all")
                                {
                                    echo "time-custom pic-yes is_solved-all";
                                }
                                if($solved_type == "solved")
                                {
                                    echo "time-custom pic-yes is_solved-yes";
                                }
                                if($solved_type == "not_solved")
                                {
                                    echo "time-custom pic-yes is_solved-no";
                                }
                        }
                }
            }
        }
 ?>