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
                </span> Car Damage </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style = "color :#F7396F;">Registration of Vehicle Damage Details</h4><br><br>
                        <!--<p class="card-description"> Basic form elements </p>-->
                        <div class="alert alert-danger">
                            <?php 
                                    if(!empty(validation_errors()))
                                        echo validation_errors(); 
                            ?>
                        </div>
                        <?php echo form_open('Damage/DamageVehicle'); ?>
                        
                            <div class="form-group">
                                <label for="exampleInputName1">Vehicle ID</label>
                                <select name="vehicle_id" id="" class="form-control">
                                    <option value="001">001</option>
                                    <option value="002">002</option>
                                </select>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="exampleSelectGender">Nature of Damage</label>
                                <select class="form-control" id="exampleSelectGender" name="description">
                                    <option values="left or Right Signal light">left or Right Signal light</option>
                                    <option values="Door damage">Door damage</option>
                                    <option value="Left and Right Side mirror damages">Left and Right Side mirror damages</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Upload Damage Vehicle Picture</label>
                                <input type="file" name="img[]" class="file-upload-default" name="image_file">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCity1">Reserved ID</label>
                                <select name="reserved_id" id="">
                                    <option value="">RV001</option>
                                    <option value="">RV002</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCity1">Fix Amount</label>
                                <input type="text" class="form-control" id="exampleInputCity1" placeholder="Enter fix amount" name="fix_amount">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Is damage solved</label>
                                <select class="form-control" id="exampleSelectGender" name="is_solved">
                                    <option values="yes">Yes of Course!</option>
                                    <option values="no">No Still it remaining </option>
                                    
                                </select>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Register</button>
                            <button class="btn btn-light">Cancel</button>
                         <?php echo form_close(); ?>   
                    </div>
                </div>
              </div>
        </div>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>