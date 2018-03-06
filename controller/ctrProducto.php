<?php

class ManageProducto
{

  private $Conexion;

  function __construct($conexion)
  {
    $this->Conexion = $conexion;
  }

  public function insertar($nombre, $categoria, $metrica)
  {
    $consulta = new ConsultasBasicas();
    list($idCat, $nameCat) = explode("_", $categoria);
    list($idMet, $nameMet, $abrevMet) = explode("_", $metrica);
    $cat = new Categoria($nameCat);
    $cat->IdCategoria = $idCat;
    $met = new Metrica($nameMet, $abrevMet);
    $met->IdMetrica = $idMet;
    $producto = new Producto($nombre, $cat, $met);

    $existe = $consulta->existeProducto($nombre, $this->Conexion);

    if ($existe == 0) {
      $insert = new Insert();
      $error = $insert->insertarProducto($producto, $this->Conexion);
      if ($error == 0) {
        header("Location: menuAdmin.php?modo=exiRegProd");
      }else {
        header("Location: menuAdmin.php?modo=errRegProd");
      }

    }else {
      header("Location: menuAdmin.php?modo=pExi");
    }

  }

  public function listar()
  {
    $consulta = new ConsultasBasicas();
    $listaProd = $consulta->listaProductos($this->Conexion);
    $listaCate = $consulta->listaCategorias($this->Conexion);
    $listaMetr = $consulta->listaMetricas($this->Conexion);
    $listArray = array();
    $i = 0;

    foreach ($listaProd as $listaP) {

      foreach ($listaCate as $listaC) {
        if ($listaP['idCatProducto'] == $listaC['idCatProducto']) {
          $cat = new Categoria($listaC['nombreCategoria']);
          $cat->IdCategoria = $listaC['idCatProducto'];
          break;
        }
      }

      foreach ($listaMetr as $listaM) {
        if ($listaP['idUnidMedida'] == $listaM['idUnidMedida']) {
          $met = new Metrica($listaM['nombre'], $listaM['abreviatura']);
          $met->IdMetrica = $listaM['idUnidMedida'];
          break;
        }
      }

      $producto = new Producto($listaP['nombreProducto'], $cat, $met);
      $producto->IdProducto = $listaP['idProducto'];

      $listArray[$i] = $producto;
      $i++;

    }

    return $listArray;
  }

  public function editar()
  {
    $efecto = "";
    var_dump($_POST);
    if (($_POST['nombre'] == $_POST['name'])&&($_POST['categoria'] == $_POST['cat'])&&($_POST['metrica'] == $_POST['met']))
    {
      $efecto = 0;
    }
    else
    {
      $productoModel = new ProductoModel($this->Conexion);

      $existe = $productoModel->existeProductoEdit($_POST['id'], $_POST['nombre']);

      if ($existe == false)
      {
        $producto = new Producto($_POST['nombre'], $_POST['categoria'], $_POST['metrica']);
        $producto->IdProducto = $_POST['id'];
        $correcto = $productoModel->edit($producto);
        if ($correcto == true)
        {
          $efecto = 1;
        }
        else
        {
          $efecto = 2;
        }

      }
      else
      {
        $efecto = 3;
      }
    }
    return $efecto;
  }

  public function productosStock($plato)
  {
    $consulta = new ProductoModel($this->Conexion);
    $listaProductos = $consulta->productosConCantidades($plato);
    $listaArray = array();
    $i = 0;
    foreach ($listaProductos as $listaP)
    {
      $producto = new Producto($listaP['nombreProducto'], "", "");
      $producto->IdProducto = $listaP['idProducto'];
      $almacen = new Almacen();
      $almacen->Cantidad = $listaP['cantidad'];
      $almacen->C_Producto = $producto;
      $listaArray[$i] = $almacen;
      $i++;
    }
    return $listaArray;
  }

}

?>
