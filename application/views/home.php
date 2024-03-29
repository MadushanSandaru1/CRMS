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
					Here at  Abhaya rent a car. we guarantee you will get the drive of a lifetime.
With our extensive range of high end cars, classic cars and something more comfortable for all your car rental needs.
				</p>
				<a href="#header-right" class="primary-btn text-uppercase text-light">Book Car Now</a>
            </div>
            <div class="col-lg-5  col-md-6">
				<div class="d-block d-sm-block d-md-none">
                    <p class="pt-20 pb-20 text-white text-center">
                        Here at  Abhaya rent a car. we guarantee you will get the drive of a lifetime.
With our extensive range of high end cars, classic cars and something more comfortable for all your car rental needs.
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
				<img class="img-fluid" src="<?php echo base_url('assets/images/benz.jpg'); ?>" alt="">
			</div>
			<div class="col-lg-6 no-padding home-about-right">
				<h1>We Guarantee</h1>
				<p>
					<span>We provide a reasonable service for the value you pay</span>
				</p>
				<p>
					That once you have confirmed your car transporter hire booking we will NEVER cancel simply to make way for a longer, more lucrative booking. There are rare instances due to circumstances beyond our control such as mechanical defect or accident we need to postpone your booking. 
				</p>
				<a class="text-uppercase primary-btn" href="<?php echo base_url('index.php/Home/car'); ?>">View vehicles</a>
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
                    <h1 class="mb-10">Let's book your car for an enjoyable journey</h1>
                    <p>Safety comfort and more with <span class="text-label">Abaya rent a car cab services</span></p>
                </div>
            </div>
        </div>
        <?php
        /*if(validation_errors()){
//            header("location:Home/index#bookingform");
//            redirect('Home/index#bookingform');
        }*/
        ?>
        <a name="bookingform"></a>
        <div class="row">
            <div class="col-lg-5  col-md-6 header-right">
                <h4 class="text-white pb-30">Book Your Car Today!</h4>
                <?php 

                    if ($this->session->flashdata('status')) {
                          echo " <div class=\"alert alert-success\">";
                          echo $this->session->flashdata('status');
                          echo "</div>";
                    }


                 ?>

                <?php echo form_open('Booking/prepareToCustomerInsertBooking');?>
                <form class="form" role="form" autocomplete="off" >
                    <div class="form-group">
                        <div class="default-select" id="default-select">
                            <select name="vehicle" class="<?php if(form_error('vehicle')) echo 'border border-danger' ?>">
                                <option value="" disabled selected hidden>Select Your Vehicle</option>
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
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 wrap-left">
                            <div class="default-select" id="default-select">
                                <div class="form-control txt-field" >Pickup</div>
                            </div>
                        </div>
                        <div class="col-md-6 wrap-right">
                            <div class="input-group dates-wrap">

                                 <input type="datetime-local" class="<?php if(form_error('pickup')) echo 'form-control txt-field border border-danger'; else echo 'form-control txt-field' ?>" name="pickup" id="pickup" placeholder="Date and Time" onchange="set_dropoff_min()"  min="<?php echo date("Y-m-d\TH:i", strtotime("1 day", strtotime(Date('Y-m-d\TH:i',time())))) ?>" value="<?php if($this->session->tempdata('pickup_fill')) echo $this->session->tempdata('pickup_fill'); ?>">
                                
                                <!--input id="datepicker" class="dates form-control" id="exampleAmount" placeholder="Date & time" type="text"-->
                                <!--div class="input-group-prepend">
                                    <span id="datepicker-icon" class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 wrap-left">
                            <div class="default-select" id="default-select">
                                <div class="form-control txt-field" >Drop off</div>
                            </div>
                        </div>
                        <div class="col-md-6 wrap-right">
                            <div class="input-group dates-wrap">
                                <input type="datetime-local" class="<?php if(form_error('drop_off')) echo 'form-control txt-field border border-danger'; else echo 'form-control txt-field' ?>" name="drop_off" id="drop_off" placeholder="Date and Time" min="<?php echo date("Y-m-d\TH:i", strtotime("2 day", strtotime(Date('Y-m-d\TH:i',time())))) ?>" value="<?php if($this->session->tempdata('drop_off_fill')) echo $this->session->tempdata('drop_off_fill'); ?>">
                                 
                                <!--input id="datepicker2" class="dates form-control" id="exampleAmount" placeholder="Date & time" type="text">
                                <div class="input-group-prepend">
                                    <span id="datepicker2-icon" class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div-->
                            </div>
                        </div>
                    </div>
                    <div class="from-group">

                        <input  class="<?php if(form_error('name')) echo 'form-control txt-field border border-danger'; else echo 'form-control txt-field' ?>"  type="text" id="name" name="name" placeholder="Your name" maxlength="100" pattern="[A-Za-z .]+" title="Numbers and special characters are not allowed" value="<?php if($this->session->tempdata('name_fill')) echo $this->session->tempdata('name_fill'); ?>" >
                        <small class="text-danger"><?php echo form_error('name'); ?></small>

                        <input class="<?php if(form_error('nic')) echo 'form-control txt-field border border-danger'; else echo 'form-control txt-field' ?>" type="text" id="nic" name="nic" placeholder="NIC number" pattern="[0-9]{9}[v|V|x|X]|[0-9]{12}" maxlength="12" title="Please enter a according to correct pattern" value="<?php if($this->session->tempdata('nic_fill')) echo $this->session->tempdata('nic_fill'); ?>">
                        <small class="text-danger"><?php echo form_error('nic'); ?></small>

                        <input class="<?php if(form_error('email')) echo 'form-control txt-field border border-danger'; else echo 'form-control txt-field' ?>" type="email" id="email" name="email" placeholder="Email address" placeholder="example@domain.com" maxlength="100" value="<?php if($this->session->tempdata('email_fill')) echo $this->session->tempdata('email_fill'); ?>" >
                        <small class="text-danger"><?php echo form_error('email'); ?></small>

                        <input class="<?php if(form_error('phone')) echo 'form-control txt-field border border-danger'; else echo 'form-control txt-field' ?>" type="tel" id="phone" name="phone" placeholder="Phone number" placeholder="0xxxxxxxxx" maxlength="10" pattern="0[0-9]{9}" title="Please follow the requested pattern" value="<?php if($this->session->tempdata('phone_fill')) echo $this->session->tempdata('phone_fill'); ?>"><small class="text-danger"><?php echo form_error('phone'); ?></small>

                        <textarea class="form-control txt-field" placeholder="Message" maxlength="255" name="msg" id="msg"><?php if($this->session->tempdata('msg_fill')) echo $this->session->tempdata('msg_fill'); ?></textarea>
                        <small class="text-danger"><?php echo form_error('msg'); ?></small>

                        <input type="hidden" name="status" id="status" value="0">

                        <!-- fouces if error ocurred -->
                        <div id="error_focus_point" tabindex="1"></div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">

                            <button type="submit" class="primary-btn btn-block text-center text-uppercase">Confirm Car Booking</button>
                        </div>
                    </div>
                </form>
                <?php echo form_close(); ?>
                
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
				<p>We can provide transport for business meetings, partners or maybe travel for clients on a regular basis or if you have an upcoming meeting with an important investor Abhaya rental car company  can offer anything from one-off corporate car hire to an ongoing luxury chauffeur service.
				</p>
				<a class="callaction-btn text-uppercase" href="<?php echo base_url('index.php/Home/contact'); ?>">Reach Our Support Team</a>	
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
                    Who are in extremely love with eco friendly also user friendly system.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-review">
                    <h4><span class="lnr lnr-user"></span> Professional Service</h4>
                    <p>
                        We are providing services to our valuable customers to do there activities easily.
                    </p>
                    <div class="star">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-review">
                    <h4><span class="lnr lnr-phone"></span> Great Support</h4>
                    <p>
                        We are always ready to support your vehicle problem easily.
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
                    <h4><span class="lnr lnr-diamond"></span> Highly Recommended</h4>
                    <p>
                        We are highly recommended our vehicles are best than other vehicles.
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
                    <h4><span class="lnr lnr-bubble"></span> Positive Reviews</h4>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
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
                    <h4><span class="lnr lnr-rocket"></span> 24 X 7  Availability</h4>
                    <p>
                        We are available at any time also anyone can access  this website in around the world.
                    </p>
                    <div class="star">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-review">
                    <h4><span class="lnr lnr-license"></span> Reduce Overhead Documentation</h4>
                    <p>
                        We are scheduling, conduction also doing task on automatically then we no need to keep kind of overhead documentation.
                    </p>
                    <div class="star">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End reviews Area -->

<script type="text/javascript">

    
    
   if(null==document.getElementById("pickup").value){
        document.getElementById("drop_off").disabled = true;
    }


    function set_dropoff_min(){
        document.getElementById("drop_off").disabled = false;
        min = document.getElementById("pickup").value;
        document.getElementById("drop_off").value = null;

        document.getElementById("drop_off").min  = min;
    }



    <?php if(validation_errors()) { ?>
            document.getElementById('error_focus_point').focus();
    <?php  } ?>


</script>





<?php
	require_once('footer.php');
?>