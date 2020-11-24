<?php


class Email_Model extends CI_Model
{
    public function sendEmail($email, $heading, $message){
        //Load email library
        $this->load->library('email');

//SMTP & mail configuration
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'chefguruhotel@gmail.com',
            'smtp_pass' => 'Admin@chefguru',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

//Email content
        $htmlContent = '<h1>Sending email via Gmail SMTP server</h1>';
        $htmlContent .= '<p>This email has sent via Gmail SMTP server from CodeIgniter application.</p>';

        $this->email->to('tg2017233@gmail.com');
        $this->email->from('chefguruhotel@gmail.com','MyWebsite');
        $this->email->subject('How to send email via Gmail SMTP server in CodeIgniter');
        $this->email->message($htmlContent);

//Send email
        $this->email->send();

//        if(!$this->email->send()) {
//            return false;
//        } else {
//            return true;
//        }
    }
}