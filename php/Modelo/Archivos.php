<?php

class Archivos {

    private $id;
    private $evento;
    private $fecha;
    private $archivo;
    private $nombre;
    private $tamano;
     
      
    
    
    public function __construct($id, $evento, $fecha, $archivo, $nombre, $tamano) {
        $this->id = $id;
        $this->evento = $evento;
        $this->fecha = $fecha;
        $this->archivo = $archivo;
        $this->nombre = $nombre;
        $this->tamano = $tamano;
    }
    function getArchivo() {
        return $this->archivo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTamano() {
        return $this->tamano;
    }

    function setArchivo($archivo) {
        $this->archivo = $archivo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTamano($tamano) {
        $this->tamano = $tamano;
    }

    function getId() {
        return $this->id;
    }

    function getEvento() {
        return $this->evento;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEvento($evento) {
        $this->evento = $evento;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }


}
/*$p = new Archivos();
$p->setNombre_Archivo("oli");
echo $p->getNombre;*/

?>