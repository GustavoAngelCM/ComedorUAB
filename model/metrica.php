<?php

class Metrica
{

  private $IdMetrica;
  private $NombreMetrica;
  private $Abreviatura;
  private $ListaProductos;

  function __construct($nombreMetrica, $abreviatura)
  {
    $this->IdMetrica =  null;
    $this->NombreMetrica = $nombreMetrica;
    $this->Abreviatura = $abreviatura;
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

  public function getListaProductosM(){ return $this->ListaProductos; }
  public function setListaProductosM($value){ $this->ListaProductos[] = $value; }

}

?>
