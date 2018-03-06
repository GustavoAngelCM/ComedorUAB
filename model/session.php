<?php

class UsuarioSesion
{
  private $Login;

  function __construct($login)
  {
      $this->Login = $login;
  }

  public function crearSesion()
  {
    $_SESSION['idUsuario'] = $this->Login->getIdUsuario();
    $_SESSION['user'] = $this->Login->getUsuario();
    $_SESSION['password'] = $this->Login->getPassword();
    $_SESSION['estado'] = $this->Login->getEstado();
    $_SESSION['tipo'] = $this->Login->getTipoUser();
    $_SESSION['email'] = $this->Login->getEmail();
  }

}

?>
