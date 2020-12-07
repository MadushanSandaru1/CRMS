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
                  <i class="mdi mdi-bookmark-plus"></i>
                </span> Car Booking </h3>
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
                        <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#addBooking" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Vehicle Booking Details</button>

                        <div class="collapse mt-5" id="addBooking" aria-labelledby="customRadioInline2">

                            <form class="forms-sample">
                                
                                <div class="form-group">
                                    <label for="expenseVehicleID"><b>Vehicle</b></label>
                                    <select class="custom-select" name="expenseVehicleID">
                                        <option value="" disabled selected hidden>Select Vehicle</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="expensedVehicleDate">Date</label>
                                    <input type="datetime-local" class="form-control" id="expensedVehicleDate" placeholder="Date">
                                </div>

                                <div class="form-group">
                                    <label for="expensedVehicleDate">Date</label>
                                    <input type="datetime-local" class="form-control" id="expensedVehicleDate" placeholder="Date">
                                </div>

                                <div class="form-group">
                                    <label for="expenseAmount">Name</label>
                                    <input type="text" class="form-control" id="expenseAmount" placeholder="Customer's name">
                                </div>

                                <div class="form-group">
                                    <label for="expenseAmount">NIC</label>
                                    <input type="text" class="form-control" id="expenseAmount" placeholder="Customer's NIC">
                                </div>

                                <div class="form-group">
                                    <label for="expenseAmount">Email</label>
                                    <input type="text" class="form-control" id="expenseAmount" placeholder="Customer's email">
                                </div>

                                <div class="form-group">
                                    <label for="expenseAmount">Phone</label>
                                    <input type="text" class="form-control" id="expenseAmount" placeholder="Customer's Phone">
                                </div>

                                <textarea class="form-control txt-field" placeholder="Message" name="msg" id="msg"></textarea>
                                <small class="text-danger"><?php echo form_error('msg'); ?></small>

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
                        <h4 class="card-title text-danger">Vehicle Booking Details</h4>
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