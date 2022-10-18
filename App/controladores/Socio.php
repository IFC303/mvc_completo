<?php

class Socio extends Controlador{



    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }
        $this->SocioModelo = $this->modelo('SocioModelo');
        $this->equipacionModelo = $this->modelo('Equipacion');     
        $this->eventoModelo = $this->modelo('Evento');   
    }



// *********** PAGINA PRINCIPAL SOCIO ***********  
    public function index(){
        $this->vista('socios/inicio', $this->datos);
    }



// *********** MODIFICAR DATOS ***********  
    public function modificarDatos(){

        $nombrePagina = "MODIFICAR DATOS";
        $tituloPagina = "MODIFICAR DATOS";
        $this->datos['nombrePagina']=$nombrePagina;
        $this->datos['tituloPagina']=$tituloPagina;
        
        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;
        $datosUser = $this->SocioModelo->obtenerDatosSocioId($idUsuarioSesion);

        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }       


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $directorio="C:/xampp/htdocs/tragamillas/public/img/fotosPerfil/";       
            copy($_FILES['foto']['tmp_name'], $directorio.$idUsuarioSesion.'.jpg');

            $editarDatos = [
                'telefonoEdit' => trim($_POST["telefono"]),
                'direccion' => trim($_POST["direccion"]),
                'emailEdit' => trim($_POST["correo"]),
                'cccEdit' => trim($_POST["cuenta"]),
                'passwEdit' => trim($_POST["password"]),
                'tallaEdit' => trim($_POST["talla"]),
                'fotoEdit' => $_FILES['foto']['name'],
            ];
      
            $directorio="C:/xampp/htdocs/tragamillas/public/img/fotosPerfil/";       
            copy($_FILES['foto']['tmp_name'], $directorio.$idUsuarioSesion.'.jpg');
            chmod($directorio.$idUsuarioSesion.'.jpg',0777);


             if ($this->SocioModelo->actualizarUsuario($editarDatos, $idUsuarioSesion, $datosUser)) {
                 redireccionar('/socio');
             } else {
                die('Algo ha fallado!!!');
             }
        } else {
            $datosUser = $this->SocioModelo->obtenerDatosSocioId($idUsuarioSesion);
            $this->datos['usuarios']=$datosUser;        
            $this->vista('socios/modificarDatos', $this->datos);
        }       
    }



// *********** VER MARCAS ***********  
    public function verMarcas(){

        $nombrePagina = "VER MARCAS";
        $tituloPagina = "MARCAS PERSONALES";
        $this->datos['nombrePagina']=$nombrePagina;
        $this->datos['tituloPagina']=$tituloPagina;

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $marcas = $this->SocioModelo->obtenerMarcasId($idUsuarioSesion);
        $this->datos['usuarios']=$marcas;
        $this->vista('socios/verMarcas', $this->datos);
    }


