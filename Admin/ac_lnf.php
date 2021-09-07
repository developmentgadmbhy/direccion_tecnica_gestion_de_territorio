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

if ($tipoparroquia==1) {
	$sector=$_POST['Ciudadela'];
}elseif ($tipoparroquia==2) {
	$sector=$_POST['Recinto'];
}

	$data='';
	/*$tipo='';

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
  	$ruta = "../certificadosImage/" . $_FILES['image']['name'];
	$resultado = @move_uploaded_file($_FILES["image"]["tmp_name"], $ruta);

	$extraeparroquia=mysql_query("SELECT 	bbh_id_parroquia, 
											bbh_canton_id, 
											bbh_tipo_parroquia, 
											bbh_parroquia
											FROM 
											bbh_parroquia 
											WHERE bbh_id_parroquia=$Parroquia2")or die(mysql_error());
	$GETparroquia=mysql_fetch_assoc($extraeparroquia);
	$NomParr=$GETparroquia['bbh_parroquia'];



mysql_query("UPDATE bbh_certificado_lin_fab 
								SET
								bbh_solicitante_fab = '$Propietario' , 
								bbh_zona_fab = '$Zona' , 
								bbh_parroquia_fab = '$NomParr' , 
								bbh_calle_fab = '$Calle' , 
								bbh_interseccion_fab = '$Interseccion' , 
								bbh_barrio_urbanizacion_fab = '$bu' , 
								bbh_clave_catastral_fab = '$Clave' , 
								bbh_superficie_fab = '$Superficie' , 
								bbh_manzana_fab = '$Manzana' , 
								bbh_lote_fab = '$Lote' , 
								bbh_frente_fab = '$Frente' , 
								bbh_imagen_croquis_fab = '$data' , 
								bbh_tipo_img_fab = '$ruta' , 
								bbh_zonif_id = '$zonificacion' , 
								bbh_calle_fab_md = '$dvc' , 
								bbh_interseccion_fab_md = '$dvi' , 
								bbh_agua = '$c1' , 
								bbh_electricida = '$c2' , 
								bbh_calzada = '$c3' , 
								bbh_bordillos = '$c4' , 
								bbh_alcantarillado = '$c5' , 
								bbh_telefono = '$c6' , 
								bbh_aceras = '$c7' , 
								bbh_relleno = '$c8'
								WHERE
								bbh_id_cert_lin_fab = '$id'")or die(mysql_error());

?>
	<script type="text/javascript">
    $(document).ready(function() {
		swal({
  		title: "Correcto!",
  		text: "Los datos se Actualizaron corectamente.",
  		imageUrl: "images/thumbs-up.jpg"
		},
  	function(){
    window.location.href = '../tcpdf/examples/pdf_certificado_linea_fabrica.php?Doc=<?php echo $id; ?>';
	});
	});
	</script>
<?php
	
}

?>