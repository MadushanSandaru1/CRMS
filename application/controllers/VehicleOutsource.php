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
                    $this->session->set_flashdata('outsource_status',"Data Recorded Successfully");
                    $this->load->view(
                        'crms_outsourcing',
                        [
                            'outsourceVehicle'=>$outSourceDetails,
                            'supplier'=>$supplier
                        ]
                    );
                }
            }
        }

        public function outsourcingReport()
        {
            $id = $this->uri->segment(3);
            $supplier_name="";

            $this->load->model("OutsourceVehicleModel");
            $outSourceDetails = $this->OutsourceVehicleModel->getOutsourceDetails();
            $supplier = $this->OutsourceVehicleModel->getSupplier();
                        
            $table = "";
            $table.="<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css' integrity='sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2' crossorigin='anonymous'>";
            $table.="<img src=assets/images/report_header.png  width=100% heighr=20%>";
            $table.="<table class='table'>";
            for($i=0;$i<sizeof($outSourceDetails);$i++)
            {
                if($outSourceDetails[$i]->id == $id)
                {
                    $table.="<tr>";
                        $table.="<td>Supplier Name </td>";
                        $table.="<td>".$outSourceDetails[$i]->supplier_id."</td>";
                    $table.="</tr>";
                    $table.="<tr>";    
                        $table.="<td>Title </td>";
                        $table.="<td>".$outSourceDetails[$i]->title."</td>";
                    $table.="</tr>";
                    $table.="<tr>";    
                        $table.="<td>Vehicle Number </td>";
                        $table.="<td>".$outSourceDetails[$i]->registered_number."</td>";
                    $table.="</tr>";    
                    // $table.="Number of Seats : ".$outsourceDetails[$i]->seat;
                    // $table.="Fuel Type : ".$outSourceDetails[$i]->fuel_type;
                    // $table.="Ac Type : ".$outSourceDetails[$i]->ac;
                    // $table.="Transmission : ".$outSourceDetails[$i]->transmission;
                    // $table.="Price Per Day : ".$outSourceDetails[$i]->price_per_day;
                    // $table.="Additional Price Per km : ".$outSourceDetails[$i]->additional_price_per_km;
                    // $table.="Additional Price Per hour : ".$outSourceDetails[$i]->additional_price_per_hour;
                    // $table.="System Registered Date : ".$outSourceDetails[$i]->system_registered_date;
                    // $table.="Insurance Date : ".$outSourceDetails[$i]->insurence_date;
                    // $table.="Revenue Licence Date : ".$outSourceDetails[$i]->revenue_license_date;
                    // $table.="Is Service Out : ".$outSourceDetails[$i]->is_service_out;
                    // $table.="<img src=".$outSourceDetails[$i]->image." width=100px height=100px >";
                    $table.="</tr>";
                }
            }
            $table.="</table>";
            $this->pdf->loadHtml($table);
            $this->pdf->render();
            $this->pdf->stream("Vehicle Outsourcing Details.pdf",array("Attachment" => 0));
        }
    }
?>