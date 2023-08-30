@extends('layouts.master')

@section('title')
    Dashboard Overall Open Item
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Dashboard Overall Open Item</li>
@endsection

@section('content')


<div class="box-header with-border">
                <h3 class="active">View Detail Project</h3>
            </div>

<div class="box-body">
<a class="btn btn-app {{$temuanc1}}" href="{{ route('dashboard2') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 1
</a>
<a class="btn btn-app {{$temuanc2}}" href="{{ route('dashboard3') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 2
</a>
<a class="btn btn-app {{$temuanc3}}" href="{{ route('dashboard4') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 3
</a>
<a class="btn btn-app {{$temuanc4}}" href="{{ route('dashboard5') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 4
</a>
<a class="btn btn-app {{$temuanc5}}" href="{{ route('dashboard6') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 5
</a>
<a class="btn btn-app {{$temuanc6}}" href="{{ route('dashboard7') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 6
</a>
<a class="btn btn-app {{$temuanc7}}" href="{{ route('dashboard8') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 7
</a>
<a class="btn btn-app {{$temuanc8}}" href="{{ route('dashboard9') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 8
</a>
<a class="btn btn-app {{$temuanc9}}" href="{{ route('dashboard10') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 9
</a>
<a class="btn btn-app {{$temuanc10}}" href="{{ route('dashboard11') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 10
</a>
<a class="btn btn-app {{$temuanc11}}" href="{{ route('dashboard12') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 11
</a>
<a class="btn btn-app {{$temuanc12}}" href="{{ route('dashboard13') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 12
</a>
<a class="btn btn-app {{$temuanc13}}" href="{{ route('dashboard14') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 13
</a>
</a>
</div>
<div class="box-body">
<a class="btn btn-app {{$temuanc14}}" href="{{ route('dashboard15') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 14
</a>
<a class="btn btn-app {{$temuanc15}}" href="{{ route('dashboard16') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 15
</a>
<a class="btn btn-app {{$temuanc16}}" href="{{ route('dashboard17') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 16
</a>
<a class="btn btn-app {{$temuanc17}}" href="{{ route('dashboard18') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 17
</a>
<a class="btn btn-app {{$temuanc18}}" href="{{ route('dashboard19') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 18
</a>
<a class="btn btn-app {{$temuanc19}}" href="{{ route('dashboard20') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 19
</a>
<a class="btn btn-app {{$temuanc20}}" href="{{ route('dashboard21') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 20
</a>
<a class="btn btn-app {{$temuanc21}}" href="{{ route('dashboard22') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 21
</a>
<a class="btn btn-app {{$temuanc22}}" href="{{ route('dashboard23') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 22
</a>
<a class="btn btn-app {{$temuanc23}}" href="{{ route('dashboard24') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 23
</a>
<a class="btn btn-app {{$temuanc24}}" href="{{ route('dashboard25') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 24
</a>
<a class="btn btn-app {{$temuanc25}}" href="{{ route('dashboard26') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 25
</a>
<a class="btn btn-app {{$temuanc26}}" href="{{ route('dashboard27') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 26
</a>
</div>

<div class="box-body">
<a class="btn btn-app {{$temuanc27}}" href="{{ route('dashboard28') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 27
</a>
<a class="btn btn-app {{$temuanc28}}" href="{{ route('dashboard29') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 28
</a>
<a class="btn btn-app {{$temuanc29}}" href="{{ route('dashboard30') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 29
</a>
<a class="btn btn-app {{$temuanc30}}" href="{{ route('dashboard31') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 30
</a>
<a class="btn btn-app {{$temuanc31}}" href="{{ route('dashboard32') }}" target="_blank">
<i class="fa fa-subway"></i> Trainset 31
</a>
</div>

<div class="box-header with-border">
                <h3 class="active"><b>OVER ALL TRAINSET</b></h3>
            </div>
<!-- Small boxes (Stat box) -->
<div class="row">
<div class="col-lg-2 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ number_format ($temuan3, 2) }}%</h3>

                <p>Progress <p> OIL</p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('temuan.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{$temuan_closed}} </h3>

                <p>Closed Item <p>List</p>
            </div>
            <div class="icon">
                <i class="fa fa-battery-full"></i>
            </div>
            <a href="{{ route('temuan.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-2 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{$temuan_open}}</h3>

                <p>Open Item <p>List</p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('temuan.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
    <div class="row">
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $barang_pr }}</h3>

                <p>Permintaan PR</p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('permintaan.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $barang_po }}</h3>

                <p>Permintaan PO</p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('permintaan.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
    <div class="row">
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $barang_request }}</h3>

                <p>Belum Diterima</p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('permintaan.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $barang_diterima }}</h3>

                <p>Permintaan Diterima</p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('permintaan.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Grafik Temuan {{ tanggal_indonesia($tanggal_awal, false) }} s/d {{ tanggal_indonesia($tanggal_akhir, false) }}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="chart">
                            <canvas id="salesChart" style="height: 180px;"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row (main row) -->

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Grafik Temuan {{ tanggal_indonesia($tanggal_awal, false) }} s/d {{ tanggal_indonesia($tanggal_akhir, false) }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <div id="piechart" style="width: 600px; height: 400px;"></div>
                        </div>
                        <!-- /.chart-responsive -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row (main row) -->

@endsection

@push('scripts')
<!-- ChartJS -->
<script src="{{ asset('AdminLTE-2/bower_components/chart.js/Chart.js') }}"></script>
<script>
$(function() {
    // Get context with jQuery - using jQuery's .get() method.
    var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
    // This will get the first returned node in the jQuery collection.
    var salesChart = new Chart(salesChartCanvas);

    var salesChartData = {
        labels: {{ json_encode($data_tanggal) }},
        datasets: [
            {
                label: 'Open',
                fillColor           : 'rgba(255, 69, 0, 1)',
                strokeColor         : 'rgba(255, 69, 0, 1)',
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: {{ json_encode($temuans) }}
            }

        ]
    };

    var salesChartOptions = {
        pointDot : false,
        responsive : true
    };

    salesChart.Line(salesChartData, salesChartOptions);
});
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Temuan Closed', {{ json_encode($temuan_closed) }}],
          ['Temuan Open',      <?php echo $temuan_open; ?>],
        ]);

        var options = {
          title: 'Progress Temuan'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
@endpush