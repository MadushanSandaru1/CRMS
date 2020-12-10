<?php


class Guarantor extends CI_Controller
{
    //new record insert query
    public function add_guarantor(){
        //form validations
        $this->form_validation->set_rules('reservedID', 'Reserved ID', 'required');
        $this->form_validation->set_rules('guarantorName', 'Guarantor Name', 'required|max_length[100]');
        $this->form_validation->set_rules('guarantorNIC', 'Guarantor NIC number', 'required|min_length[9]|max_length[12]');
        $this->form_validation->set_rules('guarantorPhone', 'Guarantor Phone number', 'required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('guarantorAddress', 'Guarantor Address', 'required|max_length[255]');
        if (empty($_FILES['nicImage']['name']))
        {
            $this->form_validation->set_rules('nicImage', 'Guarantor NIC Image', 'required');
        }

        //When there are validation errors
        if($this->form_validation->run() == FALSE){
            //store value to the temporary session already filled
            $this->session->set_tempdata('reservedID_fill', $this->input->post('reservedID', TRUE), 5);
            $this->session->set_tempdata('guarantorName_fill', $this->input->post('guarantorName', TRUE), 5);
            $this->session->set_tempdata('guarantorNIC_fill', $this->input->post('guarantorNIC', TRUE), 5);
            $this->session->set_tempdata('guarantorPhone_fill', $this->input->post('guarantorPhone', TRUE), 5);
            $this->session->set_tempdata('guarantorAddress_fill', $this->input->post('guarantorAddress', TRUE), 5);
            $this->session->set_tempdata('nicImage_fill', $this->input->post('nicImage', TRUE), 5);

            //Required data retrieval module
            $this->load->model("Customer_message");
            $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();

            $this->load->model("notification");
            $data["insurence_date"]=$this->notification->insurence_date();
            $data["revenue_license_date"]=$this->notification->revenue_license_date();
            $data["car_booking_notification"]=$this->notification->car_booking_notification();
            $data["car_not_recive"]=$this->notification->car_not_recive();

            $this->load->model("Guarantor_Model");
            $data['guarantor_data'] = $this->Guarantor_Model->getGuarantorData();
            $data['reserved_data'] = $this->Guarantor_Model->getReservedData();
            $this->load->view('crms_guarantor', $data);
        }
        //When there are no validation errors
        else{

           //document upload
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['upload_path'] = './assets/images/guarantor/';
            $this->load->library('upload',$config);

            //When the files are uploaded correctly
            if($this->upload->do_upload('nicImage')) {

                $data = $this->input->post();
                $info = $this->upload->data();
                $image_path= $info['raw_name'].$info['file_ext'];

                //Call to model function to insert data
                $this->load->model('Guarantor_Model');
                $response = $this->Guarantor_Model->insertGuarantorData($image_path);

                if($response) {
                    //Store recerved id in tempary data to generate report
                    $this->session->set_tempdata('report_details', $this->input->post('reservedID', TRUE), 5);

                    //Message that data has been entered
                    $this->session->set_flashdata('guarantor_status', 'Guarantor registration successful');
                    redirect('Home/crms_guarantor');
                } else{
                    //Message that data has not been entered
                    $this->session->set_flashdata('guarantor_status', 'Guarantor registration not successful');
                    redirect('Home/crms_guarantor');
                }
            } else{
                //When the files are not uploaded correctly
                $this->session->set_flashdata('guarantor_status', 'NIC Copy cannot upload');
                redirect('Home/crms_guarantor');
            }
        }
    }
    //** new record insert query **

    //record delete function
    public function delete_guarantor(){
        //Call to model function to delete data
        $this->load->model('Guarantor_Model');
        $response = $this->Guarantor_Model->removeGuarantorData();

        if($response) {
            $this->session->set_flashdata('guarantor_status', 'Guarantor details were successfully removed');
            redirect('Home/crms_guarantor');
        }
    }
    //** record delete function **

    //report generator function
    public function report_guarantor($reserved_id){
        //Call to model function to generate report
        $this->load->model('Guarantor_Model');
        $data['report_details'] = $this->Guarantor_Model->reportGuarantor($reserved_id);

        //view report design
        $this->load->view("guarantor_report.php", $data);
        $html = $this->output->get_output();
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        //$output = $this->pdf->output();
        //file_put_contents("guarantor_report".date("Ymd_his").".pdf", $output);
        $this->pdf->stream("guarantor_report".date("Ymd_his").".pdf",array("Attachment" => 0));
    }
    //** report generator function **

}