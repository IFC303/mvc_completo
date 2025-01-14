<?php

class LoginModelo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }


    public function loginEmail($email, $passw)
    {
        $this->db->query("SELECT * FROM v2usuario WHERE email = :email AND passw = :passw");
        $this->db->bind(':email', $email);
        $this->db->bind(':passw', $passw);

        return $this->db->registro();
    }

    
    public function recuperar($socio){
        $this->db->query("SELECT email FROM v2usuario  WHERE id_usuario=:socio");
        $this->db->bind(':socio', $socio);
        return $this->db->registro();
    }

    public function cambiarPass($password,$id){
    
        $this->db->query("UPDATE v2usuario  SET passw=MD5(:passw) where id_usuario=:id");
        $this->db->bind(':passw', $password);
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }



    /*public function registroSesion($id_usuario)
    {
        $this->db->query("INSERT INTO sesiones (id_sesion, id_usuario, fecha_inicio) 
                                        VALUES (:id_sesion, :id_usuario, NOW())");

        $this->db->bind(':id_sesion', session_id());
        $this->db->bind(':id_usuario', $id_usuario);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function registroFinSesion($id_usuario)
    {
        $this->db->query("UPDATE sesiones SET fecha_fin = NOW()  
                                    WHERE id_usuario = :id_usuario AND id_sesion = :id_sesion");

        $this->db->bind(':id_sesion', session_id());
        $this->db->bind(':id_usuario', $id_usuario);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }*/
}
