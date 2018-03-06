<?php

class LoginManager
{
  private $ConsultasBas;

  public function __construct()
  {
    $this->ConsultasBas = new ConsultasBasicas();
  }

  public function Autentificacion($login)
  {
    $userDto = $login->getUsuario();
    $datos = $this->ConsultasBas->getUsuarioDB($userDto);
    if ($datos) {
      $login->setTipoUser($datos['idTipoUsuario']);
      $login->setEstado($datos['estado']);
      $login->setEmail($datos['email']);
      $login->setIdUsuario($datos['idUsuario']);
      if ($this->AccesPermited($datos['estado'])==true) {

        if ($login->getPassword()==$datos['contrasena']) {
          session_start();
          $ses = new UsuarioSesion($login);
          $ses->crearSesion();
          $this->TipoUsuario($datos['idTipoUsuario']);
        }else {
            header("Location: index.php?modo=ErrPass");
        }
      }else {
        header('Location: index.php?modo=AccesDenied');
      }
    }else {
      header('Location: index.php?modo=ErrUserInexitente');
    }

  }

  public function AccesPermited($estado)
  {
    if ($estado==1) {
      return true;
    }else {
      return false;
    }
  }

  public function TipoUsuario($tipo)
  {
    if ($tipo==1) {
      header("Location: view/menuAdmin.php");
    }else {
      if ($tipo==2) {
        header("Location: view/menuNutricionista.php");
      }else {
        if ($tipo==3) {

        }else {
          header('Location: index.php?modo=AccesDenied');
        }
      }
    }
  }

  public function listar($conexion)
  {
    $consulta = new UsuarioConsulta($conexion);
    $listaUsuarios = $consulta->listaUsuarios();
    $ArrayListaUsuarios = array();
    $i = 0;
    foreach ($listaUsuarios as $listaU)
    {
      $usuario = new Login($listaU['usuario'], $listaU['contrasena']);
      $usuario->setIdUsuario($listaU['idUsuario']);
      $usuario->setPassword($listaU['contrasena']);
      $usuario->setTipoUser($listaU['idTipoUsuario']);
      $usuario->setEmail($listaU['email']);
      $usuario->setEstado($listaU['estado']);
      $ArrayListaUsuarios[$i] = $usuario;
      $i++;
    }
    return $ArrayListaUsuarios;
  }

  public function crear($usuario, $conexion)
  {
    $consulta = new UsuarioConsulta($conexion);
    $existe = $consulta->existeUsuario($usuario->getUsuario());
    if ($existe == false)
    {
      try
      {

        $conexion->beginTransaction();

        $query = 'INSERT INTO usuarios (idUsuario, idTipoUsuario, usuario, contrasena, email, estado)
                      VALUES (:idUsuario, :idTipoUsuario, :usuario, :contrasena, :email, :estado)';

        $stmtUser = $conexion->prepare($query);

        $stmtUser->bindValue(':idUsuario', $usuario->getIdUsuario());
        $stmtUser->bindValue(':idTipoUsuario', $usuario->getTipoUser());
        $stmtUser->bindValue(':usuario', $usuario->getUsuario());
        $stmtUser->bindValue(':contrasena', $usuario->getPassword());
        $stmtUser->bindValue(':email', $usuario->getEmail());
        $stmtUser->bindValue(':estado', $usuario->getEstado());

        $stmtUser->execute();

        $conexion->commit();

        header("Location: menuAdmin.php?modo=exRegU");

      }
      catch (PDOException $e)
      {
        header("Location: menuAdmin.php?modo=errRegU");
        $conexion->rollBack();
      }
    }
    else
    {
      header("Location: menuAdmin.php?modo=exisU");
    }
  }

}

?>
