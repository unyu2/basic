@extends('layouts.master')

@section('title')
    Design & Engineering Progress
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Design & Engineering Progress</li>
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
<div class="hurup-kapital">Overall Technology Progress</div>
<br></br>
            <!-- /.box-header -->
            <div class="box-body">
<div class="row">
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="overall_normal" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="overall_bobot" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
</div>
<div class="hurup-kapital">Design Department Progress</div>
<br></br>
            <!-- /.box-header -->
            <div class="box-body">
<div class="row">
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div1" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div2" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
</div>
<div class="hurup-kapital">Engineering Department Progress</div>
<br></br>
            <!-- /.box-header -->
            <div class="box-body">
<div class="row">
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div1E" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div2E" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
</div>

<div class="hurup-kapital"> Electrical Design Progress</div>
<br> </br>
<div class="row">
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div4" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div5" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
</div>
<div class="hurup-kapital"> Mechanical & Interior Design Progress</div>
<br> </br>
<div class="row">
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div6" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div7" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
</div>
<div class="hurup-kapital"> Carbody Design Progress</div>
<br> </br>
<div class="row">
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div8" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div9" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
</div>
<div class="hurup-kapital"> Bogie & Wagon Design Progress</div>
<br> </br>
<div class="row">
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div10" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div11" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
</div>
<div class="hurup-kapital"> Quality Engineering Progress</div>
<br> </br>
<div class="row">
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div12" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div13" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
</div>

<div class="hurup-kapital"> Project Engineering Progress</div>
<br> </br>
<div class="row">
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div14" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div15" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
</div>
<div class="hurup-kapital"> Mechanical Engineering System Progress</div>
<br> </br>
<div class="row">
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div16" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div17" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
</div>
<div class="hurup-kapital"> Electrical Engineering System Progress</div>
<br> </br>
<div class="row">
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div18" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="chart">
            <!-- Sales Chart Canvas -->
            <div id="chart_div19" style="width: 100%; height: 300px;"></div>
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

<!------------------------------------------- PIE CHART OVERALL TECHNOLOGY ----------------------------------------------------->
<script type="text/javascript">

    $('body').addClass('sidebar-collapse');

    google.charts.load('current', {
        'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(function() {
    });

    function drawStatusPieChartOverallNormal(chart_data, chart_main_title) {
        let jsonData = chart_data;

        if (jsonData !== null && jsonData.length !== undefined) {
            let data = new google.visualization.DataTable();
            data.addColumn('string', 'Status');
            data.addColumn('number', 'Jumlah');

            let statusData = {};

            if (jsonData.length === 0) {
                data.addRow(['Open']);
            } else {
                $.each(jsonData, (i, itemData) => {
                    let status = itemData.status;
                    let jumlah = parseFloat($.trim(itemData.jumlah));

                    if (statusData[status]) {
                        statusData[status] += jumlah;
                    } else { 
                        statusData[status] = jumlah;
                    }
                });
            }

            for (let status in statusData) {
                data.addRow([status, statusData[status]]);
            }

            var options = {
                title: chart_main_title,
                chartArea: {
                    width: '80%',
                    height: '80%'
                },
                slices: {}
            };

            var isAllOpen = Object.keys(statusData).length === 1 && statusData.hasOwnProperty('Open');

            if (isAllOpen) {
                options.slices[0] = { color: 'red' };
            } else {
                options.slices[0] = { color: 'red' };
                options.slices[1] = { color: 'green' };
                options.slices[2] = { color: 'orange' };
            }

            var chart = new google.visualization.PieChart(document.getElementById('overall_normal'));
            chart.draw(data, options);

            var openCount = statusData['Open'] || 0;
            var releaseCount = statusData['Release'] || 0;
            var prosesCount = statusData['Proses Revisi'] || 0;

            $('#open_count').text(openCount);
            $('#released_count').text(releaseCount);
            $('#proses_count').text(prosesCount);

        } else {
            console.error("Data yang diterima tidak valid.");
        }
    }

    function loadStatusPieChartDataOverallNormal(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;

        if (id_proyek === '') {
            id_proyek = null;
        }

        $.ajax({
            url: '/charts/chartDesign/fetch_data_overall',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                if (data !== null && data.length !== undefined) {
                    drawStatusPieChartOverallNormal(data, temp_title);
                } else {
                    console.error("Data yang diterima tidak valid atau kosong.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Kesalahan dalam permintaan AJAX:", textStatus, errorThrown);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var selectedProyekId = $(this).val();
            if (selectedProyekId !== '') {
                loadStatusPieChartDataOverallNormal(selectedProyekId, 'Status Penyelesaian (Tanpa Bobot) - ID:');
            } else {
                loadStatusPieChartDataOverallNormal('', 'Status Penyelesaian - All Proyek');
            }
        });
    });
</script>


<!-------------------------------------------------------- PIE CHART OVERALL TECHNOLOGY DENGAN BOBOT ------------------------------------------------------>
<script type="text/javascript">

google.charts.load('current', {
    'packages': ['corechart']
});

google.charts.setOnLoadCallback(drawStatusPieChartOverallBobot);

function drawStatusPieChartOverallBobot(chart_data, chart_main_title) {

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Status');
    data.addColumn('number', 'Persentase');

    var statusData = {};

    $.each(chart_data, function (i, item) {
        var status = item.status;
        var prosentase = parseFloat(item.prosentase);

        if (statusData[status]) {
            statusData[status] += prosentase;
        } else {
            statusData[status] = prosentase;
        }
    });

    for (var status in statusData) {
        data.addRow([status, statusData[status]]);
    }

    var options = {
        title: chart_main_title,
        colors: ['red', 'green', 'orange'],
        chartArea: {
            width: '80%',
            height: '80%'
        }
    };

    var chart = new google.visualization.PieChart(document.getElementById('overall_bobot'));
    chart.draw(data, options);
}

