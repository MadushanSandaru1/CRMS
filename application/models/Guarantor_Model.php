<?php

class Guarantor_Model extends CI_Model
{
    public function insertGuarantorData($image_path){
        $guarantor_data = array(
            'reserved_id' => $this->input->post('reservedID', TRUE),
            'name' => $this->input->post('guarantorName', TRUE),
            'nic' => $this->input->post('guarantorNIC', TRUE),
            'phone' => $this->input->post('guarantorPhone', TRUE),
            'address' => $this->input->post('guarantorAddress', TRUE),
            'nic_copy' => $image_path
        );

        return $this->db->insert('guarantor',$guarantor_data);
    }

    public function getGuarantorData() {
        //$userdata_view_query = $this->db->get('guarantor');
        $guarantordata_view_query = $this->db->query('SELECT * FROM `guarantor` WHERE `is_deleted` = 0');
        return $guarantordata_view_query;
    }

    public function removeGuarantorData($guarantor_id) {
        $this->db->set('is_deleted', 1);
        $this->db->where('id', $guarantor_id);
        $this->db->where('is_deleted', 0);

        return $this->db->update('guarantor');;
    }

    public function reportGuarantor($reserved_id) {
        $reserveddata_view_query = $this->db->query("SELECT g.*, c.`name` AS 'customer_name', v.`registered_number` AS 'vehicle_no', r.`from_date` FROM `guarantor` g, `reserved` r, `customer` c, `vehicle` v WHERE g.`reserved_id` = ".$reserved_id." AND g.`reserved_id` = r.`id` AND r.`customer_id` = c.`id` AND r.`vehicle_id` = v.`id` AND g.`is_deleted` = 0");
        return $reserveddata_view_query;
    }

    public function getReservedData() {
        //$userdata_view_query = $this->db->get('guarantor');
        $reserveddata_view_query = $this->db->query('SELECT r.`id`, v.`registered_number` FROM `reserved` r, `vehicle` v WHERE v.`id` = r.`id` AND r.`is_returned` = 0 AND r.`is_deleted` = 0 AND r.`id` NOT IN (SELECT `reserved_id` FROM `guarantor`) ORDER BY `from_date` DESC');
        return $reserveddata_view_query;
    }
}