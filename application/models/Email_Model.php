<?php


class Email_Model extends CI_Model
{
    function trigger_mail($to, $subject, $message, $cc = NULL)
    {
        $message.= "<br><br>Thank you.<br><br><strong style='color:#C70039;'>Abhaya Rent Car & Cab Service</strong><br><i>System Administrator</i><br><hr width='250' align='left'>";
        $message.= "Mobile: <b style='color:#C70039;'>(+94) 71 102 9301</b> Email: <b style='color:#C70039;'>abhayabeliatta@gmail.com</b><br>";
        $message.= "Abhaya Rent a Car, No 23/01, Wincent Road, Beliatta, Matara";

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