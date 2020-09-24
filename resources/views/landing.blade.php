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
                <div class="invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="300">
                    <a class="btn btn-hero btn-alt-primary min-width-175 mb-10 mx-5" href="/dashboard">
                        <i class="fa fa-fw fa-arrow-right mr-1"></i> Enter Dashboard
                    </a>
                </div>
                <div id="floating-panel">
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
                </div>
                <div id="Map" style="height:500px"></div>
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
        ["WSS Sompok", "-7.001399", "110.435182", "Jl. Sompok No 22, Semarang Selatan, Semarang", "1"],
        ["WSS Banyumanik", "-7.058927", "110.419344", "Jl. Durian Selatan I no. 29, Srondol Wetan, Banyumanik", "2"],
        ["WSS Puri Anjasmoro", "-6.977567", "110.390782", "Jl. Puri Anjasmoro Raya No 49, Semarang Barat, Semarang", "3"],
        ["WSS Sambiroto", "-7.032299", "110.458408", "Jl. Sambiroto Raya No F5 (Ruko Sambiroto) Semarang", "4"],
        ["WSS Lampersari", "-7.005722", "110.433339", "Jl. Lamper Sari No.29, Lamper Kidul, Semarang Selatan, Kota Semarang", "5"],
        ["WSS Ngaliyan", "-6.990962", "110.355057", "Jl. Prof. Dr Hamka No 59, Semarang Barat,Ngaliyan, Semarang", "6"],
        ["WSS Salatiga Diponegoro", "-7.315488", "110.493782", "Jl. Diponegoro No 105, Ruko wijaya Square A1, Sidorejo, Kota Salatiga,", "7"],
        ["WSS Salatiga Sudirman", "-7.340567", "110.508987", "Jl. Jend. Sudirman No 286, Mrican, Salatiga", "8"],
        ["WSS Pekalongan", "-6.935703", "109.653512", "Jl. Sapu Garut no. 130, Buaran, Pekalongan", "9"],
        ["WSS Ungaran", "-7.111628", "110.41214", "Jl. Gatot Subroto No 6 (Jl.Raya Ungaran-Semarang), Bandarjo, Ungaran barat", "10"],
        ["WSS Tegal", "-6.881856", "109.12638", "Jl. Kapten Soedibyo No 220 , Tegal Selatan, Tegal", "11"],
        ["WSS Pati", "-6.755579", "111.038311", "JL. Wahid Hasyim, No. 22, Batangan, Pati Kidul, Kec. Pati", "12"],
        ["WSS Sampangan", "-7.015081", "110.389743", "Jl. Menoreh Raya No 69, Sampangan Semarang", "13"],
        ["WSS Tembalang 2", "-7.056785", "110.429054", "Jl. Tirto Agung No.32, Pedalangan, Banyumanik, Kota Semarang", "14"],
        ["WSS Kudus", "-6.779308", "110.834531", "Jl. Lingkar Utara no. 3, Peganjaran, Bae, Kudus", "15"],
        ["WSS Jatinangor", "-6.945964", "107.772524", "Jl. Kol. Ahmad Sam No.48 Desa Sayang, Jatinangor, Sumedang", "16"],
        ["WSS Cirebon Ampera", "-6.717714", "108.557268", "Jl. Ampera Raya No.11A, Pekiringan, Kesambi, Kota Cirebon", "17"],
        ["WSS Cirebon Tuparev", "-6.710732", "108.539203", "Jl. Tuparev (Samping Sentral Yamaha), Kesambi, Cirebon", "18"],
        ["WSS Purwokerto GOR Satria", "-7.41798", "109.248597", "Jl. Prof. DR. Soeharso, (Depan Pintu Barat GOR Satria), Purwokerto", "19"],
        ["WSS Purwokerto Wiryaatmaja", "-7.419496", "109.226842", "Jl. RA. Wiryaatmaja (Jl. Bank) Kel Kedungwuluh, Purwokerto Barat", "20"],
        ["WSS Cilacap", "-7.717944", "109.00571", "Jl MT Haryono No.31 (Sebelah  DISHUB), Cilacap Selatan", "21"],
        ["WSS Magelang", "-7.479969", "110.217219", "Jalan Tentara Pelajar No. 20, Kemirirejo, Magelang", "22"],
        ["WSS Prambanan", "-7.754966", "110.502543", "Jalan Raya Jogja - Solo, Sri Mulyo, Kebondalem Kidul, Prambanan", "23"],
        ["WSS Palagan", "-7.739613", "110.37593", "Jl. Palagan Tentara Pelajar km.7 no. 20A, Yogyakarta.", "24"],
        ["WSS Perjuangan", "-7.770956", "110.3765", "Jl. Kaliurang Km 3, Barat Grha Sabha Pramana UGM, Yogyakarta", "25"],
        ["WSS Condong Catur Barat", "-7.758273", "110.3965", "Jl. Ringroad Utara, Condong Catur, Depok, Yogyakarta", "26"],
        ["WSS Condong Catur Timur", "-7.757942", "110.398735", "JI. Ringroad Utara (200 m barat POLDA Yogyakarta), Condong Catur, Depok, Yogyakarta", "27"],
        ["WSS Besi", "-7.706722", "110.411332", "Jl. Kaliurang Km. 12 No. 42 Sardonoharjo, Ngaglik, Sleman, Yogyakarta", "28"],
        ["WSS Pandega Martha", "-7.755874", "110.376575", "Jl. Pandega Marta, Mlati, Sleman, Yogyakarta", "29"],
        ["WSS Samirono", "-7.77714", "110.383825", "JI. Samirono Baru (depan GOR UNY), Gondokusuman, Yogyakarta", "30"],
        ["WSS Teknik Kimia UGM", "-7.763961", "110.381705", "Jl. Grafika No. 2 , Kampus UGM, Sinduadi, Mlati, Senolowo, Sinduadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281", "31"],
        ["WSS Gedongkuning", "-7.80022", "110.402209", "Jalan Raya Janti (seberang BKPM), Banguntapan, Yogyakarta", "32"],
        ["WSS Plengkung Gading", "-7.814622", "110.363793", "Jl. Mayjen Sutoyo No 56, Mantrijeron, Depan Bank BNI, Yogyakarta", "33"],
        ["WSS Veteran", "-7.812082", "110.392469", "JI. Veteran No 122, Warungboto, Yogyakarta", "34"],
        ["WSS Monjali", "-7.766679", "110.36905", "Jl. Monjali, Karangjati, Mlati, Sleman, Yogyakarta", "35"],
        ["WSS Perumnas", "-7.774246", "110.404108", "Ruko Raflesia, Jl. Perumnas Mundusaren Yogyakarta", "36"],
        ["WSS Babarsari", "-7.774047", "110.413154", "JI. Babarsari ( Samping SMA Babarsari), Depok, Sleman, Yogyakarta", "37"],
        ["WSS Wonosari", "-7.973726", "110.601745", "Jl. Baron Km 1, Siraman, Wonosari, Yogyakarta", "38"],
        ["WSS Bantul", "-7.848427", "110.343547", "Jl. Raya Bantul Km. 6, Sewon, Bantul, Yogyakarta", "39"],
        ["WSS Kyai Mojo", "-7.78188", "110.354854", "Jl. Kyai Mojo no. A68 Pingit, Yogyakarta", "40"],
        ["WSS Megatruh", "-7.762519", "110.380723", "Jl. Kaliurang Km. 5 Gang. Megatruh No. 5 Sleman Yogyakarta", "41"],
        ["WSS De&#039;Halal Mart", "-7.730488", "110.394488", "Jl. Kaliurang Km. 9 (Kompleks De&#039;Halal Mart), Sardonoharjo, Sleman, Yogyakarta", "42"],
        ["WSS Kisamaun", "-6.18239", "106.630964", "Jl. Kisamaun No 233, Sukasari, Tangerang.", "43"],
        ["WSS Kisamaun #2", "-6.185544", "106.632576", "Jl. Kisamaun No 233 Pasar Lama, Tangerang (Depan PDAM)", "44"],
        ["WSS BSD", "-6.299787", "106.681677", "Bumi Serpong Damai Blok V2/23 sektor 1.2 Tangerang", "45"],
        ["WSS Lippo Asiatic", "-6.231999", "106.587852", "Ruko Asiatic JI. Permata Sari B15 No 50, Karawaci, Tangerang", "46"],
        ["WSS Bintaro 1", "-6.273059", "106.746134", "JI. Bintaro Utama III Blok AP No 57 Bintaro Sektor 3, Tangerang", "47"],
        ["WSS Citra Raya", "-6.252446", "106.520149", "Ruko Blossom Ville W1 No 20 Citra Raya, Tangerang", "48"],
        ["WSS L&#039;agricola", "-6.251875", "106.618633", "JI. L&#039;Agricola, Ruko L&#039;Agricola Blok A15, Kelapa Dua, Curug sangereng, Tangerang", "49"],
        ["WSS Gading Serpong", "-6.232279", "106.631181", "JI Raya Kelapa Puan AF1/19 Ruko Gading Serpong Summarecon, Tangerang", "50"],
        ["WSS Bogor Yasmin", "-6.561061", "106.765947", "Ruko Taman Yasmin, Jl. RKH Abdulah Bin Nuh No 202 Sektor 6, Bogor Barat, Bogor", "51"],
        ["WSS Greenville", "-6.169326", "106.772537", "Jln. Greenvile Blok BL No.3, Duri Kepa, Kebon Jeruk, Jakarta Barat", "52"],
        ["WSS Palemsemi", "-6.22032", "106.615219", "Jl. Parasel Ruko Madrid No 30. Palemsemi, Karawaci, Tangerang", "53"],
        ["WSS Bintaro 2", "-6.273132", "106.746049", "Jl. Bintaro Utama III Blok AP No.58 Bintaro Sektor 3, Tangerang.", "54"],
        ["WSS Tanjung Duren Utara", "-6.171875", "106.783192", "Jl. Tanjung Duren Utara No. 224 Grogol-Jakarta Barat", "55"],
        ["WSS Bekasi", "-6.229879", "106.984911", "Jl. Jend. Sudirman No. 16, Kayuringin Jaya, Bekasi Selatan Jawa Barat", "56"],
        ["WSS Tamansari", "-6.229211", "106.607652", "Pusat Kuliner Tamansari, Jl. Boulevard Palem Raya, Lippo Karawaci, Tangerang", "57"],
        ["WSS Boyolali", "-7.541272", "110.592614", "JI. Perintis Kemerdekaan No 889, Boyolali", "58"],
        ["WSS Sragen", "-7.422994", "111.019472", "Jl. Brigjen Slamet Riyadi no. 105, Pengko, Sragen Tengah, Sragen", "59"],
        ["WSS Karanganyar", "-7.610353", "110.94746", "Jl. Brigjen Slamet Riyadi, Badran Mulyo, Karanganyar. (sebelah utara SPBU Lalung)", "60"],
        ["WSS Patimura", "-7.587171", "110.81642", "Jl. Patimura no.91 Dawung Tengah, Serengan, Solo.", "61"],
        ["WSS Manahan Barat", "-7.559555", "110.806836", "JI. Hasanudin No 53, Laweyan, Solo", "62"],
        ["WSS Gonilan", "-7.547964", "110.771644", "Jl. Melon Raya, Karangasem, Solo. (belakang taman Edupark UMS)", "63"],
        ["WSS Solo Baru", "-7.610683", "110.814919", "Jl. Raya Solo Baru, Bacem No.8R Langenharjo, Grogol, Sukoharjo (Sebelum Pertigaan Jembatan Bacem)", "64"],
        ["WSS Jurug", "-7.559653", "110.848756", "Jl.Ir. Sutami No.13A, Kentingan, Surakarta (sebelah selatan SPBU Sekarpace)", "65"],
        ["WSS Kerten", "-7.559242", "110.790694", "Jl. Blimbing no. 5 (Belakang RS Panti Waluyo), Kerten", "66"],
        ["WSS Klaten", "-7.693745", "110.600528", "Jl. Mayor Kusmanto, Dukuh Sekar Mulyo, RT 02 RW 07 Desa Sekarsuli , Klaten.", "67"],
        ["WSS Wonogiri", "-7.805434", "110.921134", "Jl. Ahmad Yani No 98, Kp Kerdu Kepik, Kel. Giripurwo,(dpn tk kerudung rabbani)", "68"],
        ["WSS Manahan Timur", "-7.55968", "110.806911", "JI. Hasanudin No 53, Laweyan, Solo", "69"],
        ["WSS Boyolali Heritage", "-7.532073", "110.594299", "Jl. Merbabu No 31, Wisma Heritage, Boyolali", "70"],
        ["WSS Banyudono", "-7.53612", "110.6886", "Jl. Raya Boyolali - Solo Km.10 Kuwiran, Banyudono, Boyolali", "71"],
        ["WSS Kediri", "-7.816851", "112.02227", "Jl. PK Bangsa No. 26, Kediri", "72"],
        ["WSS Malang Sengkaling", "-7.917099", "112.588427", "Jl. Sengkaling No. 150, Malang", "73"],
        ["WSS Malang Ciliwung", "-7.954035", "112.64369", "Jl. Ciliwung No. 53, Malang", "74"],
        ["WSS Jember", "-8.156416", "113.716063", "Jl. Danau Toba No. 15, Tegal Gede, Sumber, Jember", "75"],
        ["WSS Madiun", "-7.638824", "111.517547", "Jl. H. Agus Salim No. 180, Manguharjo, Madiun", "76"],
        ["WSS Surabaya #1 Arjuna Raya", "-7.260449", "112.725659", "Jl. Arjuna Raya Gg. Merapi No. 12-14, Sawahan", "77"],
        ["WSS Malang LA Sucipto", "-7.942384", "112.645937", "Jl. Laksda Adi Sucipto No.75, Jawa Timur 65125", "78"],
        ["WSS Surabaya #3 Rungkut", "-7.332458", "112.773843", "Jalan Rungkut Madya no. 25, Rungkut Kidul, Surabaya", "79"],
        ["WSS Bali Batubulan", "-8.610565", "115.252937", "Jl. Raya Batubulan - Gianyar (utara Lapangan Candra Muka), Batubulan, Gianyar", "80"],
        ["WSS Bali Tukad Barito", "-8.684438", "115.230627", "Jl. Tukad Barito No. 30-31 Renon, Denpasar", "81"],
        ["WSS Bali Uluwatu", "-8.819866", "115.153181", "Jl. Pura Masuka no. 1, Ungasan, Uluwatu, Badung Selatan, Bali", "82"],
        ["WSS Depok", "-6.378387", "106.829553", "Jl. Margonda Raya No.280, Kemiri Muka, Beji, Kota Depok", "83"],
        ["WSS Temanggung", "-7.314029", "110.164633", "Jln Gatot Subroto no.30 Manding,temanggung,temanggung", "84"],
        ["WSS Kupatan", "-7.440041", "110.22698", "Jl. Ahmad Yani 340 Magelang (Depan RSJ Dr. Soerojo)", "85"],
        ["WSS Muntilan", "-7.581979", "110.286116", "Jl. Bima,Sayangan, Muntilan, Kauman, Muntilan, Magelang", "86"],
        ["WSS TTDI Kuala Lumpur", "3.139044", "101.628159", "Jl. Wan Kadir 2, Taman Tun Dr. Ismail, Ruko No  43 Kuala Lumpur", "87"],
        ["WSS Kopral Sayom", "-7.696289", "110.612392", "Jln Kopral Sayom No 23, Jetak kidul ,Karanganom,Klaten utara, Jawa tengah", "88"],
        ["WSS Bawean", "-6.9098", "107.618016", "Jl. Bawean No.1, Merdeka, Sumur Bandung, Kota Bandung, Jawa Barat.", "89"],
        ["WSS Sewon", "-7.873826", "110.351774", "Jl. Parangtritis Km. 9 Sewon, Bantul, Yogyakarta", "90"],
        ["WSS Klodran", "", "", "Jl. Adi Sumarmo No.337, Plalangan, Klodran, Colomadu, Kabupaten Karanganyar, Jawa Tengah 57172", "91"],
        ["WSS Ambarketawang", "-7.802796", "110.310781", "Jln. Wates Km 6, Ambarketawang, Gamping, Sleman, Yogyakarta", "92"],
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
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                console.log('position', position );
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                currentlocation = pos;
                var google_map_pos = new google.maps.LatLng( pos.lat, pos.lng );
                var google_maps_geocoder = new google.maps.Geocoder();
                google_maps_geocoder.geocode(
                    { 'latLng': google_map_pos },
                    function( results, status ) {
                        if ( status == google.maps.GeocoderStatus.OK && results[0] ) {
                            // currentlocation = results[0].formatted_address;
                            console.log( 'addres', results[0].formatted_address );
                        }
                    }
                );
                marker = new google.maps.Marker({
                    icon: image,
                    position: new google.maps.LatLng(pos.lat, pos.lng),
                    map: map
                });
                console.log('ini pos', pos);
                map.setCenter(pos);
            },
            () => {
                handleLocationError(true, infoWindow, map.getCenter());
            }
        );
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }

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
</script>
@endsection