@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Kelurahan
        <small>Edit Kegiatan Kelurahan</small>
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
              <h3 class="box-title">Kegiatan Kelurahan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('kegiatan_kelurahan.update', $data->id) }}" enctype="multipart/form-data">
                @csrf
            <input type="hidden" name="_method" value="PATCH">
              <div class="box-body">
                <div class="form-group">
                  <label for="judul">Kegiatan</label>
                  <input type="text" class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}" id="judul" name="judul" value="{{ $data->judul }}">
                  @if ($errors->has('judul'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('judul') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="desc">Deskripsi</label>
                  <textarea id="desc" name="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}">{{ $data->desc }}</textarea>
                    @if ($errors->has('desc'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('desc') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="tgl">Tanggal Kegiatan</label>
                  <input type="date" class="form-control{{ $errors->has('tgl') ? ' is-invalid' : '' }}" id="tgl" name="tgl" value="{{ $data->tgl }}">
                  @if ($errors->has('tgl'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tgl') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="gambar">Gambar</label>
                  <input type="file" class="form-control{{ $errors->has('gambar') ? ' is-invalid' : '' }}" id="gambar" name="gambar">
                  @if ($errors->has('gambar'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gambar') }}</strong>
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
