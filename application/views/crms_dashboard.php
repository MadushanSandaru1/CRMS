<?php

    //session timeout error
    if ((!$this->session->userdata('user_id')) && ($user_data->num_rows() <= 0)) {
        $this->session->set_flashdata('user_status', 'Session timeout');

        //redirect to sign in page
        redirect('Home/crms_signin');
    }

    if (!$this->session->userdata('user_id')) {
        $user_data_row = (array)$user_data->result()[0];
        $session_data = array(
            'user_id' => $user_data_row['id'],
            'user_name' => $user_data_row['name'],
            'user_nic' => $user_data_row['nic'],
            'user_email' => $user_data_row['email'],
            'user_phone' => $user_data_row['phone'],
            'user_address' => $user_data_row['address'],
            'user_image' => $user_data_row['image'],
            'user_role' => $user_data_row['role']
        );
        $this->session->set_userdata($session_data);
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
                  <i class="mdi mdi-home"></i>
                </span> Dashboard </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
<!--                        <span></span><i class="mdi mdi-clock icon-sm text-primary align-middle"></i>-->
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">New Pending Booking <i class="mdi mdi-bookmark mdi-24px float-right"></i>
                        </h4>
                        <?php
                        foreach ($new_booking_data->result() as $row) {
                        ?>
                            <h2 class="mb-5"><?php echo $row->new_booking_count; ?></h2>
                        <?php
                        }
                        ?>

                        <?php
                        foreach ($accepted_booking_data->result() as $row) {
                            ?>
                            <h6 class="card-text">Accepted Booking - <?php echo $row->accepted_booking_count; ?> </h6>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Weekly Income <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <?php
                        foreach ($weekly_income_data->result() as $row) {
                        ?>
                            <h2 class="mb-5">LKR <?php echo number_format($row->weekly_income,2); ?></h2>
                        <?php
                        }
                        ?>

                        <?php
                        foreach ($weekly_date_data->result() as $row) {
                            ?>
                            <h6 class="card-text"><?php echo $row->start_date; ?> <small>to</small> <?php echo $row->end_date; ?> </h6>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Weekly Expenses <i class="mdi mdi-chart-areaspline mdi-24px float-right"></i>
                        </h4>
                        <?php
                        foreach ($weekly_expense_data->result() as $row) {
                            ?>
                            <h2 class="mb-5">LKR <?php echo number_format($row->weekly_expense,2); ?></h2>
                            <?php
                        }
                        ?>

                        <?php
                        foreach ($weekly_date_data->result() as $row) {
                            ?>
                            <h6 class="card-text"><?php echo $row->start_date; ?> <small>to</small> <?php echo $row->end_date; ?> </h6>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Monthly Income <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <?php
                        foreach ($monthly_income_data->result() as $row) {
                            ?>
                            <h2 class="mb-5">LKR <?php echo number_format($row->monthly_income,2); ?></h2>
                            <?php
                        }
                        ?>

                        <?php
                        foreach ($monthly_date_data->result() as $row) {
                            ?>
                            <h6 class="card-text"><?php echo $row->start_date; ?> <small>to</small> <?php echo $row->end_date; ?> </h6>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-dark card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Monthly Expenses <i class="mdi mdi-chart-areaspline mdi-24px float-right"></i>
                        </h4>
                        <?php
                        foreach ($monthly_expense_data->result() as $row) {
                            ?>
                            <h2 class="mb-5">LKR <?php echo number_format($row->monthly_expense,2); ?></h2>
                            <?php
                        }
                        ?>

                        <?php
                        foreach ($monthly_date_data->result() as $row) {
                            ?>
                            <h6 class="card-text"><?php echo $row->start_date; ?> <small>to</small> <?php echo $row->end_date; ?> </h6>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-warning card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Damage Vehicles <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <?php
                        foreach ($damage_vehicles_data->result() as $row) {
                        ?>
                            <h2 class="mb-5"><?php echo $row->damage_vehicles; ?></h2>
                        <?php
                        }
                        ?>

                        <?php
                        foreach ($monthly_damage_data->result() as $row) {
                        ?>
                            <h6 class="card-text">Damages this months - <?php echo $row->monthly_damage; ?> </h6>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>