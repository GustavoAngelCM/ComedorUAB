<?php

class ctrFactura
{

  private $Conexion;

  function __construct($conexion)
  {
    $this->Conexion = $conexion;
  }
  public function registrarFactura($factura)
  {
    try {

        $this->Conexion->beginTransaction();

        $query = "INSERT INTO factura (idFactura,idDetalle,numFactura,valorIVA)
                  VALUES (:idFactura,:idDetalle,:numFactura,:valorIVA)";

        $insertFactura = $this->Conexion->prepare($query);

        $insertFactura->bindValue(':idFactura', $factura->IdFactura);
        $insertFactura->bindValue(':idDetalle', $factura->IdDetalle);
        $insertFactura->bindValue(':numFactura',$factura->NumFactura);
        $insertFactura->bindValue(':valorIVA', $factura->ValorIva);

        $insertFactura->execute();

        $this->Conexion->commit();

      } catch (PDOException $e) {

        $this->Conexion->rollBack();

        echo "Error al Registrar";

      }
  }



}

?>
