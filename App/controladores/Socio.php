<?php

class Socio extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [3];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->adminModelo = $this->modelo('AdminModelo');

        $this->socioModelo = $this->modelo('SocioModelo');
        $this->equipacionModelo = $this->modelo('Equipacion');     
        $this->eventoModelo = $this->modelo('Evento');   
    }



// *********** PAGINA PRINCIPAL SOCIO ***********  
    public function index(){
        $id=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->adminModelo->obtenerDatosId($id);



        // $nombrePagina = "SUBIR LICENCIAS";
        // $tituloPagina = "MIS LICENCIAS";        
        // $this->datos['nombrePagina']=$nombrePagina;
        // $this->datos['tituloPagina']=$tituloPagina;
        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;
        $licencias = $this->socioModelo->obtenerLicenciasUsuarioId($idUsuarioSesion);
        $this->datos['usuarios']=$licencias;   



        $this->datos['eventos'] = $this->socioModelo->obtener_eventos();
        $this->datos['grupos'] = $this->socioModelo->obtener_grupos();
        $this->datos['categorias'] = $this->socioModelo->obtener_categorias();

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
        $id=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->adminModelo->obtenerDatosId($id);



        $nombrePagina = "VER MARCAS";
        $tituloPagina = "MARCAS PERSONALES";
        $this->datos['nombrePagina']=$nombrePagina;
        $this->datos['tituloPagina']=$tituloPagina;

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $marcas = $this->socioModelo->obtenerMarcasId($idUsuarioSesion);
        $this->datos['usuarios']=$marcas;
        $this->vista('socios/verMarcas', $this->datos);
    }


// *********** VER LICENCIAS ***********  
    public function licencias(){

        $id=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->adminModelo->obtenerDatosId($id);

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
      
        $id=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->adminModelo->obtenerDatosId($id);


        // $tituloPagina = "PEDIR EQUIPACION";
        // $this->datos['tituloPagina']=$tituloPagina;

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;
        $this->datos['equipacion'] = $this->equipacionModelo->obtenerEquipaciones();
        $this->datos['talla'] = $this->equipacionModelo->obtener_tallas();
        $this->datos['equi'] = $this->socioModelo->obtener_pedidos($id);

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




   
 //************* INSCRIPCIONES *****************/

    public function inscripciones(){

        $id=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->adminModelo->obtenerDatosId($id);
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






}
