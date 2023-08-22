@extends('layouts.master')

@section('title')
    Charts
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Charts</li>
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
                <div id="chart_div" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="chart">
                <!-- Sales Chart Canvas -->
                <div id="chart_div3" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div>
            <div class="chart">
                <!-- Sales Chart Canvas -->
                <div id="chart_div6" style="width: 100%; height: 600px;"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div>
            <div class="chart">
                <!-- Sales Chart Canvas -->
                <div id="chart_div7" style="width: 100%; height: 700px;"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div>
            <div class="chart">
                <!-- Sales Chart Canvas -->
                <div id="chart_div8" style="width: 100%; height: 1500px;"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div>
            <div class="chart">
                <!-- Sales Chart Canvas -->
                <div id="chart_div9" style="width: 100%; height: 400px;"></div>
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
    google.charts.setOnLoadCallback(drawlevelChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data, and
    // draws it.
    function drawlevelChart(chart_data, chart_main_title) {
        let jsonData = chart_data;

        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', 'level');
        data.addColumn('number', 'Jumlah Level');

        let levelData = {}; // Object to store level data

        $.each(jsonData, (i, jsonData) => {
            let level = jsonData.level;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            // If the level already exists in the levelData object, add the quantity to it
            if (levelData[level]) {
                levelData[level] += jumlah;
            } else { // If the level doesn't exist in the levelData object, initialize it with the initial quantity
                levelData[level] = jumlah;
            }
        });

        // Iterate through the levelData object to add data to the table
        for (let level in levelData) {
            data.addRows([[level, levelData[level]]]);
        }

        // Set chart options
        var options = {
            title: chart_main_title,
            hAxis: {
                title: "level Temuan"
            },
            vAxis: {
                title: "Jumlah Level"
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

    function loadlevelData(id_proyek, title) {
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
                drawlevelChart(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadlevelData(id_proyek, 'Progress Per Bulan:');
            }
        });
    });
</script>




<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
        'packages': ['corechart']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawStatusLineChart);

    // Callback that creates and populates a data table,
    // instantiates the line chart, passes in the data, and
    // draws it.
    function drawStatusLineChart(chart_data, chart_main_title) {
        let jsonData = chart_data;

        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Tanggal');
        data.addColumn('number', 'Open');
        data.addColumn('number', 'Closed');

        let openData = {}; // Object to store Open data
        let closedData = {}; // Object to store Closed data

        $.each(jsonData, (i, jsonData) => {
            let status = jsonData.status;
            let tanggal = jsonData.created_at;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            // Add data to the respective objects based on status
            if (status === 'Open') {
                openData[tanggal] = jumlah;
            } else if (status === 'Closed') {
                closedData[tanggal] = jumlah;
            }
        });

        // Combine the data from openData and closedData
        let combinedData = [];

        for (let tanggal in openData) {
            if (closedData[tanggal]) {
                combinedData.push([tanggal, openData[tanggal], closedData[tanggal]]);
            } else {
                combinedData.push([tanggal, openData[tanggal], 0]);
            }
        }

        for (let tanggal in closedData) {
            if (!openData[tanggal]) {
                combinedData.push([tanggal, 0, closedData[tanggal]]);
            }
        }

        // Sort the data by tanggal in ascending order
        combinedData.sort((a, b) => new Date(a[0]) - new Date(b[0]));

        // Add the combined data to the DataTable
        data.addRows(combinedData);

        // Set chart options
        var options = {
            title: chart_main_title,
            hAxis: {
                title: "Tanggal"
            },
            vAxis: {
                title: "Output"
            },
            colors: ['red', 'green'],
            chartArea: {
                width: '50%',
                height: '80%'
            }
        };

        // Instantiate and draw the chart
        var chart = new google.visualization.LineChart(document.getElementById('chart_div4'));
        chart.draw(data, options);
    }

    function loadStatusLineChartData(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: 'chart/fetch_data_tanggal_status',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawStatusLineChart(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadStatusLineChartData(id_proyek, 'Status Line Chart:');
            }
        });
    });
</script>


<script type="text/javascript">
google.charts.load('current', {
    'packages': ['corechart']
});

google.charts.setOnLoadCallback(() => {
    const chartData = [
        // Isi chart_data Anda di sini
    ];

    const chartMainTitle = 'Judul Grafik Utama';

    drawCurvasChart(chartData, chartMainTitle);
});

