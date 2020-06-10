@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Kelurahan
        <small>Tambah Kelurahan</small>
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
              <h3 class="box-title">Data Kelurahan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('kelurahan.update', $data->id) }}">
                @csrf
            <input type="hidden" name="_method" value="PATCH">
              <div class="box-body">
                <div class="form-group">
                  <label for="kecamatan">Kecamatan</label>
                  <select class="form-control{{ $errors->has('kecamatan_id') ? ' is-invalid' : '' }}" id="kecamatan" name="kecamatan_id">
                    <option>Pilih Kecamatan</option>
                    @foreach($a as $spd)
                        <option value="{{ $spd->id }}"> {{ $spd->kecamatan }}</option>
                    @endforeach
                    @if ($errors->has('kecamatan_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('kecamatan_id') }}</strong>
                        </span>
                    @endif
                 </select>
                </div>
                <div class="form-group">
                  <label for="kelurahan">Kelurahan</label>
                  <input type="text" class="form-control{{ $errors->has('kelurahan') ? ' is-invalid' : '' }}" id="kelurahan" name="kelurahan" value="{{ $data->kelurahan }}">
                  @if ($errors->has('kelurahan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('kelurahan') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="kode_pos">Kode Pos</label>
                  <input type="text" class="form-control{{ $errors->has('kode_pos') ? ' is-invalid' : '' }}" id="kode_pos" name="kode_pos" value="{{ $data->kode_pos }}">
                  @if ($errors->has('kode_pos'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('kode_pos') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="alamat_kantor">Alamat Kantor</label>
                  <input type="text" class="form-control{{ $errors->has('alamat_kantor') ? ' is-invalid' : '' }}" id="alamat_kantor" name="alamat_kantor" value="{{ $data->alamat_kantor }}">
                  @if ($errors->has('alamat_kantor'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('alamat_kantor') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ $data->email }}">
                  @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="website">Website</label>
                  <input type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" id="website" name="website" value="{{ $data->website }}">
                  @if ($errors->has('website'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('website') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="no_telp">No Telp</label>
                  <input type="text" class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" id="no_telp" name="no_telp" value="{{ $data->no_telp }}">
                  @if ($errors->has('no_telp'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('no_telp') }}</strong>
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
