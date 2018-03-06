<?php
include '../model/conexion.php';
include '../model/categoria.php';
include '../model/metrica.php';
include '../model/producto.php';
include '../model/consultasBasicas.php';
include '../controller/ctrProducto.php';

$con = new Conexion();
$manajadorProd = new ManageProducto($con);
$listaProd = $manajadorProd->listar();


?>
<div class="container">
        <div class="text-center well" style="opacity:0.6">
            <h1>Reporte Almacen</h1>
        </div>
        <div class="row">
          <div class="col-sm-1 col-md-2"></div>
            <div class="col-sm-10 col-md-8">

                <div class="panel panel-primary">
        					<div class="panel-heading">
        						<h1 class="panel-title">Detalle de Almacen por producto y fechas</h1>

                    <form  action="menuAdmin.php?modo=reporteDetalle1" method="post" >

                        <div class="row"style="background:#193144">
                          <br>
                        <div class="col-md-12">
                          <label>Producto:</label>
                            <div class="input-group selector">
                              <span class="input-group-addon" style="background: red; color:white" id="sizing-addon2"><i class="fa fa-cube"></i></span>
                              <select class="selectpicker form-control" name="producto" id="producto" data-live-search="true" title="Seleccione un producto" required>
                                <?php foreach ($listaProd as $listaProducto): ?>
                                  <option value="<?php echo $listaProducto->IdProducto; ?>"><?php echo $listaProducto->NombreProducto; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <br><br><br><br>

                          <div class="col-md-6">
                            <label>Fecha Inicio</label>
                            <div class="input-group" >
                              <span class="input-group-addon" style="background: red; color:white" id="sizing-addon2"><i class="fa fa-calendar"></i></span>
                              <input id="fechaInico" name="fechaInicio" type="text" class="form-control datepicker" data-date-format="yyyy/mm/dd" readonly="true" placeholder="Fecha Inicio:  AAAA/MM/DD" aria-describedby="sizing-addon2" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                              <label>Fecha Fin</label>
                            <div class="input-group" >
                              <span class="input-group-addon" style="background: red; color:white" id="sizing-addon2"><i class="fa fa-calendar"></i></span>
                              <input id="fechaFin" name="fechaFin" type="text" class="form-control datepicker" data-date-format="yyyy/mm/dd" readonly="true" placeholder="Fecha Fin:  AAAA/MM/DD" aria-describedby="sizing-addon2" required>
                            </div>
                          </div>
                          <br><br><br><br>
                            <div class="col-md-12">
                              <div class="pull-right">
                                <button type="submit" class="btn btn-success">Ver Detalle <i class="fa fa-check-circle"></i></button>
                              </div>
                            </div>
                            <br><br><br>
                          </div>
                  </form>
                  </div>
                  </div>
            </div>
            <div class="col-sm-1 col-md-2"></div>

            </div>
    	  </div>