// *********** VER LICENCIAS ***********  
    public function licencias(){

        $nombrePagina = "SUBIR LICENCIAS";
        $tituloPagina = "MIS LICENCIAS";        
        $this->datos['nombrePagina']=$nombrePagina;
        $this->datos['tituloPagina']=$tituloPagina;

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $licencias = $this->SocioModelo->obtenerLicenciasUsuarioId($idUsuarioSesion);
        $this->datos['usuarios']=$licencias;     
        $this->vista('socios/licencias', $this->datos);
    }








    //************* EQUIPACION *****************/
    public function equipacion(){
      

        $tituloPagina = "PEDIR EQUIPACION";
        $this->datos['tituloPagina']=$tituloPagina;

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;
        $this->datos['equipacion'] = $this->equipacionModelo->obtenerEquipaciones();

        //$marcas = $this->SocioModelo->obtenerMarcasId($idUsuarioSesion);
        //$this->datos['usuarios']=$marcas;

        $this->vista('socios/equipacion', $this->datos);
    }


    public function pedir_equipacion(){

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $pedidoEquipacion = [
                'cantidad' => trim($_POST["cantidad"]),
                'talla' => trim($_POST["talla"]),
                'idUsuario' => $idUsuarioSesion,
                'idEquipacion' => trim($_POST['idEquipacion'])
            ];


             if ($this->equipacionModelo->pedidoEquipacion($pedidoEquipacion) ){
                 redireccionar('/socio/equipacion');

             } else {
                die('Algo ha fallado!!!');
             }
        } else {
            $datosUser = $this->SocioModelo->obtenerDatosSocioId($idUsuarioSesion);
            $this->datos['usuarios']=$datosUser;        

            $this->vista('socios/modificarDatos', $this->datos);
        }
       
    }




    public function verFoto($idLic){
     

        $this->datos['foto']=$this->SocioModelo->obtenerFotoLicencia($idLic);
       
        $this->vista('socios/verFoto',$this->datos);
    }

   
 //************* INSCRIPCIONES *****************/

    public function escuela(){
        // $nombrePagina = "ESCUELA";
        // $tituloPagina = "ESCUELA";
        
        // $this->datos['nombrePagina']=$nombrePagina;
        // $this->datos['tituloPagina']=$tituloPagina;

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        $datosUser = $this->SocioModelo->obtenerDatosSocioId($idUsuarioSesion);
        $this->datos['usuarios']=$datosUser;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $dirCarnet="/var/www/html/tragamillas/public/img/foto_carnet_solicitud/";

            $terCarnet=(substr($_FILES['imgCarnet']["name"], strpos($_FILES['imgCarnet']["name"],'.')+strlen('.')));
            $nomFoto = "socioCarnet_".$datosUser[0]->id_usuario.".".$terCarnet;

            move_uploaded_file($_FILES['imgCarnet']['tmp_name'], $dirCarnet.$nomFoto);
           
            $agreEscuela = [
                'id_usu' =>$datosUser[0]->id_usuario,
                'categoria' => trim($_POST['cat']),
                'grupo' => trim($_POST['grup']),
                'fecha' => date('Y-m-d'),
                'fotoCarnet' => $nomFoto,
            ];
          
            if ($this->SocioModelo->escuela($agreEscuela)) {
                redireccionar('/socio');
            } else {
                die('Algo ha fallado!!!');
            }
        }



        
        $categorias = $this->SocioModelo->obtenerCategorias();
        $this->datos['categorias']=$categorias;
        $grupos = $this->SocioModelo->obtenergrupos();
        $this->datos['grupos']=$grupos;
        $eventos = $this->eventoModelo->obtenerEventos();
        $this->datos['eventos']=$eventos;
              
        $this->vista('socios/formulario_escuela', $this->datos);
        
    }


    public function ins_evento(){

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;
        $datosUser = $this->SocioModelo->obtenerDatosSocioId($idUsuarioSesion);

        $id_evento=(trim($_POST['id_evento']));

        $this->datos['rolesPermitidos'] = [3]; 
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }
     
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->SocioModelo->eventoSoli($id_evento,$datosUser)) {

                redireccionar('/socio/escuela');
            } else {
                die('Algo ha fallado!!!');
            }
        }

    }




    // public function eventoSolicitud()
    // {
    //     $nombrePagina = "EVENTO";
    //     $tituloPagina = "EVENTO";
        
    //     $this->datos['nombrePagina']=$nombrePagina;
    //     $this->datos['tituloPagina']=$tituloPagina;

    //     $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

    //     $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

    //     if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
    //         redireccionar('/usuarios');
    //     }

    //     $datosUser = $this->SocioModelo->obtenerDatosSocioId($idUsuarioSesion);

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $agreEvento = [
    //             'id_usu' =>trim($datosUser[0]->id_usuario),
    //             'even' => trim($_POST['even']),
    //         ];
          
    //         if ($this->SocioModelo->eventoSoli($agreEvento)) {
    //             redireccionar('/socio');
    //         } else {
    //             die('Algo ha fallado!!!');
    //         }
    //     }

    //     $eventos = $this->SocioModelo->obtenerEventos();
    //     $this->datos['usuarios']=$datosUser;
    //     $this->datos['eventos']=$eventos;
    //     $this->vista('socios/formulario_evento', $this->datos);
        
    // }


}
