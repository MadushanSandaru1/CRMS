<?php
class  OutSourceSupplier extends CI_Controller
{
    public function getSuppliers()
    {
        $this->load->model('OutSourceSuplierModel');
        $supplierDetails = $this->OutSourceSuplierModel->getSupplierDetails();
        $this->load->view('crms_outsourcing_supplier',['supplier_details'=>$supplierDetails]);
    }

    public function outSourcingSupplier()
    {
        $this->form_validation->set_rules('name','Supplier Name','required');
        $this->form_validation->set_rules('nic','Supplier NIC','required');
        //$this->form_validation->set_rules('nic_copy','OutSource Supplier NIC Image File','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('phone','Phone Number','required');
        $this->form_validation->set_rules('address','Address','required');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->model("Customer_message");
            $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
            $this->load->model("notification");
            $data["insurence_date"]=$this->notification->insurence_date();
            $data["revenue_license_date"]=$this->notification->revenue_license_date();
            $data["car_booking_notification"]=$this->notification->car_booking_notification();
            $data["car_not_recive"]=$this->notification->car_not_recive();

            $this->load->model('OutSourceSuplierModel');
            $data["supplier_details"] = $this->OutSourceSuplierModel->getSupplierDetails();
            $this->session->set_tempdata('form','add_form',5);
            $this->load->view('crms_outsourcing_supplier', $data);
        }
        else
        {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['upload_path'] = './assets/images/outsourceSupplier/';
            $this->load->library('upload',$config);

            if($this->upload->do_upload('nic_copy'))
            {
                $data = $this->input->post();
                $info = $this->upload->data();
                $image_path= "assets/images/outsourceSupplier/".$info['raw_name'].$info['file_ext'];
                $this->load->model('OutSourceSuplierModel');
                $response = $this->OutSourceSuplierModel->insertOutSourceSupplier($image_path);

                if($response)
                {
                    $this->load->model("Customer_message");
                    $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                    $this->load->model("notification");
                    $data["insurence_date"]=$this->notification->insurence_date();
                    $data["revenue_license_date"]=$this->notification->revenue_license_date();
                    $data["car_booking_notification"]=$this->notification->car_booking_notification();
                    $data["car_not_recive"]=$this->notification->car_not_recive();

                    $this->load->model('OutSourceSuplierModel');
                    $data["supplier_details"] = $this->OutSourceSuplierModel->getSupplierDetails();
                    $this->session->set_tempdata('form','add_form',5);
                    $this->session->set_flashdata('outsource_supplier_status', 'Data Recorded Successfully!');
                    $this->load->view('crms_outsourcing_supplier', $data);

                }
            }
        }
    }

    public function prepareToDeleteOutsourceSupplier()
    {
        $this->load->model('OutSourceSuplierModel');
        $response = $this->OutSourceSuplierModel->deleteOutSourceSupplier();

        if ($response) {
            $this->session->set_flashdata('outsource_status', 'Data Deleted Successfully!');
            redirect('Home/crms_outsourcing_supplier');
        }

    }

    public function updateOutSourcingSupplier()
    {
        $this->form_validation->set_rules('sup_name','Supplier Name','required');
        $this->form_validation->set_rules('sup_nic','Supplier NIC','required');
        //$this->form_validation->set_rules('sup_nic_copy','OutSource Supplier NIC Image File','required');
        $this->form_validation->set_rules('sup_email','Email','required');
        $this->form_validation->set_rules('sup_phone','Phone Number','required');
        $this->form_validation->set_rules('sup_address','Address','required');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->model("Customer_message");
            $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
            $this->load->model("notification");
            $data["insurence_date"]=$this->notification->insurence_date();
            $data["revenue_license_date"]=$this->notification->revenue_license_date();
            $data["car_booking_notification"]=$this->notification->car_booking_notification();
            $data["car_not_recive"]=$this->notification->car_not_recive();

            $this->load->model('OutSourceSuplierModel');
            $data["supplier_details"] = $this->OutSourceSuplierModel->getSupplierDetails();
            $this->session->set_tempdata('form','update_form',5);
            $this->load->view('crms_outsourcing_supplier', $data);
        }
        else
        {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['upload_path'] = './assets/images/outsourceSupplier/';
            $this->load->library('upload',$config);

            if($this->upload->do_upload('nic_copy'))
            {
                $data = $this->input->post();
                $info = $this->upload->data();
                $image_path= "assets/images/outsourceSupplier/".$info['raw_name'].$info['file_ext'];
                $this->load->model('OutSourceSuplierModel');
                $response = $this->OutSourceSuplierModel->insertOutSourceSupplier($image_path);

                if($response)
                {
                    $this->load->model("Customer_message");
                    $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                    $this->load->model("notification");
                    $data["insurence_date"]=$this->notification->insurence_date();
                    $data["revenue_license_date"]=$this->notification->revenue_license_date();
                    $data["car_booking_notification"]=$this->notification->car_booking_notification();
                    $data["car_not_recive"]=$this->notification->car_not_recive();

                    $this->load->model('OutSourceSuplierModel');
                    $data["supplier_details"] = $this->OutSourceSuplierModel->getSupplierDetails();
                    $this->session->set_tempdata('form','add_form',5);
                    $this->session->set_flashdata('outsource_supplier_status', 'Data Updated Successfully!');
                    $this->load->view('crms_outsourcing_supplier', $data);

                }
            }
            else
            {
                $image_path= " ";
                $this->load->model('OutSourceSuplierModel');
                $response = $this->OutSourceSuplierModel->updateOutSourceSupplier($image_path);
                if($response)
                {
                    $this->load->model("Customer_message");
                    $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                    $this->load->model("notification");
                    $data["insurence_date"]=$this->notification->insurence_date();
                    $data["revenue_license_date"]=$this->notification->revenue_license_date();
                    $data["car_booking_notification"]=$this->notification->car_booking_notification();
                    $data["car_not_recive"]=$this->notification->car_not_recive();

                    $this->load->model('OutSourceSuplierModel');
                    $data["supplier_details"] = $this->OutSourceSuplierModel->getSupplierDetails();
                    $this->session->set_tempdata('form','add_form',5);
                    $this->session->set_flashdata('outsource_supplier_status', 'Data Updated Successfully!');
                    $this->load->view('crms_outsourcing_supplier', $data);

                }
            }
        }
    }
}
?>