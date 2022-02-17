<?php

class AdminModelo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function obtenerUsuarios($rol)
    {
        $this->db->query("SELECT * FROM USUARIO WHERE id_rol = $rol");
        return $this->db->registros();
    }

    public function borrarUsuario($idUsuario)
    {
        $this->db->query("DELETE FROM USUARIO WHERE id_usuario = :id_usu");
        $this->db->bind(':id_usu', $idUsuario);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function anadirUsuario($usuAnadir)
    {
        $this->db->query("SELECT id_usuario FROM `USUARIO` ORDER BY `id_usuario` DESC LIMIT 1");
        $idBDD = $this->db->registros();
        $idBDD = $idBDD[0]->id_usuario;
        $idUsuAna = $idBDD + 1;

        $this->db->query("INSERT INTO USUARIO (id_usuario, dni, nombre, apellidos, email, fecha_nacimiento, telefono, CCC, passw, talla, foto, activado, id_rol) 
        VALUES (:idUsu, :dniUsu, :nomUsu, :apelUsu, :emaUsu, :fecUsu, :telUsu, :cccUsu, MD5(:passUsu), :tallUsu, :fotUsu, :actUsu, :idRolUsu);");

        $this->db->bind(':idUsu', $idUsuAna);
        $this->db->bind(':dniUsu', $usuAnadir['dniUsuAna']);
        $this->db->bind(':nomUsu', $usuAnadir['nomUsuAna']);
        $this->db->bind(':apelUsu', $usuAnadir['apelUsuAna']);
        $this->db->bind(':fecUsu', $usuAnadir['fecUsuAna']);
        $this->db->bind(':telUsu', $usuAnadir['telUsuAna']);
        $this->db->bind(':emaUsu', $usuAnadir['emaUsuAna']);
        $this->db->bind(':cccUsu', "" /*$usuAnadir['cccUsuAna']*/);
        $this->db->bind(':passUsu', $usuAnadir['passUsuAna']);
        $this->db->bind(':tallUsu', ""/*$usuAnadir['tallUsuAna']*/);
        $this->db->bind(':fotUsu', ""/*$usuAnadir['fotUsuAna']*/);
        $this->db->bind(':actUsu', "1"/*$usuAnadir['actUsuAna']*/);
        $this->db->bind(':idRolUsu', "1"/*$usuAnadir['idRolUsuAna']*/);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
