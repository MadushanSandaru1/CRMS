<?php 

	class Customer extends CI_Controller

    {

    	private function upload_files($path,$title,$files){

    			$config['upload_path'] = $path;
			    $config['allowed_types'] = 'gif|jpg|png|jpeg';
			    $this->load->library('upload',$config); 
    	}

        public function add_customer() {
           
        	//validate customer details
        	$this->form_validation->set_rules('name','Name','required');
        	$this->form_validation->set_rules('nic','NIC','required');
        	$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[customer.email]');
        	$this->form_validation->set_rules('phone','Phone','required|regex_match[/^[0-9]{10}$/]');
        	$this->form_validation->set_rules('address','Address','required');
        	//$this->form_validation->set_rules('nic_copy', 'NIC Copy', 'required');
        	//$this->form_validation->set_rules('license_copy', 'License Copy', 'required');

        	//check validated
        	if($this->form_validation->run() == FALSE){
        		$this->load->view('crms_customer');
        	}else{
        		

        

			           

			         if ($this->upload->do_upload('nic_copy')){
			                echo "uploded";
			                die();
			         }
			         else{
			               echo $this->upload->display_errors();
			         }
			    


			         $config['upload_path'] = './assets/images/customers/License Copy/';
			         $config['allowed_types'] = 'gif|jpg|png|jpeg';
			         $this->load->library('upload',$config);   

			         /*if ($this->upload->do_upload('license_copy'){
			                echo "uploded";
			                die();
			         }
			         else{
			               echo $this->upload->display_errors();
			         }*/


			        /* $config['upload_path'] = './assets/images/customers/NIC Copy/';
			         $config['allowed_types'] = 'gif|jpg|png|jpeg';
			         $this->load->library('upload',$config);   

			         if ($this->upload->do_upload('nic_copy'){
			                echo "uploded";
			                die();
			         }
			         else{
			               echo $this->upload->display_errors();
			         }*/

	        	}

	    }	
        	
   	}


 ?>

