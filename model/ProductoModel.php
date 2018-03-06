<?php

class ProductoModel
{

  private $Conexion;

  function __construct($con)
  {
    $this->Conexion = $con;
  }

  public function existeProductoEdit($id, $nombre)
  {
    $query = 'SELECT * FROM producto where idProducto!=:idProducto';
    $consulta = $this->Conexion->prepare($query);
    $consulta->bindParam(':idProducto', $id);
    $consulta->execute();
    $registro = $consulta->fetchAll();
    $existe = false;
    foreach ($registro as $item)
    {
      if ($item['nombreProducto'] == $nombre)
      {
        $existe = true;
        break;
      }
    }
    return $existe;
  }

  public function edit($producto)
  {
    var_dump($producto);
    try
    {
      $this->Conexion->beginTransaction();

      $query = 'UPDATE
                  producto
                SET
                  nombreProducto = :nombreProducto,
                  idUnidMedida = :idMetrica,
                  idCatProducto = :idCategoria
                WHERE
                  idProducto = :idProducto';

      $stmtProducto = $this->Conexion->prepare($query);

      $stmtProducto->bindValue(':nombreProducto',$producto->NombreProducto);
      $stmtProducto->bindValue(':idMetrica',$producto->C_Metrica);
      $stmtProducto->bindValue(':idCategoria',$producto->C_Categoria);
      $stmtProducto->bindValue(':idProducto',$producto->IdProducto);

      $stmtProducto->execute();

      $this->Conexion->commit();
      return true;
    }
    catch (PDOException $e)
    {
      $this->Conexion->rollBack();
      return false;
    }

  }

  public function productosConCantidades($plato)
  {
    if ($plato == "")
    {
      $query = 'SELECT
                  p.idProducto,
                  p.nombreProducto,
                  concat_ws(" ",a.cantidad, u.abreviatura) as cantidad
                FROM
                  almacen a,
                  producto p,
                  udiadmedida u
                WHERE
                  u.idUnidMedida = p.idUnidMedida
                  AND p.idProducto = a.idProducto
                  ORDER BY p.nombreProducto';

      $consulta = $this->Conexion->prepare($query);
      $consulta->execute();
    }
    else
    {
      $query = 'SELECT
                  p.idProducto,
                  p.nombreProducto,
                  concat_ws(" ",a.cantidad, u.abreviatura) as cantidad
                FROM
                  almacen a,
                  producto p,
                  receta r,
                  plato pl,
                  udiadmedida u
                WHERE
                      pl.idPlato = r.idPlato
                  AND r.idProducto = p.idProducto
                  AND u.idUnidMedida = p.idUnidMedida
                  AND p.idProducto = a.idProducto
                  AND pl.idPlato = :plato
                  ORDER BY p.nombreProducto';

      $consulta = $this->Conexion->prepare($query);
      $consulta->bindParam(':plato', $plato);
      $consulta->execute();
    }

    $registro = $consulta->fetchAll();
    return $registro;
  }

}

?>
