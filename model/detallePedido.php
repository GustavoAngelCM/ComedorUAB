<?php

class DetallePedido
{

  private $IdDetallePedido;
  private $Cantidad;
  private $C_Almacen;
  private $C_Pedido;

  function __construct($cantidad, $pedido, $almacen)
  {
    $this->IdDetallePedido = null;
    $this->Cantidad = $cantidad;
    $this->C_Almacen = $almacen;
    $this->C_Pedido = $pedido;
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
