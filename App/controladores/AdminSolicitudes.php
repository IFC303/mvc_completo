<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once RUTA_APP.'/librerias/PHPMailer/Exception.php';
require_once RUTA_APP.'/librerias/PHPMailer/PHPMailer.php';
require_once RUTA_APP.'/librerias/PHPMailer/SMTP.php';


class AdminSolicitudes extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];      

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->adminModelo = $this->modelo('AdminModelo');
        $this->solicitudModelo = $this->modelo('Solicitud');
        $this->eventoModelo = $this->modelo('Evento');
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
    }



// ************************************* SOLICITUDES SOCIOS **************************************//

    public function socios(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $verSoli = $this->solicitudModelo->solicitudes_socio();
        $this->datos['soliSocio'] = $verSoli;

        $this->vista('administradores/solicitudes/socios', $this->datos);
    }



    public function borrar_socio($id){
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->solicitudModelo->borrar_socio($id)) {
                redireccionar('/adminSolicitudes/socios');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }



    public function editar_socio($id){
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $editar = [
                'nombre' => trim($_POST['nombre']),
                'apellidos' => trim($_POST['apellidos']),
                'dni'=> trim($_POST['dni']),
                'fecha' => trim($_POST['fecha_naci']),
                'telefono'=>trim($_POST['tlf']),
                'email' => trim($_POST['email']),
                'direccion' => trim($_POST['direccion']), 
                'cuenta' => trim($_POST['cuenta']),
                'talla' => trim($_POST['talla']),  
                'socio' => trim($_POST['pri_socio']), 
                'nom_pa' => trim($_POST['nom_pa']),
                'ape_pa' => trim($_POST['ape_pa']),  
                'dni_pa' => trim($_POST['dni_pa'])
            ];
    
            if ($this->solicitudModelo->editar_socio($editar,$id)) {
                redireccionar('/adminSolicitudes/socios');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }




     public function aceptar_socio($id){
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $socio=trim($_POST['verEsSocio']);
            if($socio=='Si'){
                $socio='1';
            }else{
                $socio='2';
            }

            $aceptarSocio = [
                'id' => $id,
                'nombre' => trim($_POST['verNombre']),
                'apellidos' => trim($_POST['verApellidos']),
                'dni'=> trim($_POST['verDni']),
                'fecha' => trim($_POST['verFecha']),
                'telefono'=>trim($_POST['verTlf']),
                'email' => trim($_POST['verEmail']),
                'direccion' => trim($_POST['verDirec']), 
                'cuenta' => trim($_POST['verCCC']),
                'talla' => trim($_POST['verTalla']),  
                'socio' => $socio,
                'nom_pa' => trim($_POST['nom_pa']),
                'ape_pa' => trim($_POST['ape_pa']),  
                'dni_pa' => trim($_POST['dni_pa'])
            ];

            if ($this->solicitudModelo->aceptar_socio($aceptarSocio)) {

                    $mail = new PHPMailer();
                    redireccionar('/adminSolicitudes/socios');
        
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
                      
                      $mail->addAddress($aceptarSocio['email']);
                      $mail->isHTML(true);
                      $mail->Subject = 'Aprobacion solicitud de socio CLUB TRAGAMILLAS';
                      $mail->Body  = 'Bienvenido al club Tragamillas Alcañiz! Tu solicitud de socio ha sido aprobada. Aqui tienes tu usuario y cotraseña para acceder a la aplicacion.'."<br><br>". 
                                    'USUARIO: '.$aceptarSocio['email']. "<br>" .
                                    'CONTRASEÑA: '.$aceptarSocio['nombre'].$aceptarSocio['id'];
                      
                      $mail->send($correo);
                  
                    //   echo '<script type="text/javascript">alert("Solicitud aceptada.Enviado email al usuario con usuario y password.");
                    //  window.location.assign("adminMensajeria/mensajeria.php");
                    //  </script>'; 
     
                  } catch (Exception $e) {
                      echo "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
                  }

                 }else{
                     die('Algo ha fallado!!!');
                }
        }else{
            
            $this->vista('administradores/solicitudes/socios', $this->datos);
         }

}   


// ************************************* SOLICITUDES EVENTOS **************************************//
   
