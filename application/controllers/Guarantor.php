<?php


class Guarantor extends CI_Controller
{
    public function add_guarantor(){
        $this->form_validation->set_rules('reservedID', 'Reserved ID', 'required');
        $this->form_validation->set_rules('guarantorName', 'Guarantor Name', 'required');
        $this->form_validation->set_rules('guarantorNIC', 'Guarantor NIC number', 'required|is_unique[guarantor.nic]');
        $this->form_validation->set_rules('guarantorPhone', 'Guarantor Phone number', 'required');
        $this->form_validation->set_rules('guarantorAddress', 'Guarantor Address', 'required');
        $this->form_validation->set_rules('licenseImage', 'Guarantor License Image', 'required');

        if($this->form_validation->run() == FALSE){
            $this->load->view('crms_guarantor');
        }
        else{
            $this->load->model('Guarantor_Model');
            $response = $this->Guarantor_Model->insertGuarantorData();

            if($response) {
                $this->session->set_flashdata('guarantor_status', 'Guarantor registration successful');
                redirect('Home/crms_guarantor');
            } else{
                $this->session->set_flashdata('guarantor_status', 'Guarantor registration not successful');
                redirect('Home/crms_guarantor');
            }
        }
    }
}