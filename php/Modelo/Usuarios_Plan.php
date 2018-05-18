<?php

class Usuarios_Plan {

    private $Documento;
    private $Id_Planes;

    public function Usuarios_Plan0(){
        
    }
    
    public function Usuarios_Plan($Documento, $Id_Planes) {
        $this->Documento = $Documento;
        $this->Id_Planes = $Id_Planes;
    }

    public function getDocumento() {
        return $this->Documento;
    }

    public function getId_Planes() {
        return $this->Id_Planes;
    }

    public function setDocumento($Documento) {
        $this->Documento = $Documento;
    }

    public function setId_Planes($Id_Planes) {
        $this->Id_Planes = $Id_Planes;
    }

}

?>