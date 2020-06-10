@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Kelurahan
        <small>Informasi Kelurahan</small>
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
              <h3 class="box-title">Informasi Kelurahan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
        @if($data != null)
            <form role="form" method="POST" action="{{ route('info_kelurahan.update', $data->id) }}">
                @csrf
            <input type="hidden" name="_method" value="PATCH">
              <div class="box-body">
                <div class="form-group">
                  <label for="visi">Visi</label>
                  <textarea id="visi" name="visi" class="form-control{{ $errors->has('visi') ? ' is-invalid' : '' }}"> {{ $data->visi }}</textarea>
                    @if ($errors->has('visi'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('visi') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="misi">Misi</label>
                  <textarea id="misi" name="misi" class="form-control{{ $errors->has('misi') ? ' is-invalid' : '' }}"> {{ $data->misi }}</textarea>
                    @if ($errors->has('misi'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('misi') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="sejarah">Sejarah</label>
                  <textarea id="sejarah" name="sejarah" class="form-control{{ $errors->has('sejarah') ? ' is-invalid' : '' }}"> {{ $data->sejarah }}</textarea>
                    @if ($errors->has('sejarah'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sejarah') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="luas_wilayah">Luas Wilayah (Ha)</label>
                  <input type="text" class="form-control{{ $errors->has('luas_wilayah') ? ' is-invalid' : '' }}" id="luas_wilayah" name="luas_wilayah" value="{{ $data->luas_wilayah }}">
                  @if ($errors->has('luas_wilayah'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('luas_wilayah') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
        @else
            <form role="form" method="POST" action="{{ route('info_kelurahan.store') }}">
                @csrf
            <input type="hidden" name="kelurahan_id" value="{{ Auth::user()->kelurahan_id }}">
              <div class="box-body">
                <div class="form-group">
                  <label for="visi">Visi</label>
                  <textarea id="visi" name="visi" class="form-control{{ $errors->has('visi') ? ' is-invalid' : '' }}"></textarea>
                    @if ($errors->has('visi'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('visi') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="misi">Misi</label>
                  <textarea id="misi" name="misi" class="form-control{{ $errors->has('misi') ? ' is-invalid' : '' }}"></textarea>
                    @if ($errors->has('misi'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('misi') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="sejarah">Sejarah</label>
                  <textarea id="sejarah" name="sejarah" class="form-control{{ $errors->has('sejarah') ? ' is-invalid' : '' }}"></textarea>
                    @if ($errors->has('sejarah'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sejarah') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="luas_wilayah">Luas Wilayah (Ha)</label>
                  <input type="text" class="form-control{{ $errors->has('luas_wilayah') ? ' is-invalid' : '' }}" id="luas_wilayah" name="luas_wilayah" value="{{ old('luas_wilayah') }}">
                  @if ($errors->has('luas_wilayah'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('luas_wilayah') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            @endif
          </div>
        </div>
    </div>

    </section>
    <!-- /.content -->
@endsection

@section('js')
<script>
  $(function () {
    CKEDITOR.replace('visi')
    CKEDITOR.replace('misi')
    CKEDITOR.replace('sejarah')
  })
</script>
@endsection
