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
                        <h4 class="card-title text-danger mb-5">Add Vehicle Details</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="vehicleType">Type</label>
                                <input type="text" class="form-control" id="vehicleType" placeholder="Type">
                            </div>
                            <div class="form-group">
                                <label for="vehicleRegisteredNumber">Registered Number</label>
                                <input type="text" class="form-control" id="vehicleRegisteredNumber" placeholder="Registered Number">
                            </div>
                            <div class="form-group">
                                <label for="vehicleSeat">Seat</label>
                                <input type="number" class="form-control" id="vehicleSeat" placeholder="No of Seat">
                            </div>
                            <div class="form-group">
                                <label for="vehicleFuelType">Fuel Type</label>
                                <select class="form-control" id="vehicleFuelType">
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
                                <input type="file" name="img[]" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="vehiclePrice">Rental Price per Day</label>
                                <input type="number" class="form-control" id="vehiclePrice" placeholder="1000.00">
                            </div>
                            <div class="form-group">
                                <label for="vehicleAddKM">Additional Price</label>
                                <input type="number" class="form-control mb-2" id="vehicleAddKM" placeholder="Per KM">
                                <input type="number" class="form-control" id="vehicleAddHour" placeholder="Per Hour">
                            </div>
                            <div class="form-group">
                                <label for="vehicleInsurance">Insurance Date</label>
                                <input type="date" class="form-control" id="vehicleInsurance" placeholder="Insurance Date">
                            </div>
                            <div class="form-group">
                                <label for="vehicleLicense">Revenue License Date</label>
                                <input type="date" class="form-control" id="vehicleLicense" placeholder="Revenue License Date">
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Reset</button>
                        </form>
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
                                <th>Vehicle Image</th>
                                <th>Rental Price per Day</th>
                                <th>Additional Price per KM</th>
                                <th>Additional Price per Hour</th>
                                <th>Insurance Date</th>
                                <th>Revenue License Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Jacob</td>
                                <td>Photoshop</td>
                                <td class="text-danger"> 28.76% <i class="mdi mdi-arrow-down"></i></td>
                                <td><label class="badge badge-danger">Pending</label></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>