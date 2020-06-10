@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Kelurahan
        <small>Kegiatan Kelurahan {{ Auth::user()->kelurahan['kelurahan'] }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kegiatan Kelurahan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Hover Data Table</h3> -->
              <a href="{{ route('kegiatan_kelurahan.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Kegiatan</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th style="width: 25px">No</th>
                  <th>Kegiatan</th>
                  <th>Deskripsi</th>
                  <th>Tanggal</th>
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
                    ajax: "{{ route('datatable.kegiatan') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'judul', name: 'judul'},
                        {data: 'desc', name: 'desc'},
                        {data: 'tgl', name: 'tgl'},
                        {data: 'foto', name: 'foto'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                });
            });
    </script>
@endsection
