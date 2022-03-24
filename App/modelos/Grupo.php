<?php

class Grupo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


    public function obtenerGrupos(){
        $this->db->query("SELECT * FROM GRUPO");
        return $this->db->registros();
    }


    public function obtenerGrupoId($id){
        $this->db->query("SELECT * FROM GRUPO WHERE id_grupo = :idGrupo");
        $this->db->bind(':idGrupo', $id);
        return $this->db->registro();
    }

    public function obtenerHorarioId($id){
        $this->db->query("SELECT id_horario FROM HORARIO_GRUPO WHERE id_grupo = :idGrupo");
        $this->db->bind(':idGrupo', $id);
        return $this->db->registros();
    }

    public function obtenerGruposHorarios(){
        $this->db->query("SELECT * FROM GRUPOS_Y_HORARIOS");
        return $this->db->registros();
    }


    public function obtenerEntrenador(){
        $this->db->query("SELECT * FROM USUARIO WHERE id_rol=2");
        return $this->db->registros();
    }

    public function obtenerEntrenadorGrupo(){
        $this->db->query("SELECT * FROM ENTRENADOR_GRUPO");
        return $this->db->registros();
    }

    //obtiene alumnos por el id_grupo (tabla SOCIO_GRUPO)
    public function obtenerAlumnosUno($idGrupo){
        $this->db->query("SELECT id_grupo, fecha_inscripcion, acepatado, activo, SOCIO_GRUPO.id_usuario, USUARIO.nombre, USUARIO.apellidos 
        from SOCIO_GRUPO, USUARIO WHERE id_grupo = :idGrupo and USUARIO.id_usuario=SOCIO_GRUPO.id_usuario and activo=1");
        $this->db->bind(':idGrupo',$idGrupo);
        return $this->db->registros();
    }
    public function obtenerAlumnosCero($idGrupo){
        $this->db->query("SELECT id_grupo, fecha_inscripcion, acepatado, activo, SOCIO_GRUPO.id_usuario, USUARIO.nombre, USUARIO.apellidos 
        from SOCIO_GRUPO, USUARIO WHERE id_grupo = :idGrupo and USUARIO.id_usuario=SOCIO_GRUPO.id_usuario and activo=0");
        $this->db->bind(':idGrupo',$idGrupo);
        return $this->db->registros();
    }


    public function agregarGrupo($grupoNuevo){
        $this->db->query("INSERT INTO GRUPO (nombre,fecha_ini,fecha_fin) VALUES (:nombre, :fechaInicio, :fechaFin)");
        $this->db->bind(':nombre', $grupoNuevo['nombre']);
        $this->db->bind(':fechaInicio',$grupoNuevo['fecha_inicio']);
        $this->db->bind(':fechaFin',$grupoNuevo['fecha_fin']);
        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }
    }
       
   
     public function agregarHorario($diaSemana){
             $this->db->query("INSERT INTO HORARIO (dia_sem, hora_ini,hora_fin) VALUES (:diaSem, :hora_ini, :hora_fin)");
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
        $this->db->query("INSERT INTO HORARIO_GRUPO (id_horario,id_grupo) VALUES (:idHorario, :idGrupo)");
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
                $this->db->query("DELETE FROM HORARIO WHERE id_horario =:hor");
                $this->db->bind(':hor',$hor);
                $this->db->execute();
            }

        $this->db->query("DELETE FROM GRUPO WHERE id_grupo =:idGrupo");
        $this->db->bind(':idGrupo',$id_grupo);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function borrarHorario($id){
        foreach($id as $info){
            $this->db->query("DELETE FROM HORARIO WHERE id_horario=:info");
            $this->db->bind(':info',$info);
            $this->db->execute();
        }
    }

    

    public function editarGrupo($grupo_modificado){
        $this->db->query("UPDATE GRUPO SET nombre=:nombre_grupo, fecha_ini=:fecha_ini, fecha_fin=:fecha_fin WHERE id_grupo = :id_grupo");
        $this->db->bind(':id_grupo',$grupo_modificado['id_grupo']);
        $this->db->bind(':nombre_grupo', $grupo_modificado['nombre_grupo']);
        $this->db->bind(':fecha_ini',$grupo_modificado['fecha_ini']);
        $this->db->bind(':fecha_fin', $grupo_modificado['fecha_fin']);
        $this->db->execute();
    }


    public function agregarEntrenadorGrupo($entrenador, $id_grupo){
        //var_dump($entrenador[0]);
     
         $this->db->query("INSERT INTO ENTRENADOR_GRUPO (fecha,id_grupo,id_usuario) VALUES (:hoy,:id_grupo,:entrenador)");
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
                $this->db->query("UPDATE SOCIO_GRUPO SET activo = 1 WHERE id_usuario = :idActual and id_grupo=:idGrupo");;
                $this->db->bind(':idActual',$idActuales);
                $this->db->bind(':idGrupo',$idGrupo);
                $this->db->execute();
           
             }

              foreach($alumnosCero as $idCero){
                   $this->db->query("UPDATE SOCIO_GRUPO SET activo = 0 WHERE id_usuario = :idCero and id_grupo=:idGrupo");
                   $this->db->bind(':idCero',$idCero);
                   $this->db->bind(':idGrupo',$idGrupo);
                   $this->db->execute();   
              }     
              
              return true;
    }
    



