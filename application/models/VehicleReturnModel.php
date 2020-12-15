<?php


class VehicleReturnModel extends CI_Model
{
    public function returnVehicle(){

        $values = array( 'is_returned' => '1');

        $this->db->where('id', $this->input->post('re_id'));
        return $this->db->update('reserved',$values);
    }
    public function extendVehicle(){

        $values = array( 'to_date' => $this->input->post('n_r_date'));

        $this->db->where('id', $this->input->post('ex_id'));
        return $this->db->update('reserved',$values);
    }
}