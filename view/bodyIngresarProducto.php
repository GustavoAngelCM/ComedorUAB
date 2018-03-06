<?php
include '../model/conexion.php';
include '../model/categoria.php';
include '../model/metrica.php';
include '../model/producto.php';
include '../model/consultasBasicas.php';
include '../model/ConsultasAlmacen.php';
include '../controller/ctrProducto.php';
$con = new Conexion();
$manageProd = new ManageProducto($con);
$consultaAlmacen = new ConsultasAlmacen($con);
$listaDetalleAlmacen=$consultaAlmacen->listaDetalleAlmacen();
$listaProd = $manageProd->listar();
?>
<div class="container">
        <div class="text-center well" style="opacity:0.6">
            <h1>Almacen</h1>
        </div>
        <div class="row">
            <div class="col-sm-10 col-md-5">

                <div class="panel panel-primary">
        					<div class="panel-heading">
        						<h2 class="panel-title">Agregar Producto al Almacen</h2>
        					</div>


                    <div class="panel-body">

                      <form action="menuAdmin.php?modo=rProductoAlmacen" method="post">


                          <div class="form-group">
                              <label>Producto</label>
                              <div class="input-group selector">
                                <span class="input-group-addon" style="background: red; color:white" id="sizing-addon2"><i class="fa fa-cube"></i></span>
                                <select class="selectpicker form-control" name="producto" id="producto" data-live-search="true" title="Seleccione un producto" required>
                                  <?php foreach ($listaProd as $listaProducto): ?>
                                    <option value="<?php echo $listaProducto->IdProducto; ?>"><?php echo $listaProducto->NombreProducto; ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label>Fecha de Ingreso</label>
                              <div class="input-group" >
                                <span class="input-group-addon" style="background: red; color:white" id="sizing-addon2"><i class="fa fa-calendar"></i></span>
                                <input name="fechaIngeso" type="text" class="form-control datepicker" data-date-format="yyyy/mm/dd" readonly="true" placeholder="Fecha de registro:  AAAA/MM/DD" aria-describedby="sizing-addon2" required>

                              </div>
                            </div>


                          <div class="form-group">

                              <label>Cantidad Ingresada del Producto</label>
                              <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2" style="background:red; color:white"><i class="fa fa-linode"></i></span>
                                <input type="text" class="form-control" placeholder="Cantidad del producto" aria-describedby="sizing-addon2" name="cantidadProducto" required>
                              </div>


                          </div>

                          <div class="form-group">
                            <label>Precio Total</label>
                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2" style="background:red; color:white"><i class="fa fa-linode"></i></span>
                              <input type="text" id="precioTotal" class="form-control" placeholder="Precio Total del producto" aria-describedby="sizing-addon2" name="precioProducto" required>
                            </div>
                          </div>

                          <div class="form-group">
                            <label>Fecha de Vencimiento</label>
                            <input style="width:15%" type="checkbox" id="fv" name="fv" value="true" onClick="mostrarOcultar()" >SI</input>
                            <div  style="display:none" id="fechaDeVencimiento">
                              <div class="input-group"  >
                                <span class="input-group-addon" style="background: red; color:white" id="fechaDeVencimiento1"><i class="fa fa-calendar"></i></span>
                                <input id="fechaDeVencimiento2" name="fechaVencimiento" type="text" class="form-control datepicker" data-date-format="yyyy/mm/dd" readonly="true" placeholder="Fecha de Vencimiento:  AAAA/MM/DD" aria-describedby="sizing-addon2" >
                              </div>
                            </div>

                          </div>      <!--<input style="width:15%" class="ocultarFecha" type="radio" name="fv" value="Si"  CHECKED>Si-->

                          <script language="JavaScript">
                          function mostrarOcultar() {
                              if (document.getElementById('fv').checked==false){
                              // document.getElementById('fechaDeVencimientoIcon').style.display='none';
                              document.getElementById('fechaDeVencimiento').style.display='none';
                              $('#fechaDeVencimiento2').val("");
                            }
                              else{
                              // document.getElementById('fechaDeVencimientoIcon').style.display='block';
                              document.getElementById('fechaDeVencimiento').style.display='block';
                            }
                          }
                          </script>

                          <div class="form-group">
                            <label>Factura</label>
                            <input style="width:15%" type="checkbox" id="opcFactura" name="opcFactura" value="true" onClick="mostrarOcultarFac()" >SI</input>
                            <div  style="display:none" id="factura">
                              <div class="form-group">
                                <label>Numero Factura</label>
                                <div class="input-group">
                                  <span class="input-group-addon" id="sizing-addon2" ><i class="fa fa-sort-numeric-asc"></i></span>
                                  <input type="text" class="form-control" placeholder="Numero factura" aria-describedby="sizing-addon2" name="numeroFactura" >
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Valor IVA</label>
                                <div class="input-group">
                                  <span class="input-group-addon" id="sizing-addon2" ><i class="fa fa-sort-numeric-asc"></i></span>
                                  <input type="text" id="iva" class="form-control" placeholder="Valor IVA" aria-describedby="sizing-addon2" name="valorIva" readonly >
                                </div>
                              </div>
                            </div>

                          </div>      <!--<input style="width:15%" class="ocultarFecha" type="radio" name="fv" value="Si"  CHECKED>Si-->

                          <script language="JavaScript">
                          var valorIva=0;
                          function mostrarOcultarFac() {
                              if (document.getElementById('opcFactura').checked==false){
                              document.getElementById('factura').style.display='none';
                              }
                              else{
                              valorIva=$('#precioTotal').val();
                              valorIva=valorIva*0.13;
                              // $('#iva').val(valorIva);
                              document.getElementById('iva').value = valorIva;
                              document.getElementById('factura').style.display='block';
                            }
                          }
                          </script>

                          <input type="hidden" name="datos" value="1">
                          <div class="pull-right">

                            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancelar <i class="fa fa-times-circle"></i></button>
                            <button type="reset" value="Reset" name="reset" class="btn btn-default">Limpiar <span class="fa fa-refresh"></span></button>
                            <button type="submit" class="btn btn-success">Guardar <i class="fa fa-check-circle"></i></button>
                          </div>

                      </form>

                    </div>
                </div>

              </div>
              <div class="col-sm-10 col-md-7">

                  <div class="panel panel-primary">
          					<div class="panel-heading">
          						<h2 class="panel-title">Detalle Almacen</h2>


          					</div>

                      <div class="panel-body">
                        <div class="table-responsive" style="height:400px;overflow-y:scroll;;">
                          <table class="table table-hover" id="dev-table" >
                            <div class="table-responsive">
                              <table class="table">
                                <thead class="desk" style="background:red; color:white;">
                                  <tr>
                                    <th class="text-center">Fecha de Registro</th>
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Cantidad Ingresada</th>
                                    <th class="text-center">Unidad de Medida</th>
                                    <th class="text-center">Cantidad Total</th>
                                    <th class="text-center">Fecha de Vencimiento</th>
                                    <th class="text-center">Usuario</th>
                                  </tr>
                                </thead>


                            <tbody class="text-center">

                              <?php

                                    foreach ($listaDetalleAlmacen as $listaDetAlm):
                                      ?>
                                <tr>
                                  <td><?php echo $listaDetAlm['fechaRegistro'];?></td>
                                  <td><?php echo ucwords(strtolower($listaDetAlm['nombreProducto'])); ?></td>
                                  <td><?php echo $listaDetAlm['cantidadIngresada']; ?></td>
                                  <td><?php echo $listaDetAlm['nombre']; ?></td>
                                  <td><?php echo $listaDetAlm['cantidad']; ?></td>
                                  <?php if ($listaDetAlm['fechaVencimiento']=="") {
                                    ?> <td>Sin caducidad</td> <?php
                                  }else {
                                  ?><td><?php echo $listaDetAlm['fechaVencimiento']; ?></td><?php
                                  } ?>


                                  <td><?php echo $listaDetAlm['usuario']; ?></td>

                                </tr>
                              <?php endforeach; ?>

                            </tbody>
                            </table>
                            </div>
                          </table>
                        </div>


                      </div>
                  </div>

                </div>

          </div>

  </div>
