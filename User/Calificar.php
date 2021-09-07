<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
include "validationfuntion.php";
$idUser=$_SESSION['MM_ID_USER'];
validar($idUser);

if (isset($_GET['Data'])) {
 $idIncidencia=$_GET['Data'];

  $DATAReport=mysql_query("SELECT   idAsignacion, 
                                      id_Tecnico, 
                                      id_Incidencia, 
                                      Fecha_Asignacion, 
                                      Hora_Asignacion,
                                      persona.Nombres,
                                      persona.Apellidos,
                                      reporte.fecha,
                                      reporte.hora,
                                      reporte.Reperte,
                                      reporte.Titulo,
                                      usuario.idUsuario
                                      FROM 
                                      db_master_bbh.asignacion, tecnico, usuario, persona, reporte
                                      WHERE asignacion.id_Tecnico=tecnico.idTecnico 
                                      AND tecnico.id_Usuario=usuario.idUsuario 
                                      AND usuario.id_Persona= persona.idPersona 
                                      AND asignacion.idAsignacion=reporte.id_Asignacion
                                      AND asignacion.id_Incidencia='$idIncidencia'
                                      ")or die(mysql_error());

  $GETReport=mysql_fetch_assoc($DATAReport);
  //print_r($GETReport);
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
    <!-- Ion Slider -->
    <link rel="stylesheet" href="../plugins/ionslider/ion.rangeSlider.css">
    <!-- ion slider Nice -->
    <link rel="stylesheet" href="../plugins/ionslider/ion.rangeSlider.skinNice.css">
    <!-- bootstrap slider -->
    <link rel="stylesheet" href="../plugins/bootstrap-slider/slider.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">  
    <script src="../alertmaster/dist/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="../alertmaster/dist/sweetalert.css">
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
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
            Calificación de Desempeño
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
                  <h3 class="box-title">Formulario de Calificación</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <form role="form" name="form1" action="G_nota.php" method="POST" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Calificación</label>
                      <select class="form-control" name="calificacion" required>
                        <option value="4">Excelente</option>
                        <option value="3">Alto</option>
                        <option value="2">Medio</option>
                        <option value="1">Bajo</option>
                      </select>
                    </div>
                     
                      <input type="hidden" name="incidencia" value="<?php if (isset($_GET['Data'])) { echo $idIncidencia; } ?>">
                    <div class="form-group">
                     <label for="exampleInputEmail1">Incidencia</label>
                     <p><?php  echo $GETReport['Titulo'] ; ?></p>
                    </div>
                    
                    <div class="form-group">
                     <label for="exampleInputEmail1">Tecnico</label>
                     <p><?php if (isset($_GET['Data'])) { echo $GETReport['Nombres'].' '.$GETReport['Apellidos'] ; } ?></p>
                    </div>

                    <div class="form-group">
                     <label for="exampleInputEmail1">Reporte</label>
                     <p><?php if (isset($_GET['Data'])) { echo $GETReport['Reperte'] ; } ?></p>
                    </div>

                    <div class="form-group">
                     <label for="exampleInputEmail1">Fecha de Atencion</label>
                     <p><?php if (isset($_GET['Data'])) { echo $GETReport['fecha'].'/'.$GETReport['hora'] ; } ?></p>
                    </div>

                  </div><!-- /.box-body -->

                   <div class="box-footer">
                
                    <button type="submit" class="btn btn-primary pull-right">Calificar</button>
                 
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
      <?php 
        include 'footer.php';
      ?>

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Ion Slider -->
    <script src="../plugins/ionslider/ion.rangeSlider.min.js"></script>
    <!-- Bootstrap slider -->
    <script src="../plugins/bootstrap-slider/bootstrap-slider.js"></script>

  </body>
</html>
