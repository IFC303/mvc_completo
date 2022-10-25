<?php


class Admin extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->adminModelo = $this->modelo('AdminModelo');
        $this->externoModelo = $this->modelo('ExternoModelo');
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

        $id=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->adminModelo->obtenerDatosId($id);

        $this->vista('administradores/inicio', $this->datos);
    }


    public function modi_datos(){

        $this->datos['rolesPermitidos'] = [1];   
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }
       
        $id=$this->datos['usuarioSesion']->id_usuario;
        $datosUser=$this->adminModelo->obtenerDatosId($id);

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (($_FILES['editarFoto']['name'])==''){
                $foto=$datosUser[0]->foto;
            }else{
                $foto=$_FILES['editarFoto']['name'];
                $foto=$id.'.jpg';
            }

            
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
                'password' => trim($_POST['password']),  
                'foto'=>$foto
            ];
            

            if ($this->adminModelo->editar_datos($nuevo,$id,$datosUser)) {
                $directorio="C:/xampp/htdocs/tragamillas/public/img/fotosPerfil/";       
                copy($_FILES['editarFoto']['tmp_name'], $directorio.$id.'.jpg');
                chmod($directorio.$id.'.jpg',0777);
                redireccionar('/admin');
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
                'password' => '',  
                'foto'=>''   
            ];

            $this->vista('administradores/usuario',$this->datos);
        }
    }





// ************************************* SOLICITUDES SOCIOS **************************************//

    public function crud_solicitudes_socios()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $verSoli = $this->adminModelo->obtenerSolicitudesSocios();
        $this->datos['soliSocio'] = $verSoli;
        $this->datos['notificaciones'][3]= "SOCIOSSOL";
        $this->vista('administradores/solicitudes/socios', $this->datos);
    }


     public function aceptar_solicitudes_socios($id){

        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;



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


            if ($this->adminModelo->aceptar_solicitudes_socios($aceptarSocio)) {

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
   

    public function borrar_solicitudes_socios($datBorrar)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->adminModelo->borrar_solicitudes_socios($datBorrar)) {
                redireccionar('/admin/crud_solicitudes_socios');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

   
    //   public function aceptar_solicitudes_seleccionadas_socios()
    // { 

    //     $notific = $this->notificaciones();
    //     $this->datos['notificaciones'] = $notific;

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $datAceptar= trim($_POST["aceptarMas"]);
    //         $datAceptar = explode ( ',', $datAceptar);
    //         if ($this->AdminModelo->aceptar_solicitudes_seleccionadas_socios($datAceptar)) {
    //             redireccionar('/admin/crud_solicitudes_socios');
    //         } else {
    //             die('Algo ha fallado!!!');
    //         }
    //     }
    // }

    // public function borrar_solicitudes_seleccionadas_socios()
    // {
    //     $notific = $this->notificaciones();
    //     $this->datos['notificaciones'] = $notific;

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $datBorrar= trim($_POST["borrarMas"]);
    //         $datBorrar = explode ( ',', $datBorrar);
    //         if ($this->AdminModelo->borrar_solicitudes_seleccionadas_socios($datBorrar)) {
    //             redireccionar('/admin/crud_solicitudes_socios');
    //         } else {
    //             die('Algo ha fallado!!!');
    //         }
    //     }
    // }



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



// ************************************* SOLICITUDES EVENTOS **************************************//

     


    // public function aceptar_solicitudes_EvenSoci($datAceptar)
    // {
    //     $notific = $this->notificaciones();
    //     $this->datos['notificaciones'] = $notific;

    //     $datAceptar = explode ( '_', $datAceptar);

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         if ($this->AdminModelo->aceptar_solicitudes_EvenSoci($datAceptar)) {
    //             redireccionar('/admin/crud_solicitudes_eventos/socio');
    //         } else {
    //             die('Algo ha fallado!!!');
    //         }
    //     }
    // }


}
