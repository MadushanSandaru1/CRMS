<?php


class User_Model extends CI_Model
{
    public function checkSigninDetails(){
        $email = $this->input->post('signin_email', TRUE);
        $password = sha1($this->input->post('signin_password', TRUE));

        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('is_deleted', 0);
        $userdata_check_query = $this->db->get('user');

        if ($userdata_check_query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getSpecificUserDetails(){
        $email = $this->session->userdata('user_email');

        $this->db->where('email', $email);
        $this->db->where('is_deleted', 0);
        return $this->db->get('user');
    }

    public function getRecoverCode(){
        $email = $this->session->userdata('recover_email');

        $this->db->where('email', $email);
        $this->db->where('is_deleted', 0);
        return $this->db->get('user');
    }
}