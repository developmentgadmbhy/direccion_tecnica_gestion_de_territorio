<!DOCTYPE html>
<html>
<head>
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="../alertmaster/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="../alertmaster/dist/sweetalert.css">
</head>
<body>

<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
if (!isset($_SESSION)) {
  session_start();
}

//$id_Usuario=$_SESSION['MM_ID_USER'];
//$id_Usuario=3;
if (isset($_GET['Data'])) {
$tipo='';
$Res=$_GET['Res'];
if ($Res=='A') {
	$tipo='I';
}elseif ($Res=='I') {
	$tipo='A';
}

$Data=$_GET['Data'];

mysql_query("UPDATE bbh_certif.bbh_usuario 
	SET
	bbh_estado = '$tipo'
	WHERE
	bbh_persona_id = '$Data'")or die(mysql_error());	

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
	
}


if (isset($_GET['Dat'])) {

$IDperson=$_GET['Dat'];
$Res=$_GET['Res'];

$Person=mysql_query("SELECT 	bbh_id_persona, 
								bbh_cedula
								FROM 
								bbh_persona
								WHERE bbh_id_persona=$IDperson")or die(mysql_error());
$GETPerson=mysql_fetch_assoc($Person);
$Pass=md5($GETPerson['bbh_cedula']);

mysql_query("UPDATE bbh_certif.bbh_usuario 
	SET 
	bbh_pass = '$Pass' 
	
	WHERE
	bbh_id_usuario = '$Res'")or die(mysql_error());

?>
	<script type="text/javascript">
    $(document).ready(function() {
		swal({
  		title: "Correcto!",
  		text: "Los datos se Actualizaron corectamente.",
  		imageUrl: "images/thumbs-up.jpg"
		},
  	function(){
    window.location.href = 'VIEW_PERSONAS.php';
	});
	});
	</script>
<?php
}
?>