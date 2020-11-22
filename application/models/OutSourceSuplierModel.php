<?php
        class OutSourceSuplierModel extends CI_Model
        {
            public function getSupplierDetails()
            {
                $query = $this->db->get('outsourcing_supplier');
                return $query->result();
            }
        }
 ?>