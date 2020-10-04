<?php

	class Contact extends CI_Controller
    {

        public function customer_message() {
            $this->form_validation->set_rules('message_name', 'Name', 'required|max_length[100]');
            $this->form_validation->set_rules('message_email', 'Email', 'required|valid_email|max_length[100]');
            $this->form_validation->set_rules('message_subject', 'Subject', 'required|max_length[100]');
            $this->form_validation->set_rules('message_content', 'Message', 'required|max_length[500]');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('contact');
            } else {
                $this->load->model('Customer_message');
                $response = $this->Customer_message->insertMessageData();

                if ($response) {
                    $this->session->set_flashdata('msg', 'Message sent successfully');
                    redirect('Home/contact');
                }
            }
        }

    }