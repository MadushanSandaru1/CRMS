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
                  <i class="mdi mdi-cash-multiple"></i>
                </span> Car Outsourcing Supplier </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span><i class="mdi mdi-clock icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>


    <div class="row">
        <div class="col-12 grid-margin stretch-card" id="add_outsource_supplier">
            <div class="card">
                <div class="card-body">
                    <?php
                    if($this->session->flashdata('outsource_supplier_status'))
                    {
                        ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('outsource_supplier_status'); ?>
                        </div>
                        <?php
                    }
                    ?>
                    <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#addOutsourcingSupplier" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Outsourcing Supplier Details</button>

                    <div class="collapse " id="addOutsourcingSupplier" aria-labelledby="customRadioInline2">
                        <br><br>
                        <?php echo form_open_multipart('OutSourceSupplier/outSourcingSupplier'); ?>
                        <div class="form-group">
                            <label for="expenseVehicleID"><b>Name</b></label>
                            <input type="text" name="name" class="form-control" placeholder="Type Supplier Name" value="<?php if($this->session->tempdata('name_fill')) echo $this->session->tempdata('name_fill'); ?>">
                            <small class="text-danger"><?php echo form_error('name'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="expensedVehicleDate">NIC</label>
                            <input type="text" name="nic" class="form-control" maxlength="12" pattern="[0-9]{9}[v|V|x|X]|[0-9]{12}" title="Please enter a according to correct pattern." id="expensedVehicleDate" placeholder="Supplier NIC Number" value="<?php if($this->session->tempdata('nic_fill')) echo $this->session->tempdata('nic_fill'); ?>">
                            <small class="text-danger"><?php echo form_error('nic'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="expenseAmount">Email</label>
                            <input type="email" name="email" class="form-control" id="expenseAmount" placeholder="Supplier Email" value="<?php if($this->session->tempdata('email_fill')) echo $this->session->tempdata('email_fill'); ?>">
                            <small class="text-danger"><?php echo form_error('email'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="expenseAmount">Phone Number</label>
                            <input type="text" name="phone" class="form-control" id="expenseAmount" maxlength="10" pattern="0[0-9]{9}" title="Please follow the requested pattern" placeholder="Supplier Phone Number" value="<?php if($this->session->tempdata('phone_fill')) echo $this->session->tempdata('phone_fill'); ?>">
                            <small class="text-danger"><?php echo form_error('phone'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="expenseAmount">Address</label>
                            <input type="text" name="address" class="form-control" id="expenseAmount" placeholder="Supplier Address" value="<?php if($this->session->tempdata('address_fill')) echo $this->session->tempdata('address_fill'); ?>">
                            <small class="text-danger"><?php echo form_error('address'); ?></small>
                        </div>

                        <div class="form-group">
                            <label for="expenseAmount">Upload NIC Picture</label>
                            <input type="file" name="nic_copy" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>

                            </div>
                            <small class="text-danger"><?php echo form_error('nic_copy'); ?></small>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-12 grid-margin stretch-card" id="update_outsource_supplier">
            <div class="card">
                <div class="card-body">
                    <?php
                    if($this->session->flashdata('outsource_supplier_status'))
                    {
                        ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('outsource_supplier_status'); ?>
                        </div>
                        <?php
                    }
                    ?>
                    <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#updateOutsourcingSupplier" aria-expanded="false" aria-controls="viewDetails">Update Outsourcing Supplier Details</button>

                    <div class="collapse " id="updateOutsourcingSupplier" aria-labelledby="customRadioInline2">
                        <br><br>
                        <?php echo form_open_multipart('OutSourceSupplier/updateOutSourcingSupplier'); ?>
                        <div class="from-group">
                            <input type="hidden" name="outsource_sup_id" id="outsource_sup_id">
                        </div>
                        <div class="form-group">
                            <label for="expenseVehicleID"><b>Name</b></label>
                            <input type="text" name="sup_name" class="form-control" placeholder="Type Supplier Name" id="sup_name">
                            <small class="text-danger"><?php echo form_error('name'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="expensedVehicleDate">NIC</label>
                            <input type="text" name="sup_nic" class="form-control" id="sup_nic" placeholder="Supplier NIC Number" >
                            <small class="text-danger"><?php echo form_error('nic'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="expenseAmount">Email</label>
                            <input type="email" name="sup_email" class="form-control" id="sup_email" placeholder="Supplier Email" >
                            <small class="text-danger"><?php echo form_error('email'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="expenseAmount">Phone Number</label>
                            <input type="text" name="sup_phone" class="form-control" id="sup_phone" placeholder="Supplier Phone Number">
                            <small class="text-danger"><?php echo form_error('phone'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="expenseAmount">Address</label>
                            <input type="text" name="sup_address" class="form-control" id="sup_address" placeholder="Supplier Address" >
                            <small class="text-danger"><?php echo form_error('address'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="expenseAmount">Upload NIC Picture</label>
                            <input type="file" name="sup_nic_copy" class="form-control" id="expenseAmount" placeholder="Supplier NIC Picture" >
                            <small class="text-danger"><?php echo form_error('nic_copy'); ?></small>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                        <button class="btn btn-light">Cancel</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-lg-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-danger">Vehicle Outsourcing Supplier Details</h4>
                    <div style="overflow-x:auto;">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>NIC</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                                <?php foreach($supplier_details as $values):?>
                                    <tr>
                                        <td><?php echo $values->name;?></td>
                                        <td><?php echo $values->nic;?></td>
                                        <td><?php echo $values->email;?></td>
                                        <td><?php echo $values->phone;?></td>
                                        <td><?php echo $values->address;?></td>
                                        <td>
                                            <a id="view" data-toggle="collapse" href="#updateOutsourcingSupplier" aria-expanded="false"
                                               aria-controls="viewDetails"><span class="mdi mdi-eyedropper text-success ml-3"
                                                                                 onclick="update_outsource_supplier('<?php echo $values->id;?>',
                                                                                         '<?php echo $values->name;?>',
                                                                                         '<?php echo $values->nic;?>',
                                                                                         '<?php echo $values->email;?>',
                                                                                         '<?php echo $values->phone;?>',
                                                                                         '<?php echo $values->address;?>',
                                                                                         )">Edit</span></a>
                                            <label class="cursor-pointer" data-toggle="modal" data-target="#deleteModal" onclick="delete_outsource_supplier('<?php echo $values->id; ?>')"> <span class="mdi mdi-close-circle text-danger ml-4"> Remove</span> </label>
                                        </td>
                                    </tr>
                                <?php endforeach;?>    

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <?php if(validation_errors()) { ?>
        <script>
            document.getElementById("addOutsourcingSupplier").classList.add("show");
        </script>
    <?php } ?>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('OutsourceSupplier/prepareToDeleteOutsourceSupplier');?>
                <form>
                    <div class="modal-body">
                        Are you sure want to delete this recode.
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="deloutsourcesid" id="deloutsourcesid" required>
                        <button type="submit" class="btn btn-primary">Yes</button>
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                    </div>
                </form>
                <?php echo form_close(); ?>
            </div>
        </div>


    </div>
    <!-- content-wrapper ends -->
    <script type="text/javascript">
        function delete_outsource_supplier(del_outsources_s_id){
            document.getElementById("deloutsourcesid").value = del_outsources_s_id;
        }
        function update_outsource_supplier(id,name,nic,email,phone,address){

            //display form if clickd edit in view table
            document.getElementById("add_outsource_supplier").style.display = "none";
            document.getElementById("update_outsource_supplier").style.display = "block";

            //load data into form
            document.getElementById("outsource_sup_id").value = id;
            document.getElementById("sup_name").value = name;
            document.getElementById("sup_nic").value = nic;
            document.getElementById("sup_email").value = email;
            document.getElementById("sup_phone").value = phone;
            document.getElementById("sup_address").value = address;

        }
    </script>
<?php require_once 'crms_footer.php';?>
<?php  if ($this->session->tempdata('form')=='add_form') { ?>
    <script>
        document.getElementById("add_outsource_supplier").style.display = "block";
        document.getElementById("update_outsource_supplier").style.display = "none";

    </script>
<?php }else if($this->session->tempdata('form')=='update_form'){ ?>
    <script>
        document.getElementById("update_outsource_supplier").style.display = "block";
        document.getElementById("add_outsource_supplier").style.display = "none";

    </script>
<?php }else{ ?>
    <script>
        document.getElementById("add_outsource_supplier").style.display = "block";
        document.getElementById("update_outsource_supplier").style.display = "none";
    </script>
<?php } ?>
