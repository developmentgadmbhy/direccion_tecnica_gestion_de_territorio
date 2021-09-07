<?php
include '../../Connections/RootSistemas_Conexion_masterWeb.php';
if (!isset($_SESSION)) {
  session_start();
}

/******* DATOS SELECT CANTON***********/
if (isset($_POST['Provincias'])) {

$IdProvinc=$_POST['Provincias'];
$viewProvinc=mysql_query("SELECT bbh_id_canton, 
								 bbh_provincia_id, 
								 bbh_canton
								 FROM 
								 bbh_canton 
								 WHERE bbh_provincia_id=$IdProvinc")or die(mysql_error());
			$html .= '<option value="">Seleccione una opcion...</option>';
			while ($fila=mysql_fetch_array($viewProvinc)) {
            $html .= '<option value="'.$fila[0].'">'.$fila[2].'</option>';
            }

            echo $html;
}
/**************************************/

/******* DATOS SELECT PARROQUIA URBANA***********/
if (isset($_POST['Canton'])) {

$IdCanton=$_POST['Canton'];
$viewProvinc=mysql_query("SELECT 	bbh_id_parroquia, 
									bbh_canton_id, 
									bbh_tipo_parroquia, 
									bbh_parroquia
									FROM 
									bbh_parroquia 
									WHERE bbh_canton_id=$IdCanton and bbh_tipo_parroquia=1")or die(mysql_error());
			$html .= '<option value="">Seleccione una opcion...</option>';
			while ($fila=mysql_fetch_array($viewProvinc)) {
            $html .= '<option value="'.$fila[0].'">'.$fila[3].'</option>';
            }

            echo $html;
}
/**************************************/


/******* DATOS SELECT PARROQUIA URBANA***********/
if (isset($_POST['Canton1'])) {

$IdCanton=$_POST['Canton1'];
$viewProvinc=mysql_query("SELECT 	bbh_id_parroquia, 
									bbh_canton_id, 
									bbh_tipo_parroquia, 
									bbh_parroquia
									FROM 
									bbh_parroquia 
									WHERE bbh_canton_id=$IdCanton and bbh_tipo_parroquia=2")or die(mysql_error());
			$html .= '<option value="">Seleccione una opcion...</option>';
			while ($fila=mysql_fetch_array($viewProvinc)) {
            $html .= '<option value="'.$fila[0].'">'.$fila[3].'</option>';
            }

            echo $html;
}
/**************************************/


/******* DATOS SELECT CIUDADELA***********/
if (isset($_POST['Parroquia'])) {

$IdParroquia=$_POST['Parroquia'];
$viewProvinc=mysql_query("SELECT 	bbh_id_ciudadela, 
									bbh_parroquia_id, 
									bbh_ciudadela
									FROM 
									bbh_ciudadela 
									WHERE bbh_parroquia_id=$IdParroquia")or die(mysql_error());
			$html .= '<option value="">Seleccione una opcion...</option>';
			while ($fila=mysql_fetch_array($viewProvinc)) {
            $html .= '<option value="'.$fila[0].'">'.$fila[2].'</option>';
            }

            echo $html;
}
/**************************************/


/******* DATOS SELECT RECINTO***********/
if (isset($_POST['Parroquia1'])) {

$IdParroquia=$_POST['Parroquia1'];
$viewProvinc=mysql_query("SELECT 	bbh_id_recinto, 
									bbh_parroquia_id, 
									bbh_recinto
									FROM 
									bbh_recinto 
									WHERE bbh_parroquia_id=$IdParroquia")or die(mysql_error());
			$html .= '<option value="">Seleccione una opcion...</option>';
			while ($fila=mysql_fetch_array($viewProvinc)) {
            $html .= '<option value="'.$fila[0].'">'.$fila[2].'</option>';
            }

            echo $html;
}
/**************************************/


/********************caonsultas************************/

/******* DATOS SELECT PARROQUIAS***********/
if (isset($_POST['tipoparroquia'])) {

$tipoparroquia=$_POST['tipoparroquia'];
$_SESSION['tipo']=$tipoparroquia;
$viewProvinc=mysql_query("SELECT 	bbh_id_parroquia, 
									bbh_canton_id, 
									bbh_tipo_parroquia, 
									bbh_parroquia
									FROM 
									bbh_parroquia 
									WHERE bbh_canton_id=2 and bbh_tipo_parroquia=$tipoparroquia")or die(mysql_error());
			$html .= '<option value="">Seleccione una opcion...</option>';
			while ($fila=mysql_fetch_array($viewProvinc)) {
            $html .= '<option value="'.$fila[0].'">'.$fila[3].'</option>';
            }

            echo $html;
}
/**************************************/


/******* DATOS PARROQUIAS INDISTINTAS***********/
if (isset($_POST['Parroquia2'])) {

$Parroquia2=$_POST['Parroquia2'];
$tipoparroquia=$_SESSION['tipo'];

if ($tipoparroquia==1) {
$viewData=mysql_query("SELECT 	bbh_id_ciudadela, 
									bbh_parroquia_id, 
									bbh_ciudadela
									FROM 
									bbh_ciudadela 
									WHERE bbh_parroquia_id=$Parroquia2")or die(mysql_error());
}

if ($tipoparroquia==2) {
$viewData=mysql_query("SELECT 	bbh_id_recinto, 
									bbh_parroquia_id, 
									bbh_recinto 
									FROM 
									bbh_recinto 
									WHERE bbh_parroquia_id=$Parroquia2")or die(mysql_error());
}
			$html .= '<option value="">Seleccione una opcion...</option>';
			while ($fila=mysql_fetch_array($viewData)) {
            $html .= '<option value="'.$fila[2].'">'.$fila[2].'</option>';
            }

            echo $html;
}
/**************************************/


?>
