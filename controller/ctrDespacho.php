<?php

class ManageDespacho
{

  private $Conexion;

  function __construct($conexion)
  {
    $this->Conexion = $conexion;
  }

  public function registrar($id)
  {
    $consultaPedido = new PedidoConsulta($this->Conexion);
    $consultaDetallePedido = new DetallePedidoConsulta($this->Conexion);
    $consultaAlmacen = new AlmacenConsulta($this->Conexion);
    $manejadorAlmacen = new AlmacenControlador($this->Conexion);

    $obtenerPedido = $consultaPedido->verPedido($id);
    $listaDetallePedido = $consultaDetallePedido->listaDetallePedido($id);

    $ArrayError = array();
    $i = 0;

    foreach ($listaDetallePedido as $listaDP)
    {
      $almacen = new Almacen();
      $almacen->IdAlmacen = $listaDP['idAlmacen'];
      $almacen->Cantidad = $listaDP['cantidad'];

      $producto = new Producto($listaDP['nombreProducto'], $listaDP['nombreCategoria'], $listaDP['nombre']);

      $almacen->C_Producto = $producto;

      $almacenRespuesta = $consultaAlmacen->cantidadSuficinte($almacen);

      if ($almacenRespuesta != "")
      {
        $ArrayError[$i] = $almacenRespuesta;
        $i++;
      }

    }


    if ($ArrayError)
    {
      $error = "<strong><p style='color:rgb(242, 115, 15)'>Pedido #  {$obtenerPedido['idPedido']}: {$obtenerPedido['cantidadPlato']} {$obtenerPedido['nombre']}</p></strong>";
      foreach ($ArrayError as $Array)
      {
        $error .="<ul>" ;
        $error .= "<li>{$Array}</li>";
        $error .="</ul>";
      }
      echo "{$error}";
    }
    else
    {
      foreach ($listaDetallePedido as $listaDP)
      {
        $almacen = new Almacen();
        $almacen->IdAlmacen = $listaDP['idAlmacen'];
        $almacen->Cantidad = $listaDP['cantidad'];

        $producto = new Producto($listaDP['nombreProducto'], $listaDP['nombreCategoria'], $listaDP['nombre']);

        $almacen->C_Producto = $producto;

        $manejadorAlmacen->disminuirAlmacen($almacen);
        $despacho = new Despacho();

        $almacen = new Almacen();
        $almacen->IdAlmacen = $listaDP['idAlmacen'];
        $plato = new Plato();
        $plato->IdPlato = $obtenerPedido['idPlato'];

        if ($almacen->IdAlmacen == "")
        {
          $almacen->IdAlmacen = null;
        }

        if ($plato->IdPlato == "")
        {
          $plato->IdPlato = null;
        }

        $despacho->C_Almacen  = $almacen;
        $despacho->C_Plato = $plato;
        $despacho->C_Usuario = $_SESSION['idUsuario'];

        $despacho->CantidadRetirada = $listaDP['cantidad'];;
        $despacho->PrecioRetiro = $consultaAlmacen->obtenerPrecioAlmacen($listaDP['idAlmacen']) * $despacho->CantidadRetirada;
        try
        {
          $this->Conexion->beginTransaction();

          $query = 'INSERT INTO despacho (idDespacho, idAlmacen, idPlato, cantidadRetirada, precioRetiro, fechaRetiro, observaciones, idUsuario)
                    VALUES (:idDespacho, :idAlmacen, :idPlato, :cantidadRetirada, :precioRetiro, now(), :observaciones, :idUsuario)';

          $stmtDespacho = $this->Conexion->prepare($query);

          $stmtDespacho->bindValue(':idDespacho', $despacho->IdDespacho);
          $stmtDespacho->bindValue(':idAlmacen', $despacho->C_Almacen->IdAlmacen);
          $stmtDespacho->bindValue(':idPlato', $despacho->C_Plato->IdPlato);
          $stmtDespacho->bindValue(':cantidadRetirada', $despacho->CantidadRetirada);
          $stmtDespacho->bindValue(':precioRetiro', $despacho->PrecioRetiro);
          $stmtDespacho->bindValue(':observaciones', $despacho->Observaciones);
          $stmtDespacho->bindValue(':idUsuario', $despacho->C_Usuario);

          $stmtDespacho->execute();

          $this->Conexion->commit();
        }
        catch (PDOException $e)
        {
          $this->Conexion->rollBack();
        }

      }

      try
      {
        $this->Conexion->beginTransaction();

        $query = 'UPDATE
                    pedido
                  SET
                    pedidoDespachado = true
                  WHERE idPedido = :id';

        $stmtPedido = $this->Conexion->prepare($query);
        //echo "string   ----  {$obtenerPedido['idPedido']}";
        $stmtPedido->bindValue(':id', $obtenerPedido['idPedido']);

        $stmtPedido->execute();

        $this->Conexion->commit();
      }
      catch (PDOException $e)
      {
        $this->Conexion->rollBack();
      }

    }

  }

}

?>
