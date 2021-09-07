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


if (isset($_POST['especificacionDesmem'])) {
	
$norte=$_POST['norte'];
$este=$_POST['este'];
$sur=$_POST['sur'];
$oeste=$_POST['oeste'];
$descripcion=$_POST['descripcion'];
$id_desmen=$_POST['id_desmen'];

$especificacionDesmem=$_POST['especificacionDesmem'];
$fecha=date("Y-m-d");
$hora=date("h:i:s");

if(isset($_POST['delete'])){
 	mysql_query("DELETE FROM bbh_certif.bbh_desmenbracion_sl_d 
	WHERE
	bbh_id_desmenb = $id_desmen")or die(mysql_error());
}


$numero=0;

		foreach ($_POST['descripcion'] as $descripcion){
			   
			   $Ln=$_POST["norte"][$numero];
			   $Le=$_POST["este"][$numero];
			   $Ls=$_POST["sur"][$numero];
			   $Lo=$_POST["oeste"][$numero];
			  // $desprecio=$_POST["descripcio"][$numero];

			   $caden="INSERT INTO bbh_desmenbracion_sl_d 
									(bbh_id_desmenb, 
									bbh_aclaratoria_sl_dem, 
									bbh_delm_norte_sl_d, 
									bbh_delm_sur_sl_d, 
									bbh_delm_este_sl_d, 
									bbh_delm_oeste_sl_d
									)
									VALUES
									('$id_desmen', 
									'$descripcion', 
									'$Ln', 
									'$Ls', 
									'$Le', 
									'$Lo'
									)";
			    mysql_query($caden)or die(mysql_error());
				$regist=1; 
				$numero++;

		}
		

mysql_query("UPDATE bbh_desmenbracion 
					SET
					bbh_aclaratoria_dems = '$especificacionDesmem' 
					WHERE
					bbh_id_desm = $id_desmen")or die(mysql_error());	


?>
	<script type="text/javascript">
    $(document).ready(function() {
		swal({
  		title: "Correcto!",
  		text: "Los datos se guardaron corectamente.",
  		imageUrl: "images/thumbs-up.jpg"
		},
  	function(){
    window.location.href = '../tcpdf/examples/pdf_desmembracion.php?Doc=<?php echo $id_desmen; ?>';
	});
	});
	</script>
<?php
	
}

?>
