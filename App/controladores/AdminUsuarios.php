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




//*********** NOTIFICACIONES EN EL MENU LATERAL *********************/
public function notificaciones(){
    $notific[0] = $this->adminModelo->notSocio();
    $notific[1] = $this->adminModelo->notGrupo();
    $notific[2] = $this->adminModelo->notEventos();
    $notific[3] = $this->adminModelo->contar_pedidos();
    return $notific;
}


//*********** INDEX *********************/
    public function index(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;
        
        $this->datos['usuarios'] = $this->adminModelo->obtenerUsuarios();
        $this->datos['roles'] = $this->adminModelo->obtenerRoles();
        $this->vista('administradores/usuario',$this->datos);
    }



//*********************************** NUEVO ****************************************/
public function nuevo_usuario(){

    $this->datos['rolesPermitidos'] = [1];   
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($caracteres), 0, 8 );
        $pass=trim($_POST["nombre"]).$password;

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
            'dni_pa' => trim($_POST['dniPa']),
            'pass' =>$pass
        ];

        if ($this->adminModelo->nuevo_usuario($nuevo)) {

            $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $password = substr(str_shuffle($caracteres), 0, 8 );

            $mail = new PHPMailer();

            redireccionar('/adminUsuarios');
            
                try {
                    //Configuracion SMTP
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
                    
                    $mail->addAddress($_POST['email']);
                    $mail->isHTML(true);
                    $mail->Subject = 'Alta como usuario en el CLUB TRAGAMILLAS';
                    $mail->Body  = 'Bienvenido al club Tragamillas Alcañiz! Has sido dado de alta en el club. Aqui tienes tu usuario y cotraseña para acceder a la aplicacion.'."<br><br>". 
                                'USUARIO: '.$_POST['email']. "<br>" .
                                'CONTRASEÑA: '.$pass;
                    
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



//*********************************** EDITAR ****************************************/

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
        $this->vista('administradores/usuario',$this->datos);
    }
}


//*********************************** BORRAR ****************************************/
 
    public function borrarUsuario($id){
        $this->datos['rolesPermitidos'] = [1];   
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

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





  

}