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
    }

    public function index()
    {
        $this->vista('tiendas/inicio', $this->datos);
    }
}
