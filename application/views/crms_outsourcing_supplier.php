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
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        
                        <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#addOutsourcingSupplier" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Outsourcing Supplier Details</button>

                        <div class="collapse " id="addOutsourcingSupplier" aria-labelledby="customRadioInline2">
                            <br><br>
                            <?php echo form_open_multipart('OutSourceSupplier/outSourcingSupplier'); ?>
                                <div class="form-group">
                                    <label for="expenseVehicleID"><b>Name</b></label>
                                    <input type="text" name="name" class="form-control" placeholder="Type Supplier Name" >
                                    <small class="text-danger"><?php echo form_error('name'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="expensedVehicleDate">NIC</label>
                                    <input type="text" name="nic" class="form-control" id="expensedVehicleDate" placeholder="Supplier NIC Number" >
                                    <small class="text-danger"><?php echo form_error('nic'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="expenseAmount">Email</label>
                                    <input type="email" name="email" class="form-control" id="expenseAmount" placeholder="Supplier Email" >
                                    <small class="text-danger"><?php echo form_error('email'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="expenseAmount">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" id="expenseAmount" placeholder="Supplier Phone Number">
                                    <small class="text-danger"><?php echo form_error('phone'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="expenseAmount">Address</label>
                                    <input type="text" name="address" class="form-control" id="expenseAmount" placeholder="Supplier Address" >
                                    <small class="text-danger"><?php echo form_error('address'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="expenseAmount">Upload NIC Picture</label>
                                    <input type="file" name="nic_copy" class="form-control" id="expenseAmount" placeholder="Supplier NIC Picture" >
                                    <small class="text-danger"><?php echo form_error('nic_copy'); ?></small>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
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
                                            <a href=""><span class="mdi mdi-eyedropper text-success"> Edit</span></a>
                                            <a href=""><span class="mdi mdi-close-circle text-danger ml-4"> Remove</span></a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php if(validation_errors()) { ?>
        <script>
            document.getElementById("addOutsourcingVehicle").classList.add("show");
        </script>
        <?php } ?>                             
    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>