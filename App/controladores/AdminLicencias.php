<?php

class AdminLicencias extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->licenciaModelo = $this->modelo('Licencia');
        $this->adminModelo = $this->modelo('AdminModelo');
    }
    

    //*********** NOTIFICACIONES EN EL MENU LATERAL *********************/
    public function notificaciones(){
        $notific[0] = $this->adminModelo->notSocio();
        $notific[1] = $this->adminModelo->notGrupo();
        $notific[2] = $this->adminModelo->notEventos();
        $notific[3] = $this->adminModelo->contar_pedidos();
        return $notific;
    }



    //*********** INDEX *********************/
    public function index(){
         $notific = $this->notificaciones();
         $this->datos['notificaciones'] = $notific;
         
        $this->datos['licencia'] = $this->licenciaModelo->obtenerSocioLicencia();
        $this->datos['lice_socio'] = $this->licenciaModelo->obtenerNombreSocio();
        
        $this->vista('administradores/licencia',$this->datos);
    }



//*********************************** NUEVO ****************************************/
    public function nuevo(){           
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }


        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $nuevo = [
                'usuario' => trim($_POST['usuario']),
                'tipo' => trim($_POST['tipo']),
                'gir' => trim($_POST['gir']),
                'num_lic' => trim($_POST['num_lic']),
                'aut_nac' => trim($_POST['aut_nac']),
                'dorsal' => trim($_POST['dorsal']),
                'fechaCad' => trim($_POST['fechaCad']),
                'foto'=>$_FILES['subirFoto']['name']            
            ];
            if($this->licenciaModelo->agregarLicencia($nuevo)){
                redireccionar('/AdminLicencias');
            }else{
                die('Añgo ha fallado!!');
            }
        }else{
            $this->datos['licencia'] = (object)[
                'usuario' => '',
                'tipo' => '',
                'gir' => '',
                'num_lic' => '',
                'aut_nac' => '',
                'dorsal' => '',
                'fechaCad' => '',
                'foto'=>''  
            ];
            $this->vista('administradores/licencia',$this->datos);
        }
    }



//*********************************** EDITAR ****************************************/
    public function editar($id){
        $this->datos['rolesPermitidos'] = [1];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if ($_FILES['subirFoto']['name']!=''){
                    $foto=$_FILES['subirFoto']['name'];
                    $foto=$id.'.jpg';
                }else{
                    $foto="";
                }
            
        
                $editar = [
                    'id_usuario' => trim($_POST['id_usuario']),
                    'foto'=>$foto,
                    'tipo' => trim($_POST['tipo']),
                    'dorsal' => trim($_POST['dorsal']),
                    'num_licencia' => trim($_POST['num_licencia']),
                    'fecha_cad' => trim($_POST['fecha_cad']),
                    'regional_nacional' => trim($_POST['aut_nac']),
                    'gir' => trim($_POST['gir'])
                ];
   
                if ($this->licenciaModelo->editarLicencia($editar, $id)) {
                    //$directorio="/var/www/html/tragamillas/public/img/licencias/";
                    $directorio="C:/xampp/htdocs/tragamillas/app/resources/licencias/";       
                    copy($_FILES['subirFoto']['tmp_name'], $directorio.$id.'.jpg');
                    chmod($directorio.$id.'.jpg',0777);
                    redireccionar('/AdminLicencias');
                }else{
                    die('Algo ha fallado!!!');
                }
        }else {
            $this->vista('administradores/licencia', $this->datos);
        }
    }



//*********************************** BORRAR ****************************************/
    public function borrar($id){
        $this->datos['rolesPermitidos'] = [1];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($this->licenciaModelo->borrarLicencia($id)) {
                //$directorio="/var/www/html/tragamillas/public/img/fotosPerfil/";
                $directorio="C:/xampp/htdocs/tragamillas/app/resources/licencias/"; 
                unlink($directorio.$id.'.jpg');
                redireccionar('/AdminLicencias');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->vista('administradores/licencia', $this->datos);
        }
    }



   
//*********************************** EXPORTAR ****************************************/

    public function exportarLicencias(){

        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;


        $licencias = $this->licenciaModelo->obtenerSocioLicencia();      
        //creamos delimitador y archivo
        $delimitador = ";";
        $archivo = "licencias" . ".csv";   
        //create a file pointer
        $f = fopen('php://memory', 'w');    
       //creamos las columnas
        $columnas = array('DNI', 'NOMBRE', 'APELLIDOS', 'EMAIL', 'NUM LICENCIA', 'FECHA CADUCIDAD','TIPO', 'DORSAL','GIR','REGIONAL/NACIONAL' );
        fputcsv($f, $columnas, $delimitador);   
        // creamos filas con el array $licencias
        foreach ($licencias as $licen) {
        $fila = array($licen->dni, $licen->nombre, $licen->apellidos, $licen->email, $licen->num_licencia, $licen->fecha_cad,$licen->tipo,$licen->dorsal,$licen->gir,$licen->regional_nacional);
        fputcsv($f, $fila, $delimitador);
        }
     
        //al principio del archivo
        fseek($f, 0);
    
     
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $archivo . '";');
    
        fpassthru($f);

           
    }


}
