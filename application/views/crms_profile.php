<?php

    //session timeout error
    if (!$this->session->userdata('user_id')) {
        $this->session->set_flashdata('user_status', 'Session timeout');

        //redirect to sign in page
        redirect('Home/crms_signin');
    }

?>
<style>
    .img_hover:hover{
        cursor: pointer;
    }
</style>
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
                  <i class="mdi mdi-account-circle"></i>
                </span> Profile </h3>
            <nav aria-label="breadcrumb">
<!--                <span id="liveTime"></span>-->
            </nav>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div id="addProfile">
                            <center>
                            <div data-toggle="modal" class="img_hover" data-target="#profile_pic" title="Click Here to Change Profile Picture">
                                <img src="<?php echo base_url('assets/images/users/'.$this->session->userdata('user_image'));?>" class="rounded-circle" alt="Profile pic" width="20%">
                            </div>
                                <br>
                                <?php
                                if($this->session->flashdata('profile_status'))
                                {
                                    ?>
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo $this->session->flashdata('profile_status'); ?>
                                    </div>
                                    <br>
                                    <?php
                                }
                                ?>
                            </center>
                            <div class="form-group">
                                <label for="profileId">Id</label>
                                <input type="text" class="form-control" name="profileId" id="profileId" value="<?php echo $this->session->userdata('user_id'); ?>" readonly>
                                <small class="text-danger"><?php echo form_error('profileId'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="profileName">Name</label>
                                <input type="text" class="form-control" name="profileName" id="profileName" value="<?php echo $this->session->userdata('user_name'); ?>" readonly>
                                <small class="text-danger"><?php echo form_error('profileName'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="profileNic">NIC</label>
                                <input type="text" class="form-control" name="profileNic" id="profileNic" value="<?php echo $this->session->userdata('user_nic'); ?>" readonly>
                                <small class="text-danger"><?php echo form_error('profileNic'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="profileEmail">Email</label>
                                <input type="text" class="form-control" name="profileEmail" id="profileEmail" value="<?php echo $this->session->userdata('user_email'); ?>" readonly>
                                <small class="text-danger"><?php echo form_error('profileEmail'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="profilePhone">Phone</label>
                                <input type="text" class="form-control" name="profilePhone" id="profilePhone" value="<?php echo $this->session->userdata('user_phone'); ?>" readonly>
                                <small class="text-danger"><?php echo form_error('profilePhone'); ?></small>
                            </div>

                            <a name="passwordchangeform"></a>

                            <div class="form-group">
                                <label for="profileAddress">Address</label>
                                <textarea class="form-control" id="profileAddress" name="guarantorAddress" rows="4" placeholder="address" readonly> </textarea>
                                <small class="text-danger"><?php echo form_error('profileAddress'); ?></small>
                            </div>

                            <?php
                            if($this->session->flashdata('profile_status'))
                            {
                                ?>
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php echo $this->session->flashdata('profile_status'); ?>
                                </div>
                                <br>
                                <?php
                            }
                            ?>

                            <div class="border border-danger p-5">

                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" onclick="passwordShowHide()" name="show_hide_password" id="show_hide_password"> Show password </label>
                                        </div>
                                    </div>
                                </div>

                                <?php echo form_open('User/change_profile_pwd');  ?>
                                <div class="form-group">
                                    <label for="current_password">Current password</label>
                                    <input type="password" class="form-control" name="current_password" id="current_password">
                                    <small class="text-danger"><?php echo form_error('current_password'); ?></small>
                                    <small class="text-danger"><?php if($this->session->tempdata('current_password_fill')) echo $this->session->tempdata('current_password_fill'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New password</label>
                                    <div id="error_focus_point" tabindex="1"></div>
                                    <input type="password" class="form-control" name="new_password" id="new_password">
                                    <small class="text-danger"><?php echo form_error('new_password'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm password</label>
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                                    <small class="text-danger"><?php echo form_error('confirm_password'); ?></small>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-light">Cancel</button>
                                <?php echo form_close();  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- profile pic update model-->
        <div class="modal fade" id="profile_pic" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: #f5005e" id="exampleModalLongTitle">Update Profile Picture  <label id="i_reg_num"></label></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('Staff/update_profil_pic'); ?>
                        <form method="post">
                            <input type="hidden" id="i_ve_id" name="vehicle_id">
                            <center>
                                <div>
                                    <img src="<?php echo base_url('assets/images/users/'.$this->session->userdata('user_image'));?>" class="rounded-circle" alt="Profile pic" width=30%">
                                </div>

                            <br>
                            <div class="form-row">
                                <div class="form-group col-md-2"></div>
                                <div class="form-group col-md-8">
                                    <input type="file" name="update_profile_Image" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Browse</button>
                                        </span>&nbsp;&nbsp;&nbsp;
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>

                                </div>
                                <div class="form-group col-md-2"></div>
                            </div>
                            </center>
                        </form>
                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>
        </div>
        <!--end model -->
        <script>
            let address=<?php echo json_encode($this->session->userdata('user_address')); ?>;
            document.getElementById("profileAddress").value = address;

            <?php
                if(validation_errors()) {
            ?>
            document.getElementById('error_focus_point').focus();
            <?php
                }
            ?>

            //password visibility
            function passwordShowHide() {
                let x = document.getElementById("current_password");
                let y = document.getElementById("new_password");
                let z = document.getElementById("confirm_password");
                if (x.type === "password") {
                    x.type = "text";
                    y.type = "text";
                    z.type = "text";
                } else {
                    x.type = "password";
                    y.type = "password";
                    z.type = "password";
                }
            }

        </script>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>