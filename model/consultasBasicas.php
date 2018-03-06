<?php


class ConsultasBasicas
{
  const Tabla = 'Usuarios';
  public function getUsuarioDB($usuario)
  {
    $conexion = new Conexion();
    $consulta = $conexion->prepare('SELECT * FROM ' . self::Tabla. ' WHERE usuario = :usuario');
    $consulta->bindParam(':usuario', $usuario);
    $consulta->execute();
    $registro = $consulta->fetch();
    return $registro;
  }

  public function existeCategoria($name, $conn)
  {
    $consulta = $conn->prepare('SELECT * FROM categoriaProducto where nombreCategoria=:name');
    $consulta->bindParam(':name', $name);
    $consulta->execute();
    $registro = $consulta->fetch();

    if ($registro) {
      return $registro;
    }else {
      $registro = 0;
      return $registro;
    }
  }

  public function existeCategoriaEditar($name, $id, $conn)
  {
    $consulta = $conn->prepare('SELECT * FROM categoriaProducto where idCatProducto != :id');
    $consulta->bindParam(':id', $id);
    $consulta->execute();
    $registro = $consulta->fetchAll();
    $existe = false;
    if ($registro) {
      foreach ($registro as $dato) {
        if ($dato['nombreCategoria'] == $name) {
            $existe = true;
            break;
        }
      }
      return $existe;
    }else {
      return $existe;
    }
  }

  public function existeMetricaEditar($name, $id, $conn)
  {
    $consulta = $conn->prepare('SELECT * FROM udiadmedida where idUnidMedida != :id');
    $consulta->bindParam(':id', $id);
    $consulta->execute();
    $registro = $consulta->fetchAll();
    $existe = false;
    if ($registro) {
      foreach ($registro as $dato) {
        if ($dato['nombre'] == $name) {
            $existe = true;
            break;
        }
      }
      return $existe;
    }else {
      return $existe;
    }
  }

  public function listaCategorias($conn)
  {
    $consulta = $conn->prepare('SELECT * FROM categoriaProducto ORDER BY nombreCategoria');
    $consulta->execute();
    $registro = $consulta->fetchAll();
    return $registro;
  }

  public function listaMetricas($conn)
  {
    $consulta = $conn->prepare('SELECT * FROM udiadmedida ORDER BY nombre');
    $consulta->execute();
    $registro = $consulta->fetchAll();
    return $registro;
  }

  public function existeMetrica($name, $conn)
  {
    $consulta = $conn->prepare('SELECT * FROM udiadmedida where nombre=:name');
    $consulta->bindParam(':name', $name);
    $consulta->execute();
    $registro = $consulta->fetch();

    if ($registro) {
      return $registro;
    }else {
      $registro = 0;
      return $registro;
    }
  }

  public function existeProducto($name, $conn)
  {
    $consulta = $conn->prepare('SELECT * FROM producto where nombreProducto=:name');
    $consulta->bindParam(':name', $name);
    $consulta->execute();
    $registro = $consulta->fetch();

    if ($registro) {
      return $registro;
    }else {
      $registro = 0;
      return $registro;
    }
  }

  public function listaProductos($conn)
  {
    $consulta = $conn->prepare('SELECT * FROM producto ORDER BY nombreProducto');
    $consulta->execute();
    $registro = $consulta->fetchAll();
    return $registro;
  }

  public function listaPedidos($conn)
  {
    $consulta = $conn->prepare('SELECT * FROM pedido');
    $consulta->execute();
    $registro = $consulta->fetchAll();
    return $registro;
  }

  public function listaDetallePedido($conn, $id)
  {
    $consulta = $conn->prepare('SELECT * FROM detallepedido where idPedido = :id');
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    $registro = $consulta->fetchAll();
    return $registro;
  }

}


?>
