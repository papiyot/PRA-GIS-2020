@extends('layouts.simple')
@section('css_after')
<style>
    div.olControlAttribution,
    div.olControlScaleLine {
        font-family: Verdana;
        font-size: 0.7em;
        bottom: 3px;
    }
</style>

@endsection
@section('content')
<!-- Hero -->
<div class="bg-white bg-pattern hero-bubbles" style="background-image: url('{{ asset('/media/various/bg-pattern-inverse.png') }}');">
    <span class="hero-bubble wh-40 pos-t-5 pos-l-20 bg-danger-light"></span>
    <span class="hero-bubble wh-30 pos-t-5 pos-l-90 bg-danger"></span>
    <span class="hero-bubble wh-20 pos-t-10 pos-l-40 bg-danger"></span>
    <span class="hero-bubble wh-40 pos-t-20 pos-l-75 bg-danger-light"></span>
    <span class="hero-bubble wh-30 pos-t-30 pos-l-10 bg-danger"></span>
    <span class="hero-bubble wh-30 pos-t-60 pos-l-25 bg-danger"></span>
    <span class="hero-bubble wh-30 pos-t-60 pos-l-75 bg-danger"></span>
    <span class="hero-bubble wh-40 pos-t-80 pos-l-50 bg-danger-light"></span>
    <span class="hero-bubble wh-40 pos-t-75 pos-l-10 bg-danger-light"></span>
    <span class="hero-bubble wh-30 pos-t-90 pos-l-90 bg-danger-light"></span>
    <div class="hero overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <!-- <div class="pt-100 pb-150"> -->
                <h1 class="font-w700 display-4 mt-20 invisible" data-toggle="appear" data-timeout="50">
                    Home<span class="font-w300 text-pulse"> Page</span>
                </h1>
                <h2 class="h3 font-w400 text-muted mb-50 invisible" data-toggle="appear" data-class="animated fadeInDown" data-timeout="300">
                    Cari Kantor Polisi Terdekat
                </h2>
                <!-- <div class="invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="300">
                    <a class="btn btn-hero btn-alt-primary min-width-175 mb-10 mx-5" >
                        <i class="fa fa-fw fa-arrow-right mr-1"></i> Enter Dashboard
                    </a>
                </div> -->
                <div id="floating-panel" class="invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="300">
                    <b>To: </b>
                    <select id="to">
                        @foreach($data->locations as $locations)
                        <option value="{{$locations->locations_id}}" lat="{{$locations->locations_latitude}}" lng="{{$locations->locations_longitude}}">{{$locations->locations_name}}</option>
                        @endforeach

                    </select>
                    <b>Mode: </b>
                    <select id="mode">
                        <option value="DRIVING">DRIVING</option>
                        <option value="BICYCLING">BICYCLING</option>
                        <option value="TRANSIT">TRANSIT</option>
                        <option value="WALKING">WALKING</option>
                    </select>
                    <a class="btn btn-hero btn-sm btn-alt-primary mb-10 mx-5" onclick="direction()">
                        <i class="fa fa-fw fa-search mr-1"></i> Direction
                    </a>
                    <a class="btn btn-hero btn-sm btn-alt-success mb-10 mx-5" onclick="init('sad')">
                        <i class="fa fa-fw fa-map-marker mr-1"></i> My Location
                    </a>
                </div>
                <div id="Map" style="height:500px" class="invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="300"></div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->
@endsection

@section('js_after')
<!-- <script>
    map = new OpenLayers.Map("demoMap");
    map.addLayer(new OpenLayers.Layer.OSM());
    map.zoomToMaxExtent();
