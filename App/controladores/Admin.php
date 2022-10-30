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



}