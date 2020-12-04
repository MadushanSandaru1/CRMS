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
                  <i class="mdi mdi-account-circle"></i>
                </span> Profile </h3>
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

                        <div id="addProfile">
                            <div>
                                <img src="<?php echo base_url('assets/images/users/'.$this->session->userdata('user_image'));?>" class="rounded-circle" alt="Profile pic" width="20%">
                            </div>
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
                            <div class="form-group">
                                <label for="profileAddress">Address</label>
                                <textarea class="form-control" id="profileAddress" name="guarantorAddress" rows="4" placeholder="address"> </textarea>
                                <small class="text-danger"><?php echo form_error('profileAddress'); ?></small>
                            </div>
                            <div class="border border-danger p-5">
                                <a name="change_pwd_div"></a>
                                <?php echo form_open('User/change_profile_pwd');  ?>
                                <div class="form-group">
                                    <label for="new_password">New password</label>
                                    <input type="text" class="form-control" name="new_password" id="new_password">
                                    <small class="text-danger"><?php echo form_error('new_password'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm password</label>
                                    <input type="text" class="form-control" name="confirm_password" id="confirm_password">
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

        <script>
            let address=<?php echo json_encode($this->session->userdata('user_address')); ?>;
            document.getElementById("profileAddress").value = address;
        </script>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>