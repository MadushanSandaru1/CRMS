<!DOCTYPE html>
<html>
  <head>
    <title>Google map</title>
    
    <style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
        height: 100vh;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
      }
    </style>
    <script>
      
   
      // Initialize and add the map
      function initMap() {

        var longitude = parseFloat(localStorage.getItem("Longitude"));
        var Latitude = parseFloat(localStorage.getItem("Latitude"));

        var current_location = { lat: Latitude, lng: longitude };
        // The map, centered at Uluru
        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 14,
          center: current_location,
        });
        
        var marker = new google.maps.Marker({
            position: current_location,
            map: map,
        });


         // setInterval(function initMap(){

         //  var longitude = parseFloat(localStorage.getItem("Longitude"));
         //  var Latitude = parseFloat(localStorage.getItem("Latitude"));
          //alert(localStorage.getItem("Longitude"));
          //alert(localStorage.getItem("Latitude"));
          // The location of Uluru
          //var uluru = { lat: Latitude, lng: longitude };
          // The map, centered at Uluru
          // var map = new google.maps.Map(document.getElementById("map"), {
          //   zoom: 14,
          //   center: uluru,
          // });
          // The marker, positioned at Uluru
         //  var marker = new google.maps.Marker({
         //    position: uluru,
         //    map: map,
         //  });

         // },3000);

      }
    </script>
  </head>
  <body>

    <div id="map"></div>
  </body>
</html>


<script type="text/javascript"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxrMJZbOnpAbPctXwashBp_dmlC-g0UTs&callback=initMap"> </script>
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAscBgnAtS8S0ItouY5wokjOlZmQlFrGRIk=initMap"> </script> -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2bXKNDezDf6YNVc-SauobynNHPo4RJb8&callback=initMap"> </script> -->


<!-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIwzALxUPNbatRBj3Xi1Uhp0fFzwWNBkE&callback=initMap&libraries=&v=weekly"
      defer
></script> -->
	
<!--script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxrMJZbOnpAbPctXwashBp_dmlC-g0UTs&callback=initMap&libraries=&v=weekly"
    defer
  ></script-->

