<?php


class Expense_Model extends CI_Model
{
    public function insertVehicleExpense(){
        $vehicle_expense = array(
            'vehicle_id' => $this->input->post('expenseVehicleID', TRUE),
            'type' => "E",
            'date' => $this->input->post('expensedVehicleDate', TRUE),
            'amount' => $this->input->post('expenseAmount', TRUE)
        );

        return $this->db->insert('transaction',$vehicle_expense);
    }

    public function removeExpenseData($expense_id) {
        $this->db->where('id', $expense_id);
        return $this->db->delete('transaction');;
    }

    public function getVehicleData() {
        $vehicle_data_view_query = $this->db->query('SELECT * FROM `vehicle` WHERE `is_service_out` = 0 AND `is_deleted` = 0');
        return $vehicle_data_view_query;
    }

    public function getVehicleExpenseData() {
        $vehicle_expense_data_view_query = $this->db->query("SELECT t.*, v.`registered_number` FROM `transaction` t, `vehicle` v WHERE t.`vehicle_id` = v.`id` AND t.`type` = 'E' ORDER BY t.`date` DESC");
        return $vehicle_expense_data_view_query;
    }

}