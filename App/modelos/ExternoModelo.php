<?php

class ExternoModelo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function obtenerEventos(){
        $this->db->query("SELECT * FROM `EVENTO`");
        return $this->db->registros();
    }


    // ******************** REGISTRA LA SOLICITUD DE SOCIO ******************* //
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


    public function obtener_soli_eventos(){
        $this->db->query("SELECT * FROM SOLICITUD_EXTER_EVENTO");

        return $this->db->registros();

    }

    // public function anadirSoliEven($agreEvento){
    //     $this->db->query("INSERT INTO EXTERNO (DNI, nombre, apellidos, fecha_nacimiento, email, telefono) 
    //     VALUES (:dniUsu, :nomUsu, :apelUsu, :fecUsu, :emaUsu, :telUsu);");
        
    //     $this->db->bind(':dniUsu', $agreEvento['dniUsuAna']);
    //     $this->db->bind(':nomUsu', $agreEvento['nomUsuAna']);
    //     $this->db->bind(':apelUsu', $agreEvento['apelUsuAna']);
    //     $this->db->bind(':fecUsu', $agreEvento['fecUsuAna']);
    //     $this->db->bind(':telUsu', $agreEvento['telUsuAna']);
    //     $this->db->bind(':emaUsu', $agreEvento['emaUsuAna']);
    //     $this->db->execute();
    //     $id_usu = $this->db->ultimoIndice();

    //     $this->db->query("INSERT INTO `SOLICITUD_EXTER_EVENTO` (`id_externo`, `id_evento`, `fecha`) VALUES ($id_usu, :id_even, :fecha);");

    //     $this->db->bind(':id_even', $agreEvento['evenUsuAna']);
    //     $this->db->bind(':fecha', date('Y-m-d'));
          
    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

}
