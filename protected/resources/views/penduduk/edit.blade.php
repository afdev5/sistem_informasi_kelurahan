@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Penduduk
        <small>
        @if(Auth::user()->level == 1)
            Edit Data Penduduk
        @else
             Edit Data Penduduk Kelurahan {{ Auth::user()->kelurahan['kelurahan'] }}
        @endif
        </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Penduduk</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Penduduk</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('penduduk.update', $data->id) }}">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
              <div class="box-body">
                <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="text" class="form-control{{ $errors->has('nik') ? ' is-invalid' : '' }}" id="nik" name="nik" value="{{ $data->nik }}">
                  @if ($errors->has('nik'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nik') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" id="nama" name="nama" value="{{ $data->nama }}">
                  @if ($errors->has('nama'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="no_kk">No KK</label>
                  <input type="text" class="form-control{{ $errors->has('no_kk') ? ' is-invalid' : '' }}" id="no_kk" name="no_kk" value="{{ $data->no_kk }}">
                  @if ($errors->has('no_kk'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('no_kk') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="ttl">Tempat & Tanggal Lahir</label>
                  <input type="text" class="form-control{{ $errors->has('ttl') ? ' is-invalid' : '' }}" id="ttl" name="ttl" value="{{ $data->ttl}}">
                  @if ($errors->has('ttl'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ttl') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="agama">Agama</label>
                  <select class="form-control{{ $errors->has('agama') ? ' is-invalid' : '' }}" id="agama" name="agama">
                    <option value="1">Islam</option>
                    <option value="2">Kristen</option>
                    <option value="3">Katolik</option>
                    <option value="4">Hindu</option>
                    <option value="5">Budha</option>
                    @if ($errors->has('agama'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('agama') }}</strong>
                        </span>
                    @endif
                 </select>
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
                  <label for="nama_ayah">Nama Ayah</label>
                  <input type="text" class="form-control{{ $errors->has('nama_ayah') ? ' is-invalid' : '' }}" id="nama_ayah" name="nama_ayah" value="{{ $data->nama_ayah }}">
                  @if ($errors->has('nama_ayah'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nama_ayah') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="nama_ibu">Nama Ibu</label>
                  <input type="text" class="form-control{{ $errors->has('nama_ibu') ? ' is-invalid' : '' }}" id="nama_ibu" name="nama_ibu" value="{{ $data->nama_ibu }}">
                  @if ($errors->has('nama_ibu'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nama_ibu') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="alamat">Detail Alamat</label>
                  <input type="text" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" id="alamat" name="alamat" value="{{ $data->alamat }}">
                  @if ($errors->has('alamat'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('alamat') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="lingkungan">Lingkungan</label>
                  <input type="number" class="form-control{{ $errors->has('lingkungan') ? ' is-invalid' : '' }}" id="lingkungan" name="lingkungan" value="{{ $data->lingkungan }}">
                  @if ($errors->has('lingkungan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('lingkungan') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="rt">RT</label>
                  <input type="number" class="form-control{{ $errors->has('rt') ? ' is-invalid' : '' }}" id="rt" name="rt" value="{{ $data->rt }}">
                  @if ($errors->has('rt'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('rt') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="rw">RW</label>
                  <input type="number" class="form-control{{ $errors->has('rw') ? ' is-invalid' : '' }}" id="rw" name="rw" value="{{ $data->rw }}">
                  @if ($errors->has('rw'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('rw') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="pendidikan">Pendidikan</label>
                  <input type="text" class="form-control{{ $errors->has('pendidikan') ? ' is-invalid' : '' }}" id="pendidikan" name="pendidikan" value="{{ $data->pendidikan }}">
                  @if ($errors->has('pendidikan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('pendidikan') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="umur">Umur</label>
                  <input type="number" class="form-control{{ $errors->has('umur') ? ' is-invalid' : '' }}" id="umur" name="umur" value="{{ $data->umur }}">
                  @if ($errors->has('umur'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('umur') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="pekerjaan">Pekerjaan</label>
                  <input type="text" class="form-control{{ $errors->has('pekerjaan') ? ' is-invalid' : '' }}" id="pekerjaan" name="pekerjaan" value="{{ $data->pekerjaan }}">
                  @if ($errors->has('pekerjaan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('pekerjaan') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="status_kawin">Status Perkawinan</label>
                  <select class="form-control{{ $errors->has('status_kawin') ? ' is-invalid' : '' }}" id="status_kawin" name="status_kawin">
                    <option value="0">Belum Menikah</option>
                    <option value="1">Sudah Menikah</option>
                    <option value="2">Cerai Hidup</option>
                    <option value="3">Cerai Mati</option>
                    @if ($errors->has('status_kawin'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('status_kawin') }}</strong>
                        </span>
                    @endif
                 </select>
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" id="status" name="status">
                    <option value="1">Hidup</option>
                    <option value="0">Meninggal</option>
                    @if ($errors->has('status'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                 </select>
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
