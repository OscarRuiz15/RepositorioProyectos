<?php

class Asignaturas {

    private $Id_Asignaturas;
    private $Nombre;
    



    

    
    function __construct($Id_Asignaturas, $Nombre) {
        $this->Id_Asignaturas = $Id_Asignaturas;
        $this->Nombre = $Nombre;
        
    }

    
    
        public function getId_Asignaturas() {
        return $this->Id_Asignaturas;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function setId_Asignaturas($Id_Asignaturas) {
        $this->Id_Asignaturas = $Id_Asignaturas;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

}

?>