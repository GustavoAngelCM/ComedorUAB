<?php

class CategoriaPlato
{

  private $IdCategoriaPlato;
  private $NombreCategoriaPlato;
  private $ListaPlatos;

  function __construct($nombreCategoria)
  {
    $this->IdCategoriaPlato =  null;
    $this->NombreCategoriaPlato = $nombreCategoria;
    $this->ListaPlatos = array();
  }

  public function __set($atributo, $value)
  {
    if (property_exists($this, $atributo)) {
      $this->$atributo = $value;
    }else {
      echo "Error al encontrar Atributo SET {$atributo} .";
    }
  }

  public function __get($atributo)
  {
    if (property_exists($this, $atributo)) {
      return $this->$atributo;
    }else {
      return "Error al encontrar Atributo GET {$atributo} .";
    }

  }

  public function setListaPlatos($value){ $this->ListaPlatos[] = $value; }

}

?>
