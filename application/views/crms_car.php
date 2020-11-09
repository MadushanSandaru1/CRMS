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
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                            <div class="alert alert-success">
                                <?php echo $this->session->flashdata('vehicle_status'); ?>
                            </div>
                            <?php
                        }
                        ?>
                        <br>
                        <h4 class="card-title text-danger mb-5">Add Vehicle Details</h4>
                        <?php echo validation_errors(); ?>
                        <?php echo form_open('Vehicle/add_vehicle');  ?>
                            <div class="form-group">
                                <label for="vehicleType">Type</label>
                                <input type="text" class="form-control" id="vehicleType" name="vehicleType" placeholder="Type">
                            </div>
                            <div class="form-group">
                                <label for="vehicleRegisteredNumber">Registered Number</label>
                                <input type="text" class="form-control" id="vehicleRegisteredNumber" name="vehicleRegisteredNumber" placeholder="Registered Number">
                            </div>
                            <div class="form-group">
                                <label for="vehicleSeat">Seat</label>
                                <input type="number" class="form-control" min="1" id="vehicleSeat" name="vehicleSeat" placeholder="No of Seat">
                            </div>
                            <div class="form-group">
                                <label for="vehicleFuelType">Fuel Type</label>
                                <select class="form-control" id="vehicleFuelType" name="vehicleFuelType">
                                    <option>Petrol</option>
                                    <option>Diesel</option>
                                </select>
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
                            </div>
                            <div class="form-group">
                                <label for="vehiclePrice">Rental Price per Day</label>
                                <input type="number" class="form-control" id="vehiclePrice" name="vehiclePrice" placeholder="1000.00">
                            </div>
                            <div class="form-group">
                                <label for="vehicleAddKM">Additional Price</label>
                                <input type="number" class="form-control mb-2" id="vehicleAddKM" name="vehicleAddKM" placeholder="Per KM">
                                <input type="number" class="form-control" id="vehicleAddHour" name="vehicleAddHour" placeholder="Per Hour">
                            </div>
                            <div class="form-group">
                                <label for="vehicleInsurance">Insurance Date</label>
                                <input type="date" class="form-control" id="vehicleInsurance" name="vehicleInsurance" placeholder="Insurance Date">
                            </div>
                            <div class="form-group">
                                <label for="vehicleLicense">Revenue License Date</label>
                                <input type="date" class="form-control" id="vehicleLicense" name="vehicleLicense" placeholder="Revenue License Date">
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Reset</button>
                        <?php echo form_close();  ?>
                    </div>
                </div>
            </div>

            <!-- view table -->
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Vehicle Details</h4></p>
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
                                    <a href=""><span class="mdi mdi-eyedropper "> Edit</span></a>
                                    <a href=""><span class="mdi mdi-close-circle ml-4"> Remove</span></a>
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
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>