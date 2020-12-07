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
                $config['allowed_types'] = 'jpg|png|jpeg'; 
                $config['upload_path'] = './assets/images/users/';
                //echo $this->input->post('email',TRUE);
                $this->load->library('upload',$config);
                if($this->upload->do_upload('staff_picture'))
                {
                    $data = $this->input->post();
                    $info = $this->upload->data();
                    $image_path= $info['raw_name'].$info['file_ext'];
                    $this->load->model('StaffModel');
                    $response = $this->StaffModel->insertStaff($image_path);

                    if($response)
                    {
                        $this->load->model('StaffModel');
                        $getStaffDetails = $this->StaffModel->getStaffDetails();
                        $this->session->set_flashdata('staff_status', 'Data Recorded Successfully!');
                        $this->load->view('crms_user',['staff_details'=>$getStaffDetails]);
                    }
                   
                }
                    
            }
        }
 ?>