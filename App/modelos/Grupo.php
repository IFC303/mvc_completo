<?php

class Grupo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


    public function obtener_grupos(){
        $this->db->query("SELECT * FROM v2grupo");
        return $this->db->registros();
    }


    public function obtenerGrupoId($id){
        $this->db->query("SELECT * FROM v2grupo WHERE id_grupo = :idGrupo");
        $this->db->bind(':idGrupo', $id);
        return $this->db->registro();
    }

    public function obtenerHorarioId($id){
        $this->db->query("SELECT id_horario FROM v2horario_grupo WHERE id_grupo = :idGrupo");
        $this->db->bind(':idGrupo', $id);
        return $this->db->registros();
    }

    public function obtenerGruposHorarios(){
        $this->db->query("SELECT * FROM v2grupos_y_horarios");
        return $this->db->registros();
    }


    public function obtenerEntrenador(){
        $this->db->query("SELECT * FROM v2usuario WHERE id_rol=2");
        return $this->db->registros();
    }

    public function obtenerEntrenadorGrupo(){
        $this->db->query("SELECT * FROM v2entrenador_grupo");
        return $this->db->registros();
    }


    //obtiene alumnos por el id_grupo (tabla SOCIO_GRUPO)
    public function obtenerAlumnosUno($idGrupo){
        $this->db->query("SELECT id_grupo, v2socio_grupo.fecha_acep, aceptado, activo, v2socio_grupo.id_usuario, v2usuario.nombre, v2usuario.apellidos 
        from v2socio_grupo, v2usuario WHERE id_grupo = :idGrupo and v2usuario.id_usuario=v2socio_grupo.id_usuario and activo=1");
        $this->db->bind(':idGrupo',$idGrupo);
        return $this->db->registros();
    }
    public function obtenerAlumnosCero($idGrupo){
        $this->db->query("SELECT id_grupo, v2socio_grupo.fecha_acep, aceptado, activo, v2socio_grupo.id_usuario, v2usuario.nombre, v2usuario.apellidos 
        from v2socio_grupo, v2usuario WHERE id_grupo = :idGrupo and v2usuario.id_usuario=v2socio_grupo.id_usuario and activo=0");
        $this->db->bind(':idGrupo',$idGrupo);
        return $this->db->registros();
    }


    public function agregarGrupo($grupoNuevo){
        $this->db->query("INSERT INTO v2grupo (nombre, cuota, fecha_ini,fecha_fin) VALUES (:nombre, :cuota, :fechaInicio, :fechaFin)");
        $this->db->bind(':nombre', $grupoNuevo['nombre']);
        $this->db->bind(':cuota', $grupoNuevo['cuota']);
        $this->db->bind(':fechaInicio',$grupoNuevo['fecha_inicio']);
        $this->db->bind(':fechaFin',$grupoNuevo['fecha_fin']);
        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }
    }
       
   
     public function agregarHorario($diaSemana){
             $this->db->query("INSERT INTO v2horario (dia_sem, hora_ini,hora_fin) VALUES (:diaSem, :hora_ini, :hora_fin)");
             $this->db->bind(':diaSem', $diaSemana->dia);
             $this->db->bind(':hora_ini',$diaSemana->ini);
             $this->db->bind(':hora_fin',$diaSemana->fin);
             if ($this->db->execute()){
                 return $this->db->ultimoIndice();
             }else{
                 return false;
             }
    }


    public function agregarGrupoHorario($grupoNuevo){
        $this->db->query("INSERT INTO v2horario_grupo (id_horario,id_grupo) VALUES (:idHorario, :idGrupo)");
        $this->db->bind(':idHorario', $grupoNuevo['id_horario']);
        $this->db->bind(':idGrupo',$grupoNuevo['id_grupo']);
        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }
    }



    public function borrarGrupo($id_grupo,$horario){
        
        foreach($horario as $info){
              $hor=$info->id_horario;
                $this->db->query("DELETE FROM v2horario WHERE id_horario =:hor");
                $this->db->bind(':hor',$hor);
                $this->db->execute();
            }

        $this->db->query("DELETE FROM v2grupo WHERE id_grupo =:idGrupo");
        $this->db->bind(':idGrupo',$id_grupo);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function borrarHorario($id){
        foreach($id as $info){
            $this->db->query("DELETE FROM v2horario WHERE id_horario=:info");
            $this->db->bind(':info',$info);
            $this->db->execute();
        }
    }

    

    public function editarGrupo($grupo_modificado){
        $this->db->query("UPDATE v2grupo SET nombre=:nombre_grupo, cuota=:cuota, fecha_ini=:fecha_ini, fecha_fin=:fecha_fin WHERE id_grupo = :id_grupo");
        $this->db->bind(':id_grupo',$grupo_modificado['id_grupo']);
        $this->db->bind(':nombre_grupo', $grupo_modificado['nombre_grupo']);
        $this->db->bind(':cuota', $grupo_modificado['cuota']);
        $this->db->bind(':fecha_ini',$grupo_modificado['fecha_ini']);
        $this->db->bind(':fecha_fin', $grupo_modificado['fecha_fin']);
        $this->db->execute();
    }


    public function agregarEntrenadorGrupo($entrenador, $id_grupo){
        //var_dump($entrenador[0]);
     
         $this->db->query("INSERT INTO v2entrenador_grupo (fecha,id_grupo,id_usuario) VALUES (:hoy,:id_grupo,:entrenador)");
         $this->db->bind(':hoy', date('Y-m-d'));
         $this->db->bind(':id_grupo',$id_grupo);
         $this->db->bind(':entrenador',$entrenador[0]);
         $this->db->execute();
    }
  

    public function cambiarEstadoAlumno($alumnosActuales, $alumnosCero,$idGrupo){
        //llega array de string
        //var_dump($alumnosActuales);         
         //var_dump($alumnosCero);
         
             foreach($alumnosActuales as $idActuales){
                $this->db->query("UPDATE v2socio_grupo SET activo = 1 WHERE id_usuario = :idActual and id_grupo= :idGrupo");;
                $this->db->bind(':idActual',$idActuales);
                $this->db->bind(':idGrupo',$idGrupo);
                $this->db->execute();
             }

              foreach($alumnosCero as $idCero){
                   $this->db->query("UPDATE v2socio_grupo SET activo = 0 WHERE id_usuario = :idCero and id_grupo=:idGrupo");
                   $this->db->bind(':idCero',$idCero);
                   $this->db->bind(':idGrupo',$idGrupo);
                   $this->db->execute();   
              }
              return true;
    }
    



//**************************************** ENTRENADOR ************************************************/
    
   
    public function obtenerTestPruebas(){
        $this->db->query("SELECT v2test_prueba.id_test, v2test_prueba.id_prueba, v2test.nombreTest, v2prueba.nombrePrueba, v2prueba.tipo 
        from v2test, v2prueba ,v2test_prueba where v2test_prueba.id_test = v2test.id_test and v2test_prueba.id_prueba = v2prueba.id_prueba");
        $this->db->execute();
        return $this->db->registros();
    }

    public function info_grupos($id_entrenador){
        $this->db->query("SELECT * FROM v2grupo, v2entrenador_grupo where v2grupo.id_grupo=v2entrenador_grupo.id_grupo and id_usuario=:id_entrenador;");
        $this->db->bind(':id_entrenador',$id_entrenador);
        return $this->db->registros();
    }

    public function horarios_grupos(){
        $this->db->query("SELECT * FROM v2horario, v2horario_grupo where v2horario.id_horario=v2horario_grupo.id_horario;");
        return $this->db->registros();
    }


    // TODOS LOS GRUPOS que tiene un entrenador
    public function grupos_por_entrenador($id_entrenador){
        $this->db->query("SELECT * from v2grupo 
        left join  v2horario_grupo on v2grupo.id_grupo=v2horario_grupo.id_grupo
        left join v2horario on v2horario.id_horario=v2horario_grupo.id_horario
        left join v2entrenador_grupo on  v2entrenador_grupo.id_grupo=v2grupo.id_grupo
        where id_usuario=:id_entrenador");
        $this->db->bind(':id_entrenador',$id_entrenador);
        return $this->db->registros();
    }

    // info de UN GRUPO CONCRETO que tiene un entrenador
    public function grupo_concreto($id_entrenador,$id_grupo){
        $this->db->query("SELECT * from v2grupo 
        left join  v2horario_grupo on v2grupo.id_grupo=v2horario_grupo.id_grupo
        left join v2horario on v2horario.id_horario=v2horario_grupo.id_horario
        left join v2entrenador_grupo on  v2entrenador_grupo.id_grupo=v2grupo.id_grupo
        where id_usuario=:id_entrenador and v2grupo.id_grupo=:id_grupo;");

        $this->db->bind(':id_entrenador',$id_entrenador);
        $this->db->bind(':id_grupo',$id_grupo);
        return $this->db->registros();
    }
    

     //  TODOS LOS ALUMOS que hay EN UN GRUPO y por entrenador
    public function ver_alus_grupo($id_entrenador,$id_grupo){
        $this->db->query("SELECT v2socio_grupo.id_grupo, v2usuario.foto, v2usuario.id_usuario, v2usuario.nombre, apellidos, telefono, direccion, email,fecha_nacimiento,
        v2socio_grupo.id_categoria,v2categoria.nombre as categoria, v2socio_grupo.id_grupo, v2grupo.nombre as grupo
         from v2usuario, v2socio_grupo, v2grupo, v2categoria, v2entrenador_grupo
         where v2socio_grupo.id_usuario=v2usuario.id_usuario
         and v2categoria.id_categoria=v2socio_grupo.id_categoria
         and v2grupo.id_grupo=v2socio_grupo.id_grupo 
         and v2entrenador_grupo.id_grupo=v2grupo.id_grupo
         and v2socio_grupo.id_grupo=:id_grupo and v2entrenador_grupo.id_usuario=:id_entrenador");

        $this->db->bind(':id_entrenador',$id_entrenador);
        $this->db->bind(':id_grupo',$id_grupo);
        return $this->db->registros();

    }



    

    
    

    

}