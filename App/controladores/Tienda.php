<?php

class Tienda extends Controlador
{
    public function __construct()
    {
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [4];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->equipacionesModelo = $this->modelo('EquipacionModelo');
    }

    public function index()
    {
        $this->vista('tienda/inicio', $this->datos);
    }

    public function equipaciones()
    {
        $equipaciones = $this->equipacionesModelo->getEquipacionesUsuario();
        $this->datos['equipaciones'] = $equipaciones;
        $this->vista('tienda/equipaciones', $this->datos);
    }
}
