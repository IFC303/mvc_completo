<?php

class Test
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }


    public function obtenerTest()
    {
        $this->db->query("SELECT * FROM TEST");

        return $this->db->registros();
    }
}