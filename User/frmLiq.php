<?php

   

header('Content-Type: text/html; charset=UTF-8');


$msconnect=mssql_connect("SQL2012","sa",'M$p2015');  
$msdb=mssql_select_db("Municipio",$msconnect);  

$rebro = "SELECT DESCRIPCION, VALOR FROM RT_RUBROS_X_TITULOS WHERE CODIGO_TITULO_REPORTE=203";  
  				$msresults1= mssql_query($rebro)or die(mssql_get_last_message());  
  				
  				echo  json_encode(utf8_encode(mssql_fetch_array($msresults1)));

mssql_close($msconnect);

?> 