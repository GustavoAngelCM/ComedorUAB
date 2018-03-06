<?php

class Categoria
{

  private $IdCategoria;
  private $NombreCategoria;
  private $ListaProductos;

  function __construct($nombreCategoria)
  {
    $this->IdCategoria =  null;
    $this->NombreCategoria = $nombreCategoria;
    $this->ListaProductos = array();
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

  public function getListaProductos(){ return $this->ListaProductos; }
  public function setListaProductos($value){ $this->ListaProductos[] = $value; }

}

?>
