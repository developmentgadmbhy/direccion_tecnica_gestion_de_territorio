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
if (isset($_POST['Propietario'])) {
	
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



	$extraeparroquia=mysql_query("SELECT 	bbh_id_parroquia, 
											bbh_canton_id, 
											bbh_tipo_parroquia, 
											bbh_parroquia
											FROM 
											bbh_parroquia 
											WHERE bbh_id_parroquia=$Parroquia2")or die(mysql_error());
	$GETparroquia=mysql_fetch_assoc($extraeparroquia);
	$NomParr=$GETparroquia['bbh_parroquia'];


    $result = mysql_query("SELECT 	MAX(bbh_id_infr_ms)	FROM bbh_informe_ms ");
    $row = mysql_fetch_row($result);
    $highest_id = $row[0]+1;

	$archivo = "../plugins/txt/informems.txt";
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

 	 $numeracion = array('0'=>'No.', '1'=>0, '2'=>0, '3'=>0, '4'=>0, '4'=>0, '6'=>0, '7'=>0, '8'=>0);
  	 $text=implode($numeracion);
  //   echo($text);
  	$RET=array_reverse($numeracion);

	for ($i=0; $i < strlen($car) ; $i++) { 
 	  $RET[$i]=$car[$i];    
 	 }
 
    $numsegi= implode(array_reverse($RET));


$GETDatos=mysql_query("INSERT INTO bbh_informe_ms 
								    (bbh_mun_inf_ms, 
								    bbh_solicitante_ms, 
								    bbh_superficie_ms, 
								    bbh_manzana_ms, 
								    bbh_solar_ms, 
								    bbh_parroquia_ms, 
								    bbh_codigo_catastral_ms, 
								    bbh_sector_ms, 
								    bbh_limite_norte_ms, 
								    bbh_ln_ms, 
								    bbh_limite_sur_ms, 
								    bbh_ls_ms, 
								    bbh_limite_este_ms, 
								    bbh_le_ms, 
								    bbh_limite_oeste_ms, 
								    bbh_lo_ms, 
								    bbh_observacion_ms, 
								    bbh_usuario_id_ms, 
								    bbh_fecha_ms, 
								    bbh_hora_ms
								    )
								    VALUES
								    ('$numsegi', 
								    '$Propietario', 
								    '$Superficie', 
								    '$Manzana', 
								    '$Solar', 
								    '$NomParr', 
								    '$Clave', 
								    '$Sector', 
								    '$NORTE', 
								    '$CN', 
								    '$SUR', 
								    '$CS', 
								    '$ESTE', 
								    '$CE', 
								    '$OESTE', 
								    '$CO', 
								    '$OBSERVACION', 
								    '$id_Usuario', 
								    '$fecha', 
								    '$hora'
								    )")or die(mysql_error());
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
    window.location.href = '../tcpdf/examples/pdf_informe_medicion_solar.php?Doc=<?php echo $highest_id; ?>';
	});
	});
	</script>
<?php
	
}

?>
