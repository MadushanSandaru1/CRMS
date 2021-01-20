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


    function getBooking(){

        /*$this->db->select('*');
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('booking');*/
        //$query=$this->db->query("SELECT * FROM booking WHERE is_deleted=0 ORDER BY id ASC ");
        $query=$this->db->query("SELECT b.`id`,b.`customer_nic`,b.`customer_name`,b.`customer_email`,b.`customer_phone`,v.`id` as `vehicle_id`,v.`title`,v.`registered_number`,b.`from_date`,b.`to_date`,b.`posting_date`,b.`message`,b.`status` FROM booking as b, vehicle as v WHERE v.`id`= b.vehicle_id AND b.is_deleted=0 ORDER BY b.id ASC");
        return $query;

    }


    function acceptBooking(){
        
        $values = array( 'status' => '1');

        $this->db->where('id', $this->input->post('bookingid'));
        return $this->db->update('booking',$values);

    }

    function rejectBooking(){
        
        $values = array( 'status' => '-1');

        $this->db->where('id', $this->input->post('bookingid'));
        return $this->db->update('booking',$values);

    }

	function deleteBooking(){

        $values = array( 'is_deleted' => '1');

        $this->db->where('id', $this->input->post('delbookingid'));
        return $this->db->update('booking',$values);
    }



    function updateBooking(){

        $values = array(
        'customer_nic' => $this->input->post('update_nic',TRUE),
        'customer_name' => $this->input->post('update_name',TRUE),
        'customer_email' => $this->input->post('update_email',TRUE),
        'customer_phone' => $this->input->post('update_phone',TRUE),
        'vehicle_id' => $this->input->post('update_vehicle',TRUE),
        'from_date' => $this->input->post('update_pickup',TRUE),
        'to_date' => $this->input->post('update_drop_off',TRUE),
        'message' => $this->input->post('update_msg',TRUE)
        );

        $this->db->where('id', $this->input->post('booking_id'));
        return $this->db->update('booking', $values);


       /* $query = UPDATE `booking` SET `customer_nic`= ,`customer_name`= ,`customer_email`= ,`customer_phone`= ,`vehicle_id`= ,`from_date`= ,`to_date`= ,`message`=  WHERE `id` =*/
    }

}

 ?>