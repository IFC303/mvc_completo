<?php

class Prueba
{
    private $db;

    public function __construct()
    {
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


     public function agregarMarca($nuevaMarca){
        //var_dump($nuevaMarca);
        //echo $nuevaMarca['marca'];
         $this->db->query("INSERT INTO PRUEBA_SOCIO (id_prueba,id_usuario,fecha,marca) VALUES (:idPrueba,:idUsuario,:fecha,:marca)");
         $this->db->bind(':idPrueba', $nuevaMarca['id_prueba']);
         $this->db->bind(':idUsuario', $nuevaMarca['id_usuario']);
         $this->db->bind(':fecha',$nuevaMarca['fecha']);
         $this->db->bind(':marca',$nuevaMarca['marca']);
         
         if ($this->db->execute()){
             return true;
         }else{
             return false;
         }
     }


     public function obtenerMarcas(){
        $this->db->query("SELECT TEST.nombreTest,TEST.id_test,PRUEBA.tipo,PRUEBA.nombrePrueba,PRUEBA_SOCIO.id_prueba,id_usuario,fecha,marca 
        from PRUEBA_SOCIO,PRUEBA,TEST, TEST_PRUEBA
        WHERE PRUEBA.id_prueba=PRUEBA_SOCIO.id_prueba and TEST.id_test=TEST_PRUEBA.id_test AND TEST_PRUEBA.id_prueba=PRUEBA.id_prueba");
        return $this->db->registros();
     }


     public function borrarMarcaUsuario($borrar){
        //var_dump($borrar);
        
         $this->db->query("DELETE FROM PRUEBA_SOCIO WHERE id_prueba = :id_prueba and id_usuario=:id_usuario");
         $this->db->bind(':id_prueba', $borrar['id_prueba']);
         $this->db->bind(':id_usuario', $borrar['id_usuario']);

         if ($this->db->execute()) {
             return true;
         } else {
             return false;
         }
        
    
    }





}