<?php

    //session timeout error
    if (!$this->session->userdata('user_id')) {
        $this->session->set_flashdata('user_status', 'Session timeout');

        //redirect to sign in page
        redirect('Home/crms_signin');
    }

?>

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
                  <i class="mdi mdi-crosshairs-gps"></i>
                </span> Car Tracking </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span><i class="mdi mdi-clock icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">

            <!--  traker start-->



                <h2 id="x"></h2>

                <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-danger mb-5">Location </h4>

                    <form class="forms-sample">
                      
                      <div class="form-group">
                        <label class="mb-3">Select car</label>
                        
                        <div class="input-group col-xs-12">
                          
                          <select class="form-control file-upload-info" id="vehicleid" onchange="trackinmap()">
                            <option value="" hidden disabled selected>Select a vehicle</option>
                            <?php 
                                foreach ($vehicle_data->result() as $row) {
                                    echo "<option value='".$row->registered_number."''>".$row->title." - ".$row->registered_number."</option>";
                                }
                             ?>
                         </select>

                          <span class="input-group-append">
                            <a href="<?php echo base_url('index.php/Home/loadmap'); ?>" target="imap" ><button class="file-upload-browse btn btn-gradient-primary ml-3" type="button">Track</button></a>
                          </span>
                        </div>
                      </div>
                      
                      
                    </form>
                    
                    <!-- source from =  https://www.embedgooglemap.net/en/?gclid=Cj0KCQiAnb79BRDgARIsAOVbhRqu2cC2RGI1ESI87-N5bI1ei8kmfskNZkPgoxyKfzOymGafr0QTRbsaAoHVEALw_wcB-->

                    <!-- <div class="mapouter">
                        <div class="gmap_canvas">
                            <iframe width="100%" height="800" id="gmap_canvas" src="https://maps.google.com/maps?q=Beliatta%20abhaya&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                
                            </iframe>
                            
                        </div>
                        <style>
                            .mapouter{
                                position:relative;
                                text-align:right;
                                height:800px;
                                width:100%;
                                }
                                .gmap_canvas {
                                    overflow:hidden;
                                    background:none!important;
                                    height:800px;
                                    width:100%;
                                }
                        </style>
                    </div> -->
                   
                    <!-- <div id="map"></div>  -->
                    <iframe name="imap" id="imap" width="100%" height="800px" scrolling="no" src="<?php echo base_url('index.php/Home/loadmap'); ?>"></iframe>
                   
                  </div>
                </div>
              </div>
            <!-- tracker end-->


        </div>

    </div>


<!-- content-wrapper ends -->
<?php require_once 'crms_footer.php';?>



<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-database.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-analytics.js"></script>

<script>

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyDxrMJZbOnpAbPctXwashBp_dmlC-g0UTs",
    authDomain: "gps-tracking-291518.firebaseapp.com",
    databaseURL: "https://gps-tracking-291518-default-rtdb.firebaseio.com",
    projectId: "gps-tracking-291518",
    storageBucket: "gps-tracking-291518.appspot.com",
    messagingSenderId: "768782133031",
    appId: "1:768782133031:web:204ca92cee90f8ae10ab02",
    measurementId: "G-NL62KRG6HN"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();



//track map

function trackinmap(){


    var vid = document.getElementById("vehicleid");
    var strvid = vid.options[vid.selectedIndex].value;


    var ref = firebase.database().ref().child('/vehicles/'+strvid);
    
    ref.on("value", function(snapshot) {

        if (snapshot.val()!=null) {
            localStorage.setItem('Latitude', snapshot.val().Latitude);
            localStorage.setItem('Longitude', snapshot.val().Longitude);
        }else{
            localStorage.setItem('Latitude', null);
            localStorage.setItem('Longitude', null);
        }
        
    }, function (error) {
        alert("sd");
       console.log("Error: " + error.code);
    });


}




$(document).ready(function() {
        setInterval(function refreshDarkSky() {
            $("#imap").attr("src", "<?php echo base_url('index.php/Home/loadmap'); ?>");
        }, 10000);
});












 /* var x = document.getElementById('x');
  var dbRef = firebase.database().ref().child('vehicels');
  dbRef.on('value',snap => x.innerHTML = snap.val());
*/

  /*Fetch veihicels*/
/*
var ref = firebase.database().ref().child('/vehicles');

ref.on("value", function(snapshot) {

    snapshot.forEach(function(ChildSnapshot){
        console.log(ChildSnapshot.key());
    });

    /*foreach(function(snapshot){
        console.log(child.key+': '+child.val());
    }

   //console.log(Object.values(snapshot.val()) );
   //console.log(snapshot.val());

}, function (error) {
   console.log("Error: " + error.code);
});

*/

  // function initMap() { 

  //       var uluru = {lat: 6.806635, lng: 79.97114630000002}; 
  //       var map = new google.maps.Map(document.getElementById('map'), { 
  //       zoom: 15, 
  //       center: uluru 
  //       }); 
  //       var marker = new google.maps.Marker({ 
  //       position: uluru, 
  //       map: map 
  //       }); 
  //   } 


</script>

<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2bXKNDezDf6YNVc-SauobynNHPo4RJb8&callback=initMap"> </script> 

 -->




