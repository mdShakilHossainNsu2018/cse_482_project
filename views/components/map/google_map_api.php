<?php

require_once(getenv("ROOT") . "database/PropertyHelper.php");
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
        const svgMarker = {
            path: "M 318.954 178.65 c 0 -57.789 -47.015 -104.803 -104.804 -104.803 c -57.789 0 -104.803 47.015 -104.803 104.803 c 0 57.789 47.015 104.804 104.803 104.804 C 271.939 283.454 318.954 236.439 318.954 178.65 z z M 125.153 90.081 c 2.39 0 4.788 -0.852 6.701 -2.58 c 22.593 -20.412 51.819 -31.654 82.296 -31.654 c 17.038 0 33.525 3.42 49.006 10.165 c 5.063 2.206 10.957 -0.11 13.162 -5.173 c 2.206 -5.063 -0.11 -10.956 -5.173 -13.162 c -18.016 -7.85 -37.192 -11.83 -56.995 -11.83 c -35.44 0 -69.428 13.074 -95.704 36.814 c -4.098 3.702 -4.418 10.026 -0.716 14.124 C 119.704 88.97 122.423 90.081 125.153 90.081 z M 101.143 108.146 c -4.889 -2.567 -10.935 -0.685 -13.502 4.205 c -10.659 20.3 -16.293 43.226 -16.293 66.299 c 0 5.523 4.477 10 10 10 s 10 -4.477 10 -10 c 0 -19.847 4.841 -39.558 14 -57.001 C 107.915 116.759 106.032 110.713 101.143 108.146 z M 456.5 500 c 5.523 0 10 -4.477 10 -10 V 361 c 0 -0.091 -0.011 -0.178 -0.014 -0.268 c -0.012 -0.436 -0.044 -0.892 -0.114 -1.324 l -10 -62 c -0.782 -4.846 -4.964 -8.408 -9.873 -8.408 h -89.722 c 23.905 -47.183 36.022 -84.27 36.022 -110.35 C 392.8 80.142 312.658 0 214.15 0 C 115.642 0 35.5 80.142 35.5 178.65 c 0 95.435 163.74 310.329 170.711 319.431 c 1.892 2.471 4.827 3.919 7.939 3.919 s 6.047 -1.449 7.939 -3.919 c 0.275 -0.359 23.494 -30.74 52.411 -73.167 V 490 c 0 5.523 4.477 10 10 10 H 456.5 z M 444.758 351 H 296.242 l 6.774 -42 h 134.968 L 444.758 351 z M 214.15 475.333 c -14.172 -19.112 -45.222 -61.928 -75.95 -110.545 C 84.097 279.187 55.5 214.821 55.5 178.65 C 55.5 91.17 126.67 20 214.15 20 S 372.8 91.17 372.8 178.65 c 0 24.519 -12.964 61.638 -38.522 110.35 H 294.5 c -4.908 0 -9.091 3.562 -9.873 8.408 l -10 62 c -0.084 0.519 -0.127 1.066 -0.127 1.592 v 27.973 C 249.352 427.22 225.928 459.454 214.15 475.333 z M 353.5 480 v -68 h 34 v 68 H 353.5 z M 446.5 480 h -39 v -78 c 0 -5.523 -4.477 -10 -10 -10 h -54 c -5.523 0 -10 4.477 -10 10 v 78 h -39 V 371 h 152 V 480 z",
            fillColor: "red",
            fillOpacity: 0.6,
            strokeWeight: 0,
            rotation: 0,
            scale: 0.09,
            anchor: new google.maps.Point(15, 30),
        };

        const svgMarker2 = {
            path: "M332.195,0C216.595,0,122.889,93.676,122.889,209.287s209.306,455.084,209.306,455.084s209.287-339.494,209.287-455.084C541.482,93.676,447.796,0,332.195,0z M332.195,371.208c-89.299,0-161.94-72.651-161.94-161.94s72.641-161.931,161.94-161.931c89.28,0,161.931,72.651,161.931,161.931C494.126,298.566,421.475,371.208,332.195,371.208zM303.031,285.455l59.383,0.01v20.302h23.966V77.526H278v13.043h96.91v16.668H278v198.52h25.031V285.455L303.031,285.455z M341.555,124.98h32.31v32.31h-32.31V124.98z M341.301,180.699h32.31v32.329h-32.31V180.699zM341.301,235.94h32.31v32.281h-32.31V235.94z M291.024,124.98h32.32v32.31h-32.32V124.98z M290.77,180.699h32.3v32.329h-32.3C290.77,213.029,290.77,180.699,290.77,180.699z M290.77,235.949h32.3v32.281h-32.3C290.77,268.23,290.77,235.949,290.77,235.949z",

            fillColor: "red",
            fillOpacity: 0.6,
            strokeWeight: 0,
            rotation: 0,
            scale: 0.09,
            anchor: new google.maps.Point(15, 30),
        };

        tempArray.forEach(obj => {
            const latLong = {
                lat: parseFloat(obj['lat']),
                lng: parseFloat(obj['long'])
            };
            console.log(latLong);
            new google.maps.Marker({
                position: latLong,
                map,
                title: obj["address"],
                icon: svgMarker2
            });
        })

    }

</script>

<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=getLocation&v=weekly&channel=2"
        async
></script>




