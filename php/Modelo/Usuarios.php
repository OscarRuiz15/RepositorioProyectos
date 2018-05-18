<?php

class Usuarios {

    private $Documento;
    private $Id_Tipo;
    private $Nombres;
    private $Apellidos;
    private $Correo;
    private $Codigo;
    private $Contrasena;
    private $Activo;
    private $foto;
    
    function getFoto() {
        return $this->foto;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    
    function __construct($Documento, $Id_Tipo, $Nombres, $Apellidos, $Correo, $Codigo, $Contrasena, $Activo, $foto) {
        $this->Documento = $Documento;
        $this->Id_Tipo = $Id_Tipo;
        $this->Nombres = $Nombres;
        $this->Apellidos = $Apellidos;
        $this->Correo = $Correo;
        $this->Codigo = $Codigo;
        $this->Contrasena = $Contrasena;
        $this->Activo = $Activo;
        $this->foto = $foto;
    }

        public function getDocumento() {
        return $this->Documento;
    }

    public function getId_Tipo() {
        return $this->Id_Tipo;
    }

    public function getNombres() {
        return $this->Nombres;
    }

    public function getApellidos() {
        return $this->Apellidos;
    }

    public function getCorreo() {
        return $this->Correo;
    }

    public function getCodigo() {
        return $this->Codigo;
    }

    public function getContrasena() {
        return $this->Contrasena;
    }

    public function getActivo() {
        return $this->Activo;
    }

    public function setDocumento($Documento) {
        $this->Documento = $Documento;
    }

    public function setId_Tipo($Id_Tipo) {
        $this->Id_Tipo = $Id_Tipo;
    }

    public function setNombres($Nombres) {
        $this->Nombres = $Nombres;
    }

    public function setApellidos($Apellidos) {
        $this->Apellidos = $Apellidos;
    }

    public function setCorreo($Correo) {
        $this->Correo = $Correo;
    }

    public function setCodigo($Codigo) {
        $this->Codigo = $Codigo;
    }

    public function setContrasena($Contrasena) {
        $this->Contrasena = $Contrasena;
    }

    public function setActivo($Activo) {
        $this->Activo = $Activo;
    }

}

?>