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
                            <?php echo form_open('Profile/update_profile');  ?>
                            <div class="form-group">
                                <label for="expenseAmount">Id</label>
                                <input type="text" class="form-control" name="profileId" id="profileId" value="">
                                <small class="text-danger"><?php echo form_error('profileId'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="expenseAmount">Name</label>
                                <input type="text" class="form-control" name="profileName" id="profileName" value="">
                                <small class="text-danger"><?php echo form_error('profileName'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="expenseAmount">NIC</label>
                                <input type="text" class="form-control" name="profileNic" id="profileNic" value="">
                                <small class="text-danger"><?php echo form_error('profileNic'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="expenseAmount">Email</label>
                                <input type="text" class="form-control" name="profileEmail" id="profileEmail" value="">
                                <small class="text-danger"><?php echo form_error('profileEmail'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="expenseAmount">Phone</label>
                                <input type="text" class="form-control" name="profilePhone" id="profilePhone" value="">
                                <small class="text-danger"><?php echo form_error('profilePhone'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="expenseAmount">Address</label>
                                <input type="text" class="form-control" name="profileAddress" id="profileAddress" value="">
                                <small class="text-danger"><?php echo form_error('profileAddress'); ?></small>
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
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>