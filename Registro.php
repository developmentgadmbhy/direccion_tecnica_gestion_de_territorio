<?php 
include 'Connections/RootSistemas_Conexion_masterWeb.php';

$ViewDepartamentoData=mysql_query("SELECT  idDepartamento, 
                                    Departamento, 
                                    Descripcion
                                    FROM 
                                    db_master_bbh.departamento")or die(mysql_error());
//Recibe parametros de identificacion
if (isset($_GET['ViewData'])) {
    
    $PersonaID=$_GET['ViewData'];

    $ResData=mysql_query("SELECT  MD5(idPersona), 
                                  Cedula, 
                                  Nombres, 
                                  Apellidos, 
                                  Telefono, 
                                  Email, 
                                  Foto, 
                                  id_Cargo
                                  FROM 
                                  persona 
                                  WHERE MD5(idPersona)='$PersonaID'")or die(mysql_error());
    $GETDATA=mysql_fetch_assoc($ResData);     
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="alertmaster/dist/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="alertmaster/dist/sweetalert.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script language="javascript">
    $(document).ready(function(){
      $("#Departamento").change(function () {
           $("#Departamento option:selected").each(function () {
            idDepartamento = $(this).val();
            $.post("MasterApp/Selects/select_cargo.php", { idDepartamento: idDepartamento }, function(data){
                $("#cargo").html(data);
            });            
        });
      })
    });
    </script>

    <script type="text/javascript">
    var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
    function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
        var iFileSize = oInput.size;
        var iConvert = (oInput.size / 1572864).toFixed(2);
         if (sFileName.length > 0) {
            var blnValid = false;
            
            
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
            
              if ((sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) || iFileSize>1572864) {
                   blnValid = true;
                   break;
               }

            }
             
            if (!blnValid) {
                txt = "Archivo : " + sFileName + "\n\n";
                txt += "Tamaño: " + iFileSize + " MB \n\n";
                txt += "Solo archivos .JPG, .JPEG, .PNG, no mayores a 1.5 MB.\n\n";

                swal(txt);
                
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
    }


function soloNumeros(e)
{
var key = window.Event ? e.which : e.keyCode
return ((key >= 48 && key <= 57) || (key==8))
}

    </script>

  </head>
  <body class="hold-transition skin-blue sidebar-mini" background="">
    <div class="wrapper">

      <!--  ******************* Header  -   Menu **********************-->

      <?php 
     // include('header.php');
      //include('menu.php');
      ?>

      <!--  ******************* Header  -   Menu **********************-->
      <!-- Content Wrapper. Contains page content -->
      

        <section class="content">
        
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->

            <!--********************** Contenido *****************************************-->
            <section class="col-lg-3 connectedSortable">
            </section>
            <section class="col-lg-6 connectedSortable">
                 <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Formulario de Registro</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="G_register.php" method="POST" enctype="multipart/form-data">
                <br>
                  <br>
                 <center>
                  <img src="logo.png">
                  </center>
                   <br>
                  <br>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Cedula</label>
                      <input type="text" class="form-control" name="Cedula" id="Cedula" placeholder="Cedula" onKeyPress="return soloNumeros(event)" maxlength="10"
                      value="<?php if (isset($_GET['ViewData'])) { echo $GETDATA['Cedula']; } ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombres</label>
                      <input type="text" class="form-control" name="Nombres" id="Nombres" placeholder="Nombres"
                      value="<?php if (isset($_GET['ViewData'])) { echo $GETDATA['Nombres']; } ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Apellidos</label>
                      <input type="text" class="form-control" name="Apellidos" id="Apellidos" placeholder="Apellidos"
                      value="<?php if (isset($_GET['ViewData'])) { echo $GETDATA['Apellidos']; } ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Telefono</label>
                      <input type="text" class="form-control" name="Telefono" id="Telefono" placeholder="Telefono" onKeyPress="return soloNumeros(event)" maxlength="10"
                      value="<?php if (isset($_GET['ViewData'])) { echo $GETDATA['Telefono']; } ?>" required>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email institucional</label>
                      <input type="text" class="form-control" name="Email" id="Email" placeholder="Email" title="Email institucional"
                      value="<?php if (isset($_GET['ViewData'])) { echo $GETDATA['Email']; } ?>"required>
                    </div>                   
                    <div class="form-group">
                      <label for="exampleInputPassword1">Departameto</label>
                      <select name="Departamento" class="form-control" id="Departamento" required >
                      <option value="">Seleccione una...</option>
                      <?php
                      while ($fila=mysql_fetch_array($ViewDepartamentoData)) {
                      ?>
                      <option value="<?php echo $fila[0] ?>" ><?php echo $fila[1] ?></option>
                      <?php
                      }
                      ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Cargo</label>
                      <select name="cargo" class="form-control" id="cargo" required >
                      <option value="">Seleccione una...</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Foto</label>
                      <input type="file" name="image" id="exampleInputFile" onchange="ValidateSingleInput(this);" >
                      <p class="help-block">Seleccione un archivo (jpg)</p>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Registrar</button>
                  </div>
                  <br>
                  <br>
                  <br>
                  <br>

                </form>
              </div><!-- /.box -->
             </section>
             <section class="col-lg-3 connectedSortable">
             </section>
             <!--********************** Contenido *****************************************-->
            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->
    

    <!-- jQuery 2.1.4 -->
    
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTEApp -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
</html>