function loadStatusPieChartDataOverallBobot(id_proyek, title) {
    const temp_title = title + ' ' + id_proyek;

    if (id_proyek === '') {
        id_proyek = null;
    }

    $.ajax({
        url: '/charts/chartDesign/fetch_data_overall_bobot',
        method: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            id_proyek: id_proyek
        },
        dataType: "JSON",
        success: function(data) {
            if (data !== null && data.length !== undefined) {
                drawStatusPieChartOverallBobot(data, temp_title);
            } else {
                console.error("Data yang diterima tidak valid atau kosong.");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
    console.error("Kesalahan dalam permintaan AJAX:");
    console.error("Status: " + textStatus);
    console.error("Error: " + errorThrown);
    console.error(jqXHR.responseText);
}

    });
    console.log(`Proyek: ${id_proyek}`);
}

$(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId !== '') {
            loadStatusPieChartDataOverallBobot(selectedProyekId, 'Status Penyelesaian Dengan Bobot - ID:');
        } else {
            loadStatusPieChartDataOverallBobot('', 'Status Penyelesaian - All Proyek');
        }
    });
});

</script>


<!------------------------------------------- PIE CHART STATUS DESIGN ----------------------------------------------------->
<script type="text/javascript">
    // Collapse Sidebar
    $('body').addClass('sidebar-collapse');

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
        'packages': ['corechart']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(function() {
    // Don't call drawStatusPieChart here, we'll call it in the AJAX success callback.
});

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data, and
    // draws it.
    function drawStatusPieChart(chart_data, chart_main_title) {
    let jsonData = chart_data;

    // Periksa jika chart_data adalah objek yang valid dan memiliki properti 'length'
    if (jsonData !== null && jsonData.length !== undefined) {
        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Jumlah');

        let statusData = {}; // Object to store status data

        // Check if chart_data is empty (no project selected)
        if (jsonData.length === 0) {
            // If no project is selected, create a single data entry for "Open"
            data.addRow(['Open']);
        } else {
            $.each(jsonData, (i, itemData) => { // Ganti nama variabel dari 'jsonData' ke 'itemData'
                let status = itemData.status;
                let jumlah = parseFloat($.trim(itemData.jumlah));

                // If the status already exists in the statusData object, add the quantity to it
                if (statusData[status]) {
                    statusData[status] += jumlah;
                } else { // If the status doesn't exist in the statusData object, initialize it with the initial quantity
                    statusData[status] = jumlah;
                }
            });
        }

        // Iterate through the statusData object to add data to the table
        for (let status in statusData) {
            data.addRow([status, statusData[status]]);
        }

        var options = {
            title: chart_main_title,
            chartArea: {
                width: '80%',
                height: '80%'
            },
            slices: {}
        };

        // Cek apakah seluruh data adalah "Open"
        var isAllOpen = Object.keys(statusData).length === 1 && statusData.hasOwnProperty('Open');

        // Tambahkan warna sesuai dengan status
        if (isAllOpen) {
            options.slices[0] = { color: 'red' }; // Jika seluruh data adalah "Open", set warna menjadi hijau
        } else {
            options.slices[0] = { color: 'red' }; // Warna untuk segmen "Open"
            options.slices[1] = { color: 'green' }; // Warna untuk segmen "Release"
            options.slices[2] = { color: 'orange' }; // Warna untuk segmen "Proses Revisi"
        }

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
    } else {
        // Tangani jika data tidak valid
        console.error("Data yang diterima tidak valid.");
    }
}

function loadStatusPieChartData(id_proyek, title) {
    const temp_title = title + ' ' + id_proyek;

    // Periksa jika id_proyek kosong, maka ubah menjadi null atau hapus dari data
    if (id_proyek === '') {
        id_proyek = null; // Atau Anda dapat menghapus baris ini jika ingin menghilangkan id_proyek dari data
    }

    $.ajax({
        url: '/charts/chartDesign/fetch_data_status',
        method: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            id_proyek: id_proyek // Gunakan id_proyek yang mungkin sudah diubah menjadi null
        },
        dataType: "JSON",
        success: function(data) {
            if (data !== null && data.length !== undefined) {
                // Periksa apakah data adalah objek yang valid dan memiliki properti 'length'
                drawStatusPieChart(data, temp_title); // Panggil drawStatusPieChart di sini
            } else {
                // Tangani jika data tidak valid atau kosong
                console.error("Data yang diterima tidak valid atau kosong.");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Kesalahan dalam permintaan AJAX:", textStatus, errorThrown);
        }
    });
    console.log(`Proyek: ${id_proyek}`);
}


$(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId !== '') {
            loadStatusPieChartData(selectedProyekId, 'Status Penyelesaian (Tanpa Bobot) - ID:');
        } else {
            // Jika "All Projects" dipilih, set nilai id_proyek menjadi string kosong ('')
            loadStatusPieChartData('', 'Status Penyelesaian - All Proyek');
        }
    });
});
</script>


<!-------------------------------------------------------- PIE CHART STATUS DESIGN DENGAN BOBOT ------------------------------------------------------>
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
        colors: ['red', 'green', 'orange'],
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

    // Periksa jika id_proyek kosong, maka ubah menjadi null atau hapus dari data
    if (id_proyek === '') {
        id_proyek = null; // Atau Anda dapat menghapus baris ini jika ingin menghilangkan id_proyek dari data
    }

    $.ajax({
        url: '/charts/chartDesign/fetch_data_status_bobot',
        method: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            id_proyek: id_proyek
        },
        dataType: "JSON",
        success: function(data) {
            if (data !== null && data.length !== undefined) {
                // Periksa apakah data adalah objek yang valid dan memiliki properti 'length'
                drawStatusPieChartBobot(data, temp_title);
            } else {
                // Tangani jika data tidak valid atau kosong
                console.error("Data yang diterima tidak valid atau kosong.");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
    console.error("Kesalahan dalam permintaan AJAX:");
    console.error("Status: " + textStatus);
    console.error("Error: " + errorThrown);
    console.error(jqXHR.responseText); // Ini akan mencetak respons kesalahan lengkap ke konsol
}
//        error: function(jqXHR, textStatus, errorThrown) {
//            console.error("Kesalahan dalam permintaan AJAX:", textStatus, errorThrown);
//        }
    });
    console.log(`Proyek: ${id_proyek}`);
}

