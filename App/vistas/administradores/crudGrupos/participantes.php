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

<body>
    
    <div class="container">

            <!--DRAG & DROP ENTRENADOR-->
            <h5>Arrastra el profesor que quieras incluir en el grupo</h5>
            <div class="row">
                <div id="entrenadores" class="col" style="border:solid" ondragover="sobre(event);" ondrop="suelta2(event);">
                    <script>
                            let participantes = <?php echo json_encode($datos['entrenadores']);?>;
                            var di=document.getElementById("entrenadores"); 

                            //console.log(participantes);
                            let ent =new Array();

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
    
                <div class="col" style="border:solid" ondragover="sobre(event);" ondrop="suelta(event,this.id);" id="cajaEntrenador"> 
                </div>
            </div>

            <br>
         

            <!--DRAG & DROP ALUMNOS-->
            <h5>Arrastra los alumos que quieras incluir en el grupo</h5>
            <div class="row">
                <div id="alumnos" class="col" style="border:solid" ondragover="sobre(event);" ondrop="sueltaAlumno(event);">
                    <script>
                            let alumnos = <?php echo json_encode($datos['alumnos']);?>;
                            var alus=document.getElementById("alumnos"); 
                            
                            let particip = new Array();

                            for(var i=0;i<alumnos.length;i++){
                            
                                var alu=document.createElement("div"); 
                                alu.setAttribute("id",alumnos[i].id_usuario);
                                alu.setAttribute("class","alumno");
                                alu.setAttribute("draggable",true);
                                alu.setAttribute("ondragstart","arrastre(this.id,event);");
                                alu.setAttribute("value",alumnos[i].id_usuario);

                                var nombre=alumnos[i].nombre+" "+ alumnos[i].apellidos;

                                var textoNodo=document.createTextNode(nombre);

                                alu.appendChild(textoNodo);
                                alus.appendChild(alu);
                            }
                        </script>
        
                </div>

                <div class="col" style="border:solid" ondragover="sobre(event);" ondrop="sueltaAlu(event,this.id);" id="cajaAlumnos">  
                </div>
            </div>


            <form action="post">
                <input type="hidden" id="entrenadorActual" name="entrenadorActual">
                <input type="hidden" id="alumnosActuales" name="alumnosActuales">
                <input type="submit" class="btn btn-success" id="enviar" name="enviar">
            </form>


    </div>


    <script>

        function arrastre(id,ev) {
            var id=document.getElementById(id);
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


        function suelta2(ev,){
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

        function sueltaAlu(ev,id){
            var caja=document.getElementById("cajaAlumnos");
            var numero = caja.getElementsByTagName('div').length;
            
            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            var clase=document.getElementById(dato);

           if(clase.className=="alumno"){ 
                caja.appendChild(document.getElementById(dato));   
                particip.push(dato);
                //para que no mande string
                var participa = JSON.stringify(particip); 
                var part=document.getElementById("alumnosActuales");
                part.setAttribute("value",participa);
           }else{
               alert("No se puede añadir mas de un entrenador a un grupo");
           }  
        }  


        function sueltaAlumno(ev){
            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            var clase=document.getElementById(dato);
            console.log(dato);

            if(clase.className=="alumno"){
                var caja=document.getElementById("alumnos");   
                caja.appendChild(document.getElementById(dato));
                for(var i=0; i<particip.length;i++){
                    if(particip[i]==dato){
                        particip.splice(i,1);
                    }
                    var participa = JSON.stringify(particip); 
                    var part=document.getElementById("alumnosActuales");
                    part.setAttribute("value",participa);
                }
            }else{
                alert ("no se puede");
            }
        } 


    </script>
