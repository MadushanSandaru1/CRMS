<?php 


class Booking extends CI_Controller{
	
	function prepareToCustomerInsertBooking()
	{
		$this->form_validation->set_rules('vehicle','Vehicle','required');
		$this->form_validation->set_rules('pickup','Pickup','required');
		$this->form_validation->set_rules('drop_off','Drop off','required');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('nic','Nic','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('phone','Phone','required|regex_match[/^[0-9]{10}$/]');
	

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_tempdata('vehicle_fill', $this->input->post('vehicle', TRUE), 5);
            $this->session->set_tempdata('pickup_fill', $this->input->post('pickup', TRUE), 5);
            $this->session->set_tempdata('drop_off_fill', $this->input->post('drop_off', TRUE), 5);
            $this->session->set_tempdata('name_fill', $this->input->post('name', TRUE), 5);
            $this->session->set_tempdata('nic_fill', $this->input->post('nic', TRUE), 5);
            $this->session->set_tempdata('email_fill', $this->input->post('email', TRUE), 5);
            $this->session->set_tempdata('phone_fill', $this->input->post('phone', TRUE), 5);
            $this->session->set_tempdata('msg_fill', $this->input->post('msg', TRUE), 5);
            

        	$this->load->model('Vehicle_Model');
        	$data['available_vehicle'] = $this->Vehicle_Model->getVehicleData();
        	$this->load->view('home',$data);

		}else{

			$this->load->model('Booking_Model');
			$response = $this->Booking_Model->insertBooking();

			if ($response) {
				$this->session->set_flashdata('status', 'Booking successful!');
				redirect('Home/index#bookingform');
			}

		}

	}


