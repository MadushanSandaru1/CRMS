<?php


class Returned extends CI_Controller
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

//    public function delete_reserved($reserved_id){
//        $this->load->model('Reserved_Model');
//        $response = $this->Reserved_Model->removeReservedData($reserved_id);
//
//        if($response) {
//            $this->session->set_flashdata('reserved_status', 'Reserved details were successfully removed');
//            redirect('Home/crms_reserved');
//        }
//    }

    public function returnVehicle(){
        $id = $this->input->post('re_id');
        $this->load->model('VehicleReturnModel');
        $response = $this->VehicleReturnModel->returnVehicle();
        $data['vehicle_data'] = $this->VehicleReturnModel->getVehicleData();
        $data['customer_data'] = $this->VehicleReturnModel->getCustomerData();
        $data['reserved_details'] = $this->VehicleReturnModel->getVehicleReserved($id);


        if($response) {

            $this->session->set_flashdata('returned_status', 'successfully returned Vehicle time');

            redirect('Home/crms_returned');
//            $this->load->view("crms_return_report",$data);
//            $html = $this->output->get_output();
//            $this->pdf->loadHtml($html);
//            $this->pdf->setPaper('A5', 'portrait');
//            $this->pdf->render();
//            $this->pdf->stream(""."Vehicle Return.pdf",array("Attachment" => 0));

        }
    }
    public function extendVehicle(){
        $this->load->model('VehicleReturnModel');
        $response = $this->VehicleReturnModel->extendVehicle();

        if($response) {
            $this->session->set_flashdata('extend_status', 'successfully extended Vehicle time');
            redirect('Home/crms_returned');
        }
    }
    public function report_returned($re_id){
        //Call to model function to generate report
        $this->load->model('VehicleReturnModel');
        $data['reserved_details'] = $this->VehicleReturnModel->reportReturned($re_id);
        $data['vehicle_data'] = $this->VehicleReturnModel->getVehicleData();
        $data['customer_data'] = $this->VehicleReturnModel->getCustomerData();

        //view report design
        $this->load->view("crms_return_report.php", $data);
        $html = $this->output->get_output();
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A5', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("vehicle_return_report".date("Ymd_his").".pdf",array("Attachment" => 0));

        //insert vehicle return income
        $amount=$this->session->tempdata('vehicle_return_income');
        $vehicle_id = $this->session->tempdata('vehicle_return_v_id');
        $this->load->model('VehicleReturnModel');
        $this->VehicleReturnModel->insertVehicleIncome($vehicle_id,$amount);
    }

    public function vehicleReturnIncome($amount)
    {

    }

}