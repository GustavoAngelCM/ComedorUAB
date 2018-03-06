<?php

class ManageMetrica
{

  private $Conexion;

  function __construct($conexion)
  {
    $this->Conexion = $conexion;
  }

  public function crear($name, $abreviatura)
  {
    $consulta = new ConsultasBasicas();
    $metrica = new Metrica($name, $abreviatura);
    $exite = $consulta->existeMetrica($name, $this->Conexion);
    if ($existe == 0) {
      $insert = new Insert();
      $error = $insert->insertarMetrica($metrica, $this->Conexion);
      if ($error == 0) {
        header("Location: menuAdmin.php?modo=rExitoMet");
      }else {
        header("Location: menuAdmin.php?modo=errRegMet");
      }

    }else {
      header("Location: menuAdmin.php?modo=eDupMet");
    }
  }

  public function lista()
  {
    $consulta = new ConsultasBasicas();
    $listaMet = $consulta->listaMetricas($this->Conexion);
    $listArray = array();
    $i = 0;
    foreach ($listaMet as $listaM) {
      $met = new Metrica($listaM['nombre'], $listaM['abreviatura']);
      $met->IdMetrica = $listaM['idUnidMedida'];
      $listArray[$i] = $met;
      $i++;
    }
    return $listArray;
  }

  public function editar($id, $nombre, $abreviatura, $name, $abbreviation)
  {

    if ((strtolower($nombre) == strtolower($name))&&(strtolower($abreviatura) == strtolower($abbreviation)))
    {
      header('Location: menuAdmin.php?modo=gCategoriaProducto');
    }
    else
    {
      $consuta = new ConsultasBasicas($this->Conexion);
      $existe = $consuta->existeMetricaEditar($nombre, $id, $this->Conexion);
      if ($existe == false)
      {
        $metrica = new Metrica(ucwords($nombre), $abreviatura);
        $metrica->IdMetrica = $id;
        $editar = new Editar();
        $editar->editarMetrica($metrica, $this->Conexion);
      }
      else
      {
        header('Location: menuAdmin.php?modo=errEditarMD');
      }
    }

  }

}

?>
