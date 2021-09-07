<?php 
include '../Connections/RootSistemas_Conexion_masterWeb.php';
$idUser=$_SESSION['MM_ID_USER'];
$Data=mysql_query("SELECT 	idReporte, 
	id_Asignacion, 
	Titulo, 
	Reperte, 
	Documento, 
	tipo, 
	progreso, 
	hora, 
	fecha,
	asignacion.idAsignacion,
	incidencia.idIncidencia,
	persona.Nombres,
	persona.Apellidos
	FROM 
	db_master_bbh.reporte, asignacion, incidencia, usuario, persona, tecnico
	WHERE reporte.id_Asignacion=asignacion.idAsignacion and usuario.idUsuario=$idUser
	AND asignacion.id_Incidencia= incidencia.idIncidencia AND asignacion.id_Tecnico=tecnico.idTecnico 
	AND tecnico.id_Usuario=usuario.idUsuario AND usuario.id_Persona=persona.idPersona AND reporte.progreso='100' AND reporte.RCB='0'
	AND incidencia.idIncidencia NOT IN (SELECT id_incidencia FROM calificaciontecnico)");


$Data1=mysql_query("SELECT 	idReporte, 
	id_Asignacion, 
	Titulo, 
	Reperte, 
	Documento, 
	tipo, 
	progreso, 
	hora, 
	fecha,
	asignacion.idAsignacion,
	incidencia.idIncidencia,
	persona.Nombres,
	persona.Apellidos
	FROM 
	db_master_bbh.reporte, asignacion, incidencia, usuario, persona, tecnico
	WHERE reporte.id_Asignacion=asignacion.idAsignacion and usuario.idUsuario=$idUser
	AND asignacion.id_Incidencia= incidencia.idIncidencia AND asignacion.id_Tecnico=tecnico.idTecnico 
	AND tecnico.id_Usuario=usuario.idUsuario AND usuario.id_Persona=persona.idPersona AND reporte.progreso='100' 
	AND incidencia.idIncidencia NOT IN (SELECT id_incidencia FROM calificaciontecnico)");


while ($Fill=mysql_fetch_array($Data)) {
	?>
	<audio src="../sound/alert.mp3" autoplay>

            </audio>
            <div class="callout callout-info">
            <h4>(<?php echo $Fill['Titulo'] ?>) Atendida por el Tecnico: <u><?php echo $Fill['Nombres'].' '.$Fill['Apellidos'] ?></u>  </h4><a href="Calificar.php?Data=<?php echo $Fill['idIncidencia']; ?>" class="btn btn-success pull-right">Calificar</a>
            <p>Fecha: <?php echo $Fill['fecha'].' '.$Fill['hora'] ?> <br>
            Reperte: <?php echo $Fill['Reperte'] ?> <br> 
            </p>

            </div>
	<?php
	$idRep=$Fill['idReporte'];
	mysql_query("UPDATE db_master_bbh.reporte 
						SET
						RCB = '1'
						WHERE
						idReporte = '$idRep'");
}

while ($Fill=mysql_fetch_array($Data1)) {
	?>
            <div class="callout callout-info">
            <h4>(<?php echo $Fill['Titulo'] ?>) Atendida por el Tecnico: <u><?php echo $Fill['Nombres'].' '.$Fill['Apellidos'] ?></u>  </h4><a href="Calificar.php?Data=<?php echo $Fill['idIncidencia']; ?>" class="btn btn-success pull-right">Calificar</a>
            <p>Fecha: <?php echo $Fill['fecha'].' '.$Fill['hora'] ?> <br>
            Reperte: <?php echo $Fill['Reperte'] ?> <br> 
            </p>

            </div>
	<?php
	}
	?>