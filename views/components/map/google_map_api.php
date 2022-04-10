<?php

require_once(getenv("ROOT")."database/PropertyHelper.php");
$points = PropertyHelper::getAllCoords();

?>


<div id="map" style="width:100%;height:400px;"></div>


<script type="text/javascript">
    let tempArray = <?php echo JSON_encode($points); ?>;
    console.log(tempArray);
    let mapDom = document.getElementById("map")

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(initMap);
        } else {
            map.innerHTML = "Geolocation is not supported by this browser.";
        }
    }


    function initMap(position) {
        const myLatLng = {lat: position.coords.latitude, lng: position.coords.longitude};
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10,
            center: myLatLng,
        });

        tempArray.forEach(obj => {
            const latLong = {lat: parseFloat(obj['lat']),
                lng: parseFloat(obj['long'])};
            console.log(latLong);
            new google.maps.Marker({
                position: latLong,
                map,
                title: "Hello World!",
            });
        })

    }

</script>

<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=getLocation&v=weekly&channel=2"
        async
></script>




