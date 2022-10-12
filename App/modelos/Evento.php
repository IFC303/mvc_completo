<?php


class Evento{

    private $db;


    public function __construct(){
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



    public function agregarEvento($evento){
        
        $this->db->query("INSERT INTO EVENTO (nombre,tipo,precio,descripcion,fecha_ini,fecha_fin,fecha_ini_inscrip,fecha_fin_inscrip) 
        VALUES (:nombre,:tipo,:precio,:descripcion,:fechaInicio, :fechaFin,:fechaIniIns,:fechaFinIns)");

        $this->db->bind(':nombre', $evento['nombre']);
        $this->db->bind(':tipo',$evento['tipo']);
        $this->db->bind(':precio',$evento['precio']);
        $this->db->bind(':descripcion',$evento['descripcion']);
        $this->db->bind(':fechaInicio',$evento['fecha_ini']);
        $this->db->bind(':fechaFin',$evento['fecha_fin']);
        $this->db->bind(':fechaIniIns',$evento['fecha_ini_inscrip']);
        $this->db->bind(':fechaFinIns',$evento['fecha_fin_inscrip']);
        
        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }
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



    public function editarEvento($evento_modificado,$id){
        $this->db->query("UPDATE EVENTO SET nombre=:nombre,tipo=:tipo, precio=:precio, descripcion=:descripcion,fecha_ini=:fecha_ini,fecha_fin=:fecha_fin,
        fecha_ini_inscrip=:fecha_ini_inscrip,fecha_fin_inscrip=:fecha_fin_inscrip WHERE id_evento = :id");

        $this->db->bind(':nombre', $evento_modificado['nombre']);
        $this->db->bind(':tipo',$evento_modificado['tipo']);
        $this->db->bind(':precio',$evento_modificado['precio']);
        $this->db->bind(':descripcion',$evento_modificado['descripcion']);
        $this->db->bind(':fecha_ini',$evento_modificado['fecha_ini']);
        $this->db->bind(':fecha_fin', $evento_modificado['fecha_fin']);
        $this->db->bind(':fecha_ini_inscrip',$evento_modificado['fecha_ini_inscrip']);
        $this->db->bind(':fecha_fin_inscrip', $evento_modificado['fecha_fin_inscrip']);
        
        $this->db->bind(':id', $id);
    
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



    public function obtenerParticipantesEventos($id){
        $this->db->query("SELECT * from participante WHERE id_evento=:id order by marca");
        $this->db->bind(':id',$id);
        return $this->db->registros();
    }



    public function borrar_participante($id){
        $this->db->query("DELETE FROM participante WHERE id_participante =:id");
        $this->db->bind(':id',$id);

        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function anotar_marca($marca,$id){
        
        $this->db->query("UPDATE participante SET dorsal=:dorsal,marca=:marca WHERE id_participante = :id");
        $this->db->bind(':dorsal', $marca['dorsal']);
        $this->db->bind(':marca', $marca['marca']);
        $this->db->bind(':id',$id);

        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
                        
    }


    public function nuevo_participante($nuevo){
        
        $this->db->query("INSERT INTO participante (id_evento,nombre,apellidos,DNI,fecha_nacimiento,direccion,email,telefono) 
        VALUES (:id,:nombre,:apellidos,:dni,:fecha_nacimiento,:direccion,:email,:telefono)");

        $this->db->bind(':id',$nuevo['id_evento']);
        $this->db->bind(':nombre', $nuevo['nombre']);
        $this->db->bind(':apellidos',$nuevo['apellidos']);
        $this->db->bind(':dni',$nuevo['dni']);
        $this->db->bind(':direccion',$nuevo['direccion']);
        $this->db->bind(':fecha_nacimiento',$nuevo['fecha_naci']);
        $this->db->bind(':email',$nuevo['email']);
        $this->db->bind(':telefono',$nuevo['telefono']);

        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }
    }


    public function editar_participante($nuevo,$id){
        
        $this->db->query("UPDATE participante SET nombre=:nombre,apellidos=:apellidos,DNI=:dni,fecha_nacimiento=:fecha_nacimiento,
        direccion=:direccion,email=:email,telefono=:telefono where id_participante=:id");

        $this->db->bind(':nombre', $nuevo['nombre']);
        $this->db->bind(':apellidos',$nuevo['apellidos']);
        $this->db->bind(':dni',$nuevo['dni']);
        $this->db->bind(':direccion',$nuevo['direccion']);
        $this->db->bind(':fecha_nacimiento',$nuevo['fecha_naci']);
        $this->db->bind(':email',$nuevo['email']);
        $this->db->bind(':telefono',$nuevo['telefono']);

        $this->db->bind(':id',$id);

        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
           
    }







}

