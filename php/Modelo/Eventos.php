<?php

class Eventos {

    private $Id_Eventos;
    private $Id_Proyectos;
    private $Id_Usuarios;
    private $Nombre;
    private $Descripcion;
    private $Fecha_Hora_Creacion;
   

    public function Eventos0(){
        
    }
    
    public function Eventos($Id_Eventos, $Id_Proyectos, $Id_Usuarios, $Nombre, $Descripcion, $Fecha_Hora_Creacion) {
        $this->Id_Eventos = $Id_Eventos;
        $this->Id_Proyectos = $Id_Proyectos;
        $this->Id_Usuarios = $Id_Usuarios;
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Fecha_Hora_Creacion = $Fecha_Hora_Creacion;
        
    }
    
    
    
    public function getId_Eventos() {
        return $this->Id_Eventos;
    }

    public function getId_Proyectos() {
        return $this->Id_Proyectos;
    }

    public function getId_Usuarios() {
        return $this->Id_Usuarios;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function getFecha_Hora_Creacion() {
        return $this->Fecha_Hora_Creacion;
    }

    

    public function setId_Eventos($Id_Eventos) {
        $this->Id_Eventos = $Id_Eventos;
    }

    public function setId_Proyectos($Id_Proyectos) {
        $this->Id_Proyectos = $Id_Proyectos;
    }

    public function setId_Usuarios($Id_Usuarios) {
        $this->Id_Usuarios = $Id_Usuarios;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    public function setFecha_Hora_Creacion($Fecha_Hora_Creacion) {
        $this->Fecha_Hora_Creacion = $Fecha_Hora_Creacion;
    }

    
}

?>