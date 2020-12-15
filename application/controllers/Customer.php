<?php 

	class Customer extends CI_Controller

    {
    	public function uploadFiles($file){
				$image_data = null;

    			$config['upload_path'] = './assets/images/customers/documentation/';
			    $config['allowed_types'] = 'gif|jpg|png|jpeg';
			    /*$config['max_size'] = '1000000';
				$config['max_width']  = '1024000';
				$config['max_height']  = '768000';*/
			    $config['encrypt_name'] = TRUE;
			    $config['overwrite'] = FALSE;
			    $this->load->library('upload',$config); 

			    if ($this->upload->do_upload($file)){
			    	$image_data = $this->upload->data();
			                
			    }
			    else{
			        echo $this->upload->display_errors();		         
			    }

			    return $image_data;
    	}



        public function prepareToInsertCustomer() {
           
        	//validate customer details
        	$this->form_validation->set_rules('name','Name','required');
        	$this->form_validation->set_rules('nic','NIC','required|is_unique[customer.nic]');
        	$this->form_validation->set_rules('email','Email','valid_email|is_unique[customer.email]');
        	$this->form_validation->set_rules('phone','Phone','required|regex_match[/^[0-9]{10}$/]');
        	$this->form_validation->set_rules('address','Address','required');
            if (empty($_FILES['nic_copy']['name']))
            {
                $this->form_validation->set_rules('nic_copy', 'NIC Copy', 'required');
            }
            if (empty($_FILES['license_copy']['name']))
            {
                $this->form_validation->set_rules('license_copy', 'License Copy', 'required');
            }


        	//check validated
        	if($this->form_validation->run() == FALSE){

                $this->session->set_tempdata('avatar_fill', $this->input->post('avatarReady', TRUE), 5);
                $this->session->set_tempdata('name_fill', $this->input->post('name', TRUE), 5);
                $this->session->set_tempdata('nic_fill', $this->input->post('nic', TRUE), 5);
                $this->session->set_tempdata('email_fill', $this->input->post('email', TRUE), 5);
                $this->session->set_tempdata('phone_fill', $this->input->post('phone', TRUE), 5);
                $this->session->set_tempdata('address_fill', $this->input->post('address', TRUE), 5);
                // $this->session->set_tempdata('email_fill', $this->input->post('email', TRUE), 5);
                // $this->session->set_tempdata('phone_fill', $this->input->post('phone', TRUE), 5);
                // $this->session->set_tempdata('msg_fill', $this->input->post('msg', TRUE), 5);
            


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

        	}else{
        		
        		$nic_copy_data = null;
        		$license_copy_data = null;
        		$light_bill_copy_data = null;

        		if (!empty($_FILES['nic_copy']['name'])){ 
        			$nic_copy_data = $this->uploadFiles('nic_copy');
        		}
        		if (!empty($_FILES['license_copy']['name'])){ 
        			$license_copy_data = $this->uploadFiles('license_copy');
        		}
        		if (!empty($_FILES['light_bill_copy']['name'])){ 
        			$light_bill_copy_data = $this->uploadFiles('light_bill_copy');
        		}
        		
        		$this->load->model('Customer_Model');
        		$response = $this->Customer_Model->insertCustomer($nic_copy_data,$license_copy_data,$light_bill_copy_data);

        			if ($response) {
        				$this->session->set_flashdata('status', 'New customer added successfully!');
        				redirect('Home/crms_customer');
        			}


	        	}

	    }




	    public function prepareToUpdateCustomer() {
           
        	//validate customer details
        	$this->form_validation->set_rules('edit_name','Name','required');
        	$this->form_validation->set_rules('edit_nic','NIC','required|is_unique[customer.nic]');
        	$this->form_validation->set_rules('edit_email','Email','valid_email|is_unique[customer.email]');
        	$this->form_validation->set_rules('edit_phone','Phone','required|regex_match[/^[0-9]{10}$/]');
        	$this->form_validation->set_rules('edit_address','Address','required');
        	//$this->form_validation->set_rules('nic_copy', 'NIC Copy', 'required');
        	//$this->form_validation->set_rules('license_copy', 'License Copy', 'required');

        	//check validated
        	if($this->form_validation->run() == FALSE){

        		$this->load->model("Customer_Model");
        		$data['customer_data']=$this->Customer_Model->getCustomers();
        		$this->load->view('crms_customer',$data);
        		
        	}else{
        		
        		$nic_copy_data = null;
        		$license_copy_data = null;
        		$light_bill_copy_data = null;

        		if (!empty($_FILES['nic_copy']['name'])){ 
        			$nic_copy_data = $this->uploadFiles('nic_copy');
        		}
        		if (!empty($_FILES['license_copy']['name'])){ 
        			$license_copy_data = $this->uploadFiles('license_copy');
        		}
        		if (!empty($_FILES['light_bill_copy']['name'])){ 
        			$light_bill_copy_data = $this->uploadFiles('light_bill_copy');
        		}
        		
        		$this->load->model('Customer_Model');
        		$response = $this->Customer_Model->insertCustomer($nic_copy_data,$license_copy_data,$light_bill_copy_data);

        			if ($response) {
        				$this->session->set_flashdata('status', 'New customer added successfully!');
        				redirect('Home/crms_customer');
        			}


	        	}

	    }


	    /*public function prepareToGetCustomers{

	    	$this->load->model("Customer_Model");
	        $data['fetch_data']=$this->Customer_Model->getCustomers();
	        $this->load->view('crms_customer',$data);
	    }*/

        	
   	}


 ?>

