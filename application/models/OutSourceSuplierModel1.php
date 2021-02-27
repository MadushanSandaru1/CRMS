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

    public function deleteOutSourceSupplier()
    {
        $values = array( 'is_deleted' => '1');

        $this->db->where('id', $this->input->post('deloutsourcesid'));
        return $this->db->update('outsourcing_supplier',$values);
    }

    public function updateOutSourceSupplier($path)
    {
        if($path ==" ")
        {
            $values = array(
                'name' => $this->input->post('sup_name',TRUE),
                'nic' => $this->input->post('sup_nic',TRUE),
                'email'=> $this->input->post('sup_email',TRUE),
                'phone'=> $this->input->post('sup_phone',TRUE),
                'address'=> $this->input->post('sup_address',TRUE),

            );
        }

        if($path !=" ")
        {
<<<<<<< Updated upstream
            $values = array(
                'name' => $this->input->post('sup_name',TRUE),
                'nic' => $this->input->post('sup_nic',TRUE),
                'email'=> $this->input->post('sup_email',TRUE),
                'phone'=> $this->input->post('sup_phone',TRUE),
                'address'=> $this->input->post('sup_address',TRUE),
                'nic_copy'=>$this->input->post('sup_nic_copy',TRUE),
            );
=======
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

            public function deleteOutSourceSupplier()
            {
                $values = array( 'is_deleted' => '1');

                $this->db->where('id', $this->input->post('deloutsourcesid'));
                return $this->db->update('outsourcing_supplier',$values);
            }

            public function updateOutSourceSupplier($path)
            {
                if($path ==" ")
                {
                    $values = array(
                        'name' => $this->input->post('sup_name',TRUE),
                        'nic' => $this->input->post('sup_nic',TRUE),
                        'email'=> $this->input->post('sup_email',TRUE),
                        'phone'=> $this->input->post('sup_phone',TRUE),
                        'address'=> $this->input->post('sup_address',TRUE),

                    );
                }

                if($path !=" ")
                {
                    $values = array(
                        'name' => $this->input->post('sup_name',TRUE),
                        'nic' => $this->input->post('sup_nic',TRUE),
                        'email'=> $this->input->post('sup_email',TRUE),
                        'phone'=> $this->input->post('sup_phone',TRUE),
                        'address'=> $this->input->post('sup_address',TRUE),
                        'nic_copy'=>$this->input->post('sup_nic_copy',TRUE),
                    );
                }
                $this->db->where('id', $this->input->post('outsource_sup_id'));
                return $this->db->update('outsourcing_supplier', $values);
            }
>>>>>>> Stashed changes
        }
        $this->db->where('id', $this->input->post('outsource_sup_id'));
        return $this->db->update('outsourcing_supplier', $values);
    }
}
?>