<?php

class Facturacion{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }



public function obtener_cuotas() {
    $this->db->query("SELECT id_ingreso, CONCAT(apellidos, ', ', nombre) AS 'apellidos_nombre', cuenta, importe, dni, observaciones, fecha, concat(apellidos, ', ', nombre) as 'apellidos_nombre',
    direccion, direccion as 'cod_postal', direccion as 'poblacion', direccion as 'provincia' FROM v2ingreso NATURAL JOIN v2usuario 
    where tipo='Cuotas';");
    return $this->db->registros();
}



// /*******************************************************/
// /**************CONSULTAS INGRESOS **********************/
// /*******************************************************/


 public function obtenerIngresos(){
     $this->db->query("SELECT id_ingreso, fecha,tipo, importe, v2ingreso.id_usuario, v2ingreso.id_entidad, v2ingreso.id_participante, v2ingreso.observaciones, CONCAT(v2usuario.nombre,' ', apellidos) as inputado
     from v2ingreso, v2usuario where v2ingreso.id_usuario = v2usuario.id_usuario 
     union all
     select id_ingreso, fecha,tipo, importe, v2ingreso.id_usuario, v2ingreso.id_entidad, v2ingreso.id_participante, v2ingreso.observaciones, v2entidad.nombre as inputado
     from v2ingreso, v2entidad where v2ingreso.id_entidad=v2entidad.id_entidad 
     union all
     SELECT id_ingreso, fecha,tipo, importe, v2ingreso.id_usuario, v2ingreso.id_entidad, v2ingreso.id_participante, v2ingreso.observaciones, CONCAT(v2participante.nombre,' ', apellidos) as inputado
     from v2ingreso, v2participante where v2ingreso.id_participante=v2participante.id_participante
     union all
     select id_ingreso, fecha, tipo, importe, id_usuario, id_entidad, id_participante, observaciones, CONCAT(null) as imputado
     from v2ingreso where v2ingreso.id_usuario is null and v2ingreso.id_entidad is null and v2ingreso.id_participante is null;");
     return $this->db->registros();
 }


public function obtenerUsuarios(){
     $this->db->query("SELECT * from v2usuario");
     return $this->db->registros();
 }

 public function obtenerEntidades(){
     $this->db->query("SELECT * from v2entidad");
     return $this->db->registros();
 }

 public function obtenerEventos(){
     $this->db->query("SELECT * from v2evento");
     return $this->db->registros();
 }
 public function obtenerParticipantes(){
     $this->db->query("SELECT * from v2participante");
     return $this->db->registros();
 }

 public function parti_even(){
    $this->db->query("SELECT v2participante.id_evento, v2participante.id_participante, v2participante.nombre, v2participante.apellidos, v2evento.nombre as evento 
    from v2participante, v2evento
    where v2participante.id_evento = v2evento.id_evento;");
    return $this->db->registros();
 }



 public function nuevo_ingreso($ingreso){
     $this->db->query("INSERT INTO v2ingreso (fecha, tipo, importe,id_entidad, id_participante, id_usuario, observaciones) 
                       VALUES (:fecha,:tipo,:importe,:id_entidad,:id_participante,:id_usuario,:observaciones)");

        $this->db->bind(':fecha',$ingreso['fecha']);
        $this->db->bind(':tipo', $ingreso['tipo']);
        $this->db->bind(':importe',$ingreso['importe']);


        if($ingreso['entidad']!=null){
            $this->db->bind(':id_entidad',$ingreso['entidad']);
        }else{
            $this->db->bind(':id_entidad',null);
        }

        if($ingreso['participante']!=null){
            $this->db->bind(':id_participante',$ingreso['participante']);
        }else{
            $this->db->bind(':id_participante',null);
        }
        
        if($ingreso['usuario']!=null){
            $this->db->bind(':id_usuario',$ingreso['usuario']);
        }else{
            $this->db->bind(':id_usuario',null);
        }

        $this->db->bind(':observaciones',$ingreso['observaciones']);

          if($this->db->execute()){
             return true;
          }else{
              return false;
          }
 }


 
 public function borrar_ingreso($id){
    $this->db->query("DELETE FROM v2ingreso WHERE id_ingreso =:id");
    $this->db->bind(':id',$id);
    if ($this->db->execute()){
        return true;
    }else{
        return false;
    }
}


public function editar_ingreso($ingreso,$id){
    $this->db->query("UPDATE v2ingreso set fecha=:fecha, tipo=:tipo, importe=:importe,id_entidad=:id_entidad,id_participante=:id_participante, id_usuario=:id_usuario,  observaciones=:concepto
    where id_ingreso=:id");

    $this->db->bind(':fecha',$ingreso['fecha']);
    $this->db->bind(':tipo',$ingreso['tipo']);
    $this->db->bind(':importe',$ingreso['importe']);


    if($ingreso['entidad']!=null){
        $this->db->bind(':id_entidad',$ingreso['entidad']);
    }else{
        $ingreso['entidad']=null;
        $this->db->bind(':id_entidad',$ingreso['entidad']);
    }

    if($ingreso['participante']!=null){
        $this->db->bind(':id_participante',$ingreso['participante']);
    }else{
        $ingreso['participante']=null;
        $this->db->bind(':id_participante',$ingreso['participante']);
    }
    
    if($ingreso['usuario']!=null){
        $this->db->bind(':id_usuario',$ingreso['usuario']);
    }else{
        $ingreso['usuario']=null;
        $this->db->bind(':id_usuario',$ingreso['usuario']);
    }

    $this->db->bind(':concepto',$ingreso['concepto']);


    $this->db->bind(':id',$id);


    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
}




/*******************************************************/
/************** CONSULTAS GASTOS **********************/
/*******************************************************/

   public function obtener_gastos(){
        $this->db->query("SELECT id_gastos, fecha,tipo, importe, v2gasto.id_usuario, v2gasto.id_entidad, v2gasto.observaciones, CONCAT(v2usuario.nombre,' ', apellidos) as inputado
        from v2gasto, v2usuario
        where v2gasto.id_usuario = v2usuario.id_usuario 
        union all
        select id_gastos, fecha,tipo, importe, v2gasto.id_usuario, v2gasto.id_entidad, v2gasto.observaciones, v2entidad.nombre as inputado
        from v2gasto, v2entidad
        where v2gasto.id_entidad = v2entidad.id_entidad 
        union all
        select id_gastos, fecha, tipo, importe, id_usuario, id_entidad, observaciones, CONCAT(null) as imputado
        from v2gasto where v2gasto.id_usuario is null and v2gasto.id_entidad is null");
        return $this->db->registros();
    }


    public function borrar_gasto($id){
        $this->db->query("DELETE FROM v2gasto WHERE id_gastos =:id");
        $this->db->bind(':id',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function nuevo_gasto($nuevo){
        $this->db->query("INSERT INTO v2gasto (fecha, tipo, importe, id_usuario, id_entidad, observaciones) 
        VALUES (:fecha,:tipo,:importe,:id_usuario,:id_entidad,:observaciones)");

        $this->db->bind(':fecha',$nuevo['fecha']);
        $this->db->bind(':tipo',$nuevo['tipo']);
        $this->db->bind(':importe',$nuevo['importe']);
        $this->db->bind(':id_usuario',$nuevo['usuario']);
        $this->db->bind(':id_entidad',$nuevo['entidad']);
        $this->db->bind(':observaciones',$nuevo['observaciones']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function editar_gasto($nuevo,$id){
        $this->db->query("UPDATE v2gasto set fecha=:fecha, tipo=:tipo, importe=:importe, id_usuario=:id_usuario, id_entidad=:id_entidad, observaciones=:observaciones
        where id_gastos=:id_gasto");

        $this->db->bind(':fecha',$nuevo['fecha']);
        $this->db->bind(':tipo',$nuevo['tipo']);
        $this->db->bind(':importe',$nuevo['importe']);
        $this->db->bind(':id_usuario',$nuevo['usuario']);
        $this->db->bind(':id_entidad',$nuevo['entidad']);
        $this->db->bind(':observaciones',$nuevo['observaciones']);
        $this->db->bind(':id_gasto',$id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }




 

  













    
    

 

   

   

    






   

  

    




  

}