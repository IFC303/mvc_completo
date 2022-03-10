<?php require_once RUTA_APP.'/vistas/inc/header_entrenador_miga.php' ?>

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

    <style>
 
        /* #ventana{
            margin: auto;
        } */

        label, h2, h4,h6{
           color:#023ef9;
        }
      
        .btn{
            background-color: #023ef9; 
            color:white;
        }

        #botonVolver{
            background-color:white; 
            color:#023ef9;
            border-color:#023ef9;
        }

        #elementSocios{
            padding-left:5px;
            margin-top:15px;
        }       

        #todos{
            margin-left:5px;
            margin-top:20px;
        }

    </style>


<body>


        <!--RADIO SELECCION-->
        <div class="container">


            <div class="row" style="text-align:center">
                <div class="col-12"><h4 id="titulo">Envio de mensajeria</h4></div>
            </div>


            <div class="row">

                <!--RADIOS-->  
                <div class="card bg-light mt-2 col-3"style="border-right:solid 1px #023ef9" >
                    <div class="form-check" id="check" >
                        <br>
                        <h6>Selecciona el grupo de destinatarios</h6>
                        <input type="radio" class="form-check-input" id="todos" name="todos" value="todos" data-bs-toggle="modal" data-bs-target="#ventanaModal">
                        <label class="form-check-label" for="todos" id="elementSocios">SOCIOS</label>
                    </div>   
                </div>


                <!--VENTANA MODAL-->
                <div class="modal" id="ventanaModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        
                            <div class="header">
                                <h4 class="modal-title">Modal</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <input type="checkbox" id="todos" onClick="marcar_desmarcar(this);"> <label for="todos">Seleccionar todos</label>    
                                <div class="mt-3 mb-3">
                                    <?php 
                                    foreach($datos['mensaje'] as $objeto){ 
                                    ?> 
                                    <input type="checkbox" name="seleccionados" id="<?php echo $objeto->nombre ?>" value="<?php echo $objeto->email?>" onclick="seleccionados(this);">
                                    <?php   print_r($objeto->nombre."  ".$objeto->apellidos ); 
                                            echo '<br>';
                                    }?>     
                                </div>
                            </div>

                            <div class="footer">
                                <button type="button" style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Aceptar</button>
                            </div>    
                                
                        </div>
                    </div>
                </div> 


                <!--FORMULARIO-->
                <div class="card bg-light mt-2 col-7" style=" ">
                        <form method="post" action="<?php echo RUTA_URL?>/entrenador/enviar"class="card-body">

                                <div class="mt-3 mb-3">
                                    <label for="destinatario">Email destinatario</label>
                                    <input type="text" name="destinatario" id="destinatario" class="form-control form-control-lg" value="">                               
                                </div>
                                <div class="mt-3 mb-3">
                                    <label for="asunto">Asunto</label>
                                    <input type="text" name="asunto" id="asunto" class="form-control form-control-lg">
                                </div>

                                <div class="mt-3 mb-3">
                                    <label for="mensaje">Mensaje</label>
                                    <textarea type="text" rows="7" name="mensaje" id="mensaje" class="form-control form-control-lg"></textarea>
                                </div>

                                <input type="submit" class="btn" value="Enviar">
                        </form>
                </div>
            </div>   
        </div>

                     
       





            <script>

                    function marcar_desmarcar(todos){
                        todos.setAttribute("checked","true");   
                    
                        var mails =[];
                        casillas=document.getElementsByTagName('input');
                        
                        //correos="";  
                        for(i=0;i<casillas.length;i++){
                            if(casillas[i].type == "checkbox"){    
                                todos.setAttribute("checked","true");
                                if(casillas[i].checked=todos.checked){
                                    mails.push(casillas[i].value);
                                    //correos=correos+casillas[i].value+",";
                                } else{
                                     mails.splice(mails.length) 
                                }                 
                             }   
                      
                        }
                        mails.shift(); 
                        document.getElementById('destinatario').setAttribute('value',mails) 
                        console.log(mails); 
                         
                    } 



                     function seleccionados(seleccionado){
                        seleccionado.setAttribute("checked","true");
                        var correos = [];
                        casillas=document.getElementsByTagName('input');

                        for(i=0;i<casillas.length;i++){
                            if((casillas[i].type=="checkbox") & (casillas[i].checked==true)){
                                correos.push(casillas[i].value);
                            }
                        }
                        
                          console.log(correos); 
                          document.getElementById('destinatario').setAttribute('value',correos);
                     }



            </script>

