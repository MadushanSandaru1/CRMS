<?php
     class Damage_Report extends CI_Controller
     {
         public function GenerateDamageReport()
         {
            $this->form_validation->set_rules('vehicle_id','Vehicle ID','required');
            $this->form_validation->set_rules('fdate','From Date','required');
            $this->form_validation->set_rules('tdate','To Date','required');
            $this->form_validation->set_rules('is_include_damage_picture','is include damage picture','required');
            $this->form_validation->set_rules('is_solved_type','is solved type','required');

            if($this->form_validation->run() == FALSE)
               {
                    $this->load->model('Damage_Report_Model');
                    $getDamageDetails = $this->Damage_Report_Model->getDamageDetails();
                    $getVehicleID = $this->Damage_Report_Model->getVehicleID();
                    $this->load->view('crms_damage_report',['getVehicleID'=>$getVehicleID,'getDamageDetails'=>$getDamageDetails]);
                    
               }
               else{
                   echo "ok";
                   die();
               }
         }
     }
?>