public function eventos(){
    $notific = $this->notificaciones();
    $this->datos['notificaciones'] = $notific;

    $verSoli = $this->solicitudModelo->solicitudes_eventos();
    $this->datos['soliEvento'] = $verSoli;
    $this->datos['eventos']=$this->eventoModelo->obtenerEventos();
    $this->vista('administradores/solicitudes/eventos', $this->datos);
}


    
public function borrar_evento($id){
    $this->datos['rolesPermitidos'] = [1];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($this->solicitudModelo->borrar_evento($id)) {
            redireccionar('/adminSolicitudes/eventos');
        } else {
            die('Algo ha fallado!!!');
        }
    }
}



public function aceptar_evento($id){
    $this->datos['rolesPermitidos'] = [1];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $aceptarEvento = [
                'id' => $id,
                'fecha' => trim($_POST['fecha']),
                'evento' => trim($_POST['id_evento']), 
                'nombre' => trim($_POST['nombre']),
                'apellidos' => trim($_POST['apellidos']),
                'dni'=> trim($_POST['dni']),
                'f_naci' => trim($_POST['f_naci']),
                'direccion' => trim($_POST['direccion']), 
                'telefono'=>trim($_POST['telefono']),
                'email' => trim($_POST['email'])               
            ];

            if ($this->solicitudModelo->aceptar_evento($aceptarEvento)) {

                    $mail = new PHPMailer();

                    redireccionar('/adminSolicitudes/eventos');

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
                      
                      $mail->addAddress($aceptarEvento['email']);
                      $mail->isHTML(true);
                      $mail->Subject = 'Aprobacion solicitud CLUB TRAGAMILLAS';
                      $mail->Body  = 'Tu solicitud al evento '.$_POST['nombre_evento'].' ha sido aprobada. En breve nos pondremos en contacto contigo para darte mas informacion.';
                                   
                      
                      $mail->send($correo);
                  
                    //   echo '<script type="text/javascript">alert("Solicitud aceptada.Enviado email al usuario con usuario y password.");
                    //  window.location.assign("adminMensajeria/mensajeria.php");
                    //  </script>'; 
     
                  } catch (Exception $e) {
                      echo "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
                  }

                 }else{
                     die('Algo ha fallado!!!');
                }
        }else{
            
            $this->vista('administradores/solicitudes/eventos', $this->datos);
         }
}    


   
public function editar_evento($id){
    $this->datos['rolesPermitidos'] = [1];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $editar = [
            'fecha' => trim($_POST['fecha']),
            'nombre' => trim($_POST['nombre']),
            'apellidos' => trim($_POST['apellidos']),
            'dni'=> trim($_POST['dni']),
            'f_naci' => trim($_POST['f_naci']),
            'telefono'=>trim($_POST['telefono']),
            'email' => trim($_POST['email']),
            'direccion' => trim($_POST['direccion']),
            'evento' => trim($_POST['evento'])
        ];

        if ($this->solicitudModelo->editar_evento($editar,$id)) {
            redireccionar('/adminSolicitudes/eventos');
        } else {
            die('Algo ha fallado!!!');
        }
    }
}







   




// ************************************* SOLICITUDES GRUPOS **************************************//

public function crud_solicitudes_grupos()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $verSoli = $this->adminModelo->obtenerSolicitudesGrupos();
        $this->datos['soliSocioGrupos'] = $verSoli;
        $this->datos['notificaciones'][3]= "GRUPOSSOL";
        $this->vista('administradores/solicitudes/grupos', $this->datos);
    }


        public function aceptar_solicitudes_grupos($datAceptar)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $datAceptar = explode ( '_', $datAceptar);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->adminModelo->aceptar_solicitudes_grupos($datAceptar)) {
                redireccionar('/admin/crud_solicitudes_grupos');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

    public function borrar_solicitudes_grupos($datBorrar)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $datBorrar = explode ( '_', $datBorrar);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->adminModelo->borrar_solicitudes_grupos($datBorrar)) {
                redireccionar('/admin/crud_solicitudes_grupos');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }


    public function aceptar_solicitudes_seleccionadas_grupos()
    { 

        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datAceptar= trim($_POST["aceptarMas"]);
            $datAceptar = explode ( ',', $datAceptar);
            if ($this->adminModelo->aceptar_solicitudes_seleccionadas_grupos($datAceptar)) {
                redireccionar('/admin/crud_solicitudes_grupos');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

    
    public function borrar_solicitudes_seleccionadas_grupos()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datBorrar= trim($_POST["borrarMas"]);
            $datBorrar = explode ( ',', $datBorrar);
    
            if ($this->adminModelo->borrar_solicitudes_seleccionadas_grupos($datBorrar)) {
                redireccionar('/admin/crud_solicitudes_grupos');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }



}
