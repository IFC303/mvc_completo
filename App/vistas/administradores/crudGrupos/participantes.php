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
            <div class="row">
                <div id="entrenador" class="col" style="border:solid" ondragover="sobre(event);" ondrop="suelta2(event);">
                    <script>
                            let participantes = <?php echo json_encode($datos['participantes']);?>;
                            var di=document.getElementById("entrenador"); 
                            console.log(participantes);

                            for(var i=0;i<participantes.length;i++){
                            
                                var part=document.createElement("div"); 
                                part.setAttribute("id","entrenador"+i);
                                part.setAttribute("draggable",true);
                                part.setAttribute("ondragstart","arrastre(this.id,event);");
                                part.setAttribute("value",participantes[i].id_usuario);

                                var nombre=participantes[i].nombre+" "+ participantes[i].apellidos;
                                console.log(nombre);

                                var textoNodo=document.createTextNode(nombre);

                                part.appendChild(textoNodo);
                                di.appendChild(part);
                            }
                        </script>
                </div>
    
                <div class="col" style="border:solid" ondragover="sobre(event);" ondrop="suelta(event,this.id);" id="caja"> 
                </div>
            </div>

        <br>


            <!--DRAG & DROP ALUMNOS-->
            <div class="row">
                <div class="col" style="border:solid">
                    <h4>alumnos</h4>
                </div>

                <div class="col" style="border:solid">
                    
                </div>
            </div>




    </div>


    <script>

        function arrastre(id,ev) {
            var id=document.getElementById(id);
            ev.dataTransfer.setData('Data',ev.target.id);
        }  

       
        function sobre(ev) {
            ev.preventDefault();
        }


        function suelta(ev,id){
                var caja=document.getElementById("caja");
                ev.preventDefault();
                var dato=ev.dataTransfer.getData('Data');
                caja.appendChild(document.getElementById(dato));
                let ent = [];
                ent.push(dato);
                console.log(ent);
        }  

        function suelta2(ev){
            var caja=document.getElementById("entrenador");
            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            caja.appendChild(document.getElementById(dato));
        } 


    </script>
