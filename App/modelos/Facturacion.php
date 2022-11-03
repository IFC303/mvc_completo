<?php

class Facturacion{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }



public function obtener_cuotas() {
    $this->db->query("SELECT id_ingreso, CONCAT(apellidos, ', ', nombre) AS 'apellidos_nombre', CCC, importe, dni, observaciones, fecha, concat(apellidos, ', ', nombre) as 'apellidos_nombre',
    direccion, direccion as 'cod_postal', direccion as 'poblacion', direccion as 'provincia' FROM ingresos NATURAL JOIN USUARIO 
    where tipo='Cuotas';");
    return $this->db->registros();
}



// /*******************************************************/
// /**************CONSULTAS INGRESOS **********************/
// /*******************************************************/


 public function obtenerIngresos(){
     $this->db->query("SELECT id_ingreso, fecha,tipo, importe, ingresos.id_usuario, ingresos.id_entidad, ingresos.id_participante, ingresos.observaciones,CONCAT(usuario.nombre,' ', apellidos) as inputado
     from ingresos, usuario where ingresos.id_usuario=usuario.id_usuario 
     union all
     select id_ingreso, fecha,tipo, importe, ingresos.id_usuario, ingresos.id_entidad, ingresos.id_participante, ingresos.observaciones, otras_entidades.nombre as inputado
     from ingresos, otras_entidades where ingresos.id_entidad=otras_entidades.id_entidad 
     union all
     SELECT id_ingreso, fecha,tipo, importe, ingresos.id_usuario, ingresos.id_entidad, ingresos.id_participante, ingresos.observaciones, CONCAT(participante.nombre,' ', apellidos) as inputado
     from ingresos, participante where ingresos.id_participante=participante.id_participante
     union all
     select id_ingreso, fecha, tipo, importe, id_usuario, id_entidad, id_participante, observaciones, CONCAT(null) as imputado
     from ingresos where ingresos.id_usuario is null and ingresos.id_entidad is null and ingresos.id_participante is null;");
     return $this->db->registros();
 }


public function obtenerUsuarios(){
     $this->db->query("SELECT * from USUARIO");
     return $this->db->registros();
 }

 public function obtenerEntidades(){
     $this->db->query("SELECT * from OTRAS_ENTIDADES");
     return $this->db->registros();
 }

 public function obtenerEventos(){
     $this->db->query("SELECT * from EVENTO");
     return $this->db->registros();
 }
 public function obtenerParticipantes(){
     $this->db->query("SELECT * from PARTICIPANTE");
     return $this->db->registros();
 }

 public function parti_even(){
    $this->db->query("SELECT participante.id_evento, participante.id_participante,participante.nombre, participante.apellidos, evento.nombre as evento from participante,evento
    where participante.id_evento=evento.id_evento;");
    return $this->db->registros();
 }



 public function nuevo_ingreso($ingreso){
     $this->db->query("INSERT INTO ingresos (fecha, tipo, importe,id_entidad, id_participante, id_usuario, observaciones) 
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
    $this->db->query("DELETE FROM ingresos WHERE id_ingreso =:id");
    $this->db->bind(':id',$id);
    if ($this->db->execute()){
        return true;
    }else{
        return false;
    }
}


public function editar_ingreso($ingreso,$id){
    $this->db->query("UPDATE ingresos set fecha=:fecha, tipo=:tipo, importe=:importe,id_entidad=:id_entidad,id_participante=:id_participante, id_usuario=:id_usuario,  observaciones=:concepto
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
        $this->db->query("SELECT id_gastos, fecha,tipo, importe, gastos.id_usuario, gastos.id_entidad, gastos.observaciones,CONCAT(usuario.nombre,' ', apellidos) as inputado
        from gastos, usuario
        where gastos.id_usuario=usuario.id_usuario 
        union all
        select id_gastos, fecha,tipo, importe, gastos.id_usuario, gastos.id_entidad, gastos.observaciones,otras_entidades.nombre as inputado
        from gastos, otras_entidades
        where gastos.id_entidad=otras_entidades.id_entidad 
        union all
        select id_gastos, fecha, tipo, importe, id_usuario, id_entidad, observaciones, CONCAT(null) as imputado
        from gastos where gastos.id_usuario is null and gastos.id_entidad is null");
        return $this->db->registros();
    }


    public function borrar_gasto($id){
        $this->db->query("DELETE FROM gastos WHERE id_gastos =:id");
        $this->db->bind(':id',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function nuevo_gasto($nuevo){
        $this->db->query("INSERT INTO gastos (fecha, tipo, importe, id_usuario, id_entidad, observaciones) 
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
        $this->db->query("UPDATE gastos set fecha=:fecha, tipo=:tipo, importe=:importe, id_usuario=:id_usuario, id_entidad=:id_entidad, observaciones=:observaciones
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