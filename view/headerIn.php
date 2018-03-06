<!DOCTYPE html>
<html lang="en">

  <head>

    <title>Comedor UAB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="view/css/estiloResp.css">
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/font-awesome/css/font-awesome.min.css">

  </head>

  <body>

    <header>

      <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: black; opacity:0.7">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="view/multimedia/img/logo.png" class="img-responsive img-rounded"   width="25" height="25" ></a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#">Acerca De</a></li>
              <li><a href="#">Mision y Vision</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#login" data-toggle="modal"><span class="fa fa-sign-in"></span> Login</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="modal fade" id="login">
        <div class="modal-dialog">
          <div class="modal-content">

            <form class="" action="index.php?modo=CampLlenos" method="post">

              <div class="modal-header">
                <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Ingresar al Sistema <i class="fa fa-arrow-right"></i> Comedor UAB</h3>
              </div>

              <div class="modal-body">
                <input type="text" class="form-control" name="user" placeholder="Usuario" required>
                <br>
                <input type="password" class="form-control" name="pass" placeholder="Contraseña" required>
                <input type="hidden" name="datos" value="1">
              </div>

              <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancelar <i class="fa fa-times"></i></button>
                <button type="submit" class="btn btn-success">Ingresar <i class="fa fa-check"></i></button>
              </div>

            </form>

          </div>
        </div>
      </div>

    </header>
