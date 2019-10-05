<?php
require_once("conexion.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript">
            setTimeout('document.location.reload()',10000)
        </script>
		<title>Highcharts Example</title>

		<script type="text/javascript" src="../resources/jquery.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        title: {
            text: 'Reporte Temperatura Y Humedad Con Arduino',
            x: -20 //center
        },
        subtitle: {
            text: '@byRafaC',
            x: -20
        },
        xAxis: {
            categories: [
            <?php
                $sql = " select fecha_hora from sensor_temp_hum order by id desc limit 10 ";
                $result = mysqli_query($connection, $sql);
                while($registros = mysqli_fetch_array($result)){
                    ?>
                        '<?php echo  $registros["fecha_hora"]?>',
                    <?php
                }
            ?>
            ]
        },
        yAxis: {
            title: {
                text: 'Temperatura (øC)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'øC'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Humedad',
            data: [
            <?php
                $query = " select humedad from sensor_temp_hum order by id desc limit 10 ";
                $resultados = mysqli_query($connection, $query);
                while($rows = mysqli_fetch_array($resultados)){
                    ?>
                        <?php echo $rows["humedad"]?>,
                    <?php
                }
            ?>
            ]
        }, {
            name: 'Temperatura',
            data: [
            <?php
                $query = " select temperatura from sensor_temp_hum order by id desc limit 10 ";
                $resultados = mysqli_query($connection, $query);
                while($rows = mysqli_fetch_array($resultados)){
                    ?>
                        <?php echo $rows["temperatura"]?>,
                    <?php
                }
            ?>
            ]
        }]
    });
});
		</script>
	</head>
	<body>
<script src="../resources/highcharts.js"></script>
<script src="../resources/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</body>
</html>

