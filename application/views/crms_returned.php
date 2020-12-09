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
                  <i class="mdi mdi-keyboard-return"></i>
                </span> Car Returned </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span><i class="mdi mdi-clock icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <!-- add reserved vehicle form start-->

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <?php
                        if($this->session->flashdata('returned_status'))
                        {
                            ?>
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $this->session->flashdata('returned_status'); ?>
                            </div>
                            <br>
                            <?php
                        }
                        ?>

                        <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#addReturnedVehicle" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Returned Vehicle Details</button>

                        <div class="collapse " id="addReturnedVehicle" aria-labelledby="customRadioInline2">
                            <?php echo form_open('Returned/add_returned');  ?>

                                <div class="form-group">
                                    <label for="reservedCustomerID"><b>Customer ID</b></label>
                                    <select class="custom-select" name="reservedCustomerID">
                                        <?php
                                        if($reserved_data->num_rows() > 0) {
                                            foreach ($reserved_data->result() as $data_row) {
                                                echo "<option value='".$data_row->id."'>".$data_row->registered_number." - ".$data_row->name."</option>";
                                            }
                                        } else {
                                            echo "<option>Data not found</option>";
                                        }
                                        ?>

                                    </select>
                                    <small class="text-danger"><?php echo form_error('reservedCustomerID'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="reservedVehicleDate">Reserved Date</label>
                                    <input type="datetime-local" class="form-control" name="reservedVehicleFromDate" id="reservedVehicleFromDate" placeholder="Reserved Date" max="<?php echo Date('Y-m-d\TH:i',time()) ?>" value="<?php if($this->session->tempdata('reservedVehicleFromDate_fill')) echo $this->session->tempdata('reservedVehicleFromDate_fill'); else echo Date('Y-m-d\TH:i',time()); ?>">
                                    <small class="text-danger"><?php echo form_error('reservedVehicleFromDate'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="reservedVehicleDate">Returned Date</label>
                                    <input type="datetime-local" class="form-control" name="reservedVehicleToDate" id="reservedVehicleToDate" placeholder="Returned Date">
                                    <small class="text-danger"><?php echo form_error('reservedVehicleToDate'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="reservedVehicleStartValue">Start Meter Value</label>
                                    <input type="number" class="form-control" name="reservedVehicleStartValue" id="reservedVehicleStartValue" placeholder="In meters">
                                    <small class="text-danger"><?php echo form_error('reservedVehicleStartValue'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="reservedVehicleAdvancedPayment">Advanced Payment</label>
                                    <input type="number" class="form-control" name="reservedVehicleAdvancedPayment" id="reservedVehicleAdvancedPayment" placeholder="1000.00">
                                    <small class="text-danger"><?php echo form_error('reservedVehicleAdvancedPayment'); ?></small>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-light">Cancel</button>

                            <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Returned Vehicle Details</h4>
                        <div style="overflow-x:auto;">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer ID</th>
                                    <th>Vehicle ID</th>
                                    <th>Reserved Date</th>
                                    <th>Return Date</th>
                                    <th>Start Meter Value</th>
                                    <th>Stop Meter Value</th>
                                    <th>Advanced Payment</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($returned_data->num_rows() > 0) {
                                    foreach ($returned_data->result() as $data_row){
                                        ?>
                                        <tr>
                                            <td class="nr"><?php echo $data_row->id; ?></td>
                                            <td><?php echo $data_row->customer_id.' - '.$data_row->name; ?></td>
                                            <td><?php echo $data_row->vehicle_id.' - '.$data_row->registered_number; ?></td>
                                            <td><?php echo $data_row->from_date; ?></td>
                                            <td><?php echo $data_row->to_date; ?></td>
                                            <td><?php echo $data_row->start_meter_value; ?></td>
                                            <td><?php echo $data_row->stop_meter_value; ?></td>
                                            <td class="text-right"><?php echo number_format($data_row->advance_payment,2); ?></td>
                                            <td>
                                                <?php if($data_row->is_returned == 0) { ?>
                                                    <a href=""><span class="edit_btn mdi mdi-calendar-clock text-success"> Extend Time</span></a>
                                                    <a href=""><span class="edit_btn mdi mdi-keyboard-return text-danger ml-4"> Return</span></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                else {
                                    ?>
                                    <tr>
                                        <td colspan="6">No Data Found</td>
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
                document.getElementById("addReturnedVehicle").classList.add("show");
            </script>
        <?php } ?>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>