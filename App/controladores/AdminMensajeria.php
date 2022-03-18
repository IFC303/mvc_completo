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
        $this->AdminModelo = $this->modelo('AdminModelo');
    }

    //NOTIFICACIONES
    public function notificaciones()
    {
        $notific[0] = $this->AdminModelo->notSocio();
        $notific[1] = $this->AdminModelo->notGrupo();
        $notific[2] = $this->AdminModelo->notEventos();
        $notific[3] ="MENSAJERIA";
        
        return $notific;
    }

    public function index(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;
        
        $this->datos['mensajeTodos']=$this->mensajeModelo->obtenerEmailsTodos();
        // $this->datos['mensajeEntre']=$this->mensajeModelo->obtenerEmailEntre();
        // $this->datos['mensajeTiendas']=$this->mensajeModelo->obtenerEmailTiendas();
        // $this->datos['mensajeSocios']=$this->mensajeModelo->obtenerEmailSocios();
        // $this->datos['mensajeExternos']=$this->mensajeModelo->obtenerEmailExternos();
        //$this->datos['mensajeEntidades']=$this->mensajeModelo->obtenerEmailEntidades();

        $this->vista('administradores/mensajeria',$this->datos);
    }

    public function enviar(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;


        if($_SERVER['REQUEST_METHOD']=='POST'){

            $mail = new PHPMailer();


            //me llega un string y lo paso a array con explode
            $destinatario = explode(",",($_POST['destinatario']));
            echo print_r($destinatario);   

            $asunto = ($_POST['asunto']);
            $mensaje =($_POST['mensaje']);
    
            try {
            //  Configuracion SMTP
                $mail->SMTPDebug =2;
                $mail->isSMTP();                                       // Activar envio SMTP
                $mail->Host  = 'smtp.gmail.com';                       // Servidor SMTP
                $mail->SMTPAuth  = true;                               // Identificacion SMTP
                $mail->Username  = 'sbr.design.reto@gmail.com';              // Usuario SMTP
                $mail->Password  = 'sbrdesign1234';	                     // Contraseña SMTP
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port  = 587;
                
            // CONFIGURACION CORREO
                $mail->setFrom('sbr.design.reto@gmail.com');   // Remitente del correo

                foreach($destinatario as $correo){
                    echo $correo ."<br>";
                     $mail->addAddress($correo); // Email destinatario
                }
                  
                $mail->isHTML(true);
                $mail->Subject = $asunto;
                $mail->Body  = $mensaje;
                $mail->send();

                
                redireccionar('/entrenador/mensajeria');
                echo 'El mensaje se ha enviado';
            } catch (Exception $e) {
                echo "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
            }

        }
            
    }

}