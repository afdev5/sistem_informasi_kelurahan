@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Kelurahan
        <small>Tambah Batas Wilayah Kelurahan</small>
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
            <form role="form" method="POST" action="{{ route('wilayah.store') }}" enctype="multipart/form-data">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="bagian">Bagian</label>
                  <select class="form-control{{ $errors->has('bagian') ? ' is-invalid' : '' }}" id="bagian" name="bagian">
                    <option value="1">Utara</option>
                    <option value="2">Timur</option>
                    <option value="3">Selatan</option>
                    <option value="4">Barat</option>
                    @if ($errors->has('bagian'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('bagian') }}</strong>
                        </span>
                    @endif
                 </select>
                </div>
                <div class="form-group">
                  <label for="batas">Batas</label>
                  <input type="text" class="form-control{{ $errors->has('batas') ? ' is-invalid' : '' }}" id="batas" name="batas" value="{{ old('batas') }}">
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
