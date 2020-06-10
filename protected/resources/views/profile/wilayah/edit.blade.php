@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Kelurahan
        <small>Edit Batas Wilayah Kelurahan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelurahan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Batas Wilayah Kelurahan</h3>
            </div>
            <!-- /.box-header --> 
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('wilayah.update', $data->id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
              <div class="box-body">
                <div class="form-group">
                  <label for="bagian">Bagian</label>
                  <select class="form-control{{ $errors->has('bagian') ? ' is-invalid' : '' }}" id="bagian" name="bagian">
                    @if($data->bagian == 1)
                    <option value="1" selected>Utara</option>
                    @endif
                    @if($data->bagian == 2)
                    <option value="2">Timur</option>
                    @endif
                    @if($data->bagian == 3)
                    <option value="3">Selatan</option>
                    @endif
                    @if($data->bagian == 4)
                    <option value="4">Barat</option>
                    @endif
                    @if ($errors->has('bagian'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('bagian') }}</strong>
                        </span>
                    @endif
                 </select>
                </div>
                <div class="form-group">
                  <label for="batas">Batas</label>
                  <input type="text" class="form-control{{ $errors->has('batas') ? ' is-invalid' : '' }}" id="batas" name="batas" value="{{ $data->batas }}">
                  @if ($errors->has('batas'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('batas') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
    </div>

    </section>
    <!-- /.content -->
@endsection
