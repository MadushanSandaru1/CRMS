<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-primary card-img-holder text-white">
            <div class="card-body">
                <img src="<?php echo base_url('assets/images/dashboard/circle.svg');?>" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">New Pending Booking <i class="mdi mdi-bookmark mdi-24px float-right"></i></h4>
                <?php
                foreach ($new_booking_data->result() as $row) {
                    ?>
                    <h2 class="mb-5"><?php echo $row->new_booking_count; ?></h2>
                    <?php
                }
                ?>

                <?php
                foreach ($accepted_booking_data->result() as $row) {
                    ?>
                    <h6 class="card-text">Accepted Booking - <?php echo $row->accepted_booking_count; ?> </h6>
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
                <h4 class="font-weight-normal mb-3">Damage Vehicles <i class="mdi mdi-chart-line mdi-24px float-right"></i>
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
    </div>

    <div class="col-md-4 stretch-card grid-margin">
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
    </div>
</div>