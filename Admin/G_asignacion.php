<!DOCTYPE html>
<html>
<head>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

  <!-- This is what you need -->
  <script src="../alertmaster/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="../alertmaster/dist/sweetalert.css">
</head>
<body>
<?php 
include '../Connections/RootSistemas_Conexion_masterWeb.php';
//echo "string";
//echo $tecnico=$_POST['tecn'];
//echo $Incidencia=$_POST['Incidencia'];

define('BOT_TOKEN', '176048945:AAFiSziTHFnaKbMO8O2qtKcmz--q0_sf_MM');
define('CHAT_ID', '-108555229');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');



//-----------------------------------------------------------

function enviar_telegram($msj){

  $queryArray=[
  'chat_id' => CHAT_ID,
  'text' => $msj,
  ];

  $url='https://api.telegram.org/bot'.BOT_TOKEN.'/sendMessage?'
    .http_build_query($queryArray);
    $result = file_get_contents($url);

}


if (isset($_POST['tecn'])) {
// $idUser=$_SESSION['MM_ID_USER'];
//boot


 $tecnico=$_POST['tecn'];
 $Incidencia=$_POST['Incidencia'];
$day=date('Y-m-d');
$hora=date("H:i");

mysql_query("INSERT INTO db_master_bbh.asignacion 
						(id_Tecnico, 
						id_Incidencia, 
						Fecha_Asignacion, 
						Hora_Asignacion, 
						Estado,
						RCB
						)
						VALUES
						('$tecnico', 
						'$Incidencia', 
						'$day', 
						'$hora', 
						'0',
						'0')")or die(mysql_error());

mysql_query("UPDATE db_master_bbh.incidencia 
						SET
						estado = '1' 
						WHERE
						idIncidencia = '$Incidencia'")or die(mysql_error());		


$result = mysql_query("SELECT MAX(idAsignacion) FROM asignacion");
    $row = mysql_fetch_row($result);
     $idas = $row[0];
//******************************************************************************************
  $R_asig=mysql_query("SELECT 	idAsignacion, 
	id_Tecnico, 
	asignacion.id_Incidencia, 
	Fecha_Asignacion, 
	Hora_Asignacion,
	incidencia.Id_Usuario,
	departamento.Departamento,
	persona.Nombres,
	persona.Apellidos,
	tipoinicidencia.incidencia
	FROM 
	db_master_bbh.asignacion, usuario, persona, cargo, departamento, tipoinicidencia, incidencia
	WHERE incidencia.Id_Usuario=usuario.idUsuario 
	AND asignacion.id_Incidencia=incidencia.idIncidencia
	AND usuario.id_Persona=persona.idPersona 
	AND cargo.idCargo=persona.id_Cargo 
	AND departamento.idDepartamento=cargo.id_Departamento 
	AND incidencia.id_Tipo_incidencia=tipoinicidencia.id_incidencia
	AND asignacion.idAsignacion=$idas")or die(mysql_error().'sdfghjhgfds');

$DatREPORT=mysql_fetch_assoc($R_asig);

 $P_Reporta=$DatREPORT['Nombres'].' '.$DatREPORT['Apellidos'].' '.'Reporta:';
 $TP_INC=$DatREPORT['incidencia'].' ';
 $DE_REPORT='Del Departamento de - '.$DatREPORT['Departamento'].' ';
 $IDTCT=$DatREPORT['id_Tecnico'];

   $TCN_0=mysql_query("SELECT idAsignacion, 
	id_Tecnico, 
	asignacion.id_Incidencia, 
	Fecha_Asignacion, 
	Hora_Asignacion, 
	usuario.Usuario
	FROM 
	db_master_bbh.asignacion, usuario, tipoinicidencia, tecnico
	WHERE asignacion.id_Tecnico=tecnico.idTecnico 
	AND usuario.idUsuario=tecnico.id_Usuario 
	AND asignacion.id_Incidencia=tipoinicidencia.id_incidencia
	AND asignacion.id_Tecnico=$IDTCT")or die(mysql_error());

   $DATATECN=mysql_fetch_assoc($TCN_0);
   $NOMTEC=$DATATECN['Usuario'];

//********************************************************************************************

$mensaje='Para: '.$NOMTEC.'- El usuario'.$P_Reporta.' '.$TP_INC.$DE_REPORT;
                enviar_telegram($mensaje);
?>

	<script type="text/javascript">
    $(document).ready(function() {
	swal({
  	title: "Correcto!",	
  	text: "Los datos se guardaron corectamente.",
  	imageUrl: "images/thumbs-up.jpg"
	},
  	function(){
    window.location.href = 'index.php';
	});

	});
	//window.location="http://www.cristalab.com";
	</script>

	<?php
	//
	}
	//header("location:viewDepartamento.php");
	?>
</body>
</html>
