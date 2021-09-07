<?php

date_default_timezone_set("America/Guayaquil");
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
if (!isset($_SESSION)) {
  session_start();
}

$hostname_Sistema = "localhost";
$database_Sistema = "bbh_certif";
$username_Sistema = "root";
$password_Sistema = "ASDasd123.";
//$_SESSION['password_Sistema']=$password_Sistema;
$Sistema = @mysql_connect($hostname_Sistema, $username_Sistema, $password_Sistema) or trigger_error(mysql_error(),E_USER_ERROR); 
@mysql_set_charset('utf8');
//mysql_set_charset('utf8',$Sistema);
@mysql_query("SET NAMES 'utf8'",$Sistema);


//---------------------Obtengo el Dia-------------------- 
$dia[0]="DOMINGO";
$dia[1]="LUNES";
$dia[2]="MARTES";
$dia[3]="MIERCOLES";
$dia[4]="JUEVES";
$dia[5]="VIERNES";
$dia[6]="SABADO";
$gisett=(int)date("w");
//-----------Obtengo el Mes----------------------
$mes[0]="-";
$mes[1]="Enero";
$mes[2]="Febrero";
$mes[3]="Marzo";
$mes[4]="Abril";
$mes[5]="Mayo";
$mes[6]="Junio";
$mes[7]="Julio";
$mes[8]="Agosto";
$mes[9]="Septiembre";
$mes[10]="Octubre";
$mes[11]="Noviembre";
$mes[12]="Diciembre";
$mesnum=(int)date("m");



mysql_select_db($database_Sistema, $Sistema);
?>
