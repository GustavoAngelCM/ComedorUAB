<?php
/**
 *
 */
class ConsultasAlmacen
{
  public $Conexion;
  function __construct($conexion)
  {
    $this->Conexion=$conexion;
  }

  public function existeProductoAlmacen($idProducto)
  {
        $query = "SELECT *
                  FROM almacen
                  WHERE idProducto = :idProducto";
        $consulta = $this->Conexion->prepare($query);
        $consulta->bindValue(':idProducto', $idProducto);
        $consulta->execute();
        $registro = $consulta->fetch();

        if ($registro)
        {
          return true;
        }
        else
        {
          return false;
        }

  }
  public function idUsuarioAlmacen($user)
  {
        $query = "SELECT *
                  FROM usuarios
                  WHERE usuario = :user";
        $consulta = $this->Conexion->prepare($query);
        $consulta->bindValue(':user', $user);
        $consulta->execute();
        $registro = $consulta->fetch();
        return $registro;

  }
  public function idAlmacen($idProducto)
  {
        $query = "SELECT idAlmacen
                  FROM almacen
                  WHERE idProducto=:idProd";
        $consulta = $this->Conexion->prepare($query);
        $consulta->bindValue(':idProd', $idProducto);
        $consulta->execute();
        $registro = $consulta->fetch();
        return $registro;
  }
  public function idMaxDetalleAlmacen()
  {
        $query = "SELECT MAX(idDetalle)
                  FROM detalleAlmacen";
        $consulta = $this->Conexion->prepare($query);
        $consulta->execute();
        $registro = $consulta->fetch();
        return $registro;
  }

  public function listaDetalleAlmacen()
  {
        $query = "SELECT da.fechaRegistro,p.nombreProducto,da.cantidadIngresada,um.nombre,a.cantidad,da.fechaVencimiento,u.usuario
                  FROM detalleAlmacen da, almacen a, producto p, usuarios u, udiadmedida um
                  WHERE da.idAlmacen=a.idAlmacen
                  AND a.idProducto=p.idProducto
                  AND p.idUnidMedida=um.idUnidMedida
                  AND da.idUsuario=u.idUsuario
                  ORDER BY da.fechaRegistro DESC";
        $consulta = $this->Conexion->prepare($query);
        $consulta->execute();
        $registro = $consulta->fetchAll();
        return $registro;
  }

  public function detalleAlmacen()
  {
        $query = "SELECT p.nombreProducto,a.cantidad,um.nombre
                  FROM almacen a, producto p, udiadmedida um
                  WHERE a.idProducto=p.idProducto
                  AND p.idUnidMedida=um.idUnidMedida";
        $consulta = $this->Conexion->prepare($query);
        $consulta->execute();
        $registro = $consulta->fetchAll();
        return $registro;
  }

}
 ?>
