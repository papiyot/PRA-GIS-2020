@extends('layouts.simple')

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
                    <div class="pt-100 pb-150">
                        <h1 class="font-w700 display-4 mt-20 invisible" data-toggle="appear" data-timeout="50">
                            Home<span class="font-w300 text-pulse"> Page</span>
                        </h1>
                        <h2 class="h3 font-w400 text-muted mb-50 invisible" data-toggle="appear" data-class="animated fadeInDown" data-timeout="300">
                            Cari Kantor Polisi Terdekat
                        </h2>
                        <div class="invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="300">
                            <a class="btn btn-hero btn-alt-primary min-width-175 mb-10 mx-5" href="/dashboard">
                                <i class="fa fa-fw fa-arrow-right mr-1"></i> Enter Dashboard
                            </a>
                        </div>
                        <div id="Map" style="height:300px"></div>
                    </div>
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

<script>
    var lat            = 47.35387;
    var lon            = 8.43609;
    var zoom           = 18;

    var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
    var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
    var position       = new OpenLayers.LonLat(lon, lat).transform( fromProjection, toProjection);

    map = new OpenLayers.Map("Map");
    var mapnik         = new OpenLayers.Layer.OSM();
    map.addLayer(mapnik);

    var markers = new OpenLayers.Layer.Markers( "Markers" );
    map.addLayer(markers);
    markers.addMarker(new OpenLayers.Marker(position));

    map.setCenter(position, zoom);
</script>
@endsection