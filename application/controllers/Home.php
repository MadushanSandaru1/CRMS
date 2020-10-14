<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    //crms home page
	public function index()
	{
		$this->load->view('home');
	}

    //crms about page
    public function about()
    {
        $this->load->view('about');
    }

    //crms car page
    public function car()
    {
        $this->load->view('car');
    }

    //crms contact page
    public function contact()
    {
        $this->load->view('contact');
    }

    //crms error 404 page
    public function error_404()
    {
        $this->load->view('error_404');
    }

    //crms error 500 page
    public function error_500()
    {
        $this->load->view('error_500');
    }

    //crms sign in page
    public function crms_signin()
    {
        $this->load->view('crms_signin');
    }

    //crms forgot password page
    public function crms_forgot_pwd()
    {
        $this->load->view('crms_forgot_pwd');
    }

    //crms reset code page
    public function crms_reset_code()
    {
        $this->load->view('crms_reset_code');
    }

    //crms change password page
    public function crms_change_pwd()
    {
        $this->load->view('crms_change_pwd');
    }

    //crms dashboard page
    public function crms_dash()
    {
        $this->load->view('crms_dashboard');
//        $this->load->model("Customer_message");
//        $data["fetch_data"]=$this->Customer_message->getCustomMessage_header();
//        $this->load->view('crms_dashboard',$data);
    }

    //crms staff user page
    public function crms_user()
    {
        $this->load->view('crms_user');
    }

    //crms car page
    public function crms_car()
    {
        $this->load->view('crms_car');
    }

    //crms customer page
    public function crms_customer()
    {
        $this->load->view('crms_customer');
    }

    //crms car reserved page
    public function crms_reserved()
    {
        $this->load->view('crms_reserved');
    }

    //crms car booking page
    public function crms_booking()
    {
        $this->load->view('crms_booking');
    }

    //crms car tracking page
    public function crms_tracking()
    {
        $this->load->view('crms_tracking');
    }

    //crms car damage page
    public function crms_damage()
    {
        $this->load->model('DamageModel');
        $getDamageDetails = $this->DamageModel->getDamageDetails();
        $getVehicleID = $this->DamageModel->getVehicleID();
        $getReservedID = $this->DamageModel->getReservedID();
        $getCustomerDetails = $this->DamageModel-> getCustomerDetails();
        $this->load->view(
            'crms_damage',
            [
                'getVehicleID'=>$getVehicleID,
                'getReservedID'=>$getReservedID,
                'getDamageDetails'=> $getDamageDetails,
                'getCustomerDetails' =>$getCustomerDetails
            ]
        );
    }

    //crms car expenses page
    public function crms_expenses()
    {
        $this->load->view('crms_expenses');
    }

    //crms car outsourcing page
    public function crms_outsourcing()
    {
        $this->load->view('crms_outsourcing');
    }

    //crms damage report page
    public function crms_damage_report()
    {
        $this->load->model('Damage_Report_Model');
        $getDamageDetails = $this->Damage_Report_Model->getDamageDetails();
        $getVehicleID = $this->Damage_Report_Model->getVehicleID();
        $this->load->view('crms_damage_report',['getVehicleID'=>$getVehicleID,'getDamageDetails'=>$getDamageDetails]);
    }

    //crms income/expense report page
    public function crms_inc_exp_report()
    {
        $this->load->view('crms_inc_exp_report');
    }

    //crms profile page
    public function crms_profile()
    {
        $this->load->view('crms_profile');
    }

    //crms notification page
    public function crms_notification()
    {
        $this->load->view('crms_notification');
    }

    //crms message page
    public function crms_message()
    {
        $this->load->model("Customer_message");
        $data["fetch_data"]=$this->Customer_message->getCustomMessage();
//        $this->load->view('crms_message');
        $this->load->view('crms_message',$data);
    }
}
