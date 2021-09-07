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
	
//$nums=$_POST['nums'];
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

   $result = mysql_query("SELECT MAX(bbh_id_permiso_cont_pc) FROM bbh_permiso_construccion");
    $row = mysql_fetch_row($result);
    $highest_id = $row[0]+1;


	$archivo = "../plugins/txt/permisoc.txt";
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

 	 $numeracion = array('0'=>'#PC/', '1'=>0, '2'=>0, '3'=>0, '4'=>0, '5'=>0, '6'=>0, '7'=>0, '8'=>0, '9'=>0, '10'=>0, '11'=>0, '12'=>0, '13'=>0, '14'=>0);
  	 $text=implode($numeracion);
  //   echo($text);
     $RET=array_reverse($numeracion);
  	 
	for ($i=0; $i < strlen($car); $i++) { 
 	   $RET[$i]=$car[$i];  
 	 }
 
    $numsegi= implode(array_reverse($RET));


$GETDatos=mysql_query("INSERT INTO bbh_permiso_construccion 
								   (bbh_numero_permiso_pc, 
								   bbh_propietario_pc, 
								   bbh_parroquia_pc, 
								   bbh_sector_pc, 
								   bbh_calle_pc, 
								   bbh_clave_catastral_pc, 
								   bbh_descripcion_pc, 
								   bbh_area_pc, 
								   bbh_usuario_id_pc, 
								   bbh_fecha_pc, 
								   bbh_hora_pc
								   )
								   VALUES
								   ('$numsegi', 
								   '$Propietario', 
								   '$NomParr', 
								   '$sector', 
								   '$Calle', 
								   '$Clave', 
								   '$descripcion', 
								   '$Area', 
								   '$id_Usuario', 
								   '$fecha', 
								   '$hora'
								   )")or die(mysql_error());
	 $contador = $contador.' '.$year;
	$fp = fopen($archivo,"w+")or die("No se pudo abrir");
	fwrite($fp, $contador, 26)or die("No se pudo escribir");
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
    window.location.href = '../tcpdf/examples/pdf_permiso_construcccion.php?Doc=<?php echo $highest_id; ?>';
	});
	});
	</script>
<?php
	
}

?>