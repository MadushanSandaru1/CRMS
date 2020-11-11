<?php


class Vehicle extends CI_Controller
{
    public function add_vehicle(){
        $this->form_validation->set_rules('vehicleType', 'Vehicle Type', 'required');
        $this->form_validation->set_rules('vehicleRegisteredNumber', 'Vehicle Registered Number', 'required|is_unique[vehicle.registered_number]');
        $this->form_validation->set_rules('vehicleSeat', 'Vehicle Seat', 'required');
        $this->form_validation->set_rules('vehicleFuelType', 'Vehicle Fuel Type', 'required');
        //$this->form_validation->set_rules('vehicleImage', 'Vehicle Image', 'required');
        $this->form_validation->set_rules('vehiclePrice', 'Vehicle Price', 'required');
        $this->form_validation->set_rules('vehicleAddKM', 'Vehicle Additional KM', 'required');
        $this->form_validation->set_rules('vehicleAddHour', 'Vehicle Additional Hour', 'required');
        $this->form_validation->set_rules('vehicleInsurance', 'Vehicle Insurance Date', 'required');
        $this->form_validation->set_rules('vehicleLicense', 'Vehicle License Date', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('crms_car');
        }
        else
        {
            $this->load->model('Vehicle_Model');
            $response = $this->Vehicle_Model->insertVehicleData();

            if($response) {
                $this->session->set_flashdata('vehicle_status', 'Registered Succuessful');
                redirect('Home/crms_car');
            } else {
                $this->session->set_flashdata('vehicle_status', 'Registered Not Succuessful');
                redirect('Home/crms_car');
            }

        }
    }
}