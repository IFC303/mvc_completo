<?php

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

    public function crud_tiendas()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $verUsu = $this->AdminModelo->obtenerUsuarios(4);
        $this->datos['usuAdmin'] = $verUsu;
        $this->datos['idTengo'] = "4";
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
                'dniUsuAna' => trim($_POST["dni"]),
                'nomUsuAna' => trim($_POST["nombre"]),
                'apelUsuAna' => trim($_POST["apellidos"]),
                'fecUsuAna' => trim($_POST["fecha"]),
                'direccionUsuAna' => trim($_POST["direccion"]),
                'telUsuAna' => trim($_POST["telf"]),
                'emaUsuAna' => trim($_POST["email"]),
                'passUsuAna' => trim($_POST["pass"]),
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
            $this->vista('administradores/cruds/nuevoUsuario', $this->datos);
        }
    }
    
    //SOLICITUD SOCIOS
    public function crud_solicitudes_socios()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $verSoli = $this->AdminModelo->obtenerSolicitudesSocios();
        $this->datos['soliSocio'] = $verSoli;
        
        $this->vista('administradores/solicitudes/socios', $this->datos);
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

    public function aceptar_solicitudes_socios($datAceptar)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $datAceptar = explode ( '_', $datAceptar);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->AdminModelo->aceptar_solicitudes_socios($datAceptar)) {
                redireccionar('/admin/crud_solicitudes_socios');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

    //SOLICITUD GRUPOS
    public function crud_solicitudes_grupos()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $verSoli = $this->AdminModelo->obtenerSolicitudesGrupos();
        $this->datos['soliSocioGrupos'] = $verSoli;
        
        $this->vista('administradores/solicitudes/grupos', $this->datos);
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

    //SOLICITUD EVENTOS
    public function crud_solicitudes_eventos()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $verSoliExter = $this->AdminModelo->obtenerSolicitudesEvenExter();
        $verSoliSoci = $this->AdminModelo->obtenerSolicitudesEvenSoci();
        $this->datos['soliEventos'] = $verSoliSoci;
        $this->datos['radioCheck'] = "socio";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($_POST["opcion"]=="socio") {
                $this->datos['soliEventos'] = $verSoliSoci;
                $this->datos['radioCheck'] = "socio";
            } elseif($_POST["opcion"]=="externo"){
                $this->datos['soliEventos'] = $verSoliExter;
                $this->datos['radioCheck'] = "externo";
            }
        }
        
        $this->vista('administradores/solicitudes/eventos', $this->datos);
    }

    public function borrar_solicitudes_EvenSoci($datBorrar)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $datBorrar = explode ( '_', $datBorrar);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->AdminModelo->borrar_solicitudes_EvenSoci($datBorrar)) {
                redireccionar('/admin/crud_solicitudes_eventos');
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
                redireccionar('/admin/crud_solicitudes_eventos');
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
                redireccionar('/admin/crud_solicitudes_eventos');
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
                redireccionar('/admin/crud_solicitudes_eventos');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }


}