function drawCurvasChart(chartData, chartMainTitle) {
    if (!chartData || chartData.length === 0) {
        console.error('No data available.');
        return;
    }

    const data = new google.visualization.DataTable();
    data.addColumn('date', 'Tanggal');
    data.addColumn('number', 'Total Temuan');
    data.addColumn('number', 'Closed');

    const totalCountData = {};
    const closedData = {};
    let totalTotalCount = 0;
    let totalClosedCount = 0;

    $.each(chartData, (i, dataRow) => {
        const tanggal = new Date(dataRow.created_at);
        const totalCount = parseFloat(dataRow.totalCount);
        const closedCount = parseFloat(dataRow.closedCount);

        totalCountData[tanggal] = totalCount;
        closedData[tanggal] = closedCount;

        totalTotalCount += totalCount;
        totalClosedCount += closedCount;
    });

    const combinedData = [];
    let accumulatedTotalCount = 0;
    let accumulatedClosedCount = 0;

    for (const tanggal in totalCountData) {
        const closedCount = closedData[tanggal] || 0;
        const totalCount = totalCountData[tanggal];

        accumulatedTotalCount += totalCount;
        accumulatedClosedCount += closedCount;

        combinedData.push([new Date(tanggal), accumulatedTotalCount, accumulatedClosedCount]);
    }

    // Sort the data by tanggal in ascending order
    combinedData.sort((a, b) => a[0] - b[0]);

    // Add the combined data to the DataTable
    data.addRows(combinedData);

    // Set chart options
    const options = {
        title: chartMainTitle,
        hAxis: {
            title: "Tanggal",
            format: 'MMM yyyy',
            viewWindow: {
                min: new Date(2020, 0, 1) // Set the minimum date on the horizontal axis
            }
        },
        vAxis: {
            title: "Total Output",
            minValue: 0 // Set nilai minimum pada vAxis
        },
        colors: ['red', 'green'],
        chartArea: {
            width: '50%',
            height: '80%'
        }
    };

    // Instantiate and draw the chart
    const chart = new google.visualization.LineChart(document.getElementById('chart_div5'));
    chart.draw(data, options);
}

function loadCurvasChartData(id_proyek, title) {
    const temp_title = title + ' ' + id_proyek;
    $.ajax({
        url: 'chart/fetch_data_curvas_tahun',
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

$(document).ready(function() {
    $('#id_proyek').change(function() {
        var id_proyek = $(this).val();
        if (id_proyek != '') {
            loadCurvasChartData(id_proyek, 'Curvas Chart:');
        }
    });
});
</script>


<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
        'packages': ['corechart', 'bar']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawcarChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data, and
    // draws it.
    function drawcarChart(chart_data, chart_main_title) {
        let jsonData = chart_data;

        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', 'car');
        data.addColumn('number', 'output');

        let carData = {}; // Object to store car data

        $.each(jsonData, (i, jsonData) => {
            let car = jsonData.car;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            // If the car already exists in the carData object, add the quantity to it
            if (carData[car]) {
                carData[car] += jumlah;
            } else { // If the car doesn't exist in the carData object, initialize it with the initial quantity
                carData[car] = jumlah;
            }
        });

        // Iterate through the carData object to add data to the table
        for (let car in carData) {
            data.addRows([[car, carData[car]]]);
        }

        // Set chart options
        var options = {
            title: chart_main_title,
            hAxis: {
                title: "car Temuan"
            },
            vAxis: {
                title: "Output"
            },
            colors: ['green'],

            chartArea: {
                width: '50%',
                height: '80%'
            }
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div6'));
        chart.draw(data, options);
    }

    function loadcarData(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: 'chart/fetch_data_car',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawcarChart(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadcarData(id_proyek, 'Progress Per Bulan:');
            }
        });
    });
</script>

<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
        'packages': ['corechart']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawbagianPieChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data, and
    // draws it.
    function drawbagianPieChart(chart_data, chart_main_title) {
        let jsonData = chart_data;

        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', 'bagian');
        data.addColumn('number', 'Jumlah');

        let bagianData = {}; // Object to store bagian data

        $.each(jsonData, (i, jsonData) => {
            let bagian = jsonData.bagian;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            // If the bagian already exists in the bagianData object, add the quantity to it
            if (bagianData[bagian]) {
                bagianData[bagian] += jumlah;
            } else { // If the bagian doesn't exist in the bagianData object, initialize it with the initial quantity
                bagianData[bagian] = jumlah;
            }
        });

        // Iterate through the bagianData object to add data to the table
        for (let bagian in bagianData) {
            data.addRow([bagian, bagianData[bagian]]);
        }

        // Set chart options
        var options = {
            title: chart_main_title,
            colors: ['green', 'red', 'blue', 'black', 'orange', 'cyan'],
            chartArea: {
                width: '80%',
                height: '80%'
            },
            is3D: true // Add 3D option
        };

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_div7'));
        chart.draw(data, options);
    }

    function loadbagianPieChartData(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: 'chart/fetch_data_bagian',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawbagianPieChart(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadbagianPieChartData(id_proyek, 'bagian Pie Chart:');
            }
        });
    });
