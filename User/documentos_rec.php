<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';
include "validationfuntion.php";
$idUser=$_SESSION['MM_ID_USER'];
validar($idUser);
$viewCargo=mysql_query("SELECT  *
                        FROM (SELECT envio_doc.id_doc, (envio_doc.fecha)AS fechaenvio, CONCAT(persona.Apellidos,' ',persona.Nombres)AS Urecp,
                          documentos.titulo, documentos.asunto, documentos.fecha_recepcion, 
                          documentos.remitente, documentos.id_documentos, documentos.nom_documento
                          FROM envio_doc, documentos, usuario, persona
                          WHERE usuario.idUsuario=envio_doc.id_user_recp AND persona.idPersona=usuario.id_Persona AND
                          envio_doc.id_doc IN (SELECT documentos.id_documentos FROM documentos) 
                          AND documentos.id_documentos=envio_doc.id_doc)tabl, 
                            (SELECT CONCAT(persona.Apellidos,' ',persona.Nombres)AS Penvia, envio_doc.id_doc, envio_doc.id_user_recp, documentos.num_seguimiento, envio_doc.nota
                             FROM envio_doc, persona, usuario, documentos 
                             WHERE envio_doc.id_user_env=usuario.idUsuario AND usuario.id_Persona=persona.idPersona 
                             AND envio_doc.id_doc=documentos.id_documentos ) envio  WHERE tabl.id_doc = envio.id_doc AND envio.id_user_recp=$idUser
                            ORDER BY fecha_recepcion ")or die(mysql_error());
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
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <script language="javascript" src="js/jquery-1.11.3.min.js"></script>
 <script type="text/javascript">

        $(document).on("click", "a.open", function () {
        var myBookId = $(this).data('id');
        //var res = myBookId.split("-");
        //document.getElementById('label1').innerHTML=res[0] ;
        //document.getElementById('tele').innerHTML=res[1] ;
        //document.getElementById('correo').innerHTML=res[2] ;
        //document.getElementById('usuario').innerHTML=res[3] ;
        

     $(".modal-body #id").val( myBookId );
    // alert(myBookId);
    // $(".modal-body #bookId").val( res[1] );
    // $(".modal-body #bookId2").val( res[2] );
    
    });
</script>

<script type="text/javascript">

        $(document).on("click", "a.open1", function () {
        var myBookId = $(this).data('id');
      document.getElementById('parrafo').innerHTML=myBookId;
     //$(".modal-body #parrafo").val( myBookId );
        });
</script>


 <script language="javascript">
    $(document).ready(function(){
      $("#departamento").change(function () {
           $("#departamento option:selected").each(function () {
            departamento = $(this).val();
            $.post("Selects/select_cargo.php", { departamento: departamento }, function(data){
                $("#persona").html(data);
            });            
        });
      })
    });
    </script>

    <style type="text/css">
    .tex{
      font-size: 30px;
    }
    </style>
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
                        <th>Titulo</th>
                        <th>Asunto</th>
                        <th>Remitente</th>
                        <th>Numero Seguimiento</th>
                        <th>Fecha</th>
                        <th>De:</th>
                        <th>Para:</th>
                        <th>Documentos</th>
                        <th>Enviar</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    while ($DataView=mysql_fetch_array($viewCargo)) {
                    ?>
                      <tr>
                        <td><?php echo $DataView['titulo']; ?></td>
                        <td><?php echo $DataView['asunto']; ?></td>
                        <td><?php echo $DataView['remitente']; ?></td>
                        <td><?php echo $DataView['num_seguimiento']; ?></td>
                        <td><?php echo $DataView['fechaenvio']; ?></td>
                        <td><?php echo $DataView['Penvia']; ?></td>
                        <td><?php echo $DataView['Urecp']; ?></td>
                        <td>
                        <center>
                          <a href="doc/<?php echo $DataView['nom_documento']; ?>" title="Abrir Documento" target="_blank"><span class='fa fa-file-pdf-o tex'></span></a>
                          &nbsp;&nbsp;
                          <a data-id="<?php echo $DataView['nota'];?>"  href="#modal11 " class="open1" data-toggle="modal" class="btn btn-primary" title='Notas Adjuntas'> <span class='fa fa-commenting-o tex' ></span></a>
                          </center>
                        </td>
                        <td>
                        <a data-id="<?php echo $DataView['id_documentos'];?>"  href="#modal1 " class="open" data-toggle="modal" class="btn btn-primary tex">Enviar</a>
                        </td>
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

    <div class="modal fade" id="modal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h3 class="modal-title" id="myModalLabel">Enviar ha....</h3>
            <br>
              <div class="box box-primary">
                <div class="modal-body"  >
                  <form action=""   method="POST"  >
                    <div class="form-group">
                        <label for="exampleInputEmail1">Departamentos</label>
                        <select name="departamento" class="form-control" id="departamento" required>
                          <option value="">Seleccione una...</option>
                            <?php $sql_mov = "SELECT * FROM departamento";
                              $result_mov = mysql_query($sql_mov);
                              while ($row_mov = mysql_fetch_array($result_mov)){ ?>
                              <option value="<?php echo $row_mov['idDepartamento'];?>" ><?php echo $row_mov['Departamento'];?></option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Canton</label>
                      <select  id="persona" name="persona" class="form-control" required>
                        <option value="">Seleccione una...</option>
                      </select>
                    </div>
                      <input type="hidden"  id="id" name="id" placeholder="id" value="">
                      <input type="submit" name="enviar"  class="btn btn-primary btn-block"  value="Comentar" >
                  </form>
  <!-- /.post -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="modal11" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h3 class="modal-title" id="myModalLabel">Nota</h3>
            <br>
              <div class="box box-primary">
                <div class="modal-body"  >
                 <p id="parrafo">
                 
                 </p>
  <!-- /.post -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
          </div>
        </div>
      </div>
    </div>

<?php
if(isset($_POST["enviar"])){
  $sql="INSERT INTO envio_doc(id_doc, id_user_recp, id_user_env) values ('".($_POST['id'])."','".($_POST['persona'])."','".$_SESSION['MM_ID_USER']."')";
  mysql_query($sql,$Sistema)
  ?>
        <script type="text/javascript">
    alert("\t  Registro Correcto\n \t");
    window.location = "view_documentos.php";
    </script>
    <?php     
  }   
?>
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
