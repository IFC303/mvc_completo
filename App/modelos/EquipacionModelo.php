<?php

class EquipacionModelo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getEquipacionesUsuario($limit, $page)
    {
        $conn       = new mysqli('mysql', 'root', 'toor', 'tragamillas2');
        $query      = "SELECT * FROM EQUIPACION JOIN USUARIO ON EQUIPACION.id_usuario = USUARIO.id_usuario";
        $this->paginator  = new Paginator($conn, $query);
        $results    = $this->paginator->getData($limit, $page);

        return $results->data;
        $this->db->query("SELECT * FROM EQUIPACION JOIN USUARIO ON EQUIPACION.id_usuario = USUARIO.id_usuario;");

        
        // return $this->db->registros();
    }

    public function updateUsuario($id, $activado)
    {
        $this->db->query("UPDATE USUARIO SET activado=:activado WHERE id_usuario = :id_usuario");
        $this->db->bind(':id_usuario', $id);
        $this->db->bind(':activado', $activado);
        $this->db->execute();
        return true;
    }
}
