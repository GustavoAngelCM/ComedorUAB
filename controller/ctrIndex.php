<?php


class ManagePage
{

  private $Modo;

  public function __construct($modo)
  {
    $this->Modo = $modo;
  }

  public function MenuIndex()
  {

    switch ($this->Modo) {

      case 'AccesDenied':
        include 'view/headerIn.php';
        ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡ERROR!</strong> <p>Acceso denegado</p>
        </div>
        <?php
        include 'view/bodyIn.php';
        include 'view/footerIn.php';
        break;

      case 'ErrUserInexitente':
        include 'view/headerIn.php';
        ?>
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡ERROR!</strong> <p>Usuario Inexistente</p>
        </div>
        <?php
        include 'view/bodyIn.php';
        include 'view/footerIn.php';
        break;

      case 'ErrPass':
        include 'view/headerIn.php';
        ?>
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡ERROR!</strong> <p>Error en la contraseña</p>
        </div>
        <?php
        include 'view/bodyIn.php';
        include 'view/footerIn.php';
          break;

      case 'CampLlenos':
          include 'model/session.php';
          include 'model/login.php';
          include 'model/ConsultasBasicas.php';
          include 'model/conexion.php';
          include 'controller/ctrLogin.php';
          include_once 'model/SED.php';
          $login = new Login($_POST['user'],$_POST['pass']);
          $manLogin = new LoginManager();
          $manLogin->Autentificacion($login);
          break;

      default:
        include 'view/headerIn.php';
        include 'view/bodyIn.php';
        include 'view/footerIn.php';
        break;
    }
  }

  public function menuNutricionista($value='')
  {
    switch ($this->Modo) {
      case 'gPedido':
        include 'headerNutri.php';
        include 'bodyGPedido.php';
        include 'footerNutri.php';
        break;

      case 'registrarPedido':
        if ($_POST)
        {
          echo "hola mundo";
          var_dump($_POST);
        }
        else
        {
          echo "<p style='color:red'>Error al Enviar datos de Pedido</p>";
        }
        break;

      case 'cambioProductos':
        if ($_POST)
        {
          include '../model/conexion.php';
          include '../model/Almacen.php';
          include '../model/producto.php';
          include '../model/ProductoModel.php';
          include '../controller/ctrProducto.php';
          $conexion = new Conexion();
          $productoManejador = new ManageProducto($conexion);
          $listaProductos = $productoManejador->productosStock($_POST['plato']);
          ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="text-center">Producto</th>
                <th class="text-center">Cantidad Disponible</th>
                <th>Cantidad a Pedir</th>
              </tr>
            </thead>
            <tbody>
              <div id="mensajeRespuesta"></div>
              <?php foreach ($listaProductos as $listaP): ?>
                <tr>
                  <td class="text-center"><?php echo $listaP->C_Producto->NombreProducto ?></td>
                  <td class="text-center"><?php echo $listaP->Cantidad ?></td>
                  <td class="text-center">
                    <input type="text" name="cantidaPedido[]" class="form-control cantidaPedido" style="width: 100px">
                    <input type="hidden" name="idPedido[]" class="idPedido" value="<?php echo $listaP->C_Producto->IdProducto ?>">
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <?php
        }
        break;

      case 'cerrarSesion':
        session_start();
        session_destroy();
        header("Location: ../index.php");
        break;

      default:
        include 'headerNutri.php';
        include 'bodyNutri.php';
        include 'footerNutri.php';
        break;
    }
  }

