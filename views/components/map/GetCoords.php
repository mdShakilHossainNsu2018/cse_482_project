<?php

class GetCoords
{

    public static function get()
    {

        echo <<< EOT


<div id="map" style="width:100%;height:400px;"></div>

<label for="lat">Latitude: </label>
<input class="box" name="lat" id="lat" value="0.0">
<label for="long">Longitude: </label>
<input class="box" name="long" id="long" value="0.0">

<script>


let mapDom = document.getElementById("map")

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(initMap);
  } else {
    map.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude +
  "<br>Longitude: " + position.coords.longitude;
}

function initMap(position) {
  const myLatLng = { lat: position.coords.latitude, lng: position.coords.longitude };
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    center: myLatLng,
  });
       document.getElementById("lat").value = position.coords.latitude;
      document.getElementById("long").value = position.coords.longitude;
  
  let marker =  new google.maps.Marker({
    position: myLatLng,
    map,
    title: "Hello World!",
  });
  
  new google.maps.event.addListener(map, 'click', function(event) {
      marker.setPosition(event.latLng);
      
      document.getElementById("lat").value = event.latLng.lat();
      document.getElementById("long").value = event.latLng.lng();
      
      // console.log(event.latLng.lat());
marker.setMap(map);
marker.setAnimation(google.maps.Animation.DROP);
   // placeMarker(event.latLng);
});

// function placeMarker(location) {
//     var marker = new google.maps.Marker({
//         position: location, 
//         map: map
//     });
// }
}

</script>

 <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=getLocation&v=weekly&channel=2"
      async
    ></script>

EOT;

    }
}