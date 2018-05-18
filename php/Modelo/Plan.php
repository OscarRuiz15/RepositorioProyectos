<?php

class Plan {

    private $Id_Planes;
    private $Nombre;

    public function Plan0(){
        
    }
    
    public function Plan($Id_Planes, $Nombre) {
        $this->Id_Planes = $Id_Planes;
        $this->Nombre = $Nombre;
    }

    public function getId_Planes() {
        return $this->Id_Planes;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function setId_Planes($Id_Planes) {
        $this->Id_Planes = $Id_Planes;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

}

?>