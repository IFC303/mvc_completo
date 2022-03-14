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
    public function obtenerAlumnos($idGrupo){
        $this->db->query("SELECT id_grupo, fecha_inscripcion, acepatado, activo, SOCIO_GRUPO.id_usuario, USUARIO.nombre, USUARIO.apellidos 
        from SOCIO_GRUPO, USUARIO WHERE id_grupo = :idGrupo and USUARIO.id_usuario=SOCIO_GRUPO.id_usuario");
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


    public function agregarEntrenadorGrupo($hoy,$id_grupo,$entrenador){
         $this->db->query("INSERT INTO ENTRENADOR_GRUPO (fecha,id_grupo,id_usuario) VALUES (:hoy,:id_grupo,:entrenador)");
         $this->db->bind(':hoy', $hoy);
         $this->db->bind(':id_grupo',$id_grupo);
         $this->db->bind(':entrenador',$entrenador);
         if ($this->db->execute()){
             return true;
         }else{
             return false;
         }
    }
  

    public function cambiarEstadoAlumno($info){
        $this->db->query("UPDATE SOCIO_GRUPO SET activo=1 WHERE id_usuario = :idAlumno");
            $this->db->bind(':idAlumno',$info);
             if ($this->db->execute()){
                 return true;
             }else{
                 return false;
             }
    }

    
    public function obtenerTestPruebas(){
        $this->db->query("SELECT TEST_PRUEBA.id_test, TEST_PRUEBA.id_prueba, TEST.nombreTest, PRUEBA.nombrePrueba, PRUEBA.tipo 
        from TEST,PRUEBA,TEST_PRUEBA where TEST_PRUEBA.id_test=TEST.id_test and TEST_PRUEBA.id_prueba=PRUEBA.id_prueba");
        $this->db->execute();
        return $this->db->registros();
    }

    

}