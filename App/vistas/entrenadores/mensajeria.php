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

        #titulo{
            font-family: 'Anton',sans-serif; 
            color: #023ef9; 
            letter-spacing: 5px;
        }



    </style>


<body>


        <!--RADIO SELECCION-->
        <div class="container">


            <div class="row" style="text-align:center">
                <div class="col-12"><h4 id="titulo">Envio de mensajeria</h4></div>
     
            </div>



        <script>

            var menTodos =  <?php echo json_encode($datos['mensaje'])?>;
            console.log(menTodos)

            var correos = new Array();
            console.log(correos);
        </script>



            <div class="row">

                <!--RADIOS-->  
                <div class="card bg-light mt-2 col-4"style="border-right:solid 1px #023ef9" >
                <div class="form-check" id="check" >
                        <br>
                        <h6>Selecciona el grupo destinatario</h6>
                        <br>

                        <?php foreach($datos['entrenadorGrupo'] as $entrenadorGrupo){
                            ?>
                            
                            <div class="col d-flex align-items-center m-2">
                                <input type="radio" class="form-check-input" id="todos<?php echo $entrenadorGrupo->nombre?>" name="todos" value="todos<?php echo $entrenadorGrupo->nombre?>" data-bs-toggle="modal" data-bs-target="#v<?php echo $entrenadorGrupo->nombre?>">
                                <label class="form-check-label m-1" for="todos" id="elementSocios"><?php echo $entrenadorGrupo->nombre?></label>
                            </div>

                <!--VENTANA MODAL-->
                <div class="modal" id="v<?php echo $entrenadorGrupo->nombre?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="card-header">
                            <div class="row">
                                <h4 class="modal-title col-11"><?php echo $entrenadorGrupo->nombre?></h4>
                                <button type="button" class="btn-close m-1 col-1" onclick="quitar();" data-bs-dismiss="modal"></button>
                            </div>
                            </div>

                            <div class="modal-body">
                                <br>
                                <input type="checkbox" id="<?php echo $entrenadorGrupo->id_grupo?>" onClick="marcar_desmarcar(this.id);"> <label for="todos">Seleccionar todos</label> 
                                <hr>   
                                <div class="mt-3 mb-3">
                                    <?php 
                                  
                                    foreach($datos['mensaje'] as $objeto){
                                        if($objeto->id_grupo==$entrenadorGrupo->id_grupo){  
                                    ?> 
                                    <input type="checkbox"  class="<?php echo $objeto->id_grupo?>" name="<?php echo $objeto->id_grupo?>" id="<?php echo $objeto->id_grupo?>" value="<?php echo $objeto->email?>" onclick="seleccionados(this);">
                                    <?php   print_r($objeto->nombre."  ".$objeto->apellidos ); ?>
                                    <br>                       
                                   <?php }}?>     
                                </div>
                            </div>

                            <div class="footer">
                                <button type="button" class="btn m-4" style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Aceptar</button>
                            </div>    
                                
                        </div>
                    </div>
                </div> 

                <?php
                        }?>   
                    </div>   
                </div>
                <!--FORMULARIO-->
                <div class="card bg-light mt-2 col-7">
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
                                <input type="hidden" name="enviarCorreos" id="enviarCorreos" value="">
                                <input type="submit" class="btn" value="Enviar">
                        </form>
                </div>
            </div>   
        </div>

                     
       




        <script>


                //FUNCION SELECCIONAR Y DESELECIONAR TODOS A LA VEZ
                function marcar_desmarcar(todos){
                    console.log("al entrar")

                    casillas=document.getElementsByClassName(todos);
                    todos=document.getElementById(todos);
                    //console.log(casillas);

                    for(i=0;i<casillas.length;i++){
                        //console.log(casillas[i].id);
                        if(casillas[i].type == "checkbox"){
                            casillas[i].setAttribute("checked","true");
                        if((casillas[i].checked=todos.checked)){
                                correos.push(casillas[i].value);
                            // console.log(correos);
                            } else{
                                var indice = correos.indexOf(casillas[i].value)
                                console.log(indice)
                                correos.splice(indice,1)
                            }
                        }
                    }
                    console.log(correos);
                    document.getElementById('destinatario').setAttribute("value",correos);
                }



                //SELECCION UNO A UNO
                function seleccionados(seleccionado){
                    // console.log("al entrar")
                    // console.log(correos);
                    //console.log(seleccionado.value)

                    seleccionado.setAttribute("checked","false");
                    console.log(seleccionado.checked)

                    if(seleccionado.checked==true){
                        correos.push(seleccionado.value);
                        document.getElementById('destinatario').setAttribute("value",correos);
                    }else{
                        var ind=correos.indexOf(seleccionado.value)
                        console.log(ind)
                        correos.splice(ind,1)
                        document.getElementById('destinatario').setAttribute("value",correos);   
                    }     
                    console.log(correos);    
                }



                function aceptar(){
                    document.getElementById('enviarCorreos').setAttribute("value",correos);
                }



                        
                function quitar(){

                    console.log(correos);

                    correos.splice(0);
                    document.getElementById('destinatario').setAttribute('value',"");
                    
                    console.log(correos)

                }


        </script>





            <!-- <script>

                    function marcar_desmarcar(todos){
                        todos.setAttribute("checked","true");   
                    
                        var mails =[];
                        casillas=document.getElementsByTagName('input');
                        
                        //correos="";  
                        for(i=0;i<casillas.length;i++){
                            if(casillas[i].type == "checkbox"){    
                                todos.setAttribute("checked","true");
                                if((casillas[i].checked=todos.checked)& (casillas[i].value!="on")){
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



            </script> -->

