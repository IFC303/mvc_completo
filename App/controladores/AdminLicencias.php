<?php

class AdminLicencias extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->licenciaModelo = $this->modelo('Licencia');
    }


    public function index(){
        $this->datos['licencia'] = $this->licenciaModelo->obtenerLicencias();
        $this->vista('administradores/crudLicencias/inicio',$this->datos);
    }


    public function nueva_licencia(){
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){

            $dir="/var/www/html/tragamillas/public/img/datosBBDD/";
           
            
            move_uploaded_file($_FILES['imagenLicAdmin']['tmp_name'], $dir.$_FILES['imagenLicAdmin']['name']);

            $licenciaNueva = [
                'num_lic' => trim($_POST['num_lic']),
                'aut_nac' => trim($_POST['aut_nac']),
                'dorsal' => trim($_POST['dorsal']),
                'fechaCad' => trim($_POST['fechaCad']),
                'imagenLicAdmin' => $_FILES['imagenLicAdmin']['name'],
            ];

            if($this->licenciaModelo->agregarLicencia($licenciaNueva)){
                redireccionar('/AdminLicencias');
            }else{
                die('Añgo ha fallado!!');
            }

        }else{
            $this->datos['licencia'] = (object)[
                'id_entidad'=>'',
                'nombre'=>'',
                'tipo'=>'',
            ];
            $this->vista('administradores/crudLicencias/nueva_licencia',$this->datos);
        }
    }

}
