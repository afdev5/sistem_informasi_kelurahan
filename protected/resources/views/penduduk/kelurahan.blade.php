@extends('layouts.app')
    @section('content')
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Penduduk
        <small> Data Penduduk Kelurahan {{ $kel['kelurahan'] }}</small>
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
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Hover Data Table</h3> -->
              <a href="{{ route('penduduk.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Penduduk</a>
              <div class="btn-group">
                  <!-- <button type="button" class="btn btn-info">Export/Import</button> -->
                  <a href="#" class="btn btn-info"><i class="fa fa-file-excel-o"></i> Export/Import</a>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Export ke Excel</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#modal-export-admin">Import dari Excel</a></li>
                  </ul>
                </div>
                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-export-kelurahan"> Pilih Kelurahan</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th style="width: 25px">No</th>
                  <th>Kelurahan</th>
                  <th>Kecamatan</th>
                  <th>Nik</th>
                  <th>Nama</th>
                  <th>Agama</th>
                  <th>Jenis Kelamin</th>
                  <th style="width: 205px">#</th>
                </tr>
                </thead>
                <tbody></tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
    <!-- /.content -->
    
    <div class="modal fade" id="modal-export-admin">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Import Data Kependudukan</h4>
              </div>
              <form action="{{ route('penduduk.import') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
                  <p class="text-red">Data yang di Import Harus Sesuai Format yang dilampirkan !!</p>
                  <a href="{{ route('penduduk.format') }}" class="btn btn-success btn-sm">Download Format Excel</a><br><br>
                  <!-- {{ csrf_field() }} -->
                  <div class="form-group">
                    <label for="file">Import File Excel</label>
                    <input type="file" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" id="file" name="file">
                    @if ($errors->has('file'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('file') }}</strong>
                          </span>
                      @endif
                  </div>
                  <div class="form-group">
                  <label for="kelurahan_id">Kelurahan</label>
                  <select class="form-control{{ $errors->has('kelurahan_id') ? ' is-invalid' : '' }}" id="kelurahan_id" name="kelurahan_id">
                    <option>Pilih Kelurahan</option>
                    @foreach($data as $spd)
                        <option value="{{ $spd->id }}"> {{ $spd->kelurahan }}</option>
                    @endforeach
                    @if ($errors->has('kelurahan_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('kelurahan_id') }}</strong>
                        </span>
                    @endif
                 </select>
                </div>
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-trash-o"></i> Import</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
    <div class="modal fade" id="modal-export-kelurahan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Kelurahan</h4>
              </div>
              <form action="{{ route('penduduk.k') }}" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                  {{ csrf_field() }}
                  <div class="form-group">
                  <label for="kelurahan_id">Kelurahan</label>
                  <select class="form-control{{ $errors->has('kelurahan_id') ? ' is-invalid' : '' }}" id="kelurahan_id" name="kelurahan_id">
                    <option>Pilih Kelurahan</option>
                    @foreach($data as $spd)
                        <option value="{{ $spd->id }}"> {{ $spd->kelurahan }}</option>
                    @endforeach
                    @if ($errors->has('kelurahan_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('kelurahan_id') }}</strong>
                        </span>
                    @endif
                 </select>
                </div>
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-trash-o"></i> Oke</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
    @endsection
    @section('js')
    <script>
                $(document).ready(function() {
                    $('#table').DataTable({
                        processing: true,
                        serverSide: true,
                        timeout: 500,
                        ajax: "{{ route('datatable.pendudukk', $id) }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {data: 'kelurahan', name: 'kelurahan'},
                            {data: 'kecamatan', name: 'kecamatan'},
                            {data: 'nik', name: 'nik'},
                            {data: 'nama', name: 'nama'},
                            {data: 'agama', name: 'agama'},
                            {data: 'jk', name: 'jk'},
                            {data: 'action', name: 'action', orderable: false, searchable: false}
                        ]
                    });
                });
        </script>
    @endsection