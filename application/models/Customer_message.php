<?php


class Customer_message extends CI_Model {

    public function insertMessageData()
    {
        $data = array(
            'name' => $this->input->post('message_name', TRUE),
            'email' => $this->input->post('message_email', TRUE),
            'subject' => $this->input->post('message_subject', TRUE),
            'message' => $this->input->post('message_content', TRUE)
        );

        return $this->db->insert('customer_message', $data);
    }

    function getCustomMessage(){
        $query=$this->db->query("SELECT * FROM customer_message WHERE is_replied='0' ORDER BY received_time DESC ");
//        $query=$this->db->get("customer_message");

        return $query;
    }

    function getCustomMessage_header(){
        $query1=$this->db->query("SELECT * FROM customer_message ORDER BY received_time DESC LIMIT 2");

        return $query1;
    }

    function getMsg($id){
        $query2=$this->db->query("SELECt * FROM customer_message WHERE id='$id'");
        return $query2;
    }

    function updateReply($msg_id){
        $update_reply=$this->db->query("UPDATE customer_message SET is_replied=1 WHERE id='$msg_id'");
        return $update_reply;
    }

    //delete old msg between after 30days
    function deleteOldMsg(){
        date_default_timezone_set('Asia/Colombo');
        $back_date=date("Y-m-d H:i:s",strtotime("-30 day"));
        $delete_msg=$this->db->query("DELETE FROM customer_message WHERE received_time <'$back_date'");

        return $delete_msg;
    }
}