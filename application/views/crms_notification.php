<?php

    //session timeout error
    if (!$this->session->userdata('user_id')) {
        $this->session->set_flashdata('user_status', 'Session timeout');

        //redirect to sign in page
        redirect('Home/crms_signin');
    }

?>

<style>
    .notification{
        cursor: pointer;
        user-select:none;
        font-family: Arial;
    }
    .notification img{
        width:80px;
        height:80px;
        border-radius:250px;
    }

    .alert{
        box-shadow: 4px 2px 4px 0 rgba(0, 0, 0, 0.2), 0 4px 6px 0 rgba(0, 0, 0, 0.2);
    }

    .alert:hover{
        transform: scale(1.01);
        transition: 0.5s;
        box-shadow: 6px 2px 6px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        background-color:rgba(255,185,196,0.44);
    }
</style>

<?php require_once 'crms_header.php';?>
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-bell"></i>
                </span> Notification </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span><i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <a class="card-body">
                        <?php

                            date_default_timezone_set('Asia/Colombo');
                            $today=date("Y-m-d");
                            foreach($revenue_license_date->result() as $row){
                                $after_one_year=date("Y-m-d",strtotime($row->revenue_license_date."+365 day"));
                                $today=date("Y-m-d");
                                if( $today> $after_one_year) {
                                    $txt_coloe = "#ff0000";
                                    $exp = "expired";
                                }else{
                                    $txt_coloe="";
                                    $exp="expire";
                                }
                        ?>
                        <div class="alert notification  text-black" data-toggle="modal" data-target="#revenueL" style="color:<?php echo $txt_coloe;?>" onclick="revenue_lic(<?php echo $row->id;?>,'<?php echo $after_one_year;?>','<?php echo $row->registered_number;?>')">
                            <img src="<?php echo base_url('assets/images/'.$row->image);?>">&nbsp;&nbsp;
                            <label class="mr-10">The Revenue License of this vehicle  <b><?php echo $row->registered_number;?></b>, is about to <?php echo $exp;?> . The date of expire is  <b><?php echo $after_one_year;?></b></label>
                        </div>
                        <?php
                            }
                        ?>
                        <?php
                            foreach($insurence_date->result() as $row){
                                $after_one_year=date("Y-m-d",strtotime($row->insurence_date."+365 day"));
                                if( $today> $after_one_year) {
                                    $bg_coloe = "#ff0000";
                                    $exp = "expired";
                                }else{
                                    $bg_coloe="";
                                    $exp="expire";
                                }
                        ?>
                        <div class="alert notification text-black"  data-toggle="modal" data-target="#Insurance" style="color:<?php echo $bg_coloe;?>" onclick="Insurance(<?php echo $row->id;?>,'<?php echo $after_one_year;?>','<?php echo $row->registered_number;?>')">
                            <img src="<?php echo base_url('assets/images/'.$row->image);?>">&nbsp;&nbsp;
                            <label class="mr-4">The Insurance of this vehicle <b><?php echo $row->registered_number;?></b> is about to  <?php echo $exp;?>. The date of expire is  <b><?php echo $after_one_year;?></b></label>
                        </div>
                        <?php
//                                }
                            }
                        ?>
                        <a  class="" href="<?php echo base_url('index.php/home/crms_booking')?>">
                        <?php
                        foreach($car_booking_notification->result() as $row){
                            ?>

                            <div class="alert notification text-black" style="width: 93%;margin-left: 45px;">
<!--                                <i class="mdi mdi-car-side mdi-48px text-danger"></i>-->

                                <label class="mr-4"><?php echo $row->customer_name;?> has Book the Car <?php echo $row->title;?></label>
                            </div>

                            <?php
                        }
                        ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal revenueL-->
        <div class="modal fade" id="revenueL" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: #f5005e" id="exampleModalLongTitle">Revenue License of  <label id="reg_num"></label></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('Home/update_revenueL_date'); ?>
                        <form method="post">
                            <input type="hidden" id="ve_id" name="vehicle_id">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Expire on : </label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label id="m_date"></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                        <label>New Date : </label>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="date" name="revenueL_date" class="form-control" value="<?php echo $today;?>" style="width: 100%;">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3"></div>
                                <div class="form-group col-md-9">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Date</button>
                                </div>
                            </div>
                        </form>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Insurance-->
        <div class="modal fade" id="Insurance" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: #f5005e" id="exampleModalLongTitle">Insurance of  <label id="i_reg_num"></label></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('Home/update_Insurance_date'); ?>
                        <form method="post">
                            <input type="hidden" id="i_ve_id" name="vehicle_id">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Expire on : </label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label id="i_date"></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                        <label>New Date : </label>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="date" name="insurance_date" class="form-control" value="<?php echo $today;?>" style="width: 100%;">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3"></div>
                                <div class="form-group col-md-9">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Date</button>
                                </div>
                            </div>
                        </form>
                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>
        </div>

    <!--car booking notification-->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body ">
<!--                        --><?php
//                            foreach($car_booking_notification->result() as $row){
//                        ?>
<!--                                <div class="alert notification  text-black" >-->
<!--                                    <i class="mdi mdi-account-circle mdi-48px   text-danger"></i>&nbsp;&nbsp;-->
<!--                                    <label class="mr-4"><b>--><?php //echo $row->customer_name;?><!--</b> </label>-->
<!--                                </div>-->
<!--                        --><?php
//                            }
//                        ?>
                    </div>
                </div>
            </div>
        </div>
    <!--end of car booking notification-->
    <!-- content-wrapper ends -->
<?php require_once "crms_footer.php";?>
<script>
    function revenue_lic(id,date,reg_num){
        document.getElementById("ve_id").value=id;
        document.getElementById("m_date").innerHTML=date;
        document.getElementById("reg_num").innerHTML=reg_num;
    }

    function Insurance(id,date,reg_num){
        document.getElementById("i_ve_id").value=id;
        document.getElementById("i_date").innerHTML=date;
        document.getElementById("i_reg_num").innerHTML=reg_num;
    }
</script>
