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
$Clave=$_POST['Clave'];
$descripcion=$_POST['descripcion'];
$zonificacion=$_POST['zonificacion'];
$descripcion2=$_POST['descripcion2'];
$fecha=date("Y-m-d");
$hora=date("h:i:s");



    $result = mysql_query("SELECT 	MAX(bbh_id_cert_uso_suelo) FROM bbh_cert_uso_suelo ");
    $row = mysql_fetch_row($result);
    $highest_id = $row[0]+1;

    $archivo = "../plugins/txt/usosuelo.txt";
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

 	 $numeracion = array('0'=>0, '1'=>0, '2'=>0, '3'=>0, '4'=>0, '4'=>0, '6'=>0, '7'=>0, '8'=>0, '9'=>0, '10'=>'-US-DTGT');
  	 $text=implode($numeracion);
  //   echo($text);
  	$RET=array_reverse($numeracion);

	for ($i=0; $i < strlen($car) ; $i++) { 
 	  $RET[$i]=$car[$i];    
 	 }
 
    $numsegi= implode(array_reverse($RET));

$GETDatos=mysql_query("INSERT INTO bbh_cert_uso_suelo 
									(bbh_num_ofic_usl, 
									bbh_solicitante_usl, 
									bbh_descripcion_usl, 
									bbh_local_descripcion_usl, 
									bbh_usuario_id, 
									bbh_fecha_usl, 
									bbh_hora_usl, 
									bbh_zonif_id, 
									bbh_clave_usl
									)
									VALUES
									('$numsegi', 
									'$Propietario', 
									'$descripcion', 
									'$descripcion2', 
									'$id_Usuario', 
									'$fecha', 
									'$hora', 
									'$zonificacion', 
									'$Clave')")or die(mysql_error());
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
    window.location.href = '../tcpdf/examples/pdf_certificado_uso_suelo.php?Doc=<?php echo $highest_id; ?>';
	});
	});
	</script>
<?php
	
}

?>