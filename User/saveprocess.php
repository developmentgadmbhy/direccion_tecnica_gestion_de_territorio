<?php
date_default_timezone_set('America/Guayaquil');
include '../Connections/RootSistemas_Conexion_masterWeb.php';
if (!isset($_SESSION)) {
  session_start();
}

if(!isset($_SESSION['Liquidacion'])){
  header("location: index.php");
}

//include "validationfuntion.php";
$idUser=$_SESSION['MM_ID_USER'];
$User=$_SESSION['USER']."-PHP";

$usr = $_SESSION['USER'];
//validar($idUser);

header('Content-Type: text/html; charset=UTF-8');
$msconnect=mssql_connect("SQL2012","sa",'M$p2015');  
$msdb=mssql_select_db("Municipio",$msconnect);  


//var_dump($_POST);


if (isset($_POST['Concepto'])) {

	
	$Concepto	= $_POST['Concepto'];
	$codPredio	= $_POST['codPredio'];
	$codUsuario	= $_POST['codUsuario'];
	$valorestotales	= $_POST['valorestotales'];
	$valorestotales = substr($valorestotales, 0, -1);
	//echo $valorestotales;
	$tipo	= $_POST['tipo'];

	$year = date('Y');
	//$year = 2020;
	$fecha  = date('Y-m-d');

	$valorT = 0;
	$tituloReporte = 0;
	$toralpagar = 0;


	$codUrb = 0;
	$codRural = 0;

	if ($tipo == 1) {
		$codUrb = $codPredio;
	}else{
		$codRural = $codPredio;
	}

	$rebro = "SELECT VALOR_INICIAL  FROM MA_SECUENCIAS 	WHERE CODIGO_APLICACION = 'LIQUIDA_GENERALES'";  
  				$msresults1= mssql_query($rebro)or die(mssql_get_last_message());  
  				
  				$valor=0;
 				while ($fila=mssql_fetch_array($msresults1)) {
 					$valor =  $fila['VALOR_INICIAL'];
 				}

 				$val = abs($valor) + 1;

 				$valorliq = "LQG-".$val;

 				$arrayName = array('liquidacion' => $valorliq );


			$data = explode('|', $valorestotales);


			foreach ($data as $key => $value) {
				$dato 	= explode(',', $value);

				$cotr 	= $dato[1];
				$codRu 	= $dato[0];
				$valR 	= $dato[2];
				$tituloReporte = $dato[1];

				$toralpagar = $toralpagar + $valR;

				$sql = "INSERT INTO RT_RUBROS_X_LIQUIDACION (CODIGO_TITULO_REPORTE ,ANIO_LIQUIDACION ,NUM_COMPROBANTE ,NUM_LIQUIDACION,ID_LIQUIDACION ,CODIGO_RUBRO ,VALOR ,TIPO ,USUARIO_INGRESO ,FECHA_INGRESO)VALUES($cotr ,$year,0 ,$val ,'$valorliq' ,$codRu ,$valR ,'R' ,'$User' ,$fecha)";
				$msresults= mssql_query(utf8_decode($sql))or die(mssql_get_last_message());
				

			}

				$sql2 = " INSERT INTO RT_LIQUIDACION
				           (CODIGO_TITULO_REPORTE
				           ,NUM_COMPROBANTE
				           ,NUM_LIQUIDACION
				           ,CODIGO_USUARIO
				           ,CODIGO_COMPRADOR
				           ,CODIGO_PREDIO
				           ,CODIGO_PREDIO_RUSTICO
				           ,TIPO_LOCAL
				           ,NUM_LOCAL
				           ,NUM_VIA
				           ,ANIO
				           ,NUMERO
				           ,FECHA_LIQUIDACION
				           ,CODIGO_TRANSACCION
				           ,CODIGO_TITULO_REPORTE2
				           ,VALOR_COMERCIAL
				           ,VALOR_CATASTRAL
				           ,VALOR_HIPOTECA
				           ,VALOR_NOMINAL
				           ,VALOR_MORA
				           ,VALOR_INTERES
				           ,TOTAL_PAGAR
				           ,TOTAL_ADICIONALES
				           ,TOTAL_DESCUENTOS
				           ,TOTAL_INT_MORA
				           ,TOTAL_COACTIVA
				           ,TOTAL_RECARGO
				           ,INTERES_PLUVIAL
				           ,RELIQUIDACION
				           ,INT_RURAL
				           ,INT_BOMBEROS
				           ,OTROS
				           ,VALOR_COMPRA
				           ,VALOR_VENTA
				           ,VALOR_MEJORAS
				           ,AREA_TOTAL
				           ,PATRIMONIO
				           ,OBSERVACION
				           ,OBSERVACION2
				           ,ID_LIQUIDACION
				           ,ESTADO_LIQUIDACION
				           ,COACTIVA
				           ,USUARIO_INGRESO
				           ,FECHA_INGRESO
				           ,USUARIO_MODIFICACION
				           ,FECHA_MODIFICACION)
				     VALUES
				           ($tituloReporte
				           ,0
				           ,$val
				           ,$codUsuario
				           ,0
				           ,$codUrb
				           ,$codRural
				           ,0
				           ,0
				           ,0
				           ,$year
				           ,0
				           ,$fecha
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,$toralpagar
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,0
				           ,'$Concepto'
				           ,0
				           ,'$valorliq'
				           ,'A'
				           ,'N'
				           ,'$User'
				           ,$fecha
				           ,''
				           ,'')";

     					$msresults= mssql_query(utf8_decode($sql2))or die(mssql_get_last_message());


						$sqlupdate = "UPDATE MA_SECUENCIAS
										   SET
										      VALOR_INICIAL = '$val'
										      ,USUARIO_MODIFICACION = '$User'
										      ,FECHA_MODIFICACION = $fecha
										 WHERE CODIGO_APLICACION = 'LIQUIDA_GENERALES'";


						mssql_query(utf8_decode($sqlupdate))or die(mssql_get_last_message());



mysql_query("INSERT INTO liquidacion_log(liquidacion, usuario, usuario_id, fecha) 
	VALUES ('$valorliq', '$usr', $idUser, '$fecha')")or die(mysql_error());

						echo json_encode($arrayName);

}

