<?php

    //session timeout error
    if (!$this->session->userdata('user_id')) {
        $this->session->set_flashdata('user_status', 'Session timeout');

        //redirect to sign in page
        redirect('Home/crms_signin');
    }

?>

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
                        <span></span><i class="mdi mdi-clock icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title text-danger" >Registration of Vehicle Damage Details</h4><br><br> -->
                        <!--<p class="card-description"> Basic form elements </p>-->
                        <!--<div class="alert alert-danger">-->
                        <div class="custom-control custom-radio custom-control-inline">
                                    
                                    <button  class="btn btn-primary mb-2" id="view" data-toggle="collapse" href="#viewDetails" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i>Add Damage Details </button>
                                    <input type="button" value="Edit Damage Details" class="btn btn-primary mb-2 ml-2" id="view" data-toggle="collapse" href="#EditDetails" aria-expanded="false" aria-controls="viewDetails">
                                    
                        </div>
                        <br>
                        <div class="collapse " id="viewDetails" aria-labelledby="customRadioInline2">
                            
                            <br><br>
                            <!--<?php echo form_open('Damage/DamageVehicle'); ?>-->
                                <?php echo form_open_multipart('Damage/DamageVehicle'); ?>
                                <div class="form-group">
                                    <label for="exampleInputName1"><b>Vehicle ID</b></label>
                                    <select name="vehicle_id" id="" class="custom-select mr-sm-2" >
                                        <option value="">Select Vehicle ID</option>
                                        <?php if(count($getVehicleID)): ?>
                                            <?php foreach($getVehicleID as $value):?>
                                                <option value=<?php echo $value->id;?>><?php echo $value->registered_number;?></option>
                                            <?php endforeach;?>
                                        <?php endif; ?>
                                    </select>
                                    <small class="text-danger"><?php echo form_error('vehicle_id'); ?></small>
                                </div>
                            
                            
                                <div class="form-group">
                                    <label for="exampleSelectGender"><b>Nature of Damage</b></label>
                                    <select class="custom-select mr-sm-2" id="exampleSelectGender" name="description">
                                        <option value="">Select Nature of Damage</option>
                                        <option values="left or Right Signal light">left or Right Signal light</option>
                                        <option values="Door damage">Door damage</option>
                                        <option value="Left and Right Side mirror damages">Left and Right Side mirror damages</option>
                                    </select>
                                    <small class="text-danger"><?php echo form_error('description'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label><b>Upload Damage Vehicle Picture</b></label>
                                    <input type="file"  class="form-control" name="image_file" >
                                    <!-- <small class="text-danger"><?php echo form_error('image_file'); ?></small>   -->
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
                                        <!-- <input type="radio" id="customRadioInline1" name="chooser" class="custom-control-input" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample " checked>
                                        <label class="mdi mdi-swap-vertical" for="customRadioInline1">Reserved ID</label> -->
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="chooser" class="custom-control-input" data-toggle="collapse" href="#custome" aria-expanded="false" aria-controls="custom " >
                                        <label class="mdi mdi-swap-vertical " for="customRadioInline2">Custom Choose </label>
                                        
                                    </div>
                                    <small class="text-danger"><?php echo form_error('chooser'); ?></small>
                                    <!-- <div class="collapse " id="collapseExample" aria-labelledby="customRadioInline1">
                                    <br>
                                        <select name="cr_vehicle_id" id="showReservedId" class="custom-select"  >
                                            <option value="">Select Reserved ID</option>    
                                            <?php if(count($getReservedID)): ?>
                                                <?php foreach($getReservedID as $value):?>
                                                    <option value=<?php echo $value->id;?>><?php echo "".$value->id;?></option>
                                                <?php endforeach;?>
                                            <?php endif; ?>
                                        </select>
                                    </div> -->
                                    <div class="collapse " id="custome" aria-labelledby="customRadioInline2">
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <select name="c_vehicle_id" id="showReservedId" class="custom-select mb-2 "  >
                                                    <option value="">Select Vehicle ID</option>
                                                    <?php if(count($getReservedID) && count($getVehicleID)): ?>
                                                         <?php for($i=0; $i < sizeof($getReservedID);$i++):?>
                                                              <?php if($getReservedID->vehicle_id == $getVehicleID->registered_number):?>
                                                                    <option value=<?php echo $getReservedID[$i]->id;?>><?php echo "".$getVehicleID[$i]->registered_number;?></option>
                                                              <?php endif; ?>
                                                              <?php endfor;?>
                                                    <?php endif; ?>
                                                </select>
                                                <!-- <small class="text-danger"><?php echo form_error('c_vehicle_id'); ?></small> -->
                                            </div>
                                            <div class="col">
                                                <select name="c" id="showReservedId" class="custom-select" >
                                                    <option value="">Select Customer</option>
                                                    <?php if(count($getReservedID) && count($getCustomerDetails)): ?>
                                                         <?php for($i=0; $i < sizeof($getReservedID);$i++):?>
                                                              <?php if($getReservedID->customer_id == $getCustomerDetails->id):?>
                                                                    <option value=<?php echo $getReservedID[$i]->id;?>><?php echo "".$getCustomerDetails[$i]->nic;?></option>
                                                              <?php endif; ?>
                                                              <?php endfor;?>
                                                    <?php endif; ?>
                                                </select> 
                                                <!-- <small class="text-danger"><?php echo form_error('c'); ?></small>       -->
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
                                <button type="submit" class="btn btn-gradient-primary mr-2">Add</button>
                                <button class="btn btn-light">Cancel</button>
                            <?php echo form_close(); ?>   
                        </div>
                        
                        <div class="collapse row" id="EditDetails" aria-labelledby="customRadioInline2">
                            <br><br>
                            <div class="col-md-6">
                                <br><br>
                                <hr>
                                <!--<?php echo form_open('Damage/SearchDamageVehicle'); ?>-->
                                <?php echo form_open_multipart('Damage/SearchDamageVehicle'); ?>
                                <div class="form-group">
                                    <label for="exampleInputName1"><b>Search By Vehicle </b></label><br><br>
                                    <select name="vehicle_id" id="" class="custom-select mr-sm-2" required>
                                        <option value="">Select Vehicle ID</option>
                                        <?php if(count($getReservedID) && count($getVehicleID)): ?>
                                            <?php for($i=0; $i < sizeof($getReservedID);$i++):?>
                                                <?php if($getReservedID->vehicle_id == $getVehicleID->id):?>
                                                    <option value=<?php echo $getReservedID[$i]->id;?>><?php echo "".$getVehicleID[$i]->registered_number;?></option>
                                                <?php endif; ?>
                                            <?php endfor;?>
                                        <?php endif; ?>
                                    </select><br><br>
                                    <button class="btn btn-gradient-primary mdi mdi-car-wash mt-2"> Search</button>
                                </div> 
                                <center><img src="<?php echo base_url('assets/images/damage_default.png');?>" alt="" width="40%" height="230px"></center>
                                <?php echo form_close(); ?>                            
                            </div>
                            <div class="col-md-6">
                                <hr>
                                <!--<?php echo form_open('Damage/DamageVehicle'); ?>-->
                                <?php echo form_open_multipart('Damage/DamageVehicle'); ?>
                                
                                <font color='green'> You can see bellow Search Result..</font>
                                <div class="form-group">
                                    <label for="exampleSelectGender" class="mt-3"><b>Vehicle ID</b></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectGender" class="mt-0"><b>Nature of Damage</b></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectGender" class="mt-0"><b>Reported Date</b></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectGender" class="mt-0"><b>Reserved From</b></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectGender" class="mt-0"><b>Is Solved</b></label>
                                    <input type="text" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-gradient-primary mr-2">Edit</button>
                                <?php echo form_close(); ?>
                            </div>   
                        </div>    
                        <!--</div>-->
                       
                    </div>
                </div>
              </div>
        </div>
        <div class="row">
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

                        <div style="overflow-x:auto;">
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
                                                <td>
                                                    <?php for($i=0;$i < sizeof($getVehicleID);$i++): ?>
                                                        <?php if($values->vehicle_id == $getVehicleID[$i]->id):?>
                                                            <?php echo $getVehicleID[$i]->registered_number; ?>
                                                        <?php endif;?>
                                                    <?php endfor; ?>
                                                </td>
                                                <td><?php echo $values->d_date;?></td>
                                                <td><?php echo $values->description; ?></td>
                                                <td>
                                                    <?php for($i=0;$i < sizeof($getCustomerDetails);$i++): ?>
                                                        <?php if($values->reserved_id == $getCustomerDetails[$i]->id):?>
                                                            <?php echo $getCustomerDetails[$i]->nic; ?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                </td>
                                                <!--<td><input type="submit" name="" class="btn btn-success" value="View"></td>-->
                                                <td><?php echo $values->fix_amount." LKR/-"; ?></td>
                                                <td>
                                                    <?php
                                                            if($values->is_solved == 0)
                                                            {
                                                                echo "<b class='text-danger'>Not Yet</b>" ;
                                                            }
                                                            else
                                                                echo "<b class='text-success'>Yes</b>" ;
                                                    ?>
                                                </td>
                                                <td>
                                                    <a id="view"  href="<?php echo base_url("index.php/Damage/DamageReport/$values->id");?>" target="_blank"><span class="mdi mdi-note "> Get Report</span></a>
                                                    <a href="" id="view" data-toggle="collapse" href="#EditDetails" aria-expanded="false" aria-controls="viewDetails"><span class="mdi mdi-eyedropper text-success ml-4"> Edit</span></a>
                                                    <label class="cursor-pointer" data-toggle="modal" data-target="#deleteModal" onclick="delete_damage('<?php echo$values->id; ?>')"> <span class="mdi mdi-close-circle text-danger ml-4"> Remove</span> </label>
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
        </div>
        <?php if(validation_errors()) { ?>
        <script>
            document.getElementById("viewDetails").classList.add("show");
        </script>
        <?php } ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('Damage/prepareToDeleteDamage');?>
                <form>
                    <div class="modal-body">
                        Are you sure want to delete this recode.
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="deldamageid" id="deldamageid" required>
                        <button type="submit" class="btn btn-primary">Yes</button>
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                    </div>
                </form>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

<script type="text/javascript">
    function delete_damage(del_damage_id){
        document.getElementById("deldamageid").value = del_damage_id;
    }
</script>
    
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>