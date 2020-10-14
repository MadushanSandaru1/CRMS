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
        $query=$this->db->query("SELECT * FROM customer_message ORDER BY received_time DESC ");
//        $query=$this->db->get("customer_message");

        return $query;
    }

    function getCustomMessage_header(){
        $query1=$this->db->query("SELECT * FROM customer_message ORDER BY received_time DESC LIMIT 2");

        return $query1;
    }
}