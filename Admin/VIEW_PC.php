<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
include "validationfuntion.php";
$idUser=$_SESSION['MM_ID_USER'];
validar($idUser);
$viewCargo=mysql_query("SELECT  bbh_id_permiso_cont_pc, 
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
  bbh_hora_pc,
  CONCAT(bbh_persona.bbh_nombres,' ',bbh_persona.bbh_apellidos)AS nombre
  FROM 
  bbh_permiso_construccion, bbh_usuario, bbh_persona
  WHERE bbh_permiso_construccion.bbh_usuario_id_pc=bbh_usuario.bbh_id_usuario 
  AND bbh_usuario.bbh_persona_id=bbh_persona.bbh_id_persona")or die(mysql_error());
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
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

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
            Listado de Documentos
            <small>Permisos de Construci??n</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
             
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Vista de datos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                 
                 </br>
                 </br>
                 </br>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>N??mero</th>
                        <th>Clave Catastral</th>
                        <th>Usuario</th>
                        <th>Solicitante</th>
                        <th>Fehca</th>
                        <th>Hora</th>
                        <th>Editar</th>
                        <th>Renovar</th>
                        <th>Imprimir</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    while ($DataView=mysql_fetch_array($viewCargo)) {
                    ?>
                      <tr>
                        <td><?php echo $DataView['bbh_numero_permiso_pc']; ?></td>
                        <td><?php echo $DataView['bbh_clave_catastral_pc']?></td>
                        <td><?php echo $DataView['nombre']?></td>
                        <td><?php echo $DataView['bbh_propietario_pc']?></td>
                        <td><?php echo $DataView['bbh_fecha_pc']?></td>
                        <td><?php echo $DataView['bbh_hora_pc']?></td>
                        <td><a href="form_pc.php?Doc=<?php echo $DataView['bbh_id_permiso_cont_pc'] ?>" target="_blank">Editar</a></td>
                        <td><a href="form_pc.php?Doc=<?php echo $DataView['bbh_id_permiso_cont_pc'] ?>&Ren=true" target="_blank">Renovar</a></td>
                        <td><a href="../tcpdf/examples/pdf_permiso_construcccion.php?Doc=<?php echo $DataView['bbh_id_permiso_cont_pc'] ?>" target="_blank">Imprimimr</a></td>
                      </tr>
                     <?php
                      }
                     ?>
                    </tbody>
                   
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
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
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
