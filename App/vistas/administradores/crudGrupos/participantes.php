<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/css/estilos.css">
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <title><?php echo NOMBRE_SITIO?></title>

</head>

<style>
 
 #ventana{
    margin: auto;
    width:60%;
    background-color:#EBECEC;
} 

label, h2,p{
   color:#023ef9;
}

p{
    margin-left:35px;
}

.btn{
    background-color: #023ef9; 
    color:white;
    margin-left:35px;
}

#botonVolver{
    background-color:white; 
    color:#023ef9;
    border-color:#023ef9;
}

#entrenadores, #alumnos,#cajaEntrenador,#cajaAlumnos{
    background-color:white;
}
</style>



<body>
    


<div id="ventana" class="card">
    
    <h2 class="card-header">Gestion de participantes</h2>
    
    <div class="container card-body">

            <!--DRAG & DROP ENTRENADOR-->
            <div class="row">
                <div class="col">
                    <p>Entrenadores disponibles</p>
                </div>
                <div class="col">
                    <p>Entrenador en el grupo</p>
                </div>
            </div>


            
            <div class="row d-flex justify-content-around">
                <div id="entrenadores" class="col-5" ondragover="sobre(event);" ondrop="suelta2(event);">

                    <script>

                        let entCero = <?php echo json_encode($datos['entrenadores']);?>;
  
                        var di=document.getElementById("entrenadores"); 

                        //console.log(entCero);
           
                        let ent = new Array();

                        for(var i=0;i<entCero.length;i++){                           
                            var part=document.createElement("div"); 
                            part.setAttribute("id",entCero[i].id_usuario);
                            part.setAttribute("class","entrenador");
                            part.setAttribute("draggable",true);
                            part.setAttribute("ondragstart","arrastre(event);");
                            part.setAttribute("value",entCero[i].id_usuario);

                            var nombre=entCero[i].nombre+" "+ entCero[i].apellidos;

                            var textoNodo=document.createTextNode(nombre);

                            part.appendChild(textoNodo);
                            di.appendChild(part);
                            //console.log(di);
                        }
                        
                    </script> 
                
                    
                </div>

                <div class="col-5"  ondragover="sobre(event);" ondrop="suelta(event);" id="cajaEntrenador">
                
 
                    <script>

                        let entreGrupo = <?php echo json_encode($datos['entrenadoresGrupo']);?>;
                        //console.log(entreGrupo);
    
                        var dis=document.getElementById("cajaEntrenador"); 

                         for(var i=0;i<entreGrupo.length;i++){
                            
                            var eP=document.createElement("div"); 
                            eP.setAttribute("id",entreGrupo[i].id_usuario);
                            eP.setAttribute("class","entrenador");
                            eP.setAttribute("draggable",true);
                            eP.setAttribute("ondragstart","arrastre(this.id,event);");
                            eP.setAttribute("value",entreGrupo[i].id_usuario);

                            var nombre=entreGrupo[i].nombre+" "+ entreGrupo[i].apellidos;

                            var textoNodo=document.createTextNode(nombre);

                            eP.appendChild(textoNodo);
                            dis.appendChild(part);
                        }
                    </script>  



                </div>
            </div>

            <br>
         

            <!--DRAG & DROP ALUMNOS-->
            <div class="row">
                <div class="col">
                    <p>Atletas disponibles</p>
                </div>
                <div class="col">
                    <p>Atletas en el grupo</p>
                </div>
            </div>


<?php
$info = [];
    foreach($datos['alCero'] as $dato){
        $info [] = $dato->id_usuario;
    }

$info2 = [];
    foreach($datos['alUno'] as $dato2){
        $info2 [] = $dato2->id_usuario;
    }
