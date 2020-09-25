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
                <a class="btn btn-hero btn-sm btn-alt-success mb-10 mx-5" >
                        <i class="fa fa-fw fa-map-marker mr-1"></i> My Location
                    </a>
                    <b>Start: </b>
                    <select id="start">
                        <option value="chicago, il">Chicago</option>
                        <option value="st louis, mo">St Louis</option>
                        <option value="joplin, mo">Joplin, MO</option>
                        <option value="oklahoma city, ok">Oklahoma City</option>
                        <option value="amarillo, tx">Amarillo</option>
                        <option value="gallup, nm">Gallup, NM</option>
                        <option value="flagstaff, az">Flagstaff, AZ</option>
                        <option value="winona, az">Winona</option>
                        <option value="kingman, az">Kingman</option>
                        <option value="barstow, ca">Barstow</option>
                        <option value="san bernardino, ca">San Bernardino</option>
                        <option value="los angeles, ca">Los Angeles</option>
                    </select>
                    <b>End: </b>
                    <select id="end">
                        <option value="chicago, il">Chicago</option>
                        <option value="st louis, mo">St Louis</option>
                        <option value="joplin, mo">Joplin, MO</option>
                        <option value="oklahoma city, ok">Oklahoma City</option>
                        <option value="amarillo, tx">Amarillo</option>
                        <option value="gallup, nm">Gallup, NM</option>
                        <option value="flagstaff, az">Flagstaff, AZ</option>
                        <option value="winona, az">Winona</option>
                        <option value="kingman, az">Kingman</option>
                        <option value="barstow, ca">Barstow</option>
                        <option value="san bernardino, ca">San Bernardino</option>
                        <option value="los angeles, ca">Los Angeles</option>
                    </select>
                    <b>Mode: </b>
                    <select id="end">
                        <option value="chicago, il">Chicago</option>
                        <option value="st louis, mo">St Louis</option>
                        <option value="joplin, mo">Joplin, MO</option>
                        <option value="oklahoma city, ok">Oklahoma City</option>
                        <option value="amarillo, tx">Amarillo</option>
                        <option value="gallup, nm">Gallup, NM</option>
                        <option value="flagstaff, az">Flagstaff, AZ</option>
                        <option value="winona, az">Winona</option>
                        <option value="kingman, az">Kingman</option>
                        <option value="barstow, ca">Barstow</option>
                        <option value="san bernardino, ca">San Bernardino</option>
                        <option value="los angeles, ca">Los Angeles</option>
                    </select>
                    <a class="btn btn-hero btn-sm btn-alt-primary mb-10 mx-5" >
                        <i class="fa fa-fw fa-search mr-1"></i> Direction
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
        @foreach($data->locations as $mylocations)
            ["{{$mylocations->locations_name}}", "{{$mylocations->locations_latitude}}", "{{$mylocations->locations_longitude}}", "{{$mylocations->locations_address}}", "{{$mylocations->locations_id}}"],
        @endforeach
    ];
    
    const markerArray = [];
    var currentlocation ;
    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer();
    var map = new google.maps.Map(document.getElementById('Map'), {
        zoom: 15,
        center: new google.maps.LatLng(-2.0188205365653173, 107.96703549708104),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    directionsRenderer.setMap(map);

    const onChangeHandler = function () {
        calculateAndDisplayRoute(directionsService, directionsRenderer);
    };

    document.getElementById("start").addEventListener("change", onChangeHandler);
    document.getElementById("end").addEventListener("change", onChangeHandler);
    var infowindow = new google.maps.InfoWindow();
    const image = {
        url: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
        size: new google.maps.Size(20, 32),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 32),
    };
    
    var icon = {
        url: "https://www.waroengss.com/filemanager/image/icon-map.png"
    };
    
    mylocation();
    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            // icon: icon,
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent('<div style="width:200px; height:auto;" id="content">' + '<div id="siteNotice">' +
                    '</div>' +
                    '<h2 style="font-size:20px" id="firstHeading" class="firstHeading">' + locations[i][0] + '</h2>' +
                    '<div id="bodyContent">' +
                    '<p>' + locations[i][3] + '<br><br><a style="text-center" onclick="outletdetail(' + locations[i][4] + ')" id="maps-btn">Detail</a></p>' +
                    '<p></p></div>' +
                    '</div>');

                infowindow.open(map, marker);
            }
        })(marker, i));

    }

    function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        directionsService.route(
            {
            origin: currentlocation,
            destination: {
                lat: -7.755874,
                lng: 110.376575
            },
            
            // destination: {
            //     query: document.getElementById("end").value,
            // },
            travelMode: google.maps.TravelMode.DRIVING,
            },
            (response, status) => {
                console.log('ini response', response);
                console.log('ini currentlocation', currentlocation);
                console.log('ini start', document.getElementById("start").value);
                console.log('ini end', document.getElementById("end").value);
                console.log('ini travelMode', google.maps.TravelMode.DRIVING);
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

    function mylocation(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    console.log('position', position );
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
                    console.log('ini pos', pos);
                    map.setCenter(pos);
                },
                () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            );
        } else {
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }
</script>
@endsection