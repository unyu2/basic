@extends('layouts.master')

@section('title')
    @auth
        My Performance - {{ auth()->user()->name }}
    @endauth
@endsection

@section('breadcrumb')
    @parent

    @auth
    <li class="active">My Performance - {{ auth()->user()->name }}</li>
    @endauth

@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">My Performance {{ tanggal_indonesia($tanggal_awal, false) }} s/d {{ tanggal_indonesia($tanggal_akhir, false) }} | Rata-Rata Output Jam</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="chart">
                            <canvas id="salesChart" style="height: 280px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">My Performance {{ tanggal_indonesia($tanggal_awal, false) }} s/d {{ tanggal_indonesia($tanggal_akhir, false) }}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="chart">
                            <canvas id="kurvas" style="height: 280px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->

<div class="row">
    <div class="col-lg-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Overall Progess Anda Berdasarkan Number Of Output Doc</h3>
            </div>
            <div class="box-body">
                <div class="chart">
                    <div id="piechart" style="width: 100%; height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Overall Progress Anda Berdasarkan Standard Jam Teknologi</h3>
            </div>
            <div class="box-body">
                <div class="chart">
                    <div id="pieJam" style="width: 100%; height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">My Performance {{ tanggal_indonesia($tanggal_awal, false) }} s/d {{ tanggal_indonesia($tanggal_akhir, false) }} - Berdasarkan Jumlah Doc Output</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="chart">
                            <canvas id="output" style="height: 280px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')
<!-- ChartJS -->
<script src="{{ asset('AdminLTE-2/bower_components/chart.js/Chart.js') }}"></script>
<script>
$(function() {
    var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
    var salesChart = new Chart(salesChartCanvas);

    var salesChartData = {
        labels: {{ json_encode($data_tanggal) }},
        datasets: [
            {
                label: 'Target',
                fillColor: 'rgba(0, 0, 255, 0.5)', // Biru
                strokeColor: 'rgba(0, 0, 255, 0.8)', // Biru
                pointColor: 'rgba(0, 0, 255, 1)', // Biru
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: {{ json_encode($data_target) }}
            },
            {
                label: 'Release',
                fillColor: 'rgba(0, 128, 0, 0.5)', // Hijau
                strokeColor: 'rgba(0, 128, 0, 0.8)', // Hijau
                pointColor: 'rgba(0, 128, 0, 1)', // Hijau
                pointStrokeColor: '#3b8bba',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: {{ json_encode($data_release_jam_overall) }}
            }
        ]
    };

    var salesChartOptions = {
        pointDot: false,
        responsive: true
    };

    salesChart.Line(salesChartData, salesChartOptions);
});
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", { packages: ["corechart"] });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ["Status", "Count", { role: "style" }], // Tambahkan kolom style
      ["Open", {{ json_encode($job_open) }}, "red"], // Berikan warna merah
      ["Release", {{ json_encode($job_closed) }}, "green"], // Berikan warna hijau
      ["Proses Revisi", {{ json_encode($job_revisi) }}, "orange"], // Berikan warna Hitam
    ]);

    var options = {
      title: "Dalam Satuan Jumlah Doc Output",
      is3D: true,
      slices: {
        0: { color: "red" }, // Atur warna merah untuk "Open"
        1: { color: "green" }, // Atur warna hijau untuk "Closed"
        2: { color: "orange" }, // Atur warna hijau untuk "Proses Revisi"
      },
    };

    var chart = new google.visualization.PieChart(
      document.getElementById("piechart")
    );

    chart.draw(data, options);
  }
</script>


<script type="text/javascript">
  google.charts.load("current", { packages: ["corechart"] });
  google.charts.setOnLoadCallback(drawChartJam);

  function drawChartJam() {
    var data = google.visualization.arrayToDataTable([
      ["Status", "Count", { role: "style" }],
      ["Open", {{ $all_open_jam[0] }}, "red"],
      ["Release", {{ $all_closed_jam[0] }}, "green"],
      ["Proses Revisi", {{ $all_revisi_jam[0] }}, "orange"],
    ]);

    var options = {
      title: "Dalam Satuan Jam",
      is3D: true,
      slices: {
        0: { color: "red" },
        1: { color: "green" },
        2: { color: "orange" },
      },
    };

    var chart = new google.visualization.PieChart(
      document.getElementById("pieJam")
    );

    chart.draw(data, options);
  }
</script>



<script>
$(function() {
    var salesChartCanvasOutput = $('#output').get(0).getContext('2d');
    var salesChart = new Chart(salesChartCanvasOutput);

    var salesChartDataOutput = {
        labels: {{ json_encode($data_tanggal) }},
        datasets: [
            {
                label: 'Jumlah Doc Open',
                fillColor: 'rgba(255, 0, 0, 0.5)', // Merah
                strokeColor: 'rgba(255, 0, 0, 0.8)', // Merah
                pointColor: 'rgba(255, 0, 0, 1)', // Merah
                pointStrokeColor: '#00a65a',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: {{ json_encode($data_open) }}
            },
            {
                label: 'Jumlah Doc Release',
                fillColor: 'rgba(0, 128, 0, 0.5)', // Hijau
                strokeColor: 'rgba(0, 128, 0, 0.8)', // Hijau
                pointColor: 'rgba(0, 128, 0, 1)', // Hijau
                pointStrokeColor: '#3b8bba',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: {{ json_encode($data_release) }}
            }
        ]
    };

    var salesChartOptions = {
        pointDot: false,
        responsive: true
    };

    salesChart.Line(salesChartDataOutput, salesChartOptions);
});
</script>

@endpush