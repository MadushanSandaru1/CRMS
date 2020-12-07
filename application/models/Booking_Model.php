<?php 


class Booking_Model extends CI_Model{
	

	function insertBooking(){

		var_dump($this->input->post());

		$values = array(

			'customer_nic'=> $this->input->post('nic', TRUE),
			'customer_name'=> $this->input->post('name', TRUE),
			'customer_email'=> $this->input->post('email', TRUE),
            'customer_phone'=> $this->input->post('phone', TRUE),
            'vehicle_id' => $this->input->post('vehicle', TRUE),
            'from_date' => $this->input->post('pickup', TRUE),
            'to_date' => $this->input->post('drop_off', TRUE),
            'posting_date'=> Date('Y-m-d\TH:i',time()),      
            'message'=> $this->input->post('msg',TRUE),
            'status'=> $this->input->post('status'),
            'is_deleted'=> 0,
        );

        return $this->db->insert('booking', $values);

	}
	
}

 ?>