$(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId !== '') {
            // Jika proyek tertentu dipilih, minta data sesuai proyek
            loadStatusPieChartDataBobot(selectedProyekId, 'Status Penyelesaian Dengan Bobot - ID:');
        } else {
            // Jika "All Projects" dipilih, minta data untuk semua proyek dengan status "Open"
            loadStatusPieChartDataBobot('', 'Status Penyelesaian - All Proyek');
        }
    });
});

</script>


<!------------------------------------------- PIE CHART STATUS ENGINEERING ----------------------------------------------------->
<script type="text/javascript">
    // Collapse Sidebar
    $('body').addClass('sidebar-collapse');

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
        'packages': ['corechart']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(function() {
    // Don't call drawStatusPieChart here, we'll call it in the AJAX success callback.
});

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data, and
    // draws it.
    function drawStatusPieChartEngineering(chart_data, chart_main_title) {
    let jsonData = chart_data;

    // Periksa jika chart_data adalah objek yang valid dan memiliki properti 'length'
    if (jsonData !== null && jsonData.length !== undefined) {
        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Jumlah');

        let statusData = {}; // Object to store status data

        // Check if chart_data is empty (no project selected)
        if (jsonData.length === 0) {
            // If no project is selected, create a single data entry for "Open"
            data.addRow(['Open']);
        } else {
            $.each(jsonData, (i, itemData) => { // Ganti nama variabel dari 'jsonData' ke 'itemData'
                let status = itemData.status;
                let jumlah = parseFloat($.trim(itemData.jumlah));

                // If the status already exists in the statusData object, add the quantity to it
                if (statusData[status]) {
                    statusData[status] += jumlah;
                } else { // If the status doesn't exist in the statusData object, initialize it with the initial quantity
                    statusData[status] = jumlah;
                }
            });
        }

        // Iterate through the statusData object to add data to the table
        for (let status in statusData) {
            data.addRow([status, statusData[status]]);
        }

        var options = {
            title: chart_main_title,
            chartArea: {
                width: '80%',
                height: '80%'
            },
            slices: {}
        };

        // Cek apakah seluruh data adalah "Open"
        var isAllOpen = Object.keys(statusData).length === 1 && statusData.hasOwnProperty('Open');

        // Tambahkan warna sesuai dengan status
        if (isAllOpen) {
            options.slices[0] = { color: 'red' }; // Jika seluruh data adalah "Open", set warna menjadi hijau
        } else {
            options.slices[0] = { color: 'red' }; // Warna untuk segmen "Open"
            options.slices[1] = { color: 'green' }; // Warna untuk segmen "Release"
            options.slices[2] = { color: 'orange' }; // Warna untuk segmen "Proses Revisi"
        }

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_div1E'));
        chart.draw(data, options);

        // Display the number of Open and Closed
        var openCount = statusData['Open'] || 0;
        var releaseCount = statusData['Release'] || 0;
        var prosesCount = statusData['Proses Revisi'] || 0;

        $('#open_count').text(openCount);
        $('#released_count').text(releaseCount);
        $('#proses_count').text(prosesCount);
    } else {
        // Tangani jika data tidak valid
        console.error("Data yang diterima tidak valid.");
    }
}

function loadStatusPieChartDataEngineering(id_proyek, title) {
    const temp_title = title + ' ' + id_proyek;

    // Periksa jika id_proyek kosong, maka ubah menjadi null atau hapus dari data
    if (id_proyek === '') {
        id_proyek = null; // Atau Anda dapat menghapus baris ini jika ingin menghilangkan id_proyek dari data
    }

    $.ajax({
        url: '/charts/chartDesign/fetch_data_engineering',
        method: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            id_proyek: id_proyek // Gunakan id_proyek yang mungkin sudah diubah menjadi null
        },
        dataType: "JSON",
        success: function(data) {
            if (data !== null && data.length !== undefined) {
                // Periksa apakah data adalah objek yang valid dan memiliki properti 'length'
                drawStatusPieChartEngineering(data, temp_title); // Panggil drawStatusPieChart di sini
            } else {
                // Tangani jika data tidak valid atau kosong
                console.error("Data yang diterima tidak valid atau kosong.");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Kesalahan dalam permintaan AJAX:", textStatus, errorThrown);
        }
    });
    console.log(`Proyek: ${id_proyek}`);
}


$(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId !== '') {
            loadStatusPieChartDataEngineering(selectedProyekId, 'Status Penyelesaian (Tanpa Bobot) - ID:');
        } else {
            // Jika "All Projects" dipilih, set nilai id_proyek menjadi string kosong ('')
            loadStatusPieChartDataEngineering('', 'Status Penyelesaian - All Proyek');
        }
    });
});
</script>


<!-------------------------------------------------------- PIE CHART STATUS ENGINEERIG DENGAN BOBOT ------------------------------------------------------>
<script type="text/javascript">
// Load the Visualization API and the corechart package.
google.charts.load('current', {
    'packages': ['corechart']
});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawStatusPieChartEngineeringBobot);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data, and
// draws it.
function drawStatusPieChartEngineeringBobot(chart_data, chart_main_title) {
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
        colors: ['red', 'green', 'orange'],
        chartArea: {
            width: '80%',
            height: '80%'
        }
    };

    // Instantiate and draw the chart
    var chart = new google.visualization.PieChart(document.getElementById('chart_div2E'));
    chart.draw(data, options);
}

function loadStatusPieChartDataEngineeringBobot(id_proyek, title) {
    const temp_title = title + ' ' + id_proyek;

    // Periksa jika id_proyek kosong, maka ubah menjadi null atau hapus dari data
    if (id_proyek === '') {
        id_proyek = null; // Atau Anda dapat menghapus baris ini jika ingin menghilangkan id_proyek dari data
    }

    $.ajax({
        url: '/charts/chartDesign/fetch_data_engineering_bobot',
        method: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            id_proyek: id_proyek
        },
        dataType: "JSON",
        success: function(data) {
            if (data !== null && data.length !== undefined) {
                // Periksa apakah data adalah objek yang valid dan memiliki properti 'length'
                drawStatusPieChartEngineeringBobot(data, temp_title);
            } else {
                // Tangani jika data tidak valid atau kosong
                console.error("Data yang diterima tidak valid atau kosong.");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
    console.error("Kesalahan dalam permintaan AJAX:");
    console.error("Status: " + textStatus);
    console.error("Error: " + errorThrown);
    console.error(jqXHR.responseText); // Ini akan mencetak respons kesalahan lengkap ke konsol
}
//        error: function(jqXHR, textStatus, errorThrown) {
//            console.error("Kesalahan dalam permintaan AJAX:", textStatus, errorThrown);
//        }
    });
    console.log(`Proyek: ${id_proyek}`);
}

