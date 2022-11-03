<?php


class AdminInformes extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];    

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

         $this->adminModelo = $this->modelo('AdminModelo');
        // $this->externoModelo = $this->modelo('ExternoModelo');
    }

    
    //*********** NOTIFICACIONES EN EL MENU LATERAL *********************/
    public function notificaciones(){
        $notific[0] = $this->adminModelo->notSocio();
        $notific[1] = $this->adminModelo->notGrupo();
        $notific[2] = $this->adminModelo->notEventos();
        $notific[3] = $this->adminModelo->contar_pedidos();
        return $notific;
    }


    public function index(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        // $id=$this->datos['usuarioSesion']->id_usuario;
        // $this->datos['datos_user'] = $this->adminModelo->obtenerDatosId($id);

        $this->vista('administradores/informes', $this->datos);
    }

}
