<?php 


class Booking extends CI_Controller{
	
	function prepareToInsertBooking()
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
}
 ?>