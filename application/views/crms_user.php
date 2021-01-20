<?php

    //session timeout error
    if (!$this->session->userdata('user_id')) {
        $this->session->set_flashdata('user_status', 'Session timeout');

        //redirect to sign in page
        redirect('Home/crms_signin');
    }

?>
<!--include the Header part-->
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
<!--icon display with Staff user-->
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-account-box"></i>
                </span> Staff User </h3>
            <nav aria-label="breadcrumb">
<!--                <span id="liveTime"></span>-->
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
<!--            add user-->
            <div class="col-12 grid-margin stretch-card" id="add_user">
                <div class="card">
                    <div class="card-body">

                        <?php
                        if($this->session->flashdata('staff_status'))
                        {
                            ?>
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $this->session->flashdata('staff_status'); ?>
                            </div>
                            <br>
                            <?php
                        }
                        ?>
<!--Scroll button to go up and down-->

<!--collapse - when click the button display form to fill  -->
                        <button type="button" class="btn btn-gradient-primary mb-2" data-toggle="collapse" href="#addStaffUser" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Staff User Details</button>

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
                                    <input type="text" name="staff_cashier_id" id="usr_cashier" class="form-control" readonly value=<?php echo $cashier_id;?>>
                                    <input type="text" name="staff_admin_id" id="usr_admin" class="form-control" readonly value=<?php echo $admin_id;?> >
                                </div>
                                
                                <div class="form-group">
                                    <label for="full_name"><b>Full Name</b></label>
                                    <input type="text" class="form-control" name="full_name" id="full_name" placeholder="A. B. Abhaya Car" maxlength="50" pattern="[A-Za-z .]+" title="Numbers and special characters are not allowed.">
                                    <small class="text-danger"><?php echo form_error('full_name'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="nic"><b>NIC</b></label>
                                    <input type="text" class="form-control" pattern="[0-9]{9}[v|V|x|X]|[0-9]{12}"  name="nic" id="nic" placeholder="xxxxxxxxxV | xxxxxxxxxxxx" maxlength="12" title="Please enter a according to correct pattern.">
                                    <small class="text-danger"><?php echo form_error('nic'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="email"><b>Email</b></label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="example@abhaya.com" maxlength="100">
                                    <small class="text-danger"><?php echo form_error('email'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="phone_no"><b>Phone No</b></label>
                                    <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="0xxxxxxxxx" maxlength="10" pattern="0[0-9]{9}" title="Please follow the requested pattern">
                                    <small class="text-danger"><?php echo form_error('phone_no'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="address"><b>Address</b></label>
                                    <textarea  id="address" cols="30" rows="4" name="address" class="form-control" maxlength="255" placeholder="Beliatta, Matara."></textarea>
                                    <small class="text-danger"><?php echo form_error('address'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="staff_picture"><b>Upload Picture</b></label>
                                    <input type="file" name="staff_picture" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder=".jpg | .png | .jpeg">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Browse</button>
                                        </span>
                                    </div>
                                    <small class="text-danger"><?php echo form_error('staff_picture'); ?></small>
                                </div>
                                
                                
                                <div class="form-group mt-3">
                                    <label for="password"><i class="mdi mdi-star-circle text-danger"></i> <b>The password will be generated automatically and will be sent to the email you entered.</b></label>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-light">Cancel</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>

<!--            update-->
            <div class="col-12 grid-margin stretch-card" id="update_user">
                <div class="card">
                    <div class="card-body">

                        <?php
                        if($this->session->flashdata('staff_status'))
                        {
                            ?>
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $this->session->flashdata('staff_status'); ?>
                            </div>
                            <br>
                            <?php
                        }
                        ?>
<!--Scroll button to go up and down-->

<!--collapse - when click the button display form to fill  -->
                        <button type="button" class="btn btn-gradient-primary mb-2" data-toggle="collapse" href="#updateStaffUser" aria-expanded="false" aria-controls="viewDetails">Update Staff User Details</button>

                        <div class="collapse mt-4" id="updateStaffUser" aria-labelledby="customRadioInline2">
                            <?php echo form_open_multipart('Staff/updateStaffDetails'); ?>
<!--                                <div class="form-group row mt-2">-->
<!--                                    <label class="col-sm-3 col-form-label"><b>Role Type</b></label>-->
<!--                                    <div class="col-sm-2">-->
<!--                                        <div class="form-check">-->
<!--                                            <label class="form-check-label">-->
<!--                                            <input type="radio" class="form-check-input" onclick="roletype();" name="role_staff" id="cashier" value="cashier" checked> Cashier </label>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-sm-2">-->
<!--                                        <div class="form-check">-->
<!--                                            <label class="form-check-label">-->
<!--                                            <input type="radio" class="form-check-input" onclick="roletype();" name="role_staff" id="admin" value="admin"> Admin </label>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="form-group">
                                    <label for="expenseVehicleID"><b><b>Staff ID</b></b></label>
                                    <input type="text" name="staff_user_id" id="update_usr_id" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="full_name"><b>Full Name</b></label>
                                    <input type="text" class="form-control" name="update_full_name" id="update_full_name" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nic"><b>NIC</b></label>
                                    <input type="text" class="form-control" name="update_nic" id="update_nic" readonly>
                                    <small class="text-danger"><?php echo form_error('nic'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="email"><b>Email</b></label>
                                    <input type="email" class="form-control" name="update_email" id="update_email" placeholder="Staff Email Address" >
                                    <small class="text-danger"><?php echo form_error('email'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="phone_no"><b>Phone No</b></label>
                                    <input type="text" class="form-control" name="update_phone_no" id="update_phone_no" placeholder="0xxxxxxxxx" pattern="0[0-9]{9}">
                                    <small class="text-danger"><?php echo form_error('phone_no'); ?></small>
                                </div>
<!--                                <div class="form-group">-->
<!--                                    <label for="address"><b>Address</b></label>-->
<!--                                    <textarea  id="" cols="30" rows="4" name="update_address" id="update_address" class="form-control" ></textarea>-->
<!--                                    <small class="text-danger">--><?php //echo form_error('address'); ?><!--</small>-->
<!--                                </div>-->
                                <div class="form-group">
                                    <label for="staff_picture"><b>Upload Picture</b></label>
                                    <input type="file" name="update_staff_picture" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Staff Picture">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                        </span>
                                    </div>
                                    <small class="text-danger"><?php echo form_error('staff_picture'); ?></small>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                                <button class="btn btn-light">Cancel</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title text-danger">Staff User Details</h4>

                            <!-- search bar-->
                            <div class="search-field d-none d-md-block">
                                <input type="text" id="searchTxt" onkeyup="searchTable()" class="form-control bg-light text-danger form-control-sm border-danger border-left-0 border-right-0 border-top-0" placeholder="Search...">
                            </div>
                        </div>

                        <div style="overflow-x:auto;">
                            <table class="table table-hover" id="staffuserTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>NIC</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th class="d-none">Role</th>
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
                                            <td class="d-none"><?php echo $value->role; ?></td>
                                            <td><?php echo $value->address; ?></td>
                                            <td>
                                            <?php if($value->role == "cashier"){ ?>
                                                <a  id="view" data-toggle="collapse" href="#updateStaffUser" aria-expanded="false" aria-controls="updateStaffUser"><span class="mdi mdi-eyedropper text-success ml-4" onclick="update_staff_user('<?php echo $value->id;?>','<?php echo $value->email;?>','<?php echo $value->phone;?>','<?php echo $value->name;?>','<?php echo $value->nic;?>','<?php echo $value->address;?>')">Edit </span></a>
                                                <label class="cursor-pointer" data-toggle="modal" data-target="#deleteModal" onclick="delete_user('<?php echo$value->id; ?>')"> <span class="mdi mdi-close-circle text-danger ml-4"> Remove</span>
                                            <?php } else if(($value->role == "admin") or ($value->id == $this->session->userdata('user_id'))){ ?>
                                                <a  id="view" data-toggle="collapse" href="#updateStaffUser" aria-expanded="false" aria-controls="updateStaffUser"><span class="mdi mdi-eyedropper text-success ml-4" onclick="update_staff_user('<?php echo $value->id;?>','<?php echo $value->email;?>','<?php echo $value->phone;?>','<?php echo $value->name;?>','<?php echo $value->nic;?>','<?php echo $value->address;?>')">Edit </span></a>
                                            <?php } ?>
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('Staff/prepareToDeleteUser');?>
            <form>
                <div class="modal-body">
                    Are you sure want to delete this recode.
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="deluserid" id="deluserid" required>
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </form>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    //admin id field hide when page load
    window.onload = function(){
        document.getElementById('usr_admin').style.display = 'none';
    }

    //auto generate id by role type
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

    //delete staff user
    function delete_user(del_user_id){
        document.getElementById("deluserid").value = del_user_id;
    }

    // table search
    function searchTable(){
        var input, filter, table, tr, td, cell, i, j;
        input = document.getElementById("searchTxt");
        filter = input.value.toUpperCase();
        table = document.getElementById("staffuserTable");
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

    function update_staff_user(id,email,phone,name,nic,address){

        //display form if clickd edit in view table
        document.getElementById("add_user").style.display = "none";
        document.getElementById("update_user").style.display = "block";

        //load data into form
        document.getElementById("update_usr_id").value = id;
        document.getElementById("update_full_name").value = name;
        document.getElementById("update_nic").value = nic;
        document.getElementById("update_email").value = email;
        document.getElementById("update_phone_no").value = phone;
        document.getElementById("update_address").value = address;

    }

</script>

<?php if(validation_errors()) { ?>
    <script type="text/javascript">
        document.getElementById("addStaffUser").classList.add("show");
    </script>
<?php } ?>

<?php require_once 'crms_footer.php';?>

<?php  if ($this->session->tempdata('form')=='add_form') { ?>
    <script>
        document.getElementById("add_user").style.display = "block";
        document.getElementById("update_user").style.display = "none";
    </script>
<?php }else if($this->session->tempdata('form')=='update_form'){ ?>
    <script>
        document.getElementById("update_user").style.display = "block";
        document.getElementById("add_user").style.display = "none";
    </script>
<?php }else{ ?>
    <script>
        document.getElementById("add_user").style.display = "block";
        document.getElementById("update_user").style.display = "none";
    </script>
<?php } ?>
