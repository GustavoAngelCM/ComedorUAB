<?php

class PlatoControlador
{

  private $Conexion;

  function __construct($con)
  {
    $this->Conexion = $con;
  }

  public function listar()
  {
    $consulta = new PlatoModel($this->Conexion);
    $listaPlatos = $consulta->listaDePlatos();
    $ArrayListaPlatos = array();
    $i = 0;
    foreach ($listaPlatos as $listaP)
    {
      $plato = new Plato();
      $plato->IdPlato = $listaP['idPlato'];
      $plato->NombrePlato = $listaP['nombre'];
      $ArrayListaPlatos[$i] = $plato;
      $i++;
    }
    return $ArrayListaPlatos;
  }

}

?>
