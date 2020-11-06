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

                   if(!empty($damages))
                   {
                       $table = "";
                       $table.="<table>";
                            $table.="<tr>";
                                $table.="<th>"."Vehicle ID"."</th>";
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
                                $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                $table.="<td>".$damages[$i]->description."</td>";
                                $table.="<td>".$damages[$i]->date."</td>";
                                $table.="<td>".$damages[$i]->image."</td>";
                                $table.="<td>".$damages[$i]->reserved_id."</td>";
                                $table.="<td>".$damages[$i]->fix_amount."</td>";
                                $table.="<td>".$damages[$i]->is_solved."</td>";
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