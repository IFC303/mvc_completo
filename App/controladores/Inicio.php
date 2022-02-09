<?php

class Inicio extends Controlador
{
    public function __construct()
    {
        $this->loginModelo = $this->modelo('LoginModelo');
    }

    public function index($error = '')
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->datos['email'] = trim($_POST['email']);
            $this->datos['passw'] = trim($_POST['passw']);
            $usuarioSesion = $this->loginModelo->loginEmail($this->datos['email'], $this->datos['passw']);
            if (isset($usuarioSesion) && !empty($usuarioSesion)) {       // si tiene datos el objeto devuelto entramos
                Sesion::crearSesion($usuarioSesion);
                $this->loginModelo->registroSesion($usuarioSesion->id_usuario);               // registro el login en DDBB
                redireccionar('/');
            } else {
                redireccionar('/login/index/error_1');
            }
        } else {
            if (Sesion::sesionCreada($this->datos)) {    // si ya estamos logueados redirecciona a la raiz
                if ($this->datos['usuarioSesion']->id_rol == 1) {
                    $this->vista('administradores/inicio', $this->datos);
                } elseif ($this->datos['usuarioSesion']->id_rol == 2) {
                    $this->vista('/entrenadores/inicio', $this->datos);
                } elseif ($this->datos['usuarioSesion']->id_rol == 3) {
                    $this->vista('/socios/inicio', $this->datos);
                } elseif ($this->datos['usuarioSesion']->id_rol == 4) {
                    $this->vista('/tiendas/inicio', $this->datos);
                }
            } else {
                $this->datos['error'] = $error;

                $this->vista('login', $this->datos);
            }
        }
    }
}
