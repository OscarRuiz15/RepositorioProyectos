<?php

class Asignaturas_Plan{
    private $Id_Asignaturas;
    private $Id_Planes;
    
    public function Asignaturas_Plan0(){
        
    }
    
    public function Asignaturas_Plan($Id_Asignaturas, $Id_Planes) {
        $this->Id_Asignaturas = $Id_Asignaturas;
        $this->Id_Planes = $Id_Planes;
    }

    public function getId_Asignaturas() {
        return $this->Id_Asignaturas;
    }

    public function getId_Planes() {
        return $this->Id_Planes;
    }

    public function setId_Asignaturas($Id_Asignaturas) {
        $this->Id_Asignaturas = $Id_Asignaturas;
    }

    public function setId_Planes($Id_Planes) {
        $this->Id_Planes = $Id_Planes;
    }


}

?>