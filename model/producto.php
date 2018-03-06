<?php
/**
 *
 */
class Producto
{

  private $IdProducto;
  private $NombreProducto;
  private $C_Metrica;
  private $C_Categoria;

  function __construct($name, $cat, $met)
  {
    $this->IdProducto = null;
    $this->NombreProducto = $name;
    $this->C_Metrica = $met;
    $this->C_Categoria = $cat;
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
