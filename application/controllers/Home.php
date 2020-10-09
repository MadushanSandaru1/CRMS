<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->load->view('home');
	}

	public function about()
	{
		$this->load->view('about');
	}

	public function car()
	{
		$this->load->view('car');
	}

	public function contact()
	{
		$this->load->view('contact');
	}
    
    public function ACRMS()
	{
		$this->load->view('login');
	}

    public function crms_dashboard()
    {
<<<<<<< Updated upstream
        $this->load->view('admin');
	}
	

    public function view_damage_car()
    {
        $this->load->view('admin_damage');
=======
        $this->load->view('crms_dashboard');
    }

    public function crms_damage()
    {
        $this->load->view('crms_damage');
>>>>>>> Stashed changes
    }
}
