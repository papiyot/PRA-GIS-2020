@extends('layouts.admin')
@section('title')PT @endsection
@section('content')
<div class="col-md-12">
    <!-- Material (floating) Register -->
    @if($data->action=='Edit')
    <div class="block block-themed  @if(session()->has('status')) 'block-mode-hidden' @else {{$data->class}} @endif">
        <div class="block-header bg-gd-primary">
            <h3 class="block-title" style="font-size: 2rem;">{{$data->action}} PT</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                    <i class="si si-refresh"></i>
                </button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
            </div>
        </div>
        <div class="block-content">
            <form action="{{ route('master.store',['pt', 'PT-']) }}" method="post"> @csrf
                <div class="form-group row">
                    <div class="col-12 col-sm-6 col-md-4 ">
                        <div class="form-material floating">
                            <input type="hidden" class="form-control" id="pt_id" name="pt_id" value="@php echo ($data->edit) ? $data->edit->pt_id: ''; @endphp">
                            @if($data->edit)
                            <input type="hidden" class="form-control" id="pt_nama_old" name="pt_nama_old" required value="@php echo ($data->edit) ? $data->edit->pt_nama: null; @endphp">
                            @endif
                            <input type="text" class="form-control" id="pt_nama" name="pt_nama" required value="@php echo ($data->edit) ? $data->edit->pt_nama:  old('pt_nama'); @endphp">
                            @if(session()->has('status')) <p class="text-danger">{{ session()->get('status') }}</p> @endif
                            <label for="pt_nama">Nama PT</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 ">
                        <div class="form-material floating">
                            <input type="text" class="form-control" id="pt_notelp" name="pt_notelp" required value="@php echo ($data->edit) ? $data->edit->pt_notelp: old('pt_notelp'); @endphp">
                            <label for="pt_notelp">Telp PT</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 ">
                        <div class="form-material floating">
                            <textarea type="text" class="form-control" id="pt_alamat" name="pt_alamat" required>@php echo ($data->edit) ? $data->edit->pt_alamat: old('pt_alamat'); @endphp</textarea>
                            <label for="pt_alamat">Alamat PT</label>
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
    @endif
    <!-- END Material (floating) Register -->

    <div class="block block-themed">
        <div class="block-header bg-gd-primary">
            <h3 class="block-title" style="font-size: 2rem;">Daftar PT</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">#</th>
                            <th>NAMA</th>
                            <th>Kontak</th>
                            <th>Alamat</th>
                            <th class="text-center" style="width: 15%;">Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach($data->list as $list)
                        <tr>
                            <td class="text-center">{{$no}}</td>
                            <td class="font-w600 text-uppercase text-primary">{{$list->pt_nama}}</td>
                            <td>{{$list->pt_notelp}}</td>
                            <td class="font-w300 font-size-sm text-uppercase text-secondary">{{$list->pt_alamat}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('master',['pt', $list->pt_id]) }}" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    @if($data->count>1)
                                    <a class="btn btn-sm btn-danger" data-toggle="confirmation" data-popout="true" data-title="Hapus Data ini?" href="{{ route('delete',['pt', $list->pt_id]) }}"><i class="fa fa-times"></i></a>
                                    @endif
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