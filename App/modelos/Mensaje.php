<?php

class Mensaje{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }



//**********************MENSAJERIA ADMIN*********************************/

public function obtener_email_todos(){
    $this->db->query("SELECT v2usuario.id_usuario as id, v2rol.nombre as tipo, v2usuario.nombre, apellidos, email FROM v2usuario, v2rol where v2usuario.id_rol=v2rol.id_rol
    union all
    select id_participante as id, 'Participantes' as tipo, nombre, apellidos, email from v2participante
    union all
    select id_entidad as id, 'Entidades' as tipo, nombre,'' as apellidos, email from v2entidad");
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
     $this->db->query("SELECT v2grupo.nombre, v2grupo.id_grupo from v2grupo, v2entrenador_grupo 
     where v2entrenador_grupo.id_usuario = :idUsu and v2grupo.id_grupo = v2entrenador_grupo.id_grupo;");
     $this->db->bind(':idUsu',$idUsu);
     return $this->db->registros();
 }

public function grupos_x_entrenador($id){
    $this->db->query("SELECT * from v2grupos_x_entrenador where entrenador=:id");
    $this->db->bind(':id',$id);
    return $this->db->registros();
}





}