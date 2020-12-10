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
		$this->load->model("Vehicle_Model");
        $data['available_vehicle'] = $this->Vehicle_Model->getVehicleData();

        $this->load->view('home',$data);

	}

    //crms about page
    public function about()
    {
        $this->load->view('about');
    }

    //crms car page
    public function car()
    {
        $this->load->model("Vehicle_Model");
        $data['vehicle_data'] = $this->Vehicle_Model->getVehicleData();

        $this->load->view('car', $data);
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
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();

        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model("User_Model");
        $data['user_data'] = $this->User_Model->getSpecificUserDetails();

        $this->load->view('crms_dashboard',$data);
    }

    //crms staff user page
    public function crms_user()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();


        $this->load->model('StaffModel');
        $data["staff_details"] = $this->StaffModel->getStaffDetails();

        $this->load->view('crms_user', $data);
        
    }

    //crms car page
    public function crms_car()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model("Vehicle_Model");
        $data['vehicle_data'] = $this->Vehicle_Model->getVehicleData();

        $this->load->view('crms_car', $data);
    }

    //crms customer page
    public function crms_customer()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model("Customer_Model");
        $data['customer_data']=$this->Customer_Model->getCustomers();

        $this->load->view('crms_customer',$data);
    }

    //crms guarantor page
    public function crms_guarantor()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model("Guarantor_Model");
        $data['guarantor_data'] = $this->Guarantor_Model->getGuarantorData();
        $data['reserved_data'] = $this->Guarantor_Model->getReservedData();

        $this->load->view('crms_guarantor', $data);
    }

    //crms car reserved page
    public function crms_reserved()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model("Reserved_Model");
        $data['vehicle_data'] = $this->Reserved_Model->getVehicleData();
        $data['customer_data'] = $this->Reserved_Model->getCustomerData();
        $data['reserved_data'] = $this->Reserved_Model->getVehicleReservedData();

        $this->load->view('crms_reserved', $data);
    }

    //crms car returned page
    public function crms_returned()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model("Returned_Model");
        $data['reserved_data'] = $this->Returned_Model->getReservedData();
        $data['returned_data'] = $this->Returned_Model->getVehicleReturnedData();

        $this->load->view('crms_returned', $data);
    }

    //crms car booking page
    public function crms_booking()
    {
        $this->load->model("Vehicle_Model");
        $data['available_vehicle'] = $this->Vehicle_Model->getVehicleData();

        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model("Booking_Model");
        $data['booking_data']=$this->Booking_Model->getBooking();

        $this->load->view('crms_booking', $data);
    }

    //crms car tracking page
    public function crms_tracking()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model('Tracker_Model');
        $data['vehicle_data']=$this->Tracker_Model->getVehicles();

        $this->load->view('crms_tracking',$data);
    }

    //crms car damage page
    public function crms_damage()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model('DamageModel');
        $data["getDamageDetails"] = $this->DamageModel->getDamageDetails();
        $data["getVehicleID"] = $this->DamageModel->getVehicleID();
        $data["getReservedID"] = $this->DamageModel->getReservedID();
        $data["getCustomerDetails"] = $this->DamageModel->getCustomerDetails();

        $this->load->view('crms_damage', $data);
    }

    //crms car expenses page
    public function crms_expenses()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model("Expense_Model");
        $data['vehicle_data'] = $this->Expense_Model->getVehicleData();
        $data['vehicle_expense_data'] = $this->Expense_Model->getVehicleExpenseData();

        $this->load->view('crms_expenses', $data);
    }

    //crms car outsourcing page
    public function crms_outsourcing()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model('OutsourceVehicleModel');
        $data["outsourceVehicle"] = $this->OutsourceVehicleModel->getOutsourceDetails();
        $data["supplier"] = $this->OutsourceVehicleModel->getSupplier();

        $this->load->view('crms_outsourcing',$data);
    }

    //crms car outsourcing supplier page
    public function crms_outsourcing_supplier()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model('OutSourceSuplierModel');
        $data["supplier_details"] = $this->OutSourceSuplierModel->getSupplierDetails();

        $this->load->view('crms_outsourcing_supplier', $data);
    }

    //crms damage report page
    public function crms_damage_report()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model('Damage_Report_Model');
        $data["getDamageDetails"] = $this->Damage_Report_Model->getDamageDetails();
        $data["getVehicleID"] = $this->Damage_Report_Model->getVehicleID();

        $this->load->view('crms_damage_report', $data);
    }

    //crms income/expense report page
    public function crms_inc_exp_report()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->view('crms_inc_exp_report', $data);
    }

    //crms profile page
    public function crms_profile()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->view('crms_profile', $data);
    }

    //crms notification page
    public function crms_notification()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();

        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->view('crms_notification',$data);
    }

    public function crms_message()
    {
        $this->load->model("Customer_message");
        $data["message_data"]=$this->Customer_message->getCustomMessageForHeader();
        $this->load->model("notification");
        $data["insurence_date"]=$this->notification->insurence_date();
        $data["revenue_license_date"]=$this->notification->revenue_license_date();
        $data["car_booking_notification"]=$this->notification->car_booking_notification();
        $data["car_not_recive"]=$this->notification->car_not_recive();

        $this->load->model("Customer_message");
        $this->Customer_message->deleteOldMsg(); // delete old msg
        $data["fetch_data"]=$this->Customer_message->getCustomMessage();

        $this->load->view('crms_message',$data);
    }

    public function update_revenueL_date(){
        $vehi_id=$this->input->post('vehicle_id');
        $date=$this->input->post('revenueL_date');
        $this->load->model("notification");
        $this->notification->update_revenue_date($vehi_id,$date);
        redirect('Home/crms_notification');
    }

    public function update_Insurance_date(){
        $date=date("Y-m-d");
        $this->form_validation->set_rules('insurance_date','Insurance date','required');

        if($this->form_validation->run()==true){
            $this->load->model("notification");
            $this->notification->update_insurence_date();
            redirect('Home/crms_notification');
        } else{
            redirect('Home/crms_notification');
        }
//        $vehi_id=$this->input->post('vehicle_id');
//        $date=$this->input->post('insurance_date');
//        $this->load->model("notification");
//        $this->notification->update_insurence_date($vehi_id,$date);
//        redirect('Home/crms_notification');
    }

    public function loadmap(){
        $this->load->view('map');
    }

}
