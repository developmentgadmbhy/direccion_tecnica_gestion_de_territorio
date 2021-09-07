<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
//include "validationfuntion.php";
//$idUser=$_SESSION['MM_ID_USER'];
//validar($idUser);

   
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
    <!--<script src="ajax.js"></script>-->
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
            EVIN
          </h1>
          
        </section>
         <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
        
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <?php 
            $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $numeroMes = date("m")-1;

           
            ?>
            <style type="text/css">
            .stl{
              text-align: right;
              text-decoration: underline;
            }
            </style>
<!--********************** Contenido *****************************************-->

            <section class="col-lg-12 connectedSortable">
                 <div class="box box-primary">
                <div class="box-header with-border">
                <table width="100%" border="1">
                  <tr>
                  <td><img src="" width="150px" height="80px"></td>
                  <td>
                  <h3 class="box-title">Ficha de Levantamiento EVIN </h3>
                  </td>
                  <td>Ficha Numero:</td>
                  </tr>
                </table>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                <table width="100%" border="1">
                  <tr>
                    <td width="70%"><b>Evento Generador:</b> </td>
                    <td width="15%"><b>Hora de Evento:</b></td>
                    <td width="15%"><b>Recorrido:</b></td>
                  </tr>
                  </table>
                  <table width="100%" border="1">
                  <tr>
                    <td width="30%"><b>Canton:</b></td>
                    <td width="30%"><b>Parroquia:</b></td>
                    <td rowspan="2"><b>Cooredenadas:</b></td>
                    <td width="25%"><b>Longitude:</b></td>
                  </tr>
                  <tr>
                    <td><b>Recinto:</b></td>
                    <td><b>Sector:</b></td>
                    <td><b>Latitude:</b></td>
                  </tr>
                </table>
                <table width="100%" border="1">
                  <tr>
                    <td width="30%"><b>Datos de Familias - Personas</b></td>
                    <td><b>AFECT.</b></td>
                    <td><b>DAMNIF.</b></td>
                    <td><b>DUEÑO.</b></td>
                    <td><b>CEDULA.</b></td>
                    <td><b>EDAD.</b></td>
                    <td><b>SEX.</b></td>
                    <td><b>TELF.</b></td>
                    <td><b>PARENTES.</b></td>
                    <td><b>DISC. %</b></td>
                  </tr>
                  <tr>
                    <td width="30%">NN</td>
                    <td>NN</td>
                    <td>NN</td>
                    <td>NN</td>
                    <td>NN</td>
                    <td>NN</td>
                    <td>NN</td>
                    <td>NN</td>
                    <td>NN</td>
                    <td>NN</td>
                  </tr>
                </table>
                <table width="100%" border="1">
                  <tr>
                    <td width="70%"><b>Caracteristicas de la Vivienda:</b></td>
                    <td width="30%"><b>Bono de Desarrollo Humano:</b></td>
                  </tr>
                  <tr>
                    <td colspan="2"><b>Descripcion del Evento:</b></td>
                  </tr>
                  </table>
                  <table width="100%" border="1">
                  <tr>
                    <td rowspan="2" width="60%"><b>Perdidas</b></td>
                    <td><b>Humanas</b></td>
                    <td><b>Materiales</b></td>
                    <td><b>Economicas</b></td>
                    <td><b>otros</b></td>
                  </tr>
                  <tr>
                    <td>NN</td>
                    <td>NN</td>
                    <td>NN</td>
                    <td>NN</td>
                  </tr>
                  </table>
                  <table width="100%" border="1">
                  <tr>
                    <td colspan="2"><center><b>Actiucion de Unidades de Socorro</b></center></td>
                  </tr>
                  <tr>
                    <td width="50%"><b>Recursos:</b></td>
                    <td width="50%"><b>Cantidad:</b></td>
                  </tr>
                  <!-- ************************************ -->
                  <tr>
                    <td width="50%">NN</td>
                    <td width="50%">NN</td>
                  </tr>
                  <!-- ************************************ -->
                  <tr>
                    <td><b>Elementos:</b></td>
                    <td><b>Cantidad:</b></td>
                  </tr>
                  <!-- ************************************ -->
                   <tr>
                    <td width="50%">NN</td>
                    <td width="50%">NN</td>
                  </tr>
                  <!-- ************************************ -->
                </table>
                <table width="100%" border="1">
                  <tr>
                    <td width="50%"><center><b>OBSERVACIONES - NECESIDADES</b></center></td>
                    <td width="50%"><center><b>EVIDENCIAS FOTOGRAFICAS</b></center></td>
                  </tr>
                  <tr>
                    <td>NN</td>
                    <td>NN</td>
                  </tr>
                </table>
                <table width="100%" border="1">
                  <tr>
                    <td><b>Datos de Lugar Acogiente:</b></td>
                    <td><b>N° De Miembros:</b></td>
                    <td><b>ELABORADO POR:</b></td>
                  </tr>
                </table>
                </div>
           
              </div><!-- /.box -->
             </section>
           
  <!--********************** Contenido *****************************************-->


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
