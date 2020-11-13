<?php 

	class Customer extends CI_Controller

    {



        public function add_customer() {
           
        	//validate customer details
        	$this->form_validation->set_rules('name','Name','required');
        	$this->form_validation->set_rules('nic','NIC','required|is_unique[customer.nic]');
        	$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[customer.email]');
        	$this->form_validation->set_rules('phone','Phone','required|regex_match[/^[0-9]{10}$/]');
        	$this->form_validation->set_rules('address','Address','required');
        	//$this->form_validation->set_rules('nic_copy', 'NIC Copy', 'required');
        	//$this->form_validation->set_rules('license_copy', 'License Copy', 'required');

        	//check validated
        	if($this->form_validation->run() == FALSE){
        		$this->load->view('crms_customer');
        	}else{
        		
        		$nic_copy_data = null;
        		$license_copy_data = null;
        		$light_bill_copy_data = null;

        		if (!empty($_FILES['nic_copy']['name'])){ 
        			$nic_copy_data = $this->upload_files('nic_copy');
        		}
        		if (!empty($_FILES['license_copy']['name'])){ 
        			$license_copy_data = $this->upload_files('license_copy');
        		}
        		if (!empty($_FILES['light_bill_copy']['name'])){ 
        			$light_bill_copy_data = $this->upload_files('light_bill_copy');
        		}
        		
        		$this->load->model('Customer_Model');
        		$response = $this->Customer_Model->insertCustomer($nic_copy_data,$license_copy_data,$light_bill_copy_data);

        			if ($response) {
        				$this->session->set_flashdata('status', 'New customer added successfully!');
        				redirect('Home/crms_customer');
        			}


	        	}

	    }



	    public function upload_files($file){
				$image_data = null;

    			$config['upload_path'] = './assets/images/customers/img_documents/';
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

        	
   	}


 ?>

