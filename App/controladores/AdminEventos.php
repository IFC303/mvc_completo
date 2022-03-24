<?php

class AdminEventos extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->eventoModelo = $this->modelo('Evento');
        $this->AdminModelo = $this->modelo('AdminModelo');
    }

    //NOTIFICACIONES
    public function notificaciones()
    {
        $notific[0] = $this->AdminModelo->notSocio();
        $notific[1] = $this->AdminModelo->notGrupo();
        $notific[2] = $this->AdminModelo->notEventos();
        $notific[3] ="EVENTOS";
        return $notific;
    }

    public function index(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $this->datos['evento'] = $this->eventoModelo->obtenerEventos();
        $this->vista('administradores/crudEventos/inicio',$this->datos);
    }
    
    public function nuevo_evento(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $eventoNuevo = [
                'nombre' => trim($_POST['nombre']),
                'tipo'=>trim($_POST['tipo']),
                'precio'=>trim($_POST['precio']),
                'descuento'=>trim($_POST['descuento']),
                'fecha_ini' => trim($_POST['fecha_ini']),
                'fecha_fin'=> trim($_POST['fecha_fin']),
                'fecha_ini_inscrip' => trim($_POST['fecha_ini_inscrip']),
                'fecha_fin_inscrip'=> trim($_POST['fecha_fin_inscrip']),
            ];

            if($this->eventoModelo->agregarEvento($eventoNuevo)){
                redireccionar('/adminEventos');
            }else{
                die('Añgo ha fallado!!');
            }

        }else{
            $this->datos['evento'] = (object)[
                'id_grupo'=>'',
                'id_usuario'=>'',
                'nombre'=>'',
                'tipo'=>'',
                'precio'=>'',
                'descuento'=>'',
                'fecha_ini'=>'',
                'fecha_fin'=>'',
            ];
            $this->datos["nuevo"]="EVENTO";
            $this->vista('administradores/crudEventos/nuevo_evento',$this->datos);
        }
    }

    public function borrar($id){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->eventoModelo->borrarEvento($id)) {
                redireccionar('/adminEventos');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->datos['evento'] = $this->eventoModelo->obtenerEventoId($id);
            $this->vista('administradores/crudEventos/inicio', $this->datos);
        }


    }

    public function editarEvento(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $this->datos['rolesPermitidos'] = [1];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $evento_modificado = [
                    'id_evento' => trim($_POST['id_evento']),
                    'nombre' => trim($_POST['nombre']),
                    'tipo'=> trim($_POST['tipo']),
                    'precio' => trim($_POST['precio']),
                    'descuento'=>trim($_POST['descuento']),
                    'fecha_ini' => trim($_POST['fecha_ini']),
                    'fecha_fin' => trim($_POST['fecha_fin']), 
                    'fecha_ini_inscrip' => trim($_POST['fecha_ini_inscrip']),
                    'fecha_fin_inscrip' => trim($_POST['fecha_fin_inscrip']),  
                ];
   
                 if ($this->eventoModelo->editarEvento($evento_modificado)) {
                     redireccionar('/adminEventos');
                 }else{
                     die('Algo ha fallado!!!');
                 }

         } else {
                $this->vista('administradores/crudEventos/inicio', $this->datos);
        }
}



        public function participantes($id_evento)
        {
            $notific = $this->notificaciones();
            $this->datos['notificaciones'] = $notific;

             $this->datos['id_evento'] = $id_evento;

             $this->datos['participantesEventos'] = $this->eventoModelo->obtenerParticipantesEventos($id_evento);
             //var_dump($this->datos['participantesEventos']);
 
            $this->datos["nuevo"]="PARTICIPANTES";
            $this->vista('administradores/crudEventos/participantes', $this->datos);
        }



        public function guardarMarcas($id){
            $notific = $this->notificaciones();
            $this->datos['notificaciones'] = $notific;

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //var_dump($_POST);

                $info=explode("_",$id);
                $marca=$_POST['marca'];
                $info['marca']=$marca;    
                $dorsal=$_POST['dorsal'];
                $info['dorsal']=$dorsal;
                $info['id_evento']=$_POST['id_evento'];
                var_dump($info);

                 if($info[1]=="Externo"){
                     $this->eventoModelo->guardarMarcasExterno($info);
                     redireccionar('/adminEventos');
                 }else{
                     $this->eventoModelo->guardarMarcasSocio($info);
                     redireccionar('/adminEventos');
                 }
                
             }else{
                 $this->vista('administradores/crudEventos/participantes', $this->datos);
            }
                
        }

        
        public function borrarMarcas($id){
            $notific = $this->notificaciones();
            $this->datos['notificaciones'] = $notific;

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //var_dump($_POST);

                $info=explode("_",$id);  
                $info['id_evento']=$_POST['id_evento'];
                var_dump($info);

                  if($info[1]=="Externo"){
                      $this->eventoModelo->borrarMarcasExterno($info);
                      redireccionar('/adminEventos');
                  }else{
                      $this->eventoModelo->borrarMarcasSocio($info);
                      redireccionar('/adminEventos');
                  }
                
            //  }else{
            //      $this->vista('administradores/crudEventos/inicio', $this->datos);
             }
                
        }






























}





