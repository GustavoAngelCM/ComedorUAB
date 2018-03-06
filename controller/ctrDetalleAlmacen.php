<?php
/**
 *
 */
class ctrDetalleAlmacen
{
  public $Conexion;

  function __construct($conexion)
  {
    $this->Conexion=$conexion;
  }
  public function insertarDetalleAlmacen($detalleAlmacen)
  {
    try {
      $this->Conexion->beginTransaction();
      $query="INSERT  INTO detalleAlmacen (idDetalle,idAlmacen,cantidadIngresada,fechaVencimiento,precioTotal,fechaRegistro,idUsuario)
              VALUES (:idDetalle,:idAlmacen,:cantidadIngresada,:fechaVencimiento,:precioTotal,:fechaRegistro,:idUsuario)
              ";

      $insertDetalleAlmacen = $this->Conexion->prepare($query);

      $insertDetalleAlmacen->bindValue(':idDetalle', $detalleAlmacen->IdDetalle);
      $insertDetalleAlmacen->bindValue(':idAlmacen', $detalleAlmacen->IdAlmacen);
      $insertDetalleAlmacen->bindValue(':cantidadIngresada', $detalleAlmacen->CantidadIngresada);
      $insertDetalleAlmacen->bindValue(':fechaVencimiento', $detalleAlmacen->FechaVencimiento);
      $insertDetalleAlmacen->bindValue(':precioTotal', $detalleAlmacen->PrecioTotal);
      $insertDetalleAlmacen->bindValue(':fechaRegistro', $detalleAlmacen->FechaRegistro);
      $insertDetalleAlmacen->bindValue(':idUsuario', $detalleAlmacen->IdUsuario);


      $insertDetalleAlmacen->execute();

      $this->Conexion->commit();

    } catch (PDOException $e) {

      $this->Conexion->rollBack();

      echo "Error al Registrar";

    }

  }
}

 ?>
