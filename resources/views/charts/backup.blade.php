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
                loadCurvasChartDataCombined(id_proyek, 'Curvas Chart:');
            }
        });
    }

    function drawCurvasChartCombined(chart_data, chart_main_title) {
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
        var chart = new google.visualization.LineChart(document.getElementById('curva_combined'));
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
            success: function(data) {
                console.log(data); // Tambahkan baris ini
                drawCurvasChartCombined(data, temp_title);
            }
        });
        console.log(`Proyek: ${id_proyek}`);
    }
</script>