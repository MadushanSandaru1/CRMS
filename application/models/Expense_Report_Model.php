<?php

class Expense_Report_Model extends CI_Model
{
    //guarantor report generate function
    public function getReport() {
        $vehicle_id = $this->input->post('expenseVehicleID', TRUE);
        $time = $this->input->post('get_time', TRUE);
        $type = $this->input->post('type', TRUE);

        $query = "SELECT * FROM `transaction` WHERE `vehicle_id` = '".$vehicle_id."'";

        if($type == "expense") {
            $query.=" AND `type` = 'E'";
        } elseif($type == "all") {

        } else {
            $query.=" AND `type` = 'I'";
        }

        if($time == "customize") {
            $start = $this->input->post('start_date', TRUE);
            $end = $this->input->post('end_date', TRUE);

            $query.=" AND `date` BETWEEN '".$start."' AND DATE_ADD('".$end."', INTERVAL 1 DAY)";
        }

        $query.=" ORDER BY `date` DESC";

        $query = $this->db->query($query);
        return $query;
    }
    //** guarantor report generate function **

    public function getVehicleData() {
        $vehicledata_view_query = $this->db->query("SELECT * FROM `vehicle` WHERE `is_service_out` = 0 AND `is_deleted` = 0 AND `id` = '".$this->session->tempdata('expense_report_vehicleId')."'");
        return $vehicledata_view_query;
    }
}