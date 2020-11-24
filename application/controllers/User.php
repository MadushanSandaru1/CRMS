<?php


class User extends CI_Controller
{
    public function user_signin() {
        $this->form_validation->set_rules('signin_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('signin_password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_tempdata('signin_email_fill', $this->input->post('signin_email', TRUE), 10);
            $this->load->view('crms_signin');
        }
        else
        {
            $this->load->model('User_Model');
            $response = $this->User_Model->checkSigninDetails();

            if ($response) {
                $session_data = array(
                    'user_email' => $this->input->post('signin_email', TRUE)
                );
                $this->session->set_userdata($session_data);

                //cookies setting
                if($this->input->post('keep_signin', TRUE)) {
                    $this->input->set_cookie('keep_signin', $this->input->post('signin_email', TRUE), time()+3600);
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
        $this->form_validation->set_rules('recover_email', 'Recover Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('crms_forgot_pwd');
        }
        else
        {
            $this->load->model('User_Model');
            $response = $this->User_Model->getRecoverCode();

            if($response) {
                $this->session->set_tempdata('recover_email_fill', $this->input->post('recover_email', TRUE), 10);
                redirect('Home/crms_reset_code');
            } else {
                $this->session->set_flashdata('recover_status', 'Cannot get recovery code');
                redirect('Home/crms_forgot_pwd');
            }
        }
    }
}