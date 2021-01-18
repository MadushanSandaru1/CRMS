<?php

class Guarantor_Model extends CI_Model
{
    //new record insert query
    public function insertGuarantorData($image_path){
        $guarantor_data = array(
            'reserved_id' => $this->input->post('reservedID', TRUE),
            'name' => $this->input->post('guarantorName', TRUE),
            'nic' => $this->input->post('guarantorNIC', TRUE),
            'phone' => $this->input->post('guarantorPhone', TRUE),
            'address' => $this->input->post('guarantorAddress', TRUE),
            'nic_copy' => $image_path
        );

        //insert record
        return $this->db->insert('guarantor',$guarantor_data);
    }
    //** new record insert query **

    //get guarantor data function
    public function getGuarantorData() {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'DESC');

        return $this->db->get('guarantor');
    }
    //** get guarantor data function **

    //delete guarantor data function
    public function removeGuarantorData() {
        $this->db->set('is_deleted', 1);
        $this->db->where('id', $this->input->post('delguarantorid'));
        $this->db->where('is_deleted', 0);

        return $this->db->update('guarantor');;
    }
    //** delete guarantor data function **

    //get reserved data function
    public function getReservedData() {
        $reserveddata_view_query = $this->db->query('SELECT r.`id`, v.`registered_number`, c.`nic` FROM `reserved` r, `vehicle` v, `customer` c WHERE v.`id` = r.`vehicle_id` AND r.`customer_id` = c.`id` AND r.`is_returned` = 0 AND r.`is_deleted` = 0 AND r.`id` NOT IN (SELECT `reserved_id` FROM `guarantor` WHERE `is_deleted` = 0) ORDER BY `from_date` DESC');
        return $reserveddata_view_query;
    }
    //** get reserved data function **

    //guarantor report generate function
    public function reportGuarantor($reserved_id) {
        $this->db->select('g.*, c.name AS customer_name, c.nic AS customer_nic, v.registered_number AS vehicle_no, r.from_date');
        $this->db->from('guarantor g, reserved r, customer c, vehicle v');
        $this->db->where('g.reserved_id', $reserved_id);
        $this->db->where('g.reserved_id = r.id');
        $this->db->where('r.customer_id = c.id');
        $this->db->where('r.vehicle_id = v.id');
        $this->db->where('g.is_deleted', 0);

        return $this->db->get();;
    }
    //** guarantor report generate function **
}