</script>

<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
        'packages': ['corechart', 'bar']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawnama_produksChart);

    // Callback that creates and populates a data table,
    // instantiates the bar chart, passes in the data, and
    // draws it.
    function drawnama_produksChart(chart_data, chart_main_title) {
        let jsonData = chart_data;

        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Komponen Failure');
        data.addColumn('number', 'Jumlah');

        let produksData = {}; // Object to store nama_produks data

        $.each(jsonData, (i, jsonData) => {
            let nama_produks = jsonData.nama_produks;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            // If the nama_produks already exists in the produksData object, add the quantity to it
            if (produksData[nama_produks]) {
                produksData[nama_produks] += jumlah;
            } else { // If the nama_produks doesn't exist in the produksData object, initialize it with the initial quantity
                produksData[nama_produks] = jumlah;
            }
        });

        // Create an array to store the data rows
        let rows = [];

        // Iterate through the produksData object to add data rows
        for (let nama_produks in produksData) {
            rows.push([nama_produks, produksData[nama_produks]]);
        }

        // Add the data rows to the data table
        data.addRows(rows);

        // Set chart options
        var options = {
            title: chart_main_title,
            hAxis: {
                title: "Jumlah"
            },
            vAxis: {
                title: "Komponen Failure"
            },
            colors: ['green'],
            chartArea: {
                width: '80%',
                height: '80%'
            }
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div8'));
        chart.draw(data, options);
    }

    function loadproduksData(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: 'chart/fetch_data_produk',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawnama_produksChart(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadproduksData(id_proyek, 'Progress Per Bulan:');
            }
        });
    });
</script>

<script type="text/javascript">
    // Load the Visualization API and the table package.
    google.charts.load('current', {
        'packages': ['table']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawDetailTable);

    // Callback that creates and populates a data table,
    // instantiates the table chart, passes in the data, and
    // draws it.
    function drawDetailTable(chart_data, chart_main_title) {
        let jsonData = chart_data;

        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Komponen Failure');
        data.addColumn('number', 'Jumlah');

        let produksData = {}; // Object to store nama_produks data

        $.each(jsonData, (i, jsonData) => {
            let nama_produks = jsonData.nama_produks;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            // If the nama_produks already exists in the produksData object, add the quantity to it
            if (produksData[nama_produks]) {
                produksData[nama_produks] += jumlah;
            } else { // If the nama_produks doesn't exist in the produksData object, initialize it with the initial quantity
                produksData[nama_produks] = jumlah;
            }
        });

        // Create an array to store the data rows
        let rows = [];

        // Iterate through the produksData object to add data rows
        for (let nama_produks in produksData) {
            rows.push([nama_produks, produksData[nama_produks]]);
        }

        // Add the data rows to the data table
        data.addRows(rows);

        // Set table options
        var options = {
            title: chart_main_title,
            width: '100%',
            height: '100%',
            showRowNumber: true,
            allowHtml: true
        };

        // Instantiate and draw the table
        var table = new google.visualization.Table(document.getElementById('chart_div9'));
        table.draw(data, options);
    }

    function loadDetailData(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: 'chart/fetch_data_detail',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawDetailTable(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadDetailData(id_proyek, 'Progress Per Bulan:');
            }
        });
    });
</script>

@endpush