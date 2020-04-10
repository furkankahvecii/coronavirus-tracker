    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['geochart'],
            'mapsApiKey': 'AIzaSyCQTRyg4qkOoIUkWZ-QWLU3VOrF4NqgPrY'
        });
        google.charts.setOnLoadCallback(drawRegionsMap);

        function drawRegionsMap() {
            var data = google.visualization.arrayToDataTable([
                ['Country', 'Confirmed Cases', ], <?php foreach($RESULT_DATA_COUNTRY as $map) {
                    echo '["'.$map['country'].'",'.$map['cases'].'],';
                } ?>
            ]);

            var options = {
                colorAxis: {colors: ['#D2E3FC', '#8AB4F8', '#4285F4', '#1967D2', '#174EA6', ]},
                backgroundColor: '#2A323C',
                legend: { textStyle: {color: '#000',fontSize: 14}},
                displayMode: 'regions',
            };

            var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
            chart.draw(data, options);
        }
    </script>
</head>