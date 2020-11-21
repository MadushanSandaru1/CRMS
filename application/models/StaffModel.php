<?php
        class StaffModel extends CI_Model
        {
            public function getStaffDetails()
            {
                $query = $this->db->get('user');
                return $query->result();
            }

            public function insertStaff($image_path)
            {
                $usr_type = $this->input->post('role_staff',TRUE);
                $id ="";
                $name=$this->input->post('full_name',TRUE);
                $nic=$this->input->post('nic',TRUE);
                $email=$this->input->post('email',TRUE);
                $phone_no=$this->input->post('phone_no',TRUE);
                $address=$this->input->post('address',TRUE);
                $pwd=sha1($this->input->post('password',TRUE));

                if($usr_type == "cashier")
                {
                    $id = $this->input->post('staff_cashier_id',TRUE);
                }

                if($usr_type == "admin")
                {
                    $id = $this->input->post('staff_admin_id',TRUE);
                }

                $values = array(
                    'id' => $id,
                    'name' => $name,
                    'nic' => $nic,
                    'email'=> $email,
                    'phone'=> $phone_no,
                    'address'=> $address,
                    'image'=> $image_path,
                    'role'=> $usr_type,
                    'password'=>$pwd
                );

                return $this->db->insert('user', $values);
            }
        }
 ?>