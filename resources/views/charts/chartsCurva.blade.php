@extends('layouts.master')

@section('title')
    S-Curve Design & Engineering
@endsection

@section('breadcrumb')
    @parent
    <li class="active">S-Curve Design & Engineering</li>
@endsection

<style>
    .hurup-kapital {
        font-size: 24px;
        color: blue;
        text-align: center; 
    }
</style>

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="col-md-5">
                <select name="id_proyek" id="id_proyek" class="form-control">
                    <option></option>
                    <option value="">All Projects</option>
                @foreach($fetch_id_proyek as $row)
                    @if(isset($proyek[$row->id_proyek]))
                    <option value="{{ $row->id_proyek }}">{{ $proyek[$row->id_proyek] }}</option>
                    @endif
                @endforeach
                </select>
                </div>
            </div>
<br></br>
    <div class="hurup-kapital">Overall Technology S-Curve</div>
<!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <div id="curva_1" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <div id="curva_sample" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <div id="curva_sample_dua" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <br> </br>

            <div class="hurup-kapital">Engineering S-Curve</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <div id="curva_2" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <br> </br>

            <div class="hurup-kapital">Design S-Curve</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <div id="curva_3" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>

            <div class="hurup-kapital">Electrical Design S-Curve</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <div id="curva_4" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>

        <br> </br>
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

<!-------------------------------------------------- COLLAPSE SIDEBAR ----------------------------------------------------->

<script type="text/javascript">
    $('body').addClass('sidebar-collapse');
</script>

