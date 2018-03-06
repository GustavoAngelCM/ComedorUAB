<?php
/**
 *
 */
class DetalleAlmacen
{
        public $IdDetalle;
        public $IdAlmacen;
        public $CantidadIngresada;
        public $FechaVencimiento;
        public $PrecioTotal;
        public $FechaRegistro;
        public $IdUsuario;

        function __construct()
        {
          $this->IdDetalle =  null;
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
