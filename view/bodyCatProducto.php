<?php
include '../model/conexion.php';
include '../model/categoria.php';
include '../model/metrica.php';
include '../model/consultasBasicas.php';
include '../controller/ctrCategoria.php';
include '../controller/ctrMetrica.php';
$con = new Conexion();
$manageCat = new ManageCategoria($con);
$litaCat = $manageCat->listaCategoria();
$manageMet = new ManageMetrica($con);
$litaMet = $manageMet->lista();
?>
<div class="container">
        <div class="text-center well" style="opacity:0.6">
            <h1>Categorias Y Unidades de Medidas</h1>
        </div>
        <div class="row">
            <div class="col-sm-1 col-md-1"></div>
            <div class="col-sm-5 col-md-5">

                <div class="panel panel-primary">
        					<div class="panel-heading">
        						<h2 class="panel-title">Acciones Posibles CATEGORIA</h2>
        						<div class="pull-right">
											<a href="#RegistroCat" data-toggle="modal" class="clickable filter btn btn-success"><i class="fa fa-plus" data-toggle="tooltip" title="Añadir nueva Categoria"></i></a>
        							<span class="clickable filter btn btn-info" data-toggle="tooltip" title="Click aqui para buscar una Categoria" data-container="body">
        								<i class="fa fa-search"></i>
        							</span>
        						</div><br><br>
                    <div class="table-responsive">
                      <table class="table">
                        <thead class="desk">
                          <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Editar</th>
                          </tr>
                        </thead>
                      </table>
                    </div>

        					</div>
        					<div class="panel-body" style="display: none">
        						<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Buscar Categoria" />
        					</div>
                  <div class="table-responsive" style="height:350px;overflow-y:scroll;;">
                    <table class="table table-hover" id="dev-table" >

                      <tbody class="text-center">
                        <?php $i = 1;
                              foreach ($litaCat as $listaC): ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $listaC->NombreCategoria; ?></td>
                            <td><a href="#editar<?php echo $listaC->IdCategoria; ?>" class="btn btn-warning" data-toggle="modal"><i class="fa fa-pencil"></i></a></td>
                            <?php
                              include 'modalForm/editarCategoria.php'; //incluimos este archivo par las ediciones de Categorias
                            ?>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  </div>

            </div>

            <div class="col-sm-5 col-md-5">

              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h2 class="panel-title">Acciones Posibles UNIDADES DE MEDIDA</h2>
                  <div class="pull-right">
                    <a href="#RegistroMet" data-toggle="modal" class="clickable filter btn btn-success"><i class="fa fa-plus" data-toggle="tooltip" title="Añadir nueva Metrica"></i></a>
                    <span class="clickable filter btn btn-info" data-toggle="tooltip" title="Click aqui para buscar Unidad de Medida" data-container="body">
                      <i class="fa fa-search"></i>
                    </span>
                  </div><br><br>
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="desk">
                        <tr>
                          <th class="text-center">#</th>
                          <th class="text-center">Nombre</th>
                          <th class="text-center">Abreviatura</th>
                          <th class="text-center">Editar</th>
                        </tr>
                      </thead>
                    </table>
                  </div>

                </div>
                <div class="panel-body" style="display: none">
                  <input type="text" class="form-control" id="task-table-filter" data-action="filter" data-filters="#task-table" placeholder="Buscar Unidad de Medida" />
                </div>
                <div class="table-responsive" style="height:350px;overflow-y:scroll;;">
                  <table class="table table-hover" id="task-table" >

                    <tbody class="text-center">
                      <?php $i = 1;
                            foreach ($litaMet as $listaM): ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $listaM->NombreMetrica; ?></td>
                          <td><?php echo $listaM->Abreviatura; ?></td>
                          <td><a href="#editar<?php echo $listaM->NombreMetrica; ?>" class="btn btn-warning" data-toggle="modal"><i class="fa fa-pencil"></i></a></td>
                          <?php
                            include 'modalForm/editarMetrica.php'; //incluimos este archivo par las ediciones de Categorias
                          ?>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                </div>

            </div>
            <div class="col-sm-1 col-md-1"></div>
        </div>
</div>

<?php
include 'modalForm/registroCategoria.php';
include 'modalForm/registroMetrica.php';
?>
