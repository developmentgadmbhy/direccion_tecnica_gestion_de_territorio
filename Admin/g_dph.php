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


    $result = mysql_query("SELECT 	MAX(bbh_id_dph)	FROM bbh_declaratoria_horizontal ");
    $row = mysql_fetch_row($result);
    $highest_id = $row[0]+1;

	$archivo = "../plugins/txt/propiedadh.txt";
	$contador = 0;

	$fp = fopen($archivo,"r");
	$contador = fgets($fp, 26);
	$arng = explode(' ', $contador);
	$contador=$arng[0];
	$year=$arng[1];
	$yr=date("Y");

	if ($year<$yr) {
	$year=$yr;
	$contador=0;
	}

	fclose($fp);

	++$contador;

	$cadena=(string)$contador;
	$num=strlen($cadena);
	$car='';

 	for($a=$num-1; $a>=0; $a--){
    $car= $car.$cadena[$a];
 	}

 	 $numeracion = array('0'=>'No.', '1'=>0, '2'=>0, '3'=>0, '4'=>0, '4'=>0);
  	 $text=implode($numeracion);
  //   echo($text);
  	$RET=array_reverse($numeracion);

	for ($i=0; $i < strlen($car) ; $i++) { 
 	  $RET[$i]=$car[$i];    
 	 }
 
    $numsegi= implode(array_reverse($RET));


$GETDatos=mysql_query("INSERT INTO bbh_declaratoria_horizontal 
								   (bbh_numero_oficio_dph, 
								   bbh_solicitante_dph, 
								   bbh_parroquia_dph, 
								   bbh_calle_dph, 
								   bbh_intercepcion_dph, 
								   bbh_barrio_urbanizacion_dph, 
								   bbh_num_linea_fab_dph, 
								   bbh_manzana_dph, 
								   bbh_num_lote_dph, 
								   bbh_clave_catastral_dph, 
								   bbh_detalle_certificado_dph, 
								   bbh_usuario_id_dph, 
								   bbh_fecha_dph, 
								   bbh_hora_dph
								   )
								   VALUES
								   ('$numsegi', 
								   '$Propietario', 
								   '$NomParr', 
								   '$Calle', 
								   '$Interseccion', 
								   '$bu', 
								   '$lf', 
								   '$Manzana', 
								   '$nl', 
								   '$Clave', 
								   '$descripcion', 
								   '$id_Usuario', 
								   '$fecha', 
								   '$hora')")or die(mysql_error());
	$contador = $contador.' '.$year;
	$fp = fopen($archivo,"w+");
	fwrite($fp, $contador, 26);
	fclose($fp);
?>
	<script type="text/javascript">
    $(document).ready(function() {
		swal({
  		title: "Correcto!",
  		text: "Los datos se guardaron corectamente.",
  		imageUrl: "images/thumbs-up.jpg"
		},
  	function(){
    window.location.href = '../tcpdf/examples/pdf_declaratoria_propiedad_horizontal.php?Doc=<?php echo $highest_id; ?>';
	});
	});
	</script>
<?php
	
}

?>