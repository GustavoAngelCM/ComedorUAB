<div class="modal fade" id="RegistroProve">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="menuAdmin.php?modo=rProd" method="post">

        <div class="modal-header">
          <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="modal-title">Crear un Nuevo <i class="fa fa-arrow-right"></i> PRODUCTO</h3>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2" style="background:red; color:white"><i class="fa fa-linode"></i></span>
              <input type="text" class="form-control" placeholder="Nombre Producto: " aria-describedby="sizing-addon2" name="nombre" required>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2" style="background:red; color:white" title="Agregar NUEVA Categoria" data-toggle="tooltip">
                <a href="#RegistroCat" data-dismiss="modal" class="btn btn-default btn-xs" data-toggle="modal"><i class="fa fa-cube"></i></a>
              </span>
              <select class="selectpicker form-control" data-size="4" name="categoria" data-live-search="true"  title="Selecciona una Categoria">
                <?php foreach ($listaCat as $key => $listaC): ?>
                  <option data-tokens="<?php echo $listaC->NombreCategoria; ?>" value="<?php echo $listaC->IdCategoria."_".$listaC->NombreCategoria; ?>"><?php echo $listaC->NombreCategoria; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2" style="background:red; color:white" title="Agregar NUEVA Unidad de Medida" data-toggle="tooltip">
                <a href="#RegistroMet" data-dismiss="modal" class="btn btn-default btn-xs" data-toggle="modal"><i class="fa fa-cube"></i></a>
              </span>
              <select class="selectpicker form-control" data-size="4" name="metrica" data-live-search="true"  title="Selecciona una Unidad de Medida">
                <?php foreach ($listaMet as $key => $listaM): ?>
                  <option data-tokens="<?php echo $listaM->NombreMetrica." ".$listaM->Abreviatura; ?>" value="<?php echo $listaM->IdMetrica."_".$listaM->NombreMetrica."_".$listaM->Abreviatura; ?>"><?php echo $listaM->NombreMetrica."  [ {$listaM->Abreviatura} ]"; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <input type="hidden" name="datos" value="1">

        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancelar <i class="fa fa-times-circle"></i></button>
          <button type="reset" value="Reset" name="reset" class="btn btn-default">Limpiar <span class="fa fa-refresh"></span></button>
          <button type="submit" class="btn btn-success">Guardar <i class="fa fa-check-circle"></i></button>
        </div>

      </form>

    </div>
  </div>
</div>
<?php
include 'modalForm/registroCategoria.php';
include 'modalForm/registroMetrica.php';
?>
