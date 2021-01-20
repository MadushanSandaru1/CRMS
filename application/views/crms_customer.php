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
        </div>

        <div class="row">

            <!-- add customer form start-->



                <div class="col-12 grid-margin stretch-card" id="add_div">
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
                      <button type="button" class="btn btn-gradient-primary mb-2" data-toggle="collapse" href="#addCustomer" aria-expanded="false" aria-controls="addCustomer"><i class="mdi mdi-plus"></i> Add Customer Details</button>

                    <div class="collapse mt-5" id="addCustomer" aria-labelledby="customRadioInline2">
                    <?php echo form_open_multipart('Customer/prepareToInsertCustomer');?>
                    <form class="forms-sample">
                      <div class="form-group">
                        <label class="ml-1 mt-2"><b>Customer's photograph</b></label>
                        <div class="row">
                          
                          <div class="col-12 photgraph-outer mt-2 mb-2">
                            <div>
                              <div class="inputCamera" ></div>
                              <div class="shutterbtn"><button type="button" class="btn btn-gradient-primary" onclick="take_pictuer()" data-toggle="modal" data-target="#previewModal" ><span class="mdi mdi-camera "> Capture</span></button></div>
                              <div id="capturedFrame" ></div>
                            </div>
                          </div> 

                        </div>
                        <input type="hidden" name="avatarReady" id="InputAvatar" value= "<?php if($this->session->tempdata('avatar_fill')) echo $this->session->tempdata('avatar_fill'); ?>"> 
                      </div>


                      <div class="form-group">
                        <label for="InputName">Name</label>
                        <input type="text" class="form-control" id="InputName" placeholder="Name" name="name" maxlength="100" value= "<?php if($this->session->tempdata('name_fill')) echo $this->session->tempdata('name_fill'); ?>" >
                          <small class="text-danger"><?php echo form_error('name'); ?></small>
                      </div>

                      <div class="form-group">
                        <label for="InputNIC">NIC</label>
                        <input type="text" class="form-control" id="InputNIC" placeholder="NIC" name="nic" value= "<?php if($this->session->tempdata('nic_fill')) echo $this->session->tempdata('nic_fill'); ?>" >
                        <small class="text-danger"><?php echo form_error('nic'); ?></small>
                      </div>

                      <div class="form-group">
                        <label for="InputEmail">Email address</label>
                        <input type="email" class="form-control" id="InputEmail" placeholder="Email address" name="email"  maxlength="100" value="<?php if($this->session->tempdata('email_fill')) echo $this->session->tempdata('email_fill'); ?>" >
                        <small class="text-danger"><?php echo form_error('email'); ?></small>
                      </div>

                      <div class="form-group">
                        <label for="InputPhone">Phone</label>
                        <input type="text" class="form-control" id="InputPhone" placeholder="Phone" name="phone" value= "<?php if($this->session->tempdata('phone_fill')) echo $this->session->tempdata('phone_fill'); ?>" >
                        <small class="text-danger"><?php echo form_error('phone'); ?></small>
                      </div>

                      <div class="form-group">
                        <label for="InputAddress">Address</label>
                        <textarea class="form-control" id="InputAddress" rows="4" placeholder="Address" name="address" maxlength="255"> <?php if($this->session->tempdata('address_fill')) echo $this->session->tempdata('address_fill'); ?> </textarea>
                        <small class="text-danger"><?php echo form_error('address'); ?></small>
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
                        <small class="text-danger"><?php echo form_error('nic_copy'); ?></small>
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
                        <small class="text-danger"><?php echo form_error('license_copy'); ?></small>
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
                        <small class="text-danger"><?php echo form_error('light_bill_copy'); ?></small>
                      </div>

                      <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                      <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
                    <?php echo form_close(); ?>
                      </div>
                    
                  </div>
                </div>
              </div>
            <!-- update customer form end-->


            

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





              <!-- update customer form start-->

                <div class="col-12 grid-margin stretch-card" id="update_div">
                <div class="card">
                  <div class="card-body">
                    
                  
                      <button type="button" class="btn btn-gradient-primary mb-2" data-toggle="collapse" href="#updateCustomer" aria-expanded="false" aria-controls="updateCustomer"><i class="mdi mdi-plus"></i> Update Customer Details</button>

                    <div class="collapse mt-5" id="updateCustomer" aria-labelledby="customRadioInline2">
                    <?php echo form_open_multipart('Customer/prepareToUpdateCustomer');?>
                    <form class="forms-sample">


                      <div class="form-group">
                        <label for="update_InputName">Name</label>
                        <input type="text" class="form-control" id="update_InputName" placeholder="Name" name="update_name" value= "<?php if($this->session->tempdata('update_name_fill')) echo $this->session->tempdata('update_name_fill'); ?>" >
                          <small class="text-danger"><?php echo form_error('update_name'); ?></small>
                      </div>

                      <div class="form-group">
                        <label for="update_InputNIC">NIC</label>
                        <input type="text" class="form-control" id="update_InputNIC" placeholder="NIC" name="update_nic" value= "<?php if($this->session->tempdata('update_nic_fill')) echo $this->session->tempdata('update_nic_fill'); ?>" >
                        <small class="text-danger"><?php echo form_error('update_nic'); ?></small>
                      </div>

                      <div class="form-group">
                        <label for="update_InputEmail">Email address</label>
                        <input type="email" class="form-control" id="update_InputEmail" placeholder="Email address" name="update_email" value= "<?php if($this->session->tempdata('update_email_fill')) echo $this->session->tempdata('update_email_fill'); ?>" >
                        <small class="text-danger"><?php echo form_error('update_email'); ?></small>
                      </div>

                      <div class="form-group">
                        <label for="update_InputPhone">Phone</label>
                        <input type="text" class="form-control" id="update_InputPhone" placeholder="Phone" name="update_phone" value= "<?php if($this->session->tempdata('update_phone_fill')) echo $this->session->tempdata('update_phone_fill'); ?>" >
                        <small class="text-danger"><?php echo form_error('update_phone'); ?></small>
                      </div>

                      <div class="form-group">
                        <label for="update_InputAddress">Address</label>
                        <textarea class="form-control" id="update_InputAddress" rows="4" placeholder="Address" name="update_address"> <?php if($this->session->tempdata('update_address_fill')) echo $this->session->tempdata('update_address_fill'); ?> </textarea>
                        <small class="text-danger"><?php echo form_error('update_address'); ?></small>
                      </div>




                          <div class="form-group row">
            
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="nic_copy_proofment" id="nic_copy_proofment"  onclick="collaps_proofments('nic_copy')"> NIC Copy </label>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="license_copy_proofment" id="license_copy_proofment" onclick="collaps_proofments('license_copy')"> License Copy </label>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="light_bill_copy_proofment" id="light_bill_copy_proofment" onclick="collaps_proofments('light_bill_copy')"> Light Bill Copy </label>
                              </div>
                            </div>

                          </div>
                       


                      <div class="form-group" id="nic_copyDiv">
                        <label>NIC Copy</label>
                        <input type="file" name="update_nic_copy" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                        <small class="text-danger"><?php echo form_error('update_nic_copy'); ?></small>
                      </div>

                      <div class="form-group" id="license_copyDiv">
                        <label>License Copy</label>
                        <input type="file" name="update_license_copy" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                        <small class="text-danger"><?php echo form_error('update_license_copy'); ?></small>
                      </div>

                      <div class="form-group" id="light_bill_copyDiv">
                        <label>Light Bill Copy</label>
                        <input type="file" name="update_light_bill_copy" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                        <small class="text-danger"><?php echo form_error('update_light_bill_copy'); ?></small>
                      </div>

                      <input type="hidden" id="update_ID" name="customer_id">

                      <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                      <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
                    <?php echo form_close(); ?>
                      </div>
                    
                  </div>
                </div>
              </div>
            <!-- update customer form end-->







            <!-- view customer table start-->

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                      <div class="d-flex justify-content-between">
                          <h4 class="card-title text-danger">Customers Details</h4>

                          <!-- search bar-->
                          <div class="search-field d-none d-md-block">
                              <input type="text" id="searchTxt" onkeyup="searchTable()" class="form-control bg-light text-danger form-control-sm border-danger border-left-0 border-right-0 border-top-0" placeholder="Search...">
                          </div>
                      </div>
                      <div style="overflow-x:auto;">
                        <table class="table table-hover" id="customerTable">
                          <thead>
                            <tr>
                                <th>#</th>
                                <th> Name </th>
                              <th> NIC </th>
                              <th> Email </th>
                              <th> Phone </th>
                              <th> Address </th>
                                <th> Image </th>
                              <th> NIC Copy </th>
                              <th> License Copy </th>
                              <th> Light Bill Copy </th>
                            <?php if($this->session->userdata('user_role') == 'admin'){ ?>
                                <th colspan="2"> Action </th>
                            <?php } ?>

                            </tr>
                          </thead>
                          <tbody>
                            <?php 

                              if ($customer_data->num_rows() > 0) { 
                                  foreach($customer_data->result() as $row){ 
                              ?>  <tr>
                                  <td><?php echo $row->id;?></td>
                                  <td><?php echo $row->name;?></td>
                                  <td><?php echo $row->nic;?></td>
                                  <td><?php echo $row->email;?></td>
                                  <td><?php echo $row->phone;?></td>
                                  <td><?php echo $row->address;?></td>
                                  <td><a href="<?php echo base_url('assets/images/customers/'.$row->image); ?>" target="_blank"><span class="mdi mdi-content-copy"> View</span></a></td>
                                  <td><a href="<?php echo base_url('assets/images/customers/documentation/'.$row->nic_copy); ?>" target="_blank"><span class="mdi mdi-content-copy"> View</span></a></td>
                                  <td><a href="<?php echo base_url('assets/images/customers/documentation/'.$row->license_copy); ?>" target="_blank"><span class="mdi mdi-content-copy"> View</span></a></td>

                                  <?php if($row->light_bill_copy!=null){ ?>
                                    <td><a href="<?php echo base_url('assets/images/customers/documentation/'.$row->light_bill_copy); ?>" target="_blank"><span class="mdi mdi-content-copy"> View</span></a></td>
                                  <?php }else{ ?>
                                    <td><span class="mdi mdi-content-copy text-muted"> View</span></td>
                                  <?php } ?>

                              <?php if($this->session->userdata('user_role') == 'admin'){ ?>
                                  <td>
                                      <label class="cursor-pointer" onclick="update_customer(<?php 
                                        echo $row->id.",'".
                                        $row->name."','".
                                        $row->nic."','".
                                        $row->email."','".
                                        $row->phone."','".
                                        $row->address."'"
                                        ?>)">
                                      <span class="mdi mdi-eyedropper text-success"> Edit</span></label> 
                          
                                      <label class="cursor-pointer" style="cursor: pointer;" data-toggle="modal" data-target="#deleteModal" onclick="delete_customer('<?php echo$row->id; ?>')"> <span class="mdi mdi-close-circle text-danger ml-4"> Remove</span> </label>
                                  </td>
                              <?php } ?>

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

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php echo form_open('Customer/delete_customer');?>
                        <form>
                            <div class="modal-body">
                                Are you sure you want to delete this record.
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="delcustomerid" id="delcustomerid" required>
                                <button type="submit" class="btn btn-primary">Yes</button>
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                            </div>
                        </form>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- ** Delete Modal -->

             <!--  <script type="text/javascript">
                
                function loadCustomerData(id,name,nic,email,phone,address,nic_copy,license_copy,light_bill_copy){
                  document.getElementById("update_ID").value = id;
                  document.getElementById("update_Name").value = name;
                  document.getElementById("update_NIC").value = nic;
                  document.getElementById("update_Email").value = email;
                  document.getElementById("update_Phone").value = phone;
                  document.getElementById("update_Address").value = address;
                  document.getElementById("update_NicCopy").value = nic_copy;
                  document.getElementById("update_LicenseCopy").value = license_copy;
                  document.getElementById("update_LightBillCopy").value = light_bill_copy;

                }
              </script> -->


            

        <script type="text/javascript">
            // delete details
            function delete_customer(del_customer_id){
                document.getElementById("delcustomerid").value = del_customer_id;
            }

            // table search
            function searchTable(){
                var input, filter, table, tr, td, cell, i, j;
                input = document.getElementById("searchTxt");
                filter = input.value.toUpperCase();
                table = document.getElementById("customerTable");
                tr = table.getElementsByTagName("tr");
                for (i = 1; i < tr.length; i++) {
                    // Hide the row initially.
                    tr[i].style.display = "none";

                    td = tr[i].getElementsByTagName("td");
                    for (var j = 0; j < td.length; j++) {
                        cell = tr[i].getElementsByTagName("td")[j];
                        if (cell) {
                            if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                                break;
                            }
                        }
                    }
                }
            }
        </script>


              <!-- view customer table end-->

        </div>

    </div>
    <!-- content-wrapper ends -->


