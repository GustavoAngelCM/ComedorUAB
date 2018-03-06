<?php
include '../model/conexion.php';
include '../model/login.php';
include '../model/SED.php';
include '../model/UsuarioConsulta.php';
include '../model/ConsultasBasicas.php';
include '../controller/ctrLogin.php';

$conexion = new Conexion();
$usuarioManejador = new LoginManager();
$listaUsuarios = $usuarioManejador->listar($conexion);

$i = 1;

?>
<div class="container">
  <div class="row">
    <div class="col-xs-1 col-sm-2 col-md-2"></div>
    <div class="col-xs-10 col-sm-8 col-md-8">
      <div class="text-center well">
        <h3><strong>Nutricionista</strong></h3>
      </div>

      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title">Acciones Posibles</h2>
          <div class="pull-right">
            <a href="#RegistroUser" data-toggle="modal" class="clickable filter btn btn-success"><i class="fa fa-plus" data-toggle="tooltip" title="Añadir nuevo(a) Nutricionista"></i></a>
            <span class="clickable filter btn btn-info" data-toggle="tooltip" title="Click aqui para buscar una Nutricionista" data-container="body">
              <i class="fa fa-search"></i>
            </span>
          </div><br><br>
          <div class="table-responsive">
            <table class="table">
              <thead class="desk">
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Nombre Usuario</th>
                  <th class="text-center">Ver</th>
                  <th class="text-center">Editar</th>
                  <th class="text-center">Estado</th>
                </tr>
              </thead>
            </table>
          </div>

        </div>
        <div class="panel-body" style="display: none">
          <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Buscar Usuario Nutricionista" />
        </div>
        <div class="table-responsive" style="height:350px;overflow-y:scroll;;">
          <table class="table table-hover" id="dev-table" >
            <tbody class="text-center">

              <?php foreach ($listaUsuarios as $listaU): ?>
                <?php if ($listaU->getEstado() == 1): ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $listaU->getUsuario() ?></td>
                    <td class="text-right"><a href="#" class="btn btn-danger"><i class="fa fa-eye"></i></a></td>
                    <td class="text-right"><a href="#" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                    <td class="text-right"><a href="#" class="btn btn-success"><i class="fa fa-toggle-on"></i></a></td>
                  </tr>
                <?php else: ?>
                  <tr class="danger">
                    <td><?php echo $i ?></td>
                    <td><?php echo $listaU->getUsuario() ?></td>
                    <td class="text-right"><a href="#" class="btn btn-default"><i class="fa fa-eye"></i></a></td>
                    <td class="text-right"><a href="#" class="btn btn-default"><i class="fa fa-pencil"></i></a></td>
                    <td class="text-right"><a href="#" class="btn btn-danger"><i class="fa fa-toggle-off"></i></a></td>
                  </tr>
                <?php endif; ?>
              <?php $i++; endforeach; ?>

            </tbody>
          </table>
        </div>
        </div>


    </div>
    <div class="col-xs-1 col-sm-2 col-md-2"></div>
  </div>
</div>
<div class="modal fade" id="RegistroUser">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="menuAdmin.php?modo=rUsuario" method="post">
        <div class="modal-header">
          <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="modal-title">Crear Nuevo Usuario <i class="fa fa-arrow-right"></i> Nutricionista</h3>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label>Usuario: </label>
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2" style="background:red; color:white"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control" placeholder="Nombre Usuario: " maxlength="30" aria-describedby="sizing-addon2" name="nombre" required>
            </div>
          </div>

          <div class="form-group">
            <label>Email: </label>
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2" style="background:red; color:white"><i class="fa fa-envelope"></i></span>
              <input type="email" class="form-control" placeholder="Email: " maxlength="30" aria-describedby="sizing-addon2" name="email" required>
            </div>
          </div>

          <div class="form-group">
            <label>Contraseña: </label>
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2" style="background:red; color:white"><i class="fa fa-lock"></i></span>
              <input type="password" id="contra" class="form-control" placeholder="Contraseña: " maxlength="30" aria-describedby="sizing-addon2" name="contrasena" required>
            </div>
          </div>

          <div class="form-group">
            <label>Repita la Contraseña: </label>
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2" style="background:red; color:white"><i class="fa fa-lock"></i></span>
              <input type="password" id="contraNew" class="form-control" placeholder="Nuevamemte Contraseña: " maxlength="30" aria-describedby="sizing-addon2" name="contrasena2" required>
            </div>
          </div>

          <div id="mensaje"></div>

        </div>
        <input type="hidden" name="datos" value="1">
        <div class="modal-footer">
          <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancelar <i class="fa fa-times-circle"></i></button>
          <button type="reset" value="Reset" name="reset" class="btn btn-default">Limpiar <span class="fa fa-refresh"></span></button>
          <button type="submit" id="saveUser" class="btn btn-success">Guardar <i class="fa fa-check-circle"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>
