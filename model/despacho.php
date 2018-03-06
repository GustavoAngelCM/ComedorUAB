<?php

class Despacho
{

  private $IdDespacho;
  private $CantidadRetirada;
  private $PrecioRetiro;
  private $FechaRetiro;
  private $Observaciones;

  private $C_Almacen;
  private $C_Plato;
  private $C_Usuario;

  function __construct()
  {
    $this->IdDespacho = null;
    $this->Observaciones = null;
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

}

?>
