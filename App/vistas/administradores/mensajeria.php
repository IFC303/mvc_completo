<?php require_once RUTA_APP.'/vistas/inc/navA.php' ?>

        <header>
        <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center"><span id="textoHead">Envio de mensajeria</span></div>
                <div class="col-2 mt-2">
                        <a type="button" id="botonLogout" class="btn"  href="<?php echo RUTA_URL ?>/login/logout">
                                <span>Logout</span>
                                <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
                        </a>
                </div>
        </div>                                   
        </header>




        <!--RADIO SELECCION-->
        <article>
        <div class="container">


            <script>

                var menTodos =  <?php echo json_encode($datos['mensajeTodos'])?>;
                //console.log(menTodos)

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

                        <?php
                        $destinatarios =['Administradores','Entrenadores','Socios','Tiendas', 'Participantes','Entidades'];

                        foreach($destinatarios as $nombre){?>
                            <div class="row">
                                <div class="col d-flex align-items-center m-2">
                                    <input type="radio" class="form-check-input"  name="todos" id="todos<?php echo $nombre?>" value="todos<?php echo $nombre?>" data-bs-toggle="modal" data-bs-target="#v<?php echo $nombre?>">
                                    <label class="form-check-label m-1" for="todos" id="elementSocios"><?php echo $nombre?></label>
                                </div>
                                <div class="col-11">
                                    
                                </div>
                            </div>
                            <!--VENTANA MODAL-->
                            <div class="modal" id="v<?php echo $nombre?>">
                            <div class="modal-dialog modal-md">
                            <div class="modal-content">


                                        <div class="card-header">
                                            <div class="row">
                                                    <h4 class="modal-title col-11"><?php echo $nombre?> </h4>
                                                    <button type="button" class="btn-close m-1 col-1" id="" onclick="quitar();" data-bs-dismiss="modal"></button>
                                            </div>
                                        </div>

                                        <div class="modal-body">
                                            <br>
                                              <input type="checkbox" id="<?php echo $nombre?>" onClick="marcar_desmarcar(this.id);"> <label for="todos">Seleccionar todos</label>
                                              <hr>
                                            <div class="mt-3 mb-3">
                                            <?php
                                                foreach($datos['mensajeTodos'] as $objeto){
                                                    if($objeto->tipo==$nombre){
                                                ?>
                                                <input type="checkbox" class="<?php echo $objeto->tipo?>" name="<?php echo $objeto->tipo?>" id="<?php echo $objeto->tipo?>" value="<?php echo $objeto->email?>" onclick="seleccionados(this);">
                                                <?php   print_r($objeto->nombre."  ".$objeto->apellidos );
                                                ?> <br> <?php
                                                }}?>
                                            </div>
                                        </div>

                                        <div class="footer">
                                            <button type="button" class="btn m-4" style="background-color: #023ef9; color:white" onclick="aceptar();" data-bs-dismiss="modal">Aceptar</button>
                                        </div>
                            </div>
                            </div>
                            </div>

                        <?php }?>

                </div>
                </div>


                <!--FORMULARIO-->
                <div class="card bg-light mt-2 col-7">
                        <form method="post" action="<?php echo RUTA_URL?>/adminMensajeria/enviar"class="card-body">

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
        </article>

        <?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>




            <script>


                    //FUNCION SELECCIONAR Y DESELECIONAR TODOS A LA VEZ
                    function marcar_desmarcar(todos){
                        //console.log("al entrar")

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

