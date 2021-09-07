<!DOCTYPE html>
<html>
<head>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

  <!-- This is what you need -->
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
if (isset($_POST['Propietario'])) {
	
$Propietario=$_POST['Propietario'];
$descripcion=$_POST['descripcion'];
$norte=$_POST['norte'];
$este=$_POST['este'];
$tipoDes=$_POST['tipodes'];
$sur=$_POST['sur'];
$oeste=$_POST['oeste'];
$numds=$_POST['numds'];
$update=$_POST['update'];
//$tipoDes=$_POST['tipodes'];

$fecha=date("Y-m-d");
$hora=date("h:i:s");



$GETDatos=mysql_query("UPDATE bbh_desmenbracion 
	SET 
 
	bbh_descripcion_desm = '$descripcion' , 
	bbh_delm_norte = '$norte' , 
	bbh_delm_sur = '$sur' , 
	bbh_delm_este = '$este' , 
	bbh_delm_oeste = '$oeste' ,  
	bbh_solicitante_dems = '$Propietario' ,  
	bbh_id_usuario = '$id_Usuario' , 
	bbh_tipo_desm = '$tipoDes'
	
	WHERE
	bbh_id_desm = '$update' ")or die(mysql_error());
	
?>
	<script type="text/javascript">
    $(document).ready(function() {
		swal({
  		title: "Correcto!",
  		text: "Los datos se guardaron corectamente.",
  		imageUrl: "images/thumbs-up.jpg"
		},
  	function(){
    window.location.href = 'form_espef.php?Doc=<?php echo $update; ?>&Data=<?php echo $numds; ?>&updata=1';
	});
	});
	</script>
<?php
	
}

?>