<?php

class Socio extends Controlador
{
    public function __construct()
    {
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->SocioModelo = $this->modelo('SocioModelo');
      
    }

    public function index()
    {
        $this->vista('socios/inicio', $this->datos);
    }

    public function modificarDatos()
    {

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

            $directorio="/var/www/html/tragamillas/public/img/fotosPerfil/";
           
            
            move_uploaded_file($_FILES['foto']['tmp_name'], $directorio.$_FILES['foto']['name']);

            $editarDatos = [
                'dniEdit' => trim($_POST["dni"]),
                'nombreEdit' => trim($_POST["nombre"]),
                'apellidosEdit' => trim($_POST["apellidos"]),
                'telefonoEdit' => trim($_POST["telefono"]),
                'emailEdit' => trim($_POST["email"]),
                'cccEdit' => trim($_POST["ccc"]),
                'passwEdit' => trim($_POST["passw"]),
                'tallaEdit' => trim($_POST["talla"]),
                'fotoEdit' => $_FILES['foto']['name'],
            ];

            if ($this->SocioModelo->actualizarUsuario($editarDatos, $idUsuarioSesion, $datosUser)) {
                redireccionar('/socio/modificarDatos');

            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $datosUser = $this->SocioModelo->obtenerDatosSocioId($idUsuarioSesion);
            $this->datos['usuarios']=$datosUser;        

            $this->vista('socios/modificarDatos', $this->datos);
        }

        
    }

    public function verMarcas()
    {
        $nombrePagina = "VER MARCAS";
        $tituloPagina = "MARCAS PERSONALES";

        $this->datos['nombrePagina']=$nombrePagina;
        $this->datos['tituloPagina']=$tituloPagina;

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $marcas = $this->SocioModelo->obtenerMarcasId($idUsuarioSesion);
        $this->datos['usuarios']=$marcas;

        $this->vista('socios/verMarcas', $this->datos);
    }


    //************* EQUIPACION *****************/
    public function equipacion(){

        $tituloPagina = "PEDIR EQUIPACION";
        $this->datos['tituloPagina']=$tituloPagina;

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        //$marcas = $this->SocioModelo->obtenerMarcasId($idUsuarioSesion);
        //$this->datos['usuarios']=$marcas;

        $this->vista('socios/equipacion', $this->datos);
    }




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

    public function verFoto($idLic){
     

        $this->datos['foto']=$this->SocioModelo->obtenerFotoLicencia($idLic);
       
        $this->vista('socios/verFoto',$this->datos);
    }

    public function nuevaLicencia()
    {
        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;
      


        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $dir="/var/www/html/tragamillas/public/img/licencias/";
           
            
            move_uploaded_file($_FILES['ImagenLicencia']['tmp_name'], $dir.$_FILES['ImagenLicencia']['name']);
           
            $agreLic = [
                'numLicencia' => trim($_POST['NumLicencia']),
                'tipoLicencia' => trim($_POST['tipoLicencia']),
                'federativas' => trim($_POST['federativas']),
                'dorsal' => trim($_POST['Dorsal']),
                'fechaCaducidad' => trim($_POST['FechaCaducidad']),
                'imagenLicencia' => $_FILES['ImagenLicencia']['name'],
            ];

            if ($this->SocioModelo->agregarLicencia($agreLic, $idUsuarioSesion)) {
                redireccionar('/socio/licencias');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->vista('socios/agregarLicencia', $this->datos);
        }
        
    }

    public function escuela()
    {
        $nombrePagina = "ESCUELA";
        $tituloPagina = "ESCUELA";
        
        $this->datos['nombrePagina']=$nombrePagina;
        $this->datos['tituloPagina']=$tituloPagina;

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        $datosUser = $this->SocioModelo->obtenerDatosSocioId($idUsuarioSesion);

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
        $grupos = $this->SocioModelo->obtenergrupos();
        $this->datos['usuarios']=$datosUser;
        $this->datos['categorias']=$categorias;
        $this->datos['grupos']=$grupos;
        $this->vista('socios/formulario_escuela', $this->datos);
        
    }

    public function eventoSolicitud()
    {
        $nombrePagina = "EVENTO";
        $tituloPagina = "EVENTO";
        
        $this->datos['nombrePagina']=$nombrePagina;
        $this->datos['tituloPagina']=$tituloPagina;

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        $datosUser = $this->SocioModelo->obtenerDatosSocioId($idUsuarioSesion);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $agreEvento = [
                'id_usu' =>trim($datosUser[0]->id_usuario),
                'even' => trim($_POST['even']),
            ];
          
            if ($this->SocioModelo->eventoSoli($agreEvento)) {
                redireccionar('/socio');
            } else {
                die('Algo ha fallado!!!');
            }
        }

        $eventos = $this->SocioModelo->obtenerEventos();
        $this->datos['usuarios']=$datosUser;
        $this->datos['eventos']=$eventos;
        $this->vista('socios/formulario_evento', $this->datos);
        
    }


}
