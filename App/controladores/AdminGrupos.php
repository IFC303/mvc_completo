<?php

class AdminGrupos extends Controlador
{


    public function __construct()
    {
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->grupoModelo = $this->modelo('Grupo');
        $this->AdminModelo = $this->modelo('AdminModelo');
    }

    //NOTIFICACIONES
    public function notificaciones()
    {
        $notific[0] = $this->AdminModelo->notSocio();
        $notific[1] = $this->AdminModelo->notGrupo();
        $notific[2] = $this->AdminModelo->notEventos();
        $notific[3] = "GRUPOS";

        return $notific;
    }



    public function index()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;
        $this->datos['grupo'] = $this->grupoModelo->obtenerGrupos();
        $this->datos['grupos_y_horarios'] = $this->grupoModelo->obtenerGruposHorarios();

        foreach ($this->datos['grupo'] as $info) {
            $id = $info->id_grupo;
            $this->datos['horario'] = $this->grupoModelo->obtenerHorarioId($id);
        }


        $this->vista('administradores/crudGrupos/inicio', $this->datos);
    }


    public function nuevo_grupo()
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $this->datos['rolesPermitidos'] = [1];
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $grupoNuevo = [
                'nombre' => trim($_POST['nombre']),
                'fecha_inicio' => trim($_POST['fecha_inicio']),
                'fecha_fin' => trim($_POST['fecha_fin'])
            ];
            $ultimoIndice = $this->grupoModelo->agregarGrupo($grupoNuevo);
            $grupoNuevo['id_grupo'] = $ultimoIndice;


            if (isset($_POST['lunesDia'])) {
                $lunes = (object) [
                    'dia' => $_POST['lunesDia'],
                    'ini' => $_POST['lunesIni'],
                    'fin' => $_POST['lunesFin']
                ];

                $ultimoIndice = $this->grupoModelo->agregarHorario($lunes);
                //$lunes->id_horario=$ultimoIndice;
                $grupoNuevo['id_horario'] = $ultimoIndice;
                //var_dump($grupoNuevo);
                $this->grupoModelo->agregarGrupoHorario($grupoNuevo);
                //echo $grupoNuevo['lunes']->id_horario;
            }


            if (isset($_POST['martesDia'])) {
                $martes = (object) [
                    'dia' => $_POST['martesDia'],
                    'ini' => $_POST['martesIni'],
                    'fin' => $_POST['martesFin']
                ];

                $ultimoIndice = $this->grupoModelo->agregarHorario($martes);
                $grupoNuevo['id_horario'] = $ultimoIndice;
                $this->grupoModelo->agregarGrupoHorario($grupoNuevo);
            }


            if (isset($_POST['miercolesDia'])) {
                $miercoles = (object) [
                    'dia' => $_POST['miercolesDia'],
                    'ini' => $_POST['miercolesIni'],
                    'fin' => $_POST['miercolesFin']
                ];

                $ultimoIndice = $this->grupoModelo->agregarHorario($miercoles);
                $grupoNuevo['id_horario'] = $ultimoIndice;
                $this->grupoModelo->agregarGrupoHorario($grupoNuevo);
            }


            if (isset($_POST['juevesDia'])) {
                $jueves = (object) [
                    'dia' => $_POST['juevesDia'],
                    'ini' => $_POST['juevesIni'],
                    'fin' => $_POST['juevesFin']
                ];

                $ultimoIndice = $this->grupoModelo->agregarHorario($jueves);
                $grupoNuevo['id_horario'] = $ultimoIndice;
                $this->grupoModelo->agregarGrupoHorario($grupoNuevo);
            }

            if (isset($_POST['viernesDia'])) {
                $viernes = (object) [
                    'dia' => $_POST['viernesDia'],
                    'ini' => $_POST['viernesIni'],
                    'fin' => $_POST['viernesFin']
                ];

                $ultimoIndice = $this->grupoModelo->agregarHorario($viernes);
                $grupoNuevo['id_horario'] = $ultimoIndice;
                $this->grupoModelo->agregarGrupoHorario($grupoNuevo);
            }

            redireccionar('/adminGrupos');
        } else {
            $this->datos['grupo'] = (object)[
                // 'id_grupo'=>'',
                'nombre' => '',
                'fecha_inicio' => '',
                'fecha_fin' => '',
                'id_horario' => '',
                'lunes' => '',
                'martes' => '',
                'miercoles' => '',
                'jueves' => '',
                'viernes' => ''
            ];
            $this->datos["nuevo"]="GRUPOS";
            $this->vista('administradores/crudGrupos/nuevo_grupo', $this->datos);
        }
    }


    public function borrar($id)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $horarios = $this->grupoModelo->obtenerHorarioId($id);
            //var_dump($horarios); //llega un array de objetos
            if ($this->grupoModelo->borrarGrupo($id, $horarios)) {
                redireccionar('/adminGrupos');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->datos['grupo'] = $this->grupoModelo->obtenerGrupoId($id);
            $this->datos['horarios'] = $this->grupoModelo->obtenerHorarioId($id);
            $this->vista('administradores/crudGrupos/inicio', $this->datos);
        }
    }




    public function editarGrupo($id)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $this->datos['rolesPermitidos'] = [1];
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //recogemos los datos modificados y guardamos en $grupo_modificado
            $grupo_modificado = [
                'id_grupo' => $id,
                'nombre_grupo' => trim($_POST['nombre']),
                'fecha_ini' => trim($_POST['fecha_inicio']),
                'fecha_fin' => trim($_POST['fecha_fin'])
            ];

            //modificamos tabla GRUPO
            $this->grupoModelo->editarGrupo($grupo_modificado);


            //borramos en tabla HORARIO
            $horario = $_POST['horario'];
            //var_dump($horario);
            $this->grupoModelo->borrarHorario($horario);


            //insertamos lo nuevo en la tabla HORARIO
            if (isset($_POST['lunesDia'])) {
                $lunes = (object) [
                    'dia' => $_POST['lunesDia'],
                    'ini' => $_POST['lunesIni'],
                    'fin' => $_POST['lunesFin']
                ];

                //agregamos horario y devuelve el indice
                $ultimoIndice = $this->grupoModelo->agregarHorario($lunes);
                //añadimos el indice al objeto lunes
                $lunes->id_horario = $ultimoIndice;
                //añadimos el indice al array GRUPO_MODIFICADO
                $grupo_modificado['id_horario'] = $ultimoIndice;
                //llamamos al modelo
                $this->grupoModelo->agregarGrupoHorario($grupo_modificado);
            }


            if (isset($_POST['martesDia'])) {
                $martes = (object) [
                    'dia' => $_POST['martesDia'],
                    'ini' => $_POST['martesIni'],
                    'fin' => $_POST['martesFin']
                ];

                //agregamos horario y devuelve el indice
                $ultimoIndice = $this->grupoModelo->agregarHorario($martes);
                //añadimos el indice al objeto lunes
                $martes->id_horario = $ultimoIndice;
                //añadimos el indice al array GRUPO_MODIFICADO
                $grupo_modificado['id_horario'] = $ultimoIndice;
                //llamamos al modelo
                $this->grupoModelo->agregarGrupoHorario($grupo_modificado);
            }


            if (isset($_POST['miercolesDia'])) {
                $miercoles = (object) [
                    'dia' => $_POST['miercolesDia'],
                    'ini' => $_POST['miercolesIni'],
                    'fin' => $_POST['miercolesFin']
                ];

                //agregamos horario y devuelve el indice
                $ultimoIndice = $this->grupoModelo->agregarHorario($miercoles);
                //añadimos el indice al objeto lunes
                $miercoles->id_horario = $ultimoIndice;
                //añadimos el indice al array GRUPO_MODIFICADO
                $grupo_modificado['id_horario'] = $ultimoIndice;
                //llamamos al modelo
                $this->grupoModelo->agregarGrupoHorario($grupo_modificado);
            }


            if (isset($_POST['juevesDia'])) {
                $jueves = (object) [
                    'dia' => $_POST['juevesDia'],
                    'ini' => $_POST['juevesIni'],
                    'fin' => $_POST['juevesFin']
                ];

                //agregamos horario y devuelve el indice
                $ultimoIndice = $this->grupoModelo->agregarHorario($jueves);
                //añadimos el indice al objeto lunes
                $jueves->id_horario = $ultimoIndice;
                //añadimos el indice al array GRUPO_MODIFICADO
                $grupo_modificado['id_horario'] = $ultimoIndice;
                //llamamos al modelo
                $this->grupoModelo->agregarGrupoHorario($grupo_modificado);
            }

            if (isset($_POST['viernesDia'])) {
                $viernes = (object) [
                    'dia' => $_POST['viernesDia'],
                    'ini' => $_POST['viernesIni'],
                    'fin' => $_POST['viernesFin']
                ];

                //agregamos horario y devuelve el indice
                $ultimoIndice = $this->grupoModelo->agregarHorario($viernes);
                //añadimos el indice al objeto lunes
                $viernes->id_horario = $ultimoIndice;
                //añadimos el indice al array GRUPO_MODIFICADO
                $grupo_modificado['id_horario'] = $ultimoIndice;
                //llamamos al modelo
                $this->grupoModelo->agregarGrupoHorario($grupo_modificado);
            }

            redireccionar('/adminGrupos');
        }
    }


    public function horario($id_grupo)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $this->datos['entrenadores'] = $this->grupoModelo->obtenerEntrenador();
        $this->datos['alumnos'] = $this->grupoModelo->obtenerAlumnos();
        $this->vista('administradores/crudGrupos/participantes', $this->datos);
    }




    public function participantes($id_grupo)
    {
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $this->datos['entrenadores'] = $this->grupoModelo->obtenerEntrenador();
        $this->datos['entrenadoresGrupo'] = $this->grupoModelo->obtenerEntrenadorGrupo();
        //var_dump($this->datos['entrenadores']);
        //var_dump($this->datos['entrenadoresGrupo']);
        
        $this->datos['alCero'] = $this->grupoModelo->obtenerAlumnosCero($id_grupo);
        $this->datos['alUno'] = $this->grupoModelo->obtenerAlumnosUno($id_grupo);
        //var_dump($this->datos['alUno']);
        //var_dump($this->datos['alCero']);
        $this->datos['id_grupo'] = $id_grupo;

        $this->vista('administradores/crudGrupos/participantes', $this->datos);
    }

                   
    public function nueva_clase(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;


        $this->datos['rolesPermitidos'] = [1];
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_POST);

            $idGrupo=($_POST['idGrupo']);
            //echo $idGrupo;
            $aUno=(explode(",",$_POST['alumnosActuales']));
            //var_dump($aUno);
            $aCero=(explode(",",$_POST['alumnosAntes']));
            //var_dump($aCero);

            $this->grupoModelo->cambiarEstadoAlumno($aUno,$aCero,$idGrupo);

            redireccionar('/adminGrupos');
        }
    }
}