</script> -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF9mRyaqTj12UxNUJmHFfZWbrCp_APwrM"></script>
<script>
    var locations = [
        @foreach($data -> locations as $mylocations)["{{$mylocations->locations_name}}", {{$mylocations -> locations_latitude}}, {{$mylocations -> locations_longitude}}, "{{$mylocations->locations_address}}", "{{$mylocations->locations_id}}"],
        @endforeach
    ];
    const image = {
        url: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
        size: new google.maps.Size(20, 32),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 32),
    };

    var icon = {
        url: "https://www.waroengss.com/filemanager/image/icon-map.png"
    };
    var clickedLocation;
    var markers = [];
    var currentlocation;
    const directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();
    var map = new google.maps.Map(document.getElementById('Map'), {
        zoom: 15,
        center: new google.maps.LatLng(-2.0188205365653173, 107.96703549708104),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    directionsRenderer.setMap(map);

    function init(set = null) {
        markers = [];
        currentlocation;
        if (set) {
            directionsRenderer = new google.maps.DirectionsRenderer();
            map = new google.maps.Map(document.getElementById('Map'), {
                zoom: 15,
                center: new google.maps.LatLng(-2.0188205365653173, 107.96703549708104),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            directionsRenderer.setMap(map);
            
        }

        var infowindow = new google.maps.InfoWindow();

        mylocation();
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                // icon: icon,
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });
            markers.push(marker);

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                
                return function() {
                    document.getElementById("to").value = locations[i][4];
                    infowindow.setContent('<div style="width:200px; height:auto;" id="content">' + '<div id="siteNotice">' +
                        '</div>' +
                        '<h2 style="font-size:20px" id="firstHeading" class="firstHeading">' + locations[i][0] + '</h2>' +
                        '<div id="bodyContent">' +
                        '<p>' + locations[i][3] + 
                        // '<br><br><a style="text-center" onclick="outletdetail(' + locations[i][4] + ')" id="maps-btn">Detail</a></p>' +
                        '<p></p></div>' +
                        '</div>');

                    infowindow.open(map, marker);
                }
            })(marker, i));

        }
    }

    function direction() {
        calculateAndDisplayRoute(directionsService, directionsRenderer);
    }

    function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        let des = {
            lat: null,
            lng: null
        };
        locations.forEach(loc => {
            (loc[4] == document.getElementById("to").value) ? des.lat = loc[1]: null;
            (loc[4] == document.getElementById("to").value) ? des.lng = loc[2]: null;
        })
        directionsService.route({
                origin: currentlocation,
                destination: des,
                travelMode: document.getElementById("mode").value,
            },
            (response, status) => {
                // console.log('ini response', response);
                // console.log('ini currentlocation', currentlocation);
                // console.log('ini lat', parseInt(document.getElementById("to").lat));
                // console.log('ini des', des);
                // console.log('ini travelMode', document.getElementById("mode").value);
                if (status === "OK") {
                    directionsRenderer.setDirections(response);
                } else {
                    window.alert("Directions request failed due to " + status);
                }
            }
        );
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
            browserHasGeolocation ?
            "Error: The Geolocation service failed." :
            "Error: Your browser doesn't support geolocation."
        );
        infoWindow.open(map);
    }

    function mylocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    currentlocation = pos;
                    marker = new google.maps.Marker({
                        icon: image,
                        position: new google.maps.LatLng(pos.lat, pos.lng),
                        map: map,
                        draggable: true
                    });
                    map.setCenter(pos);
                    google.maps.event.addListener(map, 'click', function(event) {                
                    //Get the location that the user clicked.
                    clickedLocation = event.latLng;
                    //If the marker hasn't been added.
                    if(marker === false){
                        //Create the marker.
                        marker = new google.maps.Marker({
                            position: clickedLocation,
                            map: map,
                            draggable: true //make it draggable
                        });
                        //Listen for drag events!
                        google.maps.event.addListener(marker, 'dragend', function(event){
                            markerLocation();
                        });
                    } else{
                        //Marker has already been added, so just change its location.
                        marker.setPosition(clickedLocation);
                    }
                    //Get the marker's location.
                    markerLocation();
                });
                },
                () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            );
        } else {
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }
    function markerLocation(){
        currentlocation.lat = marker.getPosition().lat();
        currentlocation.lng = marker.getPosition().lng();
        //Add lat and lng values to a field that we can save.
        // console.log('drag',currentlocation );
    }
    init();
</script>
@endsection