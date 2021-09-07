<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
include "validationfuntion.php";
$idUser=$_SESSION['MM_ID_USER'];
validar($idUser);
$GetDatos=mysql_query("SELECT   bbh_id_provincia, 
                                bbh_provincia
                                FROM 
                                bbh_provincia")or die(mysql_error());
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DTGT</title>
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

    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>

 <!-- SCRIPT SELECT CANTON -->
    <script language="javascript">
    $(document).ready(function(){
      $("#Provincias").change(function () {
           $("#Provincias option:selected").each(function () {
            Provincias = $(this).val();
            $.post("Selects/select_cargo.php", { Provincias: Provincias }, function(data){
                $("#Canton1").html(data);
            });            
        });
      })
    });
    </script>
 <!-- SCRIPT SELECT CANTON -->

  <!-- SCRIPT SELECT CANTON -->
    <script language="javascript">
    $(document).ready(function(){
      $("#Canton1").change(function () {
           $("#Canton1 option:selected").each(function () {
            Canton1 = $(this).val();
            $.post("Selects/select_cargo.php", { Canton1: Canton1 }, function(data){
                $("#Parroquia1").html(data);
            });            
        });
      })
    });
    </script>
  <!-- SCRIPT SELECT CANTON -->

    <!-- SCRIPT SELECT PARROQUIA -->
    <script language="javascript">
    $(document).ready(function(){
      $("#Parroquia1").change(function () {
           $("#Parroquia1 option:selected").each(function () {
            Parroquia1 = $(this).val();
            $.post("Selects/select_cargo.php", { Parroquia1: Parroquia1 }, function(data){
                $("#Recinto").html(data);
            });            
        });
      })
    });
    </script>
  <!-- SCRIPT SELECT PARROQUIA -->
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
            Ingresos
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
            <section class="col-lg-2 connectedSortable">
            </section>
            <section class="col-lg-8 connectedSortable">
                 <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Formulario Recintos </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
            <form role="form" action="colectaDatos.php" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Provincias</label>
                      <select name="Provincias" id="Provincias" class="form-control" required>
                      <option value="">Seleccione una opcion...</option>
                      <?php 
                      while ($fila=mysql_fetch_assoc($GetDatos)) {
                       ?>
                       <option value="<?php echo $fila['bbh_id_provincia']; ?>"><?php echo $fila['bbh_provincia']; ?></option>
                       <?php
                      }
                      ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Canton:</label>
                      <select name="Canton1" id="Canton1" class="form-control" required>
                        <option value="">Seleccione una opcion...</option>
                      </select>
                    </div>

                     <div class="form-group">
                      <label for="exampleInputPassword1">Parroquia:</label>
                      <select name="Parroquia" id="Parroquia1" class="form-control" required>
                        <option value="">Seleccione una opcion...</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Recinto:</label>
                      <select name="Recinto" id="Recinto" class="form-control" required>
                        <option value="">Seleccione una opcion...</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Sector:</label>
                      <input type="text" class="form-control" name="Sector" id="Sector" placeholder="Sector" required>
                    </div>
                  </div><!-- /.box-body -->
                  <input type="hidden" name="dato" value="7">
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                  </div>
                </form>
              </div><!-- /.box -->
             </section>
             <section class="col-lg-2 connectedSortable">
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
