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

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <?php
                        if($this->session->flashdata('returned_status'))
                        {
                            ?>
                            <div class="alert alert-success">
                                <?php echo $this->session->flashdata('returned_status'); ?>
                            </div>
                            <?php
                        }
                        ?>
                        <h4 class="card-title text-danger">Returned Vehicle Details</h4>
                        <div style="overflow-x:auto;">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Actions</th>
                                    <th>Customer ID</th>
                                    <th>Vehicle ID</th>
                                    <th>Reserved Date</th>
                                    <th>Return Date</th>
                                    <th>Start Meter Value</th>
                                    <th>Stop Meter Value</th>
                                    <th>Advanced Payment</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($returned_data->num_rows() > 0) {
                                    foreach ($returned_data->result() as $data_row){
                                        ?>
                                        <tr>
                                            <td class="nr"><?php echo $data_row->id; ?></td>
                                            <td>
                                                <?php if($data_row->is_returned == 0) { ?>
                                                    <a href="" class=" alert notification  text-black" data-toggle="modal" data-target="#extendVehicle" style="" onclick="extend_vehicle(<?php echo $data_row->id;?>,'<?php echo $data_row->name;?>','<?php echo $data_row->registered_number;?>','<?php echo $data_row->from_date;?>','<?php echo $data_row->to_date;?>')"><span class="edit_btn mdi mdi-calendar-clock text-success"> Extend Time</span></a>
                                                    <a href="" class=" alert notification  text-black" data-toggle="modal" data-target="#returnVehicle" style="" onclick="return_vehicle(<?php echo $data_row->id;?>,'<?php echo $data_row->name;?>','<?php echo $data_row->registered_number;?>','<?php echo $data_row->start_meter_value;?>','<?php echo $data_row->stop_meter_value;?>')"><span class="edit_btn mdi mdi-keyboard-return text-danger ml-4"> Return</span></a>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $data_row->customer_id.' - '.$data_row->name; ?></td>
                                            <td><?php echo $data_row->vehicle_id.' - '.$data_row->registered_number; ?></td>
                                            <td><?php echo $data_row->from_date; ?></td>
                                            <td><?php echo $data_row->to_date; ?></td>
                                            <td><?php echo $data_row->start_meter_value; ?></td>
                                            <td><?php echo $data_row->stop_meter_value; ?></td>
                                            <td class="text-right"><?php echo number_format($data_row->advance_payment,2); ?></td>
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
        <div class="modal fade" id="returnVehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: #f5005e" id="exampleModalLongTitle">Return Vehicle of  <label id="reg_num"></label></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('Returned/returnVehicle'); ?>
                        <form method="post">
                            <input type="hidden" id="re_id" name="re_id">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Customer : </label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label id="customer"></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Start Meter Value : </label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label id="meter_value"></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>End Meter Value : </label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label id="meter_e_value"></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3"></div>
                                <div class="form-group col-md-9">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Return</button>
                                </div>
                            </div>
                        </form>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="extendVehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: #f5005e" id="exampleModalLongTitle">Extend time vehicle of  <label id="e_reg_num"></label></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('Returned/extendVehicle'); ?>
                        <form method="post">
                            <input type="hidden" id="ex_id" name="ex_id">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Customer : </label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label id="customer_id"></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Reserevd Date : </label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label id="r_date"></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Return Date : </label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label id="ret_date"></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Extend Date : </label>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="date" name="n_r_date" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3"></div>
                                <div class="form-group col-md-9">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Extend</button>
                                </div>
                            </div>
                        </form>
                        <?php echo form_close(); ?>
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
    <script>
        function return_vehicle(id,customer,reg_num,sm_value,em_value){
            document.getElementById("re_id").value=id;
            document.getElementById("customer").innerHTML=customer;
            document.getElementById("reg_num").innerHTML=reg_num;
            document.getElementById("meter_value").innerHTML=sm_value;
            document.getElementById("meter_e_value").innerHTML=em_value;
        }
        function extend_vehicle(id,customer_name,reg_num,r_date,ret_date){
            document.getElementById("ex_id").value=id;
            document.getElementById("customer_id").innerHTML=customer_name;
            document.getElementById("e_reg_num").innerHTML=reg_num;
            document.getElementById("r_date").innerHTML=r_date;
            document.getElementById("ret_date").innerHTML=ret_date;
        }
    </script>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>