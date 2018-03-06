<?php
include '../model/conexion.php';
include '../model/categoria.php';
include '../model/metrica.php';
include '../model/producto.php';
include '../model/consultasBasicas.php';
include '../controller/ctrCategoria.php';
include '../controller/ctrMetrica.php';
include '../controller/ctrProducto.php';
$con = new Conexion();
$manageCat = new ManageCategoria($con);
$listaCat = $manageCat->listaCategoria();
$manageMet = new ManageMetrica($con);
$listaMet = $manageMet->lista();
$manageProd = new ManageProducto($con);
$listaProd = $manageProd->listar();
?>
<div class="container">
        <div class="text-center well" style="opacity:0.6">
            <h1>Productos</h1>
        </div>
        <div class="row">
            <div class="col-sm-1 col-md-2"></div>
            <div class="col-sm-10 col-md-8" id="RespuestaTabla">

                <div class="panel panel-primary">
        					<div class="panel-heading">
        						<h2 class="panel-title">Lista de Productos <h2 id="RespuestaMensaje"></h2></h2>
        						<div class="pull-right">
											<a href="#RegistroProve" data-toggle="modal" class="clickable filter btn btn-success"><i class="fa fa-plus" data-toggle="tooltip" title="Añadir nuevo Producto"></i></a>
        							<span class="clickable filter btn btn-info" data-toggle="tooltip" title="Click aqui para buscar un Producto" data-container="body">
        								<i class="fa fa-search"></i>
        							</span>
        						</div><br><br>
                    <div class="table-responsive">
                      <table class="table">
                        <thead class="desk">
                          <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Categoria</th>
                            <th class="text-right">Editar</th>
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
                              foreach ($listaProd as $listaP): ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo ucwords(strtolower($listaP->NombreProducto)); ?></td>
                            <td><?php echo $listaP->C_Categoria->NombreCategoria; ?></td>
                            <td><a href="#editar<?php echo $listaP->IdProducto; ?>" class="btn btn-primary" data-toggle="modal"><i class="fa fa-pencil"></i></a></td>
                          </tr>
                          <?php
                            include 'modalForm/editarProducto.php';
                          ?>
                        <?php endforeach; ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-sm-1 col-md-2"></div>
            </div>
    	  </div>
<?php
  include 'modalForm/registroProducto.php';
?>
