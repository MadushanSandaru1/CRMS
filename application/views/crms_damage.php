<?php

    //session timeout error
    if (!$this->session->userdata('user_id')) {
        $this->session->set_flashdata('user_status', 'Session timeout');

        //redirect to sign in page
        redirect('Home/crms_signin');
    }

?>
<?php
    $vehicle_reg="";
    $cus_name ="";
    $cus_nic="";
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

        <div class="row" id="add_damage">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title text-danger" >Registration of Vehicle Damage Details</h4><br><br> -->
                        <!--<p class="card-description"> Basic form elements </p>-->
                        <!--<div class="alert alert-danger">-->
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
                        <div class="custom-control custom-radio custom-control-inline">
                            <button  class="btn btn-primary mb-2" id="view" data-toggle="collapse" href="#viewDetails" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i>Add Damage Details </button>

                        </div>
                        <br>
                        <div class="collapse " id="viewDetails" aria-labelledby="customRadioInline2">
                            
                            <br><br>
                            <!--<?php echo form_open('Damage/DamageVehicle'); ?>-->
                                <?php echo form_open_multipart('Damage/DamageVehicle'); ?>
                                <div class="form-group">
                                    <label for="exampleInputName1"><b>Vehicle ID</b></label>
                                    <select name="vehicle_id" id="" class="custom-select mr-sm-2" >
                                        <option disabled selected hidden>Select Vehicle ID</option>
                                        <?php if(count($getVehicleID)): ?>
                                            <?php foreach($getVehicleID as $value):?>
                                                <?php
                                                if($this->session->tempdata('u_vehicle_id_fill')) {
                                                    if($this->session->tempdata('u_vehicle_id_fill') == $value->id)
                                                    {
                                                        echo "<option value='".$value->id."' selected>".$value->id." - ".$value->registered_number."</option>";
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='".$value->id."'>".$value->id." - ".$value->registered_number."</option>";
                                                    }

                                                }
                                                else
                                                {
                                                    echo "<option value='".$value->id."'>".$value->id." - ".$value->registered_number."</option>";
                                                }
                                                ?>
                                            <?php endforeach;?>
                                        <?php else: ?>
                                            <option disabled selected hidden>Data not found</option>
                                        <?php endif; ?>
                                    </select>
                                    <small class="text-danger"><?php echo form_error('vehicle_id'); ?></small>
                                </div>
                            
                            
                                <div class="form-group">
                                    <label for="exampleSelectGender"><b>Nature of Damage</b></label>
                                    <select class="custom-select mr-sm-2" id="exampleSelectGender" name="description" value="<?php if($this->session->tempdata('description_fill')) echo $this->session->tempdata('description_fill'); ?>">
                                        <option disabled selected hidden>Select Damage Type</option>
                                        <?php
                                            if($this->session->tempdata('u_description_fill')) echo $this->session->tempdata('u_description_fill');
                                        ?>
                                        <option values="left or Right Signal light">left or Right Signal light</option>
                                        <option values="Door damage">Door damage</option>
                                        <option value="Left and Right Side mirror damages">Left and Right Side mirror damages</option>
                                    </select>
                                    <small class="text-danger"><?php echo form_error('description'); ?></small>
                                </div>

                                <div class="form-group">
                                    <label><b>Upload Damage Vehicle Picture</b></label>
                                    <input type="file" name="image_file" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                        <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>
                                    </div>
                                    <small class="text-danger"><?php echo form_error('image_file'); ?></small>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCity1"><b>Reserved From</b></label><br><br>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="chooser" class="custom-control-input" data-toggle="collapse" href="#custome" aria-expanded="false" aria-controls="custom " >
                                        <label class="mdi mdi-swap-vertical " for="customRadioInline2">Custom Choose </label>
                                        
                                    </div>
                                    <small class="text-danger"><?php echo form_error('chooser'); ?></small>

                                    <div class="collapse " id="custome" aria-labelledby="customRadioInline2">
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <select name="c_vehicle_id" id="showReservedId" class="custom-select mb-2 "  value="<?php if($this->session->tempdata('c_vehicle_id_fill')) echo $this->session->tempdata('c_vehicle_id_fill'); ?>">
                                                    <option disabled selected hidden>Select Vehicle ID</option>
                                                    <?php if(count($getReservedID) && count($getVehicleID) || count($getCustomerDetails)): ?>
                                                         <?php for($i=0; $i < sizeof($getReservedID);$i++):?>
                                                              <?php if($getReservedID->vehicle_id == $getVehicleID->registered_number || $getReservedID->customer_id == $getCustomerDetails->id):?>
                                                                <?php
                                                                if($this->session->tempdata('uc_vehicle_id_fill'))
                                                                {
                                                                    if ($this->session->tempdata('uc_vehicle_id_fill')==$getReservedID->id) {
                                                                        echo "<option value='".$getReservedID->id."' selected>".$getReservedID->id." - ".$getVehicleID->registered_number."</option>";
                                                                    }
                                                                    else
                                                                        echo "<option value=".$getReservedID[$i]->id.">".$getReservedID[$i]->id." - ".$getVehicleID[$i]->registered_number." (". $getCustomerDetails[$i]->nic.")"."</option>";
                                                                }
                                                                else
                                                                    echo "<option value=".$getReservedID[$i]->id.">".$getReservedID[$i]->id." - ".$getVehicleID[$i]->registered_number." (". $getCustomerDetails[$i]->nic.")"."</option>";
                                                                ?>
                                                              <?php endif; ?>
                                                              <?php endfor;?>
                                                    <?php else: ?>
                                                        <option disabled selected hidden>Data not found</option>
                                                    <?php endif; ?>
                                                </select>
                                                <!-- <small class="text-danger"><?php echo form_error('c_vehicle_id'); ?></small> -->
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
                                        <input type="text" name="fix_amount" id="" class="form-control" value="<?php if($this->session->tempdata('fix_amount_fill')) echo $this->session->tempdata('fix_amount_fill'); ?>" placeholder="Enter pay amount">
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectGender"><b>Is damage solved</b></label><br><br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="checkbox" id="damage_solved" name="is_solved" class="" data-toggle="collapse" href="#solved" aria-expanded="false" aria-controls="solved" value="1">
                                        <label for="exampleInputCity1 "> Yes</label>
                                    </div>
                                    <div class="collapse " id="solved" aria-labelledby="solved">
                                        <br>
                                        <input type="text" name="solved_amount" id="" class="form-control"  placeholder="Enter solved amount" value="<?php if($this->session->tempdata('solved_amount_fill')) echo $this->session->tempdata('solved_amount_fill'); ?>">

                                    </div>

                                </div>
                                <button type="submit" class="btn btn-gradient-primary mr-2">Add</button>
                                <input type="reset" class="btn btn-light" value="Cancel">
                            <?php echo form_close(); ?>   
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="update_damage">
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
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="button" value="Update Damage Details" class="btn btn-primary mb-2 ml-0" id="update_damage" data-toggle="collapse" href="#EditDetails" aria-expanded="false" aria-controls="EditDetails">
                        </div>

                        <div class="collapse row" id="EditDetails" aria-labelledby="customRadioInline2">
                            <br><br>
                            <div class="col-md-12">
                                <hr>
                                <?php echo form_open_multipart('Damage/updateDamageVehicle'); ?>
                                <div class="form-group">
                                    <input type="hidden" name="damage_id" id="damage_id">
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectGender" class="mt-3"><b>Vehicle ID</b></label>
                                    <select name="u_vehicle_id" id="u_vehicle_id" class="custom-select mr-sm-2" >
                                        <option disabled selected hidden>Select Vehicle ID</option>
                                        <?php if(count($getVehicleID)): ?>
                                            <?php foreach($getVehicleID as $value):?>
                                                <?php
                                                    if($this->session->tempdata('u_vehicle_id_fill')) {
                                                        if($this->session->tempdata('u_vehicle_id_fill') == $value->id)
                                                        {
                                                            echo "<option value='".$value->id."' selected>".$value->id." - ".$value->registered_number."</option>";
                                                        }
                                                        else
                                                        {
                                                            echo "<option value='".$value->id."'>".$value->id." - ".$value->registered_number."</option>";
                                                        }

                                                    }
                                                    else
                                                    {
                                                        echo "<option value='".$value->id."'>".$value->id." - ".$value->registered_number."</option>";
                                                    }
                                                ?>
                                            <?php endforeach;?>
                                        <?php else: ?>
                                            <option disabled selected hidden>Data not found</option>
                                        <?php endif; ?>
                                    </select>
                                    <small class="text-danger"><?php echo form_error('vehicle_id'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectGender" class="mt-0"><b>Nature of Damage</b></label>
                                    <select class="custom-select mr-sm-2" id="u_description" name="u_description" >
                                        <option disabled selected hidden>Select Vehicle ID</option>
                                        <option values="left or Right Signal light">left or Right Signal light</option>
                                        <option values="Door damage">Door damage</option>
                                        <option value="Left and Right Side mirror damages">Left and Right Side mirror damages</option>
                                    </select>
                                    <small class="text-danger"><?php echo form_error('description'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectGender" class="mt-0"><b>Reported Date</b></label>
                                    <input type="date" class="form-control" name="u_reported_date" id="reported_date">
                                    <small class="text-danger"><?php echo form_error('reported_date'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label><b>Upload Damage Vehicle Picture</b></label>
                                    <input type="file" name="u_image_file" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Damage Vehicle Image(jpg|png|jpeg)">
                                        <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>
                                    </div>
                                    <small class="text-danger"><?php echo form_error('u_image_file'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCity1"><b>Reserved From</b></label><br><br>
                                    <select name="uc_vehicle_id" id="c_showReservedId" class="custom-select mb-2 "  value="<?php if($this->session->tempdata('uc_vehicle_id_fill')) echo $this->session->tempdata('uc_vehicle_id_fill'); ?>">
                                        <option disabled selected hidden>Select Vehicle ID</option>
                                        <?php if(count($getReservedID) && count($getVehicleID) || count($getCustomerDetails)): ?>

                                            <?php for($i=0; $i < sizeof($getReservedID);$i++):?>
                                                <?php if($getReservedID->vehicle_id == $getVehicleID->registered_number || $getReservedID->customer_id == $getCustomerDetails->id):?>
                                                    <?php
                                                    if($this->session->tempdata('uc_vehicle_id_fill'))
                                                    {
                                                        if ($this->session->tempdata('uc_vehicle_id_fill')==$getReservedID->id) {
                                                            echo "<option value='".$getReservedID->id."' selected>".$getReservedID->id." - ".$getVehicleID->registered_number."</option>";
                                                        }
                                                        else
                                                            echo "<option value=".$getReservedID[$i]->id.">".$getReservedID[$i]->id." - ".$getVehicleID[$i]->registered_number." (". $getCustomerDetails[$i]->nic.")>"."</option>";
                                                    }
                                                    else
                                                        echo "<option value=".$getReservedID[$i]->id.">".$getReservedID[$i]->id." - ".$getVehicleID[$i]->registered_number." (". $getCustomerDetails[$i]->nic.")>"."</option>";
                                                    ?>

                                                <?php endif; ?>
                                            <?php endfor;?>
                                        <?php else: ?>
                                            <option disabled selected hidden>Data not found</option>
                                        <?php endif; ?>
                                    </select>
                                    <!-- <small class="text-danger"><?php echo form_error('c_vehicle_id'); ?></small> -->

                                </div>

                                <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                                <input type="reset" class="btn btn-light" value="Cancel">
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
                                        <th>Customer Paid Amount</th>
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
                                                            <?php
                                                                echo $getVehicleID[$i]->registered_number;
                                                                $vehicle_reg = $getVehicleID[$i]->registered_number;
                                                            ?>
                                                        <?php endif;?>
                                                    <?php endfor; ?>
                                                </td>
                                                <td><?php echo $values->d_date;?></td>
                                                <td><?php echo $values->description; ?></td>
                                                <td>
                                                    <?php for($i=0;$i < sizeof($getCustomerDetails);$i++): ?>
                                                        <?php if($values->reserved_id == $getCustomerDetails[$i]->id):?>
                                                            <?php
                                                                echo $getCustomerDetails[$i]->nic;
                                                                $cus_nic =$getCustomerDetails[$i]->nic;
                                                            ?>
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
                                                    <?php if($values->is_solved == 0):?>
                                                        <label class="cursor-pointer" data-toggle="modal" data-target="#solvedModal" onclick="solved_damage('<?php echo $values->id;?>','<?php echo $values->vehicle_id;?>','<?php echo $vehicle_reg;?>','<?php echo $cus_nic;?>','<?php echo $values->fix_amount;?>')"> <span class="mdi mdi-car-wash text-dark ml-4 mr-4"> Solve Damage</span> </label>
                                                    <?php endif;?>
                                                    <a id="view"  href="<?php echo base_url("index.php/Damage/DamageReport/$values->id");?>" target="_blank"><span class="mdi mdi-note "> Get Report</span></a>
                                                    <a  id="view" data-toggle="collapse" href="#EditDetails" aria-expanded="false" aria-controls="EditDetails"><span class="mdi mdi-eyedropper text-success ml-4" onclick="update_damage('<?php echo $values->id;?>','<?php echo $values->vehicle_id;?>','<?php echo $values->description;?>','<?php echo $values->d_date;?>','<?php echo $values->reserved_id;?>')"> Edit</span></a>
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
    <div class="modal fade" id="solvedModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Solved Damage</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('Damage/prepareToSolvedDamage');?>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="soldamageid" id="soldamageid" required>
                                <input type="hidden" name="soldid" id="soldid" required>
                                Vehicle No <br>
                                <input type="text" name="soldvehicleid" id="soldvehicleid" required class="form-control mt-2 mb-2" readonly>
                                Customer NIC  <br>
                                <input type="text" name="soldcusnic" id="soldcusnic" required class="form-control mt-2 mb-2" readonly>
                                Customer Paid <br>
                                <input type="text" name="customer_paid" id="soldfix" required class="form-control mt-2 mb-1" readonly><br>
                                solve Price <br>
                                <input type="text" name="solve_price" id="" required class="form-control mt-2 mb-2" ><br>

                                <button type="submit" class="btn btn-primary">Solve</button>
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

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

    function solved_damage(d_id,sol_damage_id,sol_vehicle_id,sol_reserved_id,sol_fix_amount){
        document.getElementById("soldid").value = d_id;
        document.getElementById("soldamageid").value = sol_damage_id;
        document.getElementById("soldvehicleid").value = sol_vehicle_id;
        document.getElementById("soldcusnic").value = sol_reserved_id;
        document.getElementById("soldfix").value = sol_fix_amount;
    }

    function update_damage(id,update_vehicle_id,update_description,d_date,res_id){

        //display form if clickd edit in view table
        document.getElementById("add_damage").style.display = "none";
        document.getElementById("update_damage").style.display = "block";

        //load data into form
        document.getElementById("damage_id").value = id;
        document.getElementById("u_vehicle_id").value = update_vehicle_id;
        document.getElementById("u_description").value = update_description;
        document.getElementById("reported_date").value = d_date;
        document.getElementById("c_showReservedId").value = res_id;

    }
</script>
    
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>
<?php  if ($this->session->tempdata('form')=='add_form') { ?>
    <script>
        document.getElementById("add_damage").style.display = "block";
        document.getElementById("update_damage").style.display = "none";

    </script>
<?php }else if($this->session->tempdata('form')=='update_form'){ ?>
    <script>
        document.getElementById("update_damage").style.display = "block";
        document.getElementById("add_damage").style.display = "none";

    </script>
<?php }else{ ?>
    <script>
        document.getElementById("add_damage").style.display = "block";
        document.getElementById("update_damage").style.display = "none";
    </script>
<?php } ?>
