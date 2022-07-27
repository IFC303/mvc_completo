<?php

class Test
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }



    public function obtenerTest(){
        $this->db->query("SELECT * FROM TEST");
        return $this->db->registros();
    }


    public function agregarSoloTest($datos){
        
        $this->db->query("INSERT INTO TEST (nombreTest,fecha_alta) VALUES (:nombre, CURDATE())");
        $this->db->bind(':nombre', $datos['nombreTest']);
        
        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }
    }


    public function agregarTodo($indice,$pruebasSelec){

              foreach($pruebasSelec as $selected){  
                  $this->db->query("INSERT INTO TEST_PRUEBA (id_test,id_prueba) VALUES (:idTest, :idPrueba)");
                  $this->db->bind(':idTest',$indice);
                  $this->db->bind(':idPrueba', $selected);
                  $this->db->execute();
              }

              return true;
    }



    public function obtenerTestId($id){
        $this->db->query("SELECT * FROM TEST WHERE id_test = :id");
        $this->db->bind(':id', $id);
        return $this->db->registro();
    }



    public function obtenerTestPrueba($id){
        $this->db->query("SELECT id_prueba FROM TEST_PRUEBA WHERE id_test = :id");
        $this->db->bind(':id', $id);
        return $this->db->registros();
    }




    public function borrarTest($id){
        $this->db->query("DELETE FROM TEST WHERE id_test = :id");
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function modificarTest($eliminar,$insertar,$testModificado){
        //var_dump($testModificado);
        
                //actualizamos tabla TEST (nombre)
                    $this->db->query("UPDATE TEST SET nombreTest=:nombreTest WHERE id_test = :id_test");
                    $this->db->bind(':id_test',$testModificado['id_test']);
                    $this->db->bind(':nombreTest', $testModificado['nombreTest']);
                    $this->db->execute();
                  

                 //INSERTAMOS en tabla TEST_PRUEBA
                 foreach($insertar as $insert){  
                     $this->db->query("INSERT INTO TEST_PRUEBA (id_test,id_prueba) VALUES (:id_test, :id_prueba)");
                     $this->db->bind(':id_test',$testModificado['id_test']);
                     $this->db->bind(':id_prueba', $insert);
                     $this->db->execute();
                 }
                 
                //ELIMINAMOS en tabla TEST_PRUEBA
                  foreach($eliminar as $elim){  
                     $this->db->query("DELETE FROM TEST_PRUEBA WHERE id_test=:id_test and id_prueba=:id_prueba");
                     $this->db->bind(':id_test',$testModificado['id_test']);
                     $this->db->bind(':id_prueba', $elim);
                     $this->db->execute();
                  }
     
                    return true;    
    }



}