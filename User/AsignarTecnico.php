<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
include "validationfuntion.php";
$idUser=$_SESSION['MM_ID_USER'];
validar($idUser);
$ViewTecnico=mysql_query("SELECT   idTecnico, 
                                      id_Usuario,
                                      usuario.Usuario  
                                      FROM 
                                      db_master_bbh.tecnico, usuario
                                      WHERE tecnico.id_Usuario=usuario.idUsuario")or die(mysql_error());

if (isset($_GET['Data'])) {
  $IdIncidencias=$_GET['Data'];

  $GetData=mysql_query("SELECT  idIncidencia, 
                                id_Tipo_incidencia, 
                                Fecha_Ingreso, 
                                Hora_Ingreso, 
                                Prioridad, 
                                Id_Usuario, 
                                RCB, 
                                incidencia.estado, 
                                obcervacion,
                                tipoinicidencia.incidencia,
                                persona.Nombres,
                                persona.Apellidos,
                                departamento.Departamento
                                FROM 
                                db_master_bbh.incidencia, tipoinicidencia, usuario, departamento, cargo, persona
                                WHERE idIncidencia='$IdIncidencias' AND incidencia.id_Tipo_incidencia=tipoinicidencia.id_incidencia AND incidencia.estado='0' AND 
                                incidencia.Id_Usuario=usuario.idUsuario AND usuario.id_Persona=persona.idPersona 
                                AND persona.id_Cargo=cargo.idCargo AND cargo.id_Departamento=departamento.idDepartamento")or die(mysql_error());       
  $ViewDataRest=mysql_fetch_assoc($GetData);

}elseif (!isset($_GET['Data'])) {
 header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Soporte</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!--  ******************* Header  -   Menu **********************-->

      <?php 
      include('header.php');
      include('menu.php');
      ?>

      <!--  ******************* Header  -   Menu **********************-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
         <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
        
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->

            <!--********************** Contenido *****************************************-->
            <section class="col-lg-2 connectedSortable">
            </section>
            <section class="col-lg-8 connectedSortable">
                 <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Asignacion de incidencias</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="G_asignacion.php">
                  <div class="box-body">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Tecnico</label>
                      <select name="tecn" id="tecn" class="form-control" required>
                      <option value="">Seleccione uno...</option>
                      <?php
                      while ($Filla=mysql_fetch_array($ViewTecnico)) {
                      ?>
                      <option value="<?php echo $Filla[0]; ?>"><?php echo $Filla[2]; ?></option>
                      <?php
                      }
                      ?>
                      </select>
                    </div>
                    
                    <input type="hidden" name="Incidencia" value="<?php echo $ViewDataRest['idIncidencia']; ?>">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Reportada por:</label>
                      <p><?php echo $ViewDataRest['Nombres'].' '.$ViewDataRest['Apellidos']; ?></p>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Departamento</label>
                      <p><?php echo $ViewDataRest['Departamento']; ?></p>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Incidencia</label>
                      <p><?php echo $ViewDataRest['incidencia']; ?></p>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Detalle</label>
                      <p><?php echo $ViewDataRest['obcervacion']; ?></p>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Asignar</button>
                  </div>
                </form>
              </div><!-- /.box -->
             </section>
             <section class="col-lg-2 connectedSortable">
             </section>
             <!--********************** Contenido *****************************************-->
            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
  </body>
</html>
