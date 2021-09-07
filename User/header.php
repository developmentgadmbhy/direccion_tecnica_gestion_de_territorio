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
   //$NM1=$N1[1];

$N2=(explode( ' ', $Nomber2 ) );
   $NM2=$N2[0];
  // $NM3=$N2[1];

$NyP=$NM.' '.$NM2;

?>
      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b>M</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>DTGT</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../images/User/default.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $NyP; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../images/User/default.png" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $GetUser; ?> - Admin
                      <!--<small>Member since Nov. 2012</small>-->
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="Perfil.php" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>
        </nav>
      </header>