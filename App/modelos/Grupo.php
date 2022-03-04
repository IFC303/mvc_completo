<?php

class Grupo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


    public function obtenerGrupos(){
        $this->db->query("SELECT * FROM GRUPO");
        return $this->db->registros();
    }


    public function obtenerGrupoId($id){
        $this->db->query("SELECT * FROM GRUPO WHERE id_grupo = :idGrupo");
        $this->db->bind(':idGrupo', $id);
        return $this->db->registro();
    }

    public function obtenerEntrenador(){
        $this->db->query("SELECT * FROM USUARIO WHERE id_rol=2");
        return $this->db->registros();
    }


    public function obtenerAlumnos(){
        $this->db->query("SELECT * FROM USUARIO WHERE id_rol=3");
        return $this->db->registros();
    }


    public function agregarGrupo($grupoNuevo){
        
        $this->db->query("INSERT INTO GRUPO (id_grupo,nombre,fecha_ini,fecha_fin) VALUES (:idGrupo, :nombre, :fechaInicio, :fechaFin)");
        $this->db->bind(':idGrupo',$grupoNuevo['id_grupo']);
        $this->db->bind(':nombre', $grupoNuevo['nombre']);
        $this->db->bind(':fechaInicio',$grupoNuevo['fecha_inicio']);
        $this->db->bind(':fechaFin',$grupoNuevo['fecha_fin']);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }


    public function borrarGrupo($id){
        $this->db->query("DELETE FROM GRUPO WHERE id_grupo =:idGrupo");
        $this->db->bind(':idGrupo',$id);

        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }


    }

    public function editarGrupo($grupo_modificado){
        $this->db->query("UPDATE GRUPO SET nombre=:nombre_grupo, fecha_ini=:fecha_ini, fecha_fin=:fecha_fin WHERE id_grupo = :id_grupo");
        $this->db->bind(':id_grupo',$grupo_modificado['id_grupo']);
        $this->db->bind(':nombre_grupo', $grupo_modificado['nombre_grupo']);
        $this->db->bind(':fecha_ini',$grupo_modificado['fecha_ini']);
        $this->db->bind(':fecha_fin', $grupo_modificado['fecha_fin']);
        $this->db->execute();

    }


  



}