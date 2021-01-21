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
        

        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-crosshairs-gps"></i>
                </span> Car Tracking </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
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
  var firebaseConfig = {
    apiKey: "AIzaSyAUupoER_mSO2D04ArrICsecEgO3mjXoZk",
    authDomain: "tracker-fe14d.firebaseapp.com",
    databaseURL: "https://tracker-fe14d-default-rtdb.firebaseio.com",
    projectId: "tracker-fe14d",
    storageBucket: "tracker-fe14d.appspot.com",
    messagingSenderId: "487604763565",
    appId: "1:487604763565:web:3f8957533cdaea81f97f24"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();



//track map

function trackinmap(){

    var vid = document.getElementById("vehicleid");
    var strvid = vid.options[vid.selectedIndex].value;

    var ref = firebase.database().ref();

    ref.on("value", function(snapshot) {

        //console.log(snapshot.child(strvid).val());

        if (snapshot.child(strvid).val()!=null) {
            localStorage.setItem('Latitude', snapshot.child(strvid).val().latitude);
            localStorage.setItem('Longitude', snapshot.child(strvid).val().longitude);
        }else{
            localStorage.setItem('Latitude', null);
            localStorage.setItem('Longitude', null);
        }
        
    }, function (error) {
        alert("sd");
       console.log("Error: " + error.code);
    });


}


//init local storage
localStorage.setItem('Latitude', null);
localStorage.setItem('Longitude', null);



</script>



