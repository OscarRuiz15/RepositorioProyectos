<?php
require_once '/../modelo/Archivos.php';
require_once 'Conexion.php'; 
/**
* 
*/
class ArchivosBD 
{
	
	public function InsertarArchivo($Archivo){
		$conexion=new Conexion();
		$sql= "insert into archivos (Id_Archivo,Id_Evento,Fecha_Hora,Archivo,Nombre_Archivo,Tamano_Archivo) values(:Id_Archivo,:Id_Evento,:fecha,:archivo,:nombre,:tamano)";
		$statement =$conexion->prepare($sql);
		$statement->bindParam(':Id_Archivo',$Archivo->getId());
        $statement->bindParam(':Id_Evento',$Archivo->getEvento());
        $statement->bindParam(':fecha',$Archivo->getFecha());
                
        $statement->bindParam(':archivo',$Archivo->getArchivo());
        $statement->bindParam(':nombre',$Archivo->getNombre());
        $statement->bindParam(':tamano',$Archivo->getTamano());
                
        $mensaje="";
        if (!$statement) {
            $mensaje="Error creando relacion";
        }  else {
            $statement->execute();
            $mensaje="Usuario creado exitosamente";
        }
        return $mensaje;
                    

	}
        public function consultarArchivos() {
            $listaarchivos=null;
            $modelo=new Conexion();
	    $conexion=$modelo->get_conexion();
            $sql= "select * from archivos";
            $statement= $conexion->prepare($sql);
            $statement->execute();
            if ($result =$statement->fetch()){
                $listaarchivos[]=$result;
            }
            return $listaarchivos;
	
        }
        
        public function consultarArchivosId($id){
            $archivo=null;
            $modelo=new Conexion();
	    $conexion=$modelo->get_conexion();
            $sql= "select * from archivos where Id_archivo=:id";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id);
            $statement->execute();
            while ($result =$statement->fetch()){
                $archivo[]=$result;
            }
            return $archivo;
        }

        public function consultarArchivosEvento($id_evento){
            $archivo=array();
            $conexion=new Conexion();
            $sql= "select * from archivos where Id_Evento=:Id_Evento";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":Id_Evento",$id_evento);
            $statement->execute();
            $result =$statement->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                $Id_Archivo=$result[$i]['Id_Archivo'];
                $Id_Evento=$result[$i]['Id_Evento'];
                $Fecha_Hora=$result[$i]['Fecha_Hora'];
                $Archivo=$result[$i]['Archivo'];
                $Nombre_Archivo=$result[$i]['Nombre_Archivo'];
                $Tamano_Archivo=$result[$i]['Tamano_Archivo'];
                $arch=new Archivos($Id_Archivo, $Id_Evento, $Fecha_Hora, $Archivo, $Nombre_Archivo, $Tamano_Archivo);
                array_push($archivo, $arch);
            }

            return $archivo;
        }

}

?>