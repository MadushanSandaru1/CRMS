<?php

class Guarantor_Model extends CI_Model
{
    public function insertGuarantorData(){
        $guarantor_data = array(
            'reserved_id' => $this->input->post('reservedID', TRUE),
            'name' => $this->input->post('guarantorName', TRUE),
            'nic' => $this->input->post('guarantorNIC', TRUE),
            'phone' => $this->input->post('guarantorPhone', TRUE),
            'address' => $this->input->post('guarantorAddress', TRUE),
            'license_copy' => $this->input->post('licenseImage', TRUE)
        );

        return $this->db->insert('guarantor',$guarantor_data);
    }

    public function getGuarantorData() {
        //$userdata_view_query = $this->db->get('guarantor');
        $guarantordata_view_query = $this->db->query('SELECT * FROM `guarantor` WHERE `is_deleted` = 0');
        return $guarantordata_view_query;
    }

    public function getReservedData() {
        //$userdata_view_query = $this->db->get('guarantor');
        $reserveddata_view_query = $this->db->query('SELECT r.id, v.`registered_number` FROM `reserved` r, `vehicle` v WHERE v.`id` = r.id AND r.`is_returned` = 0 AND r.`is_deleted` = 0');
        return $reserveddata_view_query;
    }
}