<?php
        class StaffModel extends CI_Model
        {
            public function getStaffDetails()
            {
                $this->db->where('is_deleted', 0);
                $this->db->order_by('id', 'ASC');

                $query = $this->db->get('user');
                return $query->result();
            }

            public function insertStaff($image_path)
            {
                $random_password = rand(10000000,99999999);

                $usr_type = $this->input->post('role_staff',TRUE);
                $id = "";
                $name = ucwords($this->input->post('full_name',TRUE));
                $nic = strtoupper($this->input->post('nic',TRUE));
                $email = $this->input->post('email',TRUE);
                $phone_no = $this->input->post('phone_no',TRUE);
                $address = ucwords($this->input->post('address',TRUE));
                $pwd = sha1($random_password);

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

                $response = $this->db->insert('user', $values);

                if($response){
                    if($usr_type == "admin"){$usr_type = "Administrator";}else{$usr_type = "Cashier";}
                    $heading = "Account created successfully";
                    $message = "You have successfully created the Abhaya account as an <b>".$usr_type."</b>.<br><br><b>".$random_password."</b> is your new Abhaya account auto generated password. Please sign in and change your password.";

                    $this->load->model("Email_Model");
                    $this->Email_Model->trigger_mail($email, $heading, $message);
                }

                return $response;
            }

            public function deleteUser(){

                $values = array( 'is_deleted' => '1');

                $this->db->where('id', $this->input->post('deluserid'));
                return $this->db->update('user',$values);
            }
        }
 ?>