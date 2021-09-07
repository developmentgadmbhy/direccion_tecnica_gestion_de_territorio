<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';



$viewDataIncidencia=mysql_query("SELECT   idIncidencia, 
  id_Tipo_incidencia, 
  Fecha_Ingreso, 
  Hora_Ingreso, 
  Prioridad, 
  Id_Usuario, 
  RCB, 
  incidencia.estado, 
  obcervacion,
  Usuario.Usuario,
  persona.Nombres,
  persona.Apellidos,
  departamento.Departamento,
  tipoInicidencia.incidencia
  FROM 
  db_master_bbh.incidencia, usuario, persona, departamento, cargo,tipoInicidencia
  WHERE incidencia.Id_Usuario=usuario.idUsuario 
  AND usuario.id_Persona=persona.idPersona 
  AND persona.id_Cargo=cargo.idCargo 
  AND cargo.id_Departamento=departamento.idDepartamento 
  AND incidencia.id_Tipo_incidencia=tipoInicidencia.id_incidencia
  AND incidencia.estado='0' AND RCB=0
")or die(mysql_error());      

$viewDataIncidencia1=mysql_query("SELECT   idIncidencia, 
  id_Tipo_incidencia, 
  Fecha_Ingreso, 
  Hora_Ingreso, 
  Prioridad, 
  Id_Usuario, 
  RCB, 
  incidencia.estado, 
  obcervacion,
  Usuario.Usuario,
  persona.Nombres,
  persona.Apellidos,
  departamento.Departamento,
  tipoInicidencia.incidencia
  FROM 
  db_master_bbh.incidencia, usuario, persona, departamento, cargo,tipoInicidencia
  WHERE incidencia.Id_Usuario=usuario.idUsuario 
  AND usuario.id_Persona=persona.idPersona 
  AND persona.id_Cargo=cargo.idCargo 
  AND cargo.id_Departamento=departamento.idDepartamento 
  AND incidencia.id_Tipo_incidencia=tipoInicidencia.id_incidencia
  AND incidencia.estado='0' AND RCB=1
")or die(mysql_error()); 


            while ($Fill=mysql_fetch_assoc($viewDataIncidencia)) {


?>
<audio src="../sound/alert.mp3" autoplay>

</audio>
            <div class="callout callout-danger">
            <h4>(<?php echo $Fill['incidencia'] ?>) Reportada por el usuario <u><?php echo $Fill['Nombres'].' '.$Fill['Apellidos'] ?></u>  </h4>
            <a href="AsignarTecnico.php?Data=<?php echo $Fill['idIncidencia'] ?>" class="btn btn-info pull-right">Asignar a Tecnico</a>
            <p>Departamento: <?php echo $Fill['Departamento'] ?> <br>
            Fecha: <?php echo $Fill['Fecha_Ingreso'] ?> <br>
            Hora: <?php echo $Fill['Hora_Ingreso'] ?> <br> 
            Observaciones: <?php echo $Fill['obcervacion'] ?></p>

            </div>
<?php
$IdIn=$Fill['idIncidencia'];
    mysql_query("UPDATE db_master_bbh.incidencia 
                        SET
                        RCB = 1 
                        WHERE
                        idIncidencia = '$IdIn'")or die(mysql_error());

     

            }

 while ($Fill=mysql_fetch_assoc($viewDataIncidencia1)) {
?>

            <div class="callout callout-danger">
            <h4>(<?php echo $Fill['incidencia'] ?>) Reportada por el usuario <u><?php echo $Fill['Nombres'].' '.$Fill['Apellidos'] ?></u>  </h4>
            <a href="AsignarTecnico.php?Data=<?php echo $Fill['idIncidencia'] ?>" class="btn btn-info pull-right">Asignar a Tecnico</a>
            <p>Departamento: <?php echo $Fill['Departamento'] ?> <br>
            Fecha: <?php echo $Fill['Fecha_Ingreso'] ?> <br>
            Hora: <?php echo $Fill['Hora_Ingreso'] ?> <br> 
            Observaciones: <?php echo $Fill['obcervacion'] ?></p>

            </div>
<?php
            }

?>