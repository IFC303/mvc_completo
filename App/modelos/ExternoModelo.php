<?php

class ExternoModelo{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function obtenerEventos(){
        $this->db->query("SELECT * FROM v2evento");
        return $this->db->registros();
    }

    public function obtener_tallas(){
        $this->db->query("SELECT * FROM v2talla");
        return $this->db->registros();
    }

    public function obtener_categoria(){
        $this->db->query("SELECT * FROM v2categoria");
        return $this->db->registros();
    }

    public function obtener_grupos(){
        $this->db->query("SELECT * FROM v2grupo");
        return $this->db->registros();
    }


  

    public function anadirSoliSocio($soliSociAnadir){       
        $this->db->query("INSERT INTO v2soli_socio (`DNI`, `nombre`, `apellidos`, `CCC`, `talla`, `fecha_nacimiento`, `email`, `telefono`, `direccion`, `ha_sido`,`nom_pa`,`ape_pa`,`dni_pa`,`fecha_soli`) 
        VALUES (:dniUsu,:nomUsu,:apelUsu,:cccUsu,:tallUsu,:fecUsu,:emaUsu,:telUsu,:direcUsu,:aSocio,:nom_pa,:ape_pa,:dni_pa, CURDATE());");

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
            $this->db->query("INSERT INTO v2soli_evento (id_evento, fecha, nombre, apellidos, DNI, fecha_nacimiento, direccion, email, telefono,foto) 
            VALUES (:evento, CURDATE(), :nombre, :apellidos,:dni, :fecha_naci, :direccion, :email, :telefono,:foto);");
            
            $this->db->bind(':nombre', $soli_eve['nombre']);
            $this->db->bind(':apellidos', $soli_eve['apellidos']);
            $this->db->bind(':fecha_naci', $soli_eve['fecha_naci']);
            $this->db->bind(':dni', $soli_eve['dni']);
            $this->db->bind(':direccion', $soli_eve['direccion']);
            $this->db->bind(':telefono', $soli_eve['telefono']);
            $this->db->bind(':email', $soli_eve['email']);
            $this->db->bind(':evento', $soli_eve['evento']);
            $this->db->bind(':foto', $soli_eve['foto']);
            $this->db->execute();

            $id_solicitud=$this->db->ultimoIndice();

         
             //COPIO LA FOTO EN EL DIRECTORIO Y CAMBIO NOMBRE EN LA BBDD  
            //$directorio = "/var/www/html/tragamillas/public/img/fotos_equipacion/";
            $directorio="C:/xampp/htdocs/tragamillas/public/img/justificantes/";   
            copy($_FILES['subirFoto']['tmp_name'], $directorio.$id_solicitud.'.jpg');
            chmod($directorio.$id_solicitud.'.jpg',0777);
    

            $foto=$id_solicitud.'.jpg';
            $this->db->query("UPDATE v2soli_evento SET foto=:foto where id_solicitud=:id;");
            $this->db->bind(':foto', $foto);  
            $this->db->bind(':id', $id_solicitud);       
            
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }



        public function soli_escuela($soli){
            $this->db->query("INSERT INTO v2soli_grupo (fecha_soli,dni, nombre, apellidos, cuenta, fecha_nacimiento, email, telefono, direccion,
            gir, id_categoria,id_grupo, es_socio, nom_pa, ape_pa, dni_pa, pago , foto) 
            VALUES (CURDATE(), :dni, :nombre, :apellidos,:cuenta, :fecha_naci,:email,:telf,:dire,:gir,:cat,:grup,:socio,:nom_pa,:ape_pa,:dni_pa,:pago,:foto);");

            $this->db->bind(':dni', $soli['dniUsuAna']);
            $this->db->bind(':nombre', $soli['nomUsuAna']);
            $this->db->bind(':apellidos', $soli['apelUsuAna']);
            $this->db->bind(':cuenta', $soli['cccUsuAna']);
            $this->db->bind(':fecha_naci', $soli['fecUsuAna']);
            $this->db->bind(':email', $soli['emaUsuAna']);
            $this->db->bind(':telf', $soli['telUsuAna']);
            $this->db->bind(':dire', $soli['direccionUsuAna']);
            $this->db->bind(':gir', $soli['gir']);
            $this->db->bind(':cat', $soli['cat']);
            $this->db->bind(':grup', $soli['grup']);
            $this->db->bind(':socio', $soli['primerAnoSocio']);
            $this->db->bind(':nom_pa', $soli['nom_pa']);
            $this->db->bind(':ape_pa', $soli['ape_pa']);
            $this->db->bind(':dni_pa', $soli['dni_pa']);
            $this->db->bind(':pago', $soli['pago']);
            $this->db->bind(':foto', $soli['foto']);
  
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }

        }




}
