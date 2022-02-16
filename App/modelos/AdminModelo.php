<?php

class AdminModelo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function obtenerUsuarios($rol){
        $this->db->query("SELECT * FROM USUARIO WHERE id_rol = $rol");
        return $this->db->registros();
    }

    public function borrarUsuario($idUsuario){
        $this->db->query("DELETE FROM USUARIO WHERE id_usuario = :id_usu");
        $this->db->bind(':id_usu',$idUsuario);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function anadirUsuario($usuAnadir){
        $this->db->query("INSERT INTO USUARIO (id_usuario, dni, nombre, apellidos, email, fecha_nacimiento, telefono, CCC, passw, talla, foto, activado, id_rol) 
        VALUES (:idUsu, :dniUsu, :nomUsu, :apelUsu, :emaUsu, :fecUsu, :telUsu, :cccUsu, :passUsu, :tallUsu, :fotUsu, :actUsu, :idRolUsu);");

        $this->db->bind(':id_test',$usuAnadir['id_test']);
        $this->db->bind(':nombre', $usuAnadir['nombre']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


}