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
        redireccionar('/tienda/equipaciones/');
    }

    public function equipaciones($page = 1)
    {
        $this->limit = 4;
        $this->page = is_numeric($page) && $page > 0 ? $page : 1;
        $this->links = 7;

        $this->datos['equipaciones'] = $this->equipacionesModelo->getEquipacionesUsuario($this->limit, $this->page);
        $this->datos['paginator'] = $this->equipacionesModelo->getPaginator();

        $this->vista('tienda/equipaciones', $this->datos);
    }

    public function editarEquipacion()
    {
        $this->datos['rolesPermitidos'] = [4];
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/tienda');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->equipacionesModelo->updateUsuario(trim($_POST['id_usuario']), trim($_POST['activado']))) {
                redireccionar('/tienda');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }
}
