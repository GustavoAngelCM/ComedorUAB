<?php

class ctrAlmacen
{

  private $Conexion;

  function __construct($conexion)
  {
    $this->Conexion = $conexion;
  }
  public function registrarAlmacen($almacen)
  {
    try {

        $this->Conexion->beginTransaction();

        $query = "INSERT INTO almacen (idAlmacen,idProducto,cantidad)
                  VALUES (:idAlmacen, :idProducto, :cantidad)";

        $insertAlmacen = $this->Conexion->prepare($query);

        $insertAlmacen->bindValue(':idAlmacen', $almacen->IdAlmacen);
        $insertAlmacen->bindValue(':idProducto', $almacen->IdProducto);
        $insertAlmacen->bindValue(':cantidad', $almacen->Cantidad);
        $insertAlmacen->execute();

        $this->Conexion->commit();

      } catch (PDOException $e) {

        $this->Conexion->rollBack();

        echo "Error al Registrar";

      }
  }

  public function actualizarAlmacen($almacen)
  {
    try {

        $this->Conexion->beginTransaction();

        $query = "UPDATE almacen
                  SET cantidad=cantidad+:cantidadAumentado
                  where idProducto=:idProducto";

        $updateAlmacen = $this->Conexion->prepare($query);

        $updateAlmacen->bindValue(':idProducto', $almacen->IdProducto);
        $updateAlmacen->bindValue(':cantidadAumentado', $almacen->Cantidad);

        $updateAlmacen->execute();

        $this->Conexion->commit();

      } catch (PDOException $e) {

        $this->Conexion->rollBack();

        echo "Error al Registrar";

      }
  }

}

?>
