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
if (isset($_POST['idUser'])) {

	$idUser=$_POST['idUser'];
	$Usuario=$_POST['Usuario'];
	$Pass=md5($_POST['Pass']);

        mysql_query("UPDATE bbh_usuario 
									SET 
									bbh_usuario = '$Usuario' , 
									bbh_pass = '$Pass' 
									WHERE
									bbh_id_usuario = $idUser")or die(mysql_error());
	?>

	<script type="text/javascript">
    $(document).ready(function() {
		swal({
  		title: "Correcto!",
  		text: "Los datos se Actualizaron corectamente.",
  		imageUrl: "images/thumbs-up.jpg"
		},
  	function(){
    window.location.href = 'index.php';
	});
	});
	</script>

	<?php

}
?>

</body>
</html>