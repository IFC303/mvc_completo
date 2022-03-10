<?php

class Licencia
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


    public function obtenerLicencias(){
        $this->db->query("SELECT * FROM LICENCIA");
        return $this->db->registros();
    }


    public function agregarLicencia($licenciaNueva){
        
        $this->db->query("INSERT INTO LICENCIA (id_usuario, tipo ,num_licencia,regional_nacional,dorsal,fecha_cad,imagen) VALUES 
        (:id , :tipo , :num_lic, :aut/nac, :dorsal, :fechaCad , :imagenLicAdmin)");

        $this->db->bind(':id', 33);
        $this->db->bind(':tipo', 'Escolar');
        $this->db->bind(':num_lic',$licenciaNueva['num_lic']);
        $this->db->bind(':aut_nac', $licenciaNueva['aut_nac']);
        $this->db->bind(':dorsal',$licenciaNueva['dorsal']);
        $this->db->bind(':fechaCad',$licenciaNueva['fechaCad']);
        $this->db->bind(':imagenLicAdmin',$licenciaNueva['imagenLicAdmin']);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }
}