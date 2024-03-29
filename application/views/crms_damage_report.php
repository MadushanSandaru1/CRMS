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
                  <i class="mdi mdi-clipboard-text"></i>
                </span> Damage Report </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span><i class="mdi mdi-clock icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Damage Report Generation</h4>
                        <!--<p class="card-description"> Basic form layout </p>-->  
                        <br>

                        <!--<div class="alert alert-danger">-->
                            <!-- <?php 
                                    if(!empty(validation_errors()))
                                        echo "<span style='color:red;'>".validation_errors()."</span>"; 
                            ?> -->
                        <!--</div>-->
                        <?php echo form_open('Damage_Report/GenerateDamageReport'); ?>
                            `<div class="form-group">
                                <label for="exampleInputUsername1"><b>Vahicle ID</b></label>
                                <select class="custom-select" name="vehicle_id">
                                    <option disabled selected hidden>Select Vehicle ID</option>
                                    <?php
                                    if($getVehicleID) {
                                        foreach ($getVehicleID as $data_row) {

                                            if ($this->session->tempdata('expenseVehicleID_fill')) {
                                                if ($this->session->tempdata('expenseVehicleID_fill')==$data_row->id) {
                                                    echo "<option value='".$data_row->id."' selected>".$data_row->id." - ".$data_row->registered_number."</option>";
                                                } else {
                                                    echo "<option value='".$data_row->id."'>".$data_row->id." - ".$data_row->registered_number."</option>";
                                                }

                                            }else{
                                                echo "<option value='".$data_row->id."'>".$data_row->id." - ".$data_row->registered_number."</option>";
                                            }

                                        }
                                    } else {
                                        echo "<option disabled selected hidden>Data not found</option>";
                                    }
                                    ?>
                                </select>
                                 <small class="text-danger"><?php echo form_error('vehicle_id'); ?></small>
                            </div>`
                            <div class="form-group">
                                    <label for="exampleInputEmail1"><b>Time Specification</b></label><br><br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="get_time" value="all" class="" data-toggle="collapse"  href="#custome" aria-expanded="false" aria-controls="collapseExample "  checked>
                                        <label class="ml-2" for="customRadioInline1" data-toggle="tooltip" data-placement="top" title="Its return all the records">Regular</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="get_time" value="customize" class="" data-toggle="collapse" href="#custome" aria-expanded="false" aria-controls="custom ">
                                        <label class="ml-2" for="customRadioInline2" data-toggle="tooltip" data-placement="top" title="You can get recored for specific time time"> Specific Time  Duration</label>
                                    </div>
                                    
                                    <div class="collapse " id="custome" aria-labelledby="customRadioInline2">
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <input type="date" name="start_date" class="form-control" value="9" max="<?php echo Date('Y-m-d',time()) ?>">
                                            </div>
                                            <div class="col">
                                                <input type="date" name="end_date" class="form-control" max="<?php echo Date('Y-m-d',time()) ?>">
                                            </div>
                                        </div>
                                    
                                    
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1"><b>Include Damage Picture</b></label>
                                <select class="custom-select" name = "is_include_damage_picture">
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"><b>Types of Solved</b></label>
                                <select class="custom-select" name="is_solved_type">
                                    <option value="all">All</option>
                                    <option value="solved">Solved Damages</option>
                                    <option value="not_solved">Not Solved Damages</option>
                                </select>
                            </div>
                      
                      
                            <a href="" target="_blank"><button type="submit" class="btn btn-gradient-primary mr-2">Generate</button></a>
                            <button class="btn btn-light">Cancel</button>
                        <?php echo form_close(); ?>   
                    </div>
                </div>
            </div>

            <!-- Table part -->
          
        </div>

    </div>
    <!-- content-wrapper ends -->
    
    
<?php require_once 'crms_footer.php';?>