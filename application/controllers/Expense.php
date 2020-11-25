<?php


class Expense extends CI_Controller
{
    public function add_expense(){
        $this->form_validation->set_rules('expenseVehicleID', 'Vehicle ID', 'required');
        $this->form_validation->set_rules('expensedVehicleDate', 'Date', 'required');
        $this->form_validation->set_rules('expenseAmount', 'Expense Amount', 'required');

        $this->session->unset_tempdata('expenseVehicleID_fill');
        $this->session->unset_tempdata('expensedVehicleDate_fill');
        $this->session->unset_tempdata('expenseAmount_fill');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_tempdata('expenseVehicleID_fill', $this->input->post('expenseVehicleID', TRUE), 5);
            $this->session->set_tempdata('expensedVehicleDate_fill', $this->input->post('expensedVehicleDate', TRUE), 5);
            $this->session->set_tempdata('expenseAmount_fill', $this->input->post('expenseAmount', TRUE), 5);

            $this->load->model("Expense_Model");
            $data['vehicle_data'] = $this->Expense_Model->getVehicleData();
            $data['vehicle_expense_data'] = $this->Expense_Model->getVehicleExpenseData();
            $this->load->view('crms_expenses', $data);
        }
        else {
            $this->load->model('Expense_Model');
            $response = $this->Expense_Model->insertVehicleExpense();

            if($response) {
                $this->session->set_flashdata('expense_status', 'Vehicle expense details added successfully');
                redirect('Home/crms_expenses');
            } else {
                $this->session->set_flashdata('expense_status', 'Failed to add vehicle expense details');
                redirect('Home/crms_expenses');
            }
        }
    }

    public function delete_expense($expense_id){
        $this->load->model('Expense_Model');
        $response = $this->Expense_Model->removeExpenseData($expense_id);

        if($response) {
            $this->session->set_flashdata('expense_status', 'Expense details were successfully removed');
            redirect('Home/crms_expenses');
        }
    }

}