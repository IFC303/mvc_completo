<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once RUTA_APP.'/librerias/PHPMailer/Exception.php';
require_once RUTA_APP.'/librerias/PHPMailer/PHPMailer.php';
require_once RUTA_APP.'/librerias/PHPMailer/SMTP.php';

class Admin extends Controlador
{
    public function __construct()
    {
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->AdminModelo = $this->modelo('AdminModelo');
    }
    //NOTIFICACIONES
    public function notificaciones()
    {
        $notific[0] = $this->AdminModelo->notSocio();
        $notific[1] = $this->AdminModelo->notGrupo();
        $notific[2] = $this->AdminModelo->notEventos();
        $notific[3] = $this->AdminModelo->notPedidos();
        return $notific;
    }

    public function index()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $this->vista('administradores/inicio', $this->datos);
    }

    //CRUDS USUARIOS
    public function crud_admin()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $verUsu = $this->AdminModelo->obtenerUsuarios(1);
        $this->datos['usuAdmin'] = $verUsu;
        $this->datos['idTengo'] = "1";
        $this->vista('administradores/cruds/crudAdmin', $this->datos);
    }

    public function crud_entrenadores()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $verUsu = $this->AdminModelo->obtenerUsuarios(2);
        $this->datos['usuAdmin'] = $verUsu;
        $this->datos['idTengo'] = "2";
        $this->vista('administradores/cruds/crudAdmin', $this->datos);
    }

    public function crud_socios()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $verUsu = $this->AdminModelo->obtenerUsuarios(3);
        $this->datos['usuAdmin'] = $verUsu;
        $this->datos['idTengo'] = "3";
        $this->vista('administradores/cruds/crudAdmin', $this->datos);
    }


    public function borrarUsuario($idUsuTengo)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $idUsu=(substr($idUsuTengo, strpos($idUsuTengo,'-')+strlen('-')));
        $usuVer=(substr($idUsuTengo, 0, strpos($idUsuTengo,'-')));
  
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->AdminModelo->borrarUsuario($idUsu)) {
                if($usuVer=="1"){
                    redireccionar('/admin/crud_admin');
                }elseif($usuVer=="2"){
                    redireccionar('/admin/crud_entrenadores');
                }elseif($usuVer=="3"){
                    redireccionar('/admin/crud_socios');
                }elseif($usuVer=="4"){
                    redireccionar('/admin/crud_tiendas');
                }else{
                    redireccionar('/');
                }
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

    public function editarUsuario($idEditTengo)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $idEdit=(substr($idEditTengo, strpos($idEditTengo,'-')+strlen('-')));
        $usuVer=(substr($idEditTengo, 0, strpos($idEditTengo,'-')));
        
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $ediUsu = [
                'idEdit' => trim($idEdit),
                'dniEdit' => trim($_POST["editDni"]),
                'nomEdit' => trim($_POST["editNombre"]),
                'apelEdit' => trim($_POST["editApellidos"]),
                'fecEdit' => trim($_POST["editFecha"]),
                'telEdit' => trim($_POST["editTlf"]),
                'emaEdit' => trim($_POST["editEmail"]),
                'direcEdit' => trim($_POST["editDirec"]),
                'passEdit' => trim($_POST["editPas"]),
                'CCCEdit' => trim($_POST["editCCC"]),
                'TallaEdit' => trim($_POST["editTalla"]),
                'FotoEdit' => trim($_POST["editFoto"]),
                'ActEdit' => trim($_POST["editAct"]),
                'RolEdit' => trim($_POST["editRol"]),
                'GirEdit' => trim($_POST["editGir"]),
                'SueldoEdit' => trim($_POST["editSueldo"]),
            ];

            if ($this->AdminModelo->editarUsuario($ediUsu)) {
                if($usuVer=="1"){
                    redireccionar('/admin/crud_admin');
                }elseif($usuVer=="2"){
                    redireccionar('/admin/crud_entrenadores');
                }elseif($usuVer=="3"){
                    redireccionar('/admin/crud_socios');
                }elseif($usuVer=="4"){
                    redireccionar('/admin/crud_tiendas');
                }else{
                    redireccionar('/');
                }
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->vista('administradores/cruds/nuevoUsuario', $this->datos);
        }
    }

    public function nuevoUsuario($usuVer)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $anaUsu = [
                'socioUsuAna' => trim($_POST["socio"]),
                'dniUsuAna' => trim($_POST["dniAtl"]),
                'nomUsuAna' => trim($_POST["nombre"]),
                'apelUsuAna' => trim($_POST["apellidos"]),
                'fecUsuAna' => trim($_POST["fecha"]),
                'direccionUsuAna' => trim($_POST["direccion"]),
                'telUsuAna' => trim($_POST["telf"]),
                'emaUsuAna' => trim($_POST["email"]),
                'passUsuAna' => trim($_POST["pass"]),
                'sueldoUsuAna' => trim($_POST["sueldo"]),
                'rolUsuAna'=> trim($usuVer),
            ];

            if ($this->AdminModelo->anadirUsuario($anaUsu)) {
                if($usuVer=="1"){
                    redireccionar('/admin/crud_admin');
                }elseif($usuVer=="2"){
                    redireccionar('/admin/crud_entrenadores');
                }elseif($usuVer=="3"){
                    redireccionar('/admin/crud_socios');
                }elseif($usuVer=="4"){
                    redireccionar('/admin/crud_tiendas');
                }else{
                    redireccionar('/');
                }
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->datos["idTengo"]=$usuVer;
            $this->datos["nuevo"]="nuevo";
            $this->vista('administradores/cruds/nuevoUsuario', $this->datos);
        }
    }



