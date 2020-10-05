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

    public function admin()
    {
        $this->load->view('admin');
    }
}
