<?php

class OutsourceVehicleModel extends CI_Model
{
    public function insertOutsourceVehicle($image_path)
    {
<<<<<<< Updated upstream
        $cur_date = date("yy-m-d");
        $values = array(
            'supplier_id'=>$this->input->post('supplier_id',TRUE),
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
            'revenue_license_date' => $this->input->post('revenue_license_date',TRUE),
        );

        //print_r($values);
        return $this->db->insert('outsourcing_vehicle',$values);
    }

    public function getOutsourceDetails()
    {
        $this->db->select('*');
        $this->db->where('is_deleted',0);
        $this->db->where('is_service_out',0);
        $this->db->from('outsourcing_vehicle');
        $query = $this->db->get();
        return $query->result();

    }

    public function getSupplier()
    {
        $this->db->select('*');
        $this->db->where('is_deleted=',0);
        $this->db->from('outsourcing_supplier');
        $query = $this->db->get();
        return $query->result();

    }

    public function deleteOutSourceVehicle()
    {
        $values = array( 'is_deleted' => '1');

        $this->db->where('id', $this->input->post('deloutsourcevid'));
        return $this->db->update('outsourcing_vehicle',$values);
    }

    public function updateOutsourceVehicle($path)
    {
        if($path == " ")
        {
            $values = array(
                'supplier_id'=>$this->input->post('update_supplier_id',TRUE),
                'title' => $this->input->post('u_vehicleTitle',TRUE),
                'registered_number' => $this->input->post('u_vehicleRegisteredNumber',TRUE),
                'seat' => $this->input->post('u_vehicleSeat',TRUE),
                'fuel_type' => $this->input->post('u_vehicleFuelType',TRUE),
                'ac' => $this->input->post('u_radioAC',TRUE),
                'transmission' => $this->input->post('u_radioTransmission',TRUE),
                'price_per_day' => $this->input->post('u_vehiclePrice',TRUE),
                'additional_price_per_km' => $this->input->post('u_vehicleAddKM',TRUE),
                'additional_price_per_hour' => $this->input->post('u_vehicleAddHour',TRUE),
                'insurence_date' => $this->input->post('u_vehicleInsurance',TRUE),
                'revenue_license_date' => $this->input->post('u_vehicleLicense',TRUE),
            );
        }

        if($path != " ")
        {
            $values = array(
                'supplier_id'=>$this->input->post('update_supplier_id',TRUE),
                'title' => $this->input->post('u_vehicleTitle',TRUE),
                'registered_number' => $this->input->post('u_vehicleRegisteredNumber',TRUE),
                'seat' => $this->input->post('u_vehicleSeat',TRUE),
                'fuel_type' => $this->input->post('u_vehicleFuelType',TRUE),
                'ac' => $this->input->post('u_radioAC',TRUE),
                'transmission' => $this->input->post('u_radioTransmission',TRUE),
                'image' => $path,
                'price_per_day' => $this->input->post('u_vehiclePrice',TRUE),
                'additional_price_per_km' => $this->input->post('u_vehicleAddKM',TRUE),
                'additional_price_per_hour' => $this->input->post('u_vehicleAddHour',TRUE),
                'insurence_date' => $this->input->post('u_vehicleInsurance',TRUE),
                'revenue_license_date' => $this->input->post('u_vehicleLicense',TRUE),
            );
        }

        $this->db->where('id', $this->input->post('u_outsource_id'));
        return $this->db->update('outsourcing_vehicle', $values);
=======
            public function insertOutsourceVehicle($image_path)
            {
                $cur_date = date("yy-m-d");
                $values = array(
                    'supplier_id'=>$this->input->post('supplier_id',TRUE),
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
                    'revenue_license_date' => $this->input->post('revenue_license_date',TRUE),
                );

                //print_r($values);
                return $this->db->insert('outsourcing_vehicle',$values);
            }

            public function getOutsourceDetails()
            {
                $this->db->select('*');
                $this->db->where('is_deleted',0);
                $this->db->where('is_service_out',0);
                $this->db->from('outsourcing_vehicle');
                $query = $this->db->get();
                return $query->result();

            }

            public function getSupplier()
            {
                $this->db->select('*');
                $this->db->where('is_deleted=',0);
                $this->db->from('outsourcing_supplier');
                $query = $this->db->get();
                return $query->result();
                        
            }

            public function deleteOutSourceVehicle()
            {
                $values = array( 'is_deleted' => '1');

                $this->db->where('id', $this->input->post('deloutsourcevid'));
                return $this->db->update('outsourcing_vehicle',$values);
            }

            public function updateOutsourceVehicle($path)
            {
                if($path == " ")
                {
                    $values = array(
                        'supplier_id'=>$this->input->post('update_supplier_id',TRUE),
                        'title' => $this->input->post('u_vehicleTitle',TRUE),
                        'registered_number' => $this->input->post('u_vehicleRegisteredNumber',TRUE),
                        'seat' => $this->input->post('u_vehicleSeat',TRUE),
                        'fuel_type' => $this->input->post('u_vehicleFuelType',TRUE),
                        'ac' => $this->input->post('u_radioAC',TRUE),
                        'transmission' => $this->input->post('u_radioTransmission',TRUE),
                        'image' => $path,
                        'price_per_day' => $this->input->post('u_vehiclePrice',TRUE),
                        'additional_price_per_km' => $this->input->post('u_vehicleAddKM',TRUE),
                        'additional_price_per_hour' => $this->input->post('u_vehicleAddHour',TRUE),
                        'insurence_date' => $this->input->post('u_vehicleInsurance',TRUE),
                        'revenue_license_date' => $this->input->post('u_vehicleLicense',TRUE),
                    );
                }

                if($path != " ")
                {
                    $values = array(
                        'supplier_id'=>$this->input->post('update_supplier_id',TRUE),
                        'title' => $this->input->post('u_vehicleTitle',TRUE),
                        'registered_number' => $this->input->post('u_vehicleRegisteredNumber',TRUE),
                        'seat' => $this->input->post('u_vehicleSeat',TRUE),
                        'fuel_type' => $this->input->post('u_vehicleFuelType',TRUE),
                        'ac' => $this->input->post('u_radioAC',TRUE),
                        'transmission' => $this->input->post('u_radioTransmission',TRUE),
                        'price_per_day' => $this->input->post('u_vehiclePrice',TRUE),
                        'additional_price_per_km' => $this->input->post('u_vehicleAddKM',TRUE),
                        'additional_price_per_hour' => $this->input->post('u_vehicleAddHour',TRUE),
                        'insurence_date' => $this->input->post('u_vehicleInsurance',TRUE),
                        'revenue_license_date' => $this->input->post('u_vehicleLicense',TRUE),
                    );
                }

                $this->db->where('id', $this->input->post('u_outsource_id'));
                return $this->db->update('outsourcing_vehicle', $values);
            }
>>>>>>> Stashed changes
    }
}
?>