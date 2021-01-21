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
                    <span></span><i class="mdi mdi-clock icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row" >
        <div class="col-12 grid-margin stretch-card" id="add_outsource_vehicle">
            <div class="card">
                <div class="card-body">
                    <?php
                    if($this->session->flashdata('outsource_status'))
                    {
                        ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('outsource_status'); ?>
                        </div>
                        <?php
                    }
                    ?>
                    <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#addOutsourcingVehicle" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Outsourcing Vehicle Details</button>

                    <div class="collapse " id="addOutsourcingVehicle" aria-labelledby="customRadioInline2">
                        <br><br>
                        <?php echo form_open_multipart('VehicleOutsource/outsourcingVehicle'); ?>
                        <div class="forms-sample">
                            <div class="form-group">
                                <label for="vehicleTitle">Supplier</label>
                                <select name="supplier_id" id="" class="custom-select">
                                    <option disabled selected hidden>Select Supplier</option>
                                    <?php for($i=0;$i < sizeof($supplier);$i++): ?>
                                        <option value=<?php echo $supplier[$i]->id;?>><?php echo $supplier[$i]->name;?></option>
                                    <?php endfor;?>
                                </select>
                                <small class="text-danger"><?php echo form_error('supplier_id'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleTitle">Title</label>
                                <input type="text" class="form-control" id="vehicleTitle" placeholder="Vehicle Title" name="vehicle_title" value="<?php if($this->session->tempdata('title_fill')) echo $this->session->tempdata('title_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('vehicle_title'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleRegisteredNumber">Registered Number</label>
                                <input type="text" class="form-control" id="vehicleRegisteredNumber" maxlength="15" pattern="[A-Za-z]{2} [A-Za-z]{2,3}[0-9]{4}" placeholder="SP ABC1234" name="registered_no" value="<?php if($this->session->tempdata('registered_no_fill')) echo $this->session->tempdata('registered_no_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('registered_no'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleSeat">Seat</label>
                                <input type="number" class="form-control" min="4" id="vehicleSeat" placeholder="No of Seat" name="no_of_seat" value="<?php if($this->session->tempdata('no_of_seat_fill')) echo $this->session->tempdata('no_of_seat_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('no_of_seat'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleFuelType">Fuel Type</label>
                                <select class="custom-select" id="vehicleFuelType" name="fuel_type" value="<?php if($this->session->tempdata('fuel_type_fill')) echo $this->session->tempdata('fuel_type_fill'); ?>">
                                    <option value="">Select Fuel Type</option>
                                    <option value="P">Petrol</option>
                                    <option value="D">Diesel</option>
                                </select>
                                <small class="text-danger"><?php echo form_error('fuel_type'); ?></small>
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

<<<<<<< Updated upstream
                            <div class="form-group">
                                <label>Vehicle Image</label>
                                <input type="file" name="outsource_pic" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>
=======
        <div class="row" >
                <div class="col-12 grid-margin stretch-card" id="add_outsource_vehicle">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if($this->session->flashdata('outsource_status'))
                            {
                                ?>
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('outsource_status'); ?>
>>>>>>> Stashed changes
                                </div>
                                <small class="text-danger"><?php echo form_error('outsource_pic'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehiclePrice">Rental Price per Day</label>
                                <input type="number" min="0" class="form-control" id="vehiclePrice" placeholder="1000.00" step="0.01" name="price_per_day" value="<?php if($this->session->tempdata('price_per_day_fill')) echo $this->session->tempdata('price_per_day_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('price_per_day'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleAddKM">Additional Price</label>
                                <input type="number" min="0" class="form-control mb-2" id="vehicleAddKM" placeholder="Per KM" step="0.01" name="per_km" value="<?php if($this->session->tempdata('per_km_fill')) echo $this->session->tempdata('per_km_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('per_km'); ?></small>
                                <input type="number" min="0" class="form-control" id="vehicleAddHour" placeholder="Per Hour" step="0.01" name="per_hour" value="<?php if($this->session->tempdata('per_hour_fill')) echo $this->session->tempdata('per_hour_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('per_hour'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleInsurance">Insurance Date</label>
                                <input type="date" class="form-control" id="vehicleInsurance" placeholder="Insurance Date" name="insurence_date" max="<?php echo Date('Y-m-d',time()) ?>" value="<?php if($this->session->tempdata('insurence_date_fill')) echo $this->session->tempdata('insurence_date_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('insurence_date'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleLicense">Revenue License Date</label>
                                <input type="date" class="form-control" id="vehicleLicense" placeholder="Revenue License Date" name="revenue_license_date" max="<?php echo Date('Y-m-d',time()) ?>" value="<?php if($this->session->tempdata('revenue_license_date_date_fill')) echo $this->session->tempdata('revenue_license_date_date_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('revenue_license_date'); ?></small>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Reset</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 grid-margin stretch-card" id="update_outsource_vehicle">
            <div class="card">
                <div class="card-body">
                    <?php
                    if($this->session->flashdata('outsource_status'))
                    {
                        ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('outsource_status'); ?>
                        </div>
                        <?php
                    }
                    ?>
                    <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#updateOutsourcingVehicle" aria-expanded="false" aria-controls="viewDetails">Update Outsourcing Vehicle Details</button>

                    <div class="collapse " id="updateOutsourcingVehicle" aria-labelledby="customRadioInline2">
                        <br><br>
                        <?php echo form_open_multipart('VehicleOutsource/updateOutsourcingVehicle'); ?>
                        <div class="forms-sample">
                            <div class="form-group">
                                <input type="hidden" name="u_outsource_id" id="u_outsource_id">
                            </div>
                            <div class="form-group">
                                <label for="vehicleTitle">Supplier</label>
                                <select name="update_supplier_id" id="update_supplier_id" class="form-control ">
                                    <option value="">Select Supplier..</option>
                                    <?php for($i=0;$i < sizeof($supplier);$i++): ?>
                                        <option value=<?php echo $supplier[$i]->id;?>><?php echo $supplier[$i]->name;?></option>
                                    <?php endfor;?>
                                </select>
                                <small class="text-danger"><?php echo form_error('supplier_id'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleTitle">Title</label>
                                <input type="text" class="form-control" id="u_vehicleTitle" placeholder="Vehicle Title" name="u_vehicleTitle" value="<?php if($this->session->tempdata('u_title_fill')) echo $this->session->tempdata('u_title_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('vehicle_title'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleRegisteredNumber">Registered Number</label>
                                <input type="text" class="form-control" id="u_vehicleRegisteredNumber" maxlength="15" pattern="[A-Za-z]{2} [A-Za-z]{2,3}[0-9]{4}" placeholder="SP ABC1234" name="u_vehicleRegisteredNumber" value="<?php if($this->session->tempdata('u_registered_no_fill')) echo $this->session->tempdata('u_registered_no_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('registered_no'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleSeat">Seat</label>
                                <input type="number" class="form-control" id="u_vehicleSeat" min="4" placeholder="No of Seat" name="u_vehicleSeat" value="<?php if($this->session->tempdata('u_no_of_seat_fill')) echo $this->session->tempdata('u_no_of_seat_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('no_of_seat'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleFuelType">Fuel Type</label>
                                <select class="form-control" id="u_vehicleFuelType" name="u_vehicleFuelType" value="<?php if($this->session->tempdata('u_fuel_type_fill')) echo $this->session->tempdata('u_fuel_type_fill'); ?>">
                                    <option value="">Select Fuel Type</option>
                                    <option value="P">Petrol</option>
                                    <option value="D">Diesel</option>
                                </select>
                                <small class="text-danger"><?php echo form_error('fuel_type'); ?></small>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">A/C or Non-A/C</label>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="u_radioAC" id="ac" value="1" checked> A/C </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="u_radioAC" id="non_ac" value="0"> Non A/C </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Transmission Type</label>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="u_radioTransmission" id="auto" value="A" checked> Auto </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="u_radioTransmission" id="manual" value="M"> Manual </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Vehicle Image</label>
                                <input type="file" name="u_outsource_pic" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>
                                </div>
                                <small class="text-danger"><?php echo form_error('u_outsource_pic'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehiclePrice">Rental Price per Day</label>
                                <input type="number" min="0" class="form-control" id="u_vehiclePrice" placeholder="1000.00" step="0.01" name="u_vehiclePrice" value="<?php if($this->session->tempdata('u_price_per_day_fill')) echo $this->session->tempdata('u_price_per_day_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('price_per_day'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleAddKM">Additional Price</label>
                                <input type="number" min="0" class="form-control mb-2" id="u_vehicleAddKM" placeholder="Per KM" step="0.01" name="u_vehicleAddKM" value="<?php if($this->session->tempdata('u_per_km_fill')) echo $this->session->tempdata('u_per_km_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('per_km'); ?></small>
                                <input type="number" min="0" class="form-control" id="u_vehicleAddHour" placeholder="Per Hour" step="0.01" name="u_vehicleAddHour" value="<?php if($this->session->tempdata('u_per_hour_fill')) echo $this->session->tempdata('u_per_hour_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('per_hour'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleInsurance">Insurance Date</label>
                                <input type="date" class="form-control" id="u_vehicleInsurance" placeholder="Insurance Date" name="u_vehicleInsurance" max="<?php echo Date('Y-m-d',time()) ?>" value="<?php if($this->session->tempdata('u_insurence_date_fill')) echo $this->session->tempdata('u_insurence_date_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('insurence_date'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="vehicleLicense">Revenue License Date</label>
                                <input type="date" class="form-control" id="u_vehicleLicense" placeholder="Revenue License Date" name="u_vehicleLicense" max="<?php echo Date('Y-m-d',time()) ?>" value="<?php if($this->session->tempdata('u_revenue_license_date_date_fill')) echo $this->session->tempdata('u_revenue_license_date_date_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('revenue_license_date'); ?></small>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                            <button type="reset" class="btn btn-light">Reset</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>

                </div>
<<<<<<< Updated upstream
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-danger">Vehicle Outsourcing Details</h4>
                    <div style="overflow-x:auto;">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th><b>Vehicle ID</b></th>
                                <th><b>Supplier</b></th>
                                <!-- <th><b>Addition Price Per km</b></th>
                                <th><b>Addition Price Per Hour</b></th> -->
                                <!--<th style="text-align: center;">Picture</th>-->
                                <th><b>Price Per Day</b></th>
                                <th><b>Insurence Date</b></th>
                                <th><b>Revenue Licence Date</b></th>
                                <th><b>Actions</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(count($outsourceVehicle)):?>
                                <?php foreach($outsourceVehicle as $values): ?>
                                    <tr>
                                        <td>
                                            <?php echo $values->registered_number; ?>
                                        </td>
                                        <td>
                                            <?php for($i=0;$i < sizeof($supplier);$i++): ?>
                                                <?php if($values->supplier_id == $supplier[$i]->id):?>
                                                    <?php echo $supplier[$i]->name; ?>
                                                <?php endif;?>
                                            <?php endfor;?>
                                        </td>
                                        <!-- <td><?php echo $values->additional_price_per_km." LKR/-"; ?></td>
                                                <td>
                                                    <?php echo $values->additional_price_per_hour." LKR/-"; ?>
                                                </td> -->
                                        <!--<td><input type="submit" name="" class="btn btn-success" value="View"></td>-->
                                        <td><?php echo $values->price_per_day." LKR/-"; ?></td>
                                        <td>
                                            <?php echo $values->insurence_date; ?>
                                        </td>
                                        <td><?php echo $values->revenue_license_date; ?></td>
                                        <td>
                                            <a id="view"  href="<?php echo base_url("index.php/VehicleOutsource/outsourcingReport/$values->id");?>" target="_blank"><span class="mdi mdi-note "> Get Report</span></a>
                                            <a id="view" data-toggle="collapse" href="#updateOutsourcingVehicle" aria-expanded="false"
                                               aria-controls="viewDetails"><span class="mdi mdi-eyedropper text-success ml-3"
                                                                                 onclick="update_vehicle_outsource('<?php echo $values->id;?>',
                                                                                         '<?php echo $values->supplier_id;?>',
                                                                                         '<?php echo $values->title;?>',
                                                                                         '<?php echo $values->registered_number;?>',
                                                                                         '<?php echo $values->seat;?>',
                                                                                         '<?php echo $values->fuel_type;?>',
                                                                                         '<?php echo $values->ac;?>',
                                                                                         '<?php echo $values->transmission?>',
                                                                                         '<?php echo $values->price_per_day; ?>',
                                                                                         '<?php echo $values->additional_price_per_km;?>',
                                                                                         '<?php echo $values->additional_price_per_hour;?>',
                                                                                         '<?php echo $values->insurence_date;?>',
                                                                                         '<?php echo $values->revenue_license_date;?>')">Edit</span></a>
                                            <label class="cursor-pointer" data-toggle="modal" data-target="#deleteModal" onclick="delete_outsource_vehicle('<?php echo $values->id; ?>')"> <span class="mdi mdi-close-circle text-danger ml-4"> Remove</span> </label>
                                        </td>
=======
                <div class="col-12 grid-margin stretch-card" id="update_outsource_vehicle">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if($this->session->flashdata('outsource_status'))
                            {
                                ?>
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('outsource_status'); ?>
                                </div>
                                <?php
                            }
                            ?>
                            <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#updateOutsourcingVehicle" aria-expanded="false" aria-controls="viewDetails">Update Outsourcing Vehicle Details</button>

                            <div class="collapse " id="updateOutsourcingVehicle" aria-labelledby="customRadioInline2">
                                <br><br>
                                <?php echo form_open_multipart('VehicleOutsource/updateOutsourcingVehicle'); ?>
                                <div class="forms-sample">
                                    <div class="form-group">
                                        <input type="hidden" name="u_outsource_id" id="u_outsource_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleTitle">Supplier</label>
                                        <select name="update_supplier_id" id="update_supplier_id" class="form-control ">
                                            <option value="">Select Supplier..</option>
                                            <?php for($i=0;$i < sizeof($supplier);$i++): ?>
                                                <option value=<?php echo $supplier[$i]->id;?>><?php echo $supplier[$i]->name;?></option>
                                            <?php endfor;?>
                                        </select>
                                        <small class="text-danger"><?php echo form_error('supplier_id'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleTitle">Title</label>
                                        <input type="text" class="form-control" id="u_vehicleTitle" placeholder="Vehicle Title" name="u_vehicleTitle" >
                                        <small class="text-danger"><?php echo form_error('vehicle_title'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleRegisteredNumber">Registered Number</label>
                                        <input type="text" class="form-control" id="u_vehicleRegisteredNumber" placeholder="Registered Number" name="u_vehicleRegisteredNumber" >
                                        <small class="text-danger"><?php echo form_error('registered_no'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleSeat">Seat</label>
                                        <input type="number" class="form-control" id="u_vehicleSeat" placeholder="No of Seat" name="u_vehicleSeat" >
                                        <small class="text-danger"><?php echo form_error('no_of_seat'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleFuelType">Fuel Type</label>
                                        <select class="form-control" id="u_vehicleFuelType" name="u_vehicleFuelType" >
                                            <option value="">Select Fuel Type</option>
                                            <option value="P">Petrol</option>
                                            <option value="D">Diesel</option>
                                        </select>
                                        <small class="text-danger"><?php echo form_error('fuel_type'); ?></small>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">A/C or Non-A/C</label>
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="u_radioAC" id="ac" value="1" checked> A/C </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="u_radioAC" id="non_ac" value="0"> Non A/C </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Transmission Type</label>
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="u_radioTransmission" id="auto" value="A" checked> Auto </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="u_radioTransmission" id="manual" value="M"> Manual </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Vehicle Image</label>
                                        <!--<input type="file" name="img[]" class="">-->
                                        <div class="input-group col-xs-12">
                                            <input type="file" class="form-control file-upload-info"  placeholder="Upload Image" name="u_outsource_pic" >
                                            <!--<span class="input-group-append">-->
                                            <!--<button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>-->
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehiclePrice">Rental Price per Day</label>
                                        <input type="number" class="form-control" id="u_vehiclePrice" placeholder="1000.00" name="u_vehiclePrice" >
                                        <small class="text-danger"><?php echo form_error('price_per_day'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleAddKM">Additional Price</label>
                                        <input type="number" class="form-control mb-2" id="u_vehicleAddKM" placeholder="Per KM" name="u_vehicleAddKM" >
                                        <small class="text-danger"><?php echo form_error('per_km'); ?></small>
                                        <input type="number" class="form-control" id="u_vehicleAddHour" placeholder="Per Hour" name="u_vehicleAddHour" >
                                        <small class="text-danger"><?php echo form_error('per_hour'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleInsurance">Insurance Date</label>
                                        <input type="date" class="form-control" id="u_vehicleInsurance" placeholder="Insurance Date" name="u_vehicleInsurance" >
                                        <small class="text-danger"><?php echo form_error('insurence_date'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="vehicleLicense">Revenue License Date</label>
                                        <input type="date" class="form-control" id="u_vehicleLicense" placeholder="Revenue License Date" name="u_vehicleLicense">
                                        <small class="text-danger"><?php echo form_error('revenue_license_date'); ?></small>
                                    </div>
                                    <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                                    <button type="reset" class="btn btn-light">Reset</button>
                                </div>
                                <?php echo form_close(); ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-danger">Vehicle Outsourcing Details</h4>
                            <div style="overflow-x:auto;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><b>Vehicle ID</b></th>
                                            <th><b>Supplier</b></th>
                                            <!-- <th><b>Addition Price Per km</b></th>
                                            <th><b>Addition Price Per Hour</b></th> -->
                                            <!--<th style="text-align: center;">Picture</th>-->
                                            <th><b>Price Per Day</b></th>
                                            <th><b>Insurence Date</b></th>
                                            <th><b>Revenue Licence Date</b></th>
                                            <th><b>Actions</b></th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <?php if(count($outsourceVehicle)):?>
                                        <?php foreach($outsourceVehicle as $values): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $values->registered_number; ?>
                                                </td>
                                                <td>
                                                    <?php for($i=0;$i < sizeof($supplier);$i++): ?>
                                                        <?php if($values->supplier_id == $supplier[$i]->id):?>
                                                            <?php echo $supplier[$i]->name; ?>
                                                        <?php endif;?>
                                                    <?php endfor;?>
                                                </td>
                                                <!-- <td><?php echo $values->additional_price_per_km." LKR/-"; ?></td>
                                                <td>
                                                    <?php echo $values->additional_price_per_hour." LKR/-"; ?>
                                                </td> -->
                                                <!--<td><input type="submit" name="" class="btn btn-success" value="View"></td>-->
                                                <td><?php echo $values->price_per_day." LKR/-"; ?></td>
                                                <td>
                                                    <?php echo $values->insurence_date; ?>
                                                </td>
                                                <td><?php echo $values->revenue_license_date; ?></td>
                                                <td>
                                                    <a id="view"  href="<?php echo base_url("index.php/VehicleOutsource/outsourcingReport/$values->id");?>" target="_blank"><span class="mdi mdi-note "> Get Report</span></a>
                                                    <a id="view" data-toggle="collapse" href="#updateOutsourcingVehicle" aria-expanded="false"
                                                       aria-controls="viewDetails"><span class="mdi mdi-eyedropper text-success ml-3"
                                                                                         onclick="update_vehicle_outsource('<?php echo $values->id;?>',
                                                                                                 '<?php echo $values->supplier_id;?>',
                                                                                                 '<?php echo $values->title;?>',
                                                                                                 '<?php echo $values->registered_number;?>',
                                                                                                 '<?php echo $values->seat;?>',
                                                                                                 '<?php echo $values->fuel_type;?>',
                                                                                                 '<?php echo $values->ac;?>',
                                                                                                 '<?php echo $values->transmission?>',
                                                                                                 '<?php echo $values->price_per_day; ?>',
                                                                                                 '<?php echo $values->additional_price_per_km;?>',
                                                                                                 '<?php echo $values->additional_price_per_hour;?>',
                                                                                                 '<?php echo $values->insurence_date;?>',
                                                                                                 '<?php echo $values->revenue_license_date;?>')">Edit</span></a>
                                                    <label class="cursor-pointer" data-toggle="modal" data-target="#deleteModal" onclick="delete_outsource_vehicle('<?php echo $values->id; ?>')"> <span class="mdi mdi-close-circle text-danger ml-4"> Remove</span> </label>
                                                </td>
>>>>>>> Stashed changes

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
            document.getElementById("addOutsourcingVehicle").classList.add("show");
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
            <?php echo form_open('VehicleOutsource/prepareToDeleteOutsourceVehicle');?>
            <form>
                <div class="modal-body">
                    Are you sure want to delete this recode.
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="deloutsourcevid" id="deloutsourcevid" required>
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </form>
            <?php echo form_close(); ?>
        </div>
    </div>
<<<<<<< Updated upstream
</div>
<script type="text/javascript">
    function delete_outsource_vehicle(del_outsources_v_id){
        document.getElementById("deloutsourcevid").value = del_outsources_v_id;
    }
    function update_vehicle_outsource(id,u_supplier_id,title,reg_no,seat,fuel,ac,trans,price_day,price_km,price_hour,insurance_date,revenue_license_date){

        //display form if clickd edit in view table
        document.getElementById("add_outsource_vehicle").style.display = "none";
        document.getElementById("update_outsource_vehicle").style.display = "block";

        //load data into form
        document.getElementById("u_outsource_id").value = id;
        document.getElementById("update_supplier_id").value = u_supplier_id;
        document.getElementById("u_vehicleTitle").value = title;
        document.getElementById("u_vehicleRegisteredNumber").value = reg_no;
        document.getElementById("u_vehicleSeat").value = seat;
        document.getElementById("u_vehicleFuelType").value = fuel;
        // document.getElementById("u_radioAC").name = ac;
        // document.getElementById("u_radioTransmission").name = trans;
        document.getElementById("u_vehiclePrice").value = price_day;
        document.getElementById("u_vehicleAddKM").value = price_km;
        document.getElementById("u_vehicleAddHour").value = price_hour;
        document.getElementById("u_vehicleInsurance").value = insurance_date;
        document.getElementById("u_vehicleLicense").value = revenue_license_date;
    }
</script>

<!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>
<?php  if ($this->session->tempdata('form')=='add_form') { ?>
    <script>
        document.getElementById("add_outsource_vehicle").style.display = "block";
        document.getElementById("update_outsource_vehicle").style.display = "none";

    </script>
<?php }else if($this->session->tempdata('form')=='update_form'){ ?>
    <script>
        document.getElementById("update_outsource_vehicle").style.display = "block";
        document.getElementById("add_outsource_vehicle").style.display = "none";

    </script>
<?php }else{ ?>
    <script>
        document.getElementById("add_outsource_vehicle").style.display = "block";
        document.getElementById("update_outsource_vehicle").style.display = "none";
    </script>
=======
    <script type="text/javascript">
        function delete_outsource_vehicle(del_outsources_v_id){
            document.getElementById("deloutsourcevid").value = del_outsources_v_id;
        }
        function update_vehicle_outsource(id,u_supplier_id,title,reg_no,seat,fuel,ac,trans,price_day,price_km,price_hour,insurance_date,revenue_license_date){

            //display form if clickd edit in view table
            document.getElementById("add_outsource_vehicle").style.display = "none";
            document.getElementById("update_outsource_vehicle").style.display = "block";

            //load data into form
            document.getElementById("u_outsource_id").value = id;
            document.getElementById("update_supplier_id").value = u_supplier_id;
            document.getElementById("u_vehicleTitle").value = title;
            document.getElementById("u_vehicleRegisteredNumber").value = reg_no;
            document.getElementById("u_vehicleSeat").value = seat;
            document.getElementById("u_vehicleFuelType").value = fuel;
            // document.getElementById("u_radioAC").name = ac;
            // document.getElementById("u_radioTransmission").name = trans;
            document.getElementById("u_vehiclePrice").value = price_day;
            document.getElementById("u_vehicleAddKM").value = price_km;
            document.getElementById("u_vehicleAddHour").value = price_hour;
            document.getElementById("u_vehicleInsurance").value = insurance_date;
            document.getElementById("u_vehicleLicense").value = revenue_license_date;
        }
    </script>

    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>
<?php  if ($this->session->tempdata('form')=='add_form') { ?>
    <script>
        document.getElementById("add_outsource_vehicle").style.display = "block";
        document.getElementById("update_outsource_vehicle").style.display = "none";

    </script>
<?php }else if($this->session->tempdata('form')=='update_form'){ ?>
    <script>
        document.getElementById("update_outsource_vehicle").style.display = "block";
        document.getElementById("add_outsource_vehicle").style.display = "none";

    </script>
<?php }else{ ?>
    <script>
        document.getElementById("add_outsource_vehicle").style.display = "block";
        document.getElementById("update_outsource_vehicle").style.display = "none";
    </script>
>>>>>>> Stashed changes
<?php } ?>
