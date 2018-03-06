<?php

class ManageCategoria
{

  private $Conexion;

  function __construct($conn)
  {
    $this->Conexion =$conn;
  }

  public function registrarCategoria($name)
  {
    $consulta = new ConsultasBasicas();
    $cat = new Categoria($name);

    $existe =  $consulta->existeCategoria($name, $this->Conexion);

    if ($existe == 0) {
      $insert = new Insert();
      $insert->insertarCategoria($cat, $this->Conexion);
      header("Location: menuAdmin.php?modo=rExitoCat");
    }else {
      header("Location: menuAdmin.php?modo=eDupCat");
    }

  }

  public function listaCategoria()
  {
    $consulta = new ConsultasBasicas();
    $listaCate = $consulta->listaCategorias($this->Conexion);
    $listArray = array();
    $i = 0;

    foreach ($listaCate as $listaC) {
      $cat = new Categoria($listaC['nombreCategoria']);
      $cat->IdCategoria = $listaC['idCatProducto'];
      $listArray[$i] = $cat;
      $i++;
    }

    return $listArray;

  }

  public function editar($nombre, $id, $name)
  {

    if (strtolower($nombre) != strtolower($name)) {

      $consulta = new ConsultasBasicas();
      $cat = new Categoria($nombre);
      $cat->IdCategoria = $id;

      $existe =  $consulta->existeCategoriaEditar($nombre, $id, $this->Conexion);

      if ($existe == 0) {
        $edit = new Editar();
        $error = $edit->editarCat($cat, $this->Conexion);
        if ($error == 0 ) {
          header("Location: menuAdmin.php?modo=editCat");
        }else {
          header("Location: menuAdmin.php?modo=errEditCat");
        }
      }else {
        header("Location: menuAdmin.php?modo=eDupCat");
      }

    }else {
      header("Location: menuAdmin.php?modo=gCategoriaProducto");
    }

  }

}

?>
