<?php

class Mensaje{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }



//**********************MENSAJERIA ADMIN*********************************/

public function obtener_email_todos(){
    $this->db->query("SELECT usuario.id_usuario as id, rol.nombre as tipo, usuario.nombre,apellidos,email FROM USUARIO, rol where usuario.id_rol=rol.id_rol
    union all
    select id_participante as id, 'Participantes' as tipo, nombre,apellidos, email from participante
    union all
    select id_entidad as id, 'Entidades' as tipo,nombre,'' as apellidos, email from otras_entidades");
    return $this->db->registros();
}


   
//**********************MENSAJERIA ENTRENADOR *********************************/

// public function obtener_email_grupos(){
//     $this->db->query("SELECT entrenador_grupo.id_grupo, grupo.nombre, socio_grupo.id_usuario as id_alumno,
//     CONCAT(usuario.nombre,' ',usuario.apellidos) as alumno,email,
//     entrenador_grupo.id_usuario as entrenador
//     from entrenador_grupo,usuario,grupo,socio_grupo
//     where socio_grupo.id_grupo=grupo.id_grupo and socio_grupo.id_usuario=usuario.id_usuario
//     and entrenador_grupo.id_grupo=grupo.id_grupo;");
//     return $this->db->registros();
// }


 public function entrenador_grupo($idUsu){
     $this->db->query("SELECT GRUPO.nombre, GRUPO.id_grupo from GRUPO, ENTRENADOR_GRUPO 
     where ENTRENADOR_GRUPO.id_usuario=:idUsu and GRUPO.id_grupo=ENTRENADOR_GRUPO.id_grupo;");
     $this->db->bind(':idUsu',$idUsu);
     return $this->db->registros();
 }

public function grupos_x_entrenador($id){
    $this->db->query("SELECT * from grupos_x_entrenador where entrenador=:id");
    $this->db->bind(':id',$id);
    return $this->db->registros();
}





}