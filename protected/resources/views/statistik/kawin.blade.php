@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Statistik
        <small>Statistik Perkawinan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Statistik</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-6 pull-right">
            <!-- DONUT CHART -->
         <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Statistik Status Perkawinan (%)</h3>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-xs-6 pull-right">
            <!-- DONUT CHART -->
         <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Keterangan</h3>
            </div>
            <div class="box-body">
              <h4>Total Penduduk : <b>{{ $total }}</b></h4>
              <h5> Data Penduduk</h5>
              <h6> Belum Menikah : <b>{{ $dnol }}</b></h6>
              <h6> Menikah : <b>{{ $dsatu }}</b></h6>
              <h6> Cerai Hidup : <b>{{ $ddua }}</b></h6>
              <h6> Cerai Mati : <b>{{ $dtiga }}</b></h6>
              <a href="#" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#modal-export-kelurahan"> Pilih Kelurahan</a>
            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="modal fade" id="modal-export-kelurahan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Kelurahan</h4>
              </div>
              <form action="{{ route('statistik.kawinn') }}" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                  {{ csrf_field() }}
                  <div class="form-group">
                  <label for="kelurahan_id">Kelurahan</label>
                  <select class="form-control{{ $errors->has('kelurahan_id') ? ' is-invalid' : '' }}" id="kelurahan_id" name="kelurahan_id">
                    <option>Pilih Kelurahan</option>
                    @foreach($kel as $spd)
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
                <button type="submit" class="btn btn-info btn-sm"> Oke</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
    <!-- /.content -->
@endsection
@section('js')
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    var areaChartData = {
      labels  : ['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : '#00c0ef',
          strokeColor         : '#00c0ef',
          pointColor          : '#00c0ef',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [{{ $nol }},
                                 {{ $satu }},
                                 {{ $dua }},
                                 {{ $tiga }},
                                ],
        },
      ]
    }
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#pieChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
</script>
@endsection
