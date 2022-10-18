<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once RUTA_APP.'/librerias/PHPMailer/Exception.php';
require_once RUTA_APP.'/librerias/PHPMailer/PHPMailer.php';
require_once RUTA_APP.'/librerias/PHPMailer/SMTP.php';


class AdminUsuarios extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];       

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->adminModelo = $this->modelo('AdminModelo');
    }

    

    public function index(){
        $this->datos['usuarios'] = $this->adminModelo->obtenerUsuarios();
        $this->datos['roles'] = $this->adminModelo->obtenerRoles();
        $this->vista('administradores/usuario',$this->datos);
    }



 
    public function borrarUsuario($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->adminModelo->borrar_usuario($id)) {
                //$directorio="/var/www/html/tragamillas/public/img/fotosPerfil/";
                $directorio="C:/xampp/htdocs/tragamillas/public/img/fotosPerfil/"; 
                unlink($directorio.$id.'.jpg');
                redireccionar('/adminUsuarios');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->vista('administradores/usuario', $this->datos);
        }
    }



    public function nuevo_usuario(){

        $this->datos['rolesPermitidos'] = [1];   
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
            $nuevo = [
                'nombre' => trim($_POST["nombre"]),
                'apellidos' => trim($_POST["apellidos"]),
                'dni' => trim($_POST["dni"]),
                'fecha_naci' => trim($_POST["fecha_naci"]),
                'telefono' => trim($_POST["telefono"]),
                'email' => trim($_POST["email"]),
                'direccion' => trim($_POST["direccion"]),
                'ccc' => trim($_POST["ccc"]),
                'talla' => trim($_POST["talla"]),
                'id_rol' => trim($_POST['rol']),
                'pri_socio' => trim($_POST['pri_socio']),
                'nom_pa' => trim($_POST['nomPa']),
                'ape_pa' => trim($_POST['apePa']),
                'dni_pa' => trim($_POST['dniPa'])
            ];

            if ($this->adminModelo->nuevo_usuario($nuevo)) {

                $mail = new PHPMailer();

                redireccionar('/adminUsuarios');
                
                  try {
                // // //  Configuracion SMTP
                      $mail->SMTPDebug =2;
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
                      
                      $mail->addAddress($_POST['email']);
                      $mail->isHTML(true);
                      $mail->Subject = 'Alta como usuario en el CLUB TRAGAMILLAS';
                      $mail->Body  = 'Bienvenido al club Tragamillas Alcañiz! Has sido dado de alta en el club. Aqui tienes tu usuario y cotraseña para acceder a la aplicacion.'."<br><br>". 
                                    'USUARIO: '.$_POST['email']. "<br>" .
                                    'CONTRASEÑA: '.$_POST['nombre'].'-'.$_POST['telefono'];
                      
                      $mail->send($correo);
     
                  } catch (Exception $e) {
                      echo "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
                  }
                    redireccionar('/adminUsuarios');
            } else {
                die('Algo ha fallado!!!');
            }
            
        } else {
            $this->datos['usuario'] = (object) [
                'nombre' => '',
                'apellidos' => '',
                'dni' => '',
                'fecha_naci' => '',
                'telefono' => '',
                'email' => '',
                'direccion' => '',
                'ccc' => '',
                'talla' => '', 
                'id_rol' => '', 
                'pri_socio' => '',
                'nom_pa' => '',
                'ape_pa' => '',
                'dni_pa' => ''          
            ];

            $this->vista('administradores/usuario',$this->datos);
        }
    }



    public function editar_usuario($id){

        $this->datos['rolesPermitidos'] = [1];   
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
            $nuevo = [
                'nombre' => trim($_POST["nombre"]),
                'apellidos' => trim($_POST["apellidos"]),
                'dni' => trim($_POST["dni"]),
                'fecha_naci' => trim($_POST["fecha_naci"]),
                'telefono' => trim($_POST["telefono"]),
                'email' => trim($_POST["email"]),
                'direccion' => trim($_POST["direccion"]),
                'ccc' => trim($_POST["ccc"]),
                'talla' => trim($_POST["talla"]),
                'id_rol' => trim($_POST['rol']),
                'pri_socio' => trim($_POST['pri_socio']),
                'nom_pa' => trim($_POST['nomPa']),
                'ape_pa' => trim($_POST['apePa']),
                'dni_pa' => trim($_POST['dniPa'])    
            ];

            if ($this->adminModelo->editar_usuario($nuevo,$id)) {
                redireccionar('/adminUsuarios');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->datos['usuario'] = (object) [
                'nombre' => '',
                'apellidos' => '',
                'dni' => '',
                'fecha_naci' => '',
                'telefono' => '',
                'email' => '',
                'direccion' => '',
                'ccc' => '',
                'talla' => '',  
                'id_rol' => '', 
                'pri_socio' => '',  
                'nom_pa' => '',
                'ape_pa' => '',
                'dni_pa' => ''       
            ];

            $this->vista('administradores/usuario',$this->datos);
        }
    }


}