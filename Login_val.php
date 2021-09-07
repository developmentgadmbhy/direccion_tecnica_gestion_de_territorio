<?php
include 'Connections/RootSistemas_Conexion_masterWeb.php';
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_POST['login'])) {
  

 $login=$_POST['login'];
 $password=md5($_POST['pass']);
mysql_select_db($database_Sistema, $Sistema);
 
 $sql="SELECT   id_usuario, 
                  nombres, 
                  apellidos, 
                  telefono, 
                  celular, 
                  email, 
                  cedula, 
                  estado, 
                  usuario, 
                  pass, 
                  libre, 
                  rol_id, 
                  estado_cambio 
                  FROM 
                  red_babahoyo.usuario 
                  WHERE usuario='' AND pass='' AND estado_cambio=1";


  $row = mysql_query($sql, $Sistema) or die(mysql_error());
   $User = mysql_num_rows($row);

  if ($User>0) {

       $IDUSER  = mysql_result($row,0,'idUsuario');
	     $idtipo  = mysql_result($row,0,'id_Rol');
       $CodUsuDoc  = mysql_result($row,0,'Usuario');
	
   //declare two session variables and assign them
        $_SESSION['MM_ID_USER'] = $IDUSER;
        $_SESSION['USER'] = $CodUsuDoc;

    	
  	if ($idtipo==1){
      header("location:MasterApp/");    
     }

    if ($idtipo==2){
      header("location:Admin/");    
     }

    if ($idtipo==3){
      header("location:Tecnico/");    
     }

    if ($idtipo==4){
      header("location:User/");    
     }
    
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
