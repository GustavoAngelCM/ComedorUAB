<?php

class CategoriaPlatoControlador
{

  private $Conexion;

  function __construct($con)
  {
    $this->Conexion = $con;
  }

  public function crear($categoriaplato)
  {
    $consulta = new CategoriaPlatoConsulta($this->Conexion);
    $existe = $consulta->existeCategoriaPlato($categoriaplato->NombreCategoriaPlato);4
    if ($existe == false)
    {
      try
      {
        $this->Conexion->beginTransaction();

        $query = "INSERT INTO categoriaplato (idCategoria, nombre)
                  VALUES (:idCategoria, :nombre)";

        $stmtCat = $this->Conexion->prepare($query);
        $stmtCat->bindValue('idCategoria', $categoriaplato->IdCategoriaPlato);
        $stmtCat->bindValue('nombre', $categoriaplato->NombreCategoriaPlato);

        $this->Conexion->commit();
      }
      catch (PDOException $e)
      {
        $this->Conexion->rollBack();
      }

    }
  }

}

?>
