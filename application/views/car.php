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

		<div class="row item-container">
			<!-- item model -->
			<div class="row align-items-center single-model item mb-3 filter-ac">
				<div class="col-lg-6 model-left">
					<h4>Audi 3000 msi</h4>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
					</p>
                    <table class="ml-4 mb-2">
                        <tr>
                            <td>Seat</td>
                            <td class="pl-3">: <strong><b>04</b></strong> <br></td>
                        </tr>
                        <tr>
                            <td>Fuel</td>
                            <td class="pl-3">: <strong><b>Petrol</b></strong> <br></td>
                        </tr>
                        <tr>
                            <td>Air Condition</td>
                            <td class="pl-3">: <strong><b>Yes</b></strong> <br></td>
                        </tr>
                        <tr>
                            <td>Transmission</td>
                            <td class="pl-3">: <strong><b>Auto</b></strong> <br></td>
                        </tr>
                    </table>
					<div class="justify-content-between d-flex">
						<button class="text-uppercase primary-btn">Book This Car</button>
						<h2 class="car-price">LKR 10000<span>/day</span></h2>
					</div>
				</div>
				<div class="col-lg-6 model-right">
					<img class="img-fluid mx-auto d-block" src="<?php echo base_url(); ?>assets/images/cars/car.jpg" alt="">
				</div>
			</div>

            <div class="row align-items-center single-model item mb-3 filter-ac">
                <div class="col-lg-6 model-left">
                    <h4>Audi 3000 msi</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <table class="ml-4 mb-2">
                        <tr>
                            <td>Seat</td>
                            <td class="pl-3">: <strong><b>04</b></strong> <br></td>
                        </tr>
                        <tr>
                            <td>Fuel</td>
                            <td class="pl-3">: <strong><b>Petrol</b></strong> <br></td>
                        </tr>
                        <tr>
                            <td>Air Condition</td>
                            <td class="pl-3">: <strong><b>Yes</b></strong> <br></td>
                        </tr>
                        <tr>
                            <td>Transmission</td>
                            <td class="pl-3">: <strong><b>Auto</b></strong> <br></td>
                        </tr>
                    </table>
                    <div class="justify-content-between d-flex">
                        <button class="text-uppercase primary-btn">Book This Car</button>
                        <h2 class="car-price">LKR 10000<span>/day</span></h2>
                    </div>
                </div>
                <div class="col-lg-6 model-right">
                    <img class="img-fluid mx-auto d-block" src="<?php echo base_url(); ?>assets/images/cars/car.jpg" alt="">
                </div>
            </div>

		</div>
    </div>
</section>
<!-- End model Area -->

<?php
	require_once('partials/footer.php');
?>