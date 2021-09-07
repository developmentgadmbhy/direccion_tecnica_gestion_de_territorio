<?php

function validar($id){

$idUSER=$id;

$DataUser=mysql_query("SELECT 	bbh_id_usuario, 
	bbh_usuario, 
	bbh_pass, 
	bbh_persona_id, 
	bbh_rol_id
	FROM 
	bbh_usuario 
	WHERE bbh_id_usuario=$idUSER");

$ViewData=mysql_fetch_assoc($DataUser);
$ResData=mysql_num_rows($DataUser);

if ($ResData>0) {
	
}elseif ($ResData==0 && $ViewData['bbh_rol_id']==1) {
	
	header("Location:logout.php");

}

if ($ViewData['bbh_rol_id']!=1) {
	
	header("Location:logout.php");
	
}
 
}

?>