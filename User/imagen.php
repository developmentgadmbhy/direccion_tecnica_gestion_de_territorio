<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
$id = $_GET['id'];
if ($id > 0){
	//vamos a crear nuestra consulta SQL
			$consulta = "SELECT 	idPersona, 
									Cedula, 
									Nombres, 
									Apellidos, 
									Telefono, 
									Email, 
									Foto, 
									id_Cargo, 
									TYPE
									FROM 
									db_master_bbh.persona, usuario
									WHERE idPersona=usuario.id_Persona AND usuario.idUsuario=$id";
	//con mysql_query la ejecutamos en nuestra base de datos indicada anteriormente
	//de lo contrario mostraremos el error que ocaciono la consulta y detendremos la ejecucion.
	$resultado= @mysql_query($consulta) or die(mysql_error());

	//si el resultado fue exitoso
	//obtendremos el dato que ha devuelto la base de datos
	$datos = mysql_fetch_assoc($resultado);

	//ruta va a obtener un valor parecido a "imagenes/nombre_imagen.jpg" por ejemplo
	$imagen = $datos['Foto'];
	$tipo = $datos['TYPE'];

	//ahora colocamos la cabeceras correcta segun el tipo de imagen
	header("Content-type: $tipo");

	echo $imagen;
}
?>