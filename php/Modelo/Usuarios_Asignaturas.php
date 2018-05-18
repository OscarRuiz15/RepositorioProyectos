<?php

class Usuarios_Asignaturas {

    private $Documento;
    private $Id_Asignaturas;
    private $year;
    private $Periodo;
    private $Grupo;

    public function Usuarios_Asignaturas0(){
        
    }
    
    public function Usuarios_Asignaturas($Documento, $Id_Asignaturas, $year, $Periodo, $Grupo) {
        $this->Documento = $Documento;
        $this->Id_Asignaturas = $Id_Asignaturas;
        $this->year = $year;
        $this->Periodo = $Periodo;
        $this->Grupo = $Grupo;
    }

    public function getDocumento() {
        return $this->Documento;
    }

    public function getId_Asignaturas() {
        return $this->Id_Asignaturas;
    }

    public function getYear() {
        return $this->year;
    }

    public function getPeriodo() {
        return $this->Periodo;
    }

    public function getGrupo() {
        return $this->Grupo;
    }

    public function setDocumento($Documento) {
        $this->Documento = $Documento;
    }

    public function setId_Asignaturas($Id_Asignaturas) {
        $this->Id_Asignaturas = $Id_Asignaturas;
    }

    public function setYear($Year) {
        $this->year = $Year;
    }

    public function setPeriodo($Periodo) {
        $this->Periodo = $Periodo;
    }

    public function setGrupo($Grupo) {
        $this->Grupo = $Grupo;
    }

}

?>
    