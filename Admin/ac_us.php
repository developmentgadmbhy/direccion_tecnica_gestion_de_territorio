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
if (isset($_POST['actualizar'])) {
$id=$_POST['actualizar'];
$Propietario=$_POST['Propietario'];
$Clave=$_POST['Clave'];
$descripcion=$_POST['descripcion'];
$zonificacion=$_POST['zonificacion'];
$descripcion2=$_POST['descripcion2'];
$fecha=date("Y-m-d");
$hora=date("h:i:s");


mysql_query("UPDATE bbh_cert_uso_suelo 
	SET
	bbh_solicitante_usl = '$Propietario' , 
	bbh_descripcion_usl = '$descripcion' , 
	bbh_local_descripcion_usl = '$descripcion2' , 
	bbh_zonif_id = '$zonificacion' , 
	bbh_clave_usl = '$Clave'
	WHERE
	bbh_id_cert_uso_suelo = '$id'")or die(mysql_error());

?>
	<script type="text/javascript">
    $(document).ready(function() {
		swal({
  		title: "Correcto!",
  		text: "Los datos se Actualizaron corectamente.",
  		imageUrl: "images/thumbs-up.jpg"
		},
  	function(){
    window.location.href = '../tcpdf/examples/pdf_certificado_uso_suelo.php?Doc=<?php echo $id; ?>';
	});
	});
	</script>
<?php
	
}

?>