<!-------------------------------------------------- KURVA S TANPA SAMPLE ----------------------------------------------------->
<script type="text/javascript">
    
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(loadChart);

    function loadChart() {
        $('#id_proyek').change(function () {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadCurvasChartDataSample(id_proyek, 'Curvas Target:');
            } else {
                // Jika "All Projects" dipilih, set id_proyek ke nilai kosong (0)
                id_proyek = 0;
                loadCurvasChartDataSample(id_proyek, 'Curvas Target for All Projects:');
            }
        });
    }

    function drawCurvasChartSample(chart_data, chart_main_title) {
        if (!chart_data || chart_data.length === 0) {
            // Handle the case when chart_data is undefined or empty
            console.error('No data available.');
            return;
        }

        let jsonData = chart_data;

        let data = new google.visualization.DataTable();
        data.addColumn('date', 'Tanggal');
        data.addColumn('number', 'Total Count Target');

        let dataRows = [];

        // Create an object to store the latest data for each unique date
        let dateDataMap = {};

        $.each(jsonData, function (index, row) {
            let tanggal = new Date(row.prediksi_akhir);
            let totalCountTarget = parseFloat(row.totalCountTarget);

            // Use the date as a key to store the latest data for that date
            dateDataMap[tanggal.toISOString().split('T')[0]] = {
                date: tanggal,
                totalCountTarget: totalCountTarget
            };
        });

        // Extract the values from the dateDataMap to create data rows
        for (let key in dateDataMap) {
            dataRows.push([dateDataMap[key].date, dateDataMap[key].totalCountTarget]);
        }

        // Sort the data by tanggal in ascending order
        dataRows.sort((a, b) => a[0] - b[0]);

        // Add the data rows to the DataTable
        data.addRows(dataRows);

        // Find the minimum date from the data
        var minDate = new Date(Math.min.apply(null, dataRows.map(row => row[0])));

        // Set chart options with dynamic minimum date
        var options = {
            title: chart_main_title,
            hAxis: {
                title: "Tanggal",
                format: 'MMM yyyy',
                viewWindow: {
                    min: minDate // Set the minimum date on the horizontal axis based on data
                }
            },
            vAxis: {
                title: "Total Count Target"
            },
            colors: ['red'],
            chartArea: {
                width: '80%',
                height: '80%'
            }
        };

        // Instantiate and draw the chart
        var chart = new google.visualization.LineChart(document.getElementById('curva_sample'));
        chart.draw(data, options);
    }

    function loadCurvasChartDataSample(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartCurva/fetch_data_curvaS_sample',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function (data) {
                console.log(data); // Tambahkan baris ini
                drawCurvasChartSample(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }
</script>


<!-------------------------------------------------- KURVA S TANPA SAMPLE DUA----------------------------------------------------->

<script type="text/javascript">
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(loadChart);

    function loadChart() {
        $('#id_proyek').change(function () {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadCurvasChartDataSampleDua(id_proyek, 'Curvas Realitation:');
            } else {
                // Jika "All Projects" dipilih, set id_proyek ke nilai kosong (0)
                id_proyek = 0;
                loadCurvasChartDataSampleDua(id_proyek, 'Curvas Realitation for All Projects:');
            }
        });
    }

    function drawCurvasChartSampleDua(chart_data, chart_main_title) {
        if (!chart_data || chart_data.length === 0) {
            // Handle the case when chart_data is undefined or empty
            console.error('No data available.');
            return;
        }

        let jsonData = chart_data;

        let data = new google.visualization.DataTable();
        data.addColumn('date', 'Tanggal');
        data.addColumn('number', 'Total Count Release');

        let dataRows = [];

        // Create an object to store the latest data for each unique date
        let dateDataMap = {};

        $.each(jsonData, function(index, row) {
            let tanggal = new Date(row.time_release_rev0);
            let totalCountRelease = parseFloat(row.totalCountRelease);

            // Use the date as a key to store the latest data for that date
            dateDataMap[tanggal.toISOString().split('T')[0]] = {
                date: tanggal,
                totalCountRelease: totalCountRelease
            };
        });

        // Extract the values from the dateDataMap to create data rows
        for (let key in dateDataMap) {
            dataRows.push([dateDataMap[key].date, dateDataMap[key].totalCountRelease]);
        }

        // Sort the data by tanggal in ascending order
        dataRows.sort((a, b) => a[0] - b[0]);

        // Add the data rows to the DataTable
        data.addRows(dataRows);

        // Find the minimum date from the data
        var minDate = new Date(Math.min.apply(null, dataRows.map(row => row[0])));

        // Set chart options with dynamic minimum date
        var options = {
            title: chart_main_title,
            hAxis: {
                title: "Tanggal",
                format: 'MMM yyyy',
                viewWindow: {
                    min: minDate // Set the minimum date on the horizontal axis based on data
                }
            },
            vAxis: {
                title: "Total Count Release"
            },
            colors: ['green'],
            chartArea: {
                width: '80%',
                height: '80%'
            }
        };

        // Instantiate and draw the chart
        var chart = new google.visualization.LineChart(document.getElementById('curva_sample_dua'));
        chart.draw(data, options);
    }

    function loadCurvasChartDataSampleDua(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartCurva/fetch_data_curvaS_sample_dua',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function (data) {
                console.log(data); // Tambahkan baris ini
                drawCurvasChartSampleDua(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }
</script>


<!-------------------------------------------- KURVA S OVERALL TEKNOLOGI DOUBLE LINE ---------------------------------------------->


<script type="text/javascript">

    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(loadChart);

    function loadChart() {
        $('#id_proyek').change(function () {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadCurvasChartDataCombined(id_proyek, 'S-Curve:');
            } else {
                loadCurvasChartDataCombined('all', 'S-Curve for All Projects:');
            }
        });
    }

    function drawCurvasChartCombined(targetData, realisasiData, chart_main_title) {
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Tanggal');
        data.addColumn('number', 'Target');
        data.addColumn('number', 'Realisasi');

        var mergedData = {};

        targetData.forEach(function (row) {
            var tanggal = new Date(row.prediksi_akhir);
            var totalCountTarget = parseFloat(row.totalCountTarget);
            mergedData[tanggal] = { date: tanggal, totalCountTarget: totalCountTarget };
        });

        realisasiData.forEach(function (row) {
            var tanggal = new Date(row.time_release_rev0);
            var totalCountRelease = parseFloat(row.totalCountRelease);
            if (mergedData[tanggal]) {
                mergedData[tanggal].totalCountRelease = totalCountRelease;
            } else {
                mergedData[tanggal] = { date: tanggal, totalCountRelease: totalCountRelease };
            }
        });

        var dataRows = [];
        for (var tanggal in mergedData) {
            dataRows.push([mergedData[tanggal].date, mergedData[tanggal].totalCountTarget, mergedData[tanggal].totalCountRelease]);
        }

        dataRows.sort(function (a, b) {
            return a[0] - b[0];
        });

        data.addRows(dataRows);
        var minDate = new Date(Math.min.apply(null, dataRows.map(function (row) { return row[0]; })));

        var options = {
            title: chart_main_title,
            hAxis: {
                title: "Tanggal",
                format: 'MMM yyyy',
                viewWindow: {
                    min: minDate
                }
            },
            vAxis: {
                title: "Total Count"
            },
            colors: ['red', 'green'],
            chartArea: {
                width: '80%',
                height: '80%'
            },
            interpolateNulls: true
        };

        var chart = new google.visualization.LineChart(document.getElementById('curva_1'));
        chart.draw(data, options);
    }

    function loadCurvasChartDataCombined(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartCurva/fetch_data_combined',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                let targetData = data.target;
                let realisasiData = data.realisasi;
                drawCurvasChartCombined(targetData, realisasiData, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

</script>

<!-------------------------------------------- KURVA S OVERALL ENGINEERING DOUBLE LINE ---------------------------------------------->


<script type="text/javascript">

    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(loadChart);

    function loadChart() {
        $('#id_proyek').change(function () {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadCurvasChartDataCombinedEngineering(id_proyek, 'S-Curve:');
            } else {
                loadCurvasChartDataCombinedEngineering('all', 'S-Curve for All Projects:');
            }
        });
    }

    function drawCurvasChartCombinedEngineering(targetData, realisasiData, chart_main_title) {
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Tanggal');
        data.addColumn('number', 'Target');
        data.addColumn('number', 'Realisasi');

        var mergedData = {};

        targetData.forEach(function (row) {
            var tanggal = new Date(row.prediksi_akhir);
            var totalCountTarget = parseFloat(row.totalCountTarget);
            mergedData[tanggal] = { date: tanggal, totalCountTarget: totalCountTarget };
        });

        realisasiData.forEach(function (row) {
            var tanggal = new Date(row.time_release_rev0);
            var totalCountRelease = parseFloat(row.totalCountRelease);
            if (mergedData[tanggal]) {
                mergedData[tanggal].totalCountRelease = totalCountRelease;
            } else {
                mergedData[tanggal] = { date: tanggal, totalCountRelease: totalCountRelease };
            }
        });

        var dataRows = [];
        for (var tanggal in mergedData) {
            dataRows.push([mergedData[tanggal].date, mergedData[tanggal].totalCountTarget, mergedData[tanggal].totalCountRelease]);
        }

        dataRows.sort(function (a, b) {
            return a[0] - b[0];
        });

        data.addRows(dataRows);
        var minDate = new Date(Math.min.apply(null, dataRows.map(function (row) { return row[0]; })));

        var options = {
            title: chart_main_title,
            hAxis: {
                title: "Tanggal",
                format: 'MMM yyyy',
                viewWindow: {
                    min: minDate
                }
            },
            vAxis: {
                title: "Total Count"
            },
            colors: ['red', 'green'],
            chartArea: {
                width: '80%',
                height: '80%'
            },
            interpolateNulls: true
        };

        var chart = new google.visualization.LineChart(document.getElementById('curva_2'));
        chart.draw(data, options);
    }

    function loadCurvasChartDataCombinedEngineering(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartCurva/fetch_data_combined_engineering',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                let targetData = data.target;
                let realisasiData = data.realisasi;
                drawCurvasChartCombinedEngineering(targetData, realisasiData, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

</script>

<!-------------------------------------------- KURVA S OVERALL DESIGN DOUBLE LINE ---------------------------------------------->


<script type="text/javascript">

    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(loadChart);

    function loadChart() {
        $('#id_proyek').change(function () {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadCurvasChartDataCombinedDesign(id_proyek, 'S-Curve:');
            } else {
                loadCurvasChartDataCombinedDesign('all', 'S-Curve for All Projects:');
            }
        });
    }

    function drawCurvasChartCombinedDesign(targetData, realisasiData, chart_main_title) {
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Tanggal');
        data.addColumn('number', 'Target');
        data.addColumn('number', 'Realisasi');

        var mergedData = {};

        targetData.forEach(function (row) {
            var tanggal = new Date(row.prediksi_akhir);
            var totalCountTarget = parseFloat(row.totalCountTarget);
            mergedData[tanggal] = { date: tanggal, totalCountTarget: totalCountTarget };
        });

        realisasiData.forEach(function (row) {
            var tanggal = new Date(row.time_release_rev0);
            var totalCountRelease = parseFloat(row.totalCountRelease);
            if (mergedData[tanggal]) {
                mergedData[tanggal].totalCountRelease = totalCountRelease;
            } else {
                mergedData[tanggal] = { date: tanggal, totalCountRelease: totalCountRelease };
            }
        });

        var dataRows = [];
        for (var tanggal in mergedData) {
            dataRows.push([mergedData[tanggal].date, mergedData[tanggal].totalCountTarget, mergedData[tanggal].totalCountRelease]);
        }

        dataRows.sort(function (a, b) {
            return a[0] - b[0];
        });

        data.addRows(dataRows);
        var minDate = new Date(Math.min.apply(null, dataRows.map(function (row) { return row[0]; })));

        var options = {
            title: chart_main_title,
            hAxis: {
                title: "Tanggal",
                format: 'MMM yyyy',
                viewWindow: {
                    min: minDate
                }
            },
            vAxis: {
                title: "Total Count"
            },
            colors: ['red', 'green'],
            chartArea: {
                width: '80%',
                height: '80%'
            },
            interpolateNulls: true
        };

        var chart = new google.visualization.LineChart(document.getElementById('curva_3'));
        chart.draw(data, options);
    }

    function loadCurvasChartDataCombinedDesign(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartCurva/fetch_data_combined_design',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                let targetData = data.target;
                let realisasiData = data.realisasi;
                drawCurvasChartCombinedDesign(targetData, realisasiData, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

</script>

<!-------------------------------------------- KURVA S OVERALL ELD DOUBLE LINE ---------------------------------------------->


<script type="text/javascript">

    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(loadChart);

    function loadChart() {
        $('#id_proyek').change(function () {
            var id_proyek = $(this).val();
            if (id_proyek != '') {
                loadCurvasChartDataCombinedEld(id_proyek, 'S-Curve:');
            } else {
                loadCurvasChartDataCombinedEld('all', 'S-Curve for All Projects:');
            }
        });
    }

    function drawCurvasChartCombinedEld(targetData, realisasiData, chart_main_title) {
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Tanggal');
        data.addColumn('number', 'Target');
        data.addColumn('number', 'Realisasi');

        var mergedData = {};

        targetData.forEach(function (row) {
            var tanggal = new Date(row.prediksi_akhir);
            var totalCountTarget = parseFloat(row.totalCountTarget);
            mergedData[tanggal] = { date: tanggal, totalCountTarget: totalCountTarget };
        });

        realisasiData.forEach(function (row) {
            var tanggal = new Date(row.time_release_rev0);
            var totalCountRelease = parseFloat(row.totalCountRelease);
            if (mergedData[tanggal]) {
                mergedData[tanggal].totalCountRelease = totalCountRelease;
            } else {
                mergedData[tanggal] = { date: tanggal, totalCountRelease: totalCountRelease };
            }
        });

        var dataRows = [];
        for (var tanggal in mergedData) {
            dataRows.push([mergedData[tanggal].date, mergedData[tanggal].totalCountTarget, mergedData[tanggal].totalCountRelease]);
        }

        dataRows.sort(function (a, b) {
            return a[0] - b[0];
        });

        data.addRows(dataRows);
        var minDate = new Date(Math.min.apply(null, dataRows.map(function (row) { return row[0]; })));

        var options = {
            title: chart_main_title,
            hAxis: {
                title: "Tanggal",
                format: 'MMM yyyy',
                viewWindow: {
                    min: minDate
                }
            },
            vAxis: {
                title: "Total Count"
            },
            colors: ['red', 'green'],
            chartArea: {
                width: '80%',
                height: '80%'
            },
            interpolateNulls: true
        };

        var chart = new google.visualization.LineChart(document.getElementById('curva_4'));
        chart.draw(data, options);
    }

    function loadCurvasChartDataCombinedEld(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartCurva/fetch_data_combined_eld',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                let targetData = data.target;
                let realisasiData = data.realisasi;
                drawCurvasChartCombinedEld(targetData, realisasiData, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

</script>
<!--

<script type="text/javascript">

google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(loadChart);

function loadChart() {
    $('#id_proyek').change(function () {
        var id_proyek = $(this).val();
        if (id_proyek != '') {
            loadCurvasChartDataCombined(id_proyek, 'Curvas Chart:');
        }
    });
}

function drawCurvasChartCombined(targetData, realisasiData, chart_main_title) {
    var data = new google.visualization.DataTable();
    data.addColumn('date', 'Tanggal');
    data.addColumn('number', 'Target');
    data.addColumn('number', 'Realisasi');

    var mergedData = {};

    targetData.forEach(function (row) {
        var tanggal = new Date(row.prediksi_akhir);
        var totalCountTarget = parseFloat(row.totalCountTarget);
        mergedData[tanggal] = { date: tanggal, totalCountTarget: totalCountTarget };
    });

    realisasiData.forEach(function (row) {
        var tanggal = new Date(row.time_release_rev0);
        var totalCountRelease = parseFloat(row.totalCountRelease);
        if (mergedData[tanggal]) {
            mergedData[tanggal].totalCountRelease = totalCountRelease;
        } else {
            mergedData[tanggal] = { date: tanggal, totalCountRelease: totalCountRelease };
        }
    });

    var dataRows = [];
    for (var tanggal in mergedData) {
        dataRows.push([mergedData[tanggal].date, mergedData[tanggal].totalCountTarget, mergedData[tanggal].totalCountRelease]);
    }

    dataRows.sort(function (a, b) {
        return a[0] - b[0];
    });

    data.addRows(dataRows);

    var minDate = new Date(Math.min.apply(null, dataRows.map(function (row) { return row[0]; })));

    var options = {
        title: chart_main_title,
        hAxis: {
            title: "Tanggal",
            format: 'MMM yyyy',
            viewWindow: {
                min: minDate
            }
        },
        vAxis: {
            title: "Total Count"
        },
        colors: ['red', 'green'],
        chartArea: {
            width: '80%',
            height: '80%'
        },
        interpolateNulls: true
    };

    var chart = new google.visualization.LineChart(document.getElementById('curva_1'));
    chart.draw(data, options);
}

function loadCurvasChartDataCombined(id_proyek, title) {
    const temp_title = title + ' ' + id_proyek;
    $.ajax({
        url: '/charts/chartCurva/fetch_data_combined',
        method: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            id_proyek: id_proyek
        },
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            let targetData = data.target;
            let realisasiData = data.realisasi;
            drawCurvasChartCombined(targetData, realisasiData, temp_title);
        }
    });
    console.log(`Proyek: ${id_proyek}`);
}

</script>

-->

@endpush