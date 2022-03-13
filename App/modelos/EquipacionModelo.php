<?php

class EquipacionModelo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getEquipacionesUsuario()
    {
        $this->db->query("SELECT * FROM EQUIPACION JOIN USUARIO ON EQUIPACION.id_usuario = USUARIO.id_usuario;");
        return $this->db->registros();
    }
}
