<?php
include '../model/conexion.php';
include '../model/categoria.php';
include '../model/metrica.php';
include '../model/producto.php';
include '../model/consultasBasicas.php';
include '../model/Reportes.php';
include '../controller/ctrProducto.php';

$con = new Conexion();
$manajadorProd = new ManageProducto($con);
$reporte = new Reportes($con);

$listaProd = $manajadorProd->listar();

   $listaAlmacenFecha = $reporte->detalleAlmacenDeProducto($_POST['producto'],$_POST['fechaInicio'],$_POST['fechaFin']);

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
        						<h2 class="panel-title">REPORTE</h2>
                    <div class="pull-right">
                      <a href="reporteLlenoPDF.php?prod=<?php echo $_POST['producto'];?>&fechaI=<?php echo $_POST['fechaInicio'];?>&fechaF=<?php echo $_POST['fechaFin'];?>" class="btn btn-danger btn-sm exportarFormularioPDFVER">Exportar PDF <i class="fa fa-file-pdf-o"></i></a>
                      <a href="menuAdmin.php?modo=reporteAlmacen" class="clickable filter btn btn-success"><i class="fa fa-plus" data-toggle="tooltip" title="Nueva Busqueda"></i></a>
                      <span class="clickable filter btn btn-info" data-toggle="tooltip" title="Click aqui para buscar un Producto" data-container="body">
                        <i class="fa fa-search"></i>
                      </span>
                    </div><br><br>

                    <div class="table-responsive">
                      <table class="table">
                        <thead class="desk">
                          <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Fecha Registro</th>
                            <th class="text-center">Nombre Producto</th>
                            <th class="text-center">Cantidad Ingresada</th>
                            <th class="text-center">Fecha Vencimiento</th>
                            <th class="text-center">Usuario que registro</th>

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
                        $totalCantidad=0;
                        $i = 1;
                              foreach ($listaAlmacenFecha as $listaA): ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $listaA['fechaRegistro']; ?></td>
                            <td><?php echo ucwords(strtolower($listaA['nombreProducto'])); ?></td>
                            <td><?php echo $listaA['cantidadIngresada']."  ".$listaA['abreviatura']; ?></td>
                            <?php if ($listaA['fechaVencimiento']=="") {
                              ?> <td>Sin caducidad</td> <?php
                            }else {
                            ?><td><?php echo $listaA['fechaVencimiento']; ?></td><?php
                            } ?>
                            <td><?php echo $listaA['usuario']; ?></td>

                          </tr>
                          <?php
                          $totalCantidad=$totalCantidad+$listaA['cantidadIngresada'];
                        endforeach; ?>


                      </tbody>
                      <tfoot>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tfoot>
                    </table>
                  </div>
                  </div>
            </div>
            <div class="col-sm-1 col-md-2"></div>

            </div>
    	  </div>