$(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId !== '') {
            // Jika proyek tertentu dipilih, minta data sesuai proyek
            loadStatusPieChartDataEngineeringBobot(selectedProyekId, 'Status Penyelesaian Dengan Bobot - ID:');
        } else {
            // Jika "All Projects" dipilih, minta data untuk semua proyek dengan status "Open"
            loadStatusPieChartDataEngineeringBobot('', 'Status Penyelesaian - All Proyek');
        }
    });
});

</script>


<!------------------------------------JS ELD---------------------------------------------------------->

<!-- PIE CHART ELD -->
<script type="text/javascript">

    $('body').addClass('sidebar-collapse');

    google.charts.load('current', {'packages': ['corechart', 'bar']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartEld);

    function drawStatusPieChartEld(chart_data, chart_main_title) {
        let jsonData = chart_data;

        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Jumlah');

        let statusData = {};

        $.each(jsonData, (i, jsonData) => {
            let status = jsonData.status;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            if (statusData[status]) {
                statusData[status] += jumlah;
            } else { 
                statusData[status] = jumlah;
            }
        });

        for (let status in statusData) {
            data.addRow([status, statusData[status]]);
        }

        var options = {
            title: chart_main_title,
            colors: ['red', 'green', 'orange'],
            chartArea: {
                width: '80%',
                height: '80%'
            },
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div4'));
        chart.draw(data, options);

        var openCount = statusData['Open'] || 0;
        var releaseCount = statusData['Release'] || 0;
        var prosesCount = statusData['Proses Revisi'] || 0;

        $('#open_count').text(openCount);
        $('#released_count').text(releaseCount);
        $('#proses_count').text(prosesCount);
    }

    function loadStatusPieChartDataEld(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawStatusPieChartEld(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId !== '') {
            loadStatusPieChartDataEld(selectedProyekId, 'Status Penyelesaian - ID:');
        } else {
            loadStatusPieChartDataEld('', 'Status Penyelesaian - All Proyek');
        }
    });
});

</script>


<!-- PIE CHART STATUS DENGAN BOBOT -->
<script type="text/javascript">

    google.charts.load('current', {
        'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartBobotEld);

    function drawStatusPieChartBobotEld(chart_data, chart_main_title) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Persentase');

        var statusData = {};

        $.each(chart_data, function (i, item) {
            var status = item.status;
            var prosentase = parseFloat(item.prosentase);

            if (statusData[status]) {
                statusData[status] += prosentase;
            } else {
                statusData[status] = prosentase;
            }
        });

        for (var status in statusData) {
            data.addRow([status, statusData[status]]);
        }
            var options = {
                title: chart_main_title,
                chartArea: {
                    width: '80%',
                    height: '80%'
                },
                is3D: true,
                slices: {}
            };

            var isAllOpen = Object.keys(statusData).length === 1 && statusData.hasOwnProperty('Open');

            if (isAllOpen) {
                options.slices[0] = { color: 'red' };
            } else {
                options.slices[0] = { color: 'red' };
                options.slices[1] = { color: 'green' };
                options.slices[2] = { color: 'orange' };
            }
        var chart = new google.visualization.PieChart(document.getElementById('chart_div5'));
        chart.draw(data, options);
    }

    function loadStatusPieChartDataBobotEld(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;

        if (id_proyek === '') {
            id_proyek = null; 
        }

        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld_bobot',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                if (data !== null && data.length !== undefined) {
                    drawStatusPieChartBobotEld(data, temp_title);
                } else {
                    console.error("Data yang diterima tidak valid atau kosong.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
        console.error("Kesalahan dalam permintaan AJAX:");
        console.error("Status: " + textStatus);
        console.error("Error: " + errorThrown);
        console.error(jqXHR.responseText);
    }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var selectedProyekId = $(this).val();
            if (selectedProyekId !== '') {
                loadStatusPieChartDataBobotEld(selectedProyekId, 'Status Penyelesaian Dengan Bobot - ID:');
            } else {
                loadStatusPieChartDataBobotEld('', 'Status Penyelesaian - All Proyek');
            }
        });
    });

</script>

<!------------------------------------------------JS MID---------------------------------------------------------->

<!-- PIE CHART MID -->
<script type="text/javascript">

    $('body').addClass('sidebar-collapse');

    google.charts.load('current', {'packages': ['corechart', 'bar']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartMid);

    function drawStatusPieChartMid(chart_data, chart_main_title) {
        let jsonData = chart_data;

        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Jumlah');

        let statusData = {};

        $.each(jsonData, (i, jsonData) => {
            let status = jsonData.status;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            if (statusData[status]) {
                statusData[status] += jumlah;
            } else { 
                statusData[status] = jumlah;
            }
        });

        for (let status in statusData) {
            data.addRow([status, statusData[status]]);
        }

        var options = {
            title: chart_main_title,
            colors: ['red', 'green', 'orange'],
            chartArea: {
                width: '80%',
                height: '80%'
            },
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div6'));
        chart.draw(data, options);

        var openCount = statusData['Open'] || 0;
        var releaseCount = statusData['Release'] || 0;
        var prosesCount = statusData['Proses Revisi'] || 0;

        $('#open_count').text(openCount);
        $('#released_count').text(releaseCount);
        $('#proses_count').text(prosesCount);
    }

    function loadStatusPieChartDataMid(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawStatusPieChartMid(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId !== '') {
            loadStatusPieChartDataMid(selectedProyekId, 'Status Penyelesaian - ID:');
        } else {
            loadStatusPieChartDataMid('', 'Status Penyelesaian - All Proyek');
        }
    });
});

