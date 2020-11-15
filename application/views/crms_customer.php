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
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">

            <!-- add customer form start-->



                <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-danger mb-5">Add new customer</h4>

                    <?php 
                            if ($this->session->flashdata('status')) {
                    ?>
                    <div class="alert alert-success">
                       <?php echo $this->session->flashdata('status'); ?>
                    </div>
                    <?php } ?>
                    
                    <?php echo validation_errors();?>
                    <?php echo form_open_multipart('Customer/prepareToInsertCustomer');?>
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="InputName">Name</label>
                        <input type="text" class="form-control" id="InputName" placeholder="Name" name="name">
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
            <!-- add customer form end-->


            <!-- view customer table start-->

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Customers</h4>
                    <p class="card-description">Maintain customer details
                    </p>
                    <table class="table table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                        <?php foreach($customer_data->result() as $row){ ?>
                          <tr>
                              <td><?php echo $row->name;?></td>
                              <td><?php echo $row->nic;?></td>
                              <td><?php echo $row->email;?></td>
                              <td><?php echo $row->phone;?></td>
                              <td><?php echo $row->address;?></td>
                              <td><a href="<?php echo base_url('assets/images/customers/img_documents/'.$row->nic_copy); ?>"><span class="mdi mdi-camera "> View</span></a></td>
                              <td><a href="<?php echo base_url('assets/images/customers/img_documents/'.$row->license_copy); ?>"><span class="mdi mdi-camera "> View</span></a></td>
                              <td><a href="<?php echo base_url('assets/images/customers/img_documents/'.$row->light_bill_copy); ?>"><span class="mdi mdi-camera "> View</span></a></td>
                              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Edit</button></td>
                              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Delete</button></td>
                          </tr>
                        <?php } ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <span class="iconify" data-icon="carbon:document-view" data-inline="false"></span>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      
                      <!-- edit start -->
                      <div class="col-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title text-danger mb-5">Add new customer</h4>

          
                          <form class="forms-sample">
                            <div class="form-group">
                              <label for="InputName">Name</label>
                              <input type="text" class="form-control" id="InputName" placeholder="Name" name="name">
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
                            <button class="btn btn-light">Cancel</button>
                          </form>
                          <?php echo form_close(); ?>   
                          
                        </div>
                      </div>
                    </div>
                     <!-- edit end -->


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- model end -->



              <!-- view customer table end-->

        </div>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>