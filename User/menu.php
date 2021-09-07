<?php 
//include 'Connections/RootSistemas_Conexion_masterWeb.php';
$idUser1=$_SESSION['MM_ID_USER'];
//$idUser1=1;
$ViewPersonaUser=mysql_query("SELECT  bbh_id_usuario, 
  bbh_usuario, 
  bbh_pass, 
  bbh_persona_id, 
  bbh_rol_id, 
  bbh_persona.bbh_nombres,
  bbh_persona.bbh_apellidos
  FROM 
  bbh_usuario, bbh_persona 
  WHERE bbh_usuario.bbh_persona_id = bbh_persona.bbh_id_persona AND 
  bbh_usuario.bbh_id_usuario=$idUser1")or die(mysql_error());

$GETDataPersona=mysql_fetch_assoc($ViewPersonaUser);

$GetUser=$GETDataPersona['bbh_usuario'];
$Nomber1=$GETDataPersona['bbh_nombres'];
$Nomber2=$GETDataPersona['bbh_apellidos'];

$N1=(explode( ' ', $Nomber1 ) );
   $NM=$N1[0];
  // $NM1=$N1[1];

$N2=(explode( ' ', $Nomber2 ) );
   $NM2=$N2[0];
   //$NM3=$N2[1];

$NyP=$NM.' '.$NM2;

?>
<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../images/User/default.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $NyP; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
     
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">

           
            <li class="header"><center>Navegación</center></li>

          <?php

            if ($_SESSION['ROLL'] != 3) {
              
            
          ?>

            <li>
              <a href="index.php">
                <i class="fa fa-home"></i> <span>Inicio</span>
              </a>
            </li>


          <li class="treeview">
            <a href="#">
              <i class="fa fa-database"></i>
              <span>Ingreso de Datos</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li>
                <a href="ING_provincia.php">
                <i class="fa fa-circle-o"></i>
                 Ingreso de Provincias
                </a>
              </li>
              <li>
                <a href="ING_canton.php">
                <i class="fa fa-circle-o"></i>
               Ingreso de Cantones
                </a>
              </li>
              <li>
                <a href="ING_parroquia.php">
                <i class="fa fa-circle-o"></i>
               Ingreso de Parroquias
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-circle-o"></i>
                  Urbano
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="ING_ciudadela.php">
                        <i class="fa fa-circle-o"></i>
                        Ciudadelas
                      </a>
                    </li>
                    <li>
                       <a href="ING_manzana.php">
                        <i class="fa fa-circle-o"></i>
                        Manzanas
                       </a>
                    </li>
                  </ul>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-circle-o"></i>
                  Rural
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="ING_recinto.php">
                        <i class="fa fa-circle-o"></i>
                        Recintos
                      </a>
                    </li>
                    <li>
                       <a href="ING_sector.php">
                        <i class="fa fa-circle-o"></i>
                        Sectores
                       </a>
                    </li>
                  </ul>
              </li>
           </ul>
          </li>


          <li class="treeview">
            <a href="#">
              <i class="fa fa-clone"></i>
              <span>Documentos</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li>
                <a href="#">
                  <i class="fa fa-circle-o"></i>
                  Permiso de Construcciòn
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="form_pc.php" target="_blank">
                        <i class="fa fa-circle-o"></i>
                        Nuevo
                      </a>
                    </li>
                    <li>
                       <a href="VIEW_PC.php">
                        <i class="fa fa-circle-o"></i>
                        Listado
                       </a>
                    </li>
                  </ul>
              </li>
             
              <li>
                <a href="#">
                  <i class="fa fa-circle-o"></i>
                  Medicion de Solar
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="form_ims.php" target="_blank">
                        <i class="fa fa-circle-o"></i>
                        Nuevo
                      </a>
                    </li>
                    <li>
                       <a href="VIEW_MS.php">
                        <i class="fa fa-circle-o"></i>
                        Listado
                       </a>
                    </li>
                  </ul>
              </li>

              <li>
                <a href="#">
                  <i class="fa fa-circle-o"></i>
                  Propiedad Horizontal
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="form_dph.php" target="_blank">
                        <i class="fa fa-circle-o"></i>
                        Nuevo
                      </a>
                    </li>
                    <li>
                       <a href="VIEW_PDH.php">
                        <i class="fa fa-circle-o"></i>
                        Listado
                       </a>
                    </li>
                  </ul>
              </li>

              <li>
                <a href="#">
                  <i class="fa fa-circle-o"></i>
                  Certificado Línea de Fábrica
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="form_lnf.php" target="_blank">
                        <i class="fa fa-circle-o"></i>
                        Nuevo
                      </a>
                    </li>
                    <li>
                       <a href="VIEW_LNF.php">
                        <i class="fa fa-circle-o"></i>
                        Listado
                       </a>
                    </li>
                  </ul>
              </li>

              <li>
                <a href="#">
                  <i class="fa fa-circle-o"></i>
                  Certificado Uso de Suelo
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="form_usl.php" target="_blank">
                        <i class="fa fa-circle-o"></i>
                        Nuevo
                      </a>
                    </li>
                    <li>
                       <a href="VIEW_US.php">
                        <i class="fa fa-circle-o"></i>
                        Listado
                       </a>
                    </li>
                  </ul>
              </li>

              <li>
                <a href="#">
                  <i class="fa fa-circle-o"></i>
                  Desmembramiento
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="form_dms.php" target="_blank">
                        <i class="fa fa-circle-o"></i>
                        Nuevo
                      </a>
                    </li>
                    <li>
                       <a href="VIEW_DESM.php">
                        <i class="fa fa-circle-o"></i>
                        Listado
                       </a>
                    </li>
                  </ul>
              </li>

           </ul>
          </li>

          <?php
        }
        ?>

            <?php
              if(isset($_SESSION['Liquidacion'])){

                if ($_SESSION['Liquidacion'] == 1) {
               

            ?>
            <li>
              <a href="liquidacion.php"> <i class="fa  fa-check-square-o"></i> <span>Liquidacion</span></a>
            </li>
            <li>
              <a href="lisliquidacion.php"> <i class="fa  fa-check-square-o"></i> <span>Lista Liquidacion</span></a>
            </li>
            <?php
              }
              }

            ?>
           <!-- <li>
              <a href="viewReportes.php"> <i class="fa  fa-reorder"></i> <span>Reportes</span></a>
            </li>
          -->
        </section>
        <!-- /.sidebar -->
      </aside>
