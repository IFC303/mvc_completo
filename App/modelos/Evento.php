<?php


class Evento{

    private $db;


    public function __construct(){
        $this->db = new Base;
    }



//*********************************** VER ****************************************/

    public function obtener_eventos($temporada){
        $this->db->query("SELECT * FROM v2evento where fecha_ini between :inicio and :fin");
        $this->db->bind(':inicio',$temporada->fecha_inicio);
        $this->db->bind(':fin',$temporada->fecha_fin);
        return $this->db->registros();
    }

    public function obtenerEventoId($id){
        $this->db->query("SELECT * FROM v2evento WHERE id_evento = :idEvento");
        $this->db->bind(':idEvento', $id);
        return $this->db->registro();
    }

    public function obtener_resul_eventos(){
        $this->db->query("SELECT * FROM v2participante order by marca");
        return $this->db->registros();
    }



//*********************************** NUEVO ****************************************/

    public function nuevo($evento){
        
        $this->db->query("INSERT INTO v2evento (nombre,tipo,precio,descripcion,fecha_ini,fecha_fin,fecha_ini_inscrip,fecha_fin_inscrip) 
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


//*********************************** EDITAR ****************************************/

    public function editar($evento_modificado,$id){
        $this->db->query("UPDATE v2evento SET nombre=:nombre,tipo=:tipo, precio=:precio, descripcion=:descripcion,fecha_ini=:fecha_ini,fecha_fin=:fecha_fin,
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

    
//*********************************** BORRAR ****************************************/

public function borrar($id){
    $this->db->query("DELETE FROM v2evento WHERE id_evento =:idEvento");
    $this->db->bind(':idEvento',$id);

    if ($this->db->execute()){
        return true;
    }else{
        return false;
    }
}




//*********************************** FUNCIONES PARTICIPANTES ****************************************/

    public function obtenerParticipantesEventos($id){
        $this->db->query("SELECT * from v2participante WHERE id_evento=:id order by marca");
        $this->db->bind(':id',$id);
        return $this->db->registros();
    }




    public function nuevo_participante($nuevo){       
        $this->db->query("INSERT INTO v2participante (id_evento,fecha_aceptacion,nombre,apellidos,dni,fecha_nacimiento,direccion,email,telefono, foto_pago) 
        VALUES (:id, CURDATE(), :nombre,:apellidos,:dni,:fecha_nacimiento,:direccion,:email,:telefono, :foto)");

        $this->db->bind(':id',$nuevo['id_evento']);
        $this->db->bind(':nombre', $nuevo['nombre']);
        $this->db->bind(':apellidos',$nuevo['apellidos']);
        $this->db->bind(':dni',$nuevo['dni']);
        $this->db->bind(':direccion',$nuevo['direccion']);
        $this->db->bind(':fecha_nacimiento',$nuevo['fecha_naci']);
        $this->db->bind(':email',$nuevo['email']);
        $this->db->bind(':telefono',$nuevo['telefono']);

        if ($nuevo['foto']=="") {
            $this->db->bind(':foto', null);    
        }else {
            $this->db->bind(':foto', $nuevo['foto']);
        }

        $this->db->execute();
        $id_parti = $this->db->ultimoIndice();


        
        if($nuevo['foto']!=''){
    //     //COPIO LA FOTO EN EL DIRECTORIO Y CAMBIO NOMBRE EN LA BBDD  
    //     //$directorio = "/var/www/html/tragamillas/public/img/fotos_equipacion/";
            $directorio="C:/xampp/htdocs/tragamillas/public/img/eventos/";   
            copy($_FILES['subirFoto']['tmp_name'], $directorio.$id_parti.'.jpg');
            chmod($directorio.$id_parti.'.jpg',0777);

            $foto=$id_parti.'.jpg';
            $this->db->query("UPDATE v2participante SET foto_pago=:foto where id_participante=:id_parti;");
            $this->db->bind(':foto', $foto);
            $this->db->bind(':id_parti', $id_parti);

            if($this->db->execute()){
                return true;
           }else{
               return false;
           }

        } 

        return true;
    }



    public function borrar_participante($id){
        $this->db->query("DELETE FROM v2participante WHERE id_participante =:id");
        $this->db->bind(':id',$id);

        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



    public function editar_participante($nuevo,$id){       

        $this->db->query("UPDATE v2participante SET nombre=:nombre,apellidos=:apellidos,dni=:dni,fecha_nacimiento=:fecha_nacimiento,
        direccion=:direccion,email=:email,telefono=:telefono, foto_pago=:foto where id_participante=:id");

        $this->db->bind(':nombre', $nuevo['nombre']);
        $this->db->bind(':apellidos',$nuevo['apellidos']);
        $this->db->bind(':dni',$nuevo['dni']);
        $this->db->bind(':direccion',$nuevo['direccion']);
        $this->db->bind(':fecha_nacimiento',$nuevo['fecha_naci']);
        $this->db->bind(':email',$nuevo['email']);
        $this->db->bind(':telefono',$nuevo['telefono']);
        $this->db->bind(':foto',$nuevo['foto']);


        $this->db->bind(':id',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }     
    }



    public function anotar_marca($marca,$id_evento){    

        foreach($marca as $datos){

            $this->db->query("UPDATE v2participante SET dorsal=:dorsal, marca=:marca WHERE id_participante=:id_participante");
            
            if($datos['dorsal']!=''){
                $this->db->bind(':dorsal', $datos['dorsal']);
            }else{
                $this->db->bind(':dorsal', null);
            }

            if($datos['marca']!=''){
                $this->db->bind(':marca', $datos['marca']);
            }else{
                $this->db->bind(':marca', null);
            }

            $this->db->bind(':id_participante',$datos['parti']);

            $this->db->execute();
        }        
        return true;
    }



}

