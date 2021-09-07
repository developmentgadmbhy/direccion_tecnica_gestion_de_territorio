<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DTGT</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="foto">

  <img src="images/logo.png" width="380px" height="150">

    <div class="login-box">
      <div class="login-logo">
       <br>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <center>
        
        </center>
        <br>
        <form action="login.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="login" placeholder="Usuario">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="pass" placeholder="Contraseña">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
              <div class="col-xs-4">
              
              </div>
              <div class="col-xs-4">
  				<button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
              </div>
              <div class="col-xs-4">
            <!--  <a href="Registro.php" class="btn btn-primary btn-block btn-flat">Registro</a> -->
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="slider/js/vendor/bootstrap.min.js"></script>      
        <script src="slider/js/jquery.backstretch.min.js"></script>
        <script>
            jQuery.backstretch([
                  "slider/img/1.jpg"
                , "slider/img/2.jpg"
                , "slider/img/3.jpg"
                , "slider/img/4.jpg"
                , "slider/img/5.jpg"
                ], {duration: 4000, fade: 1000}
            );
            
        </script>
<?php 
if (isset($_GET['error'])) {
?>
<div class="box-body">
<div class="alert alert-danger alert-dismissable">
<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
<h4>
<i class="icon fa fa-ban"></i>
Error
</h4>
Verifica los datos.
</div>
<?php
}
?>
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->

  </body>
</html>
