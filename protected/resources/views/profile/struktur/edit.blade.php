@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Kelurahan
        <small>Edit Struktur Kelurahan</small>
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
              <h3 class="box-title">Struktur Kelurahan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('struktur_kelurahan.update', $data->id) }}" enctype="multipart/form-data">
                @csrf
            <input type="hidden" name="_method" value="PATCH">
              <div class="box-body">
                <div class="form-group">
                  <label for="nama_pegawai">Nama Pegawai</label>
                  <input type="text" class="form-control{{ $errors->has('nama_pegawai') ? ' is-invalid' : '' }}" id="nama_pegawai" name="nama_pegawai" value="{{ $data->nama_pegawai }}">
                  @if ($errors->has('nama_pegawai'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nama_pegawai') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="nip_pegawai">Nip Pegawai</label>
                  <input type="text" class="form-control{{ $errors->has('nip_pegawai') ? ' is-invalid' : '' }}" id="nip_pegawai" name="nip_pegawai" value="{{ $data->nip_pegawai }}">
                  @if ($errors->has('nip_pegawai'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nip_pegawai') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="jenis_kelamin">Jenis Kelamin</label>
                  <select class="form-control{{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="1">Laki-Laki</option>
                    <option value="2">Perempuan</option>
                    @if ($errors->has('jenis_kelamin'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                        </span>
                    @endif
                 </select>
                </div>
                <div class="form-group">
                  <label for="agama">Agama</label>
                  <input type="text" class="form-control{{ $errors->has('agama') ? ' is-invalid' : '' }}" id="agama" name="agama" value="{{ $data->agama }}">
                  @if ($errors->has('agama'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('agama') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="level_jabatan">Jabatan</label>
                  <select class="form-control{{ $errors->has('level_jabatan') ? ' is-invalid' : '' }}" id="level_jabatan" name="level_jabatan">
                    <option value="0">Lurah</option>
                    <option value="1">Sekretaris</option>
                    <option value="2">Kesie. Pemerintahan & Trantib</option>
                    <option value="3">Kesie. Pembangunan</option>
                    <option value="4">Kesie. Keuangan</option>
                    <option value="5">Kesie. Kesra</option>
                    @if ($errors->has('level_jabatan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('level_jabatan') }}</strong>
                        </span>
                    @endif
                 </select>
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
