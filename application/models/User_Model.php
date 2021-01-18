<?php date_default_timezone_set("Asia/Colombo"); ?>

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

        $random_recover_code = rand(100000,999999);
        $this->session->set_tempdata('random_recover_code', $random_recover_code, 180);

        $email = $this->session->tempdata('recover_email_fill');
        $heading = "Password recovery code";
        $message = "<b>".$random_recover_code."</b> is your Abhaya account recovery code.";

        $this->load->model("Email_Model");
        $response = $this->Email_Model->trigger_mail($email, $heading, $message);

        return $response;
    }

    public function verifyRecoverCode(){

        $input_recover_code = $this->input->post('recover_code', TRUE);

        if($input_recover_code == $this->session->tempdata('random_recover_code')) {
            return true;
        } else {
            return false;
        }

    }

    //change password from password recovery option
    public function changeUserPwd(){

        $new_password = $this->input->post('new_password', TRUE);

        $this->db->set('password', sha1($new_password));
        $this->db->where('email', $this->session->tempdata('recover_email_fill'));
        $this->db->where('is_deleted', 0);
        $response = $this->db->update('user');

        if ($response) {
            $email = $this->session->tempdata('recover_email_fill');
            $heading = "New Password";
            $message = "Your password on the Abhaya account was changed on <b>".date("Y-m-d h:i:sa")."</b>";

            $this->load->model("Email_Model");
            $this->Email_Model->trigger_mail($email, $heading, $message);
        }

        return $response;

    }

    //change password from profile section
    public function changeProfilePwd(){

        $email = $this->session->userdata('user_email');
        $current_password = sha1($this->input->post('current_password', TRUE));

        $this->db->where('email', $email);
        $this->db->where('password', $current_password);
        $this->db->where('is_deleted', 0);
        $userdata_check_query = $this->db->get('user');

        if ($userdata_check_query->num_rows() > 0) {
            $new_password = $this->input->post('new_password', TRUE);

            $this->db->set('password', sha1($new_password));
            $this->db->where('email', $email);
            $this->db->where('is_deleted', 0);
            $response = $this->db->update('user');

            if ($response) {
                $email = $this->session->userdata('user_email');
                $heading = "New Password";
                $message = "Your password on the Abhaya account was changed on <b>".date("Y-m-d h:i:sa")."</b>";

                $this->load->model("Email_Model");
                $this->Email_Model->trigger_mail($email, $heading, $message);
            }

            return $response;
        } else {
            $this->session->set_tempdata('current_password_fill', "The current password does not match.", 2);
            return false;
        }

    }

}