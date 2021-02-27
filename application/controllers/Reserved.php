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
            $this->session->set_tempdata('reservedCustomerID_fill' , $this->input->post('reservedCustomerID',TRUE), 5); 
            $this->session->set_tempdata('reservedVehicleID_fill' , $this->input->post('reservedVehicleID',TRUE), 5);
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
            $this->session->set_tempdata('form','add_form',5);
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

                //Store recerved id in tempary data to generate report
                $this->session->set_tempdata('report_details', $this->input->post('reservedVehicleID', TRUE), 5);

                $this->session->set_flashdata('reserved_status', 'Vehicle reserved details added successfully');
                $this->session->set_tempdata('form','add_form',5);
                redirect('Home/crms_reserved');
            } else {
                $this->session->set_flashdata('reserved_status', 'Failed to add vehicle reserved details');
                $this->session->set_tempdata('form','add_form',5);
                redirect('Home/crms_reserved');
            }
        }
    }

    //record delete function
    public function delete_reserved(){
        //Call to model function to delete data
        $this->load->model('Reserved_Model');
        $response = $this->Reserved_Model->removeReservedData();

        if($response) {
            $this->session->set_flashdata('reserved_status', 'Reserved details were successfully removed');
            $this->session->set_tempdata('form','add_form',5);
            redirect('Home/crms_reserved');
        }
    }
    //** record delete function **

    //report generator function
    public function report_reserved($vehicle_id){
        //Call to model function to generate report
        $this->load->model('Reserved_Model');
        $data['report_details'] = $this->Reserved_Model->reportReserved($vehicle_id);

        //view report design
        $this->load->view("reserved_bill_report.php", $data);
        $html = $this->output->get_output();
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A5', 'portrait');
        $this->pdf->render();

        $this->pdf->stream("reserved_bill_report".date("Ymd_his").".pdf",array("Attachment" => 0));
    }
    //** report generator function **

}