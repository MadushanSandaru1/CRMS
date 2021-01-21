<?php


class Vehicle extends CI_Controller
{
    public function add_vehicle(){
        $this->form_validation->set_rules('vehicleType', 'Vehicle Type', 'required|max_length[255]');
        $this->form_validation->set_rules('vehicleRegisteredNumber', 'Vehicle Registered Number', 'required|is_unique[vehicle.registered_number]|max_length[15]');
        $this->form_validation->set_rules('vehicleSeat', 'Vehicle Seat', 'required');
        $this->form_validation->set_rules('vehicleFuelType', 'Vehicle Fuel Type', 'required');
        $this->form_validation->set_rules('vehiclePrice', 'Vehicle Price', 'required');
        $this->form_validation->set_rules('vehicleAddKM', 'Additional price per KM', 'required');
        $this->form_validation->set_rules('vehicleAddHour', 'Additional price per Hour', 'required');
        $this->form_validation->set_rules('vehicleInsurance', 'Vehicle Insurance Date', 'required');
        $this->form_validation->set_rules('vehicleLicense', 'Vehicle License Date', 'required');
        if (empty($_FILES['vehicleImage']['name']))
        {
            $this->form_validation->set_rules('vehicleImage', 'Vehicle Image', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_tempdata('vehicleType_fill', $this->input->post('vehicleType', TRUE), 5);
            $this->session->set_tempdata('vehicleRegisteredNumber_fill', $this->input->post('vehicleRegisteredNumber', TRUE), 5);
            $this->session->set_tempdata('vehicleSeat_fill', $this->input->post('vehicleSeat', TRUE), 5);
            $this->session->set_tempdata('vehicleFuelType_fill', $this->input->post('vehicleFuelType', TRUE), 5);
            $this->session->set_tempdata('radioAC_fill', $this->input->post('radioAC', TRUE), 5);
            $this->session->set_tempdata('radioTransmission_fill', $this->input->post('radioTransmission', TRUE), 5);
            $this->session->set_tempdata('vehicleImage_fill', $this->input->post('vehicleImage', TRUE), 5);
            $this->session->set_tempdata('vehiclePrice_fill', $this->input->post('vehiclePrice', TRUE), 5);
            $this->session->set_tempdata('vehicleAddKM_fill', $this->input->post('vehicleAddKM', TRUE), 5);
            $this->session->set_tempdata('vehicleAddHour_fill', $this->input->post('vehicleAddHour', TRUE), 5);
            $this->session->set_tempdata('vehicleInsurance_fill', $this->input->post('vehicleInsurance', TRUE), 5);
            $this->session->set_tempdata('vehicleLicense_fill', $this->input->post('vehicleLicense', TRUE), 5);

            $this->load->model("Vehicle_Model");
            $data['vehicle_data'] = $this->Vehicle_Model->getVehicleData();

            $this->load->model("Customer_message");
            $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
            $this->load->model("notification");
            $data["insurence_date"]=$this->notification->insurence_date();
            $data["revenue_license_date"]=$this->notification->revenue_license_date();
            $data["car_booking_notification"]=$this->notification->car_booking_notification();
            $data["car_not_recive"]=$this->notification->car_not_recive();

            $this->load->view('crms_car', $data);
        }
        else {

            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['upload_path'] = './assets/images/vehicles/';
            $this->load->library('upload',$config);

            if($this->upload->do_upload('vehicleImage')) {
                $data = $this->input->post();
                $info = $this->upload->data();
                $image_path = $info['raw_name'] . $info['file_ext'];

                $this->load->model('Vehicle_Model');
                $response = $this->Vehicle_Model->insertVehicleData($image_path);

                if($response) {
                    $this->session->set_flashdata('vehicle_status', 'Vehicle registration successful');
                    redirect('Home/crms_car');
                } else {
                    $this->session->set_flashdata('vehicle_status', 'Vehicle registration not successful');
                    redirect('Home/crms_car');
                }

            } else {
                $this->session->set_flashdata('vehicle_status', 'Vehicle image cannot upload');
                redirect('Home/crms_car');
            }
        }
    }

    //record delete function
    public function delete_vehicle(){
        //Call to model function to delete data
        $this->load->model('Vehicle_Model');
        $response = $this->Vehicle_Model->removeVehicleData();

        if($response) {
            $this->session->set_flashdata('vehicle_status', 'Vehicle details were successfully removed');
            redirect('Home/crms_car');
        }
    }
    //** record delete function **

    public function update_vehicle()
    {

        $this->form_validation->set_rules('u_vehicleType', 'Vehicle Type', 'required|max_length[255]');
        $this->form_validation->set_rules('u_vehicleRegisteredNumber', 'Vehicle Registered Number', 'required|max_length[15]');
        $this->form_validation->set_rules('u_vehicleSeat', 'Vehicle Seat', 'required');
        $this->form_validation->set_rules('u_vehicleFuelType', 'Vehicle Fuel Type', 'required');
        $this->form_validation->set_rules('u_vehiclePrice', 'Vehicle Price', 'required');
        $this->form_validation->set_rules('u_vehicleAddKM', 'Additional price per KM', 'required');
        $this->form_validation->set_rules('u_vehicleAddHour', 'Additional price per Hour', 'required');
        $this->form_validation->set_rules('u_vehicleInsurance', 'Vehicle Insurance Date', 'required');
        $this->form_validation->set_rules('u_vehicleLicense', 'Vehicle License Date', 'required');

        if(!empty($this->input->post('vehicle_proofment'))){

            if (empty($_FILES['update_vehicle_copy']['name']))
            {
                $this->form_validation->set_rules('update_vehicle_copy', 'Vehicle Image', 'required');
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_tempdata('u_vehicleType_fill', $this->input->post('u_vehicleType', TRUE), 5);
            $this->session->set_tempdata('u_vehicleRegisteredNumber_fill', $this->input->post('u_vehicleRegisteredNumber', TRUE), 5);
            $this->session->set_tempdata('u_vehicleSeat_fill', $this->input->post('u_vehicleSeat', TRUE), 5);
            $this->session->set_tempdata('u_vehicleFuelType_fill', $this->input->post('u_vehicleFuelType', TRUE), 5);
            $this->session->set_tempdata('u_radioAC_fill', $this->input->post('u_radioAC', TRUE), 5);
            $this->session->set_tempdata('u_radioTransmission_fill', $this->input->post('u_radioTransmission', TRUE), 5);
            //$this->session->set_tempdata('u_vehicleImage_fill', $this->input->post('update_vehicle_copy', TRUE), 5);
            $this->session->set_tempdata('u_vehiclePrice_fill', $this->input->post('u_vehiclePrice', TRUE), 5);
            $this->session->set_tempdata('u_vehicleAddKM_fill', $this->input->post('u_vehicleAddKM', TRUE), 5);
            $this->session->set_tempdata('u_vehicleAddHour_fill', $this->input->post('u_vehicleAddHour', TRUE), 5);
            $this->session->set_tempdata('u_vehicleInsurance_fill', $this->input->post('u_vehicleInsurance', TRUE), 5);
            $this->session->set_tempdata('u_vehicleLicense_fill', $this->input->post('u_vehicleLicense', TRUE), 5);

            if(!empty($this->input->post())){
                $this->session->set_tempdata('vehicleImage_fill', $this->input->post('vehicle_proofment', TRUE), 5);
            }

            $this->load->model("Vehicle_Model");
            $data['vehicle_data'] = $this->Vehicle_Model->getVehicleData();

            $this->load->model("Customer_message");
            $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
            $this->load->model("notification");
            $data["insurence_date"]=$this->notification->insurence_date();
            $data["revenue_license_date"]=$this->notification->revenue_license_date();
            $data["car_booking_notification"]=$this->notification->car_booking_notification();
            $data["car_not_recive"]=$this->notification->car_not_recive();

            $this->session->set_flashdata('vehicle_status', 'Unable Vehicle Update');
            $this->session->set_tempdata('form','update_form',5);
            $this->load->view('crms_car', $data);
        }
        else {

            $vehicle_copy_data = null;

            if (!empty($_FILES['update_vehicle_copy']['name'])){
                $vehicle_copy_data = $this->uploadFiles('update_vehicle_copy');
            }


            $this->load->model('Vehicle_Model');
            $response = $this->Vehicle_Model->updateVehicleData($vehicle_copy_data);

            if($response) {
                $this->session->set_tempdata('form','add_form',5);
                $this->session->set_flashdata('vehicle_status', 'Vehicle Updated successful');
                redirect('Home/crms_car');
            } else {
                $this->session->set_tempdata('form','update_form',5);
                $this->session->set_flashdata('vehicle_status', 'Vehicle update not successful');
                redirect('Home/crms_car');
            }



        }
    }

    public function setLocalDateTime($insuarance,$revenue_d)
    {
        $insurance_Time = new DateTime($insuarance);
        $insurance_Time_local_time = $insurance_Time->format("Y-m-d\TH:i:s");

        $revenueTime = new DateTime($revenue_d);
        $revenue_Time_local_time = $revenueTime->format("Y-m-d\TH:i:s");

        $this->session->set_tempdata('u_insurence_date_fill',$insurance_Time_local_time,10);
        $this->session->set_tempdata('u_revenue_date_fill',$revenue_Time_local_time,10);
    }

    public function uploadFiles($file){
        $image_data = null;

        $config['upload_path'] = './assets/images/vehicles/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        /*$config['max_size'] = '1000000';
        $config['max_width']  = '1024000';
        $config['max_height']  = '768000';*/
        $config['encrypt_name'] = TRUE;
        $config['overwrite'] = FALSE;
        $this->load->library('upload',$config);

        if ($this->upload->do_upload($file)){
            $image_data = $this->upload->data();

        }
        else{
            echo $this->upload->display_errors();
        }

        return $image_data;
    }
}