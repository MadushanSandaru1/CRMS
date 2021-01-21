<?php

class VehicleOutsource extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
    }

    public function  outsourcingVehicle()
    {
        $this->form_validation->set_rules('supplier_id','Supplier ID','required');
        $this->form_validation->set_rules('vehicle_title','Vehicle Title','required');
        //$this->form_validation->set_rules('outsource_pic','OutSource Vehicle Image File','required');
        $this->form_validation->set_rules('registered_no','Registered Number','required');
        $this->form_validation->set_rules('no_of_seat','No of seats','required');
        $this->form_validation->set_rules('fuel_type','Fuel Type','required');
        $this->form_validation->set_rules('price_per_day','Price Per Day','required');
        $this->form_validation->set_rules('per_km','Price Per KM','required');
        $this->form_validation->set_rules('per_hour','Price Per Hour','required');
        $this->form_validation->set_rules('insurence_date','Insurence Date','required');
        $this->form_validation->set_rules('revenue_license_date','Revenue Licence Date','required');

        if (empty($_FILES['outsource_pic']['name']))
        {
            $this->form_validation->set_rules('outsource_pic', 'OutSource Vehicle Image File', 'required');
        }

        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_tempdata('title_fill',$this->input->post('vehicle_title',TRUE),5);
            $this->session->set_tempdata('registered_no_fill',$this->input->post('registered_no',TRUE),5);
            $this->session->set_tempdata('no_of_seat_fill',$this->input->post('no_of_seat',TRUE),5);
            $this->session->set_tempdata('fuel_type_fill',$this->input->post('fuel_type',TRUE),5);
            $this->session->set_tempdata('price_per_day_fill',$this->input->post('price_per_day',TRUE),5);
            $this->session->set_tempdata('per_km_fill',$this->input->post('per_km',TRUE),5);
            $this->session->set_tempdata('per_hour_fill',$this->input->post('per_hour',TRUE),5);
            $this->session->set_tempdata('insurence_date_fill',$this->input->post('insurence_date',TRUE),5);
            $this->session->set_tempdata('revenue_license_date_date_fill',$this->input->post('revenue_license_date',TRUE),5);

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
        else{
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['upload_path'] = './assets/images/outsourceVehicles/';
            $this->load->library('upload',$config);

            if($this->upload->do_upload('outsource_pic'))
            {
                $data = $this->input->post();
                $info = $this->upload->data();
                $image_path= "assets/images/outsourceVehicles/".$info['raw_name'].$info['file_ext'];
                $this->load->model('OutsourceVehicleModel');
                $outSourceDetails = $this->OutsourceVehicleModel->getOutsourceDetails();
                $supplier = $this->OutsourceVehicleModel->getSupplier();
                $response = $this->OutsourceVehicleModel->insertOutsourceVehicle($image_path);

                if ($response)
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

                    $this->session->set_flashdata('outsource_status',"Data Recorded Successfully");
                    $this->load->view('crms_outsourcing',$data);

                }

            }
            else
            {
                echo "no";
            }
        }
    }

    public function outsourcingReport()
    {
        $id = $this->uri->segment(3);
        $supplier_name="";
        $outSID=0;
        $this->load->model("OutsourceVehicleModel");
        $outSourceDetails = $this->OutsourceVehicleModel->getOutsourceDetails();
        $supplier = $this->OutsourceVehicleModel->getSupplier();

        foreach($outSourceDetails as $values)
        {
            if($values->id == $id)
            {
                $outSID = $values->supplier_id;
            }
        }

        for($i=0;$i<sizeof($supplier);$i++)
        {
            if($supplier[$i]->id == $outSID)
            {
                $supplier_name = $supplier[$i]->name;
            }
        }

        $table = "";
        $table.="<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css' integrity='sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2' crossorigin='anonymous'>";
        $table.="<style>";
        $table.="footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #C70039;
            color: #ffffff;
        }";
        $table.="@page {
        margin: 0cm 0cm;
        }";
        $table.="body {
            font-family: 'Times New Roman', serif;
            margin-top: 5.5cm;
            margin-bottom: 2cm;
            margin-left: 1cm;
            margin-right: 1cm;
        }";
        $table.="table {
            margin: 0 auto;
            width: 80%;
        }";
        $table.="header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
        }";
        $table.="</style>";

        $table.="<br><br><center><h3>Vehicle Outsource Details</h3></center><br>";
        $table.="<header>
            <img src='assets/images/report_header.png' width='100%' height='20%'/>
            <small><pre class='text-right mr-4'>printed date: ".Date('Y-m-d h:i:s a',time())."</pre></small>
        </header>";
        $table.="<footer class='text-center'>".
            "<p class='mt-4'>"."<small>Copyright &copy;".date("Y")."All rights reserved | Team Semicolon</small></p>".
            "</footer>";
        $table.="<table class='table'>";

        for($i=0;$i<sizeof($outSourceDetails);$i++)
        {
            if($outSourceDetails[$i]->id == $id)
            {
                $table.="<tr>";
                $table.="<td colspan=2 ><center><img src=".$outSourceDetails[$i]->image." width=300px height=200px ></center></td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>Supplier Name </td>";
                $table.="<td>".$supplier_name."</td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>Title </td>";
                $table.="<td>".$outSourceDetails[$i]->title."</td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>Vehicle Number </td>";
                $table.="<td>".$outSourceDetails[$i]->registered_number."</td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>Number of Seats </td>";
                $table.="<td>".$outSourceDetails[$i]->seat."</td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>Fuel Type </td>";
                if($outSourceDetails[$i]->fuel_type == "P")
                    $table.="<td>Petrol </td>";
                else
                    $table.="<td>Diesel </td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>Ac or Non A/c </td>";
                if($outSourceDetails[$i]->ac == 1)
                    $table.="<td>AC Vehicle </td>";
                else
                    $table.="<td>Non AC Vehicle </td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>Transmission </td>";
                if($outSourceDetails[$i]->transmission == "A")
                    $table.="<td>Auto Transmission </td>";
                else
                    $table.="<td>Menual Transmission </td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>Price Per Day </td>";
                $table.="<td>".$outSourceDetails[$i]->price_per_day." LKR/- </td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>Additional Price Per km </td>";
                $table.="<td>".$outSourceDetails[$i]->additional_price_per_km." LKR /- </td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>Additional Price Per hour </td>";
                $table.="<td>".$outSourceDetails[$i]->additional_price_per_hour." LKR/- </td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>System Registered Date </td>";
                $table.="<td>".$outSourceDetails[$i]->system_registered_date."</td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>Insurance Date </td>";
                $table.="<td>".$outSourceDetails[$i]->insurence_date."</td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>Revenue Licence Date </td>";
                $table.="<td>".$outSourceDetails[$i]->revenue_license_date."</td>";
                $table.="</tr>";
                $table.="<tr>";
                $table.="<td>Is Service Out </td>";
                if($outSourceDetails[$i]->is_service_out == 0)
                    $table.="<td>Service not out </td>";
                else
                    $table.="<td> Yes service out </td>";
                $table.="</tr>";

            }
        }
        $table.="</table>";
        $table.="<br>I do here by certify that all the details above furnished by me are true and accurate to the best of my knowledge. ";
        $table.="<br><br><br>Document Issued Date : ".date('d-m-yy');
        $table.="<br><br><br>........................................................";
        $table.="<br>Signature";
        $table.="<br>(Owner of the Outsource Vehicle)";
        $this->pdf->loadHtml($table);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("Vehicle Outsourcing Details.pdf",array("Attachment" => 0));
    }

    public function prepareToDeleteOutsourceVehicle()
    {
        $this->load->model('OutsourceVehicleModel');
        $response = $this->OutsourceVehicleModel->deleteOutSourceVehicle();

        if ($response) {
            $this->session->set_flashdata('outsource_status', 'Data Deleted Successfully!');
            redirect('Home/crms_outsourcing');
        }

    }

    public function updateOutsourcingVehicle()
    {
        $this->form_validation->set_rules('update_supplier_id','Supplier ID','required');
        $this->form_validation->set_rules('u_vehicleTitle','Vehicle Title','required');
        //$this->form_validation->set_rules('u_outsource_pic','OutSource Vehicle Image File','required');
        $this->form_validation->set_rules('u_vehicleRegisteredNumber','Registered Number','required');
        $this->form_validation->set_rules('u_vehicleSeat','No of seats','required');
        $this->form_validation->set_rules('u_vehicleFuelType','Fuel Type','required');
        $this->form_validation->set_rules('u_vehiclePrice','Price Per Day','required');
        $this->form_validation->set_rules('u_vehicleAddKM','Price Per KM','required');
        $this->form_validation->set_rules('u_vehicleAddHour','Price Per Hour','required');
        $this->form_validation->set_rules('u_vehicleInsurance','Insurance Date','required');
        $this->form_validation->set_rules('u_vehicleLicense','Revenue Licence Date','required');

        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_tempdata('u_title_fill',$this->input->post('u_vehicleTitle',TRUE),5);
            $this->session->set_tempdata('u_registered_no_fill',$this->input->post('u_vehicleRegisteredNumber',TRUE),5);
            $this->session->set_tempdata('u_no_of_seat_fill',$this->input->post('u_vehicleSeat',TRUE),5);
            $this->session->set_tempdata('u_fuel_type_fill',$this->input->post('u_vehicleFuelType',TRUE),5);
            $this->session->set_tempdata('u_price_per_day_fill',$this->input->post('u_vehiclePrice',TRUE),5);
            $this->session->set_tempdata('u_per_km_fill',$this->input->post('u_vehicleAddKM',TRUE),5);
            $this->session->set_tempdata('u_per_hour_fill',$this->input->post('u_vehicleAddHour',TRUE),5);
            $this->session->set_tempdata('u_insurence_date_fill',$this->input->post('u_vehicleInsurance',TRUE),5);
            $this->session->set_tempdata('u_revenue_license_date_date_fill',$this->input->post('u_vehicleLicense',TRUE),5);

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

            $this->session->set_tempdata('form','update_form',5);
            $this->load->view('crms_outsourcing',$data);
        }
        else{
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['upload_path'] = './assets/images/outsourceVehicles/';
            $this->load->library('upload',$config);

            if($this->upload->do_upload('u_outsource_pic'))
            {
                $data = $this->input->post();
                $info = $this->upload->data();
                $image_path= "assets/images/outsourceVehicles/".$info['raw_name'].$info['file_ext'];
                $this->load->model('OutsourceVehicleModel');
                $outSourceDetails = $this->OutsourceVehicleModel->getOutsourceDetails();
                $supplier = $this->OutsourceVehicleModel->getSupplier();
                $response = $this->OutsourceVehicleModel->updateOutsourceVehicle($image_path);

                if ($response)
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

                    $this->session->set_flashdata('outsource_status',"Data Updated Successfully");
                    $this->session->set_tempdata('form','add_form',5);
                    $this->load->view('crms_outsourcing',$data);

                }

            }
            else
            {
                $this->load->model('OutsourceVehicleModel');
                $outSourceDetails = $this->OutsourceVehicleModel->getOutsourceDetails();
                $supplier = $this->OutsourceVehicleModel->getSupplier();
                $response = $this->OutsourceVehicleModel->updateOutsourceVehicle(" ");

                if ($response)
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

                    $this->session->set_flashdata('outsource_status',"Data Updated Successfully");
                    $this->session->set_tempdata('form','add_form',5);
                    $this->load->view('crms_outsourcing',$data);

                }
            }
        }
    }
}
?>