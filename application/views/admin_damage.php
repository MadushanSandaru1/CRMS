<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="<?php echo base_url('assets/css/admin_font-face.css');?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/js/vendor/vendor/font-awesome-4.7/css/font-awesome.min.css')?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/js/vendor/vendor/font-awesome-5/css/fontawesome-all.min.css')?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/js/vendor/vendor/mdi-font/css/material-design-iconic-font.min.css')?>" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?php echo base_url('assets/js/vendor/vendor/bootstrap-4.1/bootstrap.min.css')?>" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?php echo base_url('assets/js/vendor/vendor/animsition/animsition.min.css')?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/js/vendor/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/js/vendor/vendor/wow/animate.css')?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/js/vendor/vendor/css-hamburgers/hamburgers.min.css')?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/js/vendor/vendor/slick/slick.css')?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/js/vendor/vendor/animsition/animsition.min.css')?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/js/vendor/vendor/perfect-scrollbar/perfect-scrollbar.css')?>" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?php echo base_url('assets/css/admin_theme.css')?>" rel="stylesheet" media="all">

    <!--logo-->
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/fav_icon');?>"/>
    <style>
        ::-webkit-scrollbar{
            color: #007aff;
        }

        ::-webkit-scrollbar-track{
            border: 9px solid #e0e0e0;
        }

        ::-webkit-scrollbar-thumb{
            background: #04091d;
        }

    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php include('admin.php');?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->

            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                        	
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Maintain</strong> Damage Details
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Vehicle No :</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="vehicle_no" class="form-control">
                                                    	<option value="KY 2019">KY 2019</option>
                                                    	<option value="KZ 9012">KZ 9012</option>
                                                    </select>
                                                    <small class="form-text text-muted">This is a vehicle number</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Nature of Damage</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="" name="" placeholder="Nature of Damage" class="form-control">
                                                    <small class="help-block form-text">Please enter damage nature</small>
                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Reserved From</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="" name="" placeholder="Reserved from" class="form-control">
                                                    <small class="help-block form-text">Please enter reserved person</small>
                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Fix Amount</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="" name="" placeholder="Fix Amount" class="form-control">
                                                    <small class="help-block form-text">Please enter fix amount</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="password-input" class=" form-control-label">Upload Picture</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="" name="" placeholder="" class="form-control">
                                                    <small class="help-block form-text">Please upload picture of nature of your damage</small>
                                                </div>
                                            </div>
                                           
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Is Resolved : </label>
                                                </div>
                                                <div class="col col-md-9">
                                                    <div class="form-check">
                                                        <div class="radio">
                                                            <label for="radio1" class="form-check-label ">
                                                                <input type="radio" id="radio1" name="radios" value="option1" class="form-check-input">Yes
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio2" class="form-check-label ">
                                                                <input type="radio" id="radio2" name="radios" value="option2" class="form-check-input">No
                                                            </label>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="row form-group">
                                                
                                                <div class="col-12 col-md-9">
                                                    <input type="submit" id="" name="" class="btn btn-success" value="Add Details">
                                                    <input type="reset" id="" name="" class="btn btn-warning" value="Clear">
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        
                                    </div>
                                </div>
                       
                            </div>
                                                                                
                           
                            
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <!-- DATA TABLE -->
                                <div class="card">
                                	<div class="card-header"><h3 class="title-5 m-b-35">damage details</h3></div>
                                	<div class="card-body">
                                		<div class="table-data__tool">
                                    		<div class="table-data__tool-left">
                                        		 <div class="rs-select2--light rs-select2--md">
                                            			<select class="js-select2" name="property">
                                                			<option selected="selected">All Details</option>
                                                			<option value="">Resolved</option>
                                                			<option value="">Not Resolved</option>
                                            			</select>
                                            			<div class="dropDownSelect2"></div>
                                       			 </div>
                                        		<div class="rs-select2--light rs-select2--sm">
                                            			<select class="js-select2" name="time">
                                                			<option selected="selected">Today</option>
                                                			<option value="">This Month</option>
                                                			<option value="">Duration of Time</option>
                                            			</select>
                                            			<div class="dropDownSelect2"></div>
                                        		</div>
                                        		<button class="au-btn-filter">
                                            		<i class="zmdi zmdi-filter-list"></i>filters</button>
                                    			</div>
                                   			<div class="table-data__tool-right">
                                        			<button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            				<i class="zmdi zmdi-plus"></i>Genarate Report</button>
                                            		<!--		
                                        			<div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                            				<select class="js-select2" name="type">
                                                				<option selected="selected">Export</option>
                                                				<option value="">Option 1</option>
                                                				<option value="">Option 2</option>
                                            				</select>
                                            				<div class="dropDownSelect2"></div>
                                        			</div>
                                        		-->
                                    		</div>
                                		</div>
                                		<div class="table-responsive table-responsive-data2">
                                    			<table class="table table-data2">
                                        			<thead>
                                            			<tr>
                                                
                                                			<th>Vehicle No</th>
                                                			<th>Date</th>
                                                			<th>nature of damage</th>
                                                			<th>Picture</th>
                                                			<th>is resolved</th>
                                                
                                            			</tr>
                                        			</thead>
                                        			<tbody>
                                            				<tr class="tr-shadow">
                                               
                                                				<td>KZ 09877</td>
                                                				<td>
                                                    				<span>2018-09-27</span>
                                                				</td>
                                                				<td class="desc">Side Mirror damage</td>
                                                				<td>picture</td>
                                                				<td>
                                                    				<span class="status--process">yes</span>
                                                				</td>
                                               
                                                				<td>
                                                    				<div class="table-data-feature">
                                                        
                                                        					<button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            					<i class="zmdi zmdi-edit"></i>
                                                        					</button>
                                                        					<button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            					<i class="zmdi zmdi-delete"></i>
                                                        					</button>
                                                        					<button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                            					<i class="zmdi zmdi-more"></i>
                                                        					</button>
                                                    				</div>
                                                				</td>
                                            				</tr>
                                            
                                            				<tr class="tr-shadow">
                                               
                                               					 <td>KD 09047</td>
                                                				 <td>
                                                    				<span>2018-09-27</span>
                                                				 </td>
                                                				 <td class="desc">Side Mirror damage</td>
                                                				 <td>picture</td>
                                                				 <td>
                                                    				<span class="status--denied">No</span>
                                                				 </td>
                                               
                                                				 <td>
                                                    				 <div class="table-data-feature">
                                                        
                                                        				<button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            				<i class="zmdi zmdi-edit"></i>
                                                        				</button>
                                                        				<button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            				<i class="zmdi zmdi-delete"></i>
                                                        				</button>
                                                        				<button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                            				<i class="zmdi zmdi-more"></i>
                                                        				</button>
                                                    				</div>
                                                				</td>
                                            				</tr>
                                            
                                        			</tbody>
                                    			</table>
                                		</div>
                                	</div>
                                </div>
                                
                                
                                
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="<?php echo base_url('assets/js/vendor/vendor/jquery-3.2.1.min.js')?>"></script>
    <!-- Bootstrap JS-->
    <script src="<?php echo base_url('assets/js/vendor/vendor/bootstrap-4.1/popper.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/vendor/bootstrap-4.1/bootstrap.min.js')?>"></script>
    <!-- Vendor JS       -->
    <script src="<?php echo base_url('assets/js/vendor/vendor/slick/slick.min.js')?>">
    </script>
    <script src="<?php echo base_url('assets/js/vendor/vendor/wow/wow.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/vendor/animsition/animsition.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')?>">
    </script>
    <script src="<?php echo base_url('assets/js/vendor/vendor/counter-up/jquery.waypoints.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/vendor/counter-up/jquery.counterup.min.js')?>">
    </script>
    <script src="<?php echo base_url('assets/js/vendor/vendor/circle-progress/circle-progress.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/vendor/perfect-scrollbar/perfect-scrollbar.js')?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/vendor/chartjs/Chart.bundle.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/vendor/select2/select2.min.js')?>">
    </script>

    <!-- Main JS-->
    <script src="<?php echo base_url('assets/js/admin_main.js')?>"></script>

</body>

</html>
<!-- end document-->
