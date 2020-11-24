<?php


class Email_Model extends CI_Model
{
    function trigger_mail($to, $subject, $message, $cc = NULL)
    {

        $CI =& get_instance();
        $CI->email->set_newline("\r\n");
        $CI->email->from('abhayabeliatta@gmail.com', 'Abhaya Rent Car & Cab Service'); // change it to yours
        $CI->email->to($to);// change it to yours
        $CI->email->subject($subject);
        $CI->email->message($message);

        if($CI->email->send())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}