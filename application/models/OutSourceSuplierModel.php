<?php
        class OutSourceSuplierModel extends CI_Model
        {
            public function getSupplierDetails()
            {
                $this->db->select('*');
                $this->db->where('is_deleted=',0);
                $this->db->from('outsourcing_supplier');
                $query = $this->db->get();
                return $query->result();

            }

            public function insertOutSourceSupplier($image_path)
            {
                $values = array(
                    'name' => $this->input->post('name',TRUE),
                    'nic' => $this->input->post('nic',TRUE),
                    'email'=> $this->input->post('email',TRUE),
                    'phone'=> $this->input->post('phone',TRUE),
                    'address'=> $this->input->post('address',TRUE),
                    'nic_copy'=> $image_path
                );

                return $this->db->insert('outsourcing_supplier', $values);
            }
        }
 ?>