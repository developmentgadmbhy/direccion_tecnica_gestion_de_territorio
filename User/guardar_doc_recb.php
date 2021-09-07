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
$idUser1=$_SESSION['MM_ID_USER'];
if (isset($_POST['NDoc'])) {
/*
  $numeracion = $array=['0'=>'DC', '1'=>0, '2'=>0, '3'=>0, '4'=>0, '4'=>0, '6'=>0, '7'=>0, '8'=>0, '9'=>0, '10'=>0, '11'=>0, '12'=>0, '13'=>0, '14'=>0];
  $text=implode($numeracion);
  //   echo($text);
  $RET=array_reverse($numeracion);
  // echo implode(array_reverse($numeracion));
 */ 
             
$NDoc=$_POST['NDoc'];
$tipo_dct=$_POST['tipo'];
$Asunto=$_POST['Asunto'];
$Remitente=$_POST['Remitente'];
$documento_ident=$_POST['documento_ident'];
$day=date("Y-m-d");
$hora=date("g:i a");
//$foto=$_POST['foto'];
//$idUser=$_POST['Tecnico'];
	$data='';
	$tipo='';
/*
if ($_FILES['foto']['tmp_name']!=""){ 

	// Archivo temporal
        $imagen_temporal = $_FILES['foto']['tmp_name'];
 
        // Tipo de archivo
        $tipo = $_FILES['foto']['type'];
 
        // Leemos el contenido del archivo temporal en binario.
        $fp = fopen($imagen_temporal, 'r+b');
        $data = fread($fp, filesize($imagen_temporal));
        fclose($fp);
 
        //Podríamos utilizar también la siguiente instrucción en lugar de las 3 anteriores.
        // $data=file_get_contents($imagen_temporal);
 
        // Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
        $data = mysql_escape_string($data);
  }*/

$idmx=mysql_query("SELECT MAX(id_documentos) AS id FROM documentos")or die(mysql_error());
$get=mysql_fetch_assoc($idmx);
$idMaxt=$get['id']+1;

$cadena=(string)$idMaxt;
$num=strlen($cadena);
$car='';

 for($a=$num-1; $a>=0; $a--){
    $car= $car.$cadena[$a];
 }


  $numeracion = array('0'=>'DC', '1'=>0, '2'=>0, '3'=>0, '4'=>0, '4'=>0, '6'=>0, '7'=>0, '8'=>0, '9'=>0, '10'=>0, '11'=>0, '12'=>0, '13'=>0, '14'=>0);
  $text=implode($numeracion);
  //   echo($text);
  $RET=array_reverse($numeracion);

for ($i=0; $i < strlen($car) ; $i++) { 
   $RET[$i]=$car[$i];    
  }
  $numsegi= implode(array_reverse($RET));


$target_path = "doc/";
$target_path = $target_path . basename( $_FILES['doc']['name']); if(move_uploaded_file($_FILES['doc']['tmp_name'], $target_path)) { echo "El archivo ". basename( $_FILES['doc']['name']). " ha sido subido";
$nom_doc=$_FILES['doc']['name'];
} else{
echo "Ha ocurrido un error, trate de nuevo!";
} 


	mysql_query("INSERT INTO db_master_bbh.documentos 
										(num_seguimiento, 
										titulo, 
										asunto, 
										remitente, 
										id_tipo_doc, 
										estado_doc, 
										documento_ident,
										usuario_id,
										nom_documento
										)
										VALUES
										('$numsegi', 
										'$NDoc', 
										'$Asunto', 
										'$Remitente', 
										'$tipo_dct', 
										'0', 
										'$documento_ident',
										'$idUser1',
										'$nom_doc'
										)")or die(mysql_error());
/*
// recepcion de documentos 
	$idmxdoc=mysql_query("SELECT MAX(id_documentos) AS id FROM documentos")or die(mysql_error());
	$resdoc=mysql_fetch_assoc($idmxdoc);
	$maxdoc=$resdoc['id'];

	mysql_query("INSERT INTO db_master_bbh.recep_documeto 
											(id_doc, 
											id_user, 
											fecha_recp, 
											hora
											)
											VALUES
											('$maxdoc', 
											'$idUser1', 
											'$day', 
											'$hora')")or die(mysql_error());
*/
?>

	<script type="text/javascript">
   $(document).ready(function() {
	swal({
  	title: "Correcto!",
  	text: "Los datos se guardaron corectamente.",
  	imageUrl: "images/thumbs-up.jpg"
	},
  	function(){
    window.location.href = 'index.php';
	});

	});
	//window.location="http://www.cristalab.com";
	</script>

<?php
}
?>

</body>
</html>