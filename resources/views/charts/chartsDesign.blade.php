@extends('layouts.master')

@section('title')
    Overall Design Progress
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Design Progress</li>
@endsection

@section('content')

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
            <div id="chart_div1" style="width: 100%; height: 400px;"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div2" style="width: 100%; height: 400px;"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div3" style="width: 100%; height: 400px;"></div>
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

<!-- PIE CHART STATUS -->
<script type="text/javascript">
    // Collapse Sidebar
    $('body').addClass('sidebar-collapse');

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
        'packages': ['corechart']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawStatusPieChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data, and
    // draws it.
    function drawStatusPieChart(chart_data, chart_main_title) {
        let jsonData = chart_data;

        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Jumlah');

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
            data.addRow([status, statusData[status]]);
        }

        // Set chart options
        var options = {
            title: chart_main_title,
            colors: ['red', 'orange', 'green'],
            chartArea: {
                width: '80%',
                height: '80%'
            }
        };

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_div1'));
        chart.draw(data, options);

        // Display the number of Open and Closed
        var openCount = statusData['Open'] || 0;
        var releaseCount = statusData['Release'] || 0;
        var prosesCount = statusData['Proses Revisi'] || 0;

        $('#open_count').text(openCount);
        $('#released_count').text(releaseCount);
        $('#proses_count').text(prosesCount);
    }

    function loadStatusPieChartData(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartDesign/fetch_data_status',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawStatusPieChart(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId != '') {
            loadStatusPieChartData(selectedProyekId, 'Status Penyelesaian (Tanpa Bobot) - ID:');
        }
    });
});
</script>



<!-- PIE CHART STATUS DENGAN BOBOT -->
<script type="text/javascript">
// Load the Visualization API and the corechart package.
google.charts.load('current', {
    'packages': ['corechart']
});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawStatusPieChartBobot);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data, and
// draws it.
function drawStatusPieChartBobot(chart_data, chart_main_title) {
    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Status');
    data.addColumn('number', 'Persentase');

    var statusData = {}; // Object to store status data

    $.each(chart_data, function (i, item) {
        var status = item.status;
        var prosentase = parseFloat(item.prosentase);

        // If the status already exists in the statusData object, add the percentage to it
        if (statusData[status]) {
            statusData[status] += prosentase;
        } else { // If the status doesn't exist in the statusData object, initialize it with the initial percentage
            statusData[status] = prosentase;
        }
    });

    // Iterate through the statusData object to add data to the table
    for (var status in statusData) {
        data.addRow([status, statusData[status]]);
    }

    // Set chart options
    var options = {
        title: chart_main_title,
        colors: ['red', 'orange', 'green'],
        chartArea: {
            width: '80%',
            height: '80%'
        }
    };

    // Instantiate and draw the chart
    var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
    chart.draw(data, options);
}

function loadStatusPieChartDataBobot(id_proyek, title) {
    const temp_title = title + ' ' + id_proyek;
    $.ajax({
        url: '/charts/chartDesign/fetch_data_status_bobot', // Sesuaikan rute dengan yang Anda gunakan di controller
        method: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            id_proyek: id_proyek
        },
        dataType: "JSON",
        success: function(data) {
            drawStatusPieChartBobot(data, temp_title);
        }
    });
    console.log(`Proyek: ${id_proyek}`);
}

$(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId != '') {
            loadStatusPieChartDataBobot(selectedProyekId, 'Status Penyelesaian (Dengan Bobot) - ID:');
        }
    });
});

</script>







<!-- KURVA S TANPA BOBOT -->
<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
        'packages': ['corechart']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(loadChart);

    function loadChart() {
        $('#id_proyek').change(function() {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadCurvasChartData(id_proyek, 'Curvas Chart:');
            }
        });
    }

    function drawCurvasChart(chart_data, chart_main_title) {
        if (!chart_data || chart_data.length === 0) {
            // Handle the case when chart_data is undefined or empty
            console.error('No data available.');
            return;
        }

        let jsonData = chart_data;

        let data = new google.visualization.DataTable();
        data.addColumn('date', 'Tanggal');
        data.addColumn('number', 'Total Release');
        data.addColumn('number', 'Total Revisi');
        data.addColumn('number', 'Total Prediksi');

        let totalReleaseData = {};
        let totalRevisiData = {};
        let totalPrediksiData = {};

        $.each(jsonData, (i, jsonData) => {
            let tanggal = new Date(jsonData.created_at);
            let totalRelease = parseFloat(jsonData.totalCountRelease);
            let totalRevisi = parseFloat(jsonData.totalCountRevisi);
            let totalPrediksi = parseFloat(jsonData.totalCountPrediksi);

            totalReleaseData[tanggal] = totalRelease;
            totalRevisiData[tanggal] = totalRevisi;
            totalPrediksiData[tanggal] = totalPrediksi;
        });

        let combinedData = [];

        for (let tanggal in totalReleaseData) {
            let totalRelease = totalReleaseData[tanggal];
            let totalRevisi = totalRevisiData[tanggal];
            let totalPrediksi = totalPrediksiData[tanggal] || 0;

            combinedData.push([new Date(tanggal), totalRelease, totalRevisi, totalPrediksi]);
        }

        // Sort the data by tanggal in ascending order
        combinedData.sort((a, b) => a[0] - b[0]);

        // Add the combined data to the DataTable
        data.addRows(combinedData);

        // Set chart options
        var options = {
            title: chart_main_title,
            hAxis: {
                title: "Tanggal",
                format: 'MMM yyyy',
                viewWindow: {
                    min: new Date(2020, 0, 1) // Set the minimum date on the horizontal axis
                }
            },
            vAxis: {
                title: "Output"
            },
            colors: ['red', 'green', 'blue'],
            chartArea: {
                width: '80%',
                height: '80%'
            }
        };

        // Instantiate and draw the chart
        var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
    }

    function loadCurvasChartData(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartDesign/fetch_data_curvaS',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                console.log(data); // Tambahkan baris ini
                drawCurvasChart(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }
</script>





@endpush