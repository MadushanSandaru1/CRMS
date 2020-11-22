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
                  <i class="mdi mdi-cash-multiple"></i>
                </span> Car Outsourcing Supplier </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span><i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#addOutsourcingSupplier" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Outsourcing Supplier Details</button>

                        <div class="collapse " id="addOutsourcingSupplier" aria-labelledby="customRadioInline2">
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="expenseVehicleID"><b>Vehicle ID</b></label>
                                    <select class="custom-select" name="expenseVehicleID">
                                        <option value="">Select Vehicle ID</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="expensedVehicleDate">Date</label>
                                    <input type="date" class="form-control" id="expensedVehicleDate" placeholder="Date">
                                </div>
                                <div class="form-group">
                                    <label for="expenseAmount">Amount</label>
                                    <input type="number" class="form-control" id="expenseAmount" placeholder="1000.00">
                                </div>
                                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-danger">Vehicle Outsourcing Supplier Details</h4>
                    <div style="overflow-x:auto;">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Vehicle ID</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Jacob</td>
                                <td>Photoshop</td>
                                <td>Jacob</td>
                                <td>Jacob</td>
                                <td>Photoshop</td>
                                <td>
                                    <a href=""><span class="mdi mdi-eyedropper text-success"> Edit</span></a>
                                    <a href=""><span class="mdi mdi-close-circle text-danger ml-4"> Remove</span></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>