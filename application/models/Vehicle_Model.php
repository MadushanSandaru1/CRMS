<?php


class Vehicle_Model extends CI_Model
{
    public function insertVehicleData(){
        $vehicle_data = array(
            'title' => $this->input->post('vehicleType', TRUE),
            'registered_number' => $this->input->post('vehicleRegisteredNumber', TRUE),
            'seat' => $this->input->post('vehicleSeat', TRUE),
            'fuel_type' => $this->input->post('vehicleFuelType', TRUE),
            'ac' => $this->input->post('radioAC', TRUE),
            'transmission' => $this->input->post('radioTransmission', TRUE),
            'image' => $this->input->post('vehicleImage', TRUE),
            'price_per_day' => $this->input->post('vehiclePrice', TRUE),
            'additional_price_per_km' => $this->input->post('vehicleAddKM', TRUE),
            'additional_price_per_hour' => $this->input->post('vehicleAddHour', TRUE),
            'insurence_date' => $this->input->post('vehicleInsurance', TRUE),
            'system_registered_date' => date("Y-m-d"),
            'revenue_license_date' => $this->input->post('vehicleLicense', TRUE)
        );

        return $this->db->insert('vehicle',$vehicle_data);
    }

    public function getVehicleData() {
        //$userdata_view_query = $this->db->get('vehicle');
        $userdata_view_query = $this->db->query('SELECT * FROM `vehicle` WHERE `is_deleted` = 0');
        return $userdata_view_query;
    }

    public function updateVehicleData(){
        $conditions_data = array(
            'id' => $this->input->post('vehicleId', TRUE)
        );
        $update_data = array(
            'title' => $this->input->post('vehicleType', TRUE),
            'registered_number' => $this->input->post('vehicleRegisteredNumber', TRUE),
            'seat' => $this->input->post('vehicleSeat', TRUE),
            'fuel_type' => $this->input->post('vehicleFuelType', TRUE),
            'ac' => $this->input->post('radioAC', TRUE),
            'transmission' => $this->input->post('radioTransmission', TRUE),
            'image' => $this->input->post('vehicleImage', TRUE),
            'price_per_day' => $this->input->post('vehiclePrice', TRUE),
            'additional_price_per_km' => $this->input->post('vehicleAddKM', TRUE),
            'additional_price_per_hour' => $this->input->post('vehicleAddHour', TRUE),
            'insurence_date' => $this->input->post('vehicleInsurance', TRUE),
            'system_registered_date' => date("Y-m-d"),
            'revenue_license_date' => $this->input->post('vehicleLicense', TRUE)
        );

        return $this->db->update('vehicle', $update_data, $conditions_data);
    }
}