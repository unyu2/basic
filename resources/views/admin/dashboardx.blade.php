@extends('layouts.master')

@section('title')
    Charts
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Charts</li>
@endsection

@section('content')

<div class="box-header with-border">
                <h3 class="active">View Detail Project</h3>
            </div>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
         <div class="col-md-5">
         <select name="id_proyek" id="id_proyek" class="form-control">
            <option value="">Select Project</option>
        @foreach($fetch_id_proyek as $row)
            @if(isset($proyek[$row->id_proyek]))
            <option value="{{ $row->id_proyek }}">{{ $proyek[$row->id_proyek] }}</option>
            @endif
       @endforeach
        </select>
    </div>
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
                <h3></h3>

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
                <h3>{{$barang_pr}} </h3>

                <p>Closed Item <p>List</p>
            </div>
            <div class="icon">
                <i class="fa fa-battery-full"></i>
            </div>
            <a href="{{ route('temuan.index') }}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
         <div class="col-md-5">
         <select name="id_proyek" id="id_proyek" class="form-control">
            <option value="">Select Project</option>
        @foreach($fetch_id_proyek as $row)
            @if(isset($proyek[$row->id_proyek]))
            <option value="{{ $row->id_proyek }}">{{ $proyek[$row->id_proyek] }}</option>
            @endif
       @endforeach
</select>
         </div>
    </div>
            <!-- /.box-header -->
            <div class="box-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="chart">
                <!-- Sales Chart Canvas -->
                <div id="chart_div" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row (main row) -->
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
        'packages': ['corechart', 'bar']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawStatusChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data, and
    // draws it.
    function drawStatusChart(chart_data, chart_main_title) {
        let jsonData = chart_data;

        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', 'status');
        data.addColumn('number', 'output');

        let statusData = {}; // Object to store status data

        $.each(jsonData, (i, jsonData) => {
            let status = jsonData.status;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            // If the status already exists in the statusData object, add the quantity to it
            if (statusData[status]) {
                statusData[status] += jumlah;
            } else { // If the status doesn't exist in the statusData object, initialize it with the initial quantity
                statusData[status] = jumlah;
            }
        });

        // Iterate through the statusData object to add data to the table
        for (let status in statusData) {
            data.addRows([[status, statusData[status]]]);
        }

        // Set chart options
        var options = {
            title: chart_main_title,
            hAxis: {
                title: "Status Temuan"
            },
            vAxis: {
                title: "Output"
            },
            colors: ['blue','red','green'],

            chartArea: {
                width: '50%',
                height: '80%'
            }
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    function loadStatusData(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: 'chart/fetch_data_jumlah',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawStatusChart(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadStatusData(id_proyek, 'Progress Per Bulan:');
            }
        });
    });
</script>

@endpush