<?php

  class Plato
  {

    private $IdPlato;
    private $NombrePlato;
    private $Imagen;

    private $C_Categoria;

    function __construct()
    {
      $this->IdPlato = null;
    }

    public function __set($atributo, $value)
    {
      if (property_exists($this, $atributo)) {
        $this->$atributo = $value;
      }else {
        echo "Error al encontrar Atributo SET {$atributo} .";
      }
    }

    public function __get($atributo)
    {
      if (property_exists($this, $atributo)) {
        return $this->$atributo;
      }else {
        return "Error al encontrar Atributo GET {$atributo} .";
      }

    }

  }

?>
