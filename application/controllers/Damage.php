<?php
        class Damage extends CI_Controller{

            public function DamageVehicle()
            {
               $this->form_validation->set_rules('vehicle_id','Vehicle ID','required');
               $this->form_validation->set_rules('description','Nature of Damage','required');
               //$this->form_validation->set_rules('image_file','Damage Image File','required');
               $this->form_validation->set_rules('chooser','Reserved ID','required');
            //    $this->form_validation->set_rules('fix_amount','Fix Amount','required');
            //    $this->form_validation->set_rules('is_solved','Is Solved','required');
            //    $this->form_validation->set_rules('d_date','Damage Date','required');

               if($this->form_validation->run() == FALSE)
               {    
                    $this->load->model('DamageModel');
                    $getVehicleID = $this->DamageModel->getVehicleID();
                    $getReservedID = $this->DamageModel->getReservedID();
                    $getDamageDetails = $this->DamageModel->getDamageDetails();
                    $getCustomerDetails = $this->DamageModel-> getCustomerDetails();
                    $this->load->view('crms_damage',['getVehicleID'=>$getVehicleID,'getReservedID'=>$getReservedID,'getDamageDetails'=>$getDamageDetails,' getCustomerDetails'=> $getCustomerDetails]);
               }
               else{
                   //echo "ok";
                   $config['allowed_types'] = 'jpg|png|jpeg'; 
                   $config['upload_path'] = './uploads/damages/';
                   $this->load->library('upload',$config);

                   if($this->upload->do_upload('image_file'))
                   {
                        //print_r($this->upload->data());
                        $data = $this->input->post();
                        $info = $this->upload->data();
                        $image_path= "uploads/damages/".$info['raw_name'].$info['file_ext'];
                        $this->load->model('DamageModel');
                        $response = $this->DamageModel->insertDamage($image_path);

                        if($response)
                        {
                            $this->load->model('DamageModel');
                            $getVehicleID = $this->DamageModel->getVehicleID();
                            $getReservedID = $this->DamageModel->getReservedID();
                            $this->session->set_flashdata('damage_status', 'Data Recorded Successfully!');
                            $this->load->view('crms_damage',['getVehicleID'=>$getVehicleID,'getReservedID'=>$getReservedID]);
                        }
                        
                   }
                   else
                   {
                        $this->load->model('DamageModel');
                        $getVehicleID = $this->DamageModel->getVehicleID();
                        $getReservedID = $this->DamageModel->getReservedID();
                        $this->session->set_flashdata('msgValidation', 'You have to upload Picture');
                        $this->load->view('crms_damage',['getVehicleID'=>$getVehicleID,'getReservedID'=>$getReservedID]);
                   }     
               }
            }
        }
?>