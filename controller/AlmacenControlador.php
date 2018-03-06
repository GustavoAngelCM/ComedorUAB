<?php

class AlmacenControlador
{

  private $Conexion;

  function __construct($con)
  {
    $this->Conexion = $con;
  }

  public function disminuirAlmacen($almacen)
  {
    $consulta = new AlmacenConsulta($this->Conexion);
    $obtenerCantidad = $consulta->obtenerCantidadAlmacen($almacen->IdAlmacen);
    $cantidad = $obtenerCantidad['cantidad'];
    if ($cantidad > $almacen->Cantidad)
    {
      $almacen->Cantidad = $cantidad - $almacen->Cantidad;

      try
      {
        $this->Conexion->beginTransaction();

        $query = 'UPDATE
                    almacen
                  SET
                    cantidad = :cantidad
                  WHERE
                    idAlmacen = :idAlmacen';

        $stmtAlmacenDis = $this->Conexion->prepare($query);

        $stmtAlmacenDis->bindValue('cantidad', $almacen->Cantidad);
        $stmtAlmacenDis->bindValue('idAlmacen', $almacen->IdAlmacen);

        $stmtAlmacenDis->execute();

        $this->Conexion->commit();

        return "1";
      }
      catch (PDOException $e)
      {
        $this->Conexion->rollBack();
        return "<p style='color:red'>Error al disminuir producto <strong>{$almacen->C_Producto->NombreProducto}</strong> </p>";
      }

    }
    else
    {
      return "<p style='color:rgb(242, 115, 15)'>La Cantidad es insuficiente del produto <strong>{$almacen->C_Producto->NombreProducto}</strong></p>";
    }

  }

}

?>
