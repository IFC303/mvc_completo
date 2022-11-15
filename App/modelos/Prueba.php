<?php

class Prueba{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }


    public function obtenerPruebas(){
        $this->db->query("SELECT * FROM v2prueba");
        return $this->db->registros();
    }


     public function obtenerPruebasTest($idTest){
         $this->db->query("SELECT v2test_prueba.id_test, v2prueba.nombrePrueba, v2prueba.id_prueba FROM v2prueba INNER JOIN v2test_prueba
                            ON v2test_prueba.id_prueba=v2prueba.id_prueba and v2test_prueba.id_test=:idTest");
         $this->db->bind(':idTest', $idTest);
         return $this->db->registros();
     }


    //   public function obtenerMarcas(){
    //      $this->db->query("SELECT TEST.nombreTest,TEST.id_test,PRUEBA.tipo,PRUEBA.nombrePrueba,v2prueba_socio.id_prueba,id_usuario,fecha,marca 
    //      from v2prueba_socio,PRUEBA,TEST, TEST_PRUEBA
    //      WHERE PRUEBA.id_prueba=v2prueba_socio.id_prueba and TEST.id_test=TEST_PRUEBA.id_test AND TEST_PRUEBA.id_prueba=PRUEBA.id_prueba");
    //     return $this->db->registros();
    //   }


//----------------------------- ANOTAR MARCAS (entrenador) ----------------------//
     public function agregarMarca($nuevaMarca){
        var_dump($nuevaMarca);
       
          $this->db->query("INSERT INTO v2prueba_socio (id_usuario, id_prueba, id_test, fecha, marca, observaciones) 
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
        $this->db->query("SELECT v2usuario.nombre, v2usuario.apellidos, v2test.nombreTest,
        v2prueba.tipo, v2prueba.nombrePrueba, v2prueba_socio.id, v2prueba_socio.id_prueba, v2prueba_socio.id_usuario, fecha, marca, v2prueba_socio.id_test, v2prueba_socio.observaciones
        from v2prueba, v2test, v2prueba_socio, v2usuario 
        WHERE v2usuario.id_usuario=v2prueba_socio.id_usuario 
        and v2prueba.id_prueba=v2prueba_socio.id_prueba 
        and v2test.id_test=v2prueba_socio.id_test 
        and v2prueba_socio.id_usuario=:alumno");

        $this->db->bind(':alumno',$alumno);

        return $this->db->registros();
     }

//----------------------------- BORRAR MARCA DE UN ALUMNO (entrenador) ----------------------//
    public function borrarMarcaUsuario($id){
         $this->db->query("DELETE FROM v2prueba_socio WHERE id = :id");
         $this->db->bind(':id', $id);

         if ($this->db->execute()) {
             return true;
         } else {
             return false;
         }
    }









 





}