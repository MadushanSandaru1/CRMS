<?php

class Returned_Model extends CI_Model
{
    public function insertReturnedData(){
//        $reserved_data = array(
//            'customer_id' => $this->input->post('reservedCustomerID', TRUE),
//            'vehicle_id' => $this->input->post('reservedVehicleID', TRUE),
//            'from_date' => $this->input->post('reservedVehicleFromDate', TRUE),
//            'to_date' => $this->input->post('reservedVehicleToDate', TRUE),
//            'start_meter_value' => $this->input->post('reservedVehicleStartValue', TRUE),
//            'advance_payment' => $this->input->post('reservedVehicleAdvancedPayment', TRUE)
//        );
//
//        return $this->db->insert('reserved',$reserved_data);
    }

    public function removeReturnedData($reserved_id) {
        $this->db->set('is_deleted', 1);
        $this->db->where('id', $reserved_id);
        $this->db->where('is_returned', 1);
        $this->db->where('is_deleted', 0);

        return $this->db->update('reserved');;
    }

    public function getReservedData() {
        $reserveddata_view_query = $this->db->query("SELECT r.*, v.`registered_number`, c.`name` FROM `reserved` r, `vehicle` v, `customer` c WHERE r.`vehicle_id` = v.`id` AND r.`customer_id` = c.`id` AND r.`is_returned` = 0 AND r.`is_deleted` = 0 ORDER BY r.`is_returned` ASC, r.`to_date` ASC");
        return $reserveddata_view_query;
    }

    public function getVehicleReturnedData() {
//        $this->db->where('is_deleted', 0);
//        $this->db->order_by('is_returned', 'ASC');
//        $this->db->order_by('to_date', 'ASC');
//        $vehicle_reserved_data_view_query = $this->db->get('reserved');
        $vehicle_returned_data_view_query = $this->db->query("SELECT r.*, v.`registered_number`, c.`name` FROM `reserved` r, `vehicle` v, `customer` c WHERE r.`vehicle_id` = v.`id` AND r.`customer_id` = c.`id` AND r.`is_deleted` = 0 ORDER BY r.`is_returned` ASC, r.`to_date` ASC");
        return $vehicle_returned_data_view_query;
    }
}