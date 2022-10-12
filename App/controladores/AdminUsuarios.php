<?php


class AdminUsuarios extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];       

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->adminModelo = $this->modelo('AdminModelo');
    }

    

    public function index(){
        $this->datos['usuarios'] = $this->adminModelo->obtenerUsuarios();
        $this->datos['roles'] = $this->adminModelo->obtenerRoles();
        $this->vista('administradores/usuario',$this->datos);
    }



 
    public function borrarUsuario($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->adminModelo->borrar_usuario($id)) {
                redireccionar('/adminUsuarios');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->vista('administradores/usuario', $this->datos);
        }
    }



    public function nuevo_usuario(){

        $this->datos['rolesPermitidos'] = [1];   
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
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
                'foto' => $_FILES['foto']['name'],
                'id_rol' => trim($_POST['rol']),
                'pri_socio' => trim($_POST['pri_socio']),
                'nom_pa' => trim($_POST['nomPa']),
                'ape_pa' => trim($_POST['apePa']),
                'dni_pa' => trim($_POST['dniPa'])
            ];

            if ($this->adminModelo->nuevo_usuario($nuevo)) {
                    redireccionar('/adminUsuarios');
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
                'foto' => '', 
                'id_rol' => '', 
                'pri_socio' => '',
                'nom_pa' => '',
                'ape_pa' => '',
                'dni_pa' => ''          
            ];


            $this->vista('administradores/usuario',$this->datos);
        }
    }

    public function editar_usuario($id){

        $this->datos['rolesPermitidos'] = [1];   
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $foto=$_FILES['foto']['name'];
            $foto=$id.'.jpg';
    
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
                'foto' => $foto,
                'id_rol' => trim($_POST['rol']),
                'pri_socio' => trim($_POST['pri_socio']),
                'nom_pa' => trim($_POST['nomPa']),
                'ape_pa' => trim($_POST['apePa']),
                'dni_pa' => trim($_POST['dniPa'])    
            ];

            
            $directorio="C:/xampp/htdocs/tragamillas/public/img/fotosPerfil/";       
            copy($_FILES['foto']['tmp_name'], $directorio.$id.'.jpg');
            chmod($directorio.$id.'.jpg',0777);


            if ($this->adminModelo->editar_usuario($nuevo,$id)) {
                    redireccionar('/adminUsuarios');
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
                'foto' => '',  
                'talla' => '', 
                'id_rol' => '', 
                'pri_socio' => '',  
                'nom_pa' => '',
                'ape_pa' => '',
                'dni_pa' => ''       
            ];

            $this->vista('administradores/usuario',$this->datos);
        }
    }


}