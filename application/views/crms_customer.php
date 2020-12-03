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
                  <i class="mdi mdi-account"></i>
                </span> Customer </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span><i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">

            <!-- add customer form start-->



                <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">

                    
                    <?php 
                    // Success status
                      if ($this->session->flashdata('status')) {
                          echo " <div class=\"alert alert-success\">";
                          echo $this->session->flashdata('status');
                          echo "</div>";
                      }


                    // errors status
//                      $errors = explode("\n",strip_tags(validation_errors()));
//
//                      foreach ($errors as $error) {
//                        if(strcmp("", $error)){
//                          echo "<div class=\"alert alert-danger\">";
//                          echo $error;
//                          echo "</div>";
//                        }
//                      }
                    ?>
                      <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#addCustomer" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Customer Details</button>

                      <div class="collapse " id="addCustomer" aria-labelledby="customRadioInline2">
                    <?php echo form_open_multipart('Customer/prepareToInsertCustomer');?>
                    <form class="forms-sample">
                      <div class="form-group">
                        <label class="ml-1 mt-2"><b>Customer's photograph</b></label>
                        <div class="row">
                          
                          <div class="col-12 photgraph-outer mt-2 mb-2">
                            <div>
                              <div class="inputCamera" ></div>
                              <div class="shutterbtn"><button type="button" class="btn btn-gradient-primary " onclick="take_pictuer()" data-toggle="modal" data-target="#previewModal" ><span class="mdi mdi-camera "> Capture</span></button></div>
                              <div id="capturedFrame" ></div>
                            </div>
                          </div> 

                        </div>
                        <input type="hidden" name="avatarReady" id="InputAvatar" value="">
                      </div>
                      <div class="form-group">
                        <label for="InputName">Name</label>
                        <input type="text" class="form-control" id="InputName" placeholder="Name" name="name">
                          <small class="text-danger"><?php echo form_error('name'); ?></small>
                      </div>
                      <div class="form-group">
                        <label for="InputNIC">NIC</label>
                        <input type="text" class="form-control" id="InputNIC" placeholder="NIC" name="nic">
                      </div>
                      <div class="form-group">
                        <label for="InputEmail">Email address</label>
                        <input type="email" class="form-control" id="InputEmail" placeholder="Email address" name="email">
                      </div>
                      <div class="form-group">
                        <label for="InputPhone">Phone</label>
                        <input type="text" class="form-control" id="InputPhone" placeholder="Phone" name="phone">
                      </div>
                      <div class="form-group">
                        <label for="InputAddress">Address</label>
                        <textarea class="form-control" id="InputAddress" rows="4" placeholder="Phone" name="address"> </textarea>
                      </div>

                      <div class="form-group">
                        <label>NIC Copy</label>
                        <input type="file" name="nic_copy" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>License Copy</label>
                        <input type="file" name="license_copy" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Light Bill Copy</label>
                        <input type="file" name="light_bill_copy" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                      <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
                    <?php echo form_close(); ?>
                      </div>
                    
                  </div>
                </div>
              </div>
            <!-- add customer form end-->


            

              <!--Preveiw image Modal-->
              <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
                <div class="modal-dialog prev-modal" role="document" >
                  <div class="modal-content prev-modal" >
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Save image</h5>
                    </div>
                    <div class="modal-body shutterbtn">
                      <div id="preivFrame" ></div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveSnap()">Save</button>
                    </div>
                  </div>
                </div>
              </div>


            <!-- view customer table start-->

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-danger">Customers Details</h4>
                      <div style="overflow-x:auto;">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th> Name </th>
                              <th> NIC </th>
                              <th> Email </th>
                              <th> Phone </th>
                              <th> Address </th>
                              <th> NIC Copy </th>
                              <th> License Copy </th>
                              <th> Light Bill Copy </th>

                              <th colspan="2"> Action </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 

                              if ($customer_data->num_rows() > 0) { 
                                  foreach($customer_data->result() as $row){ 
                              ?>  <tr>
                                  <td><?php echo $row->name;?></td>
                                  <td><?php echo $row->nic;?></td>
                                  <td><?php echo $row->email;?></td>
                                  <td><?php echo $row->phone;?></td>
                                  <td><?php echo $row->address;?></td>
                                  <td><a href="<?php echo base_url('assets/images/customers/documentation/'.$row->nic_copy); ?>" target="_blank"><span class="mdi mdi-content-copy"> View</span></a></td>
                                  <td><a href="<?php echo base_url('assets/images/customers/documentation/'.$row->license_copy); ?>" target="_blank"><span class="mdi mdi-content-copy"> View</span></a></td>
                                  <td><a href="<?php echo base_url('assets/images/customers/documentation/'.$row->light_bill_copy); ?>" target="_blank"><span class="mdi mdi-content-copy"> View</span></a></td>
                                  <td>
                                      <a href="" data-toggle="modal" data-target="#editmodel" onclick="loadCustomerData(<?php echo $row->id.",'".$row->name."','".$row->nic."','".$row->email."','".$row->phone."','".$row->address."','".$row->nic_copy."','".$row->license_copy."','".$row->light_bill_copy."'" ?>)"><span class="mdi mdi-eyedropper text-success"> Edit</span></a>
                                      <a href=""><span class="mdi mdi-close-circle text-danger ml-4"> Remove</span></a>
                                  </td>
                              </tr>
                              <?php 
                                  }
                                }else{
                              ?>
                              <tr><td colspan="9" class="text-danger">No Data Found</td></tr>
          
                              <?php } ?>

                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>

              <script type="text/javascript">
                
                function loadCustomerData(id,name,nic,email,phone,address,nic_copy,license_copy,light_bill_copy){
                  document.getElementById("EditID").value = id;
                  document.getElementById("EditName").value = name;
                  document.getElementById("EditNIC").value = nic;
                  document.getElementById("EditEmail").value = email;
                  document.getElementById("EditPhone").value = phone;
                  document.getElementById("EditAddress").value = address;
                  document.getElementById("EditNicCopy").value = nic_copy;
                  document.getElementById("EditLicenseCopy").value = license_copy;
                  document.getElementById("EditLightBillCopy").value = light_bill_copy;

                }
              </script>


              <!-- Edit Modal -->
              <div class="modal fade" id="editmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Customer Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      
                      <!-- edit start -->
                      <div class="col-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <!--h4 class="card-title text-danger mb-5">Add new customer</h4-->

                          <?php echo form_open_multipart('Customer/prepareToUpdateCustomer');?>
                          <form class="forms-sample">
                            <div class="form-group">
                              
                              <input type="hidden" id="EditID" name="edit_id" >

                              <label for="EditName">Name</label>
                              <input type="text" class="form-control" id="EditName" placeholder="Name" name="edit_name">
                            </div>
                            <div class="form-group">
                              <label for="EditNIC">NIC</label>
                              <input type="text" class="form-control" id="EditNIC" placeholder="NIC" name="edit_nic">
                            </div>
                            <div class="form-group">
                              <label for="EditEmail">Email address</label>
                              <input type="email" class="form-control" id="EditEmail" placeholder="Email address" name="edit_email">
                            </div>
                            <div class="form-group">
                              <label for="EditPhone">Phone</label>
                              <input type="text" class="form-control" id="EditPhone" placeholder="Phone" name="edit_phone">
                            </div>
                            <div class="form-group">
                              <label for="EditAddress">Address</label>
                              <textarea class="form-control" id="EditAddress" rows="4" placeholder="Phone" name="edit_address"> </textarea>
                            </div>

                            <div class="form-group">
                              <label>NIC Copy</label>
                              <input type="file" name="edit_nic_copy" class="file-upload-default">
                              <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" id="EditNicCopy" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                </span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label>License Copy</label>
                              <input type="file" name="edit_license_copy" class="file-upload-default">
                              <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" id="EditLicenseCopy" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                </span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label>Light Bill Copy</label>
                              <input type="file" name="edit_light_bill_copy" class="file-upload-default">
                              <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" id="EditLightBillCopy" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                </span>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                            <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                          </form>
                          <?php echo form_close(); ?>   
                          
                        </div>
                      </div>
                    </div>
                     <!-- edit end -->


                    </div>
                    <!--div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div-->
                  </div>
                </div>
              </div>
              <!-- model end -->

            <?php if(validation_errors()) { ?>
                <script>
                    document.getElementById("addCustomer").classList.add("show");
                </script>
            <?php } ?>

              <!-- view customer table end-->

        </div>

    </div>
    <!-- content-wrapper ends -->

<audio id="sound">
      <source src="<?php echo base_url('assets/audio/shutter-click.mp3'); ?>" type="audio/mpeg" >
</audio>
    

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" crossorigin="anonymous"></script>
<script>

      Webcam.set({
          width:510,
          height:380,
          image_format:'png',
          jpeg_quality:90
      })

      Webcam.attach(".inputCamera")

      function take_pictuer(){
          Webcam.snap(function(data_uri){
              var x = document.getElementById("sound");
              x.play(); 
              document.getElementById("preivFrame").innerHTML='<img id="preview" class="imageCaptured" src="'+data_uri+'"/>';
          });
      }
      
      function saveSnap(){

          var base64image = document.getElementById("preview").src;
          document.getElementById("capturedFrame").innerHTML='<img id="avatar" class="imageCaptured" src="'+base64image+'"/>';
          document.getElementById("InputAvatar").value = base64image;
           // Get base64 value from <img id='imageprev'> source
           /*var base64image = document.getElementById("webcam").src;
           Webcam.upload( base64image, 'webcam.php', function(code, text) {
            console.log('Save successfully');
            //console.log(text);
          });*/
      }
</script>



<?php require_once 'crms_footer.php';?>