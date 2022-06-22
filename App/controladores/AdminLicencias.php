<?php

class AdminLicencias extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->licenciaModelo = $this->modelo('Licencia');
        $this->AdminModelo = $this->modelo('AdminModelo');
    }

     //NOTIFICACIONES
     public function notificaciones()
     {
         $notific[0] = $this->AdminModelo->notSocio();
         $notific[1] = $this->AdminModelo->notGrupo();
         $notific[2] = $this->AdminModelo->notEventos();
         $notific[3] ="LICENCIA";
         
         return $notific;
     }

    public function index(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;
        $this->datos['licencia'] = $this->licenciaModelo->obtenerSocioLicencia();
        
        $this->vista('administradores/crudLicencias/inicio',$this->datos);
    }

    public function verFoto($idLic){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;     

        $this->datos['foto']=$this->licenciaModelo->obtenerFotoLicencia($idLic);
       
        $this->vista('administradores/crudLicencias/verFoto',$this->datos);
    }

    public function nueva_licencia(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;
      
        $this->datos['licencia'] = $this->licenciaModelo->obtenerNombreSocio();
        


        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){

            $dir="/var/www/html/tragamillas/public/img/licencias/";
           
            
            move_uploaded_file($_FILES['imagenLicAdmin']['tmp_name'], $dir.$_FILES['imagenLicAdmin']['name']);

            $licenciaNueva = [
                'usuario' => trim($_POST['usuario']),
                'tipo' => trim($_POST['tipo']),
                'gir' => trim($_POST['gir']),
                'num_lic' => trim($_POST['num_lic']),
                'aut_nac' => trim($_POST['aut_nac']),
                'dorsal' => trim($_POST['dorsal']),
                'fechaCad' => trim($_POST['fechaCad']),
                'imagenLicAdmin' => $_FILES['imagenLicAdmin']['name']
            ];

            if($this->licenciaModelo->agregarLicencia($licenciaNueva)){
                redireccionar('/AdminLicencias');
            }else{
                die('Añgo ha fallado!!');
            }

        }else{
            $this->datos["nuevo"]="LICENCIA";
            $this->vista('administradores/crudLicencias/nueva_licencia',$this->datos);
        }
    }

    public function borrar($num_lic){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->licenciaModelo->borrarLicencia($num_lic)) {
                redireccionar('/AdminLicencias');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->vista('administradores/crudLicencias/inicio', $this->datos);
        }


    }



    public function editarLicencia($id){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $this->datos['rolesPermitidos'] = [1];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $dir="/var/www/html/tragamillas/public/img/licencias/";
           
            
            move_uploaded_file($_FILES['imagen']['tmp_name'], $dir.$_FILES['imagen']['name']);

                //recogemos los datos modificados y guardamos en $grupo_modificado
                $licencia_modificada = [
                    'id_usuario' => trim($_POST['id_usuario']),
                    'usuario' => trim($_POST['usuario']),
                    'tipo' => trim($_POST['tipo']),
                    'gir' => trim($_POST['gir']),
                    'num_licencia' => trim($_POST['num_licencia']),
                    'regional_nacional' => trim($_POST['regional_nacional']),
                    'dorsal' => trim($_POST['dorsal']),
                    'fecha_cad' => trim($_POST['fecha_cad']),
                    'imagen' => $_FILES['imagen']['name']
                ];
   
    
                if ($this->licenciaModelo->editarLicencia($licencia_modificada, $id)) {
                    redireccionar('/AdminLicencias');
                }else{
                    die('Algo ha fallado!!!');
                }
        }else {
            $this->vista('administradores/crudLicencias/inicio', $this->datos);
        }
    }


    public function exportarLicencias(){

        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;
        $licencias = $this->licenciaModelo->obtenerSocioLicencia();
        
        var_dump ($licencias);
     
         $archivo="Archivo.csv";
         $fp=fopen($archivo,'w');
        
fputcsv($fp,$licencias[0]->tipo);
        //   foreach ($licencias as $lice){
           
           
        //   }
          fclose($fp);
          exit;

            
        //     header("Content-Type: text/csv");
        //     header("Content-Disposition: attachment; filename="$csv_file"");
          
        //     $is_coloumn = true;

        //     if(!empty($this->datos['licencia'])) {
        //     foreach($this->datos['licencia'] as $lice) {
        //     if($is_coloumn) {
        //     fputcsv($fh, array_keys($record));

        //     $is_coloumn = false;
        //     }
        //     fputcsv($fh, array_values($record));
        //     }
        //     fclose($fh);
        //     }
        //     exit;
           
    }


}
