@extends('layouts.master')

@section('title')
Overall Design & Engineering Schedule
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Overall Design & Engineering Schedule</li>
@endsection

<style>
.custom-btn {
    font-size: 10em; /* Ukuran teks 4 kali lipat */
    padding: 200px 400px; /* Atur padding sesuai kebutuhan */
    /* Tambahan gaya sesuai preferensi Anda */
}
</style>

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border"></div>
            <div class="box-header">
                <h3 class="box-title">Untuk Melihat Detail Pilih Button Dibawah Ini</h3>
            </div>
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3>150</h3>
                            <p>Mechanical Engineering System</p>
                        </div>
                        <div class="icon inner">
                            <i class="fa fa-area-chart"></i>
                        </div>
                        <a href="{{ route('chartsMes') }}" target="_blank" class="small-box-footer">More Detail Schedule <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>150</h3>
                        <p>	Electrical Engineering System</p>
                    </div>
                    <div class="icon inner">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                <a href="{{ route('chartsEes') }}" target="_blank" class="small-box-footer">More Detail Schedule <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Quality Engineering</p>
                    </div>
                    <div class="icon inner">
                        <i class="fa fa-line-chart"></i>
                    </div>
                <a href="{{ route('chartsQen') }}" target="_blank" class="small-box-footer">More Detail Schedule <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-maroon">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Product Engineering</p>
                    </div>
                    <div class="icon inner">
                        <i class="fa fa-pie-chart "></i>
                    </div>
                <a href="{{ route('chartsPre') }}" target="_blank" class="small-box-footer">More Detail Schedule <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
                <!-- Add other small-box elements here as needed -->
            </div>

            <div class="row">
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>150</h3>
                        <p>	Electrical Design</p>
                    </div>
                    <div class="icon inner">
                        <i class="fa fa-area-chart"></i>
                    </div>
                <a href="{{ route('chartsEld') }}" target="_blank" class="small-box-footer">More Detail Schedule <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-gray">
                    <div class="inner">
                        <h3>150</h3>
                        <p>	Mechanical & Interior Design</p>
                    </div>
                    <div class="icon inner">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                <a href="{{ route('chartsMid') }}" target="_blank" class="small-box-footer">More Detail Schedule <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>150</h3>
                        <p>	Carbody Design</p>
                    </div>
                    <div class="icon inner">
                        <i class="fa fa-line-chart"></i>
                    </div>
                <a href="{{ route('chartsCbd') }}" target="_blank" class="small-box-footer">More Detail Schedule<i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>150</h3>
                        <p>	Bogie & Wagon Design</p>
                    </div>
                    <div class="icon inner">
                        <i class="fa fa-pie-chart "></i>
                    </div>
                <a href="{{ route('chartsBwd') }}" target="_blank" class="small-box-footer">More Detail Schedule <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
                <!-- Add other small-box elements for the second row here as needed -->
            </div>

            <br>
            <br>

            <div class="box-header">
                <h3 class="box-title">Overall Design & Engineering Schedule</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="chart">
                            <div id="chart1" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    // Collapse Sidebar
    $('body').addClass('sidebar-collapse');
    
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Task ID');
      data.addColumn('string', 'Task Name');
      data.addColumn('string', 'Resource');
      data.addColumn('date', 'Start Date');
      data.addColumn('date', 'End Date');
      data.addColumn('number', 'Duration');
      data.addColumn('number', 'Percent Complete');
      data.addColumn('string', 'Dependencies');

      var designData = @json($design);

if (designData.length > 0) {
    for (var i = 0; i < designData.length; i++) {
        var item = designData[i];
        data.addRows([
            [item.id_design.toString(), item.kode_design + ' - ' + item.nama_design, item.refrensi_design,
            new Date(item.tp_yy, item.tp_mm - 1, item.tp_dd), new Date(item.pa_yy, item.pa_mm - 1, item.pa_dd), item.prediksi_hari, item.prosentase, null],
        ]);
    }
} else {

}

      var options = {
        height: 100000,
        gantt: {
          trackHeight: 30
        }
      };

      var chart = new google.visualization.Gantt(document.getElementById('chart1'));
      chart.draw(data, options);
    }
</script>



@endpush
