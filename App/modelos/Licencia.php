<?php

class Licencia
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


    public function obtenerNombreSocio()
    {
        $this->db->query("SELECT nombre, id_usuario FROM USUARIO ");

        return $this->db->registros();
    }

    public function obtenerLicencias(){
        $this->db->query("SELECT * FROM LICENCIA");
        return $this->db->registros();
    }


    public function obtenerSocioLicencia(){
        $this->db->query("SELECT * FROM LICENCIA, USUARIO WHERE USUARIO.id_usuario = LICENCIA.id_usuario");
        return $this->db->registros();
    }

    public function agregarLicencia($licenciaNueva){
        
        $this->db->query("INSERT INTO LICENCIA (id_usuario, tipo ,num_licencia,regional_nacional,dorsal,fecha_cad,imagen) VALUES 
        (:id , :tipo , :num_lic, :aut_nac, :dorsal, :fechaCad , :imagenLicAdmin)");

        $this->db->bind(':id', $licenciaNueva['usuario']);
        $this->db->bind(':tipo', 'Escolar');
        $this->db->bind(':num_lic',$licenciaNueva['num_lic']);

        $this->db->bind(':aut_nac', $licenciaNueva['aut_nac']);
        if ($licenciaNueva['aut_nac']==1) {
            $this->db->bind(':aut_nac', 'Autonómica');
        }elseif ($licenciaNueva['aut_nac']==2) {
            $this->db->bind(':aut_nac', 'Nacional');
        }elseif ($licenciaNueva['aut_nac']==0) {
            $this->db->bind(':aut_nac', NULL);
        }
        
        if ($licenciaNueva['dorsal']=="") {
            $this->db->bind(':dorsal', NULL);    
        }else {
            $this->db->bind(':dorsal', $licenciaNueva['dorsal']);
        }
        
        if ($licenciaNueva['fechaCad']=="") {
            $this->db->bind(':fechaCad', NULL);    
        }else {
            $this->db->bind(':fechaCad', $licenciaNueva['fechaCad']);
        }

        if ($licenciaNueva['imagenLicAdmin']=="") {
            $this->db->bind(':imagenLicAdmin',NULL);
        }else {
            $this->db->bind(':imagenLicAdmin',$licenciaNueva['imagenLicAdmin']);
        }
        
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function borrarLicencia($num_lic){
        $this->db->query("DELETE FROM LICENCIA WHERE num_licencia =:num_licencia");
        $this->db->bind(':num_licencia',$num_lic);

        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



    public function editarLicencia($licencia_modificada){
        
        if ($licencia_modificada['imagen']=="") {
            $this->db->query("UPDATE LICENCIA SET num_licencia=:num_licencia, tipo=:tipo, num_licencia=:num_licencia, dorsal=:dorsal, fecha_cad=:fecha_cad WHERE num_licencia = :num_licencia");
        }else {
            $this->db->query("UPDATE LICENCIA SET num_licencia=:num_licencia, tipo=:tipo, num_licencia=:num_licencia, dorsal=:dorsal, fecha_cad=:fecha_cad, imagen=:imagen WHERE num_licencia = :num_licencia");
        }

        
        
        
        $this->db->bind(':num_licencia',$licencia_modificada['num_licencia']);

        $this->db->bind(':tipo', $licencia_modificada['tipo']);

        if ($licencia_modificada['tipo']==1) {
            $this->db->bind(':tipo', 'Federativa');
        }elseif ($licencia_modificada['tipo']==2) {
            $this->db->bind(':tipo', 'Escolar');
        }

        if ($licencia_modificada['regional_nacional']==1) {
            $this->db->bind(':regional_nacional', 'Autonómica');
        }elseif ($licencia_modificada['regional_nacional']==2) {
            $this->db->bind(':regional_nacional', 'Nacional');
        }elseif ($licencia_modificada['regional_nacional']==0) {
            $this->db->bind(':regional_nacional', NULL);
        }

        if ($licencia_modificada['dorsal']=="") {
            $this->db->bind(':dorsal', NULL);    
        }else {
            $this->db->bind(':dorsal', $licencia_modificada['dorsal']);
        }
        
        if ($licencia_modificada['fecha_cad']=="") {
            $this->db->bind(':fecha_cad', NULL);    
        }else {
            $this->db->bind(':fecha_cad', $licencia_modificada['fecha_cad']);
        }
 
        $this->db->bind(':imagen',$licencia_modificada['imagen']);
               
        
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}