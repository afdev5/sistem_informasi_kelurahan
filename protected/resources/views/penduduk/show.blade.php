@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Penduduk
        <small>
        @if(Auth::user()->level == 1)
            Detail Data Penduduk Kecamatan {{ $data->kelurahan->kecamatan['kecamatan'] }}, Kelurahan {{ $data->kelurahan['kelurahan'] }}
        @else
             Detail Data Penduduk Kelurahan {{ Auth::user()->kelurahan['kelurahan'] }}
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
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('assets/dist/img/logo.png') }}" alt="User profile picture">

              <h3 class="profile-username text-center"><b>{{ $data->nama }}</b></h3>
              @if($data->status == 0)
                <p class="text-red text-center"><b>Telah Meniggal</b></p>
              @endif
              <p class="text-muted text-center">Umur <b>{{ $data->umur }}</b></p>
              <p class="text-muted text-center">
                  @if($data->jenis_kelamin == 1)
                    Laki-laki
                  @else
                    Perempuan
                  @endif
                </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>No Kartu Keluarga</b> <a class="pull-right">{{ $data->no_kk }}</a>
                </li>
                <li class="list-group-item">
                  <b>NIK</b> <a class="pull-right">{{ $data->nik }}</a>
                </li>
                <li class="list-group-item">
                  <b>Tempat Lahir</b> <a class="pull-right">{{ $data->tl }}</a>
                </li>
                <li class="list-group-item">
                  <b>Tanggal Lahir</b> <a class="pull-right">{{ $data->tgl }}</a>
                </li>
                <li class="list-group-item">
                  <b>Agama</b> <a class="pull-right">
                  @if($data->agama == 1)
                    Islam
                  @elseif($data->agama == 2)
                    Kristen
                  @elseif($data->agama == 3)
                    Katolik
                  @elseif($data->agama == 4)
                    Budha
                  @elseif($data->agama == 5)
                    Hindu
                  @elseif($data->agama == 6)
                    Konghuchu
                  @endif
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Nama Ayah</b> <a class="pull-right">{{ $data->nama_ayah }}</a>
                </li>
                <li class="list-group-item">
                  <b>Nama Ibu</b> <a class="pull-right">{{ $data->nama_ibu }}</a>
                </li>
                <li class="list-group-item">
                  <b>Pekerjaan</b> <a class="pull-right">{{ $data->pekerjaan }}</a>
                </li>
                <li class="list-group-item">
                  <b>Pendidikan Terakhir</b> <a class="pull-right">
                    @if($data->pendidikan == 1)
                      Tidak/Belum Sekolah
                    @elseif($data->pendidikan == 2)
                      Belum Tamat SD/Sederajat
                    @elseif($data->pendidikan == 3)
                      Tamat SD/Sederajat
                    @elseif($data->pendidikan == 4)
                      SLTP/Sederajat
                    @elseif($data->pendidikan == 5)
                      SLTA/Sederajat
                    @elseif($data->pendidikan == 6)
                      Diploma I/II
                    @elseif($data->pendidikan == 7)
                      Akademi/Diploma III/S.Muda
                    @elseif($data->pendidikan == 8)
                      Diploma IV/Strata I
                    @elseif($data->pendidikan == 9)
                      Strata II
                    @elseif($data->pendidikan == 10)
                      Strata III
                    @endif
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Status Perkawinan</b> <a class="pull-right">
                      @if($data->status_kawin == 0)
                        Belum Menikah
                      @elseif($data->status_kawin == 1)
                        Sudah Menikah
                      @elseif($data->status_kawin == 2)
                        Cerai Hidup
                      @elseif($data->status_kawin == 3)
                        Cerai Mati
                      @endif
                    </a>
                </li>
                <li class="list-group-item">
                  <b>Alamat</b> <a class="pull-right">{{ $data->alamat }}</a>
                </li>
                <li class="list-group-item">
                  <b>Lingkungan</b> <a class="pull-right">{{ $data->lingkungan }}</a>
                </li>
                <li class="list-group-item">
                  <b>RT/RW</b> <a class="pull-right">{{ $data->rt }}/{{ $data->rw }}</a>
                </li>
              </ul>

              <a href="{{ route('penduduk.index') }}" class="btn btn-primary btn-block"><b>OK</b></a>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
    </div>

    </section>
    <!-- /.content -->
@endsection
