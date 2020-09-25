@extends('layouts.admin')
@section('title')Images @endsection
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
            <h3 class="block-title" style="font-size: 2rem;">{{$data->action}} Images</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                    <i class="si si-refresh"></i>
                </button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
            </div>
        </div>
        <div class="block-content">
            <form action="{{ route('images.store') }}" method="post" enctype="multipart/form-data"> @csrf
                <div class="form-group row">
                    <div class="col-12 col-sm-6 col-md-6 ">
                        <div class="form-material">
                            <input type="hidden" class="form-control" id="images_id" name="images_id" value="@php echo ($data->edit) ? $data->edit->images_id: ''; @endphp">
                            <input type="hidden" class="form-control" id="images_upload_name" name="images_upload_name" value="@php echo ($data->edit) ? $data->edit->images_name: ''; @endphp" >
                            <select type="text" required class="form-control" id="images_locations_id" name="images_locations_id">
                                <option value="">Pilih Lokasi</option>
                                @foreach($data->select as $select)
                                <option value="{{$select->locations_id}}" @php echo ($data->edit) ? ($data->edit->images_locations_id==$select->locations_id) ? 'selected': '' : null; @endphp>{{$select->locations_name}}</option>
                                @endforeach
                            </select>
                            <label for="images_locations_id">Locations</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 ">
                        <div class="form-material">
                            <input type="file" class="form-control" id="image_upload" name="image_upload" >
                            <label for="image_upload">Image</label>
                        </div>
                    </div>
                    @if($data->action=='Edit')
                        <div class="col-12">
                            <span><br></span>
                            <span class="text-right font-w600 text-danger" >* Jangan menambah image jika tidak ingin merubah Foto/gambar.</span>
                        </div>
                    @endif

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
            <h3 class="block-title" style="font-size: 2rem;">Daftar Images</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">#</th>
                            <th>Name</th>
                            <th>Location</th>
                            <!-- <th>Images</th> -->
                            <th class="text-center" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach($data->list as $list)
                        <tr>
                            <td class="text-center">{{$no}}</td>
                            <td class="font-w600 text-uppercase text-primary">{{$list->images_name}}</td>
                            <td class="font-w300 font-size-sm text-uppercase text-secondary">{{$list->locations_name}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('images.view',[ $list->images_id]) }}" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger" data-toggle="confirmation" data-popout="true" data-title="Hapus Data ini?" href="{{ route('images.delete',[ $list->images_id]) }}"><i class="fa fa-times"></i></a>
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
