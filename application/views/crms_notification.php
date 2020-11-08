<style>
    .notification{
        cursor: pointer;
        user-select:text;
    }
    .notification img{
        width:80px;
        height:80px;
        border-radius:250px;
    }

    .alert{
        box-shadow: 6px 2px 6px 0 rgba(0, 0, 0, 0.3), 0 4px 10px 0 rgba(0, 0, 0, 0.2);
        background-color:white;
    }

    .alert:hover{
        transform: scale(1.01);
        transition: 0.5s;
        box-shadow: 6px 2px 6px 0 rgba(0, 0, 0, 0.3), 0 4px 10px 0 rgba(0, 0, 0, 0.2);
        background-color:rgba(255,185,196,0.44);
    }
</style>

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
                  <i class="mdi mdi-bell"></i>
                </span> Notification </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body ">
                        <?php
                            date_default_timezone_set('Asia/Colombo');
                            $today_date=date("Y-m-d");
                            foreach($fetch_data->result() as $row){
                                $after_one_year=date("Y-m-d",strtotime($row->revenue_license_date."+365 day"));
                                $future_date=date("Y-m-d",strtotime($after_one_year."+10 day"));
                                $back_date=date("Y-m-d",strtotime($after_one_year."-10 day"));
                                if( $back_date < $today_date && $future_date > $today_date){

                        ?>
                        <div class="alert notification  text-black" role="alert">
                            <img src="<?php echo base_url($row->image);?>"
                            <label class="mr-4">The Revenue License of this vehicle  <b><?php echo $row->registered_number;?></b>, is about to expire .The date of expire is <?php echo $after_one_year;?></label>
                            <label class="mr-4"></label>
                        </div>
                        <?php
                                }
                            }
                        ?>

                        <?php
                            foreach($fetch_data->result() as $row){
                                $after_one_year=date("Y-m-d",strtotime($row->insurence_date."+365 day"));
                                $future_date=date("Y-m-d",strtotime($after_one_year."+10 day"));
                                $back_date=date("Y-m-d",strtotime($after_one_year."-10 day"));
                                if( $back_date < $today_date && $future_date > $today_date){
                        ?>
                        <div class="alert notification  text-black" role="alert">
                            <img src="<?php echo base_url($row->image);?>"
                            <label class="mr-4">The Insuranse of this vehicle <b><?php echo $row->registered_number;?></b> is about to expire .The date of expire is <?php echo $after_one_year;?></label>
                            <label class="mr-4"></label>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>