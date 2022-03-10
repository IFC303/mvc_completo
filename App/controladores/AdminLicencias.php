<?php

class AdminLicencias extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->licenciaModelo = $this->modelo('Licencia');
    }


    public function index(){
        $this->datos['licencia'] = $this->licenciaModelo->obtenerLicencias();
        $this->vista('administradores/crudLicencias/inicio',$this->datos);
    }

}
