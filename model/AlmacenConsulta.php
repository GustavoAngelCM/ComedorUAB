<?php

class AlmacenConsulta
{

  private $Conexion;

  function __construct($con)
  {
    $this->Conexion = $con;
  }

  public function obtenerCantidadAlmacen($id)
  {
    $query = "SELECT
                cantidad
              FROM
                almacen
              WHERE
                idAlmacen = :id";
    $consulta = $this->Conexion->prepare($query);
    $consulta->bindParam(':id', $id);
    $consulta->execute();
    $registro = $consulta->fetch();
    return $registro;
  }

  public function obtenerPrecioAlmacen($id)
  {
    $query = "SELECT
                Max(precioTotal/cantidadIngresada) AS precioUnitario
              FROM
                detallealmacen
              WHERE
                idAlmacen = :id";
    $consulta = $this->Conexion->prepare($query);
    $consulta->bindParam(':id', $id);
    $consulta->execute();
    $registro = $consulta->fetch();
    $dato = $registro['precioUnitario'];
    return $dato;
  }

  public function cantidadSuficinte($almacen)
  {
    $query = "SELECT
                (cantidad>:cantidad) AS resp
              FROM
                almacen
              where
                idAlmacen = :id";
    $consulta = $this->Conexion->prepare($query);
    $consulta->bindValue(':id', $almacen->IdAlmacen);
    $consulta->bindValue(':cantidad', $almacen->Cantidad);
    $consulta->execute();
    $registro = $consulta->fetch();
    $dato = $registro['resp'];
    if ($dato == "1")
    {
      return "";
    }
    else
    {
      return "<p style='color:rgb(242, 115, 15)'>La Cantidad es insuficiente del produto <strong>{$almacen->C_Producto->NombreProducto}</strong></p>";
    }

  }

}

?>
