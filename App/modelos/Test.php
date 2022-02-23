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



    public function agregarTest($datos,$pruebasSelec){
        
        $this->db->query("INSERT INTO TEST (id_test,nombreTest) VALUES (:idTest, :nombre)");
        $this->db->bind(':idTest',$datos['id_test']);
        $this->db->bind(':nombre', $datos['nombreTest']);
        
        if ($this->db->execute()) {
            foreach($pruebasSelec as $selected){  
                $this->db->query("INSERT INTO TEST_PRUEBA (id_test,id_prueba) VALUES (:idTest, :idPrueba)");
                $this->db->bind(':idTest',$datos['id_test']);
                $this->db->bind(':idPrueba', $selected);
                    if(!$this->db->execute()){
                        return false;
                    }
            }   
            return true;
        } else {
            return false;
        }
    }



    public function obtenerTestId($id){
        $this->db->query("SELECT * FROM TEST WHERE id_test = :id");
        $this->db->bind(':id', $id);
        return $this->db->registro();
    }



    public function obtenerTestPrueba($id){
        $this->db->query("SELECT * FROM TEST_PRUEBA WHERE id_test = :id");
        $this->db->bind(':id', $id);
        return $this->db->registros();
    }




    public function borrarTest($id){
        $this->db->query("DELETE FROM TEST WHERE id_test = :id");
        $this->db->bind(':id', $id);

        // $this->db->query("DELETE FROM TEST_PRUEBA WHERE id_prueba = :id_prueba AND id_test=:id" );
        // $this->db->bind(':id_prueba', $id_);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function modificarTest($testModificado,$datos){
        
        //actualizamos tabla TEST
          $this->db->query("UPDATE TEST SET nombreTest=:nombreTest WHERE id_test = :id_test");
          $this->db->bind(':id_test',$testModificado['id_test']);
          $this->db->bind(':nombreTest', $testModificado['nombreTest']);

       
          if ($this->db->execute()) {

                foreach($datos['test_prueba'] as $idPrueba){  
                    foreach($testModificado['id_prueba'] as $modificado){
                        if(!$idPrueba=$modificado){
                        $this->datos['eliminar']=$idPrueba;

                        $this->db->query("DELETE FROM TEST_PRUEBA WHERE id_test=:id_test AND id_prueba=:id_prueba");
                        $this->db->bind(':id_test',$testModificado['id_test']);
                        $this->db->bind(':id_prueba', $this->datos['eliminar']);
                        return $this->db->registros();
                        }
                    }
                }


                foreach($testModificado['id_prueba'] as $modificado){  
                    foreach($datos['test_prueba'] as $idPrueba){
                        if(!$modificado=$idPrueba){
                            $this->datos['insertar']=$modificado;

                            $this->db->query("INSERT INTO TEST_PRUEBA (id_test,id_prueba) VALUES (:id_test, :id_prueba)");
                            $this->db->bind(':id_test',$testModificado['id_test']);
                            $this->db->bind(':id_prueba', $this->datos['insertar']);
                            return $this->db->registros();
                        }
                    }
                }
                return true;
            }else{
                return false;
            }


    }




}