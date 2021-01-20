<?php
     defined('BASEPATH') OR exit('No direct script access allowed');
     class Expense_Report extends CI_Controller
     {
         public function generateExpenseReport() {
             $this->form_validation->set_rules('expenseVehicleID', 'Vehicle ID', 'required');
             if($this->input->post('get_time', TRUE) == "customize") {
                 $this->form_validation->set_rules('start_date', 'Start Date', 'required');
                 $this->form_validation->set_rules('end_date', 'End Date', 'required');
             }

             //When there are validation errors
             if($this->form_validation->run() == FALSE){
                 //store value to the temporary session already filled
                 $this->session->set_tempdata('expenseVehicleID_fill', $this->input->post('expenseVehicleID', TRUE), 5);
                 $this->session->set_tempdata('get_time_fill', $this->input->post('get_time', TRUE), 5);
                 if($this->input->post('get_time', TRUE) == "customize") {
                     $this->session->set_tempdata('start_date_fill', $this->input->post('start_date', TRUE), 5);
                     $this->session->set_tempdata('end_date_fill', $this->input->post('end_date', TRUE), 5);
                 }
                 $this->session->set_tempdata('type_fill', $this->input->post('type', TRUE), 5);


                 //Required data retrieval module
                 $this->load->model("Customer_message");
                 $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                 $this->load->model("notification");
                 $data["insurence_date"]=$this->notification->insurence_date();
                 $data["revenue_license_date"]=$this->notification->revenue_license_date();
                 $data["car_booking_notification"]=$this->notification->car_booking_notification();
                 $data["car_not_recive"]=$this->notification->car_not_recive();


                 $this->load->model("Expense_Model");
                 $data['vehicle_data'] = $this->Expense_Model->getVehicleData();

                 $this->load->view('crms_inc_exp_report', $data);
             } else {
                 $this->load->model('Expense_Report_Model');
                 $response = $this->Expense_Report_Model->getReport();

                 if($response) {
                     //unset before set
                     $this->session->unset_tempdata('expense_report_start_date');

                     //Store recerved id in tempary data to generate report
                     $this->session->set_tempdata('expense_report_details', $response->result(), 300);
                     $this->session->set_tempdata('expense_report_type', $this->input->post('type', TRUE), 300);
                     $this->session->set_tempdata('expense_report_vehicleId', $this->input->post('expenseVehicleID', TRUE), 300);
                     if($this->input->post('get_time', TRUE) == "customize") {
                         $this->session->set_tempdata('expense_report_start_date', $this->input->post('start_date', TRUE), 300);
                         $this->session->set_tempdata('expense_report_end_date', $this->input->post('end_date', TRUE), 300);
                     }

                     $this->session->set_flashdata('expenses_report_status', 'Generate expenses report successfully');
                     redirect('Home/crms_inc_exp_report');
                 } else {
                     $this->session->set_flashdata('expenses_report_status', 'Failed to generate expenses report');
                     redirect('Home/crms_inc_exp_report');
                 }
             }

         }

         //report generator function
         public function report_expense(){
             //Call to model function to generate report
             $this->load->model('Reserved_Model');

             //view report design
             $this->load->view("income_expense_report.php");
             $html = $this->output->get_output();
             $this->pdf->loadHtml($html);
             $this->pdf->setPaper('A4', 'portrait');
             $this->pdf->render();
             //$output = $this->pdf->output();
             //file_put_contents("guarantor_report".date("Ymd_his").".pdf", $output);
             $this->pdf->stream("income_expense_report".date("Ymd_his").".pdf",array("Attachment" => 0));
         }
         //** report generator function **
     }
?>