<?php
/**
 *
 */
class Reportes
{
  public $Conexion;
  function __construct($conexion)
  {
    $this->Conexion=$conexion;
  }

  public function detalleAlmacenDeProducto($producto,$fechaInicio,$fechaFin)
  {
        $query = "SELECT da.fechaRegistro,p.nombreProducto,da.cantidadIngresada,um.abreviatura,da.fechaVencimiento,u.usuario
                  FROM detalleAlmacen da, almacen a, producto p, usuarios u, udiadmedida um
                  WHERE da.idAlmacen=a.idAlmacen
                  AND a.idProducto=p.idProducto
                  AND p.idUnidMedida=um.idUnidMedida
                  AND da.idUsuario=u.idUsuario
                  AND p.idProducto=:idProducto
                  AND da.fechaRegistro BETWEEN :fechaI  AND :fechaF
                  ORDER BY da.fechaRegistro ASC";
        $consulta = $this->Conexion->prepare($query);
        $consulta->bindValue(':idProducto', $producto);
        $consulta->bindValue(':fechaI', $fechaInicio);
        $consulta->bindValue(':fechaF', $fechaFin);
// '1','2015-01-01','2017-01-01'

        $consulta->execute();
        $registro = $consulta->fetchAll();
        return $registro;
  }

}
 ?>
