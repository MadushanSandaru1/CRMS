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
                  <i class="mdi mdi-clipboard-text"></i>
                </span> Damage Report </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="color: #F7396F;">Damage Details</h4>
                        <!--<p class="card-description"> Add class <code>.table</code></p>-->
                    
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Vehicle ID</th>
                                    <th>Date</th>
                                    <th>Discription</th>
                                    <th>Reserved ID</th>
                                    <th style="text-align: center;">Picture</th>
                                    <th>Fix Amount</th>
                                    <th>Is Solved</th>
                                    <th style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                          	        <td>Ruvindu</td>
                          	        <td>12 May 2020</td>
                          	        <td>left or Right Signal light</td>
                          	        <td>53275531</td>
                          	        <td><input type="submit" name="" class="btn btn-success" value="View"></td>
                          	        <td>1000 LKR/-</td>
                          	        <td><b style="color: red;">Not yet</b></td>
                          	        <td>
                          		        <input type="submit" name="" class="btn btn-primary" value="Edit">
                          		        <input type="submit" name="" class="btn btn-gradient-primary" value="Remove"></td>
                          	        </td>

                                </tr>
                       	        <tr>
                          	        <td>Madushan</td>
                          	        <td>12 May 2020</td>
                          	        <td>left or Right Signal light</td>
                          	        <td>53275531</td>
                          	        <td><input type="submit" name="" class="btn btn-success" value="View"></td>
                          	        <td>1000 LKR/-</td>
                          	        <td><b style="color: green;">Yes</b></td>
                          	        <td>
                          		        <input type="submit" name="" class="btn btn-primary" value="Edit">
                          		        <input type="submit" name="" class="btn btn-gradient-primary" value="Remove"></td>
                          	        </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>