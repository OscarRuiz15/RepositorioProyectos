<?php
require_once '/../modelo/Usuarios_Proyecto.php';
require_once 'Conexion.php'; 
/**
* 
*/
class UsuariosProyectoBD 
{
	
	public function InsertarUsuarioProyecto($usuproyecto){
		
		$conexion=new Conexion();
		$sql= "insert into usuarios_proyecto_asignaturas (Documento,Id_Proyecto,Id_Asignatura,Ano,Periodo,Grupo) "
                        . "values(:Documento,:Id_Proyecto,:Id_Asignatura,:Year,:Periodo,:Grupo)";
		$statement =$conexion->prepare($sql);
		$statement->bindParam(':Documento',$usuproyecto->getDocumento());
                $statement->bindParam(':Id_Proyecto',$usuproyecto->getId_Proyectos());
                $statement->bindParam(':Id_Asignatura',$usuproyecto->getId_Asignatura());
                $statement->bindParam(':Year',$usuproyecto->getAno());
                
                $statement->bindParam(':Periodo',$usuproyecto->getPeriodo());
                $statement->bindParam(':Grupo',$usuproyecto->getGrupo());
                
                
                $mensaje="";
                if (!$statement) {
                    $mensaje="Error creando relacion";
                }  else {
                    $statement->execute();
                    $mensaje="Usuario creado exitosamente";
                }
                return $mensaje;
                    

	}
        public function consultarUsuariosAsignaturas() {
            $usupro=array();
            
	    $conexion=new Conexion();
            $sql= "select * from Usuarios_Proyecto";
            $statement= $conexion->prepare($sql);
            $statement->execute();
            $result =$statement->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                
            
                $id=$result[$i]['Id_Plan'];
                $nombre=$result[$i]['Nombre'];
                

                $plan=new Plan($id, $nombre);
              
                array_push($usupro, $plan);
                
            }
            //echo count($listaasplan);
           
            return $usupro;
	
        }
        
        public function consultarProyectosId($id,$asi,$year,$grupo,$periodo){
            $usupro=array();
            
	    $conexion=new Conexion();
            $sql= "select * from Usuarios_Proyecto_Asignaturas where Documento=:Documento and "
                    . "Id_Asignatura=:id_asi and Ano=:year and Grupo=:grupo and Periodo=:periodo";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":Documento",$id);
            $statement-> bindParam(":id_asi",$asi);
            $statement-> bindParam(":year",$year);
            $statement-> bindParam(":grupo",$grupo);
            $statement-> bindParam(":periodo",$periodo);
            $statement->execute();
            
            $result =$statement->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
               
                $idP= $result[$i]['Id_Proyecto'];
                $usuariopro =new Usuarios_Proyecto($id, $idP, $asi, $year, $periodo, $grupo);
                array_push($usupro, $usuariopro);
             
               
            }
            
                      
            return $usupro;
        }

}

?>