</script>


<!-- PIE CHART STATUS DENGAN BOBOT -->
<script type="text/javascript">

    google.charts.load('current', {
        'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartBobotMid);

    function drawStatusPieChartBobotMid(chart_data, chart_main_title) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Persentase');

        var statusData = {};

        $.each(chart_data, function (i, item) {
            var status = item.status;
            var prosentase = parseFloat(item.prosentase);

            if (statusData[status]) {
                statusData[status] += prosentase;
            } else {
                statusData[status] = prosentase;
            }
        });

        for (var status in statusData) {
            data.addRow([status, statusData[status]]);
        }
            var options = {
                title: chart_main_title,
                chartArea: {
                    width: '80%',
                    height: '80%'
                },
                is3D: true,
                slices: {}
            };

            var isAllOpen = Object.keys(statusData).length === 1 && statusData.hasOwnProperty('Open');

            if (isAllOpen) {
                options.slices[0] = { color: 'red' };
            } else {
                options.slices[0] = { color: 'red' };
                options.slices[1] = { color: 'green' };
                options.slices[2] = { color: 'orange' };
            }
        var chart = new google.visualization.PieChart(document.getElementById('chart_div7'));
        chart.draw(data, options);
    }

    function loadStatusPieChartDataBobotMid(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;

        if (id_proyek === '') {
            id_proyek = null; 
        }

        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld_bobot',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                if (data !== null && data.length !== undefined) {
                    drawStatusPieChartBobotMid(data, temp_title);
                } else {
                    console.error("Data yang diterima tidak valid atau kosong.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
        console.error("Kesalahan dalam permintaan AJAX:");
        console.error("Status: " + textStatus);
        console.error("Error: " + errorThrown);
        console.error(jqXHR.responseText);
    }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var selectedProyekId = $(this).val();
            if (selectedProyekId !== '') {
                loadStatusPieChartDataBobotMid(selectedProyekId, 'Status Penyelesaian Dengan Bobot - ID:');
            } else {
                loadStatusPieChartDataBobotMid('', 'Status Penyelesaian - All Proyek');
            }
        });
    });

</script>


<!------------------------------------------------JS CBD---------------------------------------------------------->

<!-- PIE CHART MID -->
<script type="text/javascript">

    $('body').addClass('sidebar-collapse');

    google.charts.load('current', {'packages': ['corechart', 'bar']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartCbd);

    function drawStatusPieChartCbd(chart_data, chart_main_title) {
        let jsonData = chart_data;

        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Jumlah');

        let statusData = {};

        $.each(jsonData, (i, jsonData) => {
            let status = jsonData.status;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            if (statusData[status]) {
                statusData[status] += jumlah;
            } else { 
                statusData[status] = jumlah;
            }
        });

        for (let status in statusData) {
            data.addRow([status, statusData[status]]);
        }

        var options = {
            title: chart_main_title,
            colors: ['red', 'green', 'orange'],
            chartArea: {
                width: '80%',
                height: '80%'
            },
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div8'));
        chart.draw(data, options);

        var openCount = statusData['Open'] || 0;
        var releaseCount = statusData['Release'] || 0;
        var prosesCount = statusData['Proses Revisi'] || 0;

        $('#open_count').text(openCount);
        $('#released_count').text(releaseCount);
        $('#proses_count').text(prosesCount);
    }

    function loadStatusPieChartDataCbd(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawStatusPieChartCbd(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId !== '') {
            loadStatusPieChartDataCbd(selectedProyekId, 'Status Penyelesaian - ID:');
        } else {
            loadStatusPieChartDataCbd('', 'Status Penyelesaian - All Proyek');
        }
    });
});

</script>


<!-- PIE CHART STATUS DENGAN BOBOT -->
<script type="text/javascript">

    google.charts.load('current', {
        'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartBobotCbd);

    function drawStatusPieChartBobotCbd(chart_data, chart_main_title) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Persentase');

        var statusData = {};

        $.each(chart_data, function (i, item) {
            var status = item.status;
            var prosentase = parseFloat(item.prosentase);

            if (statusData[status]) {
                statusData[status] += prosentase;
            } else {
                statusData[status] = prosentase;
            }
        });

        for (var status in statusData) {
            data.addRow([status, statusData[status]]);
        }
            var options = {
                title: chart_main_title,
                chartArea: {
                    width: '80%',
                    height: '80%'
                },
                is3D: true,
                slices: {}
            };

            var isAllOpen = Object.keys(statusData).length === 1 && statusData.hasOwnProperty('Open');

            if (isAllOpen) {
                options.slices[0] = { color: 'red' };
            } else {
                options.slices[0] = { color: 'red' };
                options.slices[1] = { color: 'green' };
                options.slices[2] = { color: 'orange' };
            }
        var chart = new google.visualization.PieChart(document.getElementById('chart_div9'));
        chart.draw(data, options);
    }

    function loadStatusPieChartDataBobotCbd(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;

        if (id_proyek === '') {
            id_proyek = null; 
        }

        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld_bobot',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                if (data !== null && data.length !== undefined) {
                    drawStatusPieChartBobotCbd(data, temp_title);
                } else {
                    console.error("Data yang diterima tidak valid atau kosong.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
        console.error("Kesalahan dalam permintaan AJAX:");
        console.error("Status: " + textStatus);
        console.error("Error: " + errorThrown);
        console.error(jqXHR.responseText);
    }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var selectedProyekId = $(this).val();
            if (selectedProyekId !== '') {
                loadStatusPieChartDataBobotCbd(selectedProyekId, 'Status Penyelesaian Dengan Bobot - ID:');
            } else {
                loadStatusPieChartDataBobotCbd('', 'Status Penyelesaian - All Proyek');
            }
        });
    });

</script>

<!------------------------------------------------JS BWD---------------------------------------------------------->

