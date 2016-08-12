<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Tutorial Google Map - Petani Kode</title>
  
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYzddCCCvKCG1J7svHqbO7MzT5sUE3f-Q&callback=initMap"
  type="text/javascript"></script>
<script>
function initialize() {
  var propertiPeta = {
    center:new google.maps.LatLng(-8.5830695,116.3202515),
    zoom:9,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  
  var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
  

}

// event jendela di-load  
google.maps.event.addDomListener(window, 'load', initialize);
</script>
  
</head>
<body>

  <div id="googleMap" style="width:100%;height:380px;"></div>
  
</body>
</html>