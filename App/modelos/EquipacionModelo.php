<?php

class EquipacionModelo
{
    private $db;
    private $paginator;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getPaginator()
    {
        return $this->paginator;
    }

    public function getEquipacionesUsuario($limit, $page)
    {
        $query = "SELECT * FROM EQUIPACION JOIN USUARIO ON EQUIPACION.id_usuario = USUARIO.id_usuario";
        $this->paginator = new Paginator($this->db, $query);

        $results    = $this->paginator->getData($limit, $page);
        return $results->data;
    }

    public function updateUsuario($id, $entregado)
    {
        $this->db->query("UPDATE USUARIO SET entregado=:entregado WHERE id_usuario = :id_usuario");
        $this->db->bind(':id_usuario', $id);
        $this->db->bind(':entregado', $entregado);
        $this->db->execute();
        return true;
    }
}