<!-- PIE CHART BWD -->
<script type="text/javascript">

    $('body').addClass('sidebar-collapse');

    google.charts.load('current', {'packages': ['corechart', 'bar']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartBwd);

    function drawStatusPieChartBwd(chart_data, chart_main_title) {
        let jsonData = chart_data;

        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Jumlah');

        let statusData = {};

        $.each(jsonData, (i, jsonData) => {
            let status = jsonData.status;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            if (statusData[status]) {
                statusData[status] += jumlah;
            } else { 
                statusData[status] = jumlah;
            }
        });

        for (let status in statusData) {
            data.addRow([status, statusData[status]]);
        }

        var options = {
            title: chart_main_title,
            colors: ['red', 'green', 'orange'],
            chartArea: {
                width: '80%',
                height: '80%'
            },
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div10'));
        chart.draw(data, options);

        var openCount = statusData['Open'] || 0;
        var releaseCount = statusData['Release'] || 0;
        var prosesCount = statusData['Proses Revisi'] || 0;

        $('#open_count').text(openCount);
        $('#released_count').text(releaseCount);
        $('#proses_count').text(prosesCount);
    }

    function loadStatusPieChartDataBwd(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawStatusPieChartBwd(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId !== '') {
            loadStatusPieChartDataBwd(selectedProyekId, 'Status Penyelesaian - ID:');
        } else {
            loadStatusPieChartDataBwd('', 'Status Penyelesaian - All Proyek');
        }
    });
});

</script>


<!-- PIE CHART STATUS DENGAN BOBOT -->
<script type="text/javascript">

    google.charts.load('current', {
        'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartBobotBwd);

    function drawStatusPieChartBobotBwd(chart_data, chart_main_title) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Persentase');

        var statusData = {};

        $.each(chart_data, function (i, item) {
            var status = item.status;
            var prosentase = parseFloat(item.prosentase);

            if (statusData[status]) {
                statusData[status] += prosentase;
            } else {
                statusData[status] = prosentase;
            }
        });

        for (var status in statusData) {
            data.addRow([status, statusData[status]]);
        }
            var options = {
                title: chart_main_title,
                chartArea: {
                    width: '80%',
                    height: '80%'
                },
                is3D: true,
                slices: {}
            };

            var isAllOpen = Object.keys(statusData).length === 1 && statusData.hasOwnProperty('Open');

            if (isAllOpen) {
                options.slices[0] = { color: 'red' };
            } else {
                options.slices[0] = { color: 'red' };
                options.slices[1] = { color: 'green' };
                options.slices[2] = { color: 'orange' };
            }
        var chart = new google.visualization.PieChart(document.getElementById('chart_div11'));
        chart.draw(data, options);
    }

    function loadStatusPieChartDataBobotBwd(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;

        if (id_proyek === '') {
            id_proyek = null; 
        }

        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld_bobot',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                if (data !== null && data.length !== undefined) {
                    drawStatusPieChartBobotBwd(data, temp_title);
                } else {
                    console.error("Data yang diterima tidak valid atau kosong.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
        console.error("Kesalahan dalam permintaan AJAX:");
        console.error("Status: " + textStatus);
        console.error("Error: " + errorThrown);
        console.error(jqXHR.responseText);
    }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var selectedProyekId = $(this).val();
            if (selectedProyekId !== '') {
                loadStatusPieChartDataBobotBwd(selectedProyekId, 'Status Penyelesaian Dengan Bobot - ID:');
            } else {
                loadStatusPieChartDataBobotBwd('', 'Status Penyelesaian - All Proyek');
            }
        });
    });

</script>

<!------------------------------------------------JS QEN---------------------------------------------------------->

<!-- PIE CHART QEN -->
<script type="text/javascript">

    $('body').addClass('sidebar-collapse');

    google.charts.load('current', {'packages': ['corechart', 'bar']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartQen);

    function drawStatusPieChartQen(chart_data, chart_main_title) {
        let jsonData = chart_data;

        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Jumlah');

        let statusData = {};

        $.each(jsonData, (i, jsonData) => {
            let status = jsonData.status;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            if (statusData[status]) {
                statusData[status] += jumlah;
            } else { 
                statusData[status] = jumlah;
            }
        });

        for (let status in statusData) {
            data.addRow([status, statusData[status]]);
        }

        var options = {
            title: chart_main_title,
            colors: ['red', 'green', 'orange'],
            chartArea: {
                width: '80%',
                height: '80%'
            },
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div12'));
        chart.draw(data, options);

        var openCount = statusData['Open'] || 0;
        var releaseCount = statusData['Release'] || 0;
        var prosesCount = statusData['Proses Revisi'] || 0;

        $('#open_count').text(openCount);
        $('#released_count').text(releaseCount);
        $('#proses_count').text(prosesCount);
    }

    function loadStatusPieChartDataQen(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawStatusPieChartQen(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId !== '') {
            loadStatusPieChartDataQen(selectedProyekId, 'Status Penyelesaian - ID:');
        } else {
            loadStatusPieChartDataQen('', 'Status Penyelesaian - All Proyek');
        }
    });
});

</script>


<!-- PIE CHART QEN DENGAN BOBOT -->
<script type="text/javascript">

    google.charts.load('current', {
        'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartBobotQen);

    function drawStatusPieChartBobotQen(chart_data, chart_main_title) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Persentase');

        var statusData = {};

        $.each(chart_data, function (i, item) {
            var status = item.status;
            var prosentase = parseFloat(item.prosentase);

            if (statusData[status]) {
                statusData[status] += prosentase;
            } else {
                statusData[status] = prosentase;
            }
        });

        for (var status in statusData) {
            data.addRow([status, statusData[status]]);
        }
            var options = {
                title: chart_main_title,
                chartArea: {
                    width: '80%',
                    height: '80%'
                },
                is3D: true,
                slices: {}
            };

            var isAllOpen = Object.keys(statusData).length === 1 && statusData.hasOwnProperty('Open');

            if (isAllOpen) {
                options.slices[0] = { color: 'red' };
            } else {
                options.slices[0] = { color: 'red' };
                options.slices[1] = { color: 'green' };
                options.slices[2] = { color: 'orange' };
            }
        var chart = new google.visualization.PieChart(document.getElementById('chart_div13'));
        chart.draw(data, options);
    }

    function loadStatusPieChartDataBobotQen(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;

        if (id_proyek === '') {
            id_proyek = null; 
        }

        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld_bobot',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                if (data !== null && data.length !== undefined) {
                    drawStatusPieChartBobotQen(data, temp_title);
                } else {
                    console.error("Data yang diterima tidak valid atau kosong.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
        console.error("Kesalahan dalam permintaan AJAX:");
        console.error("Status: " + textStatus);
        console.error("Error: " + errorThrown);
        console.error(jqXHR.responseText);
    }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var selectedProyekId = $(this).val();
            if (selectedProyekId !== '') {
                loadStatusPieChartDataBobotQen(selectedProyekId, 'Status Penyelesaian Dengan Bobot - ID:');
            } else {
                loadStatusPieChartDataBobotQen('', 'Status Penyelesaian - All Proyek');
            }
        });
    });

