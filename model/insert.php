<?php

class Insert
{

  public function insertarCategoria($cat, $conn)
  {
    $id = $cat->IdCategoria;
    $name = $cat->NombreCategoria;

    try {

      $conn->beginTransaction();

      $cat_insert = 'INSERT INTO categoriaProducto (idCatProducto, nombreCategoria)
                    VALUES (:idCatProducto, :nombreCategoria)';

      $stmtCat = $conn->prepare($cat_insert);

      $stmtCat->bindParam(':idCatProducto', $id);
      $stmtCat->bindParam(':nombreCategoria', $name);

      $stmtCat->execute();

      $conn->commit();

    } catch (PDOException $e) {
      header("Location: menuAdmin.php?modo=eRegCat");
      $conn->rollBack();
    }

  }

  public function insertarMetrica($metrica, $conn)
  {
    $id = $metrica->IdMetrica;
    $name = $metrica->NombreMetrica;
    $abrev = $metrica->Abreviatura;
    $error = 1;
    try {

      $conn->beginTransaction();

      $met_insert = 'INSERT INTO udiadmedida (idUnidMedida, nombre, abreviatura)
                    VALUES (:idUnidMedida, :nombre, :abreviatura);';

      $stmtMet = $conn->prepare($met_insert);

      $stmtMet->bindParam(':idUnidMedida', $id);
      $stmtMet->bindParam(':nombre', $name);
      $stmtMet->bindParam(':abreviatura', $abrev);

      $stmtMet->execute();

      $conn->commit();
      $error = 0;
    } catch (PDOException $e) {
      $error = 1;
      $conn->rollBack();
    }
    return $error;
  }

  public function insertarProducto($producto, $conn)
  {
    $id = $producto->IdProducto;
    $name = $producto->NombreProducto;
    $idCat = $producto->C_Categoria->IdCategoria;
    $idMet = $producto->C_Metrica->IdMetrica;
    $error = 1;
    try {

      $conn->beginTransaction();

      $prod_insert = 'INSERT INTO producto (idProducto, nombreProducto, idUnidMedida, idCatProducto)
                    VALUES (:idProducto, :nombreProducto, :idUnidMedida, :idCatProducto);';

      $stmtProd = $conn->prepare($prod_insert);

      $stmtProd->bindParam(':idProducto', $id);
      $stmtProd->bindParam(':nombreProducto', $name);
      $stmtProd->bindParam(':idUnidMedida', $idMet);
      $stmtProd->bindParam(':idCatProducto', $idCat);

      $stmtProd->execute();

      $conn->commit();
      $error = 0;
    } catch (PDOException $e) {
      $error = 1;
      $conn->rollBack();
    }
    return $error;
  }

}

?>
