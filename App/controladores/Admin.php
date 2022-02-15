<?php

class Admin extends Controlador
{
    public function __construct()
    {
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }
    }

    
    public function index()
    {
        $this->vista('administradores/inicio', $this->datos);
    }


    public function crud_admin()
    {
        $this->vista('administradores/cruds/crudAdmin', $this->datos);
    }

    public function crud_entrenadores()
    {
        $this->vista('administradores/cruds/crudEntrenador', $this->datos);
    }

    public function crud_socios()
    {
        $this->vista('administradores/cruds/crudSocios', $this->datos);
    }

    public function crud_tiendas()
    {
        $this->vista('administradores/cruds/crudTiendas', $this->datos);
    }
}
