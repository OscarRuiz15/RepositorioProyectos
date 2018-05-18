<?php
include_once '/../Modelo/Eventos.php';
include_once 'Conexion.php'; 
/**
* 
*/
class EventosBD 
{
	
	public function InsertarEvento($Evento){
		
		$conexion=new Conexion();
		$sql= "insert into eventos (Id_Evento,Id_Proyecto,Documento,Nombre,Descripcion,Fecha_Hora_Creacion) "
                                  . "values(:Id_Evento,:Id_Proyecto,:Documento,:Nombre,:Descripcion,:Fecha)";
		$statement =$conexion->prepare($sql);
		
                $statement->bindParam(':Id_Evento',$Evento->getId_Eventos());
                $statement->bindParam(':Id_Proyecto',$Evento->getId_Proyectos());
                $statement->bindParam(':Documento',$Evento->getId_Usuarios());
                
                $statement->bindParam(':Nombre',$Evento->getNombre());
                $statement->bindParam(':Descripcion',$Evento->getDescripcion());
                $statement->bindParam(':Fecha',$Evento->getFecha_Hora_Creacion());
                
               $mensaje="";
                if (!$statement) {
                    $mensaje="Error creando relacion";
                }  else {
                    $statement->execute();
                    $mensaje="Usuario creado exitosamente";
                }
                return $mensaje;
                    

	}
        public function consultarEventos() {
            $listaevento=array();
            $conexion=new Conexion();
            $sql= "select * from eventos ";
            $statement= $conexion->prepare($sql);
           
            $statement->execute();
            
           
            
            $result =$statement->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                $id= $result[$i]['Id_Evento'];
                $id_proyecto=$result[$i]['Id_Proyecto'];
                $documento = $result[$i]['Documento'];
                $nombre=$result[$i]['Nombre'];
                $descripcion=$result[$i]['Descripcion'];
                $fecha=$result[$i]['Fecha_Hora_Creacion'];
                $evento=new Eventos($id, $id_proyecto, $documento, $nombre, $descripcion, $fecha);
                array_push($listaevento, $evento);
            }
            
            
            return $listaevento;
	
        }
        
        public function consultarEventosIdProyecto($id_proyecto){
            $listaevento=array();
            $conexion=new Conexion();
            $sql= "select * from eventos where Id_Proyecto=:id";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id_proyecto);
            $statement->execute();
            
           
            
            $result =$statement->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                $id= $result[$i]['Id_Evento'];
                $documento = $result[$i]['Documento'];
                $nombre=$result[$i]['Nombre'];
                $descripcion=$result[$i]['Descripcion'];
                $fecha=$result[$i]['Fecha_Hora_Creacion'];
                $evento=new Eventos($id, $id_proyecto, $documento, $nombre, $descripcion, $fecha);
                array_push($listaevento, $evento);
            }
            
            
            return $listaevento;
        }
        public function consultarEventosId($id){
            $evento=null;
            $conexion=new Conexion();
            $sql= "select * from eventos where Id_Evento=:id";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id);
            $statement->execute();
            
           
            
            while ($result =$statement->fetchAll()){
                $id_proyecto= $result[0]['Id_Proyectos'];
                $documento = $result[0]['Documento'];
                $nombre=$result[0]['Nombre'];
                $descripcion=$result[0]['Descripcion'];
                $fecha=$result[0]['Fecha_Hora_Creacion'];
                $evento=new Eventos($id, $id_proyecto, $documento, $nombre, $descripcion, $fecha);
                break;
            }
            
            
            return $evento;
        }

}

?>