///ENTRENADOR
    
    public function obtenerTestPruebas(){
        $this->db->query("SELECT TEST_PRUEBA.id_test, TEST_PRUEBA.id_prueba, TEST.nombreTest, PRUEBA.nombrePrueba, PRUEBA.tipo 
        from TEST,PRUEBA,TEST_PRUEBA where TEST_PRUEBA.id_test=TEST.id_test and TEST_PRUEBA.id_prueba=PRUEBA.id_prueba");
        $this->db->execute();
        return $this->db->registros();
    }


    //todos los socios de los grupos de un UNICO ENTRENADOR
    public function todosSociosGrupos($id_entrenador){
        $this->db->query("SELECT CATEGORIA.id_categoria, CATEGORIA.nombre as nombre_categoria, USUARIO.id_usuario, USUARIO.nombre, USUARIO.apellidos,
                        GRUPO.id_grupo,GRUPO.nombre as nombre_grupo,
                        ENTRENADOR_GRUPO.id_usuario as id_entrenador
                        from USUARIO,CATEGORIA,CATEGORIA_SOCIO,GRUPO,SOCIO_GRUPO, ENTRENADOR_GRUPO
                        where CATEGORIA_SOCIO.id_categoria=CATEGORIA.id_categoria and CATEGORIA_SOCIO.id_usuario=USUARIO.id_usuario 
                        and SOCIO_GRUPO.id_grupo=GRUPO.id_grupo and USUARIO.id_usuario=SOCIO_GRUPO.id_usuario
                        and ENTRENADOR_GRUPO.id_usuario=:id_entrenador and ENTRENADOR_GRUPO.id_grupo=GRUPO.id_grupo");
                        $this->db->bind(':id_entrenador',$id_entrenador);
                        $this->db->execute();
                        return $this->db->registros();
    }

    
    //todos los grupos de un UNICO ENTRENADOR
    public function todosEntrenadoresGrupos($id_entrenador){
        $this->db->query("SELECT GRUPO.id_grupo, GRUPO.nombre as nombre_grupo, USUARIO.id_usuario,USUARIO.nombre, USUARIO.apellidos
            from USUARIO,GRUPO,ENTRENADOR_GRUPO
            where ENTRENADOR_GRUPO.id_grupo=GRUPO.id_grupo and ENTRENADOR_GRUPO.id_usuario=USUARIO.id_usuario
            and ENTRENADOR_GRUPO.id_usuario=$id_entrenador");
        $this->db->execute();
        return $this->db->registros();
    }



    
    

    

}