  public function MenuAdmin()
  {
    switch ($this->Modo) {
      case 'gProduct':
        include 'headerAdmin.php';
        include 'bodyProduct.php';
        include 'footerAdmin.php';
        break;

      case 'exiEditProd':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-check-circle"></i>Exito!</strong> <p>Al Editar Producto</p>
        </div>
        <?php
        include 'bodyProduct.php';
        include 'footerAdmin.php';
        break;

      case 'errEditProd':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-times-circle"></i>Error!</strong> <p>Al Editar Producto</p>
        </div>
        <?php
        include 'bodyProduct.php';
        include 'footerAdmin.php';
        break;

      case 'gCatPlato':
        include 'headerAdmin.php';
        include 'bodyCatPlato.php';
        include 'footerAdmin.php';
        break;

      case 'eProd':
        if (isset($_POST['datos']))
        {
          include '../model/conexion.php';
          include '../model/producto.php';
          include '../model/ProductoModel.php';
          include '../controller/ctrProducto.php';

          $conexion =  new Conexion();
          $productoModel = new ManageProducto($conexion);
          $efecto = $productoModel->editar();
            switch ($efecto) {
              case 1:
                header("Location: menuAdmin.php?modo=exiEditProd");
                break;
              case 2:
                header("Location: menuAdmin.php?modo=errEditProd");
                break;
              case 3:
                header("Location: menuAdmin.php?modo=pExi");
                break;
              case 0:
                header("Location: menuAdmin.php?modo=gProduct");
                break;
            }
        }
        else
        {
          header("Location: menuAdmin.php?modo=forVacioProd");
        }

        break;

      case 'gIngresarProducto':
        include 'headerAdmin.php';
        include 'bodyIngresarProducto.php';
        include 'footerAdmin.php';
        break;

      case 'reporteDetalle1':
        include 'headerAdmin.php';
        include 'bodyReporteAlmacenVista.php';
        include 'footerAdmin.php';
        break;

      case 'detalleAlmacen':
        include 'headerAdmin.php';
        include 'bodyDetalleAlmacen.php';
        include 'footerAdmin.php';
        break;

      case 'reporteAlmacen':
        include 'headerAdmin.php';
        include 'bodyReporteAlmacen.php';
        include 'footerAdmin.php';
        break;
      case 'registroExitosoAlmacen':
        include 'headerAdmin.php';
        ?>
        <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-6">
          <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><h4><i class="fa fa-check-circle"></i>¡Exito!</h4></strong> <p>Al Registrar el Producto en el Almacen...</p>
        </div>
        </div>
        </div>
        <?php
        include 'bodyIngresarProducto.php';
        include 'footerAdmin.php';
        break;

      case 'rProductoAlmacen':
      if (isset($_POST['datos'])) {
        include '../model/conexion.php';
        include '../model/ConsultasAlmacen.php';
        include '../model/Almacen.php';
        include '../model/DetalleAlmacen.php';
        include '../model/Factura.php';
        include '../controller/ctrAlmacen.php';
        include '../controller/ctrDetalleAlmacen.php';
        include '../controller/ctrFactura.php';

        $con = new Conexion();

        $manejadorAlmacen=new ConsultasAlmacen($con);
        $datosUsuario=$manejadorAlmacen->idUsuarioAlmacen($_SESSION['user']);
        $almacen=new Almacen();
        $almacen->IdProducto=$_POST['producto'];
        $almacen->Cantidad=$_POST['cantidadProducto'];

        $detalleAlmacen=new DetalleAlmacen();
        $detalleAlmacen->CantidadIngresada=$_POST['cantidadProducto'];
        $detalleAlmacen->FechaRegistro=$_POST['fechaIngeso'];
        $detalleAlmacen->PrecioTotal=$_POST['precioProducto'];
        $detalleAlmacen->IdUsuario=$datosUsuario['idUsuario'];
        $detalleAlmacen->FechaVencimiento=$_POST['fechaVencimiento'];
        if ($detalleAlmacen->FechaVencimiento=="")
          $detalleAlmacen->FechaVencimiento=null;

        $factura=new Factura;


        $existeProductoEnAlmacen=$manejadorAlmacen->existeProductoAlmacen($almacen->IdProducto);
        $ctrAlmacen=new ctrAlmacen($con);
        $ctrDetalleAlmacen=new ctrDetalleAlmacen($con);
        $ctrFactura=new ctrFactura($con);

        if ($existeProductoEnAlmacen==true)
          $ctrAlmacen->actualizarAlmacen($almacen);

        else
          $ctrAlmacen->registrarAlmacen($almacen);

        $datoAlmacen=$manejadorAlmacen->idAlmacen($almacen->IdProducto);
        $detalleAlmacen->IdAlmacen=$datoAlmacen['idAlmacen'];
        $ctrDetalleAlmacen->insertarDetalleAlmacen($detalleAlmacen);
        $idDetalleAlmacen=$manejadorAlmacen->idMaxDetalleAlmacen();
        $factura->NumFactura=$_POST['numeroFactura'];

        if ($factura->NumFactura!="") {
          $factura->IdDetalle=$idDetalleAlmacen['MAX(idDetalle)'];
          $factura->ValorIva=$_POST['valorIva'];
          $ctrFactura->registrarFactura($factura);
        }

        header("Location: menuAdmin.php?modo=registroExitosoAlmacen");

      }else {
        header("Location: menuAdmin.php?modo=forVacioProd");
      }


        break;
      // CRUD DE CATEGORIA Y METRICA START
      case 'gCategoriaProducto':
        include 'headerAdmin.php';
        include 'bodyCatProducto.php';
        include 'footerAdmin.php';
        break;

      case 'forVacioCat':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-exclamation-triangle"></i>¡Advertencia!</strong> <p>Por Favor llene el Formulario</p>
        </div>
        <?php
        include 'bodyCatProducto.php';
        include 'footerAdmin.php';
        break;

      case 'rExitoCat':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-check-circle"></i>¡Exito!</strong> <p>Al Registrar Categoria</p>
        </div>
        <?php
        include 'bodyCatProducto.php';
        include 'footerAdmin.php';
        break;

      case 'eDupCat':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong> <i class="fa fa-times-circle"></i> ¡ERROR!</strong> <p>La Categoria ya Existe</p>
        </div>
        <?php
        include 'bodyCatProducto.php';
        include 'footerAdmin.php';
        break;

      case 'eRegCat':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong> <i class="fa fa-times-circle"></i> ¡ERROR!</strong> <p>Error al Registrar</p>
        </div>
        <?php
        include 'bodyCatProducto.php';
        include 'footerAdmin.php';
        break;

      case 'rCat':
        if (isset($_POST['datos'])) {
          include '../model/conexion.php';
          include '../model/categoria.php';
          include '../model/consultasBasicas.php';
          include '../model/insert.php';
          include '../controller/ctrCategoria.php';
          $con = new Conexion();
          $manage = new ManageCategoria($con);
          $manage->registrarCategoria($_POST['nombre']);
        }else {
          header("Location: menuAdmin.php?modo=forVacioCat");
        }
        break;

      case 'rMet':
        if (isset($_POST['datos'])) {
          include '../model/conexion.php';
          include '../model/metrica.php';
          include '../model/consultasBasicas.php';
          include '../model/insert.php';
          include '../controller/ctrMetrica.php';
          $con = new Conexion();
          $manage = new ManageMetrica($con);
          $manage->crear($_POST['nombre'], $_POST['abrev']);
        }else {
          header("Location: menuAdmin.php?modo=forVacioCat");
        }
        break;

      case 'eCat':
        if (isset($_POST['datos'])) {
          include '../model/conexion.php';
          include '../model/categoria.php';
          include '../model/consultasBasicas.php';
          include '../model/editar.php';
          include '../controller/ctrCategoria.php';
          $con = new Conexion();
          $manage = new ManageCategoria($con);
          $manage->editar($_POST['nombre'], $_POST['id'], $_POST['name']);
        }else {
          header("Location: menuAdmin.php?modo=forVacioCat");
        }
        break;

      case 'errEditCat':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong> <i class="fa fa-times-circle"></i> ¡ERROR!</strong> <p>Error al Editar Producto</p>
        </div>
        <?php
        include 'bodyCatProducto.php';
        include 'footerAdmin.php';
        break;

      case 'editCat':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-check-circle"></i>¡Exito!</strong> <p>Al Editar Categoria</p>
        </div>
        <?php
        include 'bodyCatProducto.php';
        include 'footerAdmin.php';
        break;

      case 'rExitoMet':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-check-circle"></i>¡Exito!</strong> <p>Al Registrar Unidad de Medida</p>
        </div>
        <?php
        include 'bodyCatProducto.php';
        include 'footerAdmin.php';
        break;

      case 'edMet':
        if (isset($_POST['datos'])) {
          include '../model/conexion.php';
          include '../model/metrica.php';
          include '../model/consultasBasicas.php';
          include '../model/editar.php';
          include '../controller/ctrMetrica.php';
          $con = new Conexion();
          $manage = new ManageMetrica($con);
          $manage->editar($_POST['id'], $_POST['nombre'], $_POST['abrev'], $_POST['name'], $_POST['abr']);
        }else {
          header("Location: menuAdmin.php?modo=forVacioMet");
        }
        break;

      case 'exEditarM':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-check"></i>¡Exito!</strong> <p>Al Editar Unidad de Medida</p>
        </div>
        <?php
        include 'bodyCatProducto.php';
        include 'footerAdmin.php';
        break;

      case 'errEditarM':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-times-circle"></i>Error!</strong> <p>Al Editar Unidad de Medida</p>
        </div>
        <?php
        include 'bodyCatProducto.php';
        include 'footerAdmin.php';
        break;

      case 'errEditarMD':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <div class="text-center"><strong><i class="fa fa-exclamation-triangle"></i>Error!</strong> <p>Al Editar Unidad de Medida Unidad Existente</p></div>
        </div>
        <?php
        include 'bodyCatProducto.php';
        include 'footerAdmin.php';
        break;

      // CRUD DE CATEGORIA Y METRICA END
      // CRUD PRODUCTOS START /////////////////////////////////////////////////////////////////////
      case 'rProd':
        if (isset($_POST['datos'])) {
          include '../model/conexion.php';
          include '../model/categoria.php';
          include '../model/consultasBasicas.php';
          include '../model/insert.php';
          include '../model/metrica.php';
          include '../model/producto.php';
          include '../controller/ctrProducto.php';
          $con = new Conexion();
          $manage = new ManageProducto($con);
          $manage->insertar($_POST['nombre'], $_POST['categoria'], $_POST['metrica']);
        }else {
          header("Location: menuAdmin.php?modo=forVacioProd");
        }
        break;

      case 'exiRegProd':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-check-circle"></i>¡Exito!</strong> <p>Al Registrar Producto</p>
        </div>
        <?php
        include 'bodyProduct.php';
        include 'footerAdmin.php';
        break;

      case 'errRegProd':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-times-circle"></i>Error!</strong> <p>Al Registrar Producto</p>
        </div>
        <?php
        include 'bodyProduct.php';
        include 'footerAdmin.php';
        break;

      case 'pExi':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-times-circle"></i>¡Error!</strong> <p> Producto Existente</p>
        </div>
        <?php
        include 'bodyProduct.php';
        include 'footerAdmin.php';
        break;

// CRUD PRODUCTOS END //////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////// CRUD DESPACHOS START
      case 'gDespachos':
        include 'headerAdmin.php';
        include 'despachosForm.php';
        include 'footerAdmin.php';
        break;

      case 'despacharPedidos':
        if ($_POST)
        {
          include '../model/conexion.php';
          include '../model/pedido.php';
          include '../model/PedidoConsulta.php';
          include '../model/detallePedido.php';
          include '../model/despacho.php';
          include '../model/producto.php';
          include '../model/DespachoConsulta.php';
          include '../model/DetallePedidoConsulta.php';
          include '../model/Almacen.php';
          include '../model/AlmacenConsulta.php';
          include '../model/Plato.php';
          include '../controller/ctrPedido.php';
          include '../controller/ctrDespacho.php';
          include '../controller/AlmacenControlador.php';

          $conexion = new Conexion();
          $despachoManage = new ManageDespacho($conexion);
          foreach ($_POST['despacho'] as $idDespacho)
          {
            $despachoManage->registrar($idDespacho);
          }
          $pedidoManage = new ManagePedido($conexion);
          $listaPedidos = $pedidoManage->listar();
          $i = 0;
          echo "<br /> <div class='text-center'><p style='color: rgb(41, 83, 128)'><strong>Pedido(s) Despachado(s)</strong></p></div>";
          ?>
          <?php foreach ($listaPedidos as $listaP): $i++;?>
            <br>
            <div class="panel panel-primary">
              <div class="panel-heading" id="accordion">
                <input type="checkbox" class="despacho" name="despacho[]" value="<?php echo $listaP->IdPedido ?>">
                <?php if ($listaP->C_Plato): ?>
                  <span class="fa fa-shopping-bag"></span> </i><?php echo $listaP->CantidadPlato." platos de ".$listaP->C_Plato ?>
                <?php else: ?>
                  <span class="fa fa-shopping-bag"></span> </i>Productos Independientes
                <?php endif; ?>
                <div class="btn-group pull-right">
                  <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#detalle<?php echo $listaP->IdPedido; ?>">
                    <span class="fa fa-chevron-down"></span>
                  </a>
                </div>
              </div>
              <div id="detalle<?php echo $listaP->IdPedido ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">

                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Producto</th>
                          <th>Cantidad</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($listaP->getListaDetallePedido() as $listaDP): ?>
                          <tr>
                            <td><?php echo $listaDP->C_Almacen; ?></td>
                            <td><?php echo $listaDP->Cantidad; ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach;

        }
        else
        {
          include '../model/conexion.php';
          include '../model/pedido.php';
          include '../model/PedidoConsulta.php';
          include '../model/detallePedido.php';
          include '../model/DetallePedidoConsulta.php';
          include '../controller/ctrPedido.php';

          $conexion = new Conexion();

          $pedidoManage = new ManagePedido($conexion);
          $listaPedidos = $pedidoManage->listar();
          $i = 0;
          echo "<br /> <div class='text-center'><p style='color: orange'><strong>Seleccione Pedidos a Enviar</strong></p></div>";
          ?>
          <?php foreach ($listaPedidos as $listaP): $i++;?>
            <br>
            <div class="panel panel-primary">
              <div class="panel-heading" id="accordion">
                <input type="checkbox" class="despacho" name="despacho[]" value="<?php echo $listaP->IdPedido ?>">
                <?php if ($listaP->C_Plato): ?>
                  <span class="fa fa-shopping-bag"></span> </i><?php echo $listaP->CantidadPlato." platos de ".$listaP->C_Plato ?>
                <?php else: ?>
                  <span class="fa fa-shopping-bag"></span> </i>Productos Independientes
                <?php endif; ?>>
                <div class="btn-group pull-right">
                  <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#detalle<?php echo $listaP->IdPedido; ?>">
                    <span class="fa fa-chevron-down"></span>
                  </a>
                </div>
              </div>
              <div id="detalle<?php echo $listaP->IdPedido ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">

                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Producto</th>
                          <th>Cantidad</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($listaP->getListaDetallePedido() as $listaDP): ?>
                          <tr>
                            <td><?php echo $listaDP->C_Almacen; ?></td>
                            <td><?php echo $listaDP->Cantidad; ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach;
        }

        break;
///////////////////////////////////////////////////////////////////// CRUD DESPACHOS END

      case 'cerrarSesion':
        session_start();
        session_destroy();
        header("Location: ../index.php");
        break;

      case 'gUsuario':
        include 'headerAdmin.php';
        include 'bodyUser.php';
        include 'footerAdmin.php';
        break;

      case 'rUsuario':
        if (isset($_POST['datos']))
        {
          include '../model/conexion.php';
          include '../model/login.php';
          include '../model/SED.php';
          include '../model/UsuarioConsulta.php';
          include '../model/ConsultasBasicas.php';
          include '../controller/ctrLogin.php';

          $conexion = new Conexion();

          $usuario = new Login($_POST['nombre'], $_POST['contrasena']);
          $usuario->setTipoUser(2);
          $usuario->setEmail($_POST['email']);
          $usuario->setEstado(1);

          $usuarioManejador = new LoginManager();
          $usuarioManejador->crear($usuario, $conexion);
        }
        else
        {

        }
        break;

      case 'exRegU':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-check"></i>¡Exito!</strong> <p>Al guardar Usuario</p>
        </div>
        <?php
        include 'bodyUser.php';
        include 'footerAdmin.php';
        break;

      case 'errRegU':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-times-circle"></i>¡Error!</strong> <p>Al guardar Usuario</p>
        </div>
        <?php
        include 'bodyUser.php';
        include 'footerAdmin.php';
        break;

      case 'exisU':
        include 'headerAdmin.php';
        ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><i class="fa fa-exclamation-triangle"></i>¡Error!</strong> <p>Usuario Existente</p>
        </div>
        <?php
        include 'bodyUser.php';
        include 'footerAdmin.php';
        break;

      default:
        include 'headerAdmin.php';
        include 'bodyAdmin.php';
        include 'footerAdmin.php';
        exit;
        break;
    }
  }

}


?>
