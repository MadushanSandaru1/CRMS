<?php


class Reserved extends CI_Controller
{
    public function add_reserved(){
        $this->form_validation->set_rules('reservedCustomerID', 'Customer ID', 'required');
        $this->form_validation->set_rules('reservedVehicleID', 'Vehicle ID', 'required');
        $this->form_validation->set_rules('reservedVehicleFromDate', 'Reserved Date', 'required');
        $this->form_validation->set_rules('reservedVehicleToDate', 'Return Date', 'required');
        $this->form_validation->set_rules('reservedVehicleStartValue', 'Start Meter Value', 'required');
        //$this->form_validation->set_rules('reservedVehicleAdvancedPayment', 'Advanced Payment', 'required');

        if($this->form_validation->run() == FALSE){
            $this->session->set_tempdata('reservedVehicleFromDate_fill', $this->input->post('reservedVehicleFromDate', TRUE), 5);
            $this->session->set_tempdata('reservedVehicleToDate_fill', $this->input->post('reservedVehicleToDate', TRUE), 5);
            $this->session->set_tempdata('reservedVehicleStartValue_fill', $this->input->post('reservedVehicleStartValue', TRUE), 5);
            $this->session->set_tempdata('reservedVehicleAdvancedPayment_fill', $this->input->post('reservedVehicleAdvancedPayment', TRUE), 5);

            $this->load->model("Reserved_Model");
            $data['vehicle_data'] = $this->Reserved_Model->getVehicleData();
            $data['customer_data'] = $this->Reserved_Model->getCustomerData();
            $data['reserved_data'] = $this->Reserved_Model->getVehicleReservedData();

            $this->load->model("Customer_message");
            $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
            $this->load->model("notification");
            $data["insurence_date"]=$this->notification->insurence_date();
            $data["revenue_license_date"]=$this->notification->revenue_license_date();
            $data["car_booking_notification"]=$this->notification->car_booking_notification();
            $data["car_not_recive"]=$this->notification->car_not_recive();

            $this->load->view('crms_reserved', $data);
        }
        else {
            $this->load->model('Reserved_Model');
            $response = $this->Reserved_Model->insertReservedData();

            if($response) {
                $advanced_payment = $this->input->post('reservedVehicleAdvancedPayment', TRUE);
                if($advanced_payment > 0) {
                    $vehicle_id = $this->input->post('reservedVehicleID', TRUE);
                    $this->load->model('Expense_Model');
                    $this->Expense_Model->insertVehicleIncome($vehicle_id, $advanced_payment);
                }

                $this->session->set_flashdata('reserved_status', 'Vehicle reserved details added successfully');
                redirect('Home/crms_reserved');
            } else {
                $this->session->set_flashdata('reserved_status', 'Failed to add vehicle reserved details');
                redirect('Home/crms_reserved');
            }
        }
    }

    public function delete_reserved($reserved_id){
        $this->load->model('Reserved_Model');
        $response = $this->Reserved_Model->removeReservedData($reserved_id);

        if($response) {
            $this->session->set_flashdata('reserved_status', 'Reserved details were successfully removed');
            redirect('Home/crms_reserved');
        }
    }

}