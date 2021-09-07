<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
include "validationfuntion.php";
$idUser=$_SESSION['MM_ID_USER'];
validar($idUser);
$Data=mysql_query("SELECT   bbh_id_zonificacion, 
                            bbh_descripcion_zon, 
                            bbh_nomenclatura_zon
                            FROM 
                            bbh_zonificacion")or die(mysql_error());
   

if (isset($_GET['Doc'])) {

$idDoc=$_GET['Doc'];
$Data1=mysql_query("SELECT  bbh_id_cert_lin_fab, 
                            bbh_num_ofic_fab, 
                            bbh_solicitante_fab, 
                            bbh_zona_fab, 
                            bbh_parroquia_fab, 
                            bbh_calle_fab, 
                            bbh_interseccion_fab, 
                            bbh_barrio_urbanizacion_fab, 
                            bbh_clave_catastral_fab, 
                            bbh_superficie_fab, 
                            bbh_manzana_fab, 
                            bbh_lote_fab, 
                            bbh_frente_fab, 
                            bbh_imagen_croquis_fab, 
                            bbh_tipo_img_fab, 
                            bbh_usuario_id_fab, 
                            bbh_fecha_fab, 
                            bbh_hota_fab, 
                            bbh_zonif_id, 
                            bbh_calle_fab_md, 
                            bbh_interseccion_fab_md, 
                            bbh_agua, 
                            bbh_electricida, 
                            bbh_calzada, 
                            bbh_bordillos, 
                            bbh_alcantarillado, 
                            bbh_telefono, 
                            bbh_aceras, 
                            bbh_relleno
                            FROM 
                            bbh_certificado_lin_fab
                            WHERE  bbh_id_cert_lin_fab=$idDoc")or die(mysql_error());

$GETData=mysql_fetch_assoc($Data1);

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
            Linia de Fábrica.
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
            <section class="col-lg-1 connectedSortable">
            </section>
            <section class="col-lg-10 connectedSortable">
                 <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Formulario Certificado Linia de Fábrica  &nbsp;&nbsp;&nbsp;&nbsp; <spam class="stl">Babahoyo, <?php echo date('d').' '.$mes[$numeroMes].' '.date("Y"); ?></spam></h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <?php if (isset($_GET['Doc'])) { ?>
                 <form role="form" action="ac_lnf.php" method="post"  enctype="multipart/form-data">
                <?php } ?>
                <?php if (!isset($_GET['Doc'])) { ?>
                 <form role="form" action="g_lnf.php" method="post"  enctype="multipart/form-data">
                <?php } ?>

                <form role="form" action="g_lnf.php" method="post"  enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Solicitante:</label>
                      <input type="text" class="form-control" name="Propietario" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_solicitante_fab']; } ?>" id="Propietario" placeholder="Propietario" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Ubicación del Predio:</label>
                    </div>

                    <div class="row">
                  
                     <div class="col-lg-6 col-xs-12">
                      
                      <div class="form-group">
                          <label for="exampleInputEmail1">Zona:</label>
                          <input type="text" class="form-control" name="Zona" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_zona_fab']; } ?>" id="Zona" placeholder="Zona" required>
                      </div>

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
                        
                         <div class="form-group">
                          <label for="exampleInputEmail1">Clave:</label>
                          <input type="text" class="form-control" name="Clave" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_clave_catastral_fab']; } ?>" id="Clave" placeholder="Clave Catastral" required>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Barrio o Urbanización:</label>
                          <input type="text" class="form-control" name="bu" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_barrio_urbanizacion_fab']; } ?>" id="bu" placeholder="Barrio o Urbanización" required>
                        </div>
                         
                        <div class="form-group">
                          <label for="exampleInputEmail1">Frente:</label>
                          <input type="text" class="form-control" name="Frente" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_frente_fab']; } ?>" id="Frente" placeholder="00,00ml" required>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Lote:</label>
                          <input type="text" class="form-control" name="Lote" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_lote_fab']; } ?>" id="Lote" placeholder="Lote" required>
                        </div>
    
                        
                        <div class="form-group">
                          <label for="exampleInputEmail1">Superficie:</label>
                          <input type="text" class="form-control" name="Superficie" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_superficie_fab']; } ?>" id="Superficie" placeholder="Superficie" required>
                        </div>

                    </div>
                   
                    <div class="col-lg-6 col-xs-12">

                         <div class="form-group">
                          <label for="exampleInputEmail1">Calle:</label>
                          <input type="text" class="form-control" name="Calle" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_calle_fab']; } ?>" id="Calle" placeholder="Calle" required>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Datos de la Via Calle:</label>
                          <input type="text" class="form-control" name="dvc" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_calle_fab_md']; } ?>" id="dvc" placeholder="Datos de la Via Calle" required>
                        </div>

                         <div class="form-group">
                          <label for="exampleInputEmail1">Intersección:</label>
                          <input type="text" class="form-control" name="Interseccion" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_interseccion_fab']; } ?>" id="Interseccion" placeholder="Intersección" required>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Datos de la Via Interseccion:</label>
                          <input type="text" class="form-control" name="dvi" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_interseccion_fab_md']; } ?>" id="dvi" placeholder="Datos de la Via Interseccion" required>
                        </div>                  
                        
                        <div class="form-group">
                          <label for="exampleInputEmail1">Manzana:</label>
                          <input type="text" class="form-control" name="Manzana" value="<?php if (isset($_GET['Doc'])) { echo $GETData['bbh_manzana_fab']; } ?>" id="Manzana" placeholder="Manzana" required>
                        </div>
            

                        <div class="form-group">
                        <label for="exampleInputPassword1">Zonificacion:</label>
                        <select name="zonificacion" id="zonificacion" class="form-control" required>
                          <option value="">Seleccione una opcion...</option>
                          <?php
                          while($fila=mysql_fetch_array($Data)){
                            ?>
                              <option value="<?php echo $fila['bbh_id_zonificacion']; ?>"><?php echo $fila['bbh_nomenclatura_zon']; ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>


                        <div class="form-group">
                          <label for="exampleInputFile">CROQUIS:</label>
                          <input type="file" name="image"  id="exampleInputFile" onchange="ValidateSingleInput(this);" required/>
                          <p class="help-block">Seleccione un archivo (jpg)</p>
                        </div>

                    </div>
                   
                    </div>

                    <div class="row">
                        <div class="col-lg-2 col-xs-12">
                        <div class="form-group">
                          <label for="exampleInputFile">Agua Potable:</label>
                          <input type="checkbox"  id="c1" name="c1" <?php if (isset($_GET['Doc'])) {if($GETData['bbh_agua']=='on'){ echo "checked";} } ?>/>
                        </div>
                        </div>

                        <div class="col-lg-2 col-xs-12">
                        <div class="form-group">
                          <label for="exampleInputFile">Electricidad:</label>
                          <input type="checkbox"  id="c2" name="c2" <?php if (isset($_GET['Doc'])) { if($GETData['bbh_electricida']=='on'){ echo "checked";}  } ?>/>
                        </div>
                        </div>

                        <div class="col-lg-2 col-xs-12">
                        <div class="form-group">
                          <label for="exampleInputFile">Calzada:</label>
                          <input type="checkbox" id="c3"  name="c3" <?php if (isset($_GET['Doc'])) {  if($GETData['bbh_calzada']=='on'){ echo "checked";} } ?>/>
                        </div>
                        </div>

                        <div class="col-lg-2 col-xs-12">
                        <div class="form-group">
                          <label for="exampleInputFile">Bordillos:</label>
                          <input type="checkbox" id="c4"  name="c4" <?php if (isset($_GET['Doc'])) { if($GETData['bbh_bordillos']=='on'){ echo "checked";} } ?> />
                        </div>
                        </div>

                        <div class="col-lg-2 col-xs-12">
                        <div class="form-group">
                          <label for="exampleInputFile">Alcantarillado:</label>
                          <input type="checkbox" id="c5"  name="c5" <?php if (isset($_GET['Doc'])) { if($GETData['bbh_alcantarillado']=='on'){ echo "checked";}  } ?>/>
                        </div>
                        </div>

                        <div class="col-lg-2 col-xs-12">
                        <div class="form-group">
                          <label for="exampleInputFile">Telefono:</label>
                          <input type="checkbox" id="c6" name="c6"  <?php if (isset($_GET['Doc'])) { if($GETData['bbh_telefono']=='on'){ echo "checked";}  } ?>/>
                        </div>
                        </div>

                        <div class="col-lg-2 col-xs-12">
                        <div class="form-group">
                          <label for="exampleInputFile">Aceras:</label>
                          <input type="checkbox" id="c7" name="c7"  <?php if (isset($_GET['Doc'])) { if($GETData['bbh_aceras']=='on'){ echo "checked";}  } ?> />
                        </div>
                        </div>

                        <div class="col-lg-2 col-xs-12">
                        <div class="form-group">
                          <label for="exampleInputFile">Relleno:</label>
                          <input type="checkbox"  id="c8" name="c8"  <?php if (isset($_GET['Doc'])) { if($GETData['bbh_relleno']=='on'){ echo "checked";}  } ?>/>
                        </div>
                        </div>


                     <?php if (isset($_GET['Doc'])) { 
                      ?>
                      <input type="hidden" value="<?php echo $_GET['Doc']; ?>" name="actualizar">
                      <?php
                      } ?>

                    </div>

                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                  </div>
                </form>
              </div><!-- /.box -->
             </section>
             <section class="col-lg-1 connectedSortable">
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
