<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
if (!isset($_SESSION)) {
	session_start();
}

if(!isset($_SESSION['Liquidacion'])){
	header("location: index.php");
}
include "validationfuntion.php";
$idUser=$_SESSION['MM_ID_USER'];
validar($idUser);

header('Content-Type: text/html; charset=UTF-8');
$msconnect=mssql_connect("SQL2012","sa",'M$p2015');  
$msdb=mssql_select_db("Municipio",$msconnect);  


if (isset($_POST['zona'])) {


	$zona 		= intval($_POST['zona']);
	$sector 	= intval($_POST['sector']);
	$manzana 	= intval($_POST['manzana']);
	$solar 		= intval($_POST['solar']);

	$Div1 		= $_POST['Div1'];
	$Div2 		= $_POST['Div2'];
	$Div3 		= $_POST['Div3'];
	$Div4 		= $_POST['Div4'];

	$PHV 		= $_POST['PHV'];
	$PHH 		= $_POST['PHH'];
	$nombres = '';
	$apellidos = '';

	$avlsolar = 0;
	$avlconstruccion = 0;
	$avlmunicipal = 0;
	$areaSolar = 0;



	$msquery = "SELECT *  FROM PU_PREDIOS
  				where ZONA = $zona and  SECTOR = $sector and MANZANA = $manzana and SOLAR = $solar and DIVISION1 = $Div1 and DIVISION2 = $Div2 and DIVISION3 = $Div3 and DIVISION4 = $Div4 and PHV = $PHV and PHH = $PHH and ESTADO_PREDIO = 'A'";  
  				$msresults= mssql_query(utf8_decode($msquery))or die(mssql_get_last_message());  
  				$row = mssql_fetch_array($msresults);
  				$codPr = $row['CODIGO_PREDIO']; 
  				//$areaSolar = $row['AREA_SOLAR'];  

  	$predio = "SELECT * FROM PU_CATASTRO WHERE CODIGO_PREDIO = $codPr and ES_ACTIVO = 'A' ORDER BY ANIO DESC";  
  				$msresults1= mssql_query(utf8_decode($predio))or die(mssql_get_last_message());  
 				$row1 = mssql_fetch_array($msresults1);
 

 				if (strlen($row1['PRIMER_NOMBRE_PROP']) > 0) {
 					$nombres = $nombres.utf8_decode($row1['PRIMER_NOMBRE_PROP']);
 				}else{
 					$nombres = $nombres.utf8_decode($row['PRIMER_NOMBRE_PROP']);
 				}
 				if (strlen(utf8_decode($row1['SEGUNDO_NOMBRE_PROP'])) > 0) {
 					$nombres = $nombres.' '.utf8_decode($row1['SEGUNDO_NOMBRE_PROP']);
 				}else{
 					$nombres = $nombres.' '.utf8_decode($row['SEGUNDO_NOMBRE_PROP']);
 				}
 				if (strlen($row1['APELLIDO_PATERNO_PROP']) > 0) {
 					$apellidos = $apellidos.utf8_decode($row1['APELLIDO_PATERNO_PROP']);
 				}else{
 					$apellidos = $apellidos.utf8_decode($row['APELLIDO_PATERNO_PROP']);
 				}
 				if (strlen($row1['APELLIDO_MATERNO_PROP']) > 0) {
 					$apellidos = $apellidos.' '.utf8_decode($row1['APELLIDO_MATERNO_PROP']);
 				}else{
 					$apellidos = $apellidos.' '.utf8_decode($row['APELLIDO_MATERNO_PROP']);
 				}
 				

 				if (strlen($row['AREA_SOLAR']) > 0) {
 					$areaSolar = $row['AREA_SOLAR'];
 				}else{
 					$areaSolar = $row1['AREA_SOLAR'];
 				}


				if (strlen($row1['AVALUO_SOLAR']) > 0) {
 					$avlsolar = $row1['AVALUO_SOLAR'];
 				}else{
 					$avlsolar = $row['AVALUO_SOLAR'];
 				}

 				if (strlen($row1['AVALUO_CONSTRUCCION']) > 0) {
 					$avlconstruccion = $row1['AVALUO_CONSTRUCCION'];
 				}else{
 					$avlconstruccion = $row['AVALUO_CONSTRUCCION'];
 				}

 				if (strlen($row1['AVALUO_MUNICIPAL']) > 0) {
 					$avlmunicipal = $row1['AVALUO_MUNICIPAL'];
 				}else{
 					$avlmunicipal = $row['AVALUO_MUNICIPAL'];
 				}

  				$user = $row['CODIGO_USUARIO'];
  				$nombres = trim($nombres);
  				$apellidos = trim($apellidos);

  				$datos = array( "AVALUO_SOLAR"=>$avlsolar, "AVALUO_CONSTRUCCION"=>$avlconstruccion, "AVALUO_MUNICIPAL"=>$avlmunicipal, "CODIGO_USUARIO"=>$user, "Nombre"=>$nombres, "apellidos"=>$apellidos, "CEDULA"=>$row1['NUMERO_IDENTIFICACION'], "CODIGO_PREDIO"=>$codPr, "AreaSolar" => $areaSolar);

  				echo json_encode($datos);

				mssql_close($msconnect);
}



