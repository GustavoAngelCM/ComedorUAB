<div class="modal fade" id="editar<?php echo $listaP->IdProducto ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <form class="formEditProd" action="menuAdmin.php?modo=eProd" method="post">

        <div class="modal-header">
          <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="modal-title">Editar <i class="fa fa-arrow-right"></i> PRODUCTO</h3>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2" style="background:red; color:white"><i class="fa fa-linode"></i></span>
              <input type="text" class="form-control" placeholder="Nombre Producto: " aria-describedby="sizing-addon2" name="nombre" value="<?php echo $listaP->NombreProducto ?>" required>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2" style="background:red; color:white" title="Agregar NUEVA Categoria" data-toggle="tooltip">
                <a href="#RegistroCat" data-dismiss="modal" class="btn btn-default btn-xs" data-toggle="modal"><i class="fa fa-cube"></i></a>
              </span>
              <select class=" form-control" data-size="4" name="categoria" data-live-search="true"  title="Selecciona una Categoria" required>
                <?php foreach ($listaCat as $listaC): ?>
                  <?php if ($listaC->IdCategoria == $listaP->C_Categoria->IdCategoria): ?>
                    <option data-tokens="<?php echo $listaC->NombreCategoria; ?>" value="<?php echo $listaC->IdCategoria ?>" selected><?php echo $listaC->NombreCategoria; ?></option>
                  <?php else: ?>
                    <option data-tokens="<?php echo $listaC->NombreCategoria; ?>" value="<?php echo $listaC->IdCategoria ?>"><?php echo $listaC->NombreCategoria; ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2" style="background:red; color:white" title="Agregar NUEVA Unidad de Medida" data-toggle="tooltip">
                <a href="#RegistroMet" data-dismiss="modal" class="btn btn-default btn-xs" data-toggle="modal"><i class="fa fa-cube"></i></a>
              </span>
              <select class=" form-control" data-size="4" name="metrica" data-live-search="true"  title="Selecciona una Unidad de Medida" required>
                <?php foreach ($listaMet as $listaM): ?>
                  <?php if ($listaM->IdMetrica == $listaP->C_Metrica->IdMetrica): ?>
                    <option data-tokens="<?php echo $listaM->NombreMetrica." ".$listaM->Abreviatura; ?>" value="<?php echo $listaM->IdMetrica ?>" selected><?php echo $listaM->NombreMetrica."  [ {$listaM->Abreviatura} ]"; ?></option>
                  <?php else: ?>
                    <option data-tokens="<?php echo $listaM->NombreMetrica." ".$listaM->Abreviatura; ?>" value="<?php echo $listaM->IdMetrica ?>"><?php echo $listaM->NombreMetrica."  [ {$listaM->Abreviatura} ]"; ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <input type="hidden" name="datos" value="1">

          <input type="hidden" name="id" value="<?php echo $listaP->IdProducto ?>">
          <input type="hidden" name="name" value="<?php echo $listaP->NombreProducto ?>">
          <input type="hidden" name="cat" value="<?php echo $listaP->C_Categoria->IdCategoria ?>">
          <input type="hidden" name="met" value="<?php echo $listaP->C_Metrica->IdMetrica ?>">

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
