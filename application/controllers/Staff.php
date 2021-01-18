<?php
        class Staff extends CI_Controller{

            public function getStaffDetails()
            {
                $this->load->model('StaffModel');
                $date["staff_details"] = $this->StaffModel->getStaffDetails();

                $this->load->model("Customer_message");
                $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                $this->load->model("notification");
                $data["insurence_date"]=$this->notification->insurence_date();
                $data["revenue_license_date"]=$this->notification->revenue_license_date();
                $data["car_booking_notification"]=$this->notification->car_booking_notification();
                $data["car_not_recive"]=$this->notification->car_not_recive();

                $this->load->view('crms_user',$date);
            }

            public function StaffDetails()
            {
                $this->form_validation->set_rules('full_name','Full Name','required');
                $this->form_validation->set_rules('nic','NIC Number','required');
                $this->form_validation->set_rules('email',' E-Mail ID','required');
                $this->form_validation->set_rules('phone_no','Phone Number','required');
                $this->form_validation->set_rules('address',' Address','required');
                if (empty($_FILES['staff_picture']['name']))
                {
                    $this->form_validation->set_rules('staff_picture', 'Staff Image', 'required');
                }

                if($this->form_validation->run() == FALSE)
                {
                    $this->load->model("Customer_message");
                    $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                    $this->load->model("notification");
                    $data["insurence_date"]=$this->notification->insurence_date();
                    $data["revenue_license_date"]=$this->notification->revenue_license_date();
                    $data["car_booking_notification"]=$this->notification->car_booking_notification();
                    $data["car_not_recive"]=$this->notification->car_not_recive();

                    $this->load->model('StaffModel');
                    $data["staff_details"] = $this->StaffModel->getStaffDetails();

                    $this->load->view('crms_user', $data);
                }
                else {
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['upload_path'] = './assets/images/users/';
                    //echo $this->input->post('email',TRUE);
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('staff_picture')) {
                        $data = $this->input->post();
                        $info = $this->upload->data();
                        $image_path = $info['raw_name'] . $info['file_ext'];

                        $this->load->model('StaffModel');
                        $response = $this->StaffModel->insertStaff($image_path);

                        if ($response) {
                            $this->load->model("Customer_message");
                            $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                            $this->load->model("notification");
                            $data["insurence_date"]=$this->notification->insurence_date();
                            $data["revenue_license_date"]=$this->notification->revenue_license_date();
                            $data["car_booking_notification"]=$this->notification->car_booking_notification();
                            $data["car_not_recive"]=$this->notification->car_not_recive();

                            $this->load->model('StaffModel');
                            $data["staff_details"] = $this->StaffModel->getStaffDetails();
                            $this->session->set_flashdata('staff_status', 'Data Recorded Successfully!');
                            $this->load->view('crms_user', $data);
                        }

                    }
                }
            }
            function prepareToDeleteUser(){

                $this->load->model('StaffModel');
                $response = $this->StaffModel->deleteUser();

                if ($response) {
                    $this->session->set_flashdata('staff_status', 'Data Deleted Successfully!');
                    redirect('Home/crms_user');
                }

            }

            public function updateStaffDetails(){
                $this->form_validation->set_rules('update_email',' E-Mail ID','required');
                $this->form_validation->set_rules('update_phone_no','Phone Number','required');

                if($this->form_validation->run() == FALSE){
                    $this->session->set_tempdata('form','update_form',5);

                    $this->load->model("Customer_message");
                    $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
                    $this->load->model("notification");
                    $data["insurence_date"]=$this->notification->insurence_date();
                    $data["revenue_license_date"]=$this->notification->revenue_license_date();
                    $data["car_booking_notification"]=$this->notification->car_booking_notification();
                    $data["car_not_recive"]=$this->notification->car_not_recive();

                    $this->load->model('StaffModel');
                    $data["staff_details"] = $this->StaffModel->getStaffDetails();

                    $this->load->view('crms_user', $data);
                }else {
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['upload_path'] = './assets/images/users/';
                    //echo $this->input->post('email',TRUE);
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('update_staff_picture')) {
                        $data = $this->input->post();
                        $info = $this->upload->data();
                        $image_path = $info['raw_name'] . $info['file_ext'];

                        $this->load->model('StaffModel');
                        $response = $this->StaffModel->updateStaff($image_path);

                        if ($response) {
                            $this->session->set_tempdata('form','add_form',5);
                            $this->load->model("Customer_message");
                            $data["message_data"] = $this->Customer_message->getCustomMessageForHeader();
                            $this->load->model("notification");
                            $data["insurence_date"] = $this->notification->insurence_date();
                            $data["revenue_license_date"] = $this->notification->revenue_license_date();
                            $data["car_booking_notification"] = $this->notification->car_booking_notification();
                            $data["car_not_recive"] = $this->notification->car_not_recive();

                            $this->load->model('StaffModel');
                            $data["staff_details"] = $this->StaffModel->getStaffDetails();
                            $this->session->set_flashdata('staff_status', 'Data Updated Successfully!');
                            $this->load->view('crms_user', $data);
                        }
                    }else{
                        $this->load->model('StaffModel');
                        $response = $this->StaffModel->updateStaff("");

                        if ($response) {
                            $this->session->set_tempdata('form','add_form',5);
                            $this->load->model("Customer_message");
                            $data["message_data"] = $this->Customer_message->getCustomMessageForHeader();
                            $this->load->model("notification");
                            $data["insurence_date"] = $this->notification->insurence_date();
                            $data["revenue_license_date"] = $this->notification->revenue_license_date();
                            $data["car_booking_notification"] = $this->notification->car_booking_notification();
                            $data["car_not_recive"] = $this->notification->car_not_recive();

                            $this->load->model('StaffModel');
                            $data["staff_details"] = $this->StaffModel->getStaffDetails();
                            $this->session->set_flashdata('staff_status', 'Data Updated Successfully!');
                            $this->load->view('crms_user', $data);
                        }
                    }
                }
            }
        }
 ?>