<?php if(validation_errors()) { ?>
    <script>
        document.getElementById("addCustomer").classList.add("show");
    </script>
<?php } ?>


<?php  if ($this->session->tempdata('form')=='customer_add_form') { ?>
<script>
        document.getElementById("add_div").style.display = "block";
        document.getElementById("update_div").style.display = "none";
        document.getElementById("addCustomer").classList.add("show");
</script>
<?php }else if($this->session->tempdata('form')=='customer_update_form'){ ?>
<script>
        document.getElementById("update_div").style.display = "block";
        document.getElementById("add_div").style.display = "none";
        document.getElementById("updateCustomer").classList.add("show");
</script>    
<?php }else{ ?>
<script>
        document.getElementById("add_div").style.display = "block";
        document.getElementById("update_div").style.display = "none";
</script> 
<?php } ?>





<script type="text/javascript">
  
  function update_customer(id,name,nic,email,phone,address){

      //display form if clickd edit in view table
      document.getElementById("add_div").style.display = "none";
      document.getElementById("update_div").style.display = "block";

      document.getElementById("update_ID").value = id;
      document.getElementById("update_InputName").value = name;
      document.getElementById("update_InputNIC").value = nic;
      document.getElementById("update_InputEmail").value = email;
      document.getElementById("update_InputPhone").value = phone;
      document.getElementById("update_InputAddress").value = address;

      //update form collaps if loaded data into that form
      document.getElementById("updateCustomer").classList.add("show");
  }



  //hide all when load the page
  document.getElementById("nic_copyDiv").style.display = "none";
  document.getElementById("license_copyDiv").style.display = "none";
  document.getElementById("light_bill_copyDiv").style.display = "none";

  function collaps_proofments(proofment){

      if (proofment=="nic_copy") {

            if (document.getElementById("nic_copy_proofment").checked) {
                document.getElementById("nic_copyDiv").style.display = "block";
            }else{
                document.getElementById("nic_copyDiv").style.display = "none";
            }

      }else if(proofment=="license_copy"){

            if (document.getElementById("license_copy_proofment").checked) {
                document.getElementById("license_copyDiv").style.display = "block";
            }else{
                document.getElementById("license_copyDiv").style.display = "none";
            }

      }else if(proofment=="light_bill_copy"){

            if (document.getElementById("light_bill_copy_proofment").checked) {
                document.getElementById("light_bill_copyDiv").style.display = "block";
            }else{
                document.getElementById("light_bill_copyDiv").style.display = "none";
            }

      }
  }

</script>


<?php if ($this->session->tempdata("nic_copy_proofment_fill")=="on") { ?>
  <script>
      document.getElementById("nic_copy_proofment").checked = true;
      document.getElementById("nic_copyDiv").style.display = "block";
  </script>
<?php } ?>

<?php if ($this->session->tempdata("license_copy_proofment_fill")=="on") { ?>
  <script>
      document.getElementById("license_copy_proofment").checked = true;
      document.getElementById("license_copyDiv").style.display = "block";
  </script>
<?php } ?>

<?php if ($this->session->tempdata("light_bill_copy_proofment_fill")=="on") { ?>
  <script>
      document.getElementById("light_bill_copy_proofment").checked = true;
      document.getElementById("light_bill_copyDiv").style.display = "block";
  </script>
<?php } ?>





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


<!-- <?php /*if($this->session->tempdata('avatar_fill')) */{ ?> 
<script>
  document.getElementById("capturedFrame").innerHTML='<img id="avatar" class="imageCaptured" src="'+ $this->session->tempdata('avatar_fill')  +'"/>';
</script> 
<?php } ?> -->


<?php require_once 'crms_footer.php';?>