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



               
<?php 

$alum=[];

 foreach ($datos['alumnos'] as $alumnos){
     $alum[]=$alumnos;
     }
     var_dump($alum);
     


?>


                    <script>
let prueba = <?php echo json_encode($alum);?>;

                        let participantes = <?php echo json_encode($datos['entrenadores']);?>;
                        let participantesGrupo = <?php echo json_encode($datos['entrenadoresGrupo']);?>;
                        var di=document.getElementById("entrenadores"); 

                        //console.log(participantes);
                        let ent = new Array();

                        for(var i=0;i<participantes.length;i++){
                            
                            var part=document.createElement("div"); 
                            part.setAttribute("id",participantes[i].id_usuario);
                            part.setAttribute("class","entrenador");
                            part.setAttribute("draggable",true);
                            part.setAttribute("ondragstart","arrastre(this.id,event);");
                            part.setAttribute("value",participantes[i].id_usuario);

                            var nombre=participantes[i].nombre+" "+ participantes[i].apellidos;

                            var textoNodo=document.createTextNode(nombre);

                            part.appendChild(textoNodo);
                            di.appendChild(part);
                        }
                    </script> 
                
                    
                </div>

                <div class="col-5"  ondragover="sobre(event);" ondrop="suelta(event,this.id);" id="cajaEntrenador"> 
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

            <div class="row d-flex justify-content-around">
                <div id="alumnos" class="col-5" ondragover="sobre(event);" ondrop="alumnoCero(event);"> 
                         <script>
                            let alumnosCero = <?php echo json_encode($datos['alumnos']);?>;
                            var alus=document.getElementById("alumnos"); 
                            console.log(alumnosCero);
                            
                            let participCero = new Array();

                             for(var i=0;i<alumnosCero.length;i++){
                                 if((alumnosCero[i]["activo"])==0){
                                     //creamos div y ledamos propiedades
                                     var alu=document.createElement("div"); 
                                     alu.setAttribute("id",alumnosCero[i].id_usuario);
                                     alu.setAttribute("class","alumno");
                                     alu.setAttribute("draggable",true);
                                     alu.setAttribute("ondragstart","arrastre(this.id,event);");
                                     alu.setAttribute("value",alumnosCero[i].id_usuario);

                                     var nombre=alumnosCero[i].nombre+" "+ alumnosCero[i].apellidos;

                                     var textoNodo=document.createTextNode(nombre);

                                     alu.appendChild(textoNodo);
                                     alus.appendChild(alu);
                                }
                             }
                        </script> 
                </div>
                
                <div id="cajaAlumnos" class="col-5" ondragover="sobre(event);" ondrop="alumnoUno(event,this.id);" >  
                
                             <script>
                                    let alumnosUno = <?php echo json_encode($datos['alumnos']);?>;
                                    //console.log(alumnosUno);
                                    var alusUno=document.getElementById("cajaAlumnos"); 
                                    let participUno = new Array();

                                for(var i=0;i<alumnosUno.length;i++){
                                    if((alumnosUno[i]["activo"])==1){
                                        //creamos div y ledamos propiedades
                                        var aluUno=document.createElement("div"); 
                                        aluUno.setAttribute("id",alumnosUno[i].id_usuario);
                                        aluUno.setAttribute("class","alumno");
                                        aluUno.setAttribute("draggable",true);
                                        aluUno.setAttribute("ondragstart","arrastre(this.id,event);");
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

            <form method="post" action="<?php echo RUTA_URL?>/adminGrupos/nueva_clase">
            
                <input type="hidden" id="entrenadorActual" name="entrenadorActual" value="">
                <input type="hidden" id="entrenadorCero" name="entrenadorCero" value="">

                <input type="hidden" id="alumnosActuales" name="alumnosActuales" value="">    
                                      
                <input type="hidden" id="alumnosCero" name="alumnosCero" value="<?php echo json_encode($alum)?>">

                <?php $idGrupo=($datos['id_grupo'])?>
                <input type="hidden" id="idGrupo" name="idGrupo" value="<?php echo $idGrupo?>">
                
                <div class="row">
                    <div class="col-2">
                        <input type="submit" class="btn" id="enviar" name="enviar" value="Confirmar">
                    </div>
                    <div class="col-3">
                        <a href="<?php echo RUTA_URL?>/adminGrupos">
                            <input type="button" class="btn" id="botonVolver" value="Volver">  
                        </a>
                    </div>
                </div>   
            </form>
    </div>

    <script>       


        //let alumnCero = new Array()
        // let alumnCero = 
        // var aluCero=document.getElementById('alumnosCero');
        // arrayAlum = new Array()
        // for(let i=0; i < alumnCero.length;i++){
        //     //
        //     arrayAlum.push(alumnCero[i]);
            
        //     // aluCero.value = JSON.stringify(alumnCero[i])
        //     console.log(alumnCero[i])
        // }
        // aluCero.setAttribute('value',JSON.stringify(arrayAlum));
        
    </script> 

    </div>


    <script>

        
        function arrastre(id,ev) {
            var id=document.getElementById(id);
            console.log(id);
            ev.dataTransfer.setData('Data',ev.target.id);
        }  

       
        function sobre(ev) {
            ev.preventDefault();
        }


        //***********CAJAS ENTRENADORES**************

        function suelta(ev,id){
            var caja=document.getElementById("cajaEntrenador");
            var numero = caja.getElementsByTagName('div').length;
            //console.log(numero);
            
            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            var clase=document.getElementById(dato);

           if((numero==0) && (clase.className=="entrenador")){ 
                caja.appendChild(document.getElementById(dato)); 
                console.log(ent)  
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

        function alumnoUno(ev,id){

            var caja=document.getElementById("cajaAlumnos");
            var numero = caja.getElementsByTagName('div').length;
            //console.log(numero);
            
            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            var clase=document.getElementById(dato);
            //console.log(clase);

           if(clase.className=="alumno"){ 

                caja.appendChild(document.getElementById(dato)); 
                
                    participUno.push(dato);
                    console.log(participUno);
                   
                //  for(var i=0; i<participCero.length;i++){
                //      if(participCero[i]==dato){
                //         participCero.splice(i,1);
     
                //      }}

                //para que no mande string
                var participaUno = JSON.stringify(participUno); 
                var part=document.getElementById("alumnosActuales");
                part.setAttribute("value",participaUno);

                 var participaCero = JSON.stringify(participCero); 
                 var partCero=document.getElementById("alumnosCero");
                 partCero.setAttribute("value",participaCero);
                
           }else{
               alert("No se puede añadir mas de un entrenador a un grupo");
           }  
        }  


        function alumnoCero(ev){

            var caja=document.getElementById("alumnos");
            var numero = caja.getElementsByTagName('div').length;
            //console.log(numero);

            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            var clase=document.getElementById(dato);
            //console.log(dato);

            if(clase.className=="alumno"){
                var caja=document.getElementById("alumnos");   
                caja.appendChild(document.getElementById(dato));

                for(var i=0; i<participUno.length;i++){
                    if(participUno[i]==dato){
                        //var cero=participUno[i];
                        participCero.push(dato);
                        console.log(participCero);
                        participUno.splice(i,1);
                        console.log(participUno);
                    }
                    //para que no mande string
                    var participaUno = JSON.stringify(participUno); 
                    var part=document.getElementById("alumnosActuales");
                    part.setAttribute("value",participaUno);

                     //para que no mande string
                    var participaCero = JSON.stringify(participCero); 
                    var partCero=document.getElementById("alumnosCero");
                    partCero.setAttribute("value",participaCero);

                }
            }else{
                alert ("no se puede");
            }
        } 


    </script>
