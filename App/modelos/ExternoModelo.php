<?php

class ExternoModelo{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function obtenerEventos(){
        $this->db->query("SELECT * FROM `EVENTO`");
        return $this->db->registros();
    }


  

    public function anadirSoliSocio($soliSociAnadir){       
        $this->db->query("INSERT INTO `SOLICITUD_SOCIO` (`DNI`, `nombre`, `apellidos`, `CCC`, `talla`, `fecha_nacimiento`, `email`, `telefono`, `direccion`, `ha_sido`,`nom_pa`,`ape_pa`,`dni_pa`) 
        VALUES (:dniUsu,:nomUsu,:apelUsu,:cccUsu,:tallUsu,:fecUsu,:emaUsu,:telUsu,:direcUsu,:aSocio,:nom_pa,:ape_pa,:dni_pa);");

        $this->db->bind(':dniUsu', $soliSociAnadir['dniUsuAna']); 
        $this->db->bind(':nomUsu', $soliSociAnadir['nomUsuAna']);
        $this->db->bind(':apelUsu', $soliSociAnadir['apelUsuAna']);
        $this->db->bind(':cccUsu', $soliSociAnadir['cccUsuAna']);
        $this->db->bind(':tallUsu', $soliSociAnadir['tallaUsuAna']);
        $this->db->bind(':fecUsu', $soliSociAnadir['fecUsuAna']);
        $this->db->bind(':emaUsu', $soliSociAnadir['emaUsuAna']);
        $this->db->bind(':telUsu', $soliSociAnadir['telUsuAna']);
        $this->db->bind(':direcUsu', $soliSociAnadir['direccionUsuAna']);

        if($soliSociAnadir['primerAnoSocio']=="si"){
            $soliSociAnadir['primerAnoSocio']=1;
        }elseif($soliSociAnadir['primerAnoSocio']=="no"){
            $soliSociAnadir['primerAnoSocio']=0;}
        
        $this->db->bind(':aSocio', $soliSociAnadir['primerAnoSocio']);       
        $this->db->bind(':nom_pa',$soliSociAnadir['nom_pa']);  
        $this->db->bind(':ape_pa',$soliSociAnadir['ape_pa']);  
        $this->db->bind(':dni_pa',$soliSociAnadir['dni_pa']);     
        
        if ($this->db->execute()) {
           return true;
        }else 
            return false;        
    }




      public function anadir_soli_eve($soli_eve){
            $this->db->query("INSERT INTO SOLICITUD_EVENTO (id_evento, fecha, nombre, apellidos, DNI, fecha_nacimiento, direccion, email, telefono) 
            VALUES (:evento, CURDATE(), :nombre, :apellidos,:dni, :fecha_naci, :direccion, :email, :telefono);");
            
            $this->db->bind(':nombre', $soli_eve['nombre']);
            $this->db->bind(':apellidos', $soli_eve['apellidos']);
            $this->db->bind(':fecha_naci', $soli_eve['fecha_naci']);
            $this->db->bind(':dni', $soli_eve['dni']);
            $this->db->bind(':direccion', $soli_eve['direccion']);
            $this->db->bind(':telefono', $soli_eve['telefono']);
            $this->db->bind(':email', $soli_eve['email']);
            $this->db->bind(':evento', $soli_eve['evento']);
            
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }



        public function soli_escuela(){

            // if ($this->db->execute()) {
            //     return true;
            // } else {
            //     return false;
            // }

        }




}