</script>

<!------------------------------------------------JS PEN---------------------------------------------------------->

<!-- PIE CHART PEN -->
<script type="text/javascript">

    $('body').addClass('sidebar-collapse');

    google.charts.load('current', {'packages': ['corechart', 'bar']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartPen);

    function drawStatusPieChartPen(chart_data, chart_main_title) {
        let jsonData = chart_data;

        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Jumlah');

        let statusData = {};

        $.each(jsonData, (i, jsonData) => {
            let status = jsonData.status;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            if (statusData[status]) {
                statusData[status] += jumlah;
            } else { 
                statusData[status] = jumlah;
            }
        });

        for (let status in statusData) {
            data.addRow([status, statusData[status]]);
        }

        var options = {
            title: chart_main_title,
            colors: ['red', 'green', 'orange'],
            chartArea: {
                width: '80%',
                height: '80%'
            },
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div14'));
        chart.draw(data, options);

        var openCount = statusData['Open'] || 0;
        var releaseCount = statusData['Release'] || 0;
        var prosesCount = statusData['Proses Revisi'] || 0;

        $('#open_count').text(openCount);
        $('#released_count').text(releaseCount);
        $('#proses_count').text(prosesCount);
    }

    function loadStatusPieChartDataPen(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawStatusPieChartPen(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId !== '') {
            loadStatusPieChartDataPen(selectedProyekId, 'Status Penyelesaian - ID:');
        } else {
            loadStatusPieChartDataPen('', 'Status Penyelesaian - All Proyek');
        }
    });
});

</script>


<!-- PIE CHART QEN DENGAN BOBOT -->
<script type="text/javascript">

    google.charts.load('current', {
        'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartBobotPen);

    function drawStatusPieChartBobotPen(chart_data, chart_main_title) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Persentase');

        var statusData = {};

        $.each(chart_data, function (i, item) {
            var status = item.status;
            var prosentase = parseFloat(item.prosentase);

            if (statusData[status]) {
                statusData[status] += prosentase;
            } else {
                statusData[status] = prosentase;
            }
        });

        for (var status in statusData) {
            data.addRow([status, statusData[status]]);
        }
            var options = {
                title: chart_main_title,
                chartArea: {
                    width: '80%',
                    height: '80%'
                },
                is3D: true,
                slices: {}
            };

            var isAllOpen = Object.keys(statusData).length === 1 && statusData.hasOwnProperty('Open');

            if (isAllOpen) {
                options.slices[0] = { color: 'red' };
            } else {
                options.slices[0] = { color: 'red' };
                options.slices[1] = { color: 'green' };
                options.slices[2] = { color: 'orange' };
            }
        var chart = new google.visualization.PieChart(document.getElementById('chart_div15'));
        chart.draw(data, options);
    }

    function loadStatusPieChartDataBobotPen(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;

        if (id_proyek === '') {
            id_proyek = null; 
        }

        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld_bobot',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                if (data !== null && data.length !== undefined) {
                    drawStatusPieChartBobotPen(data, temp_title);
                } else {
                    console.error("Data yang diterima tidak valid atau kosong.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
        console.error("Kesalahan dalam permintaan AJAX:");
        console.error("Status: " + textStatus);
        console.error("Error: " + errorThrown);
        console.error(jqXHR.responseText);
    }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var selectedProyekId = $(this).val();
            if (selectedProyekId !== '') {
                loadStatusPieChartDataBobotPen(selectedProyekId, 'Status Penyelesaian Dengan Bobot - ID:');
            } else {
                loadStatusPieChartDataBobotPen('', 'Status Penyelesaian - All Proyek');
            }
        });
    });

</script>

<!------------------------------------------------JS MIS---------------------------------------------------------->

<!-- PIE CHART MIS -->
<script type="text/javascript">

    $('body').addClass('sidebar-collapse');

    google.charts.load('current', {'packages': ['corechart', 'bar']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartMis);

    function drawStatusPieChartMis(chart_data, chart_main_title) {
        let jsonData = chart_data;

        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Jumlah');

        let statusData = {};

        $.each(jsonData, (i, jsonData) => {
            let status = jsonData.status;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            if (statusData[status]) {
                statusData[status] += jumlah;
            } else { 
                statusData[status] = jumlah;
            }
        });

        for (let status in statusData) {
            data.addRow([status, statusData[status]]);
        }

        var options = {
            title: chart_main_title,
            colors: ['red', 'green', 'orange'],
            chartArea: {
                width: '80%',
                height: '80%'
            },
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div16'));
        chart.draw(data, options);

        var openCount = statusData['Open'] || 0;
        var releaseCount = statusData['Release'] || 0;
        var prosesCount = statusData['Proses Revisi'] || 0;

        $('#open_count').text(openCount);
        $('#released_count').text(releaseCount);
        $('#proses_count').text(prosesCount);
    }

    function loadStatusPieChartDataMis(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawStatusPieChartMis(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId !== '') {
            loadStatusPieChartDataMis(selectedProyekId, 'Status Penyelesaian - ID:');
        } else {
            loadStatusPieChartDataMis('', 'Status Penyelesaian - All Proyek');
        }
    });
});

</script>


