<?php
    if ($this->session->userdata('user_id')) {
        redirect('Home/crms_dash');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- page title -->
        <title>Abhaya rent a car</title>

        <!-- page title icon -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png');?>" />

        <!-- css -->
        <link rel="stylesheet" href="<?php echo base_url('assets/vendors/mdi/css/materialdesignicons.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
    </head>

    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth">
                    <div class="row flex-grow">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-left p-5">
                                <!-- logo -->
                                <div class="brand-logo">
                                    <img src="<?php echo base_url('assets/images/logo.png');?>">
                                </div>
                                <h4>Recover Password</h4>
                                <h6 class="font-weight-light">Don't worry, happens to the best of us.</h6>

                                <!-- password recover form -->
                                <?php echo form_open('User/recover_password'); ?>
                                <div class="pt-3">
                                    <!-- username -->
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" name="recover_email" placeholder="Email">
                                        <small class="text-danger"><?php echo form_error('recover_email'); ?></small>
                                    </div>

                                    <!-- recover button code -->
                                    <div class="mt-3">
                                        <button type="submit" name="recover_code_btn" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">GET RESET CODE</button>
                                    </div>

                                    <div class="my-2 d-flex justify-content-center align-items-center">
                                        <!-- back to sign in button -->
                                        <a href="<?php echo base_url('index.php/Home/crms_signin'); ?>" class="mt-2 auth-link text-black">Back to sign in</a>
                                    </div>
                                </div>
                                <!-- ** password recover form -->

                                <?php echo form_close(); ?>
                                <div class="text-danger">
                                    <?php
                                    if($this->session->flashdata('recover_status'))
                                    {
                                        echo $this->session->flashdata('recover_status');
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- js -->
        <script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js');?>"></script>
        <script src="<?php echo base_url('assets/js/off-canvas.js');?>"></script>
        <script src="<?php echo base_url('assets/js/hoverable-collapse.js');?>"></script>
        <script src="<?php echo base_url('assets/js/misc.js');?>"></script>

    </body>
</html>