<?php
        class Customer_Model extends CI_Model{

              
                public function insertCustomer($nic_copy_data,$license_copy_data,$light_bill_copy_data)
                {

                        //var_dump($this->input->post());
                        $image = $this->input->post("avatarReady");
                        
                        if ($image!="") {
                                $decodedimg = base64_decode(str_replace('[removed]', '', $image));
                                $image_name = md5(uniqid(rand(), true));// image name generating with random number with 32 characters
                                $filename = $image_name . '.' . 'png';
                                //save image
                                file_put_contents('assets/images/customers/' . $filename, $decodedimg);
                        }else{
                                $filename = 'user_prev.png';
                        }
                        

                   
                        $values = array(
                                'name' => $this->input->post('name', TRUE),
                                'nic' => $this->input->post('nic', TRUE),
                                'email' => $this->input->post('email', TRUE),
                                'phone'=> $this->input->post('phone', TRUE),
                                'address'=> $this->input->post('address', TRUE),
                                'image'=> $filename,
                                'nic_copy'=> $nic_copy_data['file_name'],
                                'license_copy'=> $license_copy_data['file_name'],
                                'light_bill_copy'=> $light_bill_copy_data['file_name'],
                                'is_deleted'=> 0,
                        );

                        var_dump($values);
                        return $this->db->insert('customer', $values);
                }



                public function getCustomers(){

                        $this->db->select('*');
                        $this->db->where('is_deleted', 0);
                        $this->db->order_by('id', 'ASC');
                        $query = $this->db->get('customer');
                        //$query=$this->db->query("SELECT * FROM customer WHERE is_deleted=0 ORDER BY id ASC ");
                        return $query;
                    
                }
                
                
        }

 ?>