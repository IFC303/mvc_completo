
<?php require_once RUTA_APP . '/vistas/inc/navE.php' ?>


<header>              
    <div class="row">
        <div class="col-10"><span id="tHead">Mensajeria</span></div>     
        <div class="col-2">
            <a type="button" class="btn" style="background-color:#0b2a85" href="<?php echo RUTA_URL ?>/login/logout">
                <span style="font-size:25px;color:white">Logout</span>
                <img class="ms-2" id="salirHeader" src="<?php echo RUTA_Icon ?>logout.png" style="width:35px;height:35px" >
            </a>
        </div>
    </div>                                 
</header>

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
            //console.log(menTodos)

            var correos = new Array();
            //console.log(correos);
        </script>



            <div class="row">

                <!--RADIOS-->  
                <div class="card bg-light mt-2 col-4"style="border-right:solid 1px #023ef9" >
                <div class="form-check" id="check" >
                       
                        <h6 class="mt-5 mb-4">Selecciona el grupo destinatario</h6>
                       

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
                        
                            <div class="modal-header">                           
                                <h4 class="modal-title mt-3 mb-2 col-10"><?php echo $entrenadorGrupo->nombre?></h4>
                                <button type="button" class="btn-close m-1 col-2" onclick="quitar(<?php echo $entrenadorGrupo->id_grupo?>);" data-bs-dismiss="modal"></button>
                            </div>
                           

                            <div class="modal-body">
                                <input type="checkbox" id="t<?php echo $entrenadorGrupo->id_grupo?>" onClick="marcar_desmarcar(this.id);"> <label for="todos">Seleccionar todos</label> 
                                <hr>   
                                <div class="mt-3 mb-3">
                                    <?php                      
                                    foreach($datos['mensaje'] as $objeto){
                                        if($objeto->id_grupo==$entrenadorGrupo->id_grupo){ 
                                    ?> 
                                    <input type="checkbox"  class="<?php echo $objeto->id_grupo?>" name="<?php echo $objeto->id_grupo?>" id="<?php echo $objeto->id_usuario?>" value="<?php echo $objeto->email?>" onclick="seleccionados(this,<?php echo $entrenadorGrupo->id_grupo?>);">
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
                                    <input type="text" name="destinatario" id="destinatario" class="form-control form-control-lg" value="" required>                               
                                </div>
                                <div class="mt-3 mb-3">
                                    <label for="asunto">Asunto</label>
                                    <input type="text" name="asunto" id="asunto" class="form-control form-control-lg" required>
                                </div>

                                <div class="mt-3 mb-3">
                                    <label for="mensaje">Mensaje</label>
                                    <textarea type="text" rows="7" name="mensaje" id="mensaje" class="form-control form-control-lg" required></textarea>
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
                    var num=todos.slice(1,)
                    var casillas=document.getElementsByClassName(num);
                    var todos=document.getElementById(todos);
               
                    todos.setAttribute("checked",todos.checked)

                    for(i=0;i<casillas.length;i++){
                        if((casillas[i].type == "checkbox")){                           
                            if(todos.checked==true){
                               casillas[i].setAttribute("checked","true") 
                               casillas[i].checked=true
                               if(correos.includes(casillas[i].value)!=true){
                                correos.push(casillas[i].value)
                                }                               
                            }else{
                                casillas[i].removeAttribute("checked")
                                casillas[i].checked=false
                                var indice = correos.indexOf(casillas[i].value)
                                correos.splice(indice,1)
                            }
                    }
                    }             

                    document.getElementById('destinatario').setAttribute("value",correos);             
                }



                //SELECCION UNO A UNO
                function seleccionados(seleccionado,nombre){
                    if((seleccionado.type == "checkbox")){   
                     if (seleccionado.checked==false){
                         seleccionado.removeAttribute("checked")
                         todos=document.getElementById("t"+nombre);
                         todos.checked=false
                         todos.removeAttribute("checked")
                         var ind=correos.indexOf(seleccionado.value)
                        correos.splice(ind,1)
                     }else{
                         seleccionado.checked=true
                         seleccionado.setAttribute("checked","true")
                         if(correos.includes(seleccionado.value)!=true){
                             correos.push(seleccionado.value)
                         } 
                     }
                    }

                    //***comprueba que si todos los checkbox estan marcados, marque tambien el selecionar todos***/
                    var cas=document.getElementsByClassName(nombre);
                    var tod=document.getElementById("t"+nombre);
                    var cont=0
                    
                    for (i=0;i<cas.length;i++){
                        if(cas[i].checked==true){
                           cont++  
                        }
                    }
                    if(cont==cas.length){
                        tod.checked=true
                         tod.setAttribute("checked","true")
                    }

                    document.getElementById('destinatario').setAttribute("value",correos);    

                }



                function aceptar(){
                    document.getElementById('enviarCorreos').setAttribute("value",correos);
                }



                        
                function quitar(id){
                    //console.log(id)
                  
                    var todos= document.getElementById(id)
                    todos.removeAttribute("checked")
                    correos.splice(0);
                    document.getElementById('destinatario').setAttribute('value',"");
                    
                    casillas=document.getElementsByClassName(id);                  

                    for(i=0;i<casillas.length;i++){
                        if(casillas[i].type == "checkbox"){
                            casillas[i].removeAttribute("checked")
                        }
                    }

              
                     // casillas=document.getElementsByClassName(todos);
                    // for(i=0;i<casillas.length;i++){
                    //     if(casillas[i].type == "checkbox"){
                    //         casillas[i].setAttribute("checked","false");
                       
                    //     }
                    // }
                    //console.log(correos)

                }


        </script>

