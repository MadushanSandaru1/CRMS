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
        <!-- navbar -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- navbar logo -->
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="<?php echo base_url('index.php/Home/crms_dash'); ?>"><img src="<?php echo base_url('assets/images/logo.png');?>" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="<?php echo base_url('index.php/Home/crms_dash'); ?>"><img src="<?php echo base_url('assets/images/logo-mini.png');?>" alt="logo" /></a>
            </div>

            <!-- navbar icons -->
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <!-- sidebar minimize icon -->
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>

                <!-- search bar-->
                <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-danger border-left-0 border-right-0 border-top-0" placeholder="Search projects">
                        </div>
                    </form>
                </div>

                <ul class="navbar-nav navbar-nav-right">
                    <!-- profile dropdown -->
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="<?php echo base_url('assets/images/faces/face1.jpg');?>" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text"><p class="mb-1 text-black">David Greymaax</p></div>
                        </a>

                        <!-- profile dropdown list -->
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="<?php echo base_url('index.php/Home/crms_profile'); ?>"><i class="mdi mdi-account-circle mr-2 text-success"></i> Profile </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                        </div>
                    </li>

                    <!-- full screen icon -->
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link"><i class="mdi mdi-fullscreen" id="fullscreen-button"></i></a>
                    </li>

                    <!-- message icon -->
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-message-outline"></i>
                            <span class="count-symbol bg-warning"></span>
                        </a>

                        <!-- message list -->
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                            <h6 class="p-3 mb-0">Messages</h6>

                            <!-- message item -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="<?php echo base_url('assets/images/faces/face4.jpg');?>" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                                </div>
                            </a>
                            <!-- ** message item -->

                            <div class="dropdown-divider"></div>

                            <!-- message link -->
                            <a href="<?php echo base_url('index.php/Home/crms_message'); ?>"><h6 class="p-3 mb-0 text-center">See all messages</h6></a>
                        </div>
                    </li>
                    <!-- ** message icon -->

                    <!-- notification icon -->
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count-symbol bg-danger"></span>
                        </a>

                        <!-- notification list -->
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0">Notifications</h6>

                            <!-- notification item -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success"><i class="mdi mdi-calendar"></i></div>
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                                </div>
                            </a>
                            <!-- ** notification item -->

                            <div class="dropdown-divider"></div>

                            <!-- notification link -->
                            <a href="<?php echo base_url('index.php/Home/crms_notification'); ?>"><h6 class="p-3 mb-0 text-center">See all notifications</h6></a>
                        </div>
                    </li>
                    <!-- ** notification icon -->

                    <!-- logout icon -->
                    <li class="nav-item nav-logout d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                    <!-- ** logout icon -->

                    <!-- settings icon -->
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li>
                    <!-- ** settings icon -->
                </ul>

                <!-- mobile view toggle icon -->
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
                <!-- ** mobile view toggle icon -->
            </div>
        </nav>
        <!-- ** navbar -->

        <div class="container-fluid page-body-wrapper">

            <!-- sidebar -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">

                    <!-- profile -->
                    <li class="nav-item nav-profile">
                        <a href="<?php echo base_url('index.php/Home/crms_profile'); ?>" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="<?php echo base_url('assets/images/faces/face1.jpg');?>" alt="profile">
                                <span class="login-status online"></span> <!--change to offline or busy as needed -->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">David Grey. H</span>
                                <span class="text-secondary text-small">Administrator</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <!-- ** profile -->

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('index.php/Home/crms_dash'); ?>">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('index.php/Home/crms_user'); ?>">
                            <span class="menu-title">Staff User</span>
                            <i class="mdi mdi-account-box menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('index.php/Home/crms_car'); ?>">
                            <span class="menu-title">Car</span>
                            <i class="mdi mdi-car menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('index.php/Home/crms_customer'); ?>">
                            <span class="menu-title">Customer</span>
                            <i class="mdi mdi-account menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('index.php/Home/crms_reserved'); ?>">
                            <span class="menu-title">Car Reserved</span>
                            <i class="mdi mdi-car menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('index.php/Home/crms_booking'); ?>">
                            <span class="menu-title">Car Booking</span>
                            <i class="mdi mdi-bookmark-plus menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('index.php/Home/crms_tracking'); ?>">
                            <span class="menu-title">Car Tracking</span>
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">Other</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-settings menu-icon"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('index.php/Home/crms_damage'); ?>">Car Damage</a></li>
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('index.php/Home/crms_expenses'); ?>">Car Expenses</a></li>
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('index.php/Home/crms_outsourcing'); ?>">Car Outsourcing</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item sidebar-actions">
                        <span class="nav-link">
                            <div class="border-bottom">
                                <h6 class="font-weight-normal mb-3">Reports</h6>
                            </div>

                            <div class="mt-4">
                                <div class="border-bottom">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('index.php/Home/crms_damage_report'); ?>">Damage Report</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('index.php/Home/crms_inc_exp_report'); ?>">Income/Expense Report</a></li>
                                    </ul>
                                </div>

                            </div>
                        </span>
                    </li>

                </ul>
            </nav>
            <!-- ** sidebar -->

            <!-- page content -->
            <div class="main-panel">