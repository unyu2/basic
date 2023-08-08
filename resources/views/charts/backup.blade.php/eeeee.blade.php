
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
        let jsonData = chart_data;

        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Prosentase'); // Mengubah kolom "Jumlah" menjadi "Prosentase"

        let totalBobot = 0; // Menambahkan variabel totalBobot untuk menghitung total bobot

        let statusData = {}; // Object to store status data

        $.each(jsonData, (i, jsonData) => {
            let status = jsonData.status;
            let bobot = parseFloat($.trim(jsonData.bobot)); // Menggunakan kolom "bobot" dari data

            let jumlah = bobot * parseFloat($.trim(jsonData.lembar)) * parseFloat($.trim(jsonData.size)); // Mengalikan bobot, lembar, dan size

            totalBobot += jumlah;

            // If the status already exists in the statusData object, add the quantity to it
            if (statusData[status]) {
                statusData[status] += jumlah;
            } else { // If the status doesn't exist in the statusData object, initialize it with the initial quantity
                statusData[status] = jumlah;
            }
        });

        // Iterate through the statusData object to add data to the table
        for (let status in statusData) {
            // Mengubah jumlah menjadi prosentase
            let prosentase = (statusData[status] / totalBobot) * 100;
            data.addRow([status, prosentase]);
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

        // Tidak perlu lagi menampilkan jumlah "Open", "Released", dan "Proses Revisi"
    }

    function loadStatusPieChartDataBobot(id_proyek, title) {
        const temp_title = title + ' ' + id_proyek;
        console.log(`id_proyek: ${id_proyek}`);
    console.log(`temp_title: ${temp_title}`);
        $.ajax({
            url: '/charts/chartDesign/fetch_data_status_bobot', // Mengganti URL endpoint
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