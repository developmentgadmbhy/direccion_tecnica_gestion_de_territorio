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

if (isset($_GET['Data'])) {

$documentoID=$_GET['Data'];
$day=date("Y-m-d");
$hora=date("g:i a");



$DataDocument=mysql_query("SELECT 	id_documentos, 
									num_seguimiento, 
									titulo, 
									asunto, 
									remitente, 
									id_tipo_doc, 
									estado_doc, 
									img, 
									tipo, 
									documento_ident
									 
									FROM 
									db_master_bbh.documentos 
									WHERE id_documentos=$documentoID")or die(mysql_error());
$RESDataDoc=mysql_fetch_assoc($DataDocument);
$DataNom=$RESDataDoc['titulo'];
$DataNumseg=$RESDataDoc['num_seguimiento'];

			  mysql_query("INSERT INTO db_master_bbh.recep_documeto 
									(id_doc, 
									id_user, 
									fecha_recp, 
									hora
									)
									VALUES
									('$documentoID', 
									'$idUser1', 
									'$day', 
									'$hora'
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
}
?>

</body>
</html>