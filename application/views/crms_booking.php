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
                        <span></span><i class="mdi mdi-clock icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">

            <!-- Add booking  -->

            <div class="col-12 grid-margin stretch-card" id="add_div">
                <div class="card">
                 
                    <div class="card-body">


                    <?php 
                     if ($this->session->flashdata('status')) {
                          echo "<div>";
                          echo " <div class=\"alert alert-success\">";
                          echo $this->session->flashdata('status');
                          echo "</div>";
                          echo "</div>";
                      }
                    ?>


                        <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#addBooking" aria-expanded="false" aria-controls="addBooking"><i class="mdi mdi-plus"></i> Add Vehicle Booking Details</button>

                        <div class="collapse mt-5" id="addBooking" aria-labelledby="customRadioInline2">
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

                                <div class="form-group">
                                    <label for="msg">Message</label>
                                    <textarea class="form-control txt-field" placeholder="Message" name="msg" id="msg"> <?php if($this->session->tempdata('msg_fill')) echo $this->session->tempdata('msg_fill'); ?> </textarea>
                                    <small class="text-danger"><?php echo form_error('msg'); ?></small>
                                </div>

                                <input type="hidden" name="status" id="status" value="1">
                                <button type="submit" class="btn btn-gradient-primary mr-2 mt-3">Submit</button>
                                <button class="btn btn-light mt-3">Cancel</button>
                            </form>
                            <?php echo form_close(); ?>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Add booking end -->


            <!-- Update booking -->

            <div class="col-12 grid-margin stretch-card" id="update_div">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-2" data-toggle="collapse" href="#updateBooking" aria-expanded="false" aria-controls="addBooking"><i class="mdi mdi-plus"></i> Update Vehicle Booking Details</button>

                        <div class="collapse mt-5" id="updateBooking" aria-labelledby="customRadioInline2">
                    
                            <?php echo form_open('Booking/prepareToUpdateBooking');?>
                            <form class="forms-sample">

                                <div class="form-group">
                                    <label for="update_vehicle"><b>Vehicle</b></label>
                                    <select name="update_vehicle" id="update_vehicle" class="custom-select">
                                        <option value="" disabled selected hidden>Select Vehicle</option>
                                        <?php 
                                            if ($available_vehicle->num_rows() > 0) {
                                                foreach($available_vehicle->result() as $row){

                                                    if ($this->session->tempdata('update_vehicle_fill')) {
                                                        if ($this->session->tempdata('update_vehicle_fill')==$row->id) {
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
                                <small class="text-danger"><?php echo form_error('update_vehicle'); ?></small>

                                <div class="form-group">
                                    <label for="update_pickup">Pickup</label>
                                    <input type="datetime-local" class="form-control" name="update_pickup" id="update_pickup" placeholder="Date and Time" onchange="set_update_dropoff_min()"  min="<?php echo Date('Y-m-d\TH:i',time()) ?>" value="<?php if($this->session->tempdata('update_pickup_fill')) echo $this->session->tempdata('update_pickup_fill'); ?>">
                                    <small class="text-danger"><?php echo form_error('update_pickup'); ?></small>
                                </div>

                                <div class="form-group">
                                    <label for="update_drop_off">Drop off</label>
                                    <input type="datetime-local" class="form-control" name="update_drop_off" id="update_drop_off" placeholder="Date and Time" min="<?php echo Date('Y-m-d\TH:i',time()) ?>" value="<?php if($this->session->tempdata('update_drop_off_fill')) echo $this->session->tempdata('update_drop_off_fill'); ?>">
                                    <small class="text-danger"><?php echo form_error('update_drop_off'); ?></small>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="update_name">Name</label>
                                    <input  class="form-control"  type="text" id="update_name" name="update_name" placeholder="Customer's name" value="<?php if($this->session->tempdata('update_name_fill')) echo $this->session->tempdata('update_name_fill'); ?>" >
                                    <small class="text-danger"><?php echo form_error('update_name'); ?></small>
                                </div>

                                <div class="form-group">
                                    <label for="update_nic">NIC</label>
                                    <input class="form-control" type="text" id="update_nic" name="update_nic" placeholder="Customer's NIC" value="<?php if($this->session->tempdata('update_nic_fill')) echo $this->session->tempdata('update_nic_fill'); ?>">
                                    <small class="text-danger"><?php echo form_error('update_nic'); ?></small>
                                </div>

                                <div class="form-group">
                                    <label for="update_email">Email</label>
                                    <input class="form-control" type="email" id="update_email" name="update_email" placeholder="Customer's email" value="<?php if($this->session->tempdata('update_email_fill')) echo $this->session->tempdata('update_email_fill'); ?>" >
                                    <small class="text-danger"><?php echo form_error('update_email'); ?></small>
                                </div>

                                <div class="form-group">
                                    <label for="update_phone">Phone</label>
                                    <input class="form-control" type="tel" id="update_phone" name="update_phone" placeholder="Customer's Phone" value="<?php if($this->session->tempdata('update_phone_fill')) echo $this->session->tempdata('update_phone_fill'); ?>">
                                    <small class="text-danger"><?php echo form_error('update_phone'); ?></small>

                                </div>

                                <div class="form-group">
                                    <label for="update_msg">Message</label>
                                    <textarea class="form-control txt-field" placeholder="Message" name="update_msg" id="update_msg"> <?php if($this->session->tempdata('update_msg_fill')) echo $this->session->tempdata('update_msg_fill'); ?> </textarea>
                                    <small class="text-danger"><?php echo form_error('update_msg'); ?></small>
                                </div>

                                <input type="hidden" name="booking_id" id="booking_id">
                                <button type="submit" class="btn btn-gradient-primary mr-2 mt-3">Submit</button>
                                <button class="btn btn-light mt-3">Cancel</button>
                            </form>
                            <?php echo form_close(); ?>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Update booking end -->



            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Vehicle Booking Details</h4>
                        <div style="overflow-x:auto;">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Customer NIC</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Customer Phone</th>
                                    <th>Vehicle</th>
                                    <th>Pickup date</th>
                                    <th>Drop off date</th>
                                    <th>Booked date</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php 

                                  if ($booking_data->num_rows() > 0) { 
                                      foreach($booking_data->result() as $row){ 
                                  ?>  <tr>
                                      <td><?php echo $row->customer_nic;?></td>
                                      <td><?php echo $row->customer_name;?></td>
                                      <td><?php echo $row->customer_email;?></td>
                                      <td><?php echo $row->customer_phone;?></td>
                                      <td><?php echo $row->title." - ".$row->registered_number; ?></td>
                                      <td><?php echo $row->from_date;?></td>
                                      <td><?php echo $row->to_date;?></td>
                                      <td><?php echo $row->posting_date;?></td>
                                      <td class="booking-msg"><?php echo $row->message;?></td>
                                      <td>
                                        <?php 
                                            if(0==$row->status){

                                                echo "<label class=\"cursor-pointer\" data-toggle=\"modal\" data-target=\"#statusModal\" onclick=\"update_status('accept','$row->id','$row->customer_email')\" ><span class=\"mdi mdi-checkbox-marked-outline text-success\"> Accept</span></label>";

                                                echo "<label class=\"cursor-pointer\" data-toggle=\"modal\" data-target=\"#statusModal\" onclick=\"update_status('reject','$row->id','$row->customer_email')\" ><span class=\"mdi mdi mdi-close-box-outline text-danger ml-4\"> Reject</span></label>";

                                            }else if (1==$row->status) {
                                                echo "<label class=\"badge badge-gradient-success resize\">Accepted</label>";
                                            }else{
                                                echo "<label class=\"badge badge-gradient-danger resize\">Rejected</label>";
                                            }

                                        ?>
                                          
                                      </td>
                                      <td>
                                            <label class="cursor-pointer" onclick="update_booking(<?php 
                                                echo $row->id.','.
                                                $row->vehicle_id.',\''.
                                                $row->from_date.'\',\''.
                                                $row->to_date.'\',\''.
                                                $row->customer_name.'\',\''.
                                                $row->customer_nic.'\',\''.
                                                $row->customer_email.'\',\''.
                                                $row->customer_phone.'\',\''.
                                                $row->message.'\'';
                                               ?>)">
                                            <span class="mdi mdi-eyedropper text-success"> Edit</span> </label>

                                            <label class="cursor-pointer" data-toggle="modal" data-target="#deleteModal" onclick="delete_booking('<?php echo $row->id; ?>')"> <span class="mdi mdi-close-circle text-danger ml-4"> Remove</span> </label>

                                            <?php if (1==$row->status) { ?>
                                            
                                                    <?php 
                                                    
                                                        $is_regular = false;
                                                        foreach ($regular_customers->result() as $row2) {
                                                            if (strcmp($row->customer_nic, $row2->nic)==0) {
                                                                $is_regular = true;
                                                                $cust_id = $row2->id;
                                                                break;
                                                            }
                                                        }
                                                    ?>

                                                    <!-- New customer redirect to add regular cutomer -->
                                                    <?php if ($is_regular) { ?>

                                                        <a href="../Booking/init_for_reserve/<?php echo rawurlencode($cust_id) ?>/<?php echo rawurlencode($row->vehicle_id) ?>/<?php echo rawurlencode($row->from_date) ?>/<?php echo rawurlencode($row->to_date) ?>" style="text-decoration: blink"><span class="mdi mdi-car text-secondary ml-4"> Reserve</span> </a>

                                                        
                                                    <!--  Regular customer redirect to reserved -->
                                                    <?php }else{ ?>

                                                       <a href="../Booking/init_new_customer/<?php echo rawurlencode($row->customer_nic) ?>/<?php echo rawurlencode($row->customer_name) ?>/<?php echo rawurlencode($row->customer_email) ?>/<?php echo rawurlencode($row->customer_phone) ?>"  style="text-decoration: blink"><span class="mdi mdi-car text-dark ml-4"> Reserve</span> </a>
                                                       
 
                                                    <?php } ?>

                                            <?php } ?>

                                      </td>
                                      
                                  </tr>

                                  <?php 
                                      }
                                    }else{
                                  ?>
                                    <tr><td colspan="9" class="text-danger">No Data Found</td></tr>
              
                                  <?php } ?>


                                <!--tr>
                                    <td>Jacob</td>
                                    <td>Photoshop</td>
                                    <td>Jacob</td>
                                    <td>Jacob</td>
                                    <td>Photoshop</td>
                                    <td>Photoshop</td>
                                    <td>Photoshop</td>
                                    <td>Photoshop</td>
                                    <td>
                                        <a href=""><span class="mdi mdi-checkbox-marked-outline text-success"> Accept</span></a>
                                        <a href=""><span class="mdi mdi mdi-close-box-outline text-danger ml-4"> Reject</span></a>
                                    </td>
                                    
                                    <td>
                                        <a href=""><span class="mdi mdi-eyedropper text-success"> Edit</span></a>
                                        <a href=""><span class="mdi mdi-close-circle text-danger ml-4"> Remove</span></a>
                                    </td>
                                </tr-->

                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
  



<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('Booking/changeBookingStatus');?>
      <form>
      <div class="modal-body">
                <div id="statusmsg"></div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="bookingid" id="bookingid" required>
        <input type="hidden" name="bookingmail" id="bookingmail" required>
        <input type="hidden" name="bookingstatus" id="bookingstatus" required>
        <button type="submit" class="btn btn-primary">Yes</button>
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
      </form>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>


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
      <?php echo form_open('Booking/prepareToDeleteBooking');?>
      <form>
      <div class="modal-body">
                Are you sure want to delete this recode.
      </div>
      <div class="modal-footer">
        <input type="hidden" name="delbookingid" id="delbookingid" required>
        <button type="submit" class="btn btn-primary">Yes</button>
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
      </form>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>



<?php  if ($this->session->tempdata('form')=='add_form') { ?>
<script>
        document.getElementById("add_div").style.display = "block";
        document.getElementById("update_div").style.display = "none";
        document.getElementById("addBooking").classList.add("show");
</script>
<?php }else if($this->session->tempdata('form')=='update_form'){ ?>
<script>
        document.getElementById("update_div").style.display = "block";
        document.getElementById("add_div").style.display = "none";
        document.getElementById("updateBooking").classList.add("show");
</script>    
<?php }else{ ?>
<script>
        document.getElementById("add_div").style.display = "block";
        document.getElementById("update_div").style.display = "none";
</script> 
<?php } ?>





<script type="text/javascript" src="https://momentjs.com/downloads/moment.min.js">
  //include date fomatter I used bellow
</script>


<script type="text/javascript">

//set disabled dorp pff panel when page loading
document.getElementById("drop_off").disabled = true;



    function set_dropoff_min(){
        document.getElementById("drop_off").disabled = false;
        min = document.getElementById("pickup").value;
        document.getElementById("drop_off").value = null;

        document.getElementById("drop_off").min  = min;
    }

    function set_update_dropoff_min(){
        min = document.getElementById("update_pickup").value;
        document.getElementById("update_drop_off").value = null;

        document.getElementById("update_drop_off").min  = min;
    }


    function update_status(changeto,booking_id,booking_mail){

        document.getElementById("bookingid").value = booking_id;
        document.getElementById("bookingmail").value = booking_mail;
        document.getElementById("bookingstatus").value = changeto;
        document.getElementById("statusmsg").innerHTML = "Are you sure want to " + changeto ;
        
    }


    function delete_booking(del_booking_id){
        document.getElementById("delbookingid").value = del_booking_id;
    }

    
    function update_booking(id,vehicle_id,pickup,drop_off,name,nic,email,phone,msg){

      //display form if clickd edit in view table
      document.getElementById("add_div").style.display = "none";
      document.getElementById("update_div").style.display = "block";

      //load data into form
      document.getElementById("booking_id").value = id;
      document.getElementById("update_vehicle").value = vehicle_id;
      document.getElementById("update_pickup").value = moment(pickup, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DDTHH:mm:ss'); //change date format for put database
      document.getElementById("update_drop_off").value = moment(drop_off, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DDTHH:mm:ss');
      document.getElementById("update_name").value = name;
      document.getElementById("update_nic").value = nic;
      document.getElementById("update_email").value = email;
      document.getElementById("update_phone").value = phone;
      document.getElementById("update_msg").value = msg;

      //set minimum date for drop off 
      document.getElementById("update_drop_off").min = moment(pickup, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DDTHH:mm:ss');

      //update form collaps if loaded data into that form
      document.getElementById("updateBooking").classList.add("show");

    }

</script>



    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>