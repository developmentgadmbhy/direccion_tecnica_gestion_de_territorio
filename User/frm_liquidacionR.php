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
$msconnect=mssql_connect("192.168.39.168:1433","sa",'M$p2015');
$msdb=mssql_select_db("Municipio",$msconnect);  


if (isset($_POST['Clave'])) {
  

  $Clave     =  $_POST['Clave'];
  $parroquia   =  $_POST['parroquia'];


  $msquery = "SELECT top 1 * FROM PU_CATASTRO_X_RUSTICO WHERE REG_CATASTRAL = '$Clave' AND PARROQUIA = '$parroquia' ORDER BY ANIO DESC";  
          $msresults= mssql_query(utf8_decode($msquery))or die(mssql_get_last_message());  
          $row = mssql_fetch_array($msresults);
          $codPr = $row['CODIGO_PREDIO']; 
          $areaSolar = $row['SUPERFICIE'];  

$predio = "SELECT * FROM RU_CATASTRO WHERE CODIGO_RURAL = $codPr";  
          $msresults= mssql_query(utf8_decode($predio))or die(mssql_get_last_message());  
        $row1 = mssql_fetch_array($msresults);
          
          $user = $row1['ID_PROPIETARIO'];


$usuarios =  "SELECT * FROM MA_USUARIOS WHERE CODIGO_USUARIO = $user";  
        $msresults= mssql_query(utf8_decode($usuarios))or die(mssql_get_last_message());  
        $ResUser = mssql_fetch_array($msresults);


          $nombres  = utf8_decode($ResUser['PRIMER_NOMBRE']).' '.utf8_decode($ResUser['SEGUNDO_NOMBRE']);
          $apellidos  = utf8_decode($ResUser['APELLIDO_PATERNO']).' '.utf8_decode($ResUser['APELLIDO_MATERNO']);
          $cedula   = $ResUser['NUMERO_IDENTIFICACION'];

          $datos = array( "AVALUO_SOLAR"=>$row1['VALOR_COMERCIAL'], "AVALUO_CONSTRUCCION"=>$row1['AVALUO_ACTUAL'], "AVALUO_MUNICIPAL"=>$row1['VALOR_CATASTRAL'], "CODIGO_USUARIO"=>$user, "Nombre"=>$nombres, "apellidos"=>$apellidos, "CEDULA"=>$cedula, "CODIGO_PREDIO"=>$codPr, "AreaSolar" => $areaSolar);

          echo json_encode($datos);

        mssql_close($msconnect);          


}


if (isset($_POST['G_id'])) {
  

  $G_id             = $_POST['G_id'];
  $G_coeficiente    = $_POST['G_coeficiente'];
  $G_tipo           = $_POST['G_tipo'];
  $G_codigoRubro    = $_POST['G_codigoRubro'];
  $G_areaSolar      = $_POST['G_areaSolar'];
  $G_avSolar        = $_POST['G_avSolar'];
  $G_avConstruccion = $_POST['G_avConstruccion'];
  $G_avMunicipal    = $_POST['G_avMunicipal'];
  $G_ValorArea      = $_POST['G_ValorArea'];


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

        $valorSub =  (round(floatval($valorSub),4) * 2)/10;

        $valor = floatval($valorSub) + abs($datos['Rubros'][1]['VALOR']);

        $datos['valorFinal'] = array("valortotal" => round(floatval($valor),4) , "subTotal"=> floatval($valorSub));

        echo json_encode($datos);

  mssql_close($msconnect);

}

if (isset($_POST['C_zona'])) {
  
  $C_coeficiente    = $_POST['C_coeficiente'];
  $C_tipo       = $_POST['C_tipo'];
  $C_codigoRubro    = $_POST['C_codigoRubro'];
  $C_areaSolar    = $_POST['C_areaSolar'];
  $C_avSolar      = $_POST['C_avSolar'];
  $C_avConstruccion = $_POST['C_avConstruccion'];
  $C_avMunicipal    = $_POST['C_avMunicipal'];
  $tipoZona     = $_POST['tipoZona'];

  $C_zona       = $_POST['C_zona'];
  $C_sector     = $_POST['C_sector'];
  $C_manzana      = $_POST['C_manzana'];
  $C_valor      = $_POST['C_valor'];

  if ($C_tipo == 4) {

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
          $resultado = ($C_valor * 0.60);

          if ($resultado < 15) {
            $resultado = 15;
          }

          $datos['valorFinal'] = array("valortotal" => ($resultado+abs($datos['Rubros'][1]['VALOR'])), "subTotal"=> $resultado);

          echo json_encode($datos);



  }


  mssql_close($msconnect);

}