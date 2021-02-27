<?php


class User extends CI_Controller
{
    public function user_signin() {
        $this->form_validation->set_rules('signin_email', 'Email', 'trim|required|valid_email|callback_user_exist_check');
        $this->form_validation->set_rules('signin_password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_tempdata('signin_email_fill', trim($this->input->post('signin_email', TRUE)), 10);
            $this->load->view('crms_signin');
        }
        else
        {
            $this->load->model('User_Model');
            $response = $this->User_Model->checkSigninDetails();

            if ($response) {
                $session_data = array(
                    'user_email' => trim($this->input->post('signin_email', TRUE))
                );
                $this->session->set_userdata($session_data);

                //cookies setting
                if($this->input->post('keep_signin', TRUE)) {
                    $this->input->set_cookie('keep_signin', trim($this->input->post('signin_email', TRUE)), time()+3600);
                } else {
                    delete_cookie('keep_signin');
                }

                redirect('Home/crms_dash');
            } else {
                $this->session->unset_tempdata('signin_email_fill');
                $this->session->set_flashdata('user_status', 'Email or Password are incorrect');
                redirect('Home/crms_signin');
            }
        }

    }

    public function user_signout() {
//        $this->session->unset_userdata('user_id');
//        $this->session->unset_userdata('user_name');
//        $this->session->unset_userdata('user_nic');
//        $this->session->unset_userdata('user_email');
//        $this->session->unset_userdata('user_phone');
//        $this->session->unset_userdata('user_address');
//        $this->session->unset_userdata('user_image');
//        $this->session->unset_userdata('user_role');
        $this->session->sess_destroy();

        redirect('Home/crms_signin');
    }

    public function recover_password(){
        $this->form_validation->set_rules('recover_email', 'Recover Email', 'trim|required|valid_email|callback_user_exist_check');

        if ($this->form_validation->run() == FALSE)
        {
            if($this->session->tempdata('recover_email_fill')) {
                $this->load->model('User_Model');
                $response = $this->User_Model->getRecoverCode();

                if($response) {
                    $this->session->set_tempdata('recover_email_fill', $this->session->tempdata('recover_email_fill'), 180);
                    redirect('Home/crms_reset_code');
                } else {
                    $this->session->set_flashdata('recover_status', 'Cannot get recovery code');
                    redirect('Home/crms_forgot_pwd');
                }
            } else {
                $this->load->view('crms_forgot_pwd');
            }
        }
        else
        {
            $this->session->set_tempdata('recover_email_fill', $this->input->post('recover_email', TRUE), 180);

            $this->load->model('User_Model');
            $response = $this->User_Model->getRecoverCode();

            if($response) {
                redirect('Home/crms_reset_code');
            } else {
                $this->session->set_flashdata('recover_status', 'Cannot get recovery code');
                redirect('Home/crms_forgot_pwd');
            }
        }
    }

    public function verify_recover_code() {
        $this->form_validation->set_rules('recover_code', 'Recover Code', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('crms_reset_code');
        }
        else
        {
            $this->load->model('User_Model');
            $response = $this->User_Model->verifyRecoverCode();

            if($response) {
                redirect('Home/crms_change_pwd');
            } else {
                $this->session->set_flashdata('recover_code_status', 'Recovery code does not match');
                redirect('Home/crms_reset_code');
            }
        }

    }

    public function change_user_pwd() {
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('crms_change_pwd');
        }
        else
        {
            $this->load->model('User_Model');
            $response = $this->User_Model->changeUserPwd();

            if($response) {
                $session_data = array(
                    'user_email' => $this->session->tempdata('recover_email_fill')
                );
                $this->session->set_userdata($session_data);

                redirect('Home/crms_dash');
            } else {
                $this->session->set_flashdata('change_pwd_status', 'Failed to change password');
                redirect('Home/crms_change_pwd');
            }
        }

    }

    public function change_profile_pwd() {
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->model("Customer_message");
            $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
            $this->load->model("notification");
            $data["insurence_date"]=$this->notification->insurence_date();
            $data["revenue_license_date"]=$this->notification->revenue_license_date();
            $data["car_booking_notification"]=$this->notification->car_booking_notification();
            $data["car_not_recive"]=$this->notification->car_not_recive();

            $this->load->view('crms_profile', $data);
        }
        else
        {
            $this->load->model('User_Model');
            $response = $this->User_Model->changeProfilePwd();

            if($response) {
                $this->session->set_flashdata('profile_status', 'Password change successfully');
                redirect('Home/crms_profile#passwordchangeform');
            } else {
                $this->session->set_flashdata('profile_status', 'Failed to change password');
                redirect('Home/crms_profile#passwordchangeform');
            }
        }

    }

    public function user_exist_check($email)
    {
        $this->db->where('email', $email);
        $this->db->where('is_deleted', 0);
        $response =  $this->db->get('user');

        if (($response->num_rows() <= 0) AND $email != "")
        {
            $this->form_validation->set_message('user_exist_check', 'User does not exist');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}