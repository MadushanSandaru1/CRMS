<?php


class Vehicle_Model extends CI_Model
{
    public function insertVehicleData($image_path){
        $vehicle_data = array(
            'title' => ucwords($this->input->post('vehicleType', TRUE)),
            'registered_number' => strtoupper($this->input->post('vehicleRegisteredNumber', TRUE)),
            'seat' => $this->input->post('vehicleSeat', TRUE),
            'fuel_type' => $this->input->post('vehicleFuelType', TRUE),
            'ac' => $this->input->post('radioAC', TRUE),
            'transmission' => $this->input->post('radioTransmission', TRUE),
            'image' => $image_path,
            'price_per_day' => $this->input->post('vehiclePrice', TRUE),
            'additional_price_per_km' => $this->input->post('vehicleAddKM', TRUE),
            'additional_price_per_hour' => $this->input->post('vehicleAddHour', TRUE),
            'insurence_date' => $this->input->post('vehicleInsurance', TRUE),
            'system_registered_date' => date("Y-m-d"),
            'revenue_license_date' => $this->input->post('vehicleLicense', TRUE)
        );

        return $this->db->insert('vehicle',$vehicle_data);
    }

    //get guarantor data function
    public function getVehicleData() {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'ASC');

        return $this->db->get('vehicle');
    }
    //** get guarantor data function **

    public function updateVehicleData($path){

        $update_data = array(
            'title' => ucwords($this->input->post('u_vehicleType', TRUE)),
            'registered_number' => strtoupper($this->input->post('u_vehicleRegisteredNumber', TRUE)),
            'seat' => $this->input->post('u_vehicleSeat', TRUE),
            'fuel_type' => $this->input->post('u_vehicleFuelType', TRUE),
            'ac' => $this->input->post('u_radioAC', TRUE),
            'transmission' => $this->input->post('u_radioTransmission', TRUE),
            'price_per_day' => $this->input->post('u_vehiclePrice', TRUE),
            'additional_price_per_km' => $this->input->post('u_vehicleAddKM', TRUE),
            'additional_price_per_hour' => $this->input->post('u_vehicleAddHour', TRUE),
            'insurence_date' => $this->input->post('u_vehicleInsurance', TRUE),
            'revenue_license_date' => $this->input->post('u_vehicleLicense', TRUE)
        );

        if ($path!=null) {
            $update_data['image'] =$path['file_name'];
        }

        $this->db->where('id', $this->input->post('u_vehicle_id'));
        return $this->db->update('vehicle', $update_data);
    }

    //delete guarantor data function
    public function removeVehicleData() {
        $this->db->set('is_deleted', 1);
        $this->db->where('id', $this->input->post('delvehicleid'));
        $this->db->where('is_deleted', 0);

        return $this->db->update('vehicle');;
    }
    //** delete guarantor data function **


}