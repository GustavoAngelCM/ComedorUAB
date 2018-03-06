<?php
include '../model/conexion.php';
include '../model/ConsultasAlmacen.php';
$con = new Conexion();
$manageAlmacen = new ConsultasAlmacen($con);
$listaAlmacen = $manageAlmacen->detalleAlmacen();

?>
<div class="container">
        <div class="text-center well" style="opacity:0.6">
            <h1>Detalle Almacen</h1>
        </div>
        <div class="row">
            <div class="col-sm-1 col-md-2"></div>
            <div class="col-sm-10 col-md-8">

                <div class="panel panel-primary">
        					<div class="panel-heading">
        						<h2 class="panel-title">Lista de Almacen</h2>
        						<div class="pull-right">
                      <a href="tablaLlenoPDF.php" class="btn btn-danger btn-sm exportarFormularioPDFVER">Exportar PDF <i class="fa fa-file-pdf-o"></i></a>
											<a href="menuAdmin.php?modo=gIngresarProducto" class="clickable filter btn btn-success"><i class="fa fa-plus" data-toggle="tooltip" title="Añadir nuevo Producto al almacen"></i></a>
        							<span class="clickable filter btn btn-info" data-toggle="tooltip" title="Click aqui para buscar un Producto" data-container="body">
        								<i class="fa fa-search"></i>
        							</span>
        						</div><br><br>
                    <div class="table-responsive">
                      <table class="table">
                        <thead class="desk">
                          <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Cantidad Total</th>
                            <th class="text-center">Unidad de Medida</th>
                          </tr>
                        </thead>
                      </table>
                    </div>

        					</div>
        					<div class="panel-body" style="display: none">
        						<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Buscar Proveedores" />
        					</div>
                  <div class="table-responsive" style="height:350px;overflow-y:scroll;;">
                    <table class="table table-hover" id="dev-table" >

                      <tbody class="text-center">

                        <?php
                        $i = 1;
                              foreach ($listaAlmacen as $listaA): ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo ucwords(strtolower($listaA['nombreProducto'])); ?></td>
                            <td><?php echo $listaA['cantidad']; ?></td>
                            <td><?php echo $listaA['nombre']; ?></td>


                          </tr>
                        <?php endforeach; ?>

                      </tbody>
                    </table>
                  </div>
                  </div>

              </div>
              <div class="col-sm-1 col-md-2"></div>
            </div>
    	  </div>
