<?php
ini_set('display_errors',1);
require("PHPMailer/class.phpmailer.php");
require("PHPMailer/class.smtp.php");

//https://www.google.com/settings/security/lesssecureapps
//http://phpmailer.worxware.com/
/*
function sendgmail($correo,$nombre,$body)
{
	$mail = new PHPMailer() ;

				 				 
		$body .= "";

		$mail->IsSMTP(); 

		//Sustituye (ServidorDeCorreoSMTP)  por el host de tu servidor de correo SMTP
		$mail->Host = "smtp.office365.com";
		$mail->Port       = 25;  
		$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		
		//Sustituye  ( CuentaDeEnvio )  por la cuenta desde la que deseas enviar por ejem. prueba@domitienda.com  
		$mail->From     = "soportecnologia@babahoyo.gob.ec";
		$mail->FromName = "Dirección de Tecnología de la Información y Comunicación";
		$mail->Subject  = "Complete el Registro";
		$mail->AltBody  = "Leer"; 
		$mail->MsgHTML($body);

		// Sustituye  (CuentaDestino )  por la cuenta a la que deseas enviar por ejem. usuario@destino.com  
		$mail->AddAddress($correo,'');
		$mail->SMTPAuth = true;

		// Sustituye (CuentaDeEnvio )  por la misma cuenta que usaste en la parte superior en este caso  prueba@midominio.com  y sustituye (ContraseñaDeEnvio)  por la contraseña que tenga dicha cuenta 

		$mail->Username = "soportecnologia@babahoyo.gob.ec";
		$mail->Password = "S@porte12345"; 

		if($mail->Send())
		{
			//return true;
			
			return $body; 
		}else
		{
			return false;
			die();
		}
	}

	*/
function sendgmail($correo,$nombre,$body)
{
	$mail = new PHPMailer() ;

/*	$body = '<table width="537" height="662" border="1">
  <tbody>
    <tr>
      <td width="253" height="94">Buenas tardes señor '.$nombre.'</td>
      <td width="557">Por medio de este presente correo...... bla bla bal....</td>
    </tr>
    <tr>
      <td colspan="2"><img src="http://www.comolohicieron.com.mx/wp-content/uploads/2015/03/Screen-Shot-2015-03-29-at-3.36.49-PM-816x497.png"></td>
    </tr>
  </tbody>
</table>';
				*/		 
		$body .= "";

		$mail->IsSMTP(); 

		//Sustituye (ServidorDeCorreoSMTP)  por el host de tu servidor de correo SMTP
 		$mail->Host = "smtp.gmail.com";		
		$mail->Port       = 465;  
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl"; 
		$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		
		//Sustituye  ( CuentaDeEnvio )  por la cuenta desde la que deseas enviar por ejem. prueba@domitienda.com  
		$mail->From     = "soportecnologia@babahoyo.gob.ec";
		$mail->FromName = "Departamento de Sistemas";
		$mail->Subject  = "Complete el Registro";
		$mail->AltBody  = "Leer"; 
		$mail->MsgHTML($body);

		// Sustituye  (CuentaDestino )  por la cuenta a la que deseas enviar por ejem. usuario@destino.com  
		$mail->AddAddress($correo,'');
		$mail->SMTPAuth = true;

		// Sustituye (CuentaDeEnvio )  por la misma cuenta que usaste en la parte superior en este caso  prueba@midominio.com  y sustituye (ContraseñaDeEnvio)  por la contraseña que tenga dicha cuenta 
		$mail->Username = "dsoportecnologia@gmail.com";
		$mail->Password = "S@porte12345"; 

		if($mail->Send())
		{			
			return $body; 
		}else
		{
			return false;
			die();
		}
	}



//$html = sendgmail($_POST['correo'],$_POST['nombre'],$_POST['descripcion']);

?>