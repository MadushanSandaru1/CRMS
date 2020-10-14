<?php require_once 'crms_header.php';?>
    
    <div class="content-wrapper">
        <!--div class="row" id="proBanner">
            <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                  <p>Get tons of UI components, Plugins, multiple layouts, 20+ sample pages, and more!</p>
                  <a href="" class="btn download-button purchase-button ml-auto">Upgrade To Pro</a>
                  <i class="mdi mdi-close" id="bannerClose"></i>
                </span>
            </div>
        </div-->

        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-car-wash"></i>
                </span> Car Damages </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger" >Registration of Vehicle Damage Details</h4><br><br>
                        <!--<p class="card-description"> Basic form elements </p>-->
                        <!--<div class="alert alert-danger">-->
                        <div class="custom-control custom-radio custom-control-inline">
                                    
                                    <input type="button" value="New Damage Registration" class="btn btn-primary" id="view" data-toggle="collapse" href="#viewDetails" aria-expanded="false" aria-controls="viewDetails">
                                    
                        </div>
                        <br>
                        <div class="collapse " id="viewDetails" aria-labelledby="customRadioInline2">
                            
                            <br><br>
                            <!--<?php echo form_open('Damage/DamageVehicle'); ?>-->
                                <?php echo form_open_multipart('Damage/DamageVehicle'); ?>
                                <div class="form-group">
                                    <label for="exampleInputName1"><b>Vehicle ID</b></label>
                                    <select name="vehicle_id" id="" class="custom-select mr-sm-2">
                                        <option value="">Select Vehicle ID</option>
                                        <?php if(count($getVehicleID)): ?>
                                            <?php foreach($getVehicleID as $value):?>
                                                <option value=<?php echo $value->id;?>><?php echo $value->registered_number;?></option>
                                            <?php endforeach;?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            
                            
                                <div class="form-group">
                                    <label for="exampleSelectGender"><b>Nature of Damage</b></label>
                                    <select class="custom-select mr-sm-2" id="exampleSelectGender" name="description">
                                        <option value="">Select Nature of Damage</option>
                                        <option values="left or Right Signal light">left or Right Signal light</option>
                                        <option values="Door damage">Door damage</option>
                                        <option value="Left and Right Side mirror damages">Left and Right Side mirror damages</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><b>Upload Damage Vehicle Picture</b></label>
                                    <input type="file"  class="form-control" name="image_file">
                                    <!--
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                        </span>
                                    </div>
                                -->
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCity1"><b>Reserved From</b></label><br><br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="chooser" class="custom-control-input" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample " checked>
                                        <label class="mdi mdi-swap-vertical" for="customRadioInline1">Reserved ID</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="chooser" class="custom-control-input" data-toggle="collapse" href="#custome" aria-expanded="false" aria-controls="custom ">
                                        <label class="mdi mdi-swap-vertical " for="customRadioInline2">Custom Choose </label>
                                    </div>
                                    <div class="collapse " id="collapseExample" aria-labelledby="customRadioInline1">
                                    <br>
                                        <select name="cr_vehicle_id" id="showReservedId" class="custom-select"  >
                                            <option value="">Select Reserved ID</option>    
                                            <?php if(count($getReservedID)): ?>
                                                <?php foreach($getReservedID as $value):?>
                                                    <option value=<?php echo $value->id;?>><?php echo "".$value->id;?></option>
                                                <?php endforeach;?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="collapse " id="custome" aria-labelledby="customRadioInline2">
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <select name="c_vehicle_id" id="showReservedId" class="custom-select mb-2 "  >
                                                    <option value="">Select Vehicle ID</option>
                                                    <?php if(count($getVehicleID)): ?>
                                                        <?php foreach($getVehicleID as $value):?>
                                                            <option value=<?php echo $value->id;?>><?php echo "".$value->registered_number;?></option>
                                                        <?php endforeach;?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select name="c_customer_id" id="showReservedId" class="custom-select"  >
                                                    <option value="">Select Customer</option>
                                                    <?php if(count($getReservedID) && count($getCustomerDetails)): ?>
                                                         <?php for($i=0; $i < sizeof($getReservedID);$i++):?>
                                                              <?php if($getReservedID->customer_id == $getCustomerDetails->id):?>
                                                                    <option value=<?php echo $getReservedID[$i]->id;?>><?php echo "".$getCustomerDetails[$i]->nic;?></option>
                                                              <?php endif; ?>
                                                              <?php endfor;?>
                                                    <?php endif; ?>
                                                </select>       
                                            </div>
                                        </div>
                                    
                                    
                                    </div>
                                
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCity1"><b>Date</b></label>
                                    <input type="text" class="form-control" id="exampleInputCity1" value=<?php echo date('yy-m-d');?> name="d_date" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCity1"><b>Are customer willing to pay now? </b></label><br><br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="checkbox" id="fix_amount" name="customRadioInline1" class="" data-toggle="collapse" href="#fix" aria-expanded="false" aria-controls="fix" > 
                                        <label for="exampleInputCity1 "> Yes</label>
                                    </div>
                                    <div class="collapse " id="fix" aria-labelledby="fix_amount">
                                        <br>
                                        <input type="text" name="fix_amount" id="" class="form-control" value="0" placeholder="Enter fix amount">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectGender"><b>Is damage solved</b></label><br><br>
                                    <input type="checkbox" name="is_solved" id="damage_solved" value="1" class="">
                                    <label for="exampleInputCity1 "> Yes</label>
                                
                                </div>
                                <button type="submit" class="btn btn-gradient-primary mr-2">Register</button>
                                <button class="btn btn-light">Cancel</button>
                            <?php echo form_close(); ?>   
                        </div>
                           
                        <!--</div>-->
                       
                    </div>
                </div>
              </div>
        </div>
        
        <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <?php
                                if($this->session->flashdata('damage_status'))
                                {
                        ?>    
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('damage_status'); ?>
                                </div>
                        <?php        
                                }
                        ?>
                        <br>
                        <h4 class="card-title text-danger">Damage Details</h4>
                        <!--<p class="card-description"> Add class <code>.table</code></p>-->
                    
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Vehicle ID</th>
                                    <th>Date</th>
                                    <th>Discription</th>
                                    <th>Reserved ID</th>
                                    <!--<th style="text-align: center;">Picture</th>-->
                                    <th>Fix Amount</th>
                                    <th>Is Solved</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($getDamageDetails)):?>
                                    <?php foreach($getDamageDetails as $values): ?>                                    
                                        <tr>
                          	                <td><?php echo "".$values->vehicle_id;?></td>
                          	                <td><?php echo $values->date;?></td>
                          	                <td><?php echo $values->description; ?></td>
                          	                <td><?php echo "".$values->reserved_id; ?></td>
                          	                <!--<td><input type="submit" name="" class="btn btn-success" value="View"></td>-->
                          	                <td><?php echo $values->fix_amount." LKR/-"; ?></td>
                                            <td>
                                                <?php
                                                        if($values->is_solved == 0)
                                                        {
                                                            echo "<b style='color: red;'>Not Yet</b>" ;
                                                        } 
                                                        else
                                                            echo "<b style='color: green;'>Yes</b>" ;
                                                ?>
                                            </td>
                          	                <td>
                          		                <a href=""><span class="mdi mdi-eyedropper " style="color:green;font-size:16px;"> Edit</span></a>
                          		                <a href=""><span class="mdi mdi-close-circle ml-4" style="color:red;font-size:16px;"> Remove</span></a>
                          	                </td>

                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                       	        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>