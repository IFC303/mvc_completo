<?php

class Mensaje
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }


    public function obtenerEmail(){
        $this->db->query("SELECT nombre,apellidos,email FROM USUARIO");
        return $this->db->registros();
    }

    public function entrenadorGrupo($idUsu){
        $this->db->query("SELECT GRUPO.nombre, GRUPO.id_grupo from GRUPO, ENTRENADOR_GRUPO 
        where ENTRENADOR_GRUPO.id_usuario=:idUsu and GRUPO.id_grupo=ENTRENADOR_GRUPO.id_grupo;");
        $this->db->bind(':idUsu',$idUsu);
        return $this->db->registros();
    }
   

    public function obtenerEmailGrupo(){
        $this->db->query("SELECT ENTRENADOR_GRUPO.id_usuario, SOCIO_GRUPO.id_grupo, USUARIO.nombre, apellidos,email 
        from USUARIO,ENTRENADOR_GRUPO,SOCIO_GRUPO 
        where USUARIO.id_usuario=SOCIO_GRUPO.id_usuario and ENTRENADOR_GRUPO.id_grupo=SOCIO_GRUPO.id_grupo");
        return $this->db->registros();   
    }


//**********************MENSAJERIA ADMIN******************************** */

    public function obtenerEmailsTodos(){
        $this->db->query("SELECT * FROM EMAIL");
        return $this->db->registros();
    }

   public function obtenerEmailEntidades(){
         $this->db->query("SELECT * FROM OTRAS_ENTIDADES");
         return $this->db->registros();
    }




    // public function obtenerEmailEntre(){
    //     $this->db->query("SELECT * FROM USUARIO WHERE id_rol=2");
    //     return $this->db->registros();
    // }

    // public function obtenerEmailSocios(){
    //     $this->db->query("SELECT * FROM USUARIO WHERE id_rol=3");
    //     return $this->db->registros();
    // }

    // public function obtenerEmailTiendas(){
    //     $this->db->query("SELECT * FROM USUARIO WHERE id_rol=4");
    //     return $this->db->registros();
    // }

    // public function obtenerEmailExternos(){
    //     $this->db->query("SELECT * FROM EXTERNO");
    //     return $this->db->registros();
    // }

   



}