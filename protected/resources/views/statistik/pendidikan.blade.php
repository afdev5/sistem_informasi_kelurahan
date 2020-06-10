@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Statistik
        <small>Statistik Pendidikan</small>
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
              <h3 class="box-title">Statistik Pendidikan (%)</h3>
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
              <h6> Belum Sekolah : <b>{{ $satu }}</b></h6>
              <h6> Belum Tamat SD/Sederajat : <b>{{ $dua }}</b></h6>
              <h6> Tamat SD/Sederajat : <b>{{ $tiga }}</b></h6>
              <h6> Tamat SLTP/Sederajat : <b>{{ $empat }}</b></h6>
              <h6> Tamat SLTA/Sederajat : <b>{{ $lima }}</b></h6>
              <h6> Diploma I/II : <b>{{ $enam }}</b></h6>
              <h6> Akademi/Diploma III/S.Muda : <b>{{ $tujuh }}</b></h6>
              <h6> Diploma IV/Strata I : <b>{{ $delapan }}</b></h6>
              <h6> Strata II : <b>{{ $sembilan }}</b></h6>
              <h6> Strata III : <b>{{ $sepuluh }}</b></h6>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
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
      labels  : ['Belum Sekolah', 'Belum Tamat SD/Sederajat', 'Tamat SD/Sederajat', 'Tamat SLTP/Sederajat', 'Tamat SLTA/Sederajat', 'Diploma I/II', 'Akademi/Diploma III/S.Muda', 'Diploma IV/Strata I', 'Strata II', 'Strata III'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : '#00c0ef',
          strokeColor         : '#00c0ef',
          pointColor          : '#00c0ef',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [{{ $tdksklh }},
                                  {{ $blmsd }},
                                  {{ $sd }},
                                  {{ $sltp}},
                                  {{ $slta}},
                                  {{ $d1 }},
                                  {{ $d3 }},
                                  {{ $s1 }},
                                  {{ $s2 }},
                                  {{ $s3 }},
                                ]
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
