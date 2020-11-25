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
                  <i class="mdi mdi-car"></i>
                </span> Car </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span><i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <!-- add vehicle form -->
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <?php
                        if($this->session->flashdata('vehicle_status'))
                        {
                            ?>
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $this->session->flashdata('vehicle_status'); ?>
                            </div>
                            <br>
                            <?php
                        }
                        ?>

                        <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#addVehicle" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Vehicle Details</button>

                        <div class="collapse " id="addVehicle" aria-labelledby="customRadioInline2">
                        <?php echo form_open('Vehicle/add_vehicle');  ?>
                            <div class="form-group">
                                <label for="vehicleType">Type</label>
                                <input type="text" class="form-control" id="vehicleType" name="vehicleType" placeholder="Type" value="<?php if($this->session->tempdata('vehicleType_fill')) echo $this->session->tempdata('vehicleType_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('vehicleType'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleRegisteredNumber">Registered Number</label>
                                <input type="text" class="form-control" id="vehicleRegisteredNumber" name="vehicleRegisteredNumber" placeholder="Registered Number" value="<?php if($this->session->tempdata('vehicleRegisteredNumber_fill')) echo $this->session->tempdata('vehicleRegisteredNumber_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('vehicleRegisteredNumber'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleSeat">Seat</label>
                                <input type="number" class="form-control" min="1" id="vehicleSeat" name="vehicleSeat" placeholder="No of Seat" value="<?php if($this->session->tempdata('vehicleSeat_fill')) echo $this->session->tempdata('vehicleSeat_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('vehicleSeat'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleFuelType">Fuel Type</label>
                                <select class="form-control" id="vehicleFuelType" name="vehicleFuelType">
                                    <option>Petrol</option>
                                    <option>Diesel</option>
                                </select>
                                <small class="text-danger"><?php echo form_error('vehicleFuelType'); ?></small>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">A/C or Non-A/C</label>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="radioAC" id="ac" value="1" checked> A/C </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="radioAC" id="non_ac" value="0"> Non A/C </label>
                                    </div>
                                </div>
                                <small class="text-danger"><?php echo form_error('radioAC'); ?></small>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Transmission Type</label>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="radioTransmission" id="auto" value="A" checked> Auto </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="radioTransmission" id="manual" value="M"> Manual </label>
                                    </div>
                                </div>
                                <small class="text-danger"><?php echo form_error('radioTransmission'); ?></small>
                            </div>
                            <div class="form-group">
                                <label>Vehicle Image</label>
                                <input type="file" name="vehicleImage" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>
                                </div>
                                <small class="text-danger"><?php echo form_error('vehicleImage'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehiclePrice">Rental Price per Day</label>
                                <input type="number" class="form-control" id="vehiclePrice" name="vehiclePrice" placeholder="1000.00" value="<?php if($this->session->tempdata('vehiclePrice_fill')) echo $this->session->tempdata('vehiclePrice_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('vehiclePrice'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleAddKM">Additional Price</label>
                                <input type="number" class="form-control mb-2" id="vehicleAddKM" name="vehicleAddKM" placeholder="Per KM" value="<?php if($this->session->tempdata('vehicleAddKM_fill')) echo $this->session->tempdata('vehicleAddKM_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('vehicleAddKM'); ?></small>
                                <input type="number" class="form-control" id="vehicleAddHour" name="vehicleAddHour" placeholder="Per Hour" value="<?php if($this->session->tempdata('vehicleAddHour_fill')) echo $this->session->tempdata('vehicleAddHour_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('vehicleAddHour'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleInsurance">Insurance Date</label>
                                <input type="date" class="form-control" id="vehicleInsurance" name="vehicleInsurance" placeholder="Insurance Date" value="<?php if($this->session->tempdata('vehicleInsurance_fill')) echo $this->session->tempdata('vehicleInsurance_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('vehicleInsurance'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleLicense">Revenue License Date</label>
                                <input type="date" class="form-control" id="vehicleLicense" name="vehicleLicense" placeholder="Revenue License Date" value="<?php if($this->session->tempdata('vehicleLicense_fill')) echo $this->session->tempdata('vehicleLicense_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('vehicleLicense'); ?></small>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Reset</button>

                        <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- view table -->
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Vehicle Details</h4>
                        <div style="overflow-x:auto;">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Registered Number</th>
                                    <th>No of Seat</th>
                                    <th>Fuel Type</th>
                                    <th>A/C or Non-A/C</th>
                                    <th>Transmission Type</th>
                                    <th>Rental Price per Day</th>
                                    <th>Additional Price per KM</th>
                                    <th>Additional Price per Hour</th>
                                    <th>System Registered Date</th>
                                    <th>Insurance Date</th>
                                    <th>Revenue License Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($vehicle_data->num_rows() > 0) {
                                    foreach ($vehicle_data->result() as $data_row){
                                        ?>
                                        <tr>
                                            <td><?php echo $data_row->id; ?></td>
                                            <td><?php echo $data_row->title; ?></td>
                                            <td><?php echo $data_row->registered_number; ?></td>
                                            <td><?php echo $data_row->seat; ?></td>
                                            <td><?php if($data_row->fuel_type == 'P') echo "Petrol"; else echo "Diesel"; ?></td>
                                            <td><?php if($data_row->ac == 'A') echo "AC"; else echo "Non A/C"; ?></td>
                                            <td><?php if($data_row->transmission == 'A') echo "Auto"; else echo "Manual"; ?></td>
                                            <td><?php echo $data_row->price_per_day; ?></td>
                                            <td><?php echo $data_row->additional_price_per_km; ?></td>
                                            <td><?php echo $data_row->additional_price_per_hour; ?></td>
                                            <td><?php echo $data_row->system_registered_date; ?></td>
                                            <td><?php echo $data_row->insurence_date; ?></td>
                                            <td><?php echo $data_row->revenue_license_date; ?></td>
                                            <td>
                                                <a href=""><span class="mdi mdi-eyedropper text-success"> Edit</span></a>
                                                <a href="<?php echo base_url('index.php/Vehicle/delete_vehicle/'.$data_row->id); ?>"><span class="mdi mdi-close-circle text-danger ml-4"> Remove</span></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="14">No Data Found</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <?php if(validation_errors()) { ?>
            <script>
                document.getElementById("addVehicle").classList.add("show");
            </script>
        <?php } ?>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>