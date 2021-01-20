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
					Contact Us				
				</h1>	
<!--				<p class="text-white link-nav"><a href="--><?php //echo base_url('index.php/Home/index'); ?><!--">Home &nbsp;</a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="--><?php //echo base_url('index.php/Home/contact'); ?><!--">&nbsp; Contact Us</a></p>-->
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
	<div class="container">
    <?php
    if($this->session->flashdata('msg')) {
        ?>
        <div class="p-3 m-3 border border-danger text-danger text-center lead">
            <?php echo $this->session->flashdata('msg'); ?>
        </div>
        <?php
    }
    ?>
		<div class="row">

			<div class="map-wrap">
				<div class="mapouter"><div class="gmap_canvas"><iframe width="1080" height="445" id="gmap_canvas" src="https://maps.google.com/maps?q=Abhaya%20rent%20a%20car&t=&z=11&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/nordvpn-coupon-code/"></a></div></div>
			</div>

			<div class="col-lg-4 d-flex flex-column address-wrap">
				<div class="single-contact-address d-flex flex-row">
					<div class="icon">
						<span class="lnr lnr-home"></span>
					</div>
					<div class="contact-details">
						<h5>Beliatta, Matara</h5>
						<p>No 23/01, Wincent Road</p>
					</div>
				</div>
				<div class="single-contact-address d-flex flex-row">
					<div class="icon">
						<span class="lnr lnr-phone-handset"></span>
					</div>
					<div class="contact-details">
						<h5>(+94) 71 102 9301</h5>
						<p>24/7 Hours Service</p>
					</div>
				</div>
				<div class="single-contact-address d-flex flex-row">
					<div class="icon">
						<span class="lnr lnr-envelope"></span>
					</div>
					<div class="contact-details">
						<h5>abhayabeliatta@gmail.com</h5>
						<p>Send us your query anytime!</p>
					</div>
				</div>														
			</div>
			<div class="col-lg-8">
                <?php echo form_open('Contact/customer_message'); ?>

				<form class="form-area " id="myForm" method="post" class="contact-form text-right">
					<div class="row">
						<div class="col-lg-6 form-group">
							<input name="message_name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="common-input mb-20 form-control" type="text">
                            <small class="text-danger"><?php echo form_error('message_name'); ?></small>

							<input name="message_email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-20 form-control" type="email">
                            <small class="text-danger"><?php echo form_error('message_email'); ?></small>

                            <!-- fouces if error ocurred -->
                            <div id="error_focus_point" tabindex="1"></div>

							<input name="message_subject" placeholder="Enter your subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your subject'" class="common-input mb-20 form-control" type="text">
							<div class="mt-20 alert-msg" style="text-align: left;"></div>
                            <small class="text-danger"><?php echo form_error('message_subject'); ?></small>
						</div>
						<div class="col-lg-6 form-group">
							<textarea class="common-textarea form-control" name="message_content" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'"></textarea>
							<button type="submit" name="message_send_btn" class="primary-btn mt-20" style="float: right;">Send Message</button>
						</div>

					</div>
				</form>

				<?php echo form_close(); ?>
                <div class="text-danger">
                    <!--printed all error under the form-->
                    <?php //echo validation_errors(); ?>
                </div>

            </div>
		</div>
	</div>

    <script type="text/javascript">
        <?php if(validation_errors()) { ?>
            document.getElementById('error_focus_point').focus();
        <?php  } ?>
    </script>

</section>
<!-- End contact-page Area -->

<?php
	require_once('footer.php');
?>