// ************************************* SOLICITUDES SOCIOS **************************************//

    public function crud_solicitudes_socios()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $verSoli = $this->AdminModelo->obtenerSolicitudesSocios();
        $this->datos['soliSocio'] = $verSoli;
        $this->datos['notificaciones'][3]= "SOCIOSSOL";
        $this->vista('administradores/solicitudes/socios', $this->datos);
    }


     public function aceptar_solicitudes_socios($id){

        //hay que enviar mail al socio con la contraseña : nombreNSolicitud
        //var_dump($datAceptar);
        //exit;
        $datos = trim($_POST["datAceptar"]);
        //echo($eso);
        //exit;

        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $datAceptar = explode ( '_', $datos);
        
        $pass='Password: :'.$datAceptar[2].$datAceptar[0];
        $correo='Usuario: '.$datAceptar[7];

        //echo $pass;
        //echo $correo;
        //exit;


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($this->AdminModelo->aceptar_solicitudes_socios($datAceptar)) {


                    redireccionar('/admin/crud_solicitudes_socios');



                    $mail = new PHPMailer();


                // //me llega un string y lo paso a array con explode
                // // $destinatario = explode(",",($_POST['destinatario']));
                // // echo print_r($destinatario);   
    
                // // $asunto = ($_POST['asunto']);
                // // echo $asunto;
                // // $mensaje =($_POST['mensaje']);
                // // echo $mensaje;
        
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
    
                //     //  foreach($destinatario as $correo){
                //     //      echo $correo ."<br>";
                //     //       $mail->addAddress($correo); // Email destinatario
                //     //  }
                      
                      $mail->addAddress('sielma712@gmail.com');
                      $mail->isHTML(true);
                      $mail->Subject = 'Aprobacion solicitud de socio';
                      $mail->Body  = 'Bienvenido al club Tragamillas Alcañiz!Tu solicitud de socio ha sido aprobada. Aqui tienes tu usuario y 
                                        contraseña para acceder a la aplicacion del Tragamillas Alcañiz: '.$pass.''.$correo;
                      
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
   

    public function borrar_solicitudes_socios($datBorrar)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->AdminModelo->borrar_solicitudes_socios($datBorrar)) {
                redireccionar('/admin/crud_solicitudes_socios');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

   
      public function aceptar_solicitudes_seleccionadas_socios()
    { 

        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datAceptar= trim($_POST["aceptarMas"]);
            $datAceptar = explode ( ',', $datAceptar);
            if ($this->AdminModelo->aceptar_solicitudes_seleccionadas_socios($datAceptar)) {
                redireccionar('/admin/crud_solicitudes_socios');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

    public function borrar_solicitudes_seleccionadas_socios()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datBorrar= trim($_POST["borrarMas"]);
            $datBorrar = explode ( ',', $datBorrar);
            if ($this->AdminModelo->borrar_solicitudes_seleccionadas_socios($datBorrar)) {
                redireccionar('/admin/crud_solicitudes_socios');
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

        $verSoli = $this->AdminModelo->obtenerSolicitudesGrupos();
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
            if ($this->AdminModelo->aceptar_solicitudes_grupos($datAceptar)) {
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
            if ($this->AdminModelo->borrar_solicitudes_grupos($datBorrar)) {
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
            if ($this->AdminModelo->aceptar_solicitudes_seleccionadas_grupos($datAceptar)) {
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
    
            if ($this->AdminModelo->borrar_solicitudes_seleccionadas_grupos($datBorrar)) {
                redireccionar('/admin/crud_solicitudes_grupos');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }



// ************************************* SOLICITUDES EVENTOS **************************************//

    
    //SOLICITUDES SELECCIONADAS EVENTOS
    public function borrar_solicitudes_seleccionadas_eventosSoci()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datBorrar= trim($_POST["borrarMas"]);
            $datBorrar = explode ( ',', $datBorrar);

            if ($this->AdminModelo->borrar_solicitudes_seleccionadas_eventosSoci($datBorrar)) {
                redireccionar('/admin/crud_solicitudes_eventos/socio"');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

    public function borrar_solicitudes_seleccionadas_eventosExter()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datBorrar= trim($_POST["borrarMas"]);
            $datBorrar = explode ( ',', $datBorrar);

            if ($this->AdminModelo->borrar_solicitudes_seleccionadas_eventosExter($datBorrar)) {
                redireccionar('/admin/crud_solicitudes_eventos/externo');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

    public function aceptar_solicitudes_seleccionadas_eventosSoci()
    { 

        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datAceptar= trim($_POST["aceptarMas"]);
            $datAceptar = explode ( ',', $datAceptar);

            if ($this->AdminModelo->aceptar_solicitudes_seleccionadas_eventosSoci($datAceptar)) {
                redireccionar('/admin/crud_solicitudes_eventos/socio');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

    public function aceptar_solicitudes_seleccionadas_eventosExter()
    { 

        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datAceptar= trim($_POST["aceptarMas"]);
            $datAceptar = explode ( ',', $datAceptar);

            if ($this->AdminModelo->aceptar_solicitudes_seleccionadas_eventosExter($datAceptar)) {
                redireccionar('/admin/crud_solicitudes_eventos/externo');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }




    //SOLICITUD EVENTOS
    public function crud_solicitudes_eventos($sociExter)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $verSoliExter = $this->AdminModelo->obtenerSolicitudesEvenExter();
        $verSoliSoci = $this->AdminModelo->obtenerSolicitudesEvenSoci();
        if($sociExter=="socio"){
            $this->datos['soliEventos'] = $verSoliSoci;
        }elseif($sociExter=="externo"){
            $this->datos['soliEventos'] = $verSoliSoci;
        }
        $this->datos['radioCheck'] = $sociExter;
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($_POST["opcion"]=="socio") {
                $this->datos['soliEventos'] = $verSoliSoci;
                $this->datos['radioCheck'] = "socio";
            } elseif($_POST["opcion"]=="externo"){
                $this->datos['soliEventos'] = $verSoliExter;
                $this->datos['radioCheck'] = "externo";
            }
        }
        $this->datos['notificaciones'][3]= "EVENTOSSOL";
        $this->vista('administradores/solicitudes/eventos', $this->datos);
    }

    public function borrar_solicitudes_EvenSoci($datBorrar)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $datBorrar = explode ( '_', $datBorrar);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->AdminModelo->borrar_solicitudes_EvenSoci($datBorrar)) {
                redireccionar('/admin/crud_solicitudes_eventos/socio');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

    public function borrar_solicitudes_EvenExter($datBorrar)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $datBorrar = explode ( '_', $datBorrar);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->AdminModelo->borrar_solicitudes_EvenExter($datBorrar)) {
                redireccionar('/admin/crud_solicitudes_eventos/externo');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }
    
    public function aceptar_solicitudes_EvenExter($datAceptar)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $datAceptar = explode ( '_', $datAceptar);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->AdminModelo->aceptar_solicitudes_EvenExter($datAceptar)) {
                redireccionar('/admin/crud_solicitudes_eventos/externo');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

    public function aceptar_solicitudes_EvenSoci($datAceptar)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $datAceptar = explode ( '_', $datAceptar);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->AdminModelo->aceptar_solicitudes_EvenSoci($datAceptar)) {
                redireccionar('/admin/crud_solicitudes_eventos/socio');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }


}
