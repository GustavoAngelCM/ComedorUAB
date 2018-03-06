<?php

class UsuarioConsulta
{

  private $Conexion;

  function __construct($con)
  {
    $this->Conexion = $con;
  }

  public function listaUsuarios()
  {
    $query = "SELECT * FROM usuarios WHERE idTipoUsuario = 2";
    $consulta = $this->Conexion->prepare($query);
    $consulta->execute();
    $registro = $consulta->fetchAll();
    return $registro;
  }

  public function existeUsuario($usuario)
  {
    $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $consulta = $this->Conexion->prepare($query);
    $consulta->bindParam(':usuario', $usuario);
    $consulta->execute();
    $registro = $consulta->fetchAll();
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
