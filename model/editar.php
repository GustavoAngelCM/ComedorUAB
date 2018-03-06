<?php

class Editar
{

  public function editarCat($categoria, $conn)
  {
    $id = $categoria->IdCategoria;
    $name = $categoria->NombreCategoria;
    $error = 1;

    try {

      $conn->beginTransaction();

      $cat_update = 'UPDATE categoriaProducto SET nombreCategoria = :nombreCategoria WHERE idCatProducto = :idCatProducto';

      $stmtCat = $conn->prepare($cat_update);

      $stmtCat->bindParam(':idCatProducto', $id);
      $stmtCat->bindParam(':nombreCategoria', $name);

      $stmtCat->execute();

      $conn->commit();
      $error = 0;

    } catch (PDOException $e) {
      $error = 1;
      $conn->rollBack();
    }

    return $error;
  }

  public function editarMetrica($metrica, $conn)
  {
    try {

      $conn->beginTransaction();

      $query = 'UPDATE udiadmedida
                SET nombre = :nombreCategoria,
                  abreviatura = :abreviatura
                WHERE idUnidMedida = :id';

      $stmtMet = $conn->prepare($query);
      var_dump($metrica);
      $stmtMet->bindValue(':nombreCategoria', $metrica->NombreMetrica);
      $stmtMet->bindValue(':abreviatura', $metrica->Abreviatura);
      $stmtMet->bindValue(':id', $metrica->IdMetrica);

      $stmtMet->execute();

      $conn->commit();
      header('Location: menuAdmin.php?modo=exEditarM');

    } catch (PDOException $e) {
      $conn->rollBack();
      header('Location: menuAdmin.php?modo=errEditarM');
    }
  }

}

?>
