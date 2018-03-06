<?php

class PedidoConsulta
{

  private $Conexion;

  function __construct($con)
  {
    $this->Conexion = $con;
  }

  public function listaPedidosPendientes()
  {
    $query = " SELECT pe.idPedido, p.nombre, pe.cantidadPlato, pe.pedidoDespachado, pe.fechaPedido
               FROM pedido as pe LEFT JOIN plato as p on pe.idPlato = p.idPlato
               WHERE  pe.pedidoDespachado = 0";
    $consulta = $this->Conexion->prepare($query);
    $consulta->execute();
    $registro = $consulta->fetchAll();
    return $registro;
  }

  public function verPedido($id)
  {
    $query = " SELECT pe.idPedido, pe.idPlato, p.nombre, pe.cantidadPlato, pe.pedidoDespachado, pe.fechaPedido
               FROM  pedido as pe LEFT JOIN plato as p on pe.idPlato = p.idPlato
               WHERE pe.pedidoDespachado = 0
               AND pe.idPedido = :id";
    $consulta = $this->Conexion->prepare($query);
    $consulta->bindParam(':id', $id);
    $consulta->execute();
    $registro = $consulta->fetch();
    return $registro;
  }

}

?>
