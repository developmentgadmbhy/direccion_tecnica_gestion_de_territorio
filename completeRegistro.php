<!DOCTYPE html>
<html>
<head>
 <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="alertmaster/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="alertmaster/dist/sweetalert.css">
</head>
<body>
<?php 
include 'Connections/RootSistemas_Conexion_masterWeb.php';

if (isset($_GET['DataRegistre'])) {
	
	 $Cadena=$_GET['DataRegistre'];
//echo "<br>";
	$name=(explode( '/', $Cadena ) );
	//$apell=( explode( ' ', $Apellidos ) );
	//$name1=$name[0];
	 $CadenaComfirmacion = $name[0];
	//echo "<br>";
	 $user=$name[1];

$GetData=mysql_query("SELECT 	id, 
								idUser, 
								acceso
								FROM 
								db_master_bbh.accesregister 
								WHERE  acceso='$CadenaComfirmacion'")or die(mysql_error());
//echo "<br>";
 $NumData=mysql_num_rows($GetData);
$VerUser=mysql_fetch_assoc($GetData);

 $idu=$VerUser['idUser'];

if ($NumData>0) {
	
	mysql_query("UPDATE db_master_bbh.usuario 
	SET 
	Estado = 'A'
	WHERE
	idUsuario = '$idu'")or die(mysql_error());

	mysql_query("UPDATE db_master_bbh.accesregister 
	SET
	acceso = 'Null'
	
	WHERE acceso='$CadenaComfirmacion'")or die(mysql_error());

	?>

	<script type="text/javascript">
	
    $(document).ready(function() {
		swal({
  			title: "Correcto!",
  			text: "Ya puedes comenzar.",
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

else {
	?>

	<script type="text/javascript">
	
    $(document).ready(function() {
		swal({
  			title: "Error!",
  			text: "Ah Ocurrido un Error verifica los Datos.",
  			imageUrl: "images/error.png"
		},
  	function(){
    window.location.href = 'index.php';
		});

	});
	//window.location="http://www.cristalab.com";
	</script>

	<?php
}

}
?>