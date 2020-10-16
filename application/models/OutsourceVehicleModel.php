<?php

    class OutsourceVehicleModel extends CI_Model
    {
            public function insertOutsourceVehicle($image_path)
            {
                $cur_date = date("yy-m-d");
                $values = array(
                    'title' => $this->input->post('vehicle_title',TRUE),
                    'registered_number' => $this->input->post('registered_no',TRUE),
                    'seat' => $this->input->post('no_of_seat',TRUE),
                    'fuel_type' => $this->input->post('fuel_type',TRUE),
                    'ac' => $this->input->post('radioAC',TRUE),
                    'transmission' => $this->input->post('radioTransmission',TRUE),
                    'image' => $image_path,
                    'price_per_day' => $this->input->post('price_per_day',TRUE),
                    'additional_price_per_km' => $this->input->post('per_km',TRUE),
                    'additional_price_per_hour' => $this->input->post('per_hour',TRUE),
                    'system_registered_date' => $cur_date,
                    'insurence_date' => $this->input->post('insurence_date',TRUE),
                    'revenue_license_date' => $this->input->post('revenue_licence_date',TRUE),
                );

                //print_r($values);
                return $this->db->insert('outsourcing_vehicle',$values);
            }
    }
?>