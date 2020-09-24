@extends('layouts.admin')
@section('title')PT @endsection
@section('content')
<div class="col-md-12">
    <!-- Material (floating) Register -->
    
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
                            @if(session()->has('status')) <p class="text-danger">{{ session()->get('status') }}</p> @endif
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
                                    <a href="{{ route('locations.view',[ $list->pt_id]) }}" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger" data-toggle="confirmation" data-popout="true" data-title="Hapus Data ini?" href="{{ route('locations.delete',[ $list->pt_id]) }}"><i class="fa fa-times"></i></a>
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