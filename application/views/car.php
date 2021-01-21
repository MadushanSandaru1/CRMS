<?php
	require_once('header.php');
?>

<style>
    .show {
        display: block;
    }

    .vehicleItem {
        width: 100%;
        /*display: none;*/
    }
</style>

<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Cars				
				</h1>	
<!--				<p class="text-white link-nav"><a href="--><?php //echo base_url('index.php/Home/index'); ?><!--">Home &nbsp;</a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="--><?php //echo base_url('index.php/Home/car'); ?><!--">&nbsp; Cars</a></p>-->
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
						<li onclick="filterSelection('all')" class="btn btn-outline-danger">ALL</li>
					</div>
					<div id="item-flters" class="btn-group btn-group-sm" role="group" aria-label="Air Condition">
						<li onclick="filterSelection('filter-ac')" class="btn btn-outline-danger">A/C</li>
						<li  onclick="filterSelection('filter-nonac')"class="btn btn-outline-danger">Non A/C</li>
					</div>
					<div class="btn-group btn-group-sm" role="group" aria-label="Fuel Type">
						<li onclick="filterSelection('filter-petrol')" class="btn btn-outline-danger">Petrol</li>
						<li onclick="filterSelection('filter-diesel')" class="btn btn-outline-danger">Diesel</li>
					</div>
					<div class="btn-group btn-group-sm" role="group" aria-label="Transmission">
						<li onclick="filterSelection('filter-auto')" class="btn btn-outline-danger">Auto</li>
						<li onclick="filterSelection('filter-manual')" class="btn btn-outline-danger">Manual</li>
					</div>
				</div>
			</div>
		</div>

<!--        <div class="row d-flex justify-content-center">-->
<!--            <div class="col-md-5 pb-40 header-text">-->
<!--                <input type="email" id="searchTxt" onkeyup="searchCars()" class="form-control form-control-sm border-danger text-danger text-center" placeholder="Search vehicle">-->
<!--            </div>-->
<!--        </div>-->

		<div id="vehicleList" class="row item-container d-flex justify-content-center">
			<!-- item model -->
            <?php
            if($vehicle_data->num_rows() > 0) {
                foreach ($vehicle_data->result() as $data_row){
            ?>
			<div class="vehicleItem row align-items-center single-model item mb-3 <?php if($data_row->ac == 'A') echo "filter-ac"; else echo "filter-nonac"; ?> <?php if($data_row->fuel_type == 'P') echo "filter-petrol"; else echo "filter-diesel"; ?> <?php if($data_row->transmission == 'A') echo "filter-auto"; else echo "filter-manual"; ?>">
                <h6 hidden><?php echo $data_row->title; ?></h6>
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

        <script type="text/javascript">
            // car filter
            filterSelection("all")
            function filterSelection(c) {
                var x, i;
                x = document.getElementsByClassName("vehicleItem");
                if (c == "all") c = "";
                for (i = 0; i < x.length; i++) {
                    w3RemoveClass(x[i], "show");
                    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
                }
            }

            function w3AddClass(element, name) {
                var i, arr1, arr2;
                arr1 = element.className.split(" ");
                arr2 = name.split(" ");
                for (i = 0; i < arr2.length; i++) {
                    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
                }
            }

            function w3RemoveClass(element, name) {
                var i, arr1, arr2;
                arr1 = element.className.split(" ");
                arr2 = name.split(" ");
                for (i = 0; i < arr2.length; i++) {
                    while (arr1.indexOf(arr2[i]) > -1) {
                        arr1.splice(arr1.indexOf(arr2[i]), 1);
                    }
                }
                element.className = arr1.join(" ");
            }


            // car search
            function searchCars(){
                var input, filter, div, tr, td, cell, i, j;
                input = document.getElementById("searchTxt");
                filter = input.value.toUpperCase();
                div = document.getElementById("vehicleList");
                tr = div.getElementsByClassName("vehicleItem");
                for (i = 0; i < tr.length; i++) {
                    // Hide the row initially.
                    tr[i].style.display = "none";

                    td = tr[i].getElementsByTagName("td");
                    for (var j = 0; j < td.length; j++) {
                        cell = tr[i].getElementsByTagName("td")[j];
                        if (cell) {
                            if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                                break;
                            }
                        }
                    }
                }
            }
        </script>

    </div>
</section>
<!-- End model Area -->

<?php
	require_once('footer.php');
?>