<?php

class Entidad
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


    public function obtenerEntidades(){
        $this->db->query("SELECT * FROM OTRAS_ENTIDADES");
        return $this->db->registros();
    }


    public function obtenerEntidadId($id){
        $this->db->query("SELECT * FROM OTRAS_ENTIDADES WHERE id_entidad = :idEntidad");
        $this->db->bind(':idEntidad', $id);
        return $this->db->registro();
    }


    public function agregarEntidad($entidadNueva){
        
        $this->db->query("INSERT INTO OTRAS_ENTIDADES (id_entidad,nombre,tipo) VALUES (:idEntidad, :nombre, :tipo)");
        $this->db->bind(':idEntidad',$entidadNueva['id_entidad']);
        $this->db->bind(':nombre', $entidadNueva['nombre']);
        $this->db->bind(':tipo',$entidadNueva['tipo']);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }



    public function borrarEntidad($id){
        $this->db->query("DELETE FROM OTRAS_ENTIDADES WHERE id_entidad =:id");
        $this->db->bind(':id',$id);

        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



    public function editarEntidad($entidad_modificada){
        $this->db->query("UPDATE OTRAS_ENTIDADES SET nombre=:nombre, tipo=:tipo WHERE id_entidad = :idEntidad");
        $this->db->bind(':idEntidad',$entidad_modificada['id_entidad']);
        $this->db->bind(':nombre', $entidad_modificada['nombre']);
        $this->db->bind(':tipo',$entidad_modificada['tipo']);
        $this->db->execute();
    }


}