<?php
require_once '/../modelo/Usuarios.php';
require_once 'Conexion.php'; 
/**
* 
*/
class UsuariosBD 
{
	
	public function InsertarUsuario($Usuario){
		
		$conexion=new Conexion();
                
		$sql= "insert into usuarios (Documento,Id_Tipo,Nombres,Apellidos,Correo,Codigo,Contrasena,Activo,Foto) "
                        . "values(:Documento,:Id_Tipo,:Nombres,:Apellidos,:Correo,:Codigo,:Contrasena,:Activo,:Foto)";
		$statement =$conexion->prepare($sql);
		$statement->bindParam(':Documento',$Usuario->getDocumento());
                
                $statement->bindParam(':Id_Tipo',$Usuario->getId_Tipo());
                $statement->bindParam(':Nombres',$Usuario->getNombres());
                
                $statement->bindParam(':Apellidos',$Usuario->getApellidos());
                $statement->bindParam(':Correo',$Usuario->getCorreo());
                $statement->bindParam(':Codigo',$Usuario->getCodigo());
                $statement->bindParam(':Contrasena',$Usuario->getContrasena());
                $statement->bindParam(':Activo',$Usuario->getActivo());
                $statement->bindParam(':Foto',$Usuario->getFoto());
               $mensaje="";
                if (!$statement) {
                    $mensaje="Error creando relacion";
                }  else {
                    $statement->execute();
                    $mensaje="Usuario creado exitosamente";
                }
                return $mensaje;
                
                    

	}
        public function ModificarUsuario($Usuario){
		
		$conexion=new Conexion();
                
		$sql= "UPDATE usuarios SET Nombres=:nombre , Apellidos=:apellidos , Correo=:correo , Activo=:activo , "
                        . "Contrasena=:contrasena , Foto=:Foto WHERE Documento=:Documento";
		$statement =$conexion->prepare($sql);
		$statement->bindParam(':Documento',$Usuario->getDocumento());                
                $statement->bindParam(':nombre',$Usuario->getNombres());                
                $statement->bindParam(':apellidos',$Usuario->getApellidos());
                $statement->bindParam(':correo',$Usuario->getCorreo());
                
                $statement->bindParam(':contrasena',$Usuario->getContrasena());
                $statement->bindParam(':activo',$Usuario->getActivo());
                $statement->bindParam(':Foto',$Usuario->getFoto());               
                $mensaje="";
                if (!$statement) {
                    $mensaje="Error creando relacion";
                }  else {
                    $statement->execute();
                    $mensaje="Usuario creado exitosamente";
                }
                return $mensaje;
                
                    

	}
        
        
        public function consultarUsuario($id){
            $usuario=null;
            
	    $conexion=new Conexion();
            $sql= "select * from usuarios where Documento=:id";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id);
            $statement->execute();
            
