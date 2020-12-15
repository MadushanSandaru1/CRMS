<?php


class VehicleReturnModel extends CI_Model
{
    public function returnVehicle(){

        $values = array(
            'is_returned' => '1',
            'stop_meter_value' => $this->input->post('stop_meter_value')
        );

        $this->db->where('id', $this->input->post('re_id'));
        return $this->db->update('reserved',$values);
    }
    public function extendVehicle(){

        $values = array( 'to_date' => $this->input->post('n_r_date'));

        $this->db->where('id', $this->input->post('ex_id'));
        return $this->db->update('reserved',$values);
    }

    public function getVehicleReserved($id){

        $this->db->select('*');
        $this->db->where('is_deleted=',0);
        $this->db->where('id=',$id);
        $this->db->from('reserved');
        $query = $this->db->get();
        return $query->result();
    }
    public function getCustomerData() {
        $this->db->where('is_deleted', 0);
        $customerdata_view_query = $this->db->get('customer');
        return $customerdata_view_query->result();
    }

    public function getVehicleData() {
        $this->db->where('is_service_out', 0);
        $this->db->where('is_deleted', 0);
        $vehicledata_view_query = $this->db->get('vehicle');
        return $vehicledata_view_query->result();
    }
}