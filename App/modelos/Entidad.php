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
        
        $this->db->query("INSERT INTO OTRAS_ENTIDADES (cif,nombre,direccion,telefono,email,observaciones) VALUES (:cif, :nombre, :direccion,:telefono,:email,:observaciones)");
        $this->db->bind(':cif',$entidadNueva['cif']);
        $this->db->bind(':nombre', $entidadNueva['nombre']);
        $this->db->bind(':direccion',$entidadNueva['direccion']);
        $this->db->bind(':telefono',$entidadNueva['telefono']);
        $this->db->bind(':email',$entidadNueva['email']);
        $this->db->bind(':observaciones',$entidadNueva['observaciones']);

        if ($this->db->execute()){
            return $this->db->ultimoIndice();
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



    public function editarEntidad($entidad_modificada,$id){
        $this->db->query("UPDATE OTRAS_ENTIDADES SET cif=:cif, nombre=:nombre, direccion=:direccion,telefono=:telefono,email=:email,observaciones=:observaciones 
        WHERE id_entidad = :id");
        
        $this->db->bind(':cif',$entidad_modificada['cif']);
        $this->db->bind(':nombre', $entidad_modificada['nombre']);
        $this->db->bind(':direccion',$entidad_modificada['direccion']);
        $this->db->bind(':telefono',$entidad_modificada['telefono']);
        $this->db->bind(':email',$entidad_modificada['email']);
        $this->db->bind(':observaciones',$entidad_modificada['observaciones']);

        $this->db->bind(':id',$id);
        
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


}