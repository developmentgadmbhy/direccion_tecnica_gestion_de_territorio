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
$descripcion=$_POST['descripcion'];
$norte=$_POST['norte'];
$este=$_POST['este'];
$tipoDes=$_POST['tipodes'];
$sur=$_POST['sur'];
$oeste=$_POST['oeste'];
$numds=$_POST['numds'];
//$tipoDes=$_POST['tipodes'];

$fecha=date("Y-m-d");
$hora=date("h:i:s");



    $result = mysql_query("SELECT 	MAX(bbh_id_desm) FROM bbh_desmenbracion ");
    $row = mysql_fetch_row($result);
    $highest_id = $row[0]+1;

	$archivo = "../plugins/txt/desmem.txt";
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

 	 $numeracion = array('0'=>0, '1'=>0, '2'=>0, '3'=>0, '4'=>0, '4'=>0, '6'=>'-DTGT');
  	 $text=implode($numeracion);
  //   echo($text);
  	$RET=array_reverse($numeracion);

	for ($i=0; $i < strlen($car) ; $i++) { 
 	  $RET[$i]=$car[$i];    
 	 }
 
    $numsegi= implode(array_reverse($RET));

$GETDatos=mysql_query("INSERT INTO bbh_desmenbracion 
									(bbh_numero_desmen, 
									bbh_descripcion_desm, 
									bbh_delm_norte, 
									bbh_delm_sur, 
									bbh_delm_este, 
									bbh_delm_oeste, 
									bbh_aclaratoria_dems, 
									bbh_solicitante_dems, 
									bbh_fecha_dems, 
									bbh_hora__dems, 
									bbh_id_usuario, 
									bbh_tipo_desm
									)
									VALUES
									(' $numsegi', 
									'$descripcion', 
									'$norte', 
									'$sur', 
									'$este', 
									'$oeste', 
									'', 
									'$Propietario', 
									'$fecha', 
									'$hora', 
									'$id_Usuario', 
									'$tipoDes' )")or die(mysql_error());
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
    window.location.href = 'form_espef.php?Doc=<?php echo $highest_id; ?>&Data=<?php echo $numds; ?>';
	});
	});
	</script>
<?php
	
}

?>
