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
                </span> Car Income/Expenses </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">

                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <?php
                        if($this->session->flashdata('expense_status'))
                        {
                            ?>
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $this->session->flashdata('expense_status'); ?>
                            </div>
                            <br>
                            <?php
                        }
                        ?>

                        <button type="button" name="add_expenses_collapse" class="btn btn-gradient-primary mb-2" data-toggle="collapse" href="#addExpense" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Vehicle Expense Details</button>

                        <div class="collapse" id="addExpense" aria-labelledby="customRadioInline2">
                            <?php echo form_open('Expense/add_expense');  ?>
                                <div class="form-group mt-2">
                                    <label for="expenseVehicleID">Vehicle ID</label>
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
                                    <label for="expensedVehicleDate">Date</label>
                                    <input type="datetime-local" class="form-control" name="expensedVehicleDate" id="expensedVehicleDate" placeholder="Date" max="<?php echo Date('Y-m-d\TH:i',time()) ?>" value="<?php if($this->session->tempdata('expensedVehicleDate_fill')) echo $this->session->tempdata('expensedVehicleDate_fill'); else echo Date('Y-m-d\TH:i',time()); ?>" readonly>
                                    <small class="text-danger"><?php echo form_error('expensedVehicleDate'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="expenseAmount">Amount</label>
                                    <input type="number" step="0.01" class="form-control" name="expenseAmount" id="expenseAmount" placeholder="1000.00" value="<?php if($this->session->tempdata('expenseAmount_fill')) echo $this->session->tempdata('expenseAmount_fill'); ?>">
                                    <small class="text-danger"><?php echo form_error('expenseAmount'); ?></small>
                                </div>
                                <button type="submit" name="expenses_btn" class="btn btn-gradient-primary mr-2">Submit</button>
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
                        <h4 class="card-title text-danger">Vehicle Income/Expenses Details</h4>

                        <!-- search bar-->
                        <div class="search-field d-none d-md-block">
                            <input type="text" id="searchTxt" onkeyup="searchTable()" class="form-control bg-light text-danger form-control-sm border-danger border-left-0 border-right-0 border-top-0" placeholder="Search...">
                        </div>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="table table-hover" id="expensesTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Vehicle ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($vehicle_expense_data->num_rows() > 0) {
                                foreach ($vehicle_expense_data->result() as $data_row){
                            ?>
                            <tr class="<?php if($data_row->type=="E") echo "table-danger"; else echo "table-success"; ?>">
                                <td class="nr"><?php echo $data_row->id; ?></td>
                                <td><?php echo $data_row->vehicle_id.' - '.$data_row->registered_number; ?></td>
                                <td><?php echo $data_row->date; ?></td>
                                <td class="text-right"><?php echo number_format($data_row->amount,2); ?></td>
                                <td><?php echo $data_row->type; ?></td>
                            </tr>
                            <?php
                                }
                            }
                            else {
                                ?>
                                <tr>
                                    <td colspan="6"  class="text-danger">No Data Found</td>
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
            document.getElementById("addExpense").classList.add("show");
        </script>
        <?php } ?>

        <script type="text/javascript">
            // table search
            function searchTable(){
                var input, filter, table, tr, td, cell, i, j;
                input = document.getElementById("searchTxt");
                filter = input.value.toUpperCase();
                table = document.getElementById("expensesTable");
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
        </script>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>