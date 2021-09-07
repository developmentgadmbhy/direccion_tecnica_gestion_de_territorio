<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
include "validationfuntion.php";
$idUser=$_SESSION['MM_ID_USER'];
validar($idUser);

   
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
      
      if(isset($_GET['Doc'])){
	  	$idRcdoc=$_GET['Doc'];
	  	$dataVi=mysql_query("SELECT 	bbh_id_desm, 
										bbh_numero_desmen, 
										bbh_descripcion_desm, 
										bbh_delm_norte, 
										bbh_delm_sur, 
										bbh_delm_este, 
										bbh_delm_oeste, 
										bbh_aclaratoria_dems, 
										bbh_solicitante_dems, 
										bbh_fecha_dems, 
										bbh_hora__dems, 
										bbh_id_usuario, 
										bbh_tipo_desm
										FROM 
										bbh_desmenbracion
										WHERE bbh_id_desm=$idRcdoc")or die(mysql_error());
		$GetDatos=mysql_fetch_assoc($dataVi);
	  }
      ?>

      <!--  ******************* Header  -   Menu **********************-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Permiso de Construcción.
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
                  <h3 class="box-title">Formulario Desmembracion  &nbsp;&nbsp;&nbsp;&nbsp; <spam class="stl">Babahoyo, <?php echo date('d').' '.$mes[$numeroMes].' '.date("Y"); ?></spam></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <?php if(isset($_GET['Doc'])){ 
                ?>
                <form role="form" action="up_desm.php" method="post">
                <input type="hidden" name="update" value="<?php echo $GetDatos['bbh_id_desm']; ?>"/>
                <?php
                 }elseif(!isset($_GET['Doc'])){
                 	?>
                 	<form role="form" action="g_desm.php" method="post">
                 	<?php
                 	} ?>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Propietario(a):</label>
                      <input type="text" class="form-control" name="Propietario" value="<?php if(isset($_GET['Doc'])){ echo $GetDatos['bbh_solicitante_dems']; } ?>" id="Propietario" placeholder="Propietario" required>
                    </div>

                    <div class="form-group"> 
                      <label for="exampleInputEmail1">Descripcion del Proyecto:</label>
                      <textarea class="form-control" name="descripcion" placeholder="Se otroga EL PERMISO PARA LA CONSTRUCCION DE UN LOCAL......" required><?php if(isset($_GET['Doc'])){ echo $GetDatos['bbh_descripcion_desm']; } ?></textarea>
                    </div>
                    
                    <div class="row">
                  
                     <div class="col-lg-6 col-xs-12">
                       <div class="form-group">
                          <label for="exampleInputEmail1">Por el Norte:</label>
                          <input type="text" class="form-control" name="norte" value="<?php if(isset($_GET['Doc'])){ echo $GetDatos['bbh_delm_norte']; } ?>" id="norte" placeholder="Por el Norte" required>
                        </div>
                         <div class="form-group">
                          <label for="exampleInputEmail1">Por el Este:</label>
                          <input type="text" class="form-control" name="este" value="<?php if(isset($_GET['Doc'])){ echo $GetDatos['bbh_delm_este']; } ?>" id="este" placeholder="Por el Este" required>
                        </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Tipo Desmembracion:</label>
                        <select name="tipodes" id="tipodes" class="form-control" required>
                        
                        <?php if(isset($_GET['Doc'])){ 
                         if($GetDatos['bbh_tipo_desm']==1){
                         echo '<option value="1">Urbana</option>';
                         echo '<option value="2">Extrajudicial</option>';
                         }elseif($GetDatos['bbh_tipo_desm']==2){
						 	echo '<option value="2">Extrajudicial</option>';
						 	echo '<option value="1">Urbana</option>';
						 }
                         }else{
                         	?>
                         	<option value="">Seleccione una opcion...</option>
                         	<option value="1">Urbana</option>
                        <option value="2">Extrajudicial</option>
                         	<?php
                         	} ?>
                        
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-6 col-xs-12">
                       <div class="form-group">
                          <label for="exampleInputEmail1">Por el Sur:</label>
                          <input type="text" class="form-control" name="sur" value="<?php if(isset($_GET['Doc'])){ echo $GetDatos['bbh_delm_sur']; } ?>" id="sur" placeholder="Por el Sur" required>
                        </div>
                         <div class="form-group">
                          <label for="exampleInputEmail1">Por el Oeste:</label>
                          <input type="text" class="form-control" name="oeste" value="<?php if(isset($_GET['Doc'])){ echo $GetDatos['bbh_delm_oeste']; } ?>" id="oeste" placeholder="Por el Oeste" required>
                        </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Numero de Desmembramientos:</label>
                        <select name="numds" id="numds" class="form-control" required>
                        <option value="">Seleccione una...</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                        </select>
                      </div>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Siguiente</button>
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
