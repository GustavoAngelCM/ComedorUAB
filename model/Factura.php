<?php
/**
 *
 */
class Factura
{

  private $IdFactura;
  private $IdDetalle;
  private $NumFactura;
  private $ValorIva;

  function __construct()
  {
    $this->IdFactura =  null;
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
