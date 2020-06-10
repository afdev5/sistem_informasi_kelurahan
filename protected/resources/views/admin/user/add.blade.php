@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Admin Kelurahan
        <small>Tambah Admin Kelurahan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin Kelurahan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Admin Kelurahan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('user.store') }}">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" id="nama" name="nama" value="{{ old('nama') }}">
                  @if ($errors->has('nama'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}">
                  @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password">
                  @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="kecamatan">Kecamatan</label>
                  <select class="form-control{{ $errors->has('kecamatan_id') ? ' is-invalid' : '' }}" id="kecamatan" name="kecamatan_id">
                    <option>Pilih Kecamatan</option>
                    @foreach($kec as $spd)
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
                  <select class="form-control{{ $errors->has('kelurahan_id') ? ' is-invalid' : '' }}" id="kelurahan" name="kelurahan_id">
                    @if ($errors->has('kelurahan_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('kelurahan_id') }}</strong>
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
@section('js')
<script>
  $(document).ready(function(){
    $('#kecamatan').on('change',function(){
    var id = $('#kecamatan').val();
      $.ajax({
        type:"GET",
        url: "{{ url('user') }}/"+id,
        success: function(res){
          $('#kelurahan').html(res);
        }
      });
    });
  });
</script>
@endsection
