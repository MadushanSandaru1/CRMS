<?php


class CustomerMessage extends CI_Controller
{
    //crms message page


    public function view_msg()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();

        $id=$_POST["id"];
        $this->load->model("Customer_message");
        $data["fetch_data"]=$this->Customer_message->getMsg($id);

        $this->load->view('view_msg',$data);
    }

    //email
    public function reply_mail(){
        $email=$this->input->post('email');
        $msg=$this->input->post('message_content');
        $msg_id=$this->input->post('msg_id');
        $msg_sub=$this->input->post('msg_sub');

        $this->load->model("Email_Model");
        $this->load->model("Customer_message");

        if($this->Email_Model->trigger_mail($email,$msg_sub,$msg,"")){
            $this->Customer_message->updateReply($msg_id);
            $class="block";
            redirect('Home/crms_message/'.$class);
        }else{
            $class="none";
            redirect('Home/crms_message/'.$class);
        }
    }
}