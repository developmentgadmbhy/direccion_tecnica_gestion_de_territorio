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
$Zona=$_POST['Zona'];
$Parroquia2=$_POST['Parroquia2'];
$Clave=$_POST['Clave'];
$Manzana=$_POST['Manzana'];
$bu=$_POST['bu'];
$Frente=$_POST['Frente'];
$Lote=$_POST['Lote'];
$Calle=$_POST['Calle'];
$dvc=$_POST['dvc'];
$Interseccion=$_POST['Interseccion'];
$dvi=$_POST['dvi'];
$Superficie=$_POST['Superficie'];
$zonificacion=$_POST['zonificacion'];
$c1=$_POST['c1'];
$c2=$_POST['c2'];
$c3=$_POST['c3'];
$c4=$_POST['c4'];
$c5=$_POST['c5'];
$c6=$_POST['c6'];
$c7=$_POST['c7'];
$c8=$_POST['c8'];
$fecha=date("Y-m-d");
$hora=date("h:i:s");
/*
if ($tipoparroquia==1) {
	$sector=$_POST['Ciudadela'];
}elseif ($tipoparroquia==2) {
	$sector=$_POST['Recinto'];
}*/

	$data='';
	//$tipo='';
/*
if ($_FILES['image']['tmp_name']!=""){ 

	// Archivo temporal
        $imagen_temporal = $_FILES['image']['tmp_name'];
 
        // Tipo de archivo
        $tipo = $_FILES['image']['type'];
 
        // Leemos el contenido del archivo temporal en binario.
        $fp = fopen($imagen_temporal, 'r+b');
        $data = fread($fp, filesize($imagen_temporal));
        fclose($fp);
 
        //Podríamos utilizar también la siguiente instrucción en lugar de las 3 anteriores.
        // $data=file_get_contents($imagen_temporal);
 
        // Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
        $data = mysql_escape_string($data);
  }
*/

//comprobamos si ha ocurrido un error.
/*if ($_FILES["imagen"]["error"] > 0){
	echo "ha ocurrido un error";
} else {*/
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 100kb
//$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
//$limite_kb = 100;

	//if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
		//esta es la ruta donde copiaremos la imagen
		//recuerden que deben crear un directorio con este mismo nombre
		//en el mismo lugar donde se encuentra el archivo subir.php

		//comprovamos si este archivo existe para no volverlo a copiar.
		//pero si quieren pueden obviar esto si no es necesario.
		//o pueden darle otro nombre para que no sobreescriba el actual.
		//if (!file_exists($ruta)){
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false
			
		/*	if ($resultado){
				echo "el archivo ha sido movido exitosamente";
			} else {
				echo "ocurrio un error al mover el archivo.";
			
		} else {
			echo $_FILES['imagen']['name'] . ", este archivo existe";
		}}*/
	//} else {
	//	echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
	//}
//}



	$extraeparroquia=mysql_query("SELECT 	bbh_id_parroquia, 
											bbh_canton_id, 
											bbh_tipo_parroquia, 
											bbh_parroquia
											FROM 
											bbh_parroquia 
											WHERE bbh_id_parroquia=$Parroquia2")or die(mysql_error());
	$GETparroquia=mysql_fetch_assoc($extraeparroquia);
	$NomParr=$GETparroquia['bbh_parroquia'];


    $result = mysql_query("SELECT 	MAX(bbh_id_cert_lin_fab) FROM bbh_certificado_lin_fab ")or die(mysql_error());
    $row = mysql_fetch_row($result);
    $highest_id = $row[0]+1;
    
    $tip=$_FILES["image"]["type"];
	$ruta = "../certificadosImage/". $highest_id ;
	
	$resultado = @move_uploaded_file($_FILES["image"]["tmp_name"], $ruta);
	
	$archivo = "../plugins/txt/lineaf.txt";
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


				mysql_query("INSERT INTO bbh_certificado_lin_fab 
												(bbh_num_ofic_fab, 
												bbh_solicitante_fab, 
												bbh_zona_fab, 
												bbh_parroquia_fab, 
												bbh_calle_fab, 
												bbh_interseccion_fab, 
												bbh_barrio_urbanizacion_fab, 
												bbh_clave_catastral_fab, 
												bbh_superficie_fab, 
												bbh_manzana_fab, 
												bbh_lote_fab, 
												bbh_frente_fab, 
												bbh_imagen_croquis_fab, 
												bbh_tipo_img_fab, 
												bbh_usuario_id_fab, 
												bbh_fecha_fab, 
												bbh_hota_fab, 
												bbh_zonif_id, 
												bbh_calle_fab_md, 
												bbh_interseccion_fab_md,
												bbh_agua, 
												bbh_electricida, 
												bbh_calzada, 
												bbh_bordillos, 
												bbh_alcantarillado, 
												bbh_telefono, 
												bbh_aceras, 
												bbh_relleno
												)
												VALUES
												('$numsegi', 
												'$Propietario', 
												'$Zona', 
												'$NomParr', 
												'$Calle', 
												'$Interseccion', 
												'$bu', 
												'$Clave', 
												'$Superficie', 
												'$Manzana', 
												'$Lote', 
												'$Frente', 
												'$data', 
												'$ruta', 
												'$id_Usuario', 
												'$fecha', 
												'$hora', 
												'$zonificacion', 
												'$dvc', 
												'$dvi',
										         '$c1', 
												 '$c2', 
												 '$c3', 
												 '$c4', 
												 '$c5', 
												 '$c6', 
												 '$c7', 
												 '$c8'
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
    window.location.href = '../tcpdf/examples/pdf_certificado_linea_fabrica.php?Doc=<?php echo $highest_id; ?>';
	});
	});
	</script>
<?php
	
}

?>