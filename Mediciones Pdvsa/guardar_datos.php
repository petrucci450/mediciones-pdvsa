<?php
	// Obtener los datos del formulario
	$pozo = $_POST["pozo"];
	$valor = $_POST["valor"];
	// Conectar a la base de datos
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "base";
	$conn = mysqli_connect($host, $user, $pass, $db);
	// Verificar la conexión
	if (!$conn) {
		die("Conexión fallida: " . mysqli_connect_error());
	}
	// Insertar los datos en la base de datos
	$sql = "INSERT INTO mediciones (pozo, valor) VALUES ('$pozo', '$valor')";
	if (mysqli_query($conn, $sql)) {
		echo "Los datos han sido guardados exitosamente";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
?>
