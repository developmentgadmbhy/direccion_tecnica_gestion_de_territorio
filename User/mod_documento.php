<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
include "validationfuntion.php";
 $idUser=$_SESSION['MM_ID_USER'];
validar($idUser);


$tipo_doct=mysql_query("SELECT   id_tipo, 
  nom_tipo, 
  descripcion_tipo
  FROM 
  db_master_bbh.tipo_doc")or die(mysql_error());

  //$GET_doc=mysql_fetch_assoc($tipo_doc);

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
            Documentos
          </h1>
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
                  <h3 class="box-title">Recepcion de Documentos</h3>
                </div><!-- /.box-header -->


 <?php
   $_SESSION['cod']=$_GET["Data"];
    $sql_mov = "SELECT * FROM documentos where id_documentos='".$_GET["Data"]."'";
    $result_mov = mysql_query($sql_mov);
    
    while ($row_mov = mysql_fetch_array($result_mov))
      { ?>







                <!-- form start -->
                <form role="form" action="" method="POST" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre Documento</label>
                      <input type="text" class="form-control" id="NDoc" name="NDoc" placeholder="Nombre Documento" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Numero Oficio</label>
                      <input type="text" class="form-control" id="documento_ident" name="documento_ident" placeholder="Numero Oficio" required>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tipo de Documento</label>
                      <select name="tipo" class="form-control" required>
                        <option value="">Seleccione una...</option>
                        <?php 
                        while ($filla=mysql_fetch_array($tipo_doct)) {
                        ?>
                        <option value="<?php echo $filla[0] ?>"><?php echo $filla[1] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Asunto</label>
                      <input type="text" class="form-control" id="Asunto" name="Asunto" placeholder="Asunto" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Remitente</label>
                      <input type="text" class="form-control" id="Remitente" name="Remitente" placeholder="Remitente" required>
                    </div>
                    
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="enviar" value="1" class="btn btn-primary pull-right">Recibir</button>
                  </div>
                </form>

 <?php
              }

 if(isset($_POST["enviar"])){
  $sql = "UPDATE documentos SET titulo ='".strtoupper($_POST['NDoc'])."' , asunto='".$_POST['Asunto']."', remitente='".$_POST['Remitente']."' , id_tipo_doc='".$_POST['tipo']."', documento_ident='".$_POST['documento_ident']."'    WHERE id_documentos= '".$_SESSION['cod']."'";

  
        if(mysql_query($sql,$cone)){

            
            ?>
        <script type="text/javascript">
    alert("\t  Modificacion Correcto\n \t");
    window.location = "view_documentos.php";
    </script>
    <?php     
      
        }else{
    
  
  
      ?>
        <script type="text/javascript">
    alert("\t  Modificacion Incorrecto\n \t");
    window.location = "view_documentos.php";
    </script>
    <?php       
  }
     
  }

?>



              </div><!-- /.box -->
             </section>
             <section class="col-lg-2 connectedSortable">
             </section>
             <!--********************** Contenido *****************************************-->
            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include "footer.php"; ?>

      
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
