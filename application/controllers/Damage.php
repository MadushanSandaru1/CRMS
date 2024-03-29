<?php
        class Damage extends CI_Controller{

            public function DamageVehicle()
            {
                $this->form_validation->set_rules('vehicle_id','Vehicle ID','required');
                $this->form_validation->set_rules('description','Nature of Damage','required');
                //$this->form_validation->set_rules('image_file','Damage Image File','required');
                $this->form_validation->set_rules('chooser','Reserved ID','required');
                //$this->form_validation->set_rules('fix_amount','Fix Amount','required');
                //$this->form_validation->set_rules('is_solved','Is Solved','required');
                $this->form_validation->set_rules('d_date','Damage Date','required');

                if($this->form_validation->run() == FALSE)
                 {
                    $this->session->set_tempdata('fix_amount_fill', $this->input->post('fix_amount', TRUE), 5);
                    $this->session->set_tempdata('solved_amount_fill', $this->input->post('solved_amount', TRUE), 5);
                    $this->session->set_tempdata('vehicle_id_fill',$this->input->post('vehicle_id', TRUE),5);
                    $this->session->set_tempdata('description_fill',$this->input->post('description', TRUE),5);
                    //$this->session->set_tempdata('image_file_fill',$this->input->post('image_file', TRUE),5);
                    $this->session->set_tempdata('c_vehicle_id_fill',$this->input->post('c_vehicle_id', TRUE),5);

                    $this->load->model("Customer_message");
                    $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                    $this->load->model("notification");
                    $data["insurence_date"]=$this->notification->insurence_date();
                    $data["revenue_license_date"]=$this->notification->revenue_license_date();
                    $data["car_booking_notification"]=$this->notification->car_booking_notification();
                    $data["car_not_recive"]=$this->notification->car_not_recive();

                    $this->load->model('DamageModel');
                    $data["getDamageDetails"] = $this->DamageModel->getDamageDetails();
                    $data["getVehicleID"] = $this->DamageModel->getVehicleID();
                    $data["getReservedID"] = $this->DamageModel->getReservedID();
                    $data["getCustomerDetails"] = $this->DamageModel->getCustomerDetails();
                     $this->session->set_tempdata('form','add_form',5);
                    $this->load->view('crms_damage', $data);
                }
                else{
                   //echo "ok";
                   $config['allowed_types'] = 'jpg|png|jpeg'; 
                   $config['upload_path'] = './assets/images/damage/';
                   $this->load->library('upload',$config);

                   if($this->upload->do_upload('image_file'))
                   {
                        //print_r($this->upload->data());
                        $data = $this->input->post();
                        $info = $this->upload->data();
                        $image_path= "assets/images/damage/".$info['raw_name'].$info['file_ext'];
                        $this->load->model('DamageModel');
                        $response = $this->DamageModel->insertDamage($image_path);

                        if($response)
                        {
                            $this->load->model("Customer_message");
                            $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                            $this->load->model("notification");
                            $data["insurence_date"]=$this->notification->insurence_date();
                            $data["revenue_license_date"]=$this->notification->revenue_license_date();
                            $data["car_booking_notification"]=$this->notification->car_booking_notification();
                            $data["car_not_recive"]=$this->notification->car_not_recive();

                            $this->load->model('DamageModel');
                            $data["getDamageDetails"] = $this->DamageModel->getDamageDetails();
                            $data["getVehicleID"] = $this->DamageModel->getVehicleID();
                            $data["getReservedID"] = $this->DamageModel->getReservedID();
                            $data["getCustomerDetails"] = $this->DamageModel->getCustomerDetails();
                            $this->session->set_tempdata('form','add_form',5);
                            $this->session->set_flashdata('damage_status', 'Data Recorded Successfully!');
                            $this->load->view('crms_damage', $data);
                        }
                        
                   }
                //    else
                //    {
                //         $this->load->model('DamageModel');
                //         $getVehicleID = $this->DamageModel->getVehicleID();
                //         $getReservedID = $this->DamageModel->getReservedID();
                //         $this->session->set_flashdata('msgValidation', 'You have to upload Picture');
                //         $this->load->view('crms_damage',['getVehicleID'=>$getVehicleID,'getReservedID'=>$getReservedID]);
                //    }     
            }
        }
        public function SearchDamageVehicle()
        {
            $this->load->model('DamageModel');
            $getVehicleID = $this->DamageModel->getVehicleID();
            $getReservedID = $this->DamageModel->getReservedID();
            $getDamageDetails = $this->DamageModel->getDamageDetails();
            $getCustomerDetails = $this->DamageModel->getCustomerDetails();
            $damageSearchDetails = $this->DamageModel->filterDamagesDetails();
            $this->load->view(
                'crms_damage',
                [
                        'getVehicleID'=>$getVehicleID,
                        'getReservedID'=>$getReservedID,
                        'getDamageDetails'=>$getDamageDetails,
                        'getCustomerDetails'=>$getCustomerDetails,
                        'getSearchDamages'=>$damageSearchDetails
                ]
            );
        }

        public function DamageReport()
        {
            $id = $this->uri->segment(3);
            $this->load->model('DamageModel');
            $data['damageDetails'] = $this->DamageModel->getDamageDetail($id);
            $data["getVehicleID"] = $this->DamageModel->getVehicleID();
            $data["getCustomerDetails"] = $this->DamageModel->getCustomerDetails();
            $this->load->view('crms_damage_single_item.php',$data);
            $html = $this->output->get_output();
            $this->pdf->loadHtml($html);
            $this->pdf->render();
            $this->pdf->stream("$id"."Damage.pdf",array("Attachment" => 0));
        }

        function prepareToDeleteDamage(){

            $this->load->model('DamageModel');
            $response = $this->DamageModel->deleteDamage();

            if ($response) {
                $this->session->set_flashdata('damage_status', 'Data Deleted Successfully!');
                $this->session->set_tempdata('form','add_form',5);
                redirect('Home/crms_damage');
            }

        }

        public function updateDamageVehicle()
        {

            $this->form_validation->set_rules('u_vehicle_id','Vehicle ID','required');
            $this->form_validation->set_rules('u_description','Nature of Damage','required');
            //$this->form_validation->set_rules('u_image_file','Damage Image File','required');
            $this->form_validation->set_rules('uc_vehicle_id','Reserved ID','required');
            $this->form_validation->set_rules('u_reported_date','Damage Date','required');

            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_tempdata('u_vehicle_id_fill', $this->input->post('u_vehicle_id', TRUE), 5);
                $this->session->set_tempdata('u_description_fill', $this->input->post('u_description', TRUE), 5);
                $this->session->set_tempdata('uc_vehicle_id_fill',$this->input->post('uc_vehicle_id', TRUE),5);

                $this->load->model("Customer_message");
                $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                $this->load->model("notification");
                $data["insurence_date"]=$this->notification->insurence_date();
                $data["revenue_license_date"]=$this->notification->revenue_license_date();
                $data["car_booking_notification"]=$this->notification->car_booking_notification();
                $data["car_not_recive"]=$this->notification->car_not_recive();

                $this->load->model('DamageModel');
                $data["getDamageDetails"] = $this->DamageModel->getDamageDetails();
                $data["getVehicleID"] = $this->DamageModel->getVehicleID();
                $data["getReservedID"] = $this->DamageModel->getReservedID();
                $data["getCustomerDetails"] = $this->DamageModel->getCustomerDetails();
                $this->session->set_tempdata('form','update_form',5);
                $this->load->view('crms_damage', $data);
            }
            else{
                //echo "ok";
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['upload_path'] = './assets/images/damage/';
                $this->load->library('upload',$config);

                if($this->upload->do_upload('u_image_file'))
                {
                    //print_r($this->upload->data());
                    $data = $this->input->post();
                    $info = $this->upload->data();
                    $image_path= "assets/images/damage/".$info['raw_name'].$info['file_ext'];
                    $this->load->model('DamageModel');
                    $response = $this->DamageModel->updateDamage($image_path);

                    if($response)
                    {
                        $this->load->model("Customer_message");
                        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                        $this->load->model("notification");
                        $data["insurence_date"]=$this->notification->insurence_date();
                        $data["revenue_license_date"]=$this->notification->revenue_license_date();
                        $data["car_booking_notification"]=$this->notification->car_booking_notification();
                        $data["car_not_recive"]=$this->notification->car_not_recive();

                        $this->load->model('DamageModel');
                        $data["getDamageDetails"] = $this->DamageModel->getDamageDetails();
                        $data["getVehicleID"] = $this->DamageModel->getVehicleID();
                        $data["getReservedID"] = $this->DamageModel->getReservedID();
                        $data["getCustomerDetails"] = $this->DamageModel->getCustomerDetails();

                        $this->session->set_tempdata('form','add_form',5);
                        $this->session->set_flashdata('damage_status', 'Data Updated Successfully!');
                        $this->load->view('crms_damage', $data);
                    }

                }
                else
                {
                    $image_path= "";
                    $this->load->model('DamageModel');
                    $response = $this->DamageModel->updateDamage($image_path);

                    if($response)
                    {
                        $this->load->model("Customer_message");
                        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                        $this->load->model("notification");
                        $data["insurence_date"]=$this->notification->insurence_date();
                        $data["revenue_license_date"]=$this->notification->revenue_license_date();
                        $data["car_booking_notification"]=$this->notification->car_booking_notification();
                        $data["car_not_recive"]=$this->notification->car_not_recive();

                        $this->load->model('DamageModel');
                        $data["getDamageDetails"] = $this->DamageModel->getDamageDetails();
                        $data["getVehicleID"] = $this->DamageModel->getVehicleID();
                        $data["getReservedID"] = $this->DamageModel->getReservedID();
                        $data["getCustomerDetails"] = $this->DamageModel->getCustomerDetails();

                        $this->session->set_tempdata('form','add_form',5);
                        $this->session->set_flashdata('damage_status', 'Data Updated Successfully!');
                        $this->load->view('crms_damage', $data);
                    }
                }
            }
        }

        public function prepareToSolvedDamage()
        {
            $this->load->model('DamageModel');
            $response = $this->DamageModel->damageSolved();
            if ($response)
            {
                $this->load->model("Customer_message");
                $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                $this->load->model("notification");
                $data["insurence_date"]=$this->notification->insurence_date();
                $data["revenue_license_date"]=$this->notification->revenue_license_date();
                $data["car_booking_notification"]=$this->notification->car_booking_notification();
                $data["car_not_recive"]=$this->notification->car_not_recive();

                $this->load->model('DamageModel');
                $data["getDamageDetails"] = $this->DamageModel->getDamageDetails();
                $data["getVehicleID"] = $this->DamageModel->getVehicleID();
                $data["getReservedID"] = $this->DamageModel->getReservedID();
                $data["getCustomerDetails"] = $this->DamageModel->getCustomerDetails();

                $this->session->set_tempdata('form','add_form',5);
                $this->session->set_flashdata('damage_status', 'Data Solved Successfully!');
                $this->load->view('crms_damage', $data);
            }
            else
            {
                $this->load->model("Customer_message");
                $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                $this->load->model("notification");
                $data["insurence_date"]=$this->notification->insurence_date();
                $data["revenue_license_date"]=$this->notification->revenue_license_date();
                $data["car_booking_notification"]=$this->notification->car_booking_notification();
                $data["car_not_recive"]=$this->notification->car_not_recive();

                $this->load->model('DamageModel');
                $data["getDamageDetails"] = $this->DamageModel->getDamageDetails();
                $data["getVehicleID"] = $this->DamageModel->getVehicleID();
                $data["getReservedID"] = $this->DamageModel->getReservedID();
                $data["getCustomerDetails"] = $this->DamageModel->getCustomerDetails();

                $this->session->set_tempdata('form','add_form',5);
                $this->session->set_flashdata('damage_status', 'Data Solved not Successfully!');
                $this->load->view('crms_damage', $data);
            }
        }
    }
?>