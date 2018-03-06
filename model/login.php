<?php

class Login
{
  private $IdUsuario;
  private $Usuario;
  private $Password;
  private $Estado;
  private $TipoUser;
  private $Email;

  public function __construct($user, $pass)
  {
    $this->IdUsuario = null;
    $this->Usuario = $user;
    $this->Password = SED::encryption($pass);
  }

  public function getIdUsuario() { return $this->IdUsuario; }
  public function getUsuario() { return $this->Usuario; }
  public function getPassword() { return $this->Password; }
  public function getEstado() { return $this->Estado; }
  public function getTipoUser() { return $this->TipoUser; }
  public function getEmail() { return $this->Email; }

  public function setIdUsuario($value) { $this->IdUsuario = $value; }
  public function setUsuario($user) { $this->Usuario = $user; }
  public function setPassword($pass) { $this->Password = $pass; }
  public function setEstado($estado) { $this->Estado = $estado; }
  public function setTipoUser($tipoUser) { $this->TipoUser = $tipoUser; }
  public function setEmail($email) { $this->Email = $email; }


}


?>
