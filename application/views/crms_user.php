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
                  <i class="mdi mdi-account-box"></i>
                </span> Staff User </h3>
            <nav aria-label="breadcrumb">
                <span id="liveTime"></span>
            </nav>
        </div>

        <div class="row">
            <?php 
                    $cashier_id="";
                    $admin_id="";
                    for($i=0;$i<sizeof($staff_details);$i++)
                    {
                        if($staff_details[$i]->role == "cashier")
                        {
                            $cashier_id = $staff_details[$i]->id;
                            $cashier_id[5] = $cashier_id[5]+1;
                        }
                    }

                    for($i=0;$i<sizeof($staff_details);$i++)
                    {
                        if($staff_details[$i]->role == "admin")
                        {
                            $admin_id = $staff_details[$i]->id;
                            $admin_id[5] = $admin_id[5]+1;
                        }
                    }
            ?>
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <?php
                            if($this->session->flashdata('staff_status'))
                            {
                        ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('staff_status'); ?>
                        </div>
                        <?php
                        }
                        ?>

                        <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#addStaffUser" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Staff User Details</button>

                        <div class="collapse mt-4" id="addStaffUser" aria-labelledby="customRadioInline2">
                            <?php echo form_open_multipart('Staff/StaffDetails'); ?>
                                <div class="form-group row mt-2">
                                    <label class="col-sm-3 col-form-label"><b>Role Type</b></label>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" onclick="roletype();" name="role_staff" id="cashier" value="cashier" checked> Cashier </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" onclick="roletype();" name="role_staff" id="admin" value="admin"> Admin </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="expenseVehicleID"><b><b>Staff ID</b></b></label>
                                    <input type="text" name="staff_cashier_id" id="usr_cashier" class="form-control" readonly value=<?php echo $cashier_id;?> >
                                    <input type="text" name="staff_admin_id" id="usr_admin" class="form-control" readonly value=<?php echo $admin_id;?> >
                                </div>
                                
                                <div class="form-group">
                                    <label for="expensedVehicleDate"><b>Full Name</b></label>
                                    <input type="text" class="form-control" name="full_name" id="expensedVehicleDate" placeholder="Staff Full Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="expenseAmount"><b>NIC</b></label>
                                    <input type="text" class="form-control" name="nic" id="expenseAmount" placeholder="Staff NIC Number" required>
                                </div>
                                <div class="form-group">
                                    <label for="expenseAmount"><b>Email</b></label>
                                    <input type="email" class="form-control" name="email" id="expenseAmount" placeholder="Staff Email Address" required>
                                </div>
                                <div class="form-group">
                                    <label for="expenseAmount"><b>Phone No</b></label>
                                    <input type="text" class="form-control" name="phone_no" id="expenseAmount" placeholder="Staff Phone Number" required>
                                </div>
                                <div class="form-group">
                                    <label for="expenseAmount"><b>Address</b></label>
                                    <textarea  id="" cols="30" rows="4" name="address" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="expenseAmount"><b>Upload Picture</b></label>
                                    <input type="file" class="form-control file-upload-info" name="staff_picture"  placeholder="Staff Picture" required>
                                </div>
                                
                                
                                <div class="form-group mt-3">
                                    <label for="expenseAmount"><b>PasswordPassword</b></label>
                                    <input type="password" class="form-control" name="password" id="expenseAmount" placeholder="Add new Password" required>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Staff User Details</h4>
                        <div style="overflow-x:auto;">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>NIC</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($staff_details as $value):?>
                                        <tr>
                                            <td><?php echo $value->id; ?></td>
                                            <td><?php echo $value->name; ?></td>
                                            <td><?php echo $value->nic; ?></td>
                                            <td><?php echo $value->email; ?></td>
                                            <td><?php echo $value->phone; ?></td>
                                            <td><?php echo $value->role; ?></td>
                                            <td><?php echo $value->address; ?></td>
                                            <td>
                                                <a href=""><span class="mdi mdi-eyedropper text-success"> Edit</span></a>
                                                <a href=""><span class="mdi mdi-close-circle text-danger ml-4"> Remove</span></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- content-wrapper ends -->

<script type="text/javascript">
    window.onload = function(){
        document.getElementById('usr_admin').style.display = 'none';
    }
    function roletype()
    {
        if(document.getElementById('cashier').checked)
        {
            document.getElementById('usr_admin').style.display = 'none';
            document.getElementById('usr_cashier').style.display = 'block';
        }
        if(document.getElementById('admin').checked)
        {
            document.getElementById('usr_cashier').style.display = 'none';
            document.getElementById('usr_admin').style.display = 'block';
        }
    }
</script>
<?php require_once 'crms_footer.php';?>
