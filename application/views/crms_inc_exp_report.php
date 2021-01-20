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
                  <i class="mdi mdi-clipboard-text"></i>
                </span> Income/Expense Report </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">

                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Income/Expense Report Generation</h4>

                        <?php
                        if($this->session->flashdata('expenses_report_status'))
                        {
                            ?>
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php
                                echo $this->session->flashdata('expenses_report_status');
                                if ($this->session->tempdata('expense_report_details'))
                                    echo "<a href='".base_url('index.php/Expense_Report/report_expense')."' target='_blank'>. print report</a>";
                                else
                                    echo ". But record empty. <a href='".base_url('index.php/Expense_Report/report_expense')."' target='_blank'>. print report</a>";
                                ?>
                            </div>
                            <br>
                            <?php
                        }
                        ?>

                        <?php echo form_open('Expense_Report/generateExpenseReport'); ?>
                        <div class="form-group">
                            <label for="exampleInputUsername1"><b>Vahicle ID</b></label>
                            <select class="custom-select" name="expenseVehicleID">
                                <option disabled selected hidden>Select Vehicle ID</option>
                                <?php
                                if($vehicle_data->num_rows() > 0) {
                                    foreach ($vehicle_data->result() as $data_row) {

                                        if ($this->session->tempdata('expenseVehicleID_fill')) {
                                            if ($this->session->tempdata('expenseVehicleID_fill')==$data_row->id) {
                                                echo "<option value='".$data_row->id."' selected>".$data_row->id." - ".$data_row->registered_number."</option>";
                                            } else {
                                                echo "<option value='".$data_row->id."'>".$data_row->id." - ".$data_row->registered_number."</option>";
                                            }

                                        }else{
                                            echo "<option value='".$data_row->id."'>".$data_row->id." - ".$data_row->registered_number."</option>";
                                        }

                                    }
                                } else {
                                    echo "<option disabled selected hidden>Data not found</option>";
                                }
                                ?>
                            </select>
                            <small class="text-danger"><?php echo form_error('expenseVehicleID'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><b>Time Specification</b></label><br><br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="get_time" value="regular" class="" data-toggle="collapse"  href="#custome" aria-expanded="false" aria-controls="collapseExample" <?php if($this->session->tempdata('get_time_fill')!="customize") echo "checked"; ?>>
                                <label class="ml-2" for="customRadioInline1" data-toggle="tooltip" data-placement="top" title="Its return all the records">Regular</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="get_time" value="customize" class="" data-toggle="collapse" href="#custome" aria-expanded="false" aria-controls="custom" <?php if($this->session->tempdata('get_time_fill')=="customize") echo "checked"; ?>>
                                <label class="ml-2" for="customRadioInline2" data-toggle="tooltip" data-placement="top" title="You can get recored for specific time time"> Specific Time  Duration</label>
                            </div>

                            <div class="collapse <?php if(form_error('start_date')||form_error('end_date')||$this->session->tempdata('get_time_fill')=="customize") echo "show"; ?>" id="custome" aria-labelledby="customRadioInline2">
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <input type="date" name="start_date" id="start_date" onchange="set_min_date()" class="form-control" value="<?php if($this->session->tempdata('start_date_fill')) echo $this->session->tempdata('start_date_fill'); ?>">
                                        <small class="text-danger"><?php echo form_error('start_date'); ?></small>
                                    </div>
                                    <div class="col">
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="<?php if($this->session->tempdata('end_date_fill')) echo $this->session->tempdata('end_date_fill'); ?>">
                                        <small class="text-danger"><?php echo form_error('end_date'); ?></small>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"><b>Types</b></label>
                            <select class="custom-select" name="type">
                                <option value="all" <?php if($this->session->tempdata('type_fill')=="all") echo "selected"; ?>>All</option>
                                <option value="income <?php if($this->session->tempdata('type_fill')=="income") echo "selected"; ?>">Income</option>
                                <option value="expense" <?php if($this->session->tempdata('type_fill')=="expense") echo "selected"; ?>>Expense</option>
                            </select>
                        </div>


                        <button type="submit" class="btn btn-gradient-primary mr-2">Generate</button>
                        <button class="btn btn-light">Cancel</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function set_min_date(){
                min = document.getElementById("start_date").value;
                document.getElementById("end_date").value = null;

                document.getElementById("end_date").min  = min;
            }
        </script>
    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>