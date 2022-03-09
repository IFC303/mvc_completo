<?php

class AdminGrupos extends Controlador
{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->grupoModelo = $this->modelo('Grupo');
    }



    public function index(){
        $this->datos['grupo'] = $this->grupoModelo->obtenerGrupos();
        $this->vista('administradores/crudGrupos/inicio',$this->datos);
    }


    public function nuevo_grupo(){
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $grupoNuevo = [
                // 'id_grupo' => trim($_POST['id_grupo']),
                'nombre' => trim($_POST['nombre']),
                'fecha_inicio' => trim($_POST['fecha_inicio']),
                'fecha_fin'=> trim($_POST['fecha_fin'])    
            ];


            
            if(isset($_POST['lunesDia'])){
                $lunes = (object) [
                    // 'id_horario' =>($_POST['id_horario']),
                    'dia'=>$_POST['lunesDia'],
                    'ini'=>$_POST['lunesIni'],
                    'fin'=>$_POST['lunesFin']
                ];
                    $grupoNuevo['lunes']=$lunes;
            }


            if(isset($_POST['martesDia'])){
               $martes = (object) [
                // 'id_horario' =>($_POST['id_horario']),
                'dia'=>$_POST['martesDia'],
                'ini'=>$_POST['martesIni'],
                'fin'=>$_POST['martesFin']
                ];
                    $grupoNuevo['martes']=$martes;
            }
          

           if(isset($_POST['miercolesDia'])){
                $miercoles = (object) [
                    // 'id_horario' =>($_POST['id_horario']),
                    'dia'=>$_POST['miercolesDia'],
                    'ini'=>$_POST['miercolesIni'],
                    'fin'=>$_POST['miercolesFin']
                ];
                    $grupoNuevo['miercoles']=$miercoles;        
            }
           

            if(isset($_POST['juevesDia'])){
                $jueves = (object) [
                    // 'id_horario' =>($_POST['id_horario']),
                    'dia'=>$_POST['juevesDia'],
                    'ini'=>$_POST['juevesIni'],
                    'fin'=>$_POST['juevesFin']
                ];
                    $grupoNuevo['jueves']=$jueves;  
            }
          
            if(isset($_POST['viernesDia'])){
                $viernes = (object) [
                    // 'id_horario' =>($_POST['id_horario']),
                    'dia'=>$_POST['viernesDia'],
                    'ini'=>$_POST['viernesIni'],
                    'fin'=>$_POST['viernesFin']
                ];
                    $grupoNuevo['viernes']=$viernes;      
            }


            var_dump($grupoNuevo);
          
            //  if($this->grupoModelo->agregarGrupo($grupoNuevo)){
            //      redireccionar('/adminGrupos');
            //  }else{
            //      die('Añgo ha fallado!!');
            //  }

        }else{
            $this->datos['grupo'] = (object)[
                // 'id_grupo'=>'',
                'nombre'=>'',
                'fecha_inicio'=>'',
                'fecha_fin'=>'',
                'id_horario' =>'',
                'lunes' => '',
                'martes' =>'',
                'miercoles' => '',
                'jueves' =>'',
                'viernes' =>''
            ];
            $this->vista('administradores/crudGrupos/nuevo_grupo',$this->datos);
        }
    }


    public function borrar($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->grupoModelo->borrarGrupo($id)) {
                redireccionar('/adminGrupos');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->datos['grupo'] = $this->grupoModelo->obtenerGrupoId($id);
            $this->vista('administradores/crudGrupos/inicio', $this->datos);
        }


    }


    public function editarGrupo($id){

        $this->datos['rolesPermitidos'] = [1];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                //recogemos los datos modificados y guardamos en $grupo_modificado
                $grupo_modificado = [
                    'id_grupo' => trim($_POST['id_grupo']),
                    'nombre_grupo' => trim($_POST['nombre_grupo']),
                    'fecha_ini' => trim($_POST['fecha_ini']),
                    'fecha_fin' => trim($_POST['fecha_fin']),   
                ];
   
    
                if ($this->grupoModelo->editarGrupo($grupo_modificado)) {
                    redireccionar('/adminGrupo');
                }else{
                    die('Algo ha fallado!!!');
                }
    }


}


        public function horario($id_grupo){
            $this->datos['entrenadores'] = $this->grupoModelo->obtenerEntrenador();
            $this->datos['alumnos'] = $this->grupoModelo->obtenerAlumnos();
            $this->vista('administradores/crudGrupos/participantes',$this->datos);
        }




        public function participantes($id_grupo){
            $this->datos['entrenadores'] = $this->grupoModelo->obtenerEntrenador();
            $this->datos['alumnos'] = $this->grupoModelo->obtenerAlumnos();
            $this->vista('administradores/crudGrupos/participantes',$this->datos);
        }


        public function nueva_clase(){
            $this->datos['rolesPermitidos'] = [1];         
            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }


        }










































}