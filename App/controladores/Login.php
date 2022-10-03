<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once RUTA_APP.'/librerias/PHPMailer/Exception.php';
require_once RUTA_APP.'/librerias/PHPMailer/PHPMailer.php';
require_once RUTA_APP.'/librerias/PHPMailer/SMTP.php';


class Login extends Controlador
{
    public function __construct()
    {
        $this->loginModelo = $this->modelo('LoginModelo');
    }


    public function index($error = '')
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->datos['email'] = trim($_POST['email']);
            $this->datos['passw'] = MD5(trim($_POST['passw']));
           // $this->datos['passw'] = trim($_POST['passw']);
            $usuarioSesion = $this->loginModelo->loginEmail($this->datos['email'], $this->datos['passw']);
            if (isset($usuarioSesion) && !empty($usuarioSesion)) {       // si tiene datos el objeto devuelto entramos
                Sesion::crearSesion($usuarioSesion);
                // $this->loginModelo->registroSesion($usuarioSesion->id_usuario);               // registro el login en DDBB
                redireccionar('/');
            } else {
                redireccionar('/login/index/error_1');
            }
        } else {
            if (Sesion::sesionCreada($this->datos)) {    // si ya estamos logueados redirecciona a la raiz
                if ($this->datos['usuarioSesion']->id_rol == 1) {
                    redireccionar('/admin');
                } elseif ($this->datos['usuarioSesion']->id_rol == 2) {
                    redireccionar('/entrenador');
                } elseif ($this->datos['usuarioSesion']->id_rol == 3) {
                    redireccionar('/socio');
                } 
            } else {
                $this->datos['error'] = $error;

                $this->vista('login', $this->datos);
            }
        }
    }

    
    public function logout(){
        Sesion::iniciarSesion($this->datos);        // controlamos si no esta iniciada la sesion y cogemos los datos de la sesion
        // $this->loginModelo->registroFinSesion($this->datos['usuarioSesion']->id_usuario);       // registramos fecha cierre de sesion
        Sesion::cerrarSesion();
        redireccionar('/');
    }


    public function recuperar(){

        
        if($_SERVER['REQUEST_METHOD'] =='POST'){

            $email=trim($_POST['email']);
            $socio=trim($_POST['socio']);


            if($this->loginModelo->recuperar($socio)){

                $recuperar=$this->loginModelo->recuperar($socio);
                
                    if ($recuperar->email==$email){

                                $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                                $password = substr(str_shuffle($caracteres), 0, 8 );

                                $this->loginModelo->cambiarPass($password,$socio);
                        
                                    $mail = new PHPMailer();

                                    try {
                                    // // //  Configuracion SMTP
                                    // $mail->SMTPDebug =2;
                                        $mail->isSMTP();                                       // Activar envio SMTP
                                        $mail->Host  = 'smtp.gmail.com';                       // Servidor SMTP
                                        $mail->SMTPAuth  = true;                               // Identificacion SMTP
                                        $mail->Username  = 'sbr.design.reto@gmail.com';              // Usuario SMTP
                                    //      //$mail->Password  = 'sbrdesign1234';	  
                                        $mail->Password = 'ncrihzkexawuolwn';                // Contraseña SMTP
                                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                        $mail->Port  = 587;
                                        
                                    // // // CONFIGURACION CORREO
                                        $mail->setFrom('sbr.design.reto@gmail.com');   // Remitente del correo
                                        
                                        $mail->addAddress($email);
                                        $mail->isHTML(true);
                                        $mail->Subject = 'Recuperacion de contraseña';
                                        $mail->Body  = 'Tus nuevas credenciales para la aplicacion del TRAGAMILLAS son:'."<br><br>". 
                                                        'USUARIO: '.$email. "<br>" .
                                                        'CONTRASEÑA: '.$password;
                                        
                                        $mail->send();

                                        echo '<script type="text/javascript">alert("Hemos enviado un mail con tus nuevas credenciales");
                                        window.location.assign("");
                                        </script>'; 
                        
                                    } catch (Exception $e) {
                                        echo "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
                                    }

                            }else{
                                echo '<script type="text/javascript">alert("El email y el usuario no coinciden. Intentelo de nuevo");
                                </script>'; 
                               
                            }
                            //redireccionar('/login');

                 }else{
                    echo '<script type="text/javascript">alert("El email y el usuario no coinciden. Intentelo de nuevo");
                    window.location.assign("");
                    </script>'; 
                    
                }
                //redireccionar('/login');

        }else{
            //   $this->datos['entidad'] = (object)[
            //     'id_entidad'=>'',
            //     'nombre'=>'',
            //     'tipo'=>'',
            // ];
            // $this->datos["nuevo"]="ENTIDADES";
            // $this->vista('administradores/crudEntidades/nueva_entidad',$this->datos);
           
         }


       
    
    }

}
