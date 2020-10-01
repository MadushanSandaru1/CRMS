<?php
	require_once('partials/header.php');
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
				<p class="text-white link-nav"><a href="index.html">Home &nbsp;</a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="about.html">&nbsp; Cars</a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start model Area -->
<section class="model-area section-gap" id="cars">
	<div class="container">
		<div class="row d-flex justify-content-center pb-40">
			<div class="col-md-8 pb-40 header-text">
				<h1 class="text-center pb-10 mb-4">Choose your Desired Car Model</h1>
				
				<div class="d-flex justify-content-between">
					<div class="btn-group btn-group-sm" role="group" aria-label="Air Condition">
						<button type="button" class="btn btn-outline-danger">A/C</button>
						<button type="button" class="btn btn-outline-danger">Non A/C</button>
					</div>
					<div class="btn-group btn-group-sm" role="group" aria-label="Fuel Type">
						<button type="button" class="btn btn-outline-danger">Petrol</button>
						<button type="button" class="btn btn-outline-danger">Diesel</button>
					</div>
					<div class="btn-group btn-group-sm" role="group" aria-label="Transmission">
						<button type="button" class="btn btn-outline-danger">Auto</button>
						<button type="button" class="btn btn-outline-danger">Manual</button>
					</div>
				</div>
			</div>
		</div>

		<div class="row align-items-center single-model item mb-3">
			<div class="col-lg-6 model-left">
				<h4>Audi 3000 msi</h4>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
				</p>
				<p>
					Seat			: 04 <br>
					Fuel			: Petrol <br>
					Air Condition	: Dual Zone <br>
					Transmission	: Automatic
				</p>
				<div class="justify-content-between d-flex">
					<button class="text-uppercase primary-btn">Book This Car</button>
					<h2 class="car-price">LKR 10000<span>/day</span></h2>
				</div>
			</div>
			<div class="col-lg-6 model-right">
				<img class="img-fluid mx-auto d-block" src="<?php echo base_url(); ?>assets/images/car.jpg" alt="">
			</div>
		</div>

	</div>	
</section>
<!-- End model Area -->

<?php
	require_once('partials/footer.php');
?>