if (isset($_POST['C_zona'])) {
	
	$C_coeficiente		=	$_POST['C_coeficiente'];
	$C_tipo				=	$_POST['C_tipo'];
	$C_codigoRubro		=	$_POST['C_codigoRubro'];
	$C_areaSolar		=	$_POST['C_areaSolar'];
	$C_avSolar			=	$_POST['C_avSolar'];
	$C_avConstruccion	=	$_POST['C_avConstruccion'];
	$C_avMunicipal		=	$_POST['C_avMunicipal'];
	$tipoZona			=	$_POST['tipoZona'];

	$C_zona				=	$_POST['C_zona'];
	$C_sector			=	$_POST['C_sector'];
	$C_manzana			=	$_POST['C_manzana'];
	$C_valor			=	$_POST['C_valor'];

	if ($C_tipo	== 4) {


		
		$msquery = "SELECT * FROM PU_VALOR_TRAMITES where ZONA = $C_zona and  SECTOR = $C_sector and MANZANA = $C_manzana";  
  				$msresults= mssql_query(utf8_decode($msquery))or die(mssql_get_last_message());  
  				$row = mssql_fetch_array($msresults);

  		$valorPlaneamiento = $row['PLANEAMIENTO'];

  		$rebro = "SELECT * FROM RT_RUBROS_X_TITULOS WHERE CODIGO_TITULO_REPORTE = $C_codigoRubro";  
  				$msresults1= mssql_query(utf8_decode($rebro))or die(mssql_get_last_message());  

  				$dato = [];

 				while ($fila=mssql_fetch_array($msresults1)) {
 					$dt= array('DESCRIPCION'=>utf8_encode($fila['DESCRIPCION']), 'VALOR'=>floatval($fila['VALOR']), 'CODIGORUBRO'=>$fila['CODIGO_RUBRO'], 'CODIGO_TITULO_REPORTE'=>$C_codigoRubro);
  					array_push($dato, $dt);
 				}

 				$datos['Rubros'] = $dato;

   				# OPRACION
  				$resultado = ($C_valor * $valorPlaneamiento);

  				if ($resultado < 15) {
  					$resultado = 15;
  				}

  				$datos['valorFinal'] = array("valortotal" => ($resultado+abs($datos['Rubros'][1]['VALOR'])), "subTotal"=> $resultado);

  				echo json_encode($datos);

	}


	mssql_close($msconnect);

}



if (isset($_POST['D_id'])) {

	$D_id				=	$_POST['D_id'];
	$D_coeficiente		=	$_POST['D_coeficiente'];
	$D_tipo				=	$_POST['D_tipo'];
	$D_codigoRubro		=	$_POST['D_codigoRubro'];
	$D_areaSolar		=	$_POST['D_areaSolar'];
	$D_avSolar			=	$_POST['D_avSolar'];
	$D_avConstruccion	=	$_POST['D_avConstruccion'];
	$D_avMunicipal		=	$_POST['D_avMunicipal'];

$rebro = "SELECT * FROM RT_RUBROS_X_TITULOS WHERE CODIGO_TITULO_REPORTE = $D_codigoRubro";  
  				$msresults1= mssql_query(utf8_decode($rebro))or die(mssql_get_last_message());  

  				$dato = [];

 				while ($fila=mssql_fetch_array($msresults1)) {
 					$dt= array('DESCRIPCION'=>utf8_encode($fila['DESCRIPCION']), 'VALOR'=>floatval($fila['VALOR']), 'CODIGORUBRO'=>$fila['CODIGO_RUBRO'], 'CODIGO_TITULO_REPORTE'=>$D_codigoRubro);
  					array_push($dato, $dt);
 				}

 				$datos['Rubros'] = $dato;


	if ($D_id == 2) {
		
		$valor = $D_avSolar *  $D_coeficiente;
		if ($valor < 15) {
			$valor = 15;
		}
		$datos['valorFinal'] = array("valortotal" => ($valor+abs($datos['Rubros'][1]['VALOR'])), "subTotal"=> $valor);

	}

	if ($D_id == 6) {
		
		$valor = $D_avConstruccion *  $D_coeficiente;
		if ($valor < 15) {
			$valor = 15;
		}
		$datos['valorFinal'] = array("valortotal" => ($valor+abs($datos['Rubros'][1]['VALOR'])), "subTotal"=> $valor);

	}

		if ($D_id == 8) {
		
		$valor = $D_avMunicipal *  $D_coeficiente;
		if ($valor < 15) {
			$valor = 15;
		}
		$datos['valorFinal'] = array("valortotal" => ($valor+abs($datos['Rubros'][1]['VALOR'])), "subTotal"=> $valor);

	}

	echo json_encode($datos);

	mssql_close($msconnect);

}


