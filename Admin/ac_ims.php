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
$tipoparroquia=$_POST['tipoparroquia'];
$Parroquia2=$_POST['Parroquia2'];
$Clave=$_POST['Clave'];
$Manzana=$_POST['Manzana'];
$Superficie=$_POST['Superficie'];
$Solar=$_POST['Solar'];
$Sector=$_POST['Sector'];
$NORTE=$_POST['NORTE'];
$CN=$_POST['CN'];
$SUR=$_POST['SUR'];
$CS=$_POST['CS'];
$ESTE=$_POST['ESTE'];
$CE=$_POST['CE'];
$OESTE=$_POST['OESTE'];
$CO=$_POST['CO'];
$OBSERVACION=$_POST['OBSERVACION'];
$fecha=date("Y-m-d");
$hora=date("h:i:s");

	# code...

/*
if ($tipoparroquia==1) {
	$sector=$_POST['Ciudadela'];
}elseif ($tipoparroquia==2) {
	$sector=$_POST['Recinto'];
}
*/
	$extraeparroquia=mysql_query("SELECT 	bbh_id_parroquia, 
											bbh_canton_id, 
											bbh_tipo_parroquia, 
											bbh_parroquia
											FROM 
											bbh_parroquia 
											WHERE bbh_id_parroquia=$Parroquia2")or die(mysql_error());
	$GETparroquia=mysql_fetch_assoc($extraeparroquia);
	$NomParr=$GETparroquia['bbh_parroquia'];
if (!isset($_POST['Ren'])) {
mysql_query("UPDATE bbh_informe_ms 
	SET
	bbh_solicitante_ms = '$Propietario' , 
	bbh_superficie_ms = '$Superficie' , 
	bbh_manzana_ms = '$Manzana' , 
	bbh_solar_ms = '$Solar' , 
	bbh_parroquia_ms = '$NomParr' , 
	bbh_codigo_catastral_ms = '$Clave' , 
	bbh_sector_ms = '$Sector' , 
	bbh_limite_norte_ms = '$NORTE' , 
	bbh_ln_ms = '$CN' , 
	bbh_limite_sur_ms = '$SUR' , 
	bbh_ls_ms = '$CS' , 
	bbh_limite_este_ms = '$ESTE' , 
	bbh_le_ms = '$CE' , 
	bbh_limite_oeste_ms = '$OESTE' , 
	bbh_lo_ms = '$CO' , 
	bbh_observacion_ms = '$OBSERVACION' 
	WHERE
	bbh_id_infr_ms = '$id'")or die(mysql_error());

}elseif (isset($_POST['Ren'])) {

	mysql_query("UPDATE bbh_informe_ms 
	SET
	bbh_solicitante_ms = '$Propietario' , 
	bbh_superficie_ms = '$Superficie' , 
	bbh_manzana_ms = '$Manzana' , 
	bbh_solar_ms = '$Solar' , 
	bbh_parroquia_ms = '$NomParr' , 
	bbh_codigo_catastral_ms = '$Clave' , 
	bbh_sector_ms = '$Sector' , 
	bbh_limite_norte_ms = '$NORTE' , 
	bbh_ln_ms = '$CN' , 
	bbh_limite_sur_ms = '$SUR' , 
	bbh_ls_ms = '$CS' , 
	bbh_limite_este_ms = '$ESTE' , 
	bbh_le_ms = '$CE' , 
	bbh_limite_oeste_ms = '$OESTE' , 
	bbh_lo_ms = '$CO' , 
	bbh_observacion_ms = '$OBSERVACION',
	bbh_fecha_ms = '$fecha' , 
	bbh_hora_ms = '$hora'
	WHERE
	bbh_id_infr_ms = '$id'")or die(mysql_error());

}
?>
	<script type="text/javascript">
    $(document).ready(function() {
		swal({
  		title: "Correcto!",
  		text: "Los datos se Actualizaron corectamente.",
  		imageUrl: "images/thumbs-up.jpg"
		},
  	function(){
    window.location.href = '../tcpdf/examples/pdf_informe_medicion_solar.php?Doc=<?php echo $id; ?>';
	});
	});
	</script>
<?php
	
}

?>