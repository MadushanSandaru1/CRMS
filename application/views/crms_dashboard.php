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


        <?php

            if($this->session->userdata('user_role') == 'admin') {
                require_once 'dash_admin_item.php';
            } else {
                require_once 'dash_cashier_item.php';
            }

        ?>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>