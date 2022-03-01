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

}