            while ($result =$statement->fetchAll()){
                $documento= $result[0]['Documento'];
                $tipo = $result[0]['Id_Tipo'];
                $nombre= $result[0]['Nombres'];
                $apellido= $result[0]['Apellidos'];
                $correo= $result[0]['Correo'];
                $codigo=$result[0]['Codigo'];
                $pass= $result[0]['Contrasena'];
                $activo= $result[0]['Activo'];
                $foto= $result[0]['Foto'];
                $usuario=new Usuarios($documento, $tipo, $nombre, $apellido, $correo, $codigo, $pass, $activo,$foto);
                break;
            }
            return $usuario;
            
        }
        public function consultarUsuarioEmail($correo){
            $usuario=null;
            
	    $conexion=new Conexion();
            $sql= "select * from usuarios where Correo=:Correo";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":Correo",$correo);
            $statement->execute();
            while ($result =$statement->fetchAll()){
                $documento= $result[0]['Documento'];
                $tipo = $result[0]['Id_Tipo'];
                $nombre= $result[0]['Nombres'];
                $apellido= $result[0]['Apellidos'];
                $correo= $result[0]['Correo'];
                $codigo=$result[0]['Codigo'];
                $pass= $result[0]['Contrasena'];
                $activo= $result[0]['Activo'];
                $foto= $result[0]['Foto'];
                $usuario=new Usuarios($documento, $tipo, $nombre, $apellido, $correo, $codigo, $pass, $activo,$foto);
                break;
            }
            return $usuario;
            
        }
        
        
        
        public function consultarUsuarioLog($id,$password){
            $usuario=null;            
	    $conexion=new Conexion();
            $sql= "select * from usuarios where Documento=:id and Contrasena=:password";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id);
            $statement-> bindParam(":password",$password);
            $statement->execute();
            
            while ($result =$statement->fetchAll()){
                $tipo = $result[0]['Id_Tipo'];
                $nombre= $result[0]['Nombres'];
                $apellido= $result[0]['Apellidos'];
                $correo= $result[0]['Correo'];
                $codigo=$result[0]['Codigo'];
                $activo= $result[0]['Activo'];
                $foto= $result[0]['Foto'];
                $usuario=new Usuarios($id, $tipo, $nombre, $apellido, $correo, $codigo, $password, $activo,$foto);
                break;
            }
            return $usuario;            
        }
        
        
            public function consultarEstudiantes($id_asignatura,$year,$periodo,$grupo){
            $usuario=array();            
            $conexion=new Conexion();
            $sql= "select * from usuarios where documento not in (select documento from usuarios_asignaturas where Id_Asignatura=:Id_Asignatura and Ano=:Year and Periodo=:Periodo and Grupo=:Grupo) and Id_Tipo=3";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":Id_Asignatura",$id_asignatura);
            $statement-> bindParam(":Year",$year);
            $statement-> bindParam(":Periodo",$periodo);
            $statement-> bindParam(":Grupo",$grupo);
            
            $statement->execute();
            $result =$statement->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                $documento= $result[$i]['Documento'];$tipo = $result[$i]['Id_Tipo'];
                $nombre= $result[$i]['Nombres'];$apellido= $result[$i]['Apellidos'];
                $correo= $result[$i]['Correo'];
                $codigo=$result[$i]['Codigo'];
                $pass= $result[$i]['Contrasena'];
                $activo= $result[$i]['Activo'];
                $foto= $result[$i]['Foto'];
                $estudiante=new Usuarios($documento, $tipo, $nombre, $apellido, $correo, $codigo, $pass, $activo,$foto);
                array_push($usuario, $estudiante);
            }
            return $usuario;            
        }
            
        
          public function consultarIntegrantes($id_proyecto){
            $usuario=array();            
	    $conexion=new Conexion();
            $sql= "select * from usuarios where documento in (select documento from usuarios_proyecto_asignaturas where Id_Proyecto=:Id_Proyecto) and Id_Tipo=3";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":Id_Proyecto",$id_proyecto);
            
            $statement->execute();
            $result =$statement->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                $documento= $result[$i]['Documento'];$tipo = $result[$i]['Id_Tipo'];
                $nombre= $result[$i]['Nombres'];$apellido= $result[$i]['Apellidos'];
                $correo= $result[$i]['Correo'];
                $codigo=$result[$i]['Codigo'];
                $pass= $result[$i]['Contrasena'];
                $activo= $result[$i]['Activo'];
                $foto= $result[$i]['Foto'];
                $estudiante=new Usuarios($documento, $tipo, $nombre, $apellido, $correo, $codigo, $pass, $activo,$foto);
                array_push($usuario, $estudiante);
            }
            return $usuario;            
        }

        public function consultarEstudiantesAsignatura($id_asignatura,$year,$periodo,$grupo){
            $usuario=array();            
            $conexion=new Conexion();
            $sql= "select * from usuarios where documento in (select documento from usuarios_asignaturas where Id_Asignatura=:Id_Asignatura and Ano=:Year and Periodo=:Periodo and Grupo=:Grupo) and Id_Tipo=3";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":Id_Asignatura",$id_asignatura);
            $statement-> bindParam(":Year",$year);
            $statement-> bindParam(":Periodo",$periodo);
            $statement-> bindParam(":Grupo",$grupo);
            
            $statement->execute();
            $result =$statement->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                $documento= $result[$i]['Documento'];$tipo = $result[$i]['Id_Tipo'];
                $nombre= $result[$i]['Nombres'];$apellido= $result[$i]['Apellidos'];
                $correo= $result[$i]['Correo'];
                $codigo=$result[$i]['Codigo'];
                $pass= $result[$i]['Contrasena'];
                $activo= $result[$i]['Activo'];
                $foto= $result[$i]['Foto'];
                $estudiante=new Usuarios($documento, $tipo, $nombre, $apellido, $correo, $codigo, $pass, $activo,$foto);
                array_push($usuario, $estudiante);
            }
            return $usuario;            
        }

        public function consultarUsuarioCodigo($id){
            $usuario=null;
            
        $conexion=new Conexion();
            $sql= "select * from usuarios where Codigo=:id";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id);
            $statement->execute();
            
            while ($result =$statement->fetchAll()){
                $documento= $result[0]['Documento'];
                $tipo = $result[0]['Id_Tipo'];
                $nombre= $result[0]['Nombres'];
                $apellido= $result[0]['Apellidos'];
                $correo= $result[0]['Correo'];
                $codigo=$result[0]['Codigo'];
                $pass= $result[0]['Contrasena'];
                $activo= $result[0]['Activo'];
                $foto= $result[0]['Foto'];
                $usuario=new Usuarios($documento, $tipo, $nombre, $apellido, $correo, $codigo, $pass, $activo,$foto);
                break;
            }
            return $usuario;
            
        }

        public function consultarEstudiantesLike($parametro,$id_asignatura,$year,$periodo,$grupo){
            $listaestudiantes = array();
            $estudiante=null;
            $conexion=new Conexion();
            //$sql = "select * from asignaturas where Nombre like :argumento";
            $params = array(':argumento' => "'".$parametro.'%'."'");

            $sql= "select * from usuarios where documento not in (select documento from usuarios_asignaturas where Id_Asignatura=:Id_Asignatura and Ano=:Year and Periodo=:Periodo and Grupo=:Grupo) and Id_Tipo=3 and Nombres like "."'".$parametro.'%'."' or Apellidos like "."'".$parametro.'%'."'";
            $stmt = $conexion->prepare($sql);
            $stmt-> bindParam(":Id_Asignatura",$id_asignatura);
            $stmt-> bindParam(":Year",$year);
            $stmt-> bindParam(":Periodo",$periodo);
            $stmt-> bindParam(":Grupo",$grupo);
            $stmt->execute();
            $result =$stmt->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                
                $documento= $result[$i]['Documento'];
                $id_tipo=$result[$i]['Id_Tipo'];
                $nombres=$result[$i]['Nombres'];
                $apellidos=$result[$i]['Apellidos'];
                $correo=$result[$i]['Correo'];
                $codigo=$result[$i]['Codigo'];
                $contrasena=$result[$i]['Codigo'];
                $activo=$result[$i]['Activo'];
                $foto=$result[$i]['Foto'];

                
                $estudiante=new Usuarios($documento, $id_tipo, $nombres, $apellidos, $correo, $codigo, $contrasena, $activo, $foto);
                array_push($listaestudiantes, $estudiante);
            }
            return $listaestudiantes;
            
        }

        public function consultarCantidadUsuarios($op){
            $cantusuarios=array();
            
            $conexion=new Conexion();
            if($op==1){
                $sql= "select count(*) from usuarios where Id_Tipo!=1";
            }
            if($op==2){
                $sql= "select count(*) from usuarios where Id_Tipo=2";
            }
            if($op==3){
                $sql= "select count(*) from usuarios where Id_Tipo=3";
            }
            $statement= $conexion->prepare($sql);
            $statement->execute();
            return $statement->fetchColumn();
        }


}



?>

