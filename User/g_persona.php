<!DOCTYPE html>
<html>
<head>
  <script src="js/jquery-2.1.3.min.js"></script>
  <script src="../alertmaster/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="../alertmaster/dist/sweetalert.css">
</head>
<body>

<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
if (!isset($_SESSION)) {
  session_start();
}

$id_Usuario=$_SESSION['MM_ID_USER'];
//$id_Usuario=3;
if (isset($_POST['Cedula'])) {

$Cedula=$_POST['Cedula'];
$Nombres=$_POST['Nombres'];
$Apellidos=$_POST['Apellidos'];
$Celular=$_POST['Celular'];
$Telefono=$_POST['Telefono'];
$Email=$_POST['Email'];

$fecha=date("Y-m-d");
$hora=date("h:i:s");

$consultaDatos=mysql_query("SELECT 	bbh_cedula 	FROM 	bbh_persona  where bbh_cedula='$Cedula' ")or die(mysql_error());
$NumDatos=mysql_num_rows($consultaDatos);
if ($NumDatos==0) {
	
mysql_query("INSERT INTO bbh_persona 
								(bbh_cedula, 
								bbh_nombres, 
								bbh_apellidos, 
								bbh_telefono, 
								bbh_celular, 
								bbh_email
								)
								VALUES
								('$Cedula',
								'$Nombres', 
								'$Apellidos', 
								'$Telefono', 
								'$Celular', 
								'$Email'
								)")or die(mysql_error());	

    $result = mysql_query("SELECT 	MAX(bbh_id_persona) FROM bbh_persona ");
    $row = mysql_fetch_row($result);
    $highest_id = $row[0];

$pss=md5($Cedula);
mysql_query("INSERT INTO bbh_usuario 
							(bbh_usuario, 
							bbh_pass, 
							bbh_persona_id, 
							bbh_rol_id, 
							bbh_estado
							)
							VALUES
							('$Cedula', 
							'$pss', 
							'$highest_id', 
							'2', 
							'A'
							)")or die(mysql_error());	

?>
	<script type="text/javascript">
    $(document).ready(function() {
		swal({
  		title: "Correcto!",
  		text: "Los datos se guardaron corectamente.",
  		imageUrl: "images/thumbs-up.jpg"
		},
  	function(){
    window.location.href = 'VIEW_PERSONAS.php';
	});
	});
	</script>
<?php
	
}elseif ($NumDatos>0) {
?>

	<script type="text/javascript">
    $(document).ready(function() {
		swal({
  		title: "Error!",
  		text: "Esta Cedula ya Existe.",
  		imageUrl: "images/error.png"
		},
  	function(){
    window.location.href = 'VIEW_PERSONAS.php';
	});
	});
	</script>

<?php
}
}
?>
