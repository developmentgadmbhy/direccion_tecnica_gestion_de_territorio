<!DOCTYPE html>
<html>
<head>
	<script src="js/jquery-2.1.3.min.js"></script>

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
$tipoparroquia=$_POST['tipoparroquia'];
$Parroquia2=$_POST['Parroquia2'];
$Calle=$_POST['Calle'];
$Clave=$_POST['Clave'];
$Interseccion=$_POST['Interseccion'];
$bu=$_POST['bu'];//barrio o urbani...
$lf=$_POST['lf'];
$nl=$_POST['nl'];
$Manzana=$_POST['Manzana'];
$fecha=date("Y-m-d");
$hora=date("h:i:s");
$descripcion=$_POST['descripcion'];



	$extraeparroquia=mysql_query("SELECT 	bbh_id_parroquia, 
											bbh_canton_id, 
											bbh_tipo_parroquia, 
											bbh_parroquia
											FROM 
											bbh_parroquia 
											WHERE bbh_id_parroquia=$Parroquia2")or die(mysql_error());
	$GETparroquia=mysql_fetch_assoc($extraeparroquia);
	$NomParr=$GETparroquia['bbh_parroquia'];

mysql_query("UPDATE bbh_declaratoria_horizontal 
					SET
					bbh_solicitante_dph = '$Propietario' , 
					bbh_parroquia_dph = '$NomParr' , 
					bbh_calle_dph = '$Calle' , 
					bbh_intercepcion_dph = '$Interseccion' , 
					bbh_barrio_urbanizacion_dph = '$bu' , 
					bbh_num_linea_fab_dph = '$lf' , 
					bbh_manzana_dph = '$Manzana' , 
					bbh_num_lote_dph = '$nl' , 
					bbh_clave_catastral_dph = '$Clave' , 
					bbh_detalle_certificado_dph = '$descripcion' 
					WHERE
					bbh_id_dph = '$id'")or die(mysql_error());

?>
	<script type="text/javascript">
    $(document).ready(function() {
		swal({
  		title: "Correcto!",
  		text: "Los datos se Actualizaron corectamente.",
  		imageUrl: "images/thumbs-up.jpg"
		},
  	function(){
    window.location.href = '../tcpdf/examples/pdf_declaratoria_propiedad_horizontal.php?Doc=<?php echo $id; ?>';
	});
	});
	</script>
<?php
	
}

?>
