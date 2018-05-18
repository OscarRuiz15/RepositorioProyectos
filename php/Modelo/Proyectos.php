<?php

class Proyectos {

    private $Id_Proyectos;
    private $Nombre;
    private $Fecha_Creacion;
    private $Descripcion;
    private $Activo;

    public function Proyectos0(){
        
    }
    
    public function Proyectos($Id_Proyectos, $Nombre, $Fecha_Creacion, $Descripcion, $Activo) {
        $this->Id_Proyectos = $Id_Proyectos;
        $this->Nombre = $Nombre;
        $this->Fecha_Creacion = $Fecha_Creacion;
        $this->Descripcion = $Descripcion;
        $this->Activo = $Activo;
    }

    public function getId_Proyectos() {
        return $this->Id_Proyectos;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getFecha_Creacion() {
        return $this->Fecha_Creacion;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function getActivo() {
        return $this->Activo;
    }

    public function setId_Proyectos($Id_Proyectos) {
        $this->Id_Proyectos = $Id_Proyectos;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function setFecha_Creacion($Fecha_Creacion) {
        $this->Fecha_Creacion = $Fecha_Creacion;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    public function setActivo($Activo) {
        $this->Activo = $Activo;
    }

}

?>
    