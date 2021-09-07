<?php
include 'Connections/RootSistemas_Conexion_masterWeb.php';
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_POST['login'])) {

$date=date("Y-m-d");
$hora=date("h:i:s");
$ip=$_SERVER['HTTP_CLIENT_IP'];
 $login=$_POST['login'];
 $password=md5($_POST['pass']);
mysql_select_db($database_Sistema, $Sistema);
 
 $sql="SELECT   bbh_id_usuario, 
  bbh_usuario, 
  bbh_pass, 
  bbh_persona_id, 
  bbh_rol_id,
  liquidacion
  FROM 
  bbh_usuario 
  WHERE bbh_usuario='$login' AND bbh_pass='$password'";


  $row = mysql_query($sql, $Sistema) or die(mysql_error());
   $User = mysql_num_rows($row);

  if ($User>0) {
        $_SESSION['cod']='';
       $IDUSER  = mysql_result($row,0,'bbh_id_usuario');
	     $idtipo  = mysql_result($row,0,'bbh_rol_id');
       $CodUsuDoc  = mysql_result($row,0,'bbh_usuario');
       $liquidacion  = mysql_result($row,0,'liquidacion');
	
   //declare two session variables and assign them
        $_SESSION['MM_ID_USER'] = $IDUSER;
        $_SESSION['USER'] = $CodUsuDoc;
        $_SESSION['ROLL'] = $idtipo;
        $_SESSION['Liquidacion'] = $liquidacion;


        mysql_query("INSERT INTO bbh_log 
                                 (bbh_usuario_id, 
                                 bbh_fecha_ingreso, 
                                 bbh_hora_ingreso, 
                                 bbh_ip
                                 )
                                 VALUES
                                 ('$IDUSER', 
                                 '$date', 
                                 '$hora', 
                                 '$ip'
                                  )")or die(mysql_error());
    	
  	if ($idtipo==1){
      header("location:Admin/");    
     }

    if ($idtipo==2){
      header("location:User/");    
     }
      if ($idtipo==3){
      header("location:User/");    
     }
/*
    if ($idtipo==3){
      header("location:Tecnico/");    
     }

    if ($idtipo==4){
      header("location:User/");    
     }*/
    
  }else{
    header("location:index.php?error");
  }
}else{
header("location:index.php?error");
}
	?>

<?php
mysql_free_result($row);

?>
