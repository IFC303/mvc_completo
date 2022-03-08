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

    public function index()
    {
        $this->vista('administradores/inicio', $this->datos);
    }


    public function crud_admin()
    {
        $verUsu = $this->AdminModelo->obtenerUsuarios(1);
        $this->datos['usuAdmin'] = $verUsu;
        $this->datos['idTengo'] = "1";
        $this->vista('administradores/cruds/crudAdmin', $this->datos);
    }

    public function crud_entrenadores()
    {
        $verUsu = $this->AdminModelo->obtenerUsuarios(2);
        $this->datos['usuAdmin'] = $verUsu;
        $this->datos['idTengo'] = "2";
        $this->vista('administradores/cruds/crudAdmin', $this->datos);
    }

    public function crud_socios()
    {
        $verUsu = $this->AdminModelo->obtenerUsuarios(3);
        $this->datos['usuAdmin'] = $verUsu;
        $this->datos['idTengo'] = "3";
        $this->vista('administradores/cruds/crudAdmin', $this->datos);
    }

    public function crud_tiendas()
    {
        $verUsu = $this->AdminModelo->obtenerUsuarios(4);
        $this->datos['usuAdmin'] = $verUsu;
        $this->datos['idTengo'] = "4";
        $this->vista('administradores/cruds/crudAdmin', $this->datos);
    }

    public function crud_solicitudes_socios()
    {
        $verSoli = $this->AdminModelo->obtenerSolicitudes();
        $this->datos['soliSocio'] = $verSoli;
        //$this->datos['idTengo'] = "1";
        $this->vista('administradores/solicitudes/solicitud', $this->datos);
    }

    public function borrarUsuario($idUsuTengo)
    {
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
                'passEdit' => trim($_POST["editPas"]),
                'CCCEdit' => trim($_POST["editCCC"]),
                'TallaEdit' => trim($_POST["editTalla"]),
                'FotoEdit' => trim($_POST["editFoto"]),
                'ActEdit' => trim($_POST["editAct"]),
                'RolEdit' => trim($_POST["editRol"]),
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
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $anaUsu = [
                'dniUsuAna' => trim($_POST["dni"]),
                'nomUsuAna' => trim($_POST["nombre"]),
                'apelUsuAna' => trim($_POST["apellidos"]),
                'fecUsuAna' => trim($_POST["fecha"]),
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

}
