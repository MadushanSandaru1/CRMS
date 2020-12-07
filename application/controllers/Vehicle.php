<?php


class Vehicle extends CI_Controller
{
    public function add_vehicle(){
        $this->form_validation->set_rules('vehicleType', 'Vehicle Type', 'required|max_length[255]');
        $this->form_validation->set_rules('vehicleRegisteredNumber', 'Vehicle Registered Number', 'required|is_unique[vehicle.registered_number]|max_length[15]');
        $this->form_validation->set_rules('vehicleSeat', 'Vehicle Seat', 'required');
        $this->form_validation->set_rules('vehicleFuelType', 'Vehicle Fuel Type', 'required');
        //$this->form_validation->set_rules('vehicleImage', 'Vehicle Image', 'required');
        $this->form_validation->set_rules('vehiclePrice', 'Vehicle Price', 'required');
        $this->form_validation->set_rules('vehicleAddKM', 'Vehicle Additional KM', 'required');
        $this->form_validation->set_rules('vehicleAddHour', 'Vehicle Additional Hour', 'required');
        $this->form_validation->set_rules('vehicleInsurance', 'Vehicle Insurance Date', 'required');
        $this->form_validation->set_rules('vehicleLicense', 'Vehicle License Date', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_tempdata('vehicleType_fill', $this->input->post('vehicleType', TRUE), 5);
            $this->session->set_tempdata('vehicleRegisteredNumber_fill', $this->input->post('vehicleRegisteredNumber', TRUE), 5);
            $this->session->set_tempdata('vehicleSeat_fill', $this->input->post('vehicleSeat', TRUE), 5);
            $this->session->set_tempdata('vehicleFuelType_fill', $this->input->post('vehicleFuelType', TRUE), 5);
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

    public function update_vehicle(){
        $update_id = $this->uri->segment(3);
        $this->load->model('Vehicle_Model');
        $data['update_data'] = $this->Vehicle_Model->updateVehicleData($update_id);
        $data['vehicle_data'] = $this->Vehicle_Model->getVehicleData();
        $this->load->view('crms_car', $data);
//        $this->form_validation->set_rules('vehicleType', 'Vehicle Type', 'required');
//        $this->form_validation->set_rules('vehicleRegisteredNumber', 'Vehicle Registered Number', 'required|is_unique[vehicle.registered_number]');
//        $this->form_validation->set_rules('vehicleSeat', 'Vehicle Seat', 'required');
//        $this->form_validation->set_rules('vehicleFuelType', 'Vehicle Fuel Type', 'required');
//        $this->form_validation->set_rules('vehicleImage', 'Vehicle Image', 'required');
//        $this->form_validation->set_rules('vehiclePrice', 'Vehicle Price', 'required');
//        $this->form_validation->set_rules('vehicleAddKM', 'Vehicle Additional KM', 'required');
//        $this->form_validation->set_rules('vehicleAddHour', 'Vehicle Additional Hour', 'required');
//        $this->form_validation->set_rules('vehicleInsurance', 'Vehicle Insurance Date', 'required');
//        $this->form_validation->set_rules('vehicleLicense', 'Vehicle License Date', 'required');
//
//        if ($this->form_validation->run() == FALSE) {
//            $this->load->view('crms_car');
//        }
//        else {
//            $this->load->model('Vehicle_Model');
//            $response = $this->Vehicle_Model->updateVehicleData();
//
//            if($response) {
//                $this->session->set_flashdata('vehicle_status', 'Vehicle update successful');
//                redirect('Home/crms_car');
//            } else {
//                $this->session->set_flashdata('vehicle_status', 'Vehicle update not successful');
//                redirect('Home/crms_car');
//            }
//        }
    }

    public function delete_vehicle($vehicle_id){
        $this->load->model('Vehicle_Model');
        $response = $this->Vehicle_Model->removeVehicleData($vehicle_id);

        if($response) {
            $this->session->set_flashdata('vehicle_status', 'Vehicle details were successfully removed');
            redirect('Home/crms_car');
        }
    }
}