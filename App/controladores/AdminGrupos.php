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
        $this->datos['grupos_y_horarios'] = $this->grupoModelo->obtenerGruposHorarios();

        foreach($this->datos['grupo'] as $info){
            $id=$info->id_grupo;
            $this->datos['horario'] = $this->grupoModelo->obtenerHorarioId($id); 
        }
        
        
        $this->vista('administradores/crudGrupos/inicio',$this->datos);
    }


    public function nuevo_grupo(){
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $grupoNuevo = [
                'nombre' => trim($_POST['nombre']),
                'fecha_inicio' => trim($_POST['fecha_inicio']),
                'fecha_fin'=> trim($_POST['fecha_fin'])    
            ];
            $ultimoIndice=$this->grupoModelo->agregarGrupo($grupoNuevo);
            $grupoNuevo['id_grupo']=$ultimoIndice;
       

            if(isset($_POST['lunesDia'])){
                $lunes = (object) [
                    'dia'=>$_POST['lunesDia'],
                    'ini'=>$_POST['lunesIni'],
                    'fin'=>$_POST['lunesFin']
                ];
                
                $ultimoIndice=$this->grupoModelo->agregarHorario($lunes); 
                //$lunes->id_horario=$ultimoIndice;
                $grupoNuevo['id_horario']=$ultimoIndice;
                //var_dump($grupoNuevo);
                $this->grupoModelo->agregarGrupoHorario($grupoNuevo);
                //echo $grupoNuevo['lunes']->id_horario;
            }


            if(isset($_POST['martesDia'])){
               $martes = (object) [
                'dia'=>$_POST['martesDia'],
                'ini'=>$_POST['martesIni'],
                'fin'=>$_POST['martesFin']
                ];

                $ultimoIndice=$this->grupoModelo->agregarHorario($martes);
                $grupoNuevo['id_horario']=$ultimoIndice;
                $this->grupoModelo->agregarGrupoHorario($grupoNuevo);  
            }
          

           if(isset($_POST['miercolesDia'])){
                $miercoles = (object) [
                    'dia'=>$_POST['miercolesDia'],
                    'ini'=>$_POST['miercolesIni'],
                    'fin'=>$_POST['miercolesFin']
                ];

                $ultimoIndice=$this->grupoModelo->agregarHorario($miercoles);
                $grupoNuevo['id_horario']=$ultimoIndice;
                $this->grupoModelo->agregarGrupoHorario($grupoNuevo);  
            }
           

            if(isset($_POST['juevesDia'])){
                $jueves = (object) [
                    'dia'=>$_POST['juevesDia'],
                    'ini'=>$_POST['juevesIni'],
                    'fin'=>$_POST['juevesFin']
                ];

                $ultimoIndice=$this->grupoModelo->agregarHorario($jueves);
                $grupoNuevo['id_horario']=$ultimoIndice;
                $this->grupoModelo->agregarGrupoHorario($grupoNuevo);  
            }
          
            if(isset($_POST['viernesDia'])){
                $viernes = (object) [
                    'dia'=>$_POST['viernesDia'],
                    'ini'=>$_POST['viernesIni'],
                    'fin'=>$_POST['viernesFin']
                ];

                $ultimoIndice=$this->grupoModelo->agregarHorario($viernes);
                $grupoNuevo['id_horario']=$ultimoIndice;
                $this->grupoModelo->agregarGrupoHorario($grupoNuevo);  
            }

                redireccionar('/adminGrupos');
          

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
            $horarios = $this->grupoModelo->obtenerHorarioId($id);
             //var_dump($horarios); //llega un array de objetos
            if ($this->grupoModelo->borrarGrupo($id,$horarios)) {
                  redireccionar('/adminGrupos');
             }else{
                 die('Algo ha fallado!!!');
             }
         }else{
             $this->datos['grupo'] = $this->grupoModelo->obtenerGrupoId($id);
             $this->datos['horarios'] = $this->grupoModelo->obtenerHorarioId($id);
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
                    'id_grupo'=>$id,
                    'nombre_grupo' => trim($_POST['nombre']),
                    'fecha_ini' => trim($_POST['fecha_inicio']),
                    'fecha_fin' => trim($_POST['fecha_fin']), 
                ];

                $this->grupoModelo->editarGrupo($grupo_modificado);
                var_dump($_POST);
                //var_dump($_POST['horario']);
                //$this->grupoModelo->agregarHorario($_POST['horario']);

                
    
                // if ($this->grupoModelo->editarGrupo($grupo_modificado)) {
                //     redireccionar('/adminGrupo');
                // }else{
                //     die('Algo ha fallado!!!');
                // }
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