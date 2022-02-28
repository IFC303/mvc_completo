<?php require_once RUTA_APP . '/vistas/inc/header_entrenador_miga.php' ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/estilos.css">
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <title><?php echo NOMBRE_SITIO?></title>
</head>


<body>

        <!--RADIO SELECCION-->
        <div class="form-check">
            <input type="radio" class="form-check-input" id="todos" name="todos" value="todos" data-bs-toggle="modal" data-bs-target="#ventanaModal">
            <label class="form-check-label" for="todos">SOCIOS</label>
        </div>

                        
        <!--VENTANA MODAL-->
        <div class="modal" id="ventanaModal">
            <div class="modal-dialog">
                <div class="modal-content">
                
                    <div class="header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                  
                    <div class="modal-body">
                        <form method="post" action="<?php echo RUTA_URL?>/entrenador/mensajeria" class="card-body">

                                <input type="checkbox" id="todos" onClick="marcar_desmarcar(this);"> <label for="todos">Seleccionar todos</label>    

                                <div class="mt-3 mb-3">

                                        <?php 
                                          foreach($datos['mensaje'] as $objeto){ 

                                            ?> 
                                            <input type="checkbox" name="seleccionados[]" id="<?php echo $objeto->nombre ?>" value="<?php echo $objeto->email?>">

                                        <?php   print_r($objeto->nombre."  ".$objeto->apellidos ); 
                                               echo '<br>';
       
                                          }?>     

                                </div>

                                <input type="text" id="destinatarios" name="destinatarios"  hidden>
                                <input type="submit" class="btn btn-success" value="Confirmar">
                        </form>
                    </div>
                </div>
            </div>
        </div> 
       

                <div class="card bg-light mt-5 w-75 card-center" style=" margin: auto;">
                    <form method="post" action="<?php echo RUTA_URL?>/entrenador/enviar"class="card-body">

                            <div class="mt-3 mb-3">
                                <label for="destinatario">Email destinatario: </label>
                                <input type="email" name="destinatario" id="destinatario" class="form-control form-control-lg" value="<?php print_r($_POST['seleccionados']) ?>">
                            </div>
                            <div class="mt-3 mb-3">
                                <label for="asunto">Asunto: </label>
                                <input type="text" name="asunto" id="asunto" class="form-control form-control-lg">
                            </div>

                            <div class="mt-3 mb-3">
                                <label for="mensaje">Mensaje </label>
                                <input type="text" name="mensaje" id="mensaje" class="form-control form-control-lg">
                            </div>

                            <input type="submit" class="btn btn-success" value="Enviar">
                    </form>
                </div>





            <script>

                function marcar_desmarcar(todos){
                    todos.setAttribute("checked","true");   
                   
                    var mails = [];
                    casillas=document.getElementsByTagName('input');

                     for(i=0;i<casillas.length;i++){
                         if(casillas[i].type == "checkbox"){    
                             todos.setAttribute("checked","true"); 
                             if (casillas[i].checked=todos.checked) {
                                mails.push(casillas[i].value);  
                             } else{
                                 mails.splice(mails.length)
                             }           
                         }  
                     } 
                    mails.shift();
                    console.log(mails);
                    
                     
                }
            
                   


            </script>

