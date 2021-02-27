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
                </span> Car Reserved </h3>
        </div>

        <div class="row">
            <!-- add reserved vehicle form start-->

            <div class="col-12 grid-margin stretch-card" id="add_reserved">
                <div class="card">
                    <div class="card-body">

                        <?php
                        if($this->session->flashdata('reserved_status'))
                        {
                            ?>
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php
                                    echo $this->session->flashdata('reserved_status');
                                    if ($this->session->tempdata('report_details'))
                                        echo "<a href='".base_url('index.php/Reserved/report_reserved/'.$this->session->tempdata('report_details'))."' target='_blank'> print bill</a>";
                                ?>
                            </div>
                            <br>
                            <?php
                        }
                        ?>

                        <button type="button" class="btn btn-gradient-primary mb-2" data-toggle="collapse" href="#addReservedVehicle" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Reserved Vehicle Details</button>

                        <div class="collapse " id="addReservedVehicle" aria-labelledby="customRadioInline2">
                            <?php echo form_open('Reserved/add_reserved');  ?>

                                <div class="form-group">
                                    <label for="reservedCustomerID"><b>Customer ID</b></label>
                                    <select class="custom-select" name="reservedCustomerID">
                                        <option disabled selected hidden>Select Customer ID</option>
                                        <?php

                                        if($customer_data->num_rows() > 0) {
                                            foreach ($customer_data->result() as $data_row) {

                                                if ( $this->session->tempdata('reservedCustomerID_fill')==$data_row->id ) {
                                                    echo "<option selected value='".$data_row->id."'>".$data_row->nic." - ".$data_row->name."</option>";
                                                }else{
                                                    echo "<option value='".$data_row->id."'>".$data_row->nic." - ".$data_row->name."</option>";
                                                }
                                            }
                                        } else {
                                            echo "<option disabled selected hidden>Data not found</option>";
                                        }
                                        ?>

                                    </select>
                                    <small class="text-danger"><?php echo form_error('reservedCustomerID'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="reservedVehicleID"><b>Vehicle ID</b></label>
                                    <select class="custom-select" name="reservedVehicleID" id="reservedVehicleID" onchange="set_payment()">
                                        <option disabled selected hidden>Select Vehicle ID</option>
                                        <?php
                                        if($vehicle_data->num_rows() > 0) {
                                            foreach ($vehicle_data->result() as $data_row) {
                                               
                                                if ( $this->session->tempdata('reservedVehicleID_fill')==$data_row->id ) {
                                                    echo "<option selected value='".$data_row->id."'>".$data_row->registered_number." - ".$data_row->title." (".$data_row->price_per_day.")</option>";
                                                }else{
                                                     echo "<option value='".$data_row->id."'>".$data_row->registered_number." - ".$data_row->title." (".$data_row->price_per_day.")</option>";
                                                }

                                            }
                                        } else {
                                            echo "<option disabled selected hidden>Data not found</option>";
                                        }
                                        ?>

                                    </select>
                                    <small class="text-danger"><?php echo form_error('reservedVehicleID'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="reservedVehicleDate">Reserved Date </label>
                                    <input type="datetime-local" class="form-control" name="reservedVehicleFromDate" id="reservedVehicleFromDate" onchange="set_dropoff_min()" placeholder="Reserved Date" min="<?php echo Date('Y-m-d\TH:i',time()) ?>"  value="<?php echo Date('Y-m-d\TH:i',time()); ?>" readonly>
                                    <small class="text-danger"><?php echo form_error('reservedVehicleFromDate'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="reservedVehicleDate">Returned Date</label>
                                    <input type="datetime-local" class="form-control" name="reservedVehicleToDate" id="reservedVehicleToDate" onchange="set_payment()" placeholder="Returned Date" min="<?php echo Date('Y-m-d\TH:i',time()) ?>" value="<?php if($this->session->tempdata('reservedVehicleToDate_fill')) echo $this->session->tempdata('reservedVehicleToDate_fill'); ?>">
                                    <small class="text-danger"><?php echo form_error('reservedVehicleToDate'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="reservedVehicleStartValue">Start Meter Value</label>
                                    <input type="number" class="form-control" name="reservedVehicleStartValue" step="0.01" id="reservedVehicleStartValue" placeholder="In meters" value="<?php if($this->session->tempdata('reservedVehicleStartValue_fill')) echo $this->session->tempdata('reservedVehicleStartValue_fill'); ?>">
                                    <small class="text-danger"><?php echo form_error('reservedVehicleStartValue'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="reservedVehicleAdvancedPayment">Advanced Payment</label>
                                    <input type="number" class="form-control" name="reservedVehicleAdvancedPayment" step="0.01" id="reservedVehicleAdvancedPayment" placeholder="1000.00" value="<?php if($this->session->tempdata('reservedVehicleAdvancedPayment_fill')) echo $this->session->tempdata('reservedVehicleAdvancedPayment_fill'); ?>">
                                    <small id="payment_value" class="text-success"></small>
                                    <small class="text-danger"><?php echo form_error('reservedVehicleAdvancedPayment'); ?></small>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-light">Cancel</button>

                            <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 grid-margin stretch-card" id="update_reserved">
                <div class="card">
                    <div class="card-body">

                        <?php
                        if($this->session->flashdata('reserved_status'))
                        {
                            ?>
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php
                                echo $this->session->flashdata('reserved_status');
                                if ($this->session->tempdata('report_details'))
                                    echo "<a href='".base_url('index.php/Reserved/report_reserved/'.$this->session->tempdata('report_details'))."' target='_blank'> print bill</a>";
                                ?>
                            </div>
                            <br>
                            <?php
                        }
                        ?>

                        <button type="button" class="btn btn-gradient-primary mb-2" data-toggle="collapse" href="#updateReservedVehicle" aria-expanded="false" aria-controls="viewDetails">Update Reserved Vehicle Details</button>

                        <div class="collapse " id="updateReservedVehicle" aria-labelledby="customRadioInline2">
                            <?php echo form_open('Reserved/update_reserved');  ?>
                            <div class="form-group">
                                <input type="text" name="" id="r_reserved_id" hidden>
                            </div>
                            <div class="form-group">
                                <label for="reservedCustomerID"><b>Customer ID</b></label>
                                <select class="custom-select" name="reservedCustomerID" id="r_customer_id">
                                    <option value="" disabled selected hidden>Select Customer ID</option>
                                    <?php
                                    if($customer_data->num_rows() > 0) {
                                        foreach ($customer_data->result() as $data_row) {
                                            echo "<option value='".$data_row->id."'>".$data_row->nic." - ".$data_row->name."</option>";
                                        }
                                    } else {
                                        echo "<option>Data not found</option>";
                                    }
                                    ?>

                                </select>
                                <small class="text-danger"><?php echo form_error('reservedCustomerID'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="reservedVehicleID"><b>Vehicle ID</b></label>
                                <select class="custom-select" name="reservedVehicleID"  id="r_reserved_v">
                                    <option value="" disabled selected hidden>Select Vehicle ID</option>
                                    <?php
                                    if($vehicle_data->num_rows() > 0) {
                                        foreach ($vehicle_data->result() as $data_row) {
                                            echo "<option value='".$data_row->id."'>".$data_row->registered_number." - ".$data_row->title."</option>";
                                        }
                                    } else {
                                        echo "<option>Data not found</option>";
                                    }
                                    ?>

                                </select>
                                <small class="text-danger"><?php echo form_error('reservedVehicleID'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="reservedVehicleDate">Reserved Date</label>
                                <input type="datetime-local" class="form-control" name="reservedVehicleFromDate" id="r_reservedVehicleFromDate" placeholder="Reserved Date" max="<?php echo Date('Y-m-d\TH:i',time()) ?>" value="<?php if($this->session->tempdata('reservedVehicleFromDate_fill')) echo $this->session->tempdata('reservedVehicleFromDate_fill'); else echo Date('Y-m-d\TH:i',time()); ?>">
                                <small class="text-danger"><?php echo form_error('reservedVehicleFromDate'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="reservedVehicleDate">Returned Date</label>
                                <input type="datetime-local" class="form-control" name="reservedVehicleToDate" id="r_reservedVehicleToDate" placeholder="Returned Date" value="<?php if($this->session->tempdata('reservedVehicleToDate_fill')) echo $this->session->tempdata('reservedVehicleToDate_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('reservedVehicleToDate'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="reservedVehicleStartValue">Start Meter Value</label>
                                <input type="number" class="form-control" name="reservedVehicleStartValue" id="r_reservedVehicleStartValue" placeholder="In meters" value="<?php if($this->session->tempdata('reservedVehicleStartValue_fill')) echo $this->session->tempdata('reservedVehicleStartValue_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('reservedVehicleStartValue'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="reservedVehicleAdvancedPayment">Advanced Payment</label>
                                <input type="number" class="form-control" name="reservedVehicleAdvancedPayment" id="r_reservedVehicleAdvancedPayment" placeholder="1000.00" value="<?php if($this->session->tempdata('reservedVehicleAdvancedPayment_fill')) echo $this->session->tempdata('reservedVehicleAdvancedPayment_fill'); ?>">
                                <small class="text-danger"><?php echo form_error('reservedVehicleAdvancedPayment'); ?></small>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                            <button type="reset" class="btn btn-light">Cancel</button>

                            <?php echo form_close();  ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title text-danger">Reserved Vehicle Details</h4>

                            <!-- search bar-->
                            <div class="search-field d-none d-md-block">
                                <input type="text" id="searchTxt" onkeyup="searchTable()" class="form-control bg-light text-danger form-control-sm border-danger border-left-0 border-right-0 border-top-0" placeholder="Search...">
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <table class="table table-hover" id="reservedTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer ID</th>
                                    <th>Vehicle ID</th>
                                    <th>Reserved Date</th>
                                    <th>Return Date</th>
                                    <th>Start Meter Value</th>
                                    <th>Advanced Payment</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($reserved_data->num_rows() > 0) {
                                    foreach ($reserved_data->result() as $data_row){
                                        ?>
                                        <tr>
                                            <td class="nr"><?php echo $data_row->id; ?></td>
                                            <td><?php echo $data_row->customer_id.' - '.$data_row->name; ?></td>
                                            <td><?php echo $data_row->vehicle_id.' - '.$data_row->registered_number; ?></td>
                                            <td><?php echo $data_row->from_date; ?></td>
                                            <td><?php echo $data_row->to_date; ?></td>
                                            <td><?php echo $data_row->start_meter_value; ?></td>
                                            <td class="text-right"><?php echo number_format($data_row->advance_payment,2); ?></td>
                                            <td>
                                                <a href="<?php echo base_url('index.php/Reserved/report_reserved/'.$data_row->vehicle_id); ?>" target="_blank"><span class="mdi mdi-printer"> Bill</span></a>
                                        <?php if($this->session->userdata('user_role') == 'admin'){ ?>

                                            <!--a id="view" data-toggle="collapse" href="#updateReservedVehicle" aria-expanded="false"
                                               aria-controls="viewDetails"><span class="mdi mdi-eyedropper text-success ml-3"
                                                                                 onclick="update_reserved('<?php echo $data_row->id;?>',
                                                                                         '<?php echo $data_row->customer_id;?>',
                                                                                         '<?php echo $data_row->vehicle_id;?>',
                                                                                         '<?php echo $data_row->from_date;?>',
                                                                                         '<?php echo $data_row->to_date;?>',
                                                                                         '<?php echo $data_row->start_meter_value;?>',
                                                                                         '<?php echo $data_row->advance_payment;?>',
                                                                                         )">Edit</span></a-->

                                                <a style="cursor: pointer;" data-toggle="modal" data-target="#deleteModal" onclick="delete_reserved('<?php echo$data_row->id; ?>')"> <span class="mdi mdi-close-circle text-danger ml-4"> Remove</span> </a>
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

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php echo form_open('Reserved/delete_reserved');?>
                    <form>
                        <div class="modal-body">
                            Are you sure you want to delete this record.
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="delreservedid" id="delreservedid" required>
                            <button type="submit" class="btn btn-primary">Yes</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                        </div>
                    </form>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!-- ** Delete Modal -->

        <script type="text/javascript">
            function set_dropoff_min(){
                min = document.getElementById("reservedVehicleFromDate").value;
                document.getElementById("reservedVehicleToDate").value = null;

                document.getElementById("reservedVehicleToDate").min  = min;
            }

            function set_payment(){

                from_val = Date.parse(document.getElementById("reservedVehicleFromDate").value);
                to_val = Date.parse(document.getElementById("reservedVehicleToDate").value);
                e = document.getElementById("reservedVehicleID");
                title = e.options[e.selectedIndex].text;

                if(to_val && title!="Select Vehicle ID") {

                    days = Math.ceil((to_val-from_val) / 1000 / 60 / 60 / 24);
                    price  = title.substring(title.lastIndexOf("(") + 1, title.lastIndexOf(")"));

                    payment = parseInt(days)*parseInt(price);

                    document.getElementById("reservedVehicleAdvancedPayment").value = null;
                    document.getElementById("payment_value").innerHTML  = "Estimated Total Amount : Rs."+payment;
                } else {
                    document.getElementById("payment_value").innerHTML  = "";
                }
            }

            // delete details
            function delete_reserved(del_reserved_id){
                document.getElementById("delreservedid").value = del_reserved_id;
            }

            // table search
            function searchTable(){
                var input, filter, table, tr, td, cell, i, j;
                input = document.getElementById("searchTxt");
                filter = input.value.toUpperCase();
                table = document.getElementById("reservedTable");
                tr = table.getElementsByTagName("tr");
                for (i = 1; i < tr.length; i++) {
                    // Hide the row initially.
                    tr[i].style.display = "none";

                    td = tr[i].getElementsByTagName("td");
                    for (var j = 0; j < td.length; j++) {
                        cell = tr[i].getElementsByTagName("td")[j];
                        if (cell) {
                            if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                                break;
                            }
                        }
                    }
                }
            }
            function update_reserved(id,cus_id,v_id,f_date,t_date,s_meter,advance_p){

                //display form if clickd edit in view table
                document.getElementById("add_reserved").style.display = "none";
                document.getElementById("update_reserved").style.display = "block";

                //load data into form
                document.getElementById("r_reserved_id").value = id;
                document.getElementById("r_customer_id").value = cus_id;
                document.getElementById("r_reserved_v").value = v_id;
                document.getElementById("r_reservedVehicleFromDate").value =getlocal_time(f_date);
                document.getElementById("r_reservedVehicleToDate").value = getlocal_time(t_date);
                document.getElementById("r_reservedVehicleStartValue").value = s_meter;
                document.getElementById("r_reservedVehicleAdvancedPayment").value = advance_p;
            }

            function  getlocal_time(time)
            {
                var dateString = time;

                if (dateString !== "") {

                    var dateVal = new Date(dateString);
                    var day = dateVal.getDate().toString().padStart(2, "0");
                    var month = (1 + dateVal.getMonth()).toString().padStart(2, "0");
                    var hour = dateVal.getHours().toString().padStart(2, "0");
                    var minute = dateVal.getMinutes().toString().padStart(2, "0");
                    var sec = dateVal.getSeconds().toString().padStart(2, "0");
                    var ms = dateVal.getMilliseconds().toString().padStart(3, "0");
                    var inputDate = dateVal.getFullYear() + "-" + (month) + "-" + (day) + "T" + (hour) + ":" + (minute) + ":" + (sec) + "." + (ms);
                    return inputDate;
                }
            }
        </script>

        <?php if(validation_errors()) { ?>
            <script>
                set_payment();
                document.getElementById("addReservedVehicle").classList.add("show");
            </script>
        <?php } ?>

        <?php if($this->session->tempdata('form')=='add_form') { ?>
            <script>
                document.getElementById("addReservedVehicle").classList.add("show");
            </script>
        <?php } ?>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>
<?php  if ($this->session->tempdata('form')=='add_form') { ?>
    <script>
        document.getElementById("add_reserved").style.display = "block";
        document.getElementById("update_reserved").style.display = "none";

    </script>
<?php }else if($this->session->tempdata('form')=='update_form'){ ?>
    <script>
        document.getElementById("update_reserved").style.display = "block";
        document.getElementById("add_reserved").style.display = "none";

    </script>
<?php }else{ ?>
    <script>
        document.getElementById("add_reserved").style.display = "block";
        document.getElementById("update_reserved").style.display = "none";
    </script>
<?php } ?>
