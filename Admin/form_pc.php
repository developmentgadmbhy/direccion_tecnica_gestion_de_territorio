<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
include "validationfuntion.php";
$idUser=$_SESSION['MM_ID_USER'];
validar($idUser);

if (isset($_GET['Doc'])) {

$idDoc=$_GET['Doc'];
$Data=mysql_query("SELECT   bbh_id_permiso_cont_pc, 
  bbh_numero_permiso_pc, 
  bbh_propietario_pc, 
  bbh_parroquia_pc, 
  bbh_sector_pc, 
  bbh_calle_pc, 
  bbh_clave_catastral_pc, 
  bbh_descripcion_pc, 
  bbh_area_pc, 
  bbh_usuario_id_pc, 
  bbh_fecha_pc, 
  bbh_hora_pc
  FROM 
  bbh_permiso_construccion 
  WHERE bbh_id_permiso_cont_pc=$idDoc")or die(mysql_error());

$GETData=mysql_fetch_assoc($Data);

}
   
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
      $("#tipoparroquia").change(function () {
           $("#tipoparroquia option:selected").each(function () {
            tipoparroquia = $(this).val();
            if (tipoparroquia==1) {
              document.getElementById("d_area").style.display = "block";
              document.getElementById("d_area1").style.display = "none";
            };

             if (tipoparroquia==2) {
              document.getElementById("d_area").style.display = "none";
              document.getElementById("d_area1").style.display = "block";
            };

            $.post("Selects/select_cargo.php", { tipoparroquia: tipoparroquia }, function(data){
                $("#Parroquia2").html(data);
            });            
        });
      })
    });
    </script>
    <!-- SCRIPT SELECT CANTON -->


    <!-- SCRIPT SELECT PARROQUIAS -->
   <script language="javascript">
    $(document).ready(function(){
      $("#Parroquia2").change(function () {
           $("#Parroquia2 option:selected").each(function () {
            Parroquia2 = $(this).val();
            $.post("Selects/select_cargo.php", { Parroquia2: Parroquia2 }, function(data){
                $("#Ciudadela").html(data);
                $("#Recinto").html(data);
            });            
        });
      })
    });
    </script>

    <!-- SCRIPT SELECT PARROQUIAS -->
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
            Permiso de Construcci??n.
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
                  <h3 class="box-title">Formulario Permiso de Construcci??n  &nbsp;&nbsp;&nbsp;&nbsp; <spam class="stl">Babahoyo, <?php echo date('d').' '.$mes[$numeroMes].' '.date("Y"); ?></spam></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php if (isset($_GET['Doc'])) { ?>
                <form role="form" action="ac_pcntr.php" method="post">
                <?php } ?>

                <?php if (!isset($_GET['Doc'])) { ?>
                <form role="form" action="g_pcntr.php" method="post">
                 <?php } ?>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Propietario(a):</label>
                      <input type="text" class="form-control" name="Propietario" id="Propietario" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_propietario_pc']; } ?>" placeholder="Propietario" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Ubicaci??n del Predio:</label>
                    </div>

                    <div class="row">
                  
                     <div class="col-lg-6 col-xs-12">
                    
                      <div class="form-group">
                        <label for="exampleInputPassword1">Tipo Parroquia:</label>
                        <select name="tipoparroquia" id="tipoparroquia" class="form-control" required>
                        <option value="">Seleccione una opcion...</option>
                        <option value="1">Urbana</option>
                        <option value="2">Rural</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputPassword1">Parroquia:</label>
                        <select name="Parroquia2" id="Parroquia2" class="form-control" required>
                          <option value="">Seleccione una opcion...</option>
                        </select>
                      </div>
                      
                      <div class="form-group" id="d_area" style="display: none">
                       <label for="exampleInputPassword1">Ciudadela:</label>
                        <select name="Ciudadela" id="Ciudadela" class="form-control" >
                          <option value="">Seleccione una opcion...</option>
                        </select>
                      </div>

                      <div class="form-group" id="d_area1" style="display: none">
                        <label for="exampleInputPassword1">Recinto:</label>
                        <select name="Recinto" id="Recinto" class="form-control" >
                         <option value="">Seleccione una opcion...</option>
                        </select>
                      </div>


                    </div>
                   
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Calle:</label>
                          <input type="text" class="form-control" name="Calle"  value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_calle_pc']; } ?>" id="Calle" placeholder="Calle" required>
                        </div>
    
                        <div class="form-group">
                          <label for="exampleInputEmail1">Clave Catastral:</label>
                          <input type="text" class="form-control" name="Clave" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_clave_catastral_pc']; } ?>" id="Clave" placeholder="Clave" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Area:</label>
                          <input type="text" class="form-control" name="Area" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_area_pc']; } ?>" id="Area" placeholder="Area" required>
                        </div>

                    </div>
                   
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Descripcion del Proyecto:</label>
                      <textarea class="form-control" name="descripcion" placeholder="Se otroga EL PERMISO PARA LA CONSTRUCCION DE UN LOCAL......" required><?php if (isset($_GET['Doc'])) { echo $GETData['bbh_descripcion_pc']; } ?></textarea>
                    </div>
                    
                    <?php if (isset($_GET['Doc'])) { 
                      ?>
                      <input type="hidden" value="<?php echo $_GET['Doc']; ?>" name="actualizar">
                      <?php
                      } ?>
                      
                      <?php if (isset($_GET['Ren'])) { 
                      ?>
                      <input type="hidden" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_numero_permiso_pc']; } ?>" name="renovar">
                      <?php
                      } ?>

                  </div><!-- /.box-body -->

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
