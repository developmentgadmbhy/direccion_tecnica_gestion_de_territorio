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
if(isset($_POST['dato'])){

/**************************Provincia****************************/
	if ($_POST['dato']=='1') {
		$Provincia=$_POST['Provincia'];
		mysql_query("INSERT INTO bbh_provincia 
								(bbh_provincia)
								VALUES
								('$Provincia')")or die(mysql_error());	

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
	</script>
<?php
	}
/**************************Provincia*****************************/

/**************************Canton*****************************/
	if ($_POST['dato']=='2') {
		$Provincias=$_POST['Provincias'];
		$Canton=$_POST['Canton'];
		
		mysql_query("INSERT INTO bbh_canton 
								 (bbh_provincia_id, 
								 bbh_canton
								 )
								 VALUES
								 ('$Provincias', 
								 '$Canton'
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
	</script>
<?php
	}
/**************************Canton*****************************/


/**************************Parroqiuia*****************************/
	if ($_POST['dato']=='3') {
		$tipoparroquia=$_POST['tipoparroquia'];
		$Canton=$_POST['Canton'];
		$Parroquia=$_POST['Parroquia'];
		
		mysql_query("INSERT INTO bbh_parroquia 
								 (bbh_canton_id, 
								 bbh_tipo_parroquia, 
								 bbh_parroquia
								 )
								 VALUES
								 ('$Canton', 
								 '$tipoparroquia', 
								 '$Parroquia'
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
	</script>
<?php
	}
/**************************Parroqiuia*****************************/

/**************************Ciudadela*****************************/
	if ($_POST['dato']=='4') {

		$Parroquia=$_POST['Parroquia'];
		$Ciudadela=$_POST['Ciudadela'];
		//$Parroquia=$_POST['Parroquia'];
		
		mysql_query("INSERT INTO bbh_ciudadela 
								 (bbh_parroquia_id, 
								 bbh_ciudadela
								 )
								 VALUES
								 ('$Parroquia', 
								 '$Ciudadela'
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
	</script>
<?php
	}
/**************************Ciudadela*****************************/

/**************************Manzana*****************************/
	if ($_POST['dato']=='5') {

		$Ciudadela=$_POST['Ciudadela'];
		$Manzana=$_POST['Manzana'];
		//$Parroquia=$_POST['Parroquia'];
		
		mysql_query("INSERT INTO bbh_manzana 
								 (bbh_ciudadela_id, 
								 bbh_manzana
								 )
								 VALUES
								 ('$Ciudadela', 
								 '$Manzana'
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
	</script>
<?php
	}
/**************************Manzana*****************************/

/**************************Recinto*****************************/
	if ($_POST['dato']=='6') {

		$Parroquia=$_POST['Parroquia'];
		$Recinto=$_POST['Recinto'];
		
		mysql_query("INSERT INTO bbh_recinto 
								 (bbh_parroquia_id, 
								 bbh_recinto
								 )
								 VALUES
								 ('$Parroquia', 
								 '$Recinto'
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
	</script>
<?php
	}
/**************************Recinto*****************************/

/**************************Sector*****************************/
	if ($_POST['dato']=='7') {

		$Recinto=$_POST['Recinto'];
		$Sector=$_POST['Sector'];
		
		mysql_query("INSERT INTO bbh_sector 
								 (bbh_recinto_id, 
								 bbh_sector
								 )
								 VALUES
								 ('$Recinto', 
								 '$Sector'
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
	</script>
<?php
	}
/**************************Recinto*****************************/


}
?>

</body>
</html>