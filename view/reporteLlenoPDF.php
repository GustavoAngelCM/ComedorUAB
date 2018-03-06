<?php

include '../model/conexion.php';

include '../model/Reportes.php';

$con = new Conexion();
$reporte = new Reportes($con);

$listaAlmacenFecha = $reporte->detalleAlmacenDeProducto($_GET['prod'],$_GET['fechaI'],$_GET['fechaF']);


  $nameCompletFile = "Detalle_Producto_".$_GET['prod'];
  ob_start();
  require_once("../view/dompdf/dompdf_config.inc.php");

  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <link href="../view/css/bootstrap.min.css" rel="stylesheet">
      <title></title>
    </head>
    <body>
      <div class="container">
        <div class="thumbnail">
          <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4">
              <center><img src="../view/multimedia/img/Logoadventista.jpg" alt="uab-logo" width="120" height="120" class="img img-responsive img-rounded"></center>
<?php
      $nombreProd="";
    foreach ($listaAlmacenFecha as $listaA):
            $nombreProd=$listaA['nombreProducto'];
      endforeach; ?>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">
              <div class="text-center">
                <h3>ALMACEN-COMEDOR</h3>
                <h2><strong>Detalle almacen de "<?php echo ucwords(strtolower($nombreProd)); ?>"</strong></h2>
                <h3>Fechas <?php echo $_GET['fechaI']." a ".$_GET['fechaF']; ?></h3>
              </div>
            </div>
          <br><br>

          <div class="row">
            <!-- <div class="col-xs-2 col-sm-2 col-md-2"></div>
            <div class="col-xs-8 col-sm-8 col-md-8"> -->
              <div class="row">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <!-- <thead> -->
                    <tr>
                      <th class="text-center"></th>
                      <th class="text-center">#</th>
                      <th class="text-center">Fecha Registro</th>
                      <th class="text-center">Nombre Producto</th>
                      <th class="text-center">Cantidad Ingresada</th>
                      <th class="text-center">Fecha Vencimiento</th>
                      <th class="text-center">Usuario que registro</th>

                    </tr>
                    <!-- </thead>
                    <tbody>
                      <tr>
                        <td></td>
                      </tr> -->
                      <?php
                      $i = 1;
                      $totalCantidad=0;
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
                    <tr>
                      <td class="text-center" colspan="6"><strong>Cantidad total: <?php echo $totalCantidad."  ".$listaA['abreviatura']; ?></strong></td>
                    </tr>

                    <!-- </tbody> -->
                  </table>
                </div>
              </div>
            <!-- </div>
            <div class="col-xs-2 col-sm-2 col-md-8"></div> -->
          </div>

        </div>
      </div>
      <script src="../view/js/bootstrap.min.js"></script>
    </body>
  </html>

  <?php

  $dompdf=new DOMPDF();
  $dompdf->load_html(ob_get_clean());
  ini_set("memory_limit","128M");
  $dompdf->render();
  $hoy = date("Y-m-d");
  $nameFile = "{$nameCompletFile}-{$hoy}";
  $dompdf->stream("$nameFile.pdf");

?>
