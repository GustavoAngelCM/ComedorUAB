<?php

class DetallePedidoConsulta
{

  private $Conexion;

  function __construct($con)
  {
    $this->Conexion = $con;
  }

  public function listaDetallePedido($pedido)
  {
    $query = "SELECT d.idDetallePedido, a.idAlmacen, p.nombreProducto, u.abreviatura, u.nombre, cp.nombreCategoria, d.idPedido, d.cantidad
              FROM detallepedido d, almacen a, producto p, udiadmedida u, categoriaproducto cp
              WHERE d.idAlmacen = a.idAlmacen
              AND a.idProducto = p.idProducto
              AND p.idUnidMedida = u.idUnidMedida
              AND p.idCatProducto = cp.idCatProducto
              AND d.idPedido = :pedido";
    $consulta = $this->Conexion->prepare($query);
    $consulta->bindParam(':pedido', $pedido);
    $consulta->execute();
    $registro = $consulta->fetchAll();
    return $registro;
  }

}

?>
