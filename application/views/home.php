<?php
	require_once('header.php');
?>

<!-- start banner Area -->
<section class="banner-area relative" id="home">
	<div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-center">
            <div class="banner-content col-lg-7 col-md-6 ">
                <h6 class="text-white ">the Royal Essence of Journey</h6>
                <h1 class="text-white text-uppercase">Relaxed Journey Ever</h1>
                <p class="pt-20 pb-20 text-white">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
				</p>
				<a href="#header-right" class="primary-btn text-uppercase text-light">Book Car Now</a>
            </div>
            <div class="col-lg-5  col-md-6">
				<div class="d-block d-sm-block d-md-none">
                    <p class="pt-20 pb-20 text-white text-center">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
			</div>
		</div>
	</div>					
</section>
<!-- End banner Area -->	

<!-- Start home-about Area -->
<section class="home-about-area" id="about">
	<div class="container-fluid">				
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-6 no-padding home-about-left d-none d-lg-block d-xl-block">
				<img class="img-fluid" src="<?php echo base_url('assets/images/about-img.jpg'); ?>" alt="">
			</div>
			<div class="col-lg-6 no-padding home-about-right">
				<h1>Globally Connected <br>
				by Large Network</h1>
				<p>
					<span>We are here to listen from you deliver exellence</span>
				</p>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
					Ut enim ad minim. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.
				</p>
				<a class="text-uppercase primary-btn" href="#">get details</a>
			</div>
		</div>
	</div>	
</section>
<!-- End home-about Area -->

<!-- Start blog Area -->
<section class="blog-area section-gap" id="blog">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center"  id="header-right">
                    <h1 class="mb-10">Latest From Our Blog</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5  col-md-6 header-right">
                <h4 class="text-white pb-30">Book Your Car Today!</h4>
                <form class="form" role="form" autocomplete="off">
                    <div class="form-group">
                        <div class="default-select" id="default-select">
                            <select>
                                <option value="" disabled selected hidden>Select Your Car</option>
                                <option value="1">BMW</option>
                                <option value="1">Farrari</option>
                                <option value="1">Toyota</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 wrap-left">
                            <div class="default-select" id="default-select">
                                <select>
                                    <option value="" disabled selected hidden>Pickup</option>
                                    <option value="1">Pickup One</option>
                                    <option value="1">Pickup Two</option>
                                    <option value="1">Pickup Three</option>
                                    <option value="1">Pickup Four</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 wrap-right">
                            <div class="input-group dates-wrap">
                                <input id="datepicker" class="dates form-control" id="exampleAmount" placeholder="Date & time" type="text">
                                <div class="input-group-prepend">
                                    <span id="datepicker-icon" class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 wrap-left">
                            <div class="default-select" id="default-select">
                                <select>
                                    <option value="" disabled selected hidden>Drop off</option>
                                    <option value="1">Drop off One</option>
                                    <option value="1">Drop off Two</option>
                                    <option value="1">Drop off Three</option>
                                    <option value="1">Drop off Four</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 wrap-right">
                            <div class="input-group dates-wrap">
                                <input id="datepicker2" class="dates form-control" id="exampleAmount" placeholder="Date & time" type="text">
                                <div class="input-group-prepend">
                                    <span id="datepicker2-icon" class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="from-group">
                        <input class="form-control txt-field" type="text" name="name" placeholder="Your name">
                        <input class="form-control txt-field" type="email" id="email" name="email" placeholder="Email address">
                        <input class="form-control txt-field" type="tel" id="phone" name="phone" placeholder="Phone number">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="reset" class="primary-btn btn-block text-center text-uppercase">Confirm Car Booking</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End blog Area -->

<!-- Start callaction Area -->
<section class="callaction-area relative section-gap">
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<h1 class="text-white">Experience Great Support</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
				</p>
				<a class="callaction-btn text-uppercase" href="#">Reach Our Support Team</a>	
			</div>
		</div>
	</div>	
</section>
<!-- End callaction Area -->

<!-- Start reviews Area -->
<section class="reviews-area section-gap" id="review">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 pb-40 header-text text-center">
                <h1>Some Features that Made us Unique</h1>
                <p class="mb-10 text-center">
                    Who are in extremely love with eco friendly system.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-review">
                    <h4>Cody Hines</h4>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                    <div class="star">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-review">
                    <h4>Chad Herrera</h4>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                    <div class="star">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-review">
                    <h4>Andre Gonzalez</h4>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                    <div class="star">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-review">
                    <h4>Jon Banks</h4>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                    <div class="star">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-review">
                    <h4>Landon Houston</h4>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                    <div class="star">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-review">
                    <h4>Nelle Wade</h4>
                    <p>
                        Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                    </p>
                    <div class="star">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End reviews Area -->

<?php
	require_once('footer.php');
?>