<?php
include '../model/conexion.php';
include '../model/Almacen.php';
include '../model/producto.php';
include '../model/ProductoModel.php';
include '../model/Plato.php';
include '../model/PlatoModel.php';
include '../controller/ctrProducto.php';
include '../controller/ctrPlato.php';
$conexion = new Conexion();
$productoManejador = new ManageProducto($conexion);
$listaProductos = $productoManejador->productosStock("");

$platoManejador = new PlatoControlador($conexion);
$listaPlatos = $platoManejador->listar();

?>
<div class="container">
  <div class="row">
    <div class="col-xs-1 col-sm-2 col-md-2"></div>
    <div class="col-xs-10 col-sm-8 col-md-8">
      <div class="text-center well" style="opacity:0.8">
        <h4>PEDIDOS</h4>
      </div>
      <a class="btn btn-success" data-toggle="modal" data-target="#conversor">Conversor</a>
      <br><br>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title">Pedido De Platos/Productos</h2>
        </div>
        <div class="panel-body">
          <label>Platos/Productos</label>
          <select id="platoPedido" class="selectpicker form-control" name="plato">
            <option value="">Productos Independientes</option>
            <?php foreach ($listaPlatos as $listaP): ?>
              <option value="<?php echo $listaP->IdPlato ?>"><?php echo $listaP->NombrePlato ?></option>
            <?php endforeach; ?>
          </select>
          <hr>
          <div class="table-responsive" id="tablaRespuesta">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th class="text-center">Producto</th>
                  <th class="text-center">Cantidad Disponible</th>
                  <th>Cantidad a Pedir</th>
                </tr>
              </thead>
              <tbody>
                <div id="mensajeRespuesta"></div>
                <?php foreach ($listaProductos as $listaP): ?>
                  <tr>
                    <td class="text-center"><?php echo $listaP->C_Producto->NombreProducto ?></td>
                    <td class="text-center"><?php echo $listaP->Cantidad ?></td>
                    <td class="text-center">
                      <input type="text" name="cantidaPedido[]" class="solo-numero-float form-control cantidaPedido" style="width: 100px">
                      <input type="hidden" name="idPedido[]" class="solo-numero-float idPedido" value="<?php echo $listaP->C_Producto->IdProducto ?>">
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="pull-right">
            <button type="button" name="guardar" class="btn btn-success" id="guardarPedido">Guardar Pedido <i class="fa fa-paper-plane"></i></button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-1 col-sm-2 col-md-2"></div>
  </div>
</div>

<div class="modal fade" id="conversor">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="contenido-conversion">

          <div class="text-center">
            <h3>Conversor de Unidades</h3>
          </div>

          <select id="tipoConversion" name="tipo" class="form-control selectpicker">
            <option value="1">Volúmen</option>
            <option value="2">Peso</option>
          </select>

          <hr>

          <div class="container-fluid" id="volumen">
            <div class="row">
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="text-center">
                  <h4>Valor</h4>
                </div>
                <input type="text" name="valor1" id="valor1" value="0" class="form-control solo-numero-float">
              </div>
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="text-center">
                  <h4>De</h4>
                </div>
                <select name="unidad1" id="unidad1" class="form-control selectpicker" data-live-search="true">
                  <option value="1" data-tokens="centimetro cubico">cm³</option>
                  <option value="2" data-tokens="litro">lt</option>
                  <option value="3" data-tokens="metro cubico">m³</option>
                  <option value="4" data-tokens="pulgada cubica">pulgada³</option>
                  <option value="5" data-tokens="pie cubico">pie³</option>
                  <option value="6" data-tokens="galon">galón</option>
                </select>
              </div>
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="text-center">
                  <h4>A</h4>
                </div>
                <select name="unidad2" id="unidad2" class="form-control selectpicker" data-live-search="true">
                  <option value="1" data-tokens="centimetro cubico">cm³</option>
                  <option value="2" data-tokens="litro">lt</option>
                  <option value="3" data-tokens="metro cubico">m³</option>
                  <option value="4" data-tokens="pulgada cubica">pulgada³</option>
                  <option value="5" data-tokens="pie cubico">pie³</option>
                  <option value="6" data-tokens="galon">galón</option>
                </select>
              </div>
              <div class="pull-right"><br>
                <button type="button" name="button" id="convertirVolumen" class="btn btn-primary">Convertir</button>
              </div>
              <div class="text-center"><br><br><br><br><br><br>
                <h3 id="respuestaVolumen"></h3>
                <a class="btn btn-default btn-sm" data-toggle="tooltip" title="Copiar"><i class="fa fa-clipboard"></i></a>
              </div>
            </div>
          </div>

          <div class="pull-right">
            <button type="button" name="button" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i></button>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
