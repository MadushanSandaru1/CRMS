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
}