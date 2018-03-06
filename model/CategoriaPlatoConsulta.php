<?php

class CategoriaPlatoConsulta
{

  private $Conexion;

  function __construct($con)
  {
    $this->Conexion = $con;
  }

  public function existeCategoriaPlato($nombre)
  {
    $query = "SELECT
                *
              FROM
                categoriaplato
              WHERE
                nombre = :nombre";
    $consulta = $this->Conexion->prepare($query);
    $consulta->bindParam(':nombre', $nombre);
    $consulta->execute();
    $registro = $consulta->fetch();
    if ($registro)
    {
      return true;
    }
    else
    {
      return false;
    }

  }

}

?>