?>



            <div class="row d-flex justify-content-around">
                <div id="alumnos" class="col-5" ondragover="sobre(event);" ondrop="alumnoCero(event);"> 
                         <script> 

                        let alumnosCero = <?php echo json_encode($datos['alCero'])?>; 
                        //console.log(alumnosCero)
                        let cero = new Array();
                         cero = <?php echo json_encode($info)?>
                         //console.log(cero);
                       

                            var alus=document.getElementById("alumnos"); 

                             for(var i=0;i<alumnosCero.length;i++){
                                 if((alumnosCero[i]["activo"])==0){
                                     //creamos div y ledamos propiedades
                                     var alu=document.createElement("div"); 
                                     alu.setAttribute("id",alumnosCero[i].id_usuario);
                                     alu.setAttribute("class","alumno");
                                     alu.setAttribute("draggable",true);
                                     alu.setAttribute("ondragstart","arrastre(event);");
                                     alu.setAttribute("value",alumnosCero[i].id_usuario);

                                     var nombre=alumnosCero[i].nombre+" "+ alumnosCero[i].apellidos;

                                     var textoNodo=document.createTextNode(nombre);

                                     alu.appendChild(textoNodo);
                                     alus.appendChild(alu);
                                }
                             }
                        </script> 
                </div>
                
                <div id="cajaAlumnos" class="col-5" ondragover="sobre(event);" ondrop="alumnoUno(event);" >  
                
                             <script>
                                    let alumnosUno = <?php echo json_encode($datos['alUno'])?>; 
                                    //console.log(alumnosUno)
                                    let uno = new Array();
                                    uno = <?php echo json_encode($info2)?>
                                    //console.log(uno);
                                   

                                var alusUno=document.getElementById("cajaAlumnos"); 
                                         
                                for(var i=0;i<alumnosUno.length;i++){
                                    if((alumnosUno[i]["activo"])==1){
                                        //creamos div y ledamos propiedades
                                        var aluUno=document.createElement("div"); 
                                        aluUno.setAttribute("id",alumnosUno[i].id_usuario);
                                        aluUno.setAttribute("class","alumno");
                                        aluUno.setAttribute("draggable",true);
                                        aluUno.setAttribute("ondragstart","arrastre(event);");
                                        aluUno.setAttribute("value",alumnosUno[i].id_usuario);

                                        var nombre=alumnosUno[i].nombre+" "+ alumnosUno[i].apellidos;

                                        var textoNodo=document.createTextNode(nombre);

                                        aluUno.appendChild(textoNodo);
                                        alusUno.appendChild(aluUno);
                                    }
                                    
                                }
                            </script> 
                </div>
            </div>

            <form method="post" action="<?php echo RUTA_URL?>/adminGrupos/partGrupo">
            
                <input type="hidden" id="entrenadorActual" name="entrenadorActual[]" value="">
                <input type="hidden" id="entrenadorCero" name="entrenadorCero[]" value="">

                <input type="hidden" id="alumnosActuales" name="alumnosActuales[]" value="">                             
                <input type="hidden" id="alumnosAntes" name="alumnosAntes[]" value="">

                <?php $idGrupo=($datos['id_grupo'])?>
                <input type="hidden" id="idGrupo" name="idGrupo" value="<?php echo $idGrupo?>">
                <br>

                <div class="row">
                <div class="col-3">
                    <input type="submit" class="btn" id="enviar" name="enviar" value="Confirmar">
                    <a href="<?php echo RUTA_URL?>/adminGrupos">
                        <input class="btn" type="button" id="botonVolver" value="Volver">  
                    </a>
                </div>
                </div>

            </form>
    </div>

    </div>


    <script>
        
        function arrastre(ev) {
            //var id=document.getElementById(id);
            //console.log(ev.target.id);
            ev.dataTransfer.setData('Data',ev.target.id);
        }  
       
        function sobre(ev) {
            ev.preventDefault();
        }

        //***********CAJAS ENTRENADORES**************

        function suelta(ev){
            var caja=document.getElementById("cajaEntrenador");
            var numero = caja.getElementsByTagName('div').length + 1;
            console.log(numero);
            
            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            var clase=document.getElementById(dato);

           if(clase.className=="entrenador" && numero==1){ 
                caja.appendChild(document.getElementById(dato)); 
                //console.log(ent)  
                ent.push(dato);

                var entrena = JSON.stringify(ent); 
                var entre=document.getElementById("entrenadorActual");
                entre.setAttribute("value",entrena);
           }else{
               alert("No se puede añadir mas de un entrenador a un grupo");
           }

        }  


        function suelta2(ev){
            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            var clase=document.getElementById(dato);
            //console.log(clase);
            if(clase.className=="entrenador"){
                var caja=document.getElementById("entrenadores");   
                caja.appendChild(document.getElementById(dato));
                for(var i=0; i<ent.length;i++){
                    if(ent[i]==dato){
                        ent.splice(i,1);
                    }
                    var entrena = JSON.stringify(ent); 
                    var entre=document.getElementById("entrenadorActual");
                    entre.setAttribute("value",entrena);
                }
            }else{
                alert ("no se puede");
            }
        } 


        //***********CAJAS ALUMNOS**************

        function alumnoUno(ev){

            var caja=document.getElementById("cajaAlumnos");
       
            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            //console.log(dato);
            var clase=document.getElementById(dato);
            // console.log(clase);
            

           if(clase.className=="alumno"){ 
                caja.appendChild(document.getElementById(dato));    
                uno.push(dato);
                      
                   for(var i=0; i<cero.length;i++){
                        //console.log(alumnosCero[i])
                       if(cero[i]==dato){
                          cero.splice(i,1);
                     }
                 } 

                 //console.log("alumnos cero")               
                 console.log(cero);
                 //console.log("alumnos uno")
                 console.log(uno);

                //para que no mande string
                var participaUno = JSON.stringify(uno); 
                var partUno=document.getElementById("alumnosActuales");
                partUno.setAttribute("value",participaUno);

                 var participaCero = JSON.stringify(cero); 
                 var partCero=document.getElementById("alumnosAntes");
                 partCero.setAttribute("value",participaCero);
                
           }else{
               alert("No se puede añadir mas de un entrenador a un grupo");
           }  
         
        }  


        function alumnoCero(ev){

            var caja=document.getElementById("alumnos");
            //var numero = caja.getElementsByTagName('div').length;
            //console.log(numero);

            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            var clase=document.getElementById(dato);
            //console.log(dato);

            if(clase.className=="alumno"){
                caja.appendChild(document.getElementById(dato));
                cero.push(dato);

                 for(var i=0;i<uno.length;i++){
                     //console.log(alumnosUno[i])
                     if(uno[i]==dato){
                       uno.splice(i,1);
                     }   
                 } 

                //alumnosCero.push(dato)
                console.log("alumnos Cero vuelta")
                console.log(cero); 
                console.log("alumnos Uno vuelta")
                console.log(uno);
                
                    //para que no mande string
                    var participaUno = JSON.stringify(uno); 
                    var partUno=document.getElementById("alumnosActuales");
                    partUno.setAttribute("value",participaUno);

                     //para que no mande string
                    var participaCero = JSON.stringify(cero); 
                    var partCero=document.getElementById("alumnosAntes");
                    partCero.setAttribute("value",participaCero);

                
            }else{
                alert ("no se puede");
            }
        } 


    </script>
