<div class="modal fade" id="editar<?php echo $listaC->IdCategoria; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="menuAdmin.php?modo=eCat" method="post">

        <div class="modal-header">
          <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="modal-title">Editar <i class="fa fa-arrow-right"></i> Categoria</h3>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2" style="background:red; color:white"><i class="fa fa-linode"></i></span>
              <input type="text" class="form-control" placeholder="Nombre Categoria: <?php echo $listaC->NombreCategoria; ?>" maxlength="30" value="<?php echo $listaC->NombreCategoria; ?>" aria-describedby="sizing-addon2" name="nombre" required>
            </div>
          </div>
          <input type="hidden" name="datos" value="1">
          <input type="hidden" name="id" value="<?php echo $listaC->IdCategoria; ?>">
          <input type="hidden" name="name" value="<?php echo $listaC->NombreCategoria; ?>">
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