if (isset($_POST['E_id'])) {
	
	$E_id			=	$_POST['E_id'];
	$E_tipo			=	$_POST['E_tipo'];
	$E_codigoRubro	=	$_POST['E_codigoRubro'];
	$E_coeficiente	=	$_POST['E_coeficiente'];

	$rebro = "SELECT * FROM RT_RUBROS_X_TITULOS WHERE CODIGO_TITULO_REPORTE = $E_codigoRubro";  
  				$msresults1= mssql_query(utf8_decode($rebro))or die(mssql_get_last_message());  
 				$dato = [];
				$valor = 0;
 				while ($fila=mssql_fetch_array($msresults1)) {
 					$dt= array('DESCRIPCION'=>utf8_encode($fila['DESCRIPCION']), 'VALOR'=>floatval($fila['VALOR']), 'CODIGORUBRO'=>$fila['CODIGO_RUBRO'], 'CODIGO_TITULO_REPORTE'=>$E_codigoRubro);
 					$valor = $valor + floatval($fila['VALOR']);
  					array_push($dato, $dt);
 				}

 				$datos['Rubros'] = $dato;

   				# OPRACION

   				$vl = abs($E_coeficiente)+$valor;

  				$datos['valorFinal'] = array("valortotal" => $vl , "subTotal"=> $E_coeficiente);

  				echo json_encode($datos);
  				mssql_close($msconnect);

}


if (isset($_POST['F_id'])) {
	

	$F_id				=	$_POST['F_id'];
	$F_coeficiente		=	$_POST['F_coeficiente'];
	$F_tipo				=	$_POST['F_tipo'];
	$F_codigoRubro		=	abs($_POST['F_codigoRubro']);
	$F_areaSolar		=	$_POST['F_areaSolar'];
	$F_avSolar			=	$_POST['F_avSolar'];
	$F_avConstruccion	=	$_POST['F_avConstruccion'];
	$F_avMunicipal		=	$_POST['F_avMunicipal'];



	$rebro = "SELECT * FROM RT_RUBROS_X_TITULOS WHERE CODIGO_TITULO_REPORTE=$F_codigoRubro";  
  				$msresults1= mssql_query($rebro)or die(mssql_get_last_message());  
  				//$row1 = mssql_fetch_assoc($msresults1);
  				$dato = [];
  				$valor=0;
 				while ($fila=mssql_fetch_array($msresults1)) {
 					$dt= array('DESCRIPCION'=>utf8_encode($fila['DESCRIPCION']), 'VALOR'=>floatval($fila['VALOR']), 'CODIGORUBRO'=>$fila['CODIGO_RUBRO'], 'CODIGO_TITULO_REPORTE'=>$F_codigoRubro);
 					$valor = $valor + floatval($fila['VALOR']);
  					array_push($dato, $dt);
 				}
 				$datos['Rubros'] = $dato;
   				# OPRACION
  				$datos['valorFinal'] = array("valortotal" => $valor );
  				echo json_encode($datos);
  				mssql_close($msconnect);

}



if (isset($_POST['G_id'])) {
	

	$G_id				=	$_POST['G_id'];
	$G_coeficiente		=	$_POST['G_coeficiente'];
	$G_tipo				=	$_POST['G_tipo'];
	$G_codigoRubro		=	$_POST['G_codigoRubro'];
	$G_areaSolar		=	$_POST['G_areaSolar'];
	$G_avSolar			=	$_POST['G_avSolar'];
	$G_avConstruccion	=	$_POST['G_avConstruccion'];
	$G_avMunicipal		=	$_POST['G_avMunicipal'];
	$G_ValorArea		=	$_POST['G_ValorArea'];


	$rebro = "SELECT * FROM RT_RUBROS_X_TITULOS WHERE CODIGO_TITULO_REPORTE=$G_codigoRubro";  
  				$msresults1= mssql_query($rebro)or die(mssql_get_last_message());  
  				//$row1 = mssql_fetch_assoc($msresults1);
  				$dato = [];
  				$valor=0;
 				while ($fila=mssql_fetch_array($msresults1)) {
 					$dt= array('DESCRIPCION'=>utf8_encode($fila['DESCRIPCION']), 'VALOR'=>floatval($fila['VALOR']), 'CODIGORUBRO'=>$fila['CODIGO_RUBRO'], 'CODIGO_TITULO_REPORTE'=>$G_codigoRubro);
 					$valor = $valor + floatval($fila['VALOR']);
  					array_push($dato, $dt);
 				}
 				$datos['Rubros'] = $dato;

 				$valorSub =  round(floatval($G_avSolar),4) /  round(floatval($G_areaSolar),4);

 				$valorSub =  round(floatval($valorSub),4) *  round(floatval($G_ValorArea),4);

 				$valorSub =  (round(floatval($valorSub),4) * 2)/1000;

 				$valor = floatval($valorSub) + abs($datos['Rubros'][1]['VALOR']);

  				$datos['valorFinal'] = array("valortotal" => round(floatval($valor),4) , "subTotal"=> floatval($valorSub));

  				echo json_encode($datos);

	mssql_close($msconnect);

}


mssql_close($msconnect);

?> 

