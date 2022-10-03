<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once RUTA_APP.'/librerias/PHPMailer/Exception.php';
require_once RUTA_APP.'/librerias/PHPMailer/PHPMailer.php';
require_once RUTA_APP.'/librerias/PHPMailer/SMTP.php';





class Externo extends Controlador
{
    public function enviado()
    {
        $this->vista('externo/enviado', $this->datos);
    }





    public function __construct()
    {
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->AdminModelo = $this->modelo('AdminModelo');
        $this->externoModelo = $this->modelo('ExternoModelo');
    }


 //NOTIFICACIONES
 public function notificaciones()
 {
     $notific[0] = $this->AdminModelo->notSocio();
     $notific[1] = $this->AdminModelo->notGrupo();
     $notific[2] = $this->AdminModelo->notEventos();
    // $notific[3] ="ENTIDADES";
     
     return $notific;
 }

 public function index(){
    $notific = $this->notificaciones();
    $this->datos['notificaciones'] = $notific;
    $this->vista('administradores/solicitudes',$this->datos);
}




    public function formulario_socio()
    {
        $this->ExternoModelo = $this->modelo('ExternoModelo');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            var_dump($_POST);

            $anaSoli = [
                
                'nomUsuAna' => trim($_POST["nomAtl"]),
                'apelUsuAna' => trim($_POST["apelAtl"]),               
                'fecUsuAna' => trim($_POST["fecha"]),
                'dniUsuAna' => trim($_POST["dniAtl"]),
                'nom_pa' =>  trim($_POST['nomPa']),
                'ape_pa' => trim ($_POST['apePa']),
                'dni_pa' => trim ($_POST['dniPa']),
                'emaUsuAna' => trim($_POST["email"]),
                'direccionUsuAna' => trim($_POST["direc"]),
                'telUsuAna' => trim($_POST["telf"]),                
                'cccUsuAna' => trim($_POST["ccc"]),
                'tallaUsuAna' => trim($_POST["talla"]),
                'primerAnoSocio' => trim($_POST["priSocio"]),

            ];

            if ($this->ExternoModelo->anadirSoliSocio($anaSoli)) {
                redireccionar('/externo/enviado');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->vista('externo/formulario_socio', $this->datos);
        }
    }


    // public function form_es()
    // {
    //     $this->ExternoModelo = $this->modelo('ExternoModelo');

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         var_dump($_POST);

    //         $anaSoli = [
                
    //             'nomUsuAna' => trim($_POST["nomAtl"]),
    //             'apelUsuAna' => trim($_POST["apelAtl"]),               
    //             'fecUsuAna' => trim($_POST["fecha"]),
    //             'dniUsuAna' => trim($_POST["dniAtl"]),
    //             'nom_pa' =>  trim($_POST['nomPa']),
    //             'ape_pa' => trim ($_POST['apePa']),
    //             'dni_pa' => trim ($_POST['dniPa']),
    //             'emaUsuAna' => trim($_POST["email"]),
    //             'direccionUsuAna' => trim($_POST["direc"]),
    //             'telUsuAna' => trim($_POST["telf"]),                
    //             'cccUsuAna' => trim($_POST["ccc"]),
    //             'tallaUsuAna' => trim($_POST["talla"]),
    //             'primerAnoSocio' => trim($_POST["priSocio"]),

    //         ];

    //         if ($this->ExternoModelo->anadirSoliSocio($anaSoli)) {
    //             redireccionar('/externo/enviado');
    //         } else {
    //             die('Algo ha fallado!!!');
    //         }
    //     } else {
    //         $this->vista('externo/form_es', $this->datos);
    //     }
    // }


//******************************************** FORMULARIO EVENTO **********************************************************/

//****************RECOGE LOS DATOS DEL FOMULARIO *****************/
     public function formulario_evento(){

         $this->externoModelo = $this->modelo('ExternoModelo');

         if ($_SERVER['REQUEST_METHOD'] == 'POST') {

             $soli_eve = [                
                 'nombre' => trim($_POST["nombre"]),
                 'apellidos' => trim($_POST["apellidos"]),
                 'fecha_naci' => trim($_POST["fecha_naci"]),
                 'dni' => trim($_POST["dni"]),
                 'direccion' => trim($_POST["direccion"]),
                 'telefono' => trim($_POST["telefono"]),
                 'email' => trim($_POST["email"]),
                 'evento' => trim($_POST["evento"]),    
                
            ];


             if ($this->externoModelo->anadir_soli_eve($soli_eve)) {
                 redireccionar('/externo/enviado');
             } else {
                 die('Algo ha fallado!!!');
             }
         } else {
             $eventos = $this->externoModelo->obtenerEventos();
             $this->datos['eventos'] = $eventos;
             $this->vista('externo/formulario_evento', $this->datos);
         }
     }



// //SOLICITUD EVENTOS
  public function crud_solicitudes_eventos(){

    $notific = $this->notificaciones();
    $this->datos['notificaciones'] = $notific;

    
    $this->externoModelo = $this->modelo('ExternoModelo');
    $this->datos['soliEvento']=$this->externoModelo->obtener_soli_eventos();
   // $this->datos['notificaciones'][2]= "EVENTOSSOL";
    $this->vista('administradores/solicitudes/eventos', $this->datos);
  
     
  }

//*********** BORRRA SOLICITUD ************/
  public function borrar_soli_eve($id){

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          if ($this->externoModelo->borrar_soli_eve($id)) {
             redireccionar('/externo/crud_solicitudes_eventos');
          } else {
              die('Algo ha fallado!!!');
          }
    }else{
        $this->datos['soliEvento'] = $this->externoModelo->obtener_soli_eventos();
        $this->vista('administradores/solicitudes/eventos', $this->datos);
      }
    }


//*********** ACEPTAR SOLICITUD ************/
    public function aceptar_soli_even($id){

        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;


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
                'email' => trim($_POST['email']),
               
            ];

            if ($this->externoModelo->aceptar_soli_even($aceptarEvento)) {

                    redireccionar('/externo/crud_solicitudes_eventos');

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
                      
                      $mail->addAddress($aceptarEvento['email']);
                      $mail->isHTML(true);
                      $mail->Subject = 'Aprobacion solicitud CLUB TRAGAMILLAS';
                      $mail->Body  = 'Tu solicitud ha sido aprobada.';
                                   
                      
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
   


}
