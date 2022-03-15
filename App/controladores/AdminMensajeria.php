<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once RUTA_APP.'/librerias/PHPMailer/Exception.php';
require_once RUTA_APP.'/librerias/PHPMailer/PHPMailer.php';
require_once RUTA_APP.'/librerias/PHPMailer/SMTP.php';


class AdminMensajeria extends Controlador
{

    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->mensajeModelo = $this->modelo('Mensaje');
    }


    public function index(){
        
        $this->datos['mensajeAdmin']=$this->mensajeModelo->obtenerEmailAdmin();
        $this->datos['mensajeEntre']=$this->mensajeModelo->obtenerEmailEntre();
        $this->datos['mensajeTiendas']=$this->mensajeModelo->obtenerEmailTiendas();
        $this->datos['mensajeSocios']=$this->mensajeModelo->obtenerEmailSocios();
        $this->datos['mensajeExternos']=$this->mensajeModelo->obtenerEmailExternos();
        $this->datos['mensajeEntidades']=$this->mensajeModelo->obtenerEmailEntidades();

        $this->vista('administradores/mensajeria',$this->datos);
    }



}