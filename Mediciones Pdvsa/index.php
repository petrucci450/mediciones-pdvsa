<!DOCTYPE html>
<html>
<head>
	<title>Registro de Mediciones de Válvulas PSI</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>.
</head>
<body>

<div class="container">
	<h2>Registro de Mediciones de Válvulas PSI</h2>
	<form action="guardar_datos.php" method="POST">
		<div class="form-group">
			<label for="pozo">Pozo:</label>
			<input type="text" class="form-control" id="pozo" placeholder="Ingrese el pozo" name="pozo">
		</div>
		<div class="form-group">
			<label for="valor">Valor:</label>
			<input type="number" class="form-control" id="valor" placeholder="Ingrese el valor en PSI" name="valor">
		</div>
		<button type="submit" class="btn btn-primary">Registrar</button>
	</form>
	<br>
	<h2>Historial de Mediciones</h2>
	<table class="table">
		<thead>
			<tr>
				<th>Fecha y Hora</th>
				<th>Pozo</th>
				<th>Valor (PSI)</th>
			</tr>
		</thead>
		<tbody>
			<?php
				// Conectar a la base de datos
				$host = "localhost";
				$user = "root";
				$pass = "";
				$db= "base";
				$conn = mysqli_connect($host, $user, $pass, $db);
				// Verificar la conexión
				if (!$conn) {
					die("Conexión fallida: " . mysqli_connect_error());
				}
				// Obtener los registros de la base de datos
				$sql = "SELECT * FROM mediciones ORDER BY fecha_hora DESC";
				$resultado = mysqli_query($conn,$sql);
				if (mysqli_num_rows($resultado) > 0) {
					while($fila = mysqli_fetch_assoc($resultado)) {
						echo "<tr><td>" . $fila["fecha_hora"] . "</td><td>" . $fila["pozo"] . "</td><td>" . $fila["valor"] . "</td></tr>";
					}
				} else {
					echo "<tr><td colspan='3'>No hay registros</td></tr>";
				}
				mysqli_close($conn);
			?>
		</tbody>
	</table>
	<br>
	<h2>Gráfica Comparativa de Mediciones</h2>
	<form action="grafica.php" method="POST">
		<div class="form-group">
			<label for="pozo">Pozo:</label>
			<input type="text" class="form-control" id="pozo" placeholder="Ingrese el pozo" name="pozo">
		</div>
		<div class="form-group">
			<label for="fecha_inicio">Fecha de Inicio:</label>
<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
</div>
<div class="form-group">
<label for="fecha_fin">Fecha de Fin:</label>
<input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
</div>
<button type="submit" class="btn btn-primary">Generar Gráfica</button>
</form>

</div>
</body>
</html>

