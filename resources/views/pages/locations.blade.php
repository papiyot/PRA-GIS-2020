@extends('layouts.admin')
@section('title')Locations @endsection
@section('content')
<div class="col-md-12">
    <!-- Material (floating) Register -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            <center>
                <h3 class="text-success"><i class="fa fa-check-circle"></i> Success</h3> 
                {{ $message }}
            </center>
        </div>
    @endif
    @if ($message = Session::get('warning'))
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            <center>
                <h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3> 
                {{ $message }}
            </center>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            <center>
                <h3 class="text-danger"><i class="fa fa-exclamation-circle"></i> Danger</h3> 
                {{ $message }}
            </center>
        </div>
    @endif
    <div class="block block-themed  @if(session()->has('status')) 'block-mode-hidden' @else {{$data->class}} @endif">
        <div class="block-header bg-gd-primary">
            <h3 class="block-title" style="font-size: 2rem;">{{$data->action}} Locations</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                    <i class="si si-refresh"></i>
                </button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
            </div>
        </div>
        <div class="block-content">
            <form action="{{ route('locations.store') }}" method="post"> @csrf
                <div class="form-group row">
                    <div class="col-12 col-sm-6 col-md-3 ">
                        <div class="form-material floating">
                            <input type="hidden" class="form-control" id="locations_id" name="locations_id" value="@php echo ($data->edit) ? $data->edit->locations_id: ''; @endphp">
                            <input type="text" class="form-control" id="locations_name" name="locations_name" required value="@php echo ($data->edit) ? $data->edit->locations_name:  old('locations_name'); @endphp">
                            <label for="locations_name">Locations Name</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 ">
                        <div class="form-material floating">
                            <input type="text" class="form-control" id="locations_phone" name="locations_phone" required value="@php echo ($data->edit) ? $data->edit->locations_phone: old('locations_phone'); @endphp">
                            <label for="locations_phone">Phone </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 ">
                        <div class="form-material floating">
                            <input type="text" class="form-control" id="locations_email" name="locations_email" required value="@php echo ($data->edit) ? $data->edit->locations_email: old('locations_email'); @endphp">
                            <label for="locations_email">Email </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 ">
                        <div class="form-material floating">
                            <textarea type="text" class="form-control" id="locations_address" name="locations_address" required>@php echo ($data->edit) ? $data->edit->locations_address: old('locations_address'); @endphp</textarea>
                            <label for="locations_address">Address</label>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <!-- <style type="text/css">
                            #map{ width:100%; height: 200px; }
                        </style> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Select a location! </label>
                                <div id="map" style="width:100%; height: 200px; "></div>
                                <p>Click on a location on the map to select it. Drag the marker to change location.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-material ">
                                <input type="text" class="form-control" id="locations_latitude" name="locations_latitude" required value="@php echo ($data->edit) ? $data->edit->locations_latitude: old('locations_latitude'); @endphp" readonly>
                                <label for="locations_latitude">Latitude </label>
                            </div>
                            <div class="form-material ">
                                <input type="text" class="form-control" id="locations_longitude" name="locations_longitude" required value="@php echo ($data->edit) ? $data->edit->locations_longitude: old('locations_longitude'); @endphp" readonly>
                                <label for="locations_longitude">Longitude </label>
                            </div>
                            
                        </div>
                        <!--/span-->
                    </div>
                </div>
                <div class="form-group row"></div>
                <div class="dropdown-divider"></div>
                <div class="form-group row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-alt-primary">
                            <i class="fa fa-plus mr-5"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-alt-secondary">
                            <i class="fa fa-minus mr-5"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- END Material (floating) Register -->

    <div class="block block-themed">
        <div class="block-header bg-gd-primary">
            <h3 class="block-title" style="font-size: 2rem;">Daftar Locations</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th class="text-center" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach($data->list as $list)
                        <tr>
                            <td class="text-center">{{$no}}</td>
                            <td class="font-w600 text-uppercase text-primary">{{$list->locations_name}}</td>
                            <td class="font-w300 font-size-sm text-uppercase text-secondary">{{$list->locations_address}}</td>
                            <td>{{$list->locations_phone}}</td>
                            <td class="font-w300 font-size-sm text-uppercase text-secondary">{{$list->locations_email}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('locations.view',[ $list->locations_id]) }}" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger" data-toggle="confirmation" data-popout="true" data-title="Hapus Data ini?" href="{{ route('locations.delete',[ $list->locations_id]) }}"><i class="fa fa-times"></i></a>
                                </div>
                            </td>
                        </tr>
                        @php $no++; @endphp @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF9mRyaqTj12UxNUJmHFfZWbrCp_APwrM"></script>
<script>
    var map; //Will contain map object.
    var marker = false; ////Has the user plotted their location marker? 
            
    //Function called to initialize / create the map.
    //This is called when the page has loaded.
    function initMap() {

        //The center location of our map.
        var lat = @if($data->edit) {{$data->edit->locations_latitude}} @else -7.783142410244717 @endif ;
        var lng = @if($data->edit) {{$data->edit->locations_longitude}} @else 110.37022014941408 @endif ;
        var centerOfMap = new google.maps.LatLng(lat, lng);

        //Map options.
        var options = {
        center: centerOfMap, //Set center.
        zoom: 7 //The zoom value.
        };

        //Create the map object.
        map = new google.maps.Map(document.getElementById('map'), options);
        @if($data->edit)
        marker = new google.maps.Marker({
            position: centerOfMap,
            map: map,
            draggable: true //make it draggable
        });
        @endif
        //Listen for any clicks on the map.
        google.maps.event.addListener(map, 'click', function(event) {                
            //Get the location that the user clicked.
            var clickedLocation = event.latLng;
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
    }
            
    //This function will get the marker's current location and then add the lat/long
    //values to our textfields so that we can save the location.
    function markerLocation(){
        //Get location.
        var currentLocation = marker.getPosition();
        //Add lat and lng values to a field that we can save.
        document.getElementById('locations_latitude').value = currentLocation.lat(); //latitude
        document.getElementById('locations_longitude').value = currentLocation.lng(); //longitude
    }
            
            
    //Load the map when the page has finished loading.
    google.maps.event.addDomListener(window, 'load', initMap);    
</script>
@endsection