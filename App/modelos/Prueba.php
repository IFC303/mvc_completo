<?php

class Prueba{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }


    public function obtenerPruebas(){
        $this->db->query("SELECT * FROM PRUEBA");
        return $this->db->registros();
    }


     public function obtenerPruebasTest($idTest){
         $this->db->query("SELECT TEST_PRUEBA.id_test,PRUEBA.nombrePrueba,PRUEBA.id_prueba FROM PRUEBA INNER JOIN TEST_PRUEBA 
                            ON TEST_PRUEBA.id_prueba=PRUEBA.id_prueba and TEST_PRUEBA.id_test=:idTest");
         $this->db->bind(':idTest', $idTest);
         return $this->db->registros();
     }


    //   public function obtenerMarcas(){
    //      $this->db->query("SELECT TEST.nombreTest,TEST.id_test,PRUEBA.tipo,PRUEBA.nombrePrueba,PRUEBA_SOCIO.id_prueba,id_usuario,fecha,marca 
    //      from PRUEBA_SOCIO,PRUEBA,TEST, TEST_PRUEBA
    //      WHERE PRUEBA.id_prueba=PRUEBA_SOCIO.id_prueba and TEST.id_test=TEST_PRUEBA.id_test AND TEST_PRUEBA.id_prueba=PRUEBA.id_prueba");
    //     return $this->db->registros();
    //   }


//----------------------------- ANOTAR MARCAS (entrenador) ----------------------//
     public function agregarMarca($nuevaMarca){
        var_dump($nuevaMarca);
       
          $this->db->query("INSERT INTO PRUEBA_SOCIO (id_usuario, id_prueba, id_test, fecha, marca, observaciones) 
          VALUES (:idUsuario, :idPrueba, :idTest, :fecha,:marca, :observaciones)");

          $this->db->bind(':idUsuario', $nuevaMarca['id_usuario']);
          $this->db->bind(':idPrueba', $nuevaMarca['id_prueba']);
          $this->db->bind(':idTest',$nuevaMarca['id_test']);
          $this->db->bind(':fecha',$nuevaMarca['fecha']);
          $this->db->bind(':marca',$nuevaMarca['marca']);          
          $this->db->bind(':observaciones',$nuevaMarca['observaciones']);
          
         if ($this->db->execute()){
             return $this->db->ultimoIndice();
         }else{
             return false;
         }
     }

//----------------------------- OBTENER MARCAS UN ALUMNO CONCRETO (entrenador) ----------------------//
     public function obtenerMarcasAlumno($alumno){
        $this->db->query("SELECT USUARIO.nombre, USUARIO.apellidos, TEST.nombreTest,
        PRUEBA.tipo,PRUEBA.nombrePrueba,PRUEBA_SOCIO.id,PRUEBA_SOCIO.id_prueba,PRUEBA_SOCIO.id_usuario,fecha,marca,PRUEBA_SOCIO.id_test, PRUEBA_SOCIO.observaciones
        from PRUEBA,TEST,PRUEBA_SOCIO,USUARIO WHERE USUARIO.id_usuario=PRUEBA_SOCIO.id_usuario and PRUEBA.id_prueba=PRUEBA_SOCIO.id_prueba 
        and TEST.id_test=prueba_socio.id_test and PRUEBA_SOCIO.id_usuario=:alumno");

        $this->db->bind(':alumno',$alumno);

        return $this->db->registros();
     }

//----------------------------- BORRAR MARCA DE UN ALUMNO (entrenador) ----------------------//
    public function borrarMarcaUsuario($id){
         $this->db->query("DELETE FROM PRUEBA_SOCIO WHERE id = :id");
         $this->db->bind(':id', $id);

         if ($this->db->execute()) {
             return true;
         } else {
             return false;
         }
    }









 





}