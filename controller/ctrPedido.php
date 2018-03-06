<?php

class ManagePedido
{

  private $Conexion;

  function __construct($conexion)
  {
    $this->Conexion = $conexion;
  }

  public function listar()
  {
    $consulta = new PedidoConsulta($this->Conexion);
    $consultaDetalle = new DetallePedidoConsulta($this->Conexion);
    $listaPedidos = $consulta->listaPedidosPendientes();
    $listaArrayPedidos = array();
    $i = 0;
    foreach ($listaPedidos as $listaP)
    {
      $pedido = new Pedido($listaP['cantidadPlato'], $listaP['nombre']);
      $pedido->IdPedido = $listaP['idPedido'];
      $pedido->PedidoDespachado = $listaP['pedidoDespachado'];
      $pedido->FechaPedido = $listaP['fechaPedido'];

      $listaDetallePedidos = $consultaDetalle->listaDetallePedido($pedido->IdPedido);

      foreach ($listaDetallePedidos as $listaDP)
      {
        $detallePedido = new DetallePedido($listaDP['cantidad']." - ".$listaDP['abreviatura'], $listaDP['idPedido'], $listaDP['nombreProducto']);
        $detallePedido->IdDetallePedido = $listaDP['idDetallePedido'];
        $pedido->setListaDetallePedido($detallePedido);
      }

      $listaArrayPedidos[$i] = $pedido;
      $i++;
    }
    return $listaArrayPedidos;
  }

  

}

?>
