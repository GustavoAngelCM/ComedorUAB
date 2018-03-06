<?php
include '../model/conexion.php';
include '../model/pedido.php';
include '../model/PedidoConsulta.php';
include '../model/detallePedido.php';
include '../model/DetallePedidoConsulta.php';
include '../controller/ctrPedido.php';

$conexion = new Conexion();

$pedidoManage = new ManagePedido($conexion);
$listaPedidos = $pedidoManage->listar();
$i = 0;

?>
<div class="container">
  <div class="row">

    <div class="text-center" style="opacity:0.9;">
        <h1>DESPACHOS</h1>
    </div>

    <div class="col-xs-1 col-sm-1 col-md-1"></div>
    <div class="col-xs-10 col-sm-10 col-md-10">
      <br><br>
      <div class="panel panel-primary">
        <div class="panel-heading" style="background-color: rgb(53, 116, 136)"><h4><strong>Lista De Pedidos</strong></h4>
          <center><button type="button" name="despachar" class="btn btn-success btn-lg" id="despacharPedidos">Despachar Pedidos</button></center>
        </div>
        <div class="panel-body" style="height: 400px">

          <br><div id="mensaje">
            <br>
            <?php if ($listaPedidos)
            {
               foreach ($listaPedidos as $listaP): $i++;?>
                <div class="panel panel-primary">
                  <div class="panel-heading" id="accordion">
                    <input type="checkbox" class="despacho" name="despacho[]" value="<?php echo $listaP->IdPedido ?>">
                    <?php if ($listaP->C_Plato): ?>
                      <span class="fa fa-shopping-bag"></span> </i><?php echo $listaP->CantidadPlato." platos de ".$listaP->C_Plato ?>
                    <?php else: ?>
                      <span class="fa fa-shopping-bag"></span> </i>Productos Independientes
                    <?php endif; ?>
                    <div class="btn-group pull-right">
                      <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#detalle<?php echo $listaP->IdPedido; ?>">
                        <span class="fa fa-chevron-down"></span>
                      </a>
                    </div>
                  </div>
                  <div id="detalle<?php echo $listaP->IdPedido ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body" style="height: 200px">

                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>Producto</th>
                              <th>Cantidad</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($listaP->getListaDetallePedido() as $listaDP): ?>
                              <tr>
                                <td><?php echo $listaDP->C_Almacen; ?></td>
                                <td><?php echo $listaDP->Cantidad; ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach;
            }
            else { ?>
              <div class="text-center">
                <p style="color:red">No Existen pedidos a ser despachados</p>
              </div>
            <?php } ?>

          </div><br>
        </div>
      </div>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1"></div>

  </div>
</div>
