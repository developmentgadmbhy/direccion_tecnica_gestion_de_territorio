<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
include "validationfuntion.php";
$idUser=$_SESSION['MM_ID_USER'];
validar($idUser);

if(!isset($_SESSION['Liquidacion'])){
	header("location: index.php");
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
  

    <!-- SCRIPT SELECT PARROQUIAS -->

  <style type="text/css">
    
    .InpTextc{
      text-align: center;
    }

    #Urb{
      display: none;
    }

    #rurl{
       display: none;
    }

    #liq{
       display: none;
       padding-top: 10px;
    }

    #liq1{
       display: none;
       padding-top: 10px;
    }


  </style>

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
            Liquidaciones.
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
                  <h3 class="box-title">Liquidacion &nbsp;&nbsp;&nbsp;&nbsp; <spam class="stl">Babahoyo, <?php echo date('d').' '.$mes[$numeroMes].' '.date("Y"); ?></spam></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
        

               
                  <div class="box-body">
                    
                    <div class="row">
                  
                     <div class="col-lg-12 col-xs-12">
                    
                      <div class="form-group">
                        <label for="exampleInputPassword1">Tipo de Predio:</label>
                        <select name="tipoPredrio" id="tipoPredrio" class="form-control" required>
                        <option value="">Seleccione una opcion...</option>
                        <option value="1">Urbano</option>
                        <option value="2">Rural</option>
                        </select>
                      </div>

                    </div>

                      <div id="Urb">
      					          <div class="col-lg-1 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Zona</label>
                            	<input type="number" class="form-control InpTextc" maxlength="3" value="0" name="zona" id="zona">
                            </div>
                          </div>
                          
                          <div class="col-lg-1 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Sector</label>
                            	<input type="number" class="form-control InpTextc" maxlength="3" value="0"  name="Sector" id="Sector">
                            </div>
                          </div>
                          
                          <div class="col-lg-1 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Manzana</label>
                            	<input type="number" class="form-control InpTextc" maxlength="3" value="0"  name="Manzana" id="Manzana">
                            </div>
                          </div>
                          
                          <div class="col-lg-1 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Solar</label>
                            	<input type="number" class="form-control InpTextc" maxlength="3" value="0"  name="Solar" id="Solar">
                            </div>
                          </div>

                          <div class="col-lg-1 col-xs-12">
                          </div>

                          <div class="col-lg-1 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Div1</label>
                            	<input type="number" class="form-control InpTextc" maxlength="3" value="0"  name="Div1" id="Div1">
                            </div>
                          </div>

                          <div class="col-lg-1 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Div2</label>
                            	<input type="number" class="form-control InpTextc" maxlength="3" value="0"  name="Div2" id="Div2">
                            </div>
                          </div>

                          <div class="col-lg-1 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Div3</label>
                            	<input type="number" class="form-control InpTextc" maxlength="3" value="0"  name="Div3" id="Div3">
                            </div>
                          </div>

                          <div class="col-lg-1 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Div4</label>
                            	<input type="number" class="form-control InpTextc" maxlength="3" value="0"  name="Div4" id="Div4">
                            </div>
                          </div>

                           <div class="col-lg-1 col-xs-12">
                          </div>
                         
                          <div class="col-lg-1 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">PHV</label>
                            	<input type="number" class="form-control InpTextc" maxlength="3" value="0"  name="PHV" id="PHV">
                            </div>
                          </div>

                          <div class="col-lg-1 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">PHH</label>
                            	<input type="number" class="form-control InpTextc" maxlength="3" value="0"  name="PHH" id="PHH">
                            </div>
                          </div>


                          <div class="col-lg-1 col-xs-12">
                           <button type="button" id="btnBuscar" class="btn btn-warning pull-right" disabled="true">Buscar</button>
                          </div>

                           <div class="col-lg-1 col-xs-12">
                           <button type="button" id="Limpiar" class="btn btn-success pull-right Limpiar">Limpiar</button>
                          </div>

                      </div>


                      <!-- RURAL -->
                      <div id="rurl">
                        
                         <div class="col-lg-4 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Codigo Rual</label>
                              <input type="number" class="form-control InpTextc" maxlength="12" value="0"  name="Clave" id="Clave">
                            </div>
                          </div>

                          <div class="col-lg-1 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Parroquia</label>
                              <input type="number" class="form-control InpTextc" maxlength="2" value="0"  name="parroquia" id="parroquia">
                            </div>
                          </div>


                          <div class="col-lg-1 col-xs-12">
                            <label for="exampleInputPassword1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                           <button type="button" id="btnBuscarRural" class="btn btn-warning pull-right" disabled="true">Buscar</button>
                          </div>

                           <div class="col-lg-1 col-xs-12">
                            <label for="exampleInputPassword1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                           <button type="button" id="Limpiar1" class="btn btn-success pull-right Limpiar">Limpiar</button>
                          </div>

                      </div>
                      <!-- RURAL -->

                      <br>
                      <br><br>

                       <div class="col-lg-12 col-xs-12">
                       </div>

                      <div class="col-lg-6 col-xs-12" id="liq">
                      	<div><h2  id="textCombo"></h2></div>
                        
                        <table width="100%" border="1">
                          <tr>
                            <td colspan="2" align="center">Avaluos Municipales</td>
                          </tr>
                          <tr>
                            <td> Avaluo Solar </td>
                            <td align="center" id="avSolar"></td>
                          </tr>
                          <tr>
                            <td>Avaluo Construccion</td>
                            <td align="center" id="avConstruccion"></td>
                          </tr>
                          <tr>
                            <td>Avaluo Municipal</td>
                            <td align="center" id="avMunicipal"></td>
                          </tr>
                        </table>
                          
                          <br>
                          <br>
  
                        <table id="tbl1" width="100%" border="1">
                          <thead>
                            <th>Descripcion</th>
                            <th>Valor</th>                            
                          </thead>
                          <tbody id="rellenoValor">
                            
                          </tbody>
                          <tfoot>
                            <tr>
                              <td>Total</td>
                              <td id="totalVal"></td>
                            </tr>
                          </tfoot>
                        </table>


                      </div>

                      <div class="col-lg-6 col-xs-12" id="liq1">

                        <div class="col-lg-12 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Tasas por Servicios Técnicos Administrativos</label>

                              <select class="form-control" name="tramites" id="tramites">
                                <option value="" id="defaul">Seleccione Una...</option>
                               
                              </select>



                            </div>
                          </div>

  
                         <div class="col-lg-12 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Nombres</label>
                              <input type="text" class="form-control" value="" placeholder="Nombres" name="Nombres" id="Nombres" disabled="true">
                            </div>
                          </div>


                         <div class="col-lg-12 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Apellidos</label>
                              <input type="text" class="form-control" value="" placeholder="Apellidos" name="Apellidos" id="Apellidos" disabled="true">
                            </div>
                          </div>

                          <div class="col-lg-12 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Cedula</label>
                              <input type="text" class="form-control" value="" placeholder="Cedula" name="Cedula" id="Cedula" >
                            </div>
                          </div>

                          <div class="col-lg-12 col-xs-12">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Concepto</label>
                              <textarea  class="form-control" value="" name="Concepto" id="Concepto"> </textarea> 
                            </div>
                          </div>

                          <input type="hidden" name="codPredio" id="codPredio">
                          <input type="hidden" name="codUsuario" id="codUsuario">
                          <input type="hidden" name="areaSolar" id="areaSolar">

                          <input type="hidden" name="avlSolar" id="avlSolar">
                          <input type="hidden" name="avlConstruccion" id="avlConstruccion">
                          <input type="hidden" name="avlMunicipal" id="avlMunicipal">
                          <input type="hidden" name="valorestotales" value="" id="valorestotales">
        

                      </div>




                    </div>

                

                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="button" class="btn btn-primary pull-right" disabled="true" id="saveProcess">Guardar</button>  </div>
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
    <script src="js/app.js"></script>
  </body>
</html>
