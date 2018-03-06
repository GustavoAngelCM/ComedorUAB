<!DOCTYPE html>
<html lang="en">
<head>

	<title>Comedor</title>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/tabsDespachos.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-select.min.css">
  <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="css/estiloMenAdmin.css">

</head>
<body>

	<header>

		<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: black; opacity:0.91">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="menuAdmin.php"><img src="../view/multimedia/img/logo.png" class="img-responsive img-rounded"   width="25" height="25" ></a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li class="active"><a href="menuAdmin.php">Home</a></li>
						<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Productos <span class="caret"></span></a>
		          <ul class="dropdown-menu" >
		            <li><a href="menuAdmin.php?modo=gCategoriaProducto">Categoria Y Metrica</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="menuAdmin.php?modo=gProduct">Gestionar Productos</a></li>
		          </ul>
		        </li>
						<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Platos <span class="caret"></span></a>
		          <ul class="dropdown-menu" >
		            <li><a href="menuAdmin.php?modo=gCatPlato">Categoria Plato</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="menuAdmin.php?modo=gPlato">Gestionar Platos</a></li>
		          </ul>
		        </li>
						<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Almacen <span class="caret"></span></a>
		          <ul class="dropdown-menu" >
		            <li><a href="menuAdmin.php?modo=gIngresarProducto">Ingresar Producto</a></li>
		            <li role="separator" class="divider"></li>
		           	<li><a href="menuAdmin.php?modo=detalleAlmacen">Detalle Almacen</a></li>
		          </ul>
		        </li>
						<li><a href="menuAdmin.php?modo=gDespachos">Despachos</a></li>
						<li><a href="menuAdmin.php?modo=gUsuario">Nutrionista</a></li>
						<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes <span class="caret"></span></a>
		          <ul class="dropdown-menu" >
		            <li><a href="menuAdmin.php?modo=reporteAlmacen">Almacen</a></li>
		            <li role="separator" class="divider"></li>
		           	<li><a href="#">Otro</a></li>
		          </ul>
		        </li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><?php echo ucwords(strtolower($_SESSION['user'])); ?></a></li>
						<li><a href="menuAdmin.php?modo=cerrarSesion"><span class="fa fa-sign-out"></span> Salir</a></li>
					</ul>
				</div>
			</div>
		</nav>

	</header>
