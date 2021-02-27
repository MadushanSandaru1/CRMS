<style>
    a:hover {
        text-decoration: none;
    }
</style>

<div class="row">
    <a href="<?php echo base_url('index.php/Home/crms_damage'); ?>" class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-dark card-img-holder text-white">
            <div class="card-body">
                <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Damage Vehicles <i class="mdi mdi-car-wash mdi-24px float-right"></i>
                </h4>
                <?php
                foreach ($damage_vehicles_data->result() as $row) {
                    ?>
                    <h2 class="mb-5"><?php echo $row->damage_vehicles; ?></h2>
                    <?php
                }
                ?>

                <?php
                foreach ($monthly_damage_data->result() as $row) {
                    ?>
                    <h6 class="card-text">Damages this months - <?php echo $row->monthly_damage; ?> </h6>
                    <?php
                }
                ?>
            </div>
        </div>
    </a>

    <a href="<?php echo base_url('index.php/Home/crms_reserved'); ?>" class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Reserved <i class="mdi mdi-car mdi-24px float-right"></i>
                </h4>
                <?php
                foreach ($reserved_count_data->result() as $row) {
                    ?>
                    <h2 class="mb-5"><?php echo $row->reserved_count; ?></h2>
                    <?php
                }
                ?>

                <?php
                foreach ($reserved_delay_count_data->result() as $row) {
                    ?>
                    <h6 class="card-text">Delays in returned - <?php echo $row->reserved_delay_count; ?></h6>
                    <?php
                }
                ?>
            </div>
        </div>
    </a>
</div>

<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
                <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Daily Income <i class="mdi mdi-chart-line mdi-24px float-right"></i></h4>
                <?php
                foreach ($daily_income_data->result() as $row) {
                    ?>
                    <h2 class="mb-5">LKR <?php echo number_format($row->daily_income,2); ?></h2>
                    <?php
                }
                ?>

                <h6 class="card-text"><?php echo date("Y-m-d"); ?> </h6>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-warning card-img-holder text-white">
            <div class="card-body">
                <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Daily Expenses <i class="mdi mdi-chart-areaspline mdi-24px float-right"></i>
                </h4>
                <?php
                foreach ($daily_expense_data->result() as $row) {
                    ?>
                    <h2 class="mb-5">LKR <?php echo number_format($row->daily_expense,2); ?></h2>
                    <?php
                }
                ?>

                <h6 class="card-text"><?php echo date("Y-m-d"); ?> </h6>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Weekly Income <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <?php
                foreach ($weekly_income_data->result() as $row) {
                    ?>
                    <h2 class="mb-5">LKR <?php echo number_format($row->weekly_income,2); ?></h2>
                    <?php
                }
                ?>

                <?php
                foreach ($weekly_date_data->result() as $row) {
                    ?>
                    <h6 class="card-text"><?php echo $row->start_date; ?> <small>to</small> <?php echo $row->end_date; ?> </h6>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Weekly Expenses <i class="mdi mdi-chart-areaspline mdi-24px float-right"></i>
                </h4>
                <?php
                foreach ($weekly_expense_data->result() as $row) {
                    ?>
                    <h2 class="mb-5">LKR <?php echo number_format($row->weekly_expense,2); ?></h2>
                    <?php
                }
                ?>

                <?php
                foreach ($weekly_date_data->result() as $row) {
                    ?>
                    <h6 class="card-text"><?php echo $row->start_date; ?> <small>to</small> <?php echo $row->end_date; ?> </h6>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-primary card-img-holder text-white">
            <div class="card-body">
                <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Monthly Income <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <?php
                foreach ($monthly_income_data->result() as $row) {
                    ?>
                    <h2 class="mb-5">LKR <?php echo number_format($row->monthly_income,2); ?></h2>
                    <?php
                }
                ?>

                <?php
                foreach ($monthly_date_data->result() as $row) {
                    ?>
                    <h6 class="card-text"><?php echo $row->start_date; ?> <small>to</small> <?php echo $row->end_date; ?> </h6>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-dark card-img-holder text-white">
            <div class="card-body">
                <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Monthly Expenses <i class="mdi mdi-chart-areaspline mdi-24px float-right"></i>
                </h4>
                <?php
                foreach ($monthly_expense_data->result() as $row) {
                    ?>
                    <h2 class="mb-5">LKR <?php echo number_format($row->monthly_expense,2); ?></h2>
                    <?php
                }
                ?>

                <?php
                foreach ($monthly_date_data->result() as $row) {
                    ?>
                    <h6 class="card-text"><?php echo $row->start_date; ?> <small>to</small> <?php echo $row->end_date; ?> </h6>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>