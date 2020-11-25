<?php


class Guarantor extends CI_Controller
{
    public function add_guarantor(){
        $this->form_validation->set_rules('reservedID', 'Reserved ID', 'required');
        $this->form_validation->set_rules('guarantorName', 'Guarantor Name', 'required|max_length[100]');
        $this->form_validation->set_rules('guarantorNIC', 'Guarantor NIC number', 'required|min_length[9]|max_length[12]');
        $this->form_validation->set_rules('guarantorPhone', 'Guarantor Phone number', 'required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('guarantorAddress', 'Guarantor Address', 'required|max_length[255]');
        //$this->form_validation->set_rules('nicImage', 'Guarantor NIC Image', 'required');

        if($this->form_validation->run() == FALSE){
            $this->session->set_tempdata('reservedID_fill', $this->input->post('reservedID', TRUE), 5);
            $this->session->set_tempdata('guarantorName_fill', $this->input->post('guarantorName', TRUE), 5);
            $this->session->set_tempdata('guarantorNIC_fill', $this->input->post('guarantorNIC', TRUE), 5);
            $this->session->set_tempdata('guarantorPhone_fill', $this->input->post('guarantorPhone', TRUE), 5);
            $this->session->set_tempdata('guarantorAddress_fill', $this->input->post('guarantorAddress', TRUE), 5);
            $this->session->set_tempdata('nicImage_fill', $this->input->post('nicImage', TRUE), 5);

            $this->load->model("Guarantor_Model");
            $data['guarantor_data'] = $this->Guarantor_Model->getGuarantorData();
            $data['reserved_data'] = $this->Guarantor_Model->getReservedData();
            $this->load->view('crms_guarantor', $data);
        }
        else{

            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['upload_path'] = './assets/images/guarantor/';
            $this->load->library('upload',$config);

            if($this->upload->do_upload('nicImage')) {
                $data = $this->input->post();
                $info = $this->upload->data();
                $image_path= $info['raw_name'].$info['file_ext'];

                $this->load->model('Guarantor_Model');
                $response = $this->Guarantor_Model->insertGuarantorData($image_path);

                if($response) {
                    $this->session->set_flashdata('guarantor_status', 'Guarantor registration successful');
                    redirect('Home/crms_guarantor');
                } else{
                    $this->session->set_flashdata('guarantor_status', 'Guarantor registration not successful');
                    redirect('Home/crms_guarantor');
                }
            } else{
                $this->session->set_flashdata('guarantor_status', 'NIC Copy cannot upload');
                redirect('Home/crms_guarantor');
            }
        }
    }

    public function delete_guarantor($guarantor_id){
        $this->load->model('Guarantor_Model');
        $response = $this->Guarantor_Model->removeGuarantorData($guarantor_id);

        if($response) {
            $this->session->set_flashdata('guarantor_status', 'Guarantor details were successfully removed');
            redirect('Home/crms_guarantor');
        }
    }

}