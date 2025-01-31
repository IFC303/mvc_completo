<?php


class Externo extends Controlador{


    public function enviado(){
        $this->vista('externo/enviado', $this->datos);
    }



    public function __construct(){
        // Sesion::iniciarSesion($this->datos);

        // $this->datos['rolesPermitidos'] = [1];       
        // if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        //     redireccionar('/');
        // }

        $this->adminModelo = $this->modelo('AdminModelo');
        $this->externoModelo = $this->modelo('ExternoModelo');
    }


//  //NOTIFICACIONES
//  public function notificaciones()
//  {
//      $notific[0] = $this->adminModelo->notSocio();
//      $notific[1] = $this->adminModelo->notGrupo();
//      $notific[2] = $this->adminModelo->notEventos();
//     // $notific[3] ="ENTIDADES";
     
//      return $notific;
//  }

 public function index(){
    // $notific = $this->notificaciones();
    // $this->datos['notificaciones'] = $notific;
    $this->vista('externo/formulario_socio',$this->datos);
}




    public function formulario_socio(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

            if ($this->externoModelo->anadirSoliSocio($anaSoli)) {
                redireccionar('/externo/enviado');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->datos['tallas'] = $this->externoModelo->obtener_tallas();
            $this->vista('externo/formulario_socio', $this->datos);
        }
    }




    
     public function formulario_evento(){

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
                 'foto'=>$_FILES['subirFoto']['name'] 
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




     public function formulario_escuela(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $anaSoli = [       
                'dniUsuAna' => trim($_POST["dniAtl"]),        
                'nomUsuAna' => trim($_POST["nomAtl"]),
                'apelUsuAna' => trim($_POST["apelAtl"]), 
                'cccUsuAna' => trim($_POST["ccc"]),             
                'fecUsuAna' => trim($_POST["fecha"]),
                'emaUsuAna' => trim($_POST["email"]),
                'telUsuAna' => trim($_POST["telf"]),  
                'direccionUsuAna' => trim($_POST["direc"]),
                'gir' => trim($_POST["gir"]),
                'cat' => trim($_POST["cat"]),
                'grup' => trim($_POST["grup"]),
                'primerAnoSocio' => trim($_POST["priSocio"]),
                'nom_pa' =>  trim($_POST['nomPa']),
                'ape_pa' => trim ($_POST['apePa']),
                'dni_pa' => trim ($_POST['dniPa']),
                'pago'=>$_FILES['pago']['name'],   
                'foto'=>$_FILES['foto']['name']               
            ];

            if ($this->externoModelo->soli_escuela($anaSoli)) {
                redireccionar('/externo/enviado');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->datos['categorias'] = $this->externoModelo->obtener_categoria();
            $this->datos['grupos'] = $this->externoModelo->obtener_grupos(); 
            $this->vista('externo/formulario_escuela', $this->datos);
        }
    }







}
