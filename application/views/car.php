<?php
	require_once('header.php');
?>

<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Cars				
				</h1>	
				<p class="text-white link-nav"><a href="<?php echo base_url('index.php/Home/index'); ?>">Home &nbsp;</a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="<?php echo base_url('index.php/Home/car'); ?>">&nbsp; Cars</a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start model Area -->
<section class="model-area section-gap" id="cars">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="col-md-8 pb-20 header-text">
				<h1 class="text-center pb-10 mb-4">Choose your Desired Car Model</h1>
				
				<div class="d-flex justify-content-between">
					<div class="btn-group btn-group-sm" role="group" aria-label="Air Condition">
						<li data-filter="*" class="filter-active btn btn-outline-danger">ALL</li>
					</div>
					<div id="item-flters" class="btn-group btn-group-sm" role="group" aria-label="Air Condition">
						<li data-filter=".filter-ac" class="btn btn-outline-danger">A/C</li>
						<li data-filter=".filter-nonac" class="btn btn-outline-danger">Non A/C</li>
					</div>
					<div class="btn-group btn-group-sm" role="group" aria-label="Fuel Type">
						<li data-filter=".filter-petrol" class="btn btn-outline-danger">Petrol</li>
						<li data-filter=".filter-diesel" class="btn btn-outline-danger">Diesel</li>
					</div>
					<div class="btn-group btn-group-sm" role="group" aria-label="Transmission">
						<li data-filter=".filter-auto" class="btn btn-outline-danger">Auto</li>
						<li data-filter=".filter-manual" class="btn btn-outline-danger">Manual</li>
					</div>
				</div>
			</div>
		</div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-5 pb-40 header-text">
                <input type="email" class="form-control form-control-sm border-danger text-danger text-center" id="colFormLabelSm" placeholder="Search vehicle">
            </div>
        </div>

		<div class="row item-container d-flex justify-content-center">
			<!-- item model -->
            <?php
            if($vehicle_data->num_rows() > 0) {
                foreach ($vehicle_data->result() as $data_row){
            ?>
			<div class="row align-items-center single-model item mb-3 <?php if($data_row->ac == 'A') echo "filter-ac"; else echo "filter-nonac"; ?> <?php if($data_row->fuel_type == 'P') echo "filter-petrol"; else echo "filter-diesel"; ?> <?php if($data_row->transmission == 'A') echo "filter-auto"; else echo "filter-manual"; ?>">
				<div class="col-lg-6 model-left">
					<h4><?php echo $data_row->title; ?></h4>
					<table class="ml-4 mb-2">
                        <tr>
                            <td>Seat</td>
                            <td class="pl-3">: <strong><b><?php echo $data_row->seat; ?></b></strong> <br></td>
                        </tr>
                        <tr>
                            <td>Fuel</td>
                            <td class="pl-3">: <strong><b><?php if($data_row->fuel_type == 'P') echo "Petrol"; else echo "Diesel"; ?></b></strong> <br></td>
                        </tr>
                        <tr>
                            <td>Air Condition</td>
                            <td class="pl-3">: <strong><b><?php if($data_row->ac == 'A') echo "AC"; else echo "Non A/C"; ?></b></strong> <br></td>
                        </tr>
                        <tr>
                            <td>Transmission</td>
                            <td class="pl-3">: <strong><b><?php if($data_row->transmission == 'A') echo "Auto"; else echo "Manual"; ?></b></strong> <br></td>
                        </tr>
                    </table>
					<div class="justify-content-between d-flex">
						<button class="text-uppercase primary-btn">Book This Car</button>
						<h2 class="car-price">LKR <?php echo number_format($data_row->price_per_day); ?><span>/day</span></h2>
					</div>
				</div>
				<div class="col-lg-6 model-right">
					<img class="img-fluid mx-auto d-block" src="<?php echo base_url('assets/images/vehicles/'.$data_row->image); ?>" alt="">
				</div>
			</div>

            <?php
                }
            } else {
            ?>
            <div class="row align-items-center">
                <p class="lead">No Data Found</p>
            </div>
            <?php
            }
            ?>

        </div>
    </div>
</section>
<!-- End model Area -->

<?php
	require_once('footer.php');
?>