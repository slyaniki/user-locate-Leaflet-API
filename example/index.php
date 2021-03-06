<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../src/leaflet.css" />
    <link rel="stylesheet" href="../src/leaflet.usermarker.css" />

</head>

<body>
    <div id="map" style="width:100%; height:100%;"></div>

    <div id="controls">
        <div class="group">
            <button id="marker-add">Position actuelle</button><br>
            <button id="marker-popup">
                Lier le popup au marqueur</button><br>
            <button id="marker-remove">Supprimer marker</button>
        </div>
        <div class="group">
            <button id="manual-marker-add">Fixer une position </button><br>
            <button id="manual-marker-accuracy">Définir la précision</button><br>
            <button id="manual-marker-remove">supprimer marker</button>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="script/leaflet.js"></script>
    <script src="../src/leaflet.usermarker.js"></script>
    <script>
        // initialisation de la map
        var tab = [];
        var map = L.map('map').setView([38, 0], 2);
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 18
        }).addTo(map);

        // position actuelle
        var marker = null;
        $("#marker-add").click(function () {
            map.on("locationfound", function (location) {

                if (!marker)
                    marker = L.userMarker(location.latlng, {
                        pulsing: true
                    }).addTo(map);
                marker.setLatLng(location.latlng);
                marker.setAccuracy(location.accuracy);
                tab.push(location.latlng)
                console.log(tab[0]);
            });

            map.locate({
                watch: false,
                locate: true,
                setView: true,
                enableHighAccuracy: true
            });
        });
        $("#marker-popup").click(function () {
            if (marker) {
                marker.bindPopup("This is you!").openPopup();
            }
        });
        $("#marker-remove").click(function () {
            if (marker) {
                map.removeLayer(marker);
                marker = null;
            }
        });

        // marquer la position maneu
        var manualMarker = null;
        var points = [
            [20, 5],
            [5, 20],
            [10, 40],
            [50, 19],
            [2, 66],
            [5.30442, -3.96555]
        ];
        $("#manual-marker-add").click(function () {
            for (let i = 0; i < points.length; i++) {
                manualMarker = L.userMarker(points[i], {
                    smallIcon: false
                }, );
                manualMarker.addTo(map);
            }

        });







        $("#manual-marker-remove").click(function () {
            if (manualMarker) {
                map.removeLayer(manualMarker);
                manualMarker = null;
            }
        });
        $("#manual-marker-accuracy").click(function () {
            if (manualMarker) {
                manualMarker.setAccuracy(1500000);

            }
        });

       window.onload = ()=>{
           liveServer();
       }

        function liveServer(){
            $.ajax({
            type: "get",
            url: "getUsers.php",
            success: (result) => {
                showUsers(JSON.parse(result));
               liveServer();
            },
            error: (err) => {
                console.log(err);
            }
        });
        }

            

        function showUsers(users){
            renitialiseDivs($(".leaflet-marker-icon"));
            for (let i = 0; i < users.length; i++) {
                users[i].coords = [parseFloat(users[i].latitude),parseFloat(users[i].longitude)];
                
                manualMarker = L.userMarker(users[i].coords, {
                    smallIcon: false
                }, );
                manualMarker.addTo(map);
            }

            let divs = $(".leaflet-marker-icon");
           

            for (let i = 0; i < divs.length; i++) {
                divs[i].title = users[i].nom;
            }
        }

        function renitialiseDivs(div){
            for (let i = 0; i < div.length; i++) {
                div.remove();
            }
        }

    </script>
</body>