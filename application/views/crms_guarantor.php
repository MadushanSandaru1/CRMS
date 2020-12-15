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

        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-shield-half-full"></i>
                </span> Guarantor </h3>
            <nav aria-label="breadcrumb">
<!--                <span id="liveTime"></span>-->
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
                              <?php
                                echo $this->session->flashdata('guarantor_status');
                                if ($this->session->tempdata('report_details'))
                                    echo "<a href='".base_url('index.php/Guarantor/report_guarantor/'.$this->session->tempdata('report_details'))."' target='_blank'> print report</a>";

                              ?>
                          </div>
                          <br>
                  <?php
                      }
                  ?>
                      <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#addGuarantor" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Guarantor Details</button>

                      <div class="collapse " id="addGuarantor" aria-labelledby="customRadioInline2">
                      <?php echo form_open_multipart('Guarantor/add_guarantor');  ?>
                        <div class="form-group">
                            <label for="reservedID"><b>Reserved ID</b></label>
                            <select class="custom-select" name="reservedID">
                                <option value="" disabled selected hidden>Select Reserved ID</option>
                                <?php
                                if($reserved_data->num_rows() > 0) {
                                    foreach ($reserved_data->result() as $data_row) {
                                        if ($this->session->tempdata('reservedID_fill')) {
                                            if ($this->session->tempdata('reservedID_fill')==$data_row->id) {
                                                echo "<option value='".$data_row->id."' selected>".$data_row->id." - ".$data_row->registered_number."</option>";
                                            }else{
                                                echo "<option value='".$data_row->id."'>".$data_row->id." - ".$data_row->registered_number."</option>";
                                            }

                                        }else{
                                            echo "<option value='".$data_row->id."'>".$data_row->id." - ".$data_row->registered_number."</option>";
                                        }
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
                          <input type="text" class="form-control" id="guarantorNIC" name="guarantorNIC" placeholder="xxxxxxxxxV | xxxxxxxxxxxx" value="<?php if($this->session->tempdata('guarantorNIC_fill')) echo $this->session->tempdata('guarantorNIC_fill'); ?>">
                          <small class="text-danger"><?php echo form_error('guarantorNIC'); ?></small>
                      </div>
                      <div class="form-group">
                        <label for="guarantorPhone">Phone</label>
                        <input type="text" class="form-control" id="guarantorPhone" name="guarantorPhone" placeholder="0xxxxxxxxx" pattern="0[0-9]{9}" value="<?php if($this->session->tempdata('guarantorPhone_fill')) echo $this->session->tempdata('guarantorPhone_fill'); ?>">
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
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title text-danger">Guarantor Details</h4>

                            <!-- search bar-->
                            <div class="search-field d-none d-md-block">
                                <input type="text" id="searchTxt" onkeyup="searchTable()" class="form-control bg-light text-danger form-control-sm border-danger border-left-0 border-right-0 border-top-0" placeholder="Search...">
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <table class="table table-hover" id="guarantorTable">
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

                                                <a href="<?php echo base_url('index.php/Guarantor/report_guarantor/'.$data_row->reserved_id); ?>" target="_blank"><span class="mdi mdi-printer"> Report</span></a>
                                                <a href=""><span class="mdi mdi-eyedropper text-success ml-4"> Edit</span></a>
                                                <a style="cursor: pointer;" data-toggle="modal" data-target="#deleteModal" onclick="delete_guarantor('<?php echo$data_row->id; ?>')"> <span class="mdi mdi-close-circle text-danger ml-4"> Remove</span> </a>
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
                    <?php echo form_open('Guarantor/delete_guarantor');?>
                    <form>
                        <div class="modal-body">
                            Are you sure you want to delete this record.
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="delguarantorid" id="delguarantorid" required>
                            <button type="submit" class="btn btn-primary">Yes</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                        </div>
                    </form>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!-- ** Delete Modal -->

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

        <script type="text/javascript">
            // delete details
            function delete_guarantor(del_guarantor_id){
                document.getElementById("delguarantorid").value = del_guarantor_id;
            }

            // table search
            function searchTable(){
                var input, filter, table, tr, td, cell, i, j;
                input = document.getElementById("searchTxt");
                filter = input.value.toUpperCase();
                table = document.getElementById("guarantorTable");
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

    </div>
    <!-- content-wrapper ends -->

<?php require_once 'crms_footer.php';?>