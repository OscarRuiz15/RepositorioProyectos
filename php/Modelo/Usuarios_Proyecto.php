<?php

class Usuarios_Proyecto {

    private $Documento;
    private $Id_Proyectos;
    private $Id_Asignatura;
    private $Ano;
    private $Periodo;
    private $Grupo;

    function __construct($Documento, $Id_Proyectos, $Id_Asignatura, $Ano, $Periodo, $Grupo) {
        $this->Documento = $Documento;
        $this->Id_Proyectos = $Id_Proyectos;
        $this->Id_Asignatura = $Id_Asignatura;
        $this->Ano = $Ano;
        $this->Periodo = $Periodo;
        $this->Grupo = $Grupo;
    }

       

    public function getDocumento() {
        return $this->Documento;
    }

    public function getId_Proyectos() {
        return $this->Id_Proyectos;
    }

   

    public function getAno() {
        return $this->Ano;
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

    public function setId_Proyectos($Id_Proyectos) {
        $this->Id_Proyectos = $Id_Proyectos;
    }

    function getId_Asignatura() {
        return $this->Id_Asignatura;
    }

    function setId_Asignatura($Id_Asignatura) {
        $this->Id_Asignatura = $Id_Asignatura;
    }

    
    public function setAno($Ano) {
        $this->Ano = $Ano;
    }

    public function setPeriodo($Periodo) {
        $this->Periodo = $Periodo;
    }

    public function setGrupo($Grupo) {
        $this->Grupo = $Grupo;
    }

}

?>
    