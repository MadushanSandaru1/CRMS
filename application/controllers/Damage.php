<?php
        class Damage extends CI_Controller{

            public function DamageVehicle()
            {
               $this->form_validation->set_rules('vehicle_id','Vehicle ID','required');
               $this->form_validation->set_rules('description','Nature of Damage','required');
               $this->form_validation->set_rules('image_file','Damage Image File','required');
               $this->form_validation->set_rules('reserved_id','Reserved ID','required');
               $this->form_validation->set_rules('fix_amount','Fix Amount','required');
               $this->form_validation->set_rules('is_solved','Is Solved','required');

               if($this->form_validation->run() == FALSE)
               {
                    $this->load->model('DamageModel');
                    $getVehicleID = $this->DamageModel->getVehicleID();
                    $getReservedID = $this->DamageModel->getReservedID();
                    $this->load->view('crms_damage',['getVehicleID'=>$getVehicleID,'getReservedID'=>$getReservedID]);
               }
               else{
                   //echo "ok";
                   $config['allowed_types'] = 'jpg|png|jpeg'; 
                   $config['upload_path'] = './uploads/damages/';
                   $this->load->library('upload',$config);

                   if($this->upload->do_upload('image_file'))
                   {
                        print_r($this->upload->data());
                   }
                   else
                        print_r($this->upload->display_errors());
               }
            }
        }
?>