<?php
        class Customer_Model extends CI_Model{

              
                public function insertCustomer($nic_copy_data,$license_copy_data,$light_bill_copy_data)
                {
                   
                        $values = array(
                                'name' => $this->input->post('name', TRUE),
                                'nic' => $this->input->post('nic', TRUE),
                                'email' => $this->input->post('email', TRUE),
                                'phone'=> $this->input->post('phone', TRUE),
                                'address'=> $this->input->post('address', TRUE),
                                'nic_copy'=> $nic_copy_data['file_name'],
                                'license_copy'=> $license_copy_data['file_name'],
                                'light_bill_copy'=> $light_bill_copy_data['file_name'],
                                'is_deleted'=> 0,
                        );

                        var_dump($values);
                        return $this->db->insert('customer', $values);
                }
                
                
        }

 ?>