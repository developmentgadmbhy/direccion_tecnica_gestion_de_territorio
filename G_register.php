<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="alertmaster/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="alertmaster/dist/sweetalert.css">
</head>
<body>

<?php
include 'Connections/RootSistemas_Conexion_masterWeb.php';
include 'email/mail.php';

 function generarCodigo($longitud) {
 $key = '';
 $pattern = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
}

if (isset($_POST['Cedula'])) {

	$Cedula=$_POST['Cedula'];
	$Nombres=$_POST['Nombres'];
	$Apellidos=$_POST['Apellidos'];
	$Telefono=$_POST['Telefono'];
	$Email=$_POST['Email'];
	$cargo=$_POST['cargo'];
	//$rol=$_POST['rol'];

	$Verificar=mysql_query("SELECT Cedula 
									FROM 
									db_master_bbh.persona 
									WHERE Cedula='$Cedula'");

	$numVerifi=mysql_num_rows($Verificar);

	$Verificar11=mysql_query("SELECT Email 
									FROM 
									db_master_bbh.persona 
									WHERE Email='$Email'");

	$numVerifi11=mysql_num_rows($Verificar11);


if ( $numVerifi11>0) {
	?>
		<script type="text/javascript">
   			$(document).ready(function() {
			swal({
  			title: "Erro!",
  			text: "El email ya esta registrado.",
  			imageUrl: "MasterApp/images/error.png"
			},
  			function(){
    		window.location.href = 'Registro.php';
			});
			});
			</script>
	<?php
	}


	if ($numVerifi==0 && $numVerifi11==0) {
	
	$V_email=(explode( '@', $Email ) );
	 $email1=$V_email[0];
	 $email2=$V_email[1];

	if ($email2<>'babahoyo.gob.ec') {
	?>
		<script type="text/javascript">
   			$(document).ready(function() {
			swal({
  			title: "Erro!",
  			text: "El email no pertenece a la institución. No puedes Registrarlo.",
  			imageUrl: "MasterApp/images/error.png"
			},
  			function(){
    		window.location.href = 'Registro.php';
			});
			});
			</script>
	<?php
	}


	$name=(explode( ' ', $Nombres ) );
	$apell=( explode( ' ', $Apellidos ) );
	$name1=$name[0];
	$user = $name1[0].$apell[0];

	$data='';
	$tipo='';

if ($_FILES['image']['tmp_name']!=""){ 

	// Archivo temporal
        $imagen_temporal = $_FILES['image']['tmp_name'];
 
        // Tipo de archivo
        $tipo = $_FILES['image']['type'];
 
        // Leemos el contenido del archivo temporal en binario.
        $fp = fopen($imagen_temporal, 'r+b');
        $data = fread($fp, filesize($imagen_temporal));
        fclose($fp);
 
        //Podríamos utilizar también la siguiente instrucción en lugar de las 3 anteriores.
        // $data=file_get_contents($imagen_temporal);
 
        // Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
        $data = mysql_escape_string($data);
  }
      mysql_query("INSERT INTO db_master_bbh.persona 
							(Cedula, 
							Nombres, 
							Apellidos, 
							Telefono, 
							Email, 
							Foto, 
							id_Cargo,
							type)
							VALUES
							('$Cedula', 
							'$Nombres', 
							'$Apellidos', 
							'$Telefono', 
							'$Email', 		
							'$data', 
							'$cargo',
							'$tipo')")or die(mysql_error());

    
    $result = mysql_query("SELECT MAX(idPersona) FROM persona");
    $row = mysql_fetch_row($result);
    $idperson = $row[0];

    /*$cadenadePass='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
	$pass = '';
    for ($i = 0; $i < 10; $i++) {
        $pass = $cadenadePass[rand(0, strlen($cadenadePass))];
    }*/


     $Pss= generarCodigo(8);
    $cadenadePass=$Pss;
    $NewPass=md5($cadenadePass);
    //$pass=md5($Cedula);

    mysql_query("INSERT INTO db_master_bbh.usuario 
							(id_Persona, 
							Usuario, 
							Pass, 
							id_Rol, 
							Estado)	
							VALUES
							('$idperson', 
							'$user', 
							'$NewPass', 
							'4', 
							'I')");

//$cadenadeVerificacion='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
//$randstring = '';
$cadenaEmail= generarCodigo(20);
//echo $cadenaEmail=$randstring.'-555';
$useEmail=md5($idperson);
$passEmail=$Pss;
$UsuarioEmail=$user;

mysql_query("INSERT INTO db_master_bbh.accesregister 
										(idUser, 
										acceso)
										VALUES
										('$idperson', 
										'$cadenaEmail')");


$body="<h3>Nuevo Registro de Acceso</h3> <br>
<p>Su solicitud de registro se registró en el sistema, para activar su cuenta de clic en el enlace que se muestra en la parte inferior.</p> <br>
<p>Su usuario es:  ".$UsuarioEmail." </p><br>
<p>Su contraseña es:  ".$passEmail." </p><br>
<p>De clic en el enlace para terminar el registro: </p><br>
<p><a href='http://localhost/adminmastersite/completeRegistro.php?DataRegistre=".$cadenaEmail."/".$useEmail."'>Clic Aqui</a> </p><br>
<p>O copie y pegue en el Navigador </p><br>
<p>http://localhost/adminmastersite/completeRegistro.php?DataRegistre=".$cadenaEmail."&".$useEmail." </p><br>
";
/*
$titulo='Nuevo Registro de Acceso';
$Contem1="Su usuario es: - ".$UsuarioEmail;
$Contem2="Su contraseña es: - ".$passEmail;
$CuerpoEmail="Su solicitud de registro se registró en el sistema para activar si cuenta de clic en el enlace que se muestra en la parte inferior.";
$PieEmail="Si usted no realizo esta solicitud por favor ignore este mensaje.";
$enlaceEmail="http://localhost/AdminMasteSite/competeRegistro.php?DataRegistre=".$cadenaEmail."&".$useEmail."";
*/
//$mensaje=$CuerpoEmail."\r\n".$Contem1."\r\n".$Contem2."\r\n".$enlaceEmail."\r\n".$PieEmail;


$Nombre_1 = 'Dirección de Tecnología de la Información y Comunicación';
$descripcion='Email de Confirmacion';
$html = sendgmail($Email,$Nombre_1,$body,$descripcion);
	//mail($Email, $titulo, $mensaje, $cabeceras);
?>

<script type="text/javascript">
   $(document).ready(function() {
	swal({
  		title: "Correcto!",
  		text: "Verifica tu email para seguir con el registro.",
  		imageUrl: "MasterApp/images/thumbs-up.jpg"
		},
  	function(){
    window.location.href = 'https://login.microsoftonline.com/';
	});
	});
	//window.location="http://www.cristalab.com";
	</script>

<?php

}elseif ($numVerifi>0) {

?>

<script type="text/javascript">
  $(document).ready(function() {
	swal({
  		title: "Erro!",
  		text: "La Cedula ya esta registrada.",
  		imageUrl: "MasterApp/images/error.png"
		},
  	function(){
    window.location.href = 'Registro.php';
	});
	});
	//window.location="http://www.cristalab.com";
	</script>

<?php
	
}

}
?>
</body>
</html>