	function prepareToStaffInsertBooking()
	{
		$this->form_validation->set_rules('vehicle','Vehicle','required');
		$this->form_validation->set_rules('pickup','Pickup','required');
		$this->form_validation->set_rules('drop_off','Drop off','required');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('nic','Nic','required');
		$this->form_validation->set_rules('email','Email','valid_email');
		$this->form_validation->set_rules('phone','Phone','required|regex_match[/^[0-9]{10}$/]');
	

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_tempdata('vehicle_fill', $this->input->post('vehicle', TRUE), 5);
            $this->session->set_tempdata('pickup_fill', $this->input->post('pickup', TRUE), 5);
            $this->session->set_tempdata('drop_off_fill', $this->input->post('drop_off', TRUE), 5);
            $this->session->set_tempdata('name_fill', $this->input->post('name', TRUE), 5);
            $this->session->set_tempdata('nic_fill', $this->input->post('nic', TRUE), 5);
            $this->session->set_tempdata('email_fill', $this->input->post('email', TRUE), 5);
            $this->session->set_tempdata('phone_fill', $this->input->post('phone', TRUE), 5);
            $this->session->set_tempdata('msg_fill', $this->input->post('msg', TRUE), 5);
            $this->session->set_tempdata('form','add_form',5);
            
            $this->load->model("Customer_Model");
        	$data["regular_customers"] = $this->Customer_Model->getCustomers();

        	$this->load->model('Vehicle_Model');
        	$data['available_vehicle'] = $this->Vehicle_Model->getVehicleData();

        	$this->load->model("Customer_message");
        	$data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
	        $this->load->model("notification");
	        $data["insurence_date"]=$this->notification->insurence_date();
	        $data["revenue_license_date"]=$this->notification->revenue_license_date();
	        $data["car_booking_notification"]=$this->notification->car_booking_notification();
	        $data["car_not_recive"]=$this->notification->car_not_recive();

	        $this->load->model("Booking_Model");
        	$data['booking_data']=$this->Booking_Model->getBooking();

        	$this->load->view('crms_booking',$data);

		}else{

			$this->load->model('Booking_Model');
        	$response = $this->Booking_Model->insertBooking();

			if ($response) {
				$this->session->set_flashdata('status', 'Booking successful!');
				redirect('Home/crms_booking');
			}

		}

	}


	function prepareToUpdateBooking(){

		$this->form_validation->set_rules('update_vehicle','Vehicle','required');
		$this->form_validation->set_rules('update_pickup','Pickup','required');
		$this->form_validation->set_rules('update_drop_off','Drop off','required');
		$this->form_validation->set_rules('update_name','Name','required');
		$this->form_validation->set_rules('update_nic','Nic','required');
		$this->form_validation->set_rules('update_email','Email','valid_email');
		$this->form_validation->set_rules('update_phone','Phone','required|regex_match[/^[0-9]{10}$/]');
	

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_tempdata('update_vehicle_fill', $this->input->post('update_vehicle', TRUE), 5);
            $this->session->set_tempdata('update_pickup_fill', $this->input->post('update_pickup', TRUE), 5);
            $this->session->set_tempdata('update_drop_off_fill', $this->input->post('update_drop_off', TRUE), 5);
            $this->session->set_tempdata('update_name_fill', $this->input->post('update_name', TRUE), 5);
            $this->session->set_tempdata('update_nic_fill', $this->input->post('update_nic', TRUE), 5);
            $this->session->set_tempdata('update_email_fill', $this->input->post('update_email', TRUE), 5);
            $this->session->set_tempdata('update_phone_fill', $this->input->post('update_phone', TRUE), 5);
            $this->session->set_tempdata('update_msg_fill', $this->input->post('update_msg', TRUE), 5);
            $this->session->set_tempdata('form','update_form',5);
            

            $this->load->model("Customer_Model");
       		$data["regular_customers"] = $this->Customer_Model->getCustomers();

        	$this->load->model('Vehicle_Model');
        	$data['available_vehicle'] = $this->Vehicle_Model->getVehicleData();

        	$this->load->model("Customer_message");
        	$data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
	        $this->load->model("notification");
	        $data["insurence_date"]=$this->notification->insurence_date();
	        $data["revenue_license_date"]=$this->notification->revenue_license_date();
	        $data["car_booking_notification"]=$this->notification->car_booking_notification();
	        $data["car_not_recive"]=$this->notification->car_not_recive();

	        $this->load->model("Booking_Model");
        	$data['booking_data']=$this->Booking_Model->getBooking();

        	$this->load->view('crms_booking',$data);

		}else{

			$this->load->model('Booking_Model');
        	$response = $this->Booking_Model->updateBooking();

			if ($response) {
				$this->session->set_flashdata('status', 'Update successful!');
				redirect('Home/crms_booking');
			}

		}
		
	}


	function changeBookingStatus(){

		/*var_dump($this->input->post());
		die();*/

		// $this->form_validation->set_rules('bookingstatus','Booking status','required');
		// $this->form_validation->set_rules('bookingmail','Customer email','required');
		// $this->form_validation->set_rules('bookingid','Booking id','required');

		// if ($this->form_validation->run() == FALSE) {
			
		// 	$this->load->model('Vehicle_Model');
  //       	$data['available_vehicle'] = $this->Vehicle_Model->getVehicleData();

  //       	$this->load->model("Customer_message");
  //       	$data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
	 //        $this->load->model("notification");
	 //        $data["insurence_date"]=$this->notification->insurence_date();
	 //        $data["revenue_license_date"]=$this->notification->revenue_license_date();
	 //        $data["car_booking_notification"]=$this->notification->car_booking_notification();
	 //        $data["car_not_recive"]=$this->notification->car_not_recive();

		//}else{

			if (strcmp("accept", $this->input->post('bookingstatus'))==0) {
				
				$this->load->model('Booking_Model');
	        	$response = $this->Booking_Model->acceptBooking();

				if ($response) {

					$this->load->model("Email_Model");

					$email = $this->input->post('bookingmail'); // reciver mail
			        $msg_sub = "Vehicle Booking";
			        $msg = "Dear customer, <br>Your vehicle booking was accepted!";

			        if($this->Email_Model->trigger_mail($email,$msg_sub,$msg,"")){
			        	redirect('Home/crms_booking');
			        }
					
				}

			}else{

				$this->load->model('Booking_Model');
	        	$response = $this->Booking_Model->rejectBooking();

				if ($response) {

					$this->load->model("Email_Model");

					$email = $this->input->post('bookingmail'); // reciver mail
			        $msg_sub = "Vehicle Booking";
			        $msg = "Dear customer, <br>Sorry, your vehicle booking was rejected!";

			        if($this->Email_Model->trigger_mail($email,$msg_sub,$msg,"")){
			        	redirect('Home/crms_booking');
			        }
					
				}

			}
		
		//}

	}


	function prepareToDeleteBooking(){

		$this->load->model('Booking_Model');
	    $response = $this->Booking_Model->deleteBooking();

	    if ($response) {		
			redirect('Home/crms_booking');			
		}

	}



	 public function init_new_customer($nic,$name,$email,$phone){

        $this->session->set_tempdata('nic_fill', rawurldecode($nic), 5);
        $this->session->set_tempdata('name_fill', rawurldecode($name) , 5);
        $this->session->set_tempdata('email_fill', rawurldecode($email), 5);
        $this->session->set_tempdata('phone_fill', rawurldecode($phone), 5);
        $this->session->set_tempdata('form','add_form',5);


        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model("Customer_Model");
        $data['customer_data']=$this->Customer_Model->getCustomers();
        $this->load->view('crms_customer',$data);
    }



    public function init_for_reserve($nic,$name,$email,$phone){
        
        $this->session->set_tempdata('nic_fill', rawurldecode($nic), 5);
        $this->session->set_tempdata('name_fill', rawurldecode($name) , 5);
        $this->session->set_tempdata('email_fill', rawurldecode($email), 5);
        $this->session->set_tempdata('phone_fill', rawurldecode($phone), 5);
        $this->session->set_tempdata('form','add_form',5);


        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model("Reserved_Model");
        $data['vehicle_data'] = $this->Reserved_Model->getVehicleData();
        $data['customer_data'] = $this->Reserved_Model->getCustomerData();
        $data['reserved_data'] = $this->Reserved_Model->getVehicleReservedData();

        $this->load->view('crms_reserved', $data);
    }


}
 ?>