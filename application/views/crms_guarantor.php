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
                  <i class="mdi mdi-shield-half-full"></i>
                </span> Guarantor </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span><i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">

            <!-- add guarantor form start-->
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">

                      <?php
                      if($this->session->flashdata('guarantor_status'))
                      {
                          ?>
                          <div class="alert alert-success" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <?php echo $this->session->flashdata('guarantor_status'); ?>
                          </div>
                          <br>
                          <?php
                      }
                      ?>

                      <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#addGuarantor" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Guarantor Details</button>

                      <div class="collapse " id="addGuarantor" aria-labelledby="customRadioInline2">
                      <?php echo form_open_multipart('Guarantor/add_guarantor');  ?>
                        <div class="form-group">
                            <label for="guarantorID"><b>Reserved ID</b></label>
                            <select class="custom-select" name="reservedID">
                                <?php
                                if($reserved_data->num_rows() > 0) {
                                    foreach ($reserved_data->result() as $data_row) {
                                        echo "<option value='".$data_row->id."'>".$data_row->id." - ".$data_row->registered_number."</option>";
                                    }
                                } else {
                                    echo "<option>Data not found</option>";
                                }
                                ?>

                            </select>
                            <small class="text-danger"><?php echo form_error('reservedID'); ?></small>
                        </div>
                      <div class="form-group">
                          <label for="guarantorName">Name</label>
                          <input type="text" class="form-control" id="guarantorName" name="guarantorName" placeholder="Name" value="<?php if($this->session->tempdata('guarantorName_fill')) echo $this->session->tempdata('guarantorName_fill'); ?>">
                          <small class="text-danger"><?php echo form_error('guarantorName'); ?></small>
                      </div>
                      <div class="form-group">
                          <label for="guarantorNIC">NIC</label>
                          <input type="text" class="form-control" id="guarantorNIC" name="guarantorNIC" placeholder="NIC" value="<?php if($this->session->tempdata('guarantorNIC_fill')) echo $this->session->tempdata('guarantorNIC_fill'); ?>">
                          <small class="text-danger"><?php echo form_error('guarantorNIC'); ?></small>
                      </div>
                      <div class="form-group">
                        <label for="guarantorPhone">Phone</label>
                        <input type="text" class="form-control" id="guarantorPhone" name="guarantorPhone" placeholder="Phone" value="<?php if($this->session->tempdata('guarantorPhone_fill')) echo $this->session->tempdata('guarantorPhone_fill'); ?>">
                          <small class="text-danger"><?php echo form_error('guarantorPhone'); ?></small>
                      </div>
                      <div class="form-group">
                        <label for="guarantorAddress">Address</label>
                        <textarea class="form-control" id="guarantorAddress" name="guarantorAddress" rows="4" placeholder="address"> </textarea>
                          <small class="text-danger"><?php echo form_error('guarantorAddress'); ?></small>
                      </div>
                      <div class="form-group">
                        <label>NIC Copy</label>
                        <input type="file" name="nicImage" class="file-upload-default">
                          <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                          <small class="text-danger"><?php echo form_error('nicImage'); ?></small>
                      </div>
                      <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                      <button type="reset" class="btn btn-light">Cancel</button>
                      <?php echo form_close();  ?>
                      </div>
                  </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Guarantor Details</h4>
                        <div style="overflow-x:auto;">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reserved ID</th>
                                    <th>Name</th>
                                    <th>NIC</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>NIC Copy</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($guarantor_data->num_rows() > 0) {
                                    foreach ($guarantor_data->result() as $data_row){
                                ?>
                                        <tr>
                                            <td><?php echo $data_row->id; ?></td>
                                            <td> <?php echo $data_row->reserved_id; ?> </td>
                                            <td><?php echo $data_row->name; ?></td>
                                            <td><?php echo $data_row->nic; ?></td>
                                            <td><?php echo $data_row->phone; ?></td>
                                            <td><?php echo $data_row->address; ?></td>
                                            <td><a href="<?php echo base_url('assets/images/guarantor/'.$data_row->nic_copy); ?>" target="_blank"><span class="mdi mdi-content-copy"> View</span></a></td>
                                            <td>
                                                <a href=""><span class="mdi mdi-eyedropper text-success"> Edit</span></a>
                                                <a href="<?php echo base_url('index.php/Guarantor/delete_guarantor/'.$data_row->id); ?>" onclick="return confirm('Are you sure to delete this information?');"><span class="mdi mdi-close-circle text-danger ml-4"> Remove</span></a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                else {
                                ?>
                                    <tr>
                                        <td colspan="8">No Data Found</td>
                                    </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(validation_errors()) { ?>
            <script>
                document.getElementById("addGuarantor").classList.add("show");
            </script>
        <?php } ?>

        <?php if($this->session->tempdata('guarantorAddress_fill')) { ?>
            <script>
                let address=<?php echo json_encode($this->session->tempdata('guarantorAddress_fill')); ?>;
                document.getElementById("guarantorAddress").value = address;
            </script>
        <?php } ?>

    </div>
    <!-- content-wrapper ends -->

<?php require_once 'crms_footer.php';?>