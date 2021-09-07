<?php
header( 'Content-type: text/html; charset=iso-8859-1' );
include '../Connections/RootSistemas_Conexion_masterWeb.php';
$search = $_POST['service'];

$query_services = mysql_query("SELECT 	idPersona, 
	Cedula, 
	Nombres, 
	Apellidos, 
	Telefono, 
	Email, 
	Foto, 
	id_Cargo, 
	type, 
	iddepartamento
	FROM 
	db_master_bbh.persona  WHERE Nombres like '" . $search . "%'  ORDER BY idPersona DESC")or die(mysql_error());
while ($row_services = mysql_fetch_array($query_services)) {
    echo '<div class="suggest-element">
    <a data="'.$row_services[2].'" id="service'.$row_services[0].'">'.utf8_encode($row_services[2]).'</a>
    </div>';
}
?>