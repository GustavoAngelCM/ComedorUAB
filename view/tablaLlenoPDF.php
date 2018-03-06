    <?php

      $nameCompletFile = "Detalle_Almacen";
      ob_start();
      require_once("../view/dompdf/dompdf_config.inc.php");

      include '../model/conexion.php';
      include '../model/ConsultasAlmacen.php';
      $con = new Conexion();
      $manageAlmacen = new ConsultasAlmacen($con);
      $listaAlmacen = $manageAlmacen->detalleAlmacen();

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
                  <!-- <div class="text-center">
                    <h5>UNIVERSIDAD</h5>
                    <h3>ADVENTISTA</h3>
                    <h5>DE BOLIVIA</h5>
                  </div> -->
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                  <div class="text-center">
                    <h3>ALMACEN-COMEDOR</h3>
                    <h2><strong>DETALLE ALMACEN DE FECHA <?php $fecha=date( "d-m-Y"); echo $fecha; ?></strong></h2>
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

                            <th class="text-center">Producto</th>
                            <th class="text-center">Cantidad Total</th>
                            <th class="text-center">Unidad de Medida</th>
                          </tr>
                        <!-- </thead>
                        <tbody>
                          <tr>
                            <td></td>
                          </tr> -->
                        <?php
                          $i = 1;
                                foreach ($listaAlmacen as $listaA): ?>
                            <tr>
                              <td class="text-center"><?php echo $i++; ?></td>
                              <td class="text-center"><?php echo ucwords(strtolower($listaA['nombreProducto'])); ?></td>
                              <td class="text-center"><?php echo $listaA['cantidad']; ?></td>
                              <td class="text-center"><?php echo $listaA['nombre']; ?></td>
                            </tr>
                          <?php endforeach; ?>
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
