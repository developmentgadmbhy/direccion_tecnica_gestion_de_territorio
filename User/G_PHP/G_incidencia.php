<!DOCTYPE html>
<html>
<head>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="../../alertmaster/dist/sweetalert-dev.js"></script>
	<link rel="stylesheet" href="../../alertmaster/dist/sweetalert.css">
</head>
<body>
<?php
include '../../Connections/RootSistemas_Conexion_masterWeb.php';
if (isset($_POST['problema'])) {

	$problema=$_POST['problema'];
	$prioridad=$_POST['prioridad'];
	$Observacion=$_POST['Observacion'];
	$fecha=date("Y-m-d");
	$hora=date("H:i");

	mysql_query("INSERT INTO db_master_bbh.incidencia 
	(id_Tipo_incidencia, 
	Fecha_Ingreso, 
	Hora_Ingreso, 
	Prioridad, 
	Id_Usuario, 
	RCB, 
	estado, 
	obcervacion
	)
	VALUES
	('$problema', 
	'$fecha', 
	'$hora', 
	'$prioridad', 
	'1', 
	'0', 
	'0', 
	'$Observacion'
	)")or die(mysql_error());

		?>

	<script type="text/javascript">
    	$(document).ready(function() {
			swal({
  			title: "Correcto!",
  			text: "Su Solicitud será atendida lo antes posible.",
  			imageUrl: "../images/thumbs-up.jpg"
		},
  		function(){
    	window.location.href = '../incidencia.php';
	});

	});
	
	</script>

<?php
}
?>
</body>
</html>