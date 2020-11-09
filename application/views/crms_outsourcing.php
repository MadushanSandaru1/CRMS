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
                  <i class="mdi mdi-clipboard-arrow-down"></i>
                </span> Car Outsourcing </h3>
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
                            <h4 class="card-title text-danger mb-5">Add Outsourcing Vehicle Details</h4>
                            <div class="custom-control custom-radio custom-control-inline">

                                <input type="button" value="New Outsourcing Vehicle" class="btn btn-primary" id="view" data-toggle="collapse" href="#viewDetails" aria-expanded="false" aria-controls="viewDetails">

                            </div>
                            <div class="collapse " id="viewDetails" aria-labelledby="customRadioInline2">
                                <br><br>
                                <?php echo form_open_multipart('VehicleOutsource/outsourcingVehicle'); ?>
                                <div class="forms-sample">
                                    <div class="form-group">
                                        <label for="vehicleTitle">Title</label>
                                        <input type="text" class="form-control" id="vehicleTitle" placeholder="Vehicle Title" name="vehicle_title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleRegisteredNumber">Registered Number</label>
                                        <input type="text" class="form-control" id="vehicleRegisteredNumber" placeholder="Registered Number" name="registered_no" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleSeat">Seat</label>
                                        <input type="number" class="form-control" id="vehicleSeat" placeholder="No of Seat" name="no_of_seat" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleFuelType">Fuel Type</label>
                                        <select class="form-control" id="vehicleFuelType" name="fuel_type" required>
                                            <option value="P">Petrol</option>
                                            <option value="D">Diesel</option>
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
<!--                                        <input type="file" name="img[]" class="">-->
                                        <div class="input-group col-xs-12">
                                            <input type="file" class="form-control file-upload-info"  placeholder="Upload Image" name="outsource_pic" required>
<!--                                            <span class="input-group-append">-->
<!--                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>-->
                                    </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehiclePrice">Rental Price per Day</label>
                                        <input type="number" class="form-control" id="vehiclePrice" placeholder="1000.00" name="price_per_day" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleAddKM">Additional Price</label>
                                        <input type="number" class="form-control mb-2" id="vehicleAddKM" placeholder="Per KM" name="per_km" required>
                                        <input type="number" class="form-control" id="vehicleAddHour" placeholder="Per Hour" name="per_hour" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleInsurance">Insurance Date</label>
                                        <input type="date" class="form-control" id="vehicleInsurance" placeholder="Insurance Date" name="insurence_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleLicense">Revenue License Date</label>
                                        <input type="date" class="form-control" id="vehicleLicense" placeholder="Revenue License Date" name="revenue_licence_date" required>
                                    </div>
                                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                                    <button type="reset" class="btn btn-light">Reset</button>
                                </div>
                                <?php echo form_close(); ?>
                            </div>

                        </div>
                    </div>
                </div>

        </div>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>