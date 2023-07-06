<?php
// Obtener los valores enviados desde el formulario
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];

// Realizar la conexión a la base de datos
require_once("conexion.php");
$conexion = conectarOracle();

// Verificar si la conexión fue exitosa
if (!$conexion) {
    $error = oci_error();
    die("Error al conectar a la base de datos: " . $error['message']);
}

// Construir la consulta SQL de actualización
$sql = "UPDATE roles SET descripcion = '$descripcion' WHERE ID_rol = '$id'";

// Preparar la sentencia SQL
$statement = oci_parse($conexion, $sql);

// Ejecutar la sentencia SQL
$resultado = oci_execute($statement);

// Verificar si la actualización fue exitosa
if ($resultado) {
    echo '<script> 
		alert ("Datos actualizados correctamente"); 
		///regresar ahi mismo///
		window.history.go(-1); 
		</script>';
} else {
    $error = oci_error($statement);
    echo '<script> 
		alert ("Error al actualizar datos: ' . $error['message'] . '"); 
		window.history.go(-1); 
		</script>';
}

// Cerrar la conexión a la base de datos
oci_close($conexion);
?>
