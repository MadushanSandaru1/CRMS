<?php
     defined('BASEPATH') OR exit('No direct script access allowed');
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
                   $damages = $this->Damage_Report_Model->getDamageDetails();
                   $vehicles =$this->Damage_Report_Model->getVehicleID();
                   $cus =$this->Damage_Report_Model->getCustomerID();
                   $res_id =$this->Damage_Report_Model->getReservedID();

                   //get form veriables
                   $v_id = $this->input->post('vehicle_id',true);
                   $get_time = $this->input->post('get_time',TRUE);
                   $damage_pic =$this->input->post('is_include_damage_picture',TRUE);
                   $solved_type =$this->input->post('is_solved_type',TRUE);

                   //temp veriables
                   $vehicle =0;
                   $reg_no="";

                   //arrays
                //    $res_ids = array();
                //    $cus_ids = array();
                //    $nic_arr = array();

                   //get reseved ids to array
                //    for($i=0;$i < sizeof($damages);$i++)
                //    {
                //        array_push($res_ids,$damages[$i]->reserved_id);
                //    }
               
                   //get customers ids to array
                //    for($i=0;$i < sizeof($res_id);$i++)
                //    {
                //        if($res_ids[$i] == $res_id[$i]->id)
                //        {
                //             array_push($cus_ids,$res_id[$i]->customer_id);
                //        }
                //    }

                   //get customer nic numbers to array
                //    for($i=0;$i < sizeof($cus);$i++)
                //    {
                //        if($cus_ids[$i] == $cus[$i]->id)
                //        {
                //             array_push($nic_arr,$cus[$i]->nic);
                //        }
                //    }

                   // Genarate report has no time specification and want image 
                   if($get_time == "all" && $damage_pic == "Yes" && $solved_type == "all")
                   {
                       $sum =0;
                       for($i=0;$i < sizeof($damages);$i++)
                       {
                           if($damages[$i]->vehicle_id == $v_id)
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
                       $table.="<img src=assets/images/report_header.png  width=100% heighr=20%>";
                       $table.="<center><h4>Vehicle Damage Details</h4></center><br>";
                       $table.="<font> Vehicle Registration Number : ".$reg_no."</font>"."</h4><br><br>";
                       $table.="<table class='table'>";
                            $table.="<tr>";
                                // $table.="<th>"."Vehicle ID"."</th>";
                                $table.="<th>"."Description"."</th>";
                                $table.="<th>"."Date"."</th>";
                                $table.="<th>"."Image"."</th>";
                                // $table.="<th>"."Reserved ID"."</th>";
                                $table.="<th>"."Fix Amount"."</th>";
                                $table.="<th>"."Is Solved"."</th>";
                            $table.="</tr>";

                            for($i=0;$i < sizeof($damages);$i++)
                            {
                                if($damages[$i]->vehicle_id == $v_id)
                                {
                                    $table.="<tr>";
                                    $sum +=$damages[$i]->fix_amount;
                                    // $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                    $table.="<td>".$damages[$i]->description."</td>";
                                    $table.="<td>".$damages[$i]->d_date."</td>";
                                    $table.="<td><img src='".$damages[$i]->image."' width=180px height=150px></td>";
                                    // $table.="<td>".$nic_arr[$i]."</td>";
                                    $table.="<td>".$damages[$i]->fix_amount." LKR/-"."</td>";
                                    if($damages[$i]->is_solved == 0)
                                        $table.="<td>"."<font color='red'>No</font>"."</td>";
                                    else
                                        $table.="<td>"."<font color='green'>Yes</font>"."</td>";    
                                    $table.="</tr>";
                                }
                            }

                            $table.="<br>";
                            $table.="<tr>";
                                $table.="<td colspan=3>"."<b>Grant Total</b>"."</td>";
                                $table.="<td><b><u><u>".$sum." LKR/-"."</u></u></b></td>";
                            $table.="</tr>";
                       $table.="</table>";
                    //    $this->pdf->loadHtml($aData['html']);
                    //    $this->pdf->set_option('isRemoteEnabled',TRUE);
                       
                       $this->load->view('crms_genarate_pdf_file.php');
                       $html = $this->output->get_output();
                    //    $this->pdf->loadHtml('<img src=assets/images/report_header.png  width=100% heighr=20%> ');
                       $this->pdf->loadHtml($table);
                       $this->pdf->render();
                       $this->pdf->stream(""."Damage.pdf",array("Attachment" => 0));
                   }

                   // Genarate report has no time specification and dont want image 
                   if($get_time == "all" && $damage_pic == "No" && $solved_type == "all")
                   {
                       $sum =0;
                       for($i=0;$i < sizeof($damages);$i++)
                       {
                           if($damages[$i]->vehicle_id == $v_id)
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
                       $table.="<img src=assets/images/report_header.png  width=100% heighr=20%>";
                       $table.="<center><h4>Vehicle Damage Details</h4></center><br>";
                       $table.="<font> Vehicle Registration Number : ".$reg_no."</font>"."</h4><br><br>";
                       $table.="<table class='table'>";
                            $table.="<tr>";
                                // $table.="<th>"."Vehicle ID"."</th>";
                                $table.="<th>"."Description"."</th>";
                                $table.="<th>"."Date"."</th>";
                                // $table.="<th>"."Reserved ID"."</th>";
                                $table.="<th>"."Fix Amount"."</th>";
                                $table.="<th>"."Is Solved"."</th>";
                            $table.="</tr>";

                            for($i=0;$i < sizeof($damages);$i++)
                            {
                                if($damages[$i]->vehicle_id == $v_id)
                                {
                                    $table.="<tr>";
                                    $sum += $damages[$i]->fix_amount;
                                    // $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                    $table.="<td>".$damages[$i]->description."</td>";
                                    $table.="<td>".$damages[$i]->d_date."</td>";
                                    // $table.="<td>".$nic_arr[$i]."</td>";
                                    $table.="<td>".$damages[$i]->fix_amount." LKR/-"."</td>";
                                    if($damages[$i]->is_solved == 0)
                                        $table.="<td>"."<font color='red'>No</font>"."</td>";
                                    else
                                        $table.="<td>"."<font color='green'>Yes</font>"."</td>";    
                                    $table.="</tr>";
                                }
                            }

                            $table.="<br>";
                            $table.="<tr>";
                                $table.="<td colspan=3>"."<b>Grant Total</b>"."</td>";
                                $table.="<td><b><u><u>".$sum." LKR/-"."</u></u></b></td>";
                            $table.="</tr>";
                       $table.="</table>";
                       $this->pdf->loadHtml($table);
                       $this->pdf->render();
                       $this->pdf->stream(""."Damage.pdf",array("Attachment" => 0));
                   }

                   // Genarate report has no time specification and dont want image also solved damages
                   if($get_time == "all" && $damage_pic == "No" && $solved_type == "solved")
                   {
                       $sum =0;   
                       for($i=0;$i < sizeof($damages);$i++)
                       {
                           if($damages[$i]->vehicle_id == $v_id)
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
                       $table.="<img src=assets/images/report_header.png  width=100% heighr=20%>";
                       $table.="<center><h4>Vehicle Damage Details</h4></center><br>";
                       $table.="<font> Vehicle Registration Number : ".$reg_no."</font>"."</h4><br><br>";
                       $table.="<table class='table'>";
                            $table.="<tr>";
                                // $table.="<th>"."Vehicle ID"."</th>";
                                $table.="<th>"."Description"."</th>";
                                $table.="<th>"."Date"."</th>";
                                // $table.="<th>"."Reserved ID"."</th>";
                                $table.="<th>"."Fix Amount"."</th>";
                               
                            $table.="</tr>";

                            for($i=0;$i < sizeof($damages);$i++)
                            {
                                if($damages[$i]->vehicle_id == $v_id && $damages[$i]->is_solved==1)
                                {
                                    $table.="<tr>";
                                    $sum += $damages[$i]->fix_amount;
                                    // $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                    $table.="<td>".$damages[$i]->description."</td>";
                                    $table.="<td>".$damages[$i]->d_date."</td>";
                                    // $table.="<td>".$nic_arr[$i]."</td>";
                                    $table.="<td>".$damages[$i]->fix_amount." LKR/-"."</td>";
                                    $table.="</tr>";
                                }
                                
                            }
                            $table.="<br>";
                            $table.="<tr>";
                                $table.="<td colspan=2>"."<b>Grant Total</b>"."</td>";
                                $table.="<td><b><u><u>".$sum." LKR/-"."</u></u></b></td>";
                            $table.="</tr>";
                       $table.="</table>";
                       $this->pdf->loadHtml($table);
                       $this->pdf->render();
                       $this->pdf->stream(""."Damage.pdf",array("Attachment" => 0));
                   }

                   // Genarate report has no time specification and dont want image also not solved damages
                   if($get_time == "all" && $damage_pic == "No" && $solved_type == "not_solved")
                   {
                       $sum =0;   
                       for($i=0;$i < sizeof($damages);$i++)
                       {
                           if($damages[$i]->vehicle_id == $v_id)
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
                       $table.="<img src=assets/images/report_header.png  width=100% heighr=20%>";
                       $table.="<center><h4>Vehicle Damage Details</h4></center><br>";
                       $table.="<font> Vehicle Registration Number : ".$reg_no."</font>"."</h4><br><br>";
                       $table.="<table class='table'>";
                            $table.="<tr>";
                                // $table.="<th>"."Vehicle ID"."</th>";
                                $table.="<th>"."Description"."</th>";
                                $table.="<th>"."Date"."</th>";
                                // $table.="<th>"."Reserved ID"."</th>";
                                $table.="<th>"."Fix Amount"."</th>";
                               
                            $table.="</tr>";

                            for($i=0;$i < sizeof($damages);$i++)
                            {
                                if($damages[$i]->vehicle_id == $v_id && $damages[$i]->is_solved==0)
                                {
                                    $table.="<tr>";
                                    $sum += $damages[$i]->fix_amount;
                                    // $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                    $table.="<td>".$damages[$i]->description."</td>";
                                    $table.="<td>".$damages[$i]->d_date."</td>";
                                    // $table.="<td>".$nic_arr[$i]."</td>";
                                    $table.="<td>".$damages[$i]->fix_amount." LKR/-"."</td>";
                                    $table.="</tr>";
                                }
                                
                            }
                            $table.="<br>";
                            $table.="<tr>";
                                $table.="<td colspan=2>"."<b>Grant Total</b>"."</td>";
                                $table.="<td><b><u><u>".$sum." LKR/-"."</u></u></b></td>";
                            $table.="</tr>";
                       $table.="</table>";
                       $this->pdf->loadHtml($table);
                       $this->pdf->render();
                       $this->pdf->stream(""."Damage.pdf",array("Attachment" => 0));
                   }

                   // Genarate report has no time specification and  want image also solved damages
                   if($get_time == "all" && $damage_pic == "Yes" && $solved_type == "solved")
                   {
                       $sum =0;   
                       for($i=0;$i < sizeof($damages);$i++)
                       {
                           if($damages[$i]->vehicle_id == $v_id)
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
                       $table.="<img src=assets/images/report_header.png  width=100% heighr=20%>";
                       $table.="<center><h4>Vehicle Damage Details</h4></center><br>";
                       $table.="<font> Vehicle Registration Number : ".$reg_no."</font>"."</h4><br><br>";
                       $table.="<table class='table'>";
                            $table.="<tr>";
                                // $table.="<th>"."Vehicle ID"."</th>";
                                $table.="<th>"."Description"."</th>";
                                $table.="<th>"."Date"."</th>";
                                $table.="<th>"."Image"."</th>";
                                // $table.="<th>"."Reserved ID"."</th>";
                                $table.="<th>"."Fix Amount"."</th>";
                               
                            $table.="</tr>";

                            for($i=0;$i < sizeof($damages);$i++)
                            {
                                if($damages[$i]->vehicle_id == $v_id && $damages[$i]->is_solved==1)
                                {
                                    $table.="<tr>";
                                    $sum += $damages[$i]->fix_amount;
                                    // $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                    $table.="<td>".$damages[$i]->description."</td>";
                                    $table.="<td>".$damages[$i]->d_date."</td>";
                                    $table.="<td><img src='".$damages[$i]->image."' width=180px height=150px></td>";
                                    // $table.="<td>".$nic_arr[$i]."</td>";
                                    $table.="<td>".$damages[$i]->fix_amount." LKR/-"."</td>";
                                    $table.="</tr>";
                                }
                                
                            }
                            $table.="<br>";
                            $table.="<tr>";
                                $table.="<td colspan=3>"."<b>Grant Total</b>"."</td>";
                                $table.="<td><b><u><u>".$sum." LKR/-"."</u></u></b></td>";
                            $table.="</tr>";
                       $table.="</table>";
                       $this->pdf->loadHtml($table);
                       $this->pdf->render();
                       $this->pdf->stream(""."Damage.pdf",array("Attachment" => 0));
                   }

                   // Genarate report has  not time specification and  want image also not solved damages
                   if($get_time == "all" && $damage_pic == "Yes" && $solved_type == "not_solved")
                   {
                       $sum =0;   
                       for($i=0;$i < sizeof($damages);$i++)
                       {
                           if($damages[$i]->vehicle_id == $v_id)
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
                       $table.="<img src=assets/images/report_header.png  width=100% heighr=20%>";
                       $table.="<center><h4>Vehicle Damage Details</h4></center><br>";
                       $table.="<font> Vehicle Registration Number : ".$reg_no."</font>"."</h4><br><br>";
                       $table.="<table class='table'>";
                            $table.="<tr>";
                                // $table.="<th>"."Vehicle ID"."</th>";
                                $table.="<th>"."Description"."</th>";
                                $table.="<th>"."Date"."</th>";
                                $table.="<th>"."Image"."</th>";
                                // $table.="<th>"."Reserved ID"."</th>";
                                $table.="<th>"."Fix Amount"."</th>";
                               
                            $table.="</tr>";

                            for($i=0;$i < sizeof($damages);$i++)
                            {
                                if($damages[$i]->vehicle_id == $v_id && $damages[$i]->is_solved==0)
                                {
                                    $table.="<tr>";
                                    $sum += $damages[$i]->fix_amount;
                                    // $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                    $table.="<td>".$damages[$i]->description."</td>";
                                    $table.="<td>".$damages[$i]->d_date."</td>";
                                    $table.="<td><img src='".$damages[$i]->image."' width=180px height=150px></td>";
                                    // $table.="<td>".$nic_arr[$i]."</td>";
                                    $table.="<td>".$damages[$i]->fix_amount." LKR/-"."</td>";
                                    $table.="</tr>";
                                }
                                
                            }
                            $table.="<br>";
                            $table.="<tr>";
                                $table.="<td colspan=3>"."<b>Grant Total</b>"."</td>";
                                $table.="<td><b><u><u>".$sum." LKR/-"."</u></u></b></td>";
                            $table.="</tr>";
                       $table.="</table>";
                       $this->pdf->loadHtml($table);
                       $this->pdf->render();
                       $this->pdf->stream(""."Damage.pdf",array("Attachment" => 0));
                    }

                   // Genarate report has  time specification and  want image also all damages
                    if($get_time == "customize" && $damage_pic == "Yes" && $solved_type == "all")
                    {
                       $damages_cus = $this->Damage_Report_Model->getDateSpecificDamages();
                       if($damages_cus == 0)
                            echo "no";  
                       $sum =0;
                       for($i=0;$i < sizeof($damages_cus);$i++)
                       {
                           if($damages[$i]->vehicle_id == $v_id)
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
                       $table.="<img src=assets/images/report_header.png  width=100% heighr=20%>";
                       $table.="<center><h4>Vehicle Damage Details</h4></center><br>";
                       $table.="<font> Vehicle Registration Number : ".$reg_no."</font>"."</h4><br><br>";
                       $table.="<table class='table'>";
                            $table.="<tr>";
                                // $table.="<th>"."Vehicle ID"."</th>";
                                $table.="<th>"."Description"."</th>";
                                $table.="<th>"."Date"."</th>";
                                $table.="<th>"."Image"."</th>";
                                // $table.="<th>"."Reserved ID"."</th>";
                                $table.="<th>"."Fix Amount"."</th>";
                                $table.="<th>"."Is Solved"."</th>";
                            $table.="</tr>";

                            for($i=0;$i < sizeof($damages_cus);$i++)
                            {
                                if($damages[$i]->vehicle_id == $v_id)
                                {
                                    $table.="<tr>";
                                    $sum +=$damages[$i]->fix_amount;
                                    // $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                    $table.="<td>".$damages_cus[$i]->description."</td>";
                                    $table.="<td>".$damages_cus[$i]->d_date."</td>";
                                    $table.="<td><img src='".$damages[$i]->image."' width=180px height=150px></td>";
                                    // $table.="<td>".$nic_arr[$i]."</td>";
                                    $table.="<td>".$damages_cus[$i]->fix_amount." LKR/-"."</td>";
                                    if($damages[$i]->is_solved == 0)
                                        $table.="<td>"."<font color='red'>No</font>"."</td>";
                                    else
                                        $table.="<td>"."<font color='green'>Yes</font>"."</td>";    
                                    $table.="</tr>";
                                }
                            }

                            $table.="<br>";
                            $table.="<tr>";
                                $table.="<td colspan=4>"."<b>Grant Total</b>"."</td>";
                                $table.="<td><b><u><u>".$sum." LKR/-"."</u></u></b></td>";
                            $table.="</tr>";
                       $table.="</table>";
                       $this->pdf->loadHtml($table);
                       $this->pdf->render();
                       $this->pdf->stream(""."Damage.pdf",array("Attachment" => 0));
                   }

                   // Genarate report has  time specification and  want image also  solved damages
                   if($get_time == "customize" && $damage_pic == "Yes" && $solved_type == "solved")
                   {
                      $damages_cus = $this->Damage_Report_Model->getDateSpecificDamages();
                      $sum =0;
                      for($i=0;$i < sizeof($damages_cus);$i++)
                      {
                          if($damages[$i]->vehicle_id == $v_id)
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
                      $table.="<img src=assets/images/report_header.png  width=100% heighr=20%>";
                      $table.="<center><h4>Vehicle Damage Details</h4></center><br>";
                      $table.="<font> Vehicle Registration Number : ".$reg_no."</font>"."</h4><br><br>";
                      $table.="<table class='table'>";
                           $table.="<tr>";
                               // $table.="<th>"."Vehicle ID"."</th>";
                               $table.="<th>"."Description"."</th>";
                               $table.="<th>"."Date"."</th>";
                               $table.="<th>"."Image"."</th>";
                               // $table.="<th>"."Reserved ID"."</th>";
                               $table.="<th>"."Fix Amount"."</th>";
                               $table.="<th>"."Is Solved"."</th>";
                           $table.="</tr>";

                           for($i=0;$i < sizeof($damages_cus);$i++)
                           {
                               if($damages[$i]->vehicle_id == $v_id && $damages[$i]->is_solved==1)
                               {
                                   $table.="<tr>";
                                   $sum +=$damages[$i]->fix_amount;
                                   // $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                   $table.="<td>".$damages_cus[$i]->description."</td>";
                                   $table.="<td>".$damages_cus[$i]->d_date."</td>";
                                   $table.="<td><img src='".$damages[$i]->image."' width=180px height=150px></td>";
                                   // $table.="<td>".$nic_arr[$i]."</td>";
                                   $table.="<td>".$damages_cus[$i]->fix_amount." LKR/-"."</td>";
                                   if($damages[$i]->is_solved == 0)
                                       $table.="<td>"."<font color='red'>No</font>"."</td>";
                                   else
                                       $table.="<td>"."<font color='green'>Yes</font>"."</td>";    
                                   $table.="</tr>";
                               }
                           }

                           $table.="<br>";
                           $table.="<tr>";
                               $table.="<td colspan=4>"."<b>Grant Total</b>"."</td>";
                               $table.="<td><b><u><u>".$sum." LKR/-"."</u></u></b></td>";
                           $table.="</tr>";
                      $table.="</table>";
                      $this->pdf->loadHtml($table);
                      $this->pdf->render();
                      $this->pdf->stream(""."Damage.pdf",array("Attachment" => 0));
                  }

                   // Genarate report has  time specification and  want image also  not solved damages
                   if($get_time == "customize" && $damage_pic == "Yes" && $solved_type == "not_solved")
                   {
                      $damages_cus = $this->Damage_Report_Model->getDateSpecificDamages();
                      $sum =0;
                      for($i=0;$i < sizeof($damages_cus);$i++)
                      {
                          if($damages[$i]->vehicle_id == $v_id)
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
                      $table.="<img src=assets/images/report_header.png  width=100% heighr=20%>";
                      $table.="<center><h4>Vehicle Damage Details</h4></center><br>";
                      $table.="<font> Vehicle Registration Number : ".$reg_no."</font>"."</h4><br><br>";
                      $table.="<table class='table'>";
                           $table.="<tr>";
                               // $table.="<th>"."Vehicle ID"."</th>";
                               $table.="<th>"."Description"."</th>";
                               $table.="<th>"."Date"."</th>";
                               $table.="<th>"."Image"."</th>";
                               // $table.="<th>"."Reserved ID"."</th>";
                               $table.="<th>"."Fix Amount"."</th>";
                               $table.="<th>"."Is Solved"."</th>";
                           $table.="</tr>";

                           for($i=0;$i < sizeof($damages_cus);$i++)
                           {
                               if($damages[$i]->vehicle_id == $v_id && $damages[$i]->is_solved==0)
                               {
                                   $table.="<tr>";
                                   $sum +=$damages[$i]->fix_amount;
                                   // $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                   $table.="<td>".$damages_cus[$i]->description."</td>";
                                   $table.="<td>".$damages_cus[$i]->d_date."</td>";
                                   $table.="<td><img src='".$damages[$i]->image."' width=180px height=150px></td>";
                                   // $table.="<td>".$nic_arr[$i]."</td>";
                                   $table.="<td>".$damages_cus[$i]->fix_amount." LKR/-"."</td>";
                                   if($damages[$i]->is_solved == 0)
                                       $table.="<td>"."<font color='red'>No</font>"."</td>";
                                   else
                                       $table.="<td>"."<font color='green'>Yes</font>"."</td>";    
                                   $table.="</tr>";
                               }
                           }

                           $table.="<br>";
                           $table.="<tr>";
                               $table.="<td colspan=4>"."<b>Grant Total</b>"."</td>";
                               $table.="<td><b><u><u>".$sum." LKR/-"."</u></u></b></td>";
                           $table.="</tr>";
                      $table.="</table>";
                      $this->pdf->loadHtml($table);
                      $this->pdf->render();
                      $this->pdf->stream(""."Damage.pdf",array("Attachment" => 0));
                  }

                  // Genarate report has  time specification and  want image also all damages
                  if($get_time == "customize" && $damage_pic == "No" && $solved_type == "all")
                  {
                     $damages_cus = $this->Damage_Report_Model->getDateSpecificDamages();
                     $sum =0;
                     for($i=0;$i < sizeof($damages_cus);$i++)
                     {
                         if($damages[$i]->vehicle_id == $v_id)
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
                     $table.="<img src=assets/images/report_header.png  width=100% heighr=20%>";
                     $table.="<center><h4>Vehicle Damage Details</h4></center><br>";
                     $table.="<font> Vehicle Registration Number : ".$reg_no."</font>"."</h4><br><br>";
                     $table.="<table class='table'>";
                          $table.="<tr>";
                              // $table.="<th>"."Vehicle ID"."</th>";
                              $table.="<th>"."Description"."</th>";
                              $table.="<th>"."Date"."</th>";
                            //   $table.="<th>"."Image"."</th>";
                              // $table.="<th>"."Reserved ID"."</th>";
                              $table.="<th>"."Fix Amount"."</th>";
                              $table.="<th>"."Is Solved"."</th>";
                          $table.="</tr>";

                          for($i=0;$i < sizeof($damages_cus);$i++)
                          {
                              if($damages[$i]->vehicle_id == $v_id)
                              {
                                  $table.="<tr>";
                                  $sum +=$damages[$i]->fix_amount;
                                  // $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                  $table.="<td>".$damages_cus[$i]->description."</td>";
                                  $table.="<td>".$damages_cus[$i]->d_date."</td>";
                                //   $table.="<td><img src='".base_url($damages_cus[$i]->image)."'></td>";
                                  // $table.="<td>".$nic_arr[$i]."</td>";
                                  $table.="<td>".$damages_cus[$i]->fix_amount." LKR/-"."</td>";
                                  if($damages[$i]->is_solved == 0)
                                      $table.="<td>"."<font color='red'>No</font>"."</td>";
                                  else
                                      $table.="<td>"."<font color='green'>Yes</font>"."</td>";    
                                  $table.="</tr>";
                              }
                          }

                          $table.="<br>";
                          $table.="<tr>";
                              $table.="<td colspan=3>"."<b>Grant Total</b>"."</td>";
                              $table.="<td><b><u><u>".$sum." LKR/-"."</u></u></b></td>";
                          $table.="</tr>";
                     $table.="</table>";
                     $this->pdf->loadHtml($table);
                     $this->pdf->render();
                     $this->pdf->stream(""."Damage.pdf",array("Attachment" => 0));
                 }

                  // Genarate report has  time specification and  want image also  solved damages
                  if($get_time == "customize" && $damage_pic == "No" && $solved_type == "solved")
                  {
                     $damages_cus = $this->Damage_Report_Model->getDateSpecificDamages();
                     $sum =0;
                     for($i=0;$i < sizeof($damages_cus);$i++)
                     {
                         if($damages[$i]->vehicle_id == $v_id)
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
                     $table.="<img src=assets/images/report_header.png  width=100% heighr=20%>";
                     $table.="<center><h4>Vehicle Damage Details</h4></center><br>";
                     $table.="<font> Vehicle Registration Number : ".$reg_no."</font>"."</h4><br><br>";
                     $table.="<table class='table'>";
                          $table.="<tr>";
                              // $table.="<th>"."Vehicle ID"."</th>";
                              $table.="<th>"."Description"."</th>";
                              $table.="<th>"."Date"."</th>";
                            //   $table.="<th>"."Image"."</th>";
                              // $table.="<th>"."Reserved ID"."</th>";
                              $table.="<th>"."Fix Amount"."</th>";
                              $table.="<th>"."Is Solved"."</th>";
                          $table.="</tr>";

                          for($i=0;$i < sizeof($damages_cus);$i++)
                          {
                              if($damages[$i]->vehicle_id == $v_id && $damages[$i]->is_solved==1)
                              {
                                  $table.="<tr>";
                                  $sum +=$damages[$i]->fix_amount;
                                  // $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                  $table.="<td>".$damages_cus[$i]->description."</td>";
                                  $table.="<td>".$damages_cus[$i]->d_date."</td>";
                                //   $table.="<td><img src='".base_url($damages_cus[$i]->image)."'></td>";
                                  // $table.="<td>".$nic_arr[$i]."</td>";
                                  $table.="<td>".$damages_cus[$i]->fix_amount." LKR/-"."</td>";
                                  if($damages[$i]->is_solved == 0)
                                      $table.="<td>"."<font color='red'>No</font>"."</td>";
                                  else
                                      $table.="<td>"."<font color='green'>Yes</font>"."</td>";    
                                  $table.="</tr>";
                              }
                          }

                          $table.="<br>";
                          $table.="<tr>";
                              $table.="<td colspan=3>"."<b>Grant Total</b>"."</td>";
                              $table.="<td><b><u><u>".$sum." LKR/-"."</u></u></b></td>";
                          $table.="</tr>";
                     $table.="</table>";
                     $this->pdf->loadHtml($table);
                     $this->pdf->render();
                     $this->pdf->stream(""."Damage.pdf",array("Attachment" => 0));
                 }

                 // Genarate report has  time specification and  want image also  not solved damages
                 if($get_time == "customize" && $damage_pic == "No" && $solved_type == "not_solved")
                 {
                    $damages_cus = $this->Damage_Report_Model->getDateSpecificDamages();
                    $sum =0;
                    for($i=0;$i < sizeof($damages_cus);$i++)
                    {
                        if($damages[$i]->vehicle_id == $v_id)
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
                    $table.="<img src=assets/images/report_header.png  width=100% heighr=20%>";
                    $table.="<center><h4>Vehicle Damage Details</h4></center><br>";
                    $table.="<font> Vehicle Registration Number : ".$reg_no."</font>"."</h4><br><br>";
                    $table.="<table class='table'>";
                         $table.="<tr>";
                             // $table.="<th>"."Vehicle ID"."</th>";
                             $table.="<th>"."Description"."</th>";
                             $table.="<th>"."Date"."</th>";
                            //  $table.="<th>"."Image"."</th>";
                             // $table.="<th>"."Reserved ID"."</th>";
                             $table.="<th>"."Fix Amount"."</th>";
                             $table.="<th>"."Is Solved"."</th>";
                         $table.="</tr>";

                         for($i=0;$i < sizeof($damages_cus);$i++)
                         {
                             if($damages[$i]->vehicle_id == $v_id && $damages[$i]->is_solved==0)
                             {
                                 $table.="<tr>";
                                 $sum +=$damages[$i]->fix_amount;
                                 // $table.="<td>".$damages[$i]->vehicle_id."</td>";
                                 $table.="<td>".$damages_cus[$i]->description."</td>";
                                 $table.="<td>".$damages_cus[$i]->d_date."</td>";
                                //  $table.="<td><img src='".base_url($damages_cus[$i]->image)."'></td>";
                                 // $table.="<td>".$nic_arr[$i]."</td>";
                                 $table.="<td>".$damages_cus[$i]->fix_amount." LKR/-"."</td>";
                                 if($damages[$i]->is_solved == 0)
                                     $table.="<td>"."<font color='red'>No</font>"."</td>";
                                 else
                                     $table.="<td>"."<font color='green'>Yes</font>"."</td>";    
                                 $table.="</tr>";
                             }
                         }

                         $table.="<br>";
                         $table.="<tr>";
                             $table.="<td colspan=3>"."<b>Grant Total</b>"."</td>";
                             $table.="<td><b><u><u>".$sum." LKR/-"."</u></u></b></td>";
                         $table.="</tr>";
                    $table.="</table>";
                    $this->pdf->loadHtml($table);
                    $this->pdf->render();
                    $this->pdf->stream(""."Damage.pdf",array("Attachment" => 0));
                }


            }
        }

        
    }
?>