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
                  <i class="mdi mdi-bookmark-plus"></i>
                </span> Car Booking </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span><i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#addBooking" aria-expanded="false" aria-controls="viewDetails"><i class="mdi mdi-plus"></i> Add Vehicle Booking Details</button>

                        <div class="collapse mt-5" id="addBooking" aria-labelledby="customRadioInline2">
                            <?php 

                                if ($this->session->flashdata('status')) {
                                      echo " <div class=\"alert alert-success\">";
                                      echo $this->session->flashdata('status');
                                      echo "</div>";
                                }


                            ?>
                            <?php echo form_open('Booking/prepareToStaffInsertBooking');?>
                            <form class="forms-sample">

                                <div class="form-group">
                                    <label for="expenseVehicleID"><b>Vehicle</b></label>
                                    <select name="vehicle" class="custom-select">
                                        <option value="" disabled selected hidden>Select Vehicle</option>
                                        <?php 
                                            if ($available_vehicle->num_rows() > 0) {
                                                foreach($available_vehicle->result() as $row){

                                                    if ($this->session->tempdata('vehicle_fill')) {
                                                        if ($this->session->tempdata('vehicle_fill')==$row->id) {
                                                            echo "<option value={$row->id} selected>{$row->title}</option>";
                                                        }else{
                                                            echo "<option value={$row->id} >{$row->title}</option>";
                                                        }
                                                         
                                                    }else{
                                                         echo "<option value={$row->id}>{$row->title}</option>";
                                                    }
                                                }                                        
                                            }else{
                                                    echo "<option class='text-danger'>No data found</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <small class="text-danger"><?php echo form_error('vehicle'); ?></small>

                                <div class="form-group">
                                    <label for="pickup">Pickup</label>
                                    <input type="datetime-local" class="form-control" name="pickup" id="pickup" placeholder="Date and Time" onchange="set_dropoff_min()"  min="<?php echo Date('Y-m-d\TH:i',time()) ?>" value="<?php if($this->session->tempdata('pickup_fill')) echo $this->session->tempdata('pickup_fill'); ?>">
                                    <small class="text-danger"><?php echo form_error('pickup'); ?></small>
                                </div>

                                <div class="form-group">
                                    <label for="drop_off">Drop off</label>
                                    <input type="datetime-local" class="form-control" name="drop_off" id="drop_off" placeholder="Date and Time" min="<?php echo Date('Y-m-d\TH:i',time()) ?>" value="<?php if($this->session->tempdata('pickup_fill')) echo $this->session->tempdata('drop_off_fill'); ?>">
                                    <small class="text-danger"><?php echo form_error('drop_off'); ?></small>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input  class="form-control"  type="text" id="name" name="name" placeholder="Customer's name" value="<?php if($this->session->tempdata('name_fill')) echo $this->session->tempdata('name_fill'); ?>" >
                                    <small class="text-danger"><?php echo form_error('name'); ?></small>
                                </div>

                                <div class="form-group">
                                    <label for="nic">NIC</label>
                                    <input class="form-control" type="text" id="nic" name="nic" placeholder="Customer's NIC" value="<?php if($this->session->tempdata('nic_fill')) echo $this->session->tempdata('nic_fill'); ?>">
                                    <small class="text-danger"><?php echo form_error('nic'); ?></small>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="email" id="email" name="email" placeholder="Customer's email" value="<?php if($this->session->tempdata('email_fill')) echo $this->session->tempdata('email_fill'); ?>" >
                                    <small class="text-danger"><?php echo form_error('email'); ?></small>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input class="form-control" type="tel" id="phone" name="phone" placeholder="Customer's Phone" value="<?php if($this->session->tempdata('phone_fill')) echo $this->session->tempdata('phone_fill'); ?>">
                                    <small class="text-danger"><?php echo form_error('phone'); ?></small>

                                </div>

                                <textarea class="form-control txt-field" placeholder="Message" name="msg" id="msg"> <?php if($this->session->tempdata('msg_fill')) echo $this->session->tempdata('msg_fill'); ?> </textarea>
                                <small class="text-danger"><?php echo form_error('msg'); ?></small>

                                <input type="hidden" name="status" id="status" value="1">
                                <button type="submit" class="btn btn-gradient-primary mr-2 mt-3">Submit</button>
                                <button class="btn btn-light mt-3">Cancel</button>
                            </form>
                            <?php echo form_close(); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Vehicle Booking Details</h4>
                        <div style="overflow-x:auto;">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vehicle ID</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Jacob</td>
                                    <td>Photoshop</td>
                                    <td>Jacob</td>
                                    <td>Jacob</td>
                                    <td>Photoshop</td>
                                    <td>
                                        <a href=""><span class="mdi mdi-eyedropper text-success"> Edit</span></a>
                                        <a href=""><span class="mdi mdi-close-circle text-danger ml-4"> Remove</span></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


<script type="text/javascript">

    
    
   //if(null==document.getElementById("pickup").value){
        document.getElementById("drop_off").disabled = true;
    //}


    function set_dropoff_min(){
        document.getElementById("drop_off").disabled = false;
        min = document.getElementById("pickup").value;
        document.getElementById("drop_off").value = null;

        document.getElementById("drop_off").min  = min;
    }

    

</script>



    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>