<!-- PIE CHART MIS DENGAN BOBOT -->
<script type="text/javascript">

    google.charts.load('current', {
        'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartBobotMis);

    function drawStatusPieChartBobotMis(chart_data, chart_main_title) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Persentase');

        var statusData = {};

        $.each(chart_data, function (i, item) {
            var status = item.status;
            var prosentase = parseFloat(item.prosentase);

            if (statusData[status]) {
                statusData[status] += prosentase;
            } else {
                statusData[status] = prosentase;
            }
        });

        for (var status in statusData) {
            data.addRow([status, statusData[status]]);
        }
            var options = {
                title: chart_main_title,
                chartArea: {
                    width: '80%',
                    height: '80%'
                },
                is3D: true,
                slices: {}
            };

            var isAllOpen = Object.keys(statusData).length === 1 && statusData.hasOwnProperty('Open');

            if (isAllOpen) {
                options.slices[0] = { color: 'red' };
            } else {
                options.slices[0] = { color: 'red' };
                options.slices[1] = { color: 'green' };
                options.slices[2] = { color: 'orange' };
            }
        var chart = new google.visualization.PieChart(document.getElementById('chart_div17'));
        chart.draw(data, options);
    }

    function loadStatusPieChartDataBobotMis(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;

        if (id_proyek === '') {
            id_proyek = null; 
        }

        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld_bobot',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                if (data !== null && data.length !== undefined) {
                    drawStatusPieChartBobotMis(data, temp_title);
                } else {
                    console.error("Data yang diterima tidak valid atau kosong.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
        console.error("Kesalahan dalam permintaan AJAX:");
        console.error("Status: " + textStatus);
        console.error("Error: " + errorThrown);
        console.error(jqXHR.responseText);
    }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var selectedProyekId = $(this).val();
            if (selectedProyekId !== '') {
                loadStatusPieChartDataBobotMis(selectedProyekId, 'Status Penyelesaian Dengan Bobot - ID:');
            } else {
                loadStatusPieChartDataBobotMis('', 'Status Penyelesaian - All Proyek');
            }
        });
    });

</script>

<!------------------------------------------------JS EES---------------------------------------------------------->

<!-- PIE CHART EES -->
<script type="text/javascript">

    $('body').addClass('sidebar-collapse');

    google.charts.load('current', {'packages': ['corechart', 'bar']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartEes);

    function drawStatusPieChartEes(chart_data, chart_main_title) {
        let jsonData = chart_data;

        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Jumlah');

        let statusData = {};

        $.each(jsonData, (i, jsonData) => {
            let status = jsonData.status;
            let jumlah = parseFloat($.trim(jsonData.jumlah));

            if (statusData[status]) {
                statusData[status] += jumlah;
            } else { 
                statusData[status] = jumlah;
            }
        });

        for (let status in statusData) {
            data.addRow([status, statusData[status]]);
        }

        var options = {
            title: chart_main_title,
            colors: ['red', 'green', 'orange'],
            chartArea: {
                width: '80%',
                height: '80%'
            },
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div18'));
        chart.draw(data, options);

        var openCount = statusData['Open'] || 0;
        var releaseCount = statusData['Release'] || 0;
        var prosesCount = statusData['Proses Revisi'] || 0;

        $('#open_count').text(openCount);
        $('#released_count').text(releaseCount);
        $('#proses_count').text(prosesCount);
    }

    function loadStatusPieChartDataEes(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                drawStatusPieChartEes(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
    $('#id_proyek').change(function() {
        var selectedProyekId = $(this).val();
        if (selectedProyekId !== '') {
            loadStatusPieChartDataEes(selectedProyekId, 'Status Penyelesaian - ID:');
        } else {
            loadStatusPieChartDataEes('', 'Status Penyelesaian - All Proyek');
        }
    });
});

</script>


<!-- PIE CHART EES DENGAN BOBOT -->
<script type="text/javascript">

    google.charts.load('current', {
        'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawStatusPieChartBobotEes);

    function drawStatusPieChartBobotEes(chart_data, chart_main_title) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Persentase');

        var statusData = {};

        $.each(chart_data, function (i, item) {
            var status = item.status;
            var prosentase = parseFloat(item.prosentase);

            if (statusData[status]) {
                statusData[status] += prosentase;
            } else {
                statusData[status] = prosentase;
            }
        });

        for (var status in statusData) {
            data.addRow([status, statusData[status]]);
        }
            var options = {
                title: chart_main_title,
                chartArea: {
                    width: '80%',
                    height: '80%'
                },
                is3D: true,
                slices: {}
            };

            var isAllOpen = Object.keys(statusData).length === 1 && statusData.hasOwnProperty('Open');

            if (isAllOpen) {
                options.slices[0] = { color: 'red' };
            } else {
                options.slices[0] = { color: 'red' };
                options.slices[1] = { color: 'green' };
                options.slices[2] = { color: 'orange' };
            }
        var chart = new google.visualization.PieChart(document.getElementById('chart_div19'));
        chart.draw(data, options);
    }

    function loadStatusPieChartDataBobotEes(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;

        if (id_proyek === '') {
            id_proyek = null; 
        }

        $.ajax({
            url: '/charts/chartDesign/fetch_data_eld_bobot',
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_proyek: id_proyek
            },
            dataType: "JSON",
            success: function(data) {
                if (data !== null && data.length !== undefined) {
                    drawStatusPieChartBobotEes(data, temp_title);
                } else {
                    console.error("Data yang diterima tidak valid atau kosong.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
        console.error("Kesalahan dalam permintaan AJAX:");
        console.error("Status: " + textStatus);
        console.error("Error: " + errorThrown);
        console.error(jqXHR.responseText);
    }
        });
        console.log(`Proyek: ${id_proyek}`);
    }

    $(document).ready(function() {
        $('#id_proyek').change(function() {
            var selectedProyekId = $(this).val();
            if (selectedProyekId !== '') {
                loadStatusPieChartDataBobotEes(selectedProyekId, 'Status Penyelesaian Dengan Bobot - ID:');
            } else {
                loadStatusPieChartDataBobotEes('', 'Status Penyelesaian - All Proyek');
            }
        });
    });

</script>

@endpush