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
                  <i class="mdi mdi-crosshairs-gps"></i>
                </span> Car Tracking </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">

            <!--  traker start-->



                <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-danger mb-5">Location </h4>

                    <form class="forms-sample">
                      
                      <div class="form-group">
                        <label class="mb-3">Select car</label>
                        
                        <div class="input-group col-xs-12">
                          
                          <select class="form-control file-upload-info" >
                            <?php 
                                foreach ($vehicle_data->result() as $row) {
                                    echo "<option value='".$row->id."''>".$row->title." - ".$row->registered_number."</option>";
                                }
                             ?>
                         </select>

                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary ml-3" type="button">Track</button>
                          </span>
                        </div>
                      </div>
                      
                      
                    </form>
                    
                    <!-- source from =  https://www.embedgooglemap.net/en/?gclid=Cj0KCQiAnb79BRDgARIsAOVbhRqu2cC2RGI1ESI87-N5bI1ei8kmfskNZkPgoxyKfzOymGafr0QTRbsaAoHVEALw_wcB-->

                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <iframe width="100%" height="800" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                
                            </iframe>
                            
                        </div>
                        <style>
                            .mapouter{
                                position:relative;
                                text-align:right;
                                height:800px;
                                width:100%;
                                }
                                .gmap_canvas {
                                    overflow:hidden;
                                    background:none!important;
                                    height:800px;
                                    width:100%;
                                }
                        </style>
                    </div>
                   
                    
                  </div>
                </div>
              </div>
            <!-- tracker end-->


        </div>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>