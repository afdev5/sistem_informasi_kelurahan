@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Kelurahan
        <small>Struktur Kelurahan {{ Auth::user()->kelurahan['kelurahan'] }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Struktur Kelurahan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Hover Data Table</h3> -->
              <a href="{{ route('struktur_kelurahan.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Struktur</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th style="width: 25px">No</th>
                  <th>Jabatan</th>
                  <th>Nama</th>
                  <th>Nip</th>
                  <th>Jenis Kelamin</th>
                  <th>Agama</th>
                  <th>Gambar</th>
                  <th style="width: 150px">#</th>
                </tr>
                </thead>
                <tbody></tbody>
                </table>
            </div>
        </div>
        </div>
    </div>

    </section>
    <!-- /.content -->
@endsection

@section('js')
  <script>
            $(document).ready(function() {
                $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    timeout: 500,
                    ajax: "{{ route('datatable.struktur') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'jab', name: 'jab'},
                        {data: 'nama_pegawai', name: 'nama_pegawai'},
                        {data: 'nip_pegawai', name: 'nip_pegawai'},
                        {data: 'jk', name: 'jk'},
                        {data: 'agama', name: 'agama'},
                        {data: 'foto', name: 'foto'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                });
            });
    </script>
@endsection
