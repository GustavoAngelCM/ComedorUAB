<?php

class Pedido
{

  private $IdPedido;
  private $CantidadPlato;
  private $PedidoDespachado;
  private $FechaPedido;

  private $C_Plato;

  private $ListaDetallePedido;

  function __construct($cantidad, $plato)
  {
    $this->IdPedido = null;
    $this->CantidadPlato = $cantidad;
    $this->PedidoDespachado = false;
    $this->FechaPedido = "now()";
    $this->C_Plato = $plato;
    $this->ListaDetallePedido = array();
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

  public function getListaDetallePedido(){ return $this->ListaDetallePedido; }
  public function setListaDetallePedido($value){ $this->ListaDetallePedido[] = $value; }

}

?>
