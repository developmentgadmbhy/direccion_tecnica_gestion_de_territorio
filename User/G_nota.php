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

$idUser=$_SESSION['MM_ID_USER'];
if (isset($_POST['calificacion'])) {

	$calificacion=$_POST['calificacion'];
	$incidencia=$_POST['incidencia'];
	 

	mysql_query("INSERT INTO db_master_bbh.calificaciontecnico 
								(Calificacion, 
								id_Usuario, 
								id_incidencia
								)
								VALUES
								('$calificacion', 
								'$idUser', 
								'$incidencia'
								)")or die(mysql_error());
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
	//
	}
	//header("location:viewDepartamento.php");
	?>
</body>
</html>
