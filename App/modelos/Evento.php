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
        
        $this->db->query("INSERT INTO EVENTO (nombre,tipo,precio,descuento,fecha_ini,fecha_fin,fecha_ini_inscrip,fecha_fin_inscrip) 
                            VALUES (:nombre,:tipo,:precio,:descuento,:fechaInicio, :fechaFin,:fechaIniIns,:fechaFinIns)");
        $this->db->bind(':nombre', $evento_modificado['nombre']);
        $this->db->bind(':tipo',$evento_modificado['tipo']);
        $this->db->bind(':precio',$evento_modificado['precio']);
        $this->db->bind(':descuento',$evento_modificado['descuento']);
        $this->db->bind(':fechaInicio',$evento_modificado['fecha_ini']);
        $this->db->bind(':fechaFin',$evento_modificado['fecha_fin']);
        $this->db->bind(':fechaIniIns',$evento_modificado['fecha_ini_inscrip']);
        $this->db->bind(':fechaFinIns',$evento_modificado['fecha_fin_inscrip']);
        
        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }
    }



    public function editarEvento($evento_modificado){
        var_dump($evento_modificado);
        $this->db->query("UPDATE EVENTO SET nombre=:nombre,tipo=:tipo, precio=:precio, descuento=:descuento,fecha_ini=:fecha_ini,fecha_fin=:fecha_fin,
        fecha_ini_inscrip=:fecha_ini_inscrip,fecha_fin_inscrip=:fecha_fin_inscrip WHERE id_evento = :id_evento");

        $this->db->bind(':id_evento', $evento_modificado['id_evento']);
        $this->db->bind(':nombre', $evento_modificado['nombre']);
        $this->db->bind(':tipo',$evento_modificado['tipo']);
        $this->db->bind(':precio',$evento_modificado['precio']);
        $this->db->bind(':descuento',$evento_modificado['descuento']);
        $this->db->bind(':fecha_ini',$evento_modificado['fecha_ini']);
        $this->db->bind(':fecha_fin', $evento_modificado['fecha_fin']);
        $this->db->bind(':fecha_ini_inscrip',$evento_modificado['fecha_ini_inscrip']);
        $this->db->bind(':fecha_fin_inscrip', $evento_modificado['fecha_fin_inscrip']);
    
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
        

    }



}

