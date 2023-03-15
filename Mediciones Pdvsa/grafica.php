<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Fecha y hora', 'Pozo 1', 'Pozo 2', 'Pozo 3'],
                <?php
                $conn = mysqli_connect("localhost", "root", "", "base");
                $sql = "SELECT fecha_hora, valor, pozo ,fecha_ inicio FROM mediciones";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($result)) {
                    echo "['" . $row['fecha_hora'] . "', " . $row['valor'] . ", " . $row['pozo'] . ",";
                }
                mysqli_close($conn);
                ?>
            ]);

            var options = {
                title: 'Comparación de PSI entre los pozos petroleros',
                legend: { position: 'bottom' },
                vAxis: { title: 'PSI' },
                hAxis: { title: 'Fecha y hora' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
</body>
</html>
