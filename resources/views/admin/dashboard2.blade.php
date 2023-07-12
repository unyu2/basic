@extends('layouts.master')

@section('title')
    Dashboard Trainset 1
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Dashboard Trainset 1</li>
@endsection

@section('content')
<div class="box-header with-border">
                <h3 class="active"><b>TRAINSET 1</b></h3>
            </div>
<!-- Small boxes (Stat box) -->
<div class="row">
<div class="col-lg-3 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $temuan4 }}</h3>

            <p>Status Kereta</p>
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
    <div class="col-lg-3 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ number_format ($temuan3, 2) }}%</h3>

            <p>Progress OIL</p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('temuan.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $temuan_all }} Item</h3> 

            <p>Total OIL</p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('temuan.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{$temuan_open}} Item</h3> 

                <p>Jumlah OIL (Open)</p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a href="{{ route('temuan.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
    <!-- ./col -->
    <div class="row">
    <div class="col-lg-3 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
            <h3></h3> 
                <p>Check Harian</p>
            </div>
            <div class="icon">
                <i class="fa fa-battery-full"></i>
            </div>
            <a href="{{ route('dashboard2x1') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
            <h3></h3> 
                <p>Perawatan Rutin</p>
            </div>
            <div class="icon">
                <i class="fa fa-battery-2"></i>
            </div>
            <a href="{{ route('dashboard2x2') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
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
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12 col-xs-24">
                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <canvas id="salesChart" style="height: 180px;"></canvas>
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
@endpush