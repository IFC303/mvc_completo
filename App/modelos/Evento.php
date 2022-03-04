<?php


class Evento{

    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }



    public function obtenerEventos(){
        $this->db->query("SELECT * FROM EVENTO");
        return $this->db->registros();
    }

    public function obtenerEventoId($id){
        $this->db->query("SELECT * FROM EVENTO WHERE id_evento = :idEvento");
        $this->db->bind(':idEvento', $id);
        return $this->db->registro();
    }


    public function borrarEvento($id){
        $this->db->query("DELETE FROM EVENTO WHERE id_evento =:idEvento");
        $this->db->bind(':idEvento',$id);

        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



    public function agregarEvento($evento_modificado){
        
        $this->db->query("INSERT INTO EVENTO (id_evento,id_usuario,nombre,tipo,precio,descuento,fecha_ini,fecha_fin) 
                        VALUES (:idEvento,:idUsuario,:nombre,:tipo,:precio,:descuento,:fechaInicio, :fechaFin)");
        $this->db->bind(':idEvento',$evento_modificado['id_evento']);
        $this->db->bind(':idUsuario',$evento_modificado['id_usuario']);
        $this->db->bind(':nombre', $evento_modificado['nombre']);
        $this->db->bind(':tipo',$evento_modificado['tipo']);
        $this->db->bind(':precio',$evento_modificado['precio']);
        $this->db->bind(':descuento',$evento_modificado['descuento']);
        $this->db->bind(':fechaInicio',$evento_modificado['fecha_ini']);
        $this->db->bind(':fechaFin',$evento_modificado['fecha_fin']);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }



    public function editarEvento($evento_modificado){
        $this->db->query("UPDATE EVENTO SET id_evento=:id_evento, id_usuario=:idUsuario, nombre=:nombre, 
                                            tipo=:tipo, precio=:precio, descuento=:descuento,fecha_ini=:fecha_ini,fecha_fin=:fecha_fin WHERE id_evento = :id_evento");
        $this->db->bind(':id_evento',$evento_modificado['id_evento']);
        $this->db->bind(':idUsuario', $evento_modificado['id_usuario']);
        $this->db->bind(':nombre', $evento_modificado['nombre']);
        $this->db->bind(':tipo',$evento_modificado['tipo']);
        $this->db->bind(':precio',$evento_modificado['precio']);
        $this->db->bind(':descuento',$evento_modificado['descuento']);
        $this->db->bind(':fecha_ini',$evento_modificado['fecha_ini']);
        $this->db->bind(':fecha_fin', $evento_modificado['fecha_fin']);
        $this->db->execute();
         if($this->db->execute()){
             return true;
         }else{
             return false;
         }
        

    }



}

