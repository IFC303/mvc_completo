<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once RUTA_APP.'/librerias/PHPMailer/Exception.php';
require_once RUTA_APP.'/librerias/PHPMailer/PHPMailer.php';
require_once RUTA_APP.'/librerias/PHPMailer/SMTP.php';



class AdminMensajeria extends Controlador{

    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];   
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }
        $this->mensajeModelo = $this->modelo('Mensaje');
        $this->temporadaModelo = $this->modelo('Temporada');
        $this->adminModelo = $this->modelo('AdminModelo');
    }



   //*********** NOTIFICACIONES EN EL MENU LATERAL *********************/
   public function notificaciones(){
    $this->datos['temp_actual']=$this->temporadaModelo->obtener_actual();
    $notific[0] = $this->adminModelo->notSocio();
    $notific[1] = $this->adminModelo->notGrupo();
    $notific[2] = $this->adminModelo->notEventos();
    $notific[3] = $this->adminModelo->contar_pedidos($this->datos['temp_actual']);
    return $notific;
}



    //*********** INDEX *********************/
    public function index(){
        $this->datos['notificaciones'] =  $this->notificaciones();
        $this->datos['email_todos']=$this->mensajeModelo->obtener_email_todos();
        $this->vista('administradores/mensajeria',$this->datos);
    }




    public function enviar(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;


        if($_SERVER['REQUEST_METHOD']=='POST'){

            $mail = new PHPMailer();

            //me llega un string y lo paso a array con explode
            $destinatario = explode(",",($_POST['destinatario']));
            $asunto = ($_POST['asunto']);
            $mensaje = ($_POST['mensaje']);

             try {
             //  Configuracion SMTP
                //$mail->SMTPDebug =2;
                 $mail->isSMTP();                                       // Activar envio SMTP
                 $mail->Host  = 'smtp.gmail.com';                       // Servidor SMTP
                 $mail->SMTPAuth  = true;                               // Identificacion SMTP
                 $mail->Username  = 'sbr.design.reto@gmail.com';              // Usuario SMTP
                 //$mail->Password  = 'sbrdesign1234';	  
                 $mail->Password = 'ncrihzkexawuolwn';                // Contraseña SMTP
                 $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                 $mail->Port  = 587;
                
             // CONFIGURACION CORREO
                 $mail->setFrom('sbr.design.reto@gmail.com');   // Remitente del correo

                 foreach($destinatario as $correo){
                     // $mail->addAddress($correo); // Email destinatario
                    $mail->addBCC($correo); //concopia oculta al resto de destinatarios
                      
                 }
                  
                 $mail->isHTML(true);
                 $mail->Subject = $asunto;
                 $mail->Body  = $mensaje;
                 $mail->send();

               
                 echo '<script type="text/javascript">alert("Mensaje enviado correctamente");
                    window.location.assign("adminMensajeria/mensajeria.php");
                    </script>'; 
 
             } catch (Exception $e) {
                 echo "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
             }


        }

        redireccionar('/adminMensajeria/mensajeria');
            
    }

}