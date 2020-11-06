<?php
     class Damage_Report extends CI_Controller
     {
         function __construct()
         {
                parent::__construct();
                $this->load->library('pdf');
         }

         public function GenerateDamageReport()
         {
            $this->form_validation->set_rules('vehicle_id','Vehicle ID','required');
            $this->form_validation->set_rules('get_time','Time Period','required');
            //$this->form_validation->set_rules('tdate','To Date','required');
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
                   $this->load->model('Damage_Report_Model');
                   $damages = $this->Damage_Report_Model->getDamages();
                   $vehicles =$this->Damage_Report_Model->getVehicleID();
                   $cus =$this->Damage_Report_Model->getCustomerID();
                   $res_id =$this->Damage_Report_Model->getReservedID();

                   $vehicle =0;
                   $reg_no="";

                   if(!empty($damages))
                   {
                       
                       for($i=0;$i < sizeof($damages);$i++)
                       {
                            $vehicle = $damages[$i]->vehicle_id;
                       }  
                       
                       for($i=0;$i < sizeof($vehicles);$i++)
                       {
                            if($vehicles[$i]->id == $vehicle)
                            {
                                $reg_no = $vehicles[$i]->registered_number;
                            }
                       }

                       $table = "";
                       $table.="<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css' integrity='sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2' crossorigin='anonymous'>";
                       $table.="<h4><font color='blue'>".$reg_no." Vehicle Damage Details</font>"."</h4>";
                       $table.="<table class='table'>";
                            $table.="<tr>";
                                // $table.="<th>"."Vehicle ID"."</th>";
                                $table.="<th>"."Description"."</th>";
                                $table.="<th>"."Date"."</th>";
                                $table.="<th>"."Image"."</th>";
                                $table.="<th>"."Reserved ID"."</th>";
                                $table.="<th>"."Fix Amount"."</th>";
                                $table.="<th>"."Is Solved"."</th>";
                            $table.="</tr>";

                            for($i=0;$i < sizeof($damages);$i++)
                            {
                                $table.="<tr>";
                                
                                // $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                $table.="<td>".$damages[$i]->description."</td>";
                                $table.="<td>".$damages[$i]->date."</td>";
                                $table.="<td>"."<img base_url(../../".$damages[$i]->image.") >"."</td>";
                                $table.="<td>".$damages[$i]->reserved_id."</td>";
                                $table.="<td>".$damages[$i]->fix_amount." LKR/-"."</td>";
                                if($damages[$i]->is_solved == 0)
                                    $table.="<td>"."<font color='red'>No</font>"."</td>";
                                else
                                    $table.="<td>"."<font color='green'>Yes</font>"."</td>";    
                                $table.="</tr>";
                            }

                       $table.="</table>";
                       $this->pdf->loadHtml($table);
                       $this->pdf->render();
                       $this->pdf->stream(""."Damage.pdf",array("Attachment" => 0));
                   }
               }
         }
     }
?>