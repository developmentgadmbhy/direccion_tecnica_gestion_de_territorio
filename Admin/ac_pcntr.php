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
$Calle=$_POST['Calle'];
$Clave=$_POST['Clave'];
$Area=$_POST['Area'];
$descripcion=$_POST['descripcion'];
$fecha=date("Y-m-d");
$hora=date("h:i:s");
if ($tipoparroquia==1) {
	$sector=$_POST['Ciudadela'];
}elseif ($tipoparroquia==2) {
	$sector=$_POST['Recinto'];
}
	$extraeparroquia=mysql_query("SELECT 	bbh_id_parroquia, 
											bbh_canton_id, 
											bbh_tipo_parroquia, 
											bbh_parroquia
											FROM 
											bbh_parroquia 
											WHERE bbh_id_parroquia=$Parroquia2")or die(mysql_error());
	$GETparroquia=mysql_fetch_assoc($extraeparroquia);
	$NomParr=$GETparroquia['bbh_parroquia'];


	/*$car=$id;
 	$numeracion = array('0'=>'#RPC/', '1'=>0, '2'=>0, '3'=>0, '4'=>0, '4'=>0, '6'=>0, '7'=>0, '8'=>0, '9'=>0, '10'=>0, '11'=>0, '12'=>0, '13'=>0);
  	$text=implode($numeracion);
  //   echo($text);
  	$RET=array_reverse($numeracion);

	for ($i=0; $i < strlen($car) ; $i++) { 
 	  $RET[$i]=$car[$i];    
 	 }
 
    $numsegi= implode(array_reverse($RET));
*/
if (isset($_POST['renovar'])) {
	$car=$_POST['renovar'];

	$numsegi=explode('/', $car);
	$numsegi1=$numsegi[0];
	$numsegi2=$numsegi[1];
	$numsegi= '#RPC/'.$numsegi2;
	
   mysql_query("UPDATE bbh_certif.bbh_permiso_construccion 
					SET
					bbh_numero_permiso_pc='$numsegi',
					bbh_propietario_pc = '$Propietario' , 
					bbh_parroquia_pc = '$NomParr' , 
					bbh_sector_pc = '$sector' , 
					bbh_calle_pc = '$Calle' , 
					bbh_clave_catastral_pc = '$Clave' , 
					bbh_descripcion_pc = '$descripcion' , 
					bbh_area_pc = '$Area',
					bbh_fecha_pc = '$fecha' , 
					bbh_hora_pc = '$hora'
					WHERE
					bbh_id_permiso_cont_pc = '$id'")or die(mysql_error());

}elseif (!isset($_POST['renovar'])) {
	
	  mysql_query("UPDATE bbh_certif.bbh_permiso_construccion 
					SET
					bbh_propietario_pc = '$Propietario' , 
					bbh_parroquia_pc = '$NomParr' , 
					bbh_sector_pc = '$sector' , 
					bbh_calle_pc = '$Calle' , 
					bbh_clave_catastral_pc = '$Clave' , 
					bbh_descripcion_pc = '$descripcion' , 
					bbh_area_pc = '$Area' 
					WHERE
					bbh_id_permiso_cont_pc = '$id'")or die(mysql_error());

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
    window.location.href = '../tcpdf/examples/pdf_permiso_construcccion.php?Doc=<?php echo $id; ?>';
	});
	});
	</script>
<?php
	
}

?>