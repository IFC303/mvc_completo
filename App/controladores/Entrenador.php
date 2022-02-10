<?php

class Entrenador extends Controlador
{
    public function __construct()
    {
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [2];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }
    }


    public function index(){
        $this->vista('entrenadores/inicio', $this->datos);
    }


    public function grupos(){
        $this->vista('entrenadores/grupos', $this->datos);
    }


    public function test(){
        $this->vista('entrenadores/test', $this->datos);
    }


    public function mensajeria(){
        $this->vista('entrenadores/mensajeria', $this->datos);
    }
}
