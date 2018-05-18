<?php

class Tipo_Usuario {

    private $Id_Tipo;
    private $Descripcion;

    public function Tipo_Usuario0(){
        
    }
    
    public function Tipo_Usuario($Id_Tipo, $Descripcion) {
        $this->Id_Tipo = $Id_Tipo;
        $this->Descripcion = $Descripcion;
    }

    public function getId_Tipo() {
        return $this->Id_Tipo;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function setId_Tipo($Id_Tipo) {
        $this->Id_Tipo = $Id_Tipo;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

}

?>
  