<?php

class Facturacion
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


//********** CONSULTAS GASTOS ************//

   public function obtenerGastos(){
        $this->db->query("SELECT * from GASTOS");
        return $this->db->registros();
    }

    public function gastosPersonal(){
        $this->db->query("SELECT id_gasto, fecha, concepto, importe, G_PERSONAL.id_usuario,USUARIO.nombre,USUARIO.apellidos 
        from USUARIO, G_PERSONAL WHERE USUARIO.id_usuario=G_PERSONAL.id_usuario;");
        return $this->db->registros();
    }

    public function gastosOtrosUsuario(){
        $this->db->query("SELECT id_gastos, fecha, concepto, importe, G_OTROS.id_usuario,USUARIO.nombre,USUARIO.apellidos 
        from USUARIO, G_OTROS WHERE USUARIO.id_usuario=G_OTROS.id_usuario;");
        return $this->db->registros();
    }

    public function gastosOtrosEntidad(){
        $this->db->query("SELECT id_gastos, fecha, concepto, importe, G_OTROS.id_entidad,OTRAS_ENTIDADES.nombre
        from OTRAS_ENTIDADES, G_OTROS WHERE OTRAS_ENTIDADES.id_entidad=G_OTROS.id_usuario;");
        return $this->db->registros();
    }



//********** CONSULTAS INGRESOS ************//

    public function obtenerIngresos(){
        $this->db->query("SELECT * from INGRESOS");
        return $this->db->registros();
    }

    
    //OBTENER SOCIOS PARA INGRESO CUOTAS
     public function obtenerSocios(){
        $this->db->query("SELECT SOCIO.id_socio,USUARIO.nombre,USUARIO.apellidos from SOCIO, USUARIO 
        where SOCIO.id_socio=USUARIO.id_usuario");
        return $this->db->registros();
    }
    //INGRESOs CUOTAS
    public function obtenerIngresosCuotas(){
        $this->db->query("SELECT id_ingreso_cuota, fecha, concepto, importe, I_CUOTAS.id_usuario,USUARIO.nombre,USUARIO.apellidos 
        from USUARIO, I_CUOTAS WHERE USUARIO.id_usuario=I_CUOTAS.id_usuario;");
        return $this->db->registros();
    }

    //OBTENER ENTIDADES PARA INGRESO EN OTROS
    public function obtenerEntidades(){
        $this->db->query("SELECT * from OTRAS_ENTIDADES");
        return $this->db->registros();
    }
    //INGRESOS OTROS
    public function obtenerIngresosOtros(){
        $this->db->query("SELECT id_ingreso_otros, fecha, concepto, importe,I_OTROS.id_entidad,OTRAS_ENTIDADES.nombre
        from OTRAS_ENTIDADES, I_OTROS where OTRAS_ENTIDADES.id_entidad=I_OTROS.id_entidad;");
        return $this->db->registros();
    }
   
    //OBTENER EVENTOS PARA INGRESO ACTIVIDADES
    public function obtenerEventos(){
        $this->db->query("SELECT * from EVENTO");
        return $this->db->registros();
    }
    //OBTENER PARTICIPAMTES (socio y externo) PARA INGRESO ACTIVIDADES
    public function obtenerParticipante(){
        $this->db->query("SELECT * from PARTICIPANTE");
        return $this->db->registros();
    }


    // AÑADIR NUEVO INGRESO
    public function agregarIngreso($ingreso){
     
        if($ingreso['tipo']=="cuotas"){
            $this->db->query("INSERT INTO I_CUOTAS (fecha, concepto, importe,id_usuario) 
                              VALUES (:fecha,:concepto,:importe,:id_socio)");

            $this->db->bind(':fecha',$ingreso['fecha']);
            $this->db->bind(':concepto', $ingreso['concepto']);
            $this->db->bind(':importe',$ingreso['importe']);
            $this->db->bind(':id_socio',$ingreso['id_socio']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }elseif($ingreso['tipo']=="otros"){
            $this->db->query("INSERT INTO I_OTROS (fecha, concepto, importe,id_entidad) 
                              VALUES (:fecha,:concepto,:importe,:id_entidad)");
            $this->db->bind(':fecha',$ingreso['fecha']);
            $this->db->bind(':concepto', $ingreso['concepto']);
            $this->db->bind(':importe',$ingreso['importe']);
            $this->db->bind(':id_entidad',$ingreso['id_entidad']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }elseif($ingreso['tipo']=="actividades"){

            if($ingreso['tipo_participante']=="socio"){
                $this->db->query("INSERT INTO I_ACTIVIDADES (id_usuario,id_evento,fecha, concepto, importe) 
                                  VALUES (:id_usuario,:id_evento,:fecha,:concepto,:importe)");
                $this->db->bind(':id_usuario',$ingreso['id_participante']);
                $this->db->bind(':id_evento',$ingreso['evento']);
                $this->db->bind(':fecha',$ingreso['fecha']);
                $this->db->bind(':concepto', $ingreso['concepto']);
                $this->db->bind(':importe',$ingreso['importe']);

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                $this->db->query("INSERT INTO I_ACTIVIDADES (id_externo,id_evento,fecha, concepto, importe) 
                                  VALUES (:id_externo,:id_evento,:fecha,:concepto,:importe)");
                $this->db->bind(':id_externo',$ingreso['id_participante']);
                $this->db->bind(':id_evento',$ingreso['evento']);
                $this->db->bind(':fecha',$ingreso['fecha']);
                $this->db->bind(':concepto', $ingreso['concepto']);
                $this->db->bind(':importe',$ingreso['importe']);

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }


    //FUNCIONES BORRADO INGRESOS
    public function borrarIngresoCuotas($id){
        $this->db->query("DELETE FROM I_CUOTAS WHERE id_ingreso_cuota =:idIngreso");
        $this->db->bind(':idIngreso',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function borrarIngresoActividades($id){
        $this->db->query("DELETE FROM I_ACTIVIDADES WHERE id_ingreso_actividades =:idIngreso");
        $this->db->bind(':idIngreso',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function borrarIngresoOtros($id){
        $this->db->query("DELETE FROM I_OTROS WHERE id_ingreso_otros =:idIngreso");
        $this->db->bind(':idIngreso',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
















   
    public function ingresosActividadesSocios(){
        $this->db->query("SELECT id_ingreso_actividades,I_ACTIVIDADES.id_externo,I_ACTIVIDADES.id_usuario, I_ACTIVIDADES.id_evento,fecha,concepto, importe,
        USUARIO.nombre,USUARIO.apellidos, EVENTO.nombre as nom_evento from USUARIO,I_ACTIVIDADES,EVENTO 
        where USUARIO.id_usuario=I_ACTIVIDADES.id_usuario and EVENTO.id_evento=I_ACTIVIDADES.id_evento;");
        return $this->db->registros();
    }

    public function ingresosActividadesExternos(){
        $this->db->query("SELECT id_ingreso_actividades, I_ACTIVIDADES.id_externo,I_ACTIVIDADES.id_externo,I_ACTIVIDADES.id_evento,fecha,concepto, importe,
        EXTERNO.nombre,EXTERNO.apellidos, EVENTO.nombre as nom_evento from EXTERNO,I_ACTIVIDADES,EVENTO
        where EXTERNO.id_externo=I_ACTIVIDADES.id_externo and EVENTO.id_evento=I_ACTIVIDADES.id_evento ;");
        return $this->db->registros();
    }

   


    
    

 

   

   

    






   

  

    




  

}