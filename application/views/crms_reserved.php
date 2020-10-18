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
                </span> Car Reserved </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <!-- add reserved vehicle form start-->

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger mb-5">Add reserved vehicle details</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="reservedCustomerID"><b>Customer ID</b></label>
                                <select class="custom-select" name="reservedCustomerID">
                                    <option value="">Select Reserved ID</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="reservedVehicleID"><b>Vehicle ID</b></label>
                                <select class="custom-select" name="reservedVehicleID">
                                    <option value="">Select Vehicle ID</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="reservedVehicleDate">Reserved Date</label>
                                <input type="date" class="form-control" id="reservedVehicleDate" placeholder="Reserved Date">
                            </div>
                            <div class="form-group">
                                <label for="reservedVehicleDate">Returned Date</label>
                                <input type="date" class="form-control" id="reservedVehicleDate" placeholder="Returned Date">
                            </div>
                            <div class="form-group">
                                <label for="reservedVehicleStartValue">Start Meter Value</label>
                                <input type="number" class="form-control" id="reservedVehicleStartValue" placeholder="In meters">
                            </div>
                            <div class="form-group">
                                <label for="reservedVehicleStopValue">Stop Meter Value</label>
                                <input type="number" class="form-control" id="reservedVehicleStopValue" placeholder="In meters">
                            </div>
                            <div class="form-group">
                                <label for="reservedVehicleAdvancedPayment">Advanced Payment</label>
                                <input type="number" class="form-control" id="reservedVehicleAdvancedPayment" placeholder="1000.00">
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Reserved Vehicle Details</h4></p>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer ID</th>
                                <th>Vehicle ID</th>
                                <th>Reserved Date</th>
                                <th>Returned Date</th>
                                <th>Start Meter Value</th>
                                <th>Stop Meter Value</th>
                                <th>Advanced Payment</th>
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