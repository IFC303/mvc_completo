
   <?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


<!------------------------------ CABECERA -------------------------------->
<header>
    <div class="row mb-5">
        <div class="col-10 d-flex align-items-center justify-content-center">
            <span id="textoHead">Gestion de ingresos</span>
        </div>
        <div class="col-2 mt-2">
            <a type="button" id="botonLogout" class="btn" href="<?php echo RUTA_URL ?>/login/logout">
                <span>Logout</span>
                <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
            </a>
        </div>
    </div>                                   
</header>
<!----------------------------------------------------------------------->


<article>

        <table id="tabla" class="table">


                    <!--CABECERA TABLA-->
                    <thead>
                        <tr>
                            <th>FECHA</th>
                            <th>TIPO</th>
                            <th>IMPORTE</th>
                            <th>CONCEPTO</th>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>

                     <!--BODY TABLA-->
                    <tbody>

                        <?php
                        foreach($datos['ingresos'] as $info):  
                           ?>
                        <tr>
                            <td><?php echo $info->fecha?></td>
                            <td><?php echo $info->tipo?></td>
                            <td><?php echo $info->importe?></td>
                            <td><?php echo $info->observaciones?></td>


                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            
                            <td>

                                 <!-- MODAL VER-->                 
                                 <a data-bs-toggle="modal" data-bs-target="#ver<?php echo $info->id_ingreso?>">
                                <img class="icono" src="<?php echo RUTA_Icon ?>ojo.svg"></img>
                                </a>

                                <div class="modal" id="ver<?php echo $info->id_ingreso?>">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">


                                        <!-- Modal Header -->
                                        <div class="modal-header azul">
                                            <p class="modal-title ms-3">Informacion</p> 
                                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>


                                         <!-- Modal body -->
                                        <div class="modal-body info mb-4">                         
                                        <div class="container mt-4">

                                            <div class="row mb-4">
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <label for="fecha" class="input-group-text">Fecha</label>
                                                        <input type="date" class="form-control form-control-md" name="fecha" value="<?php echo $info->fecha?>"readonly>    
                                                    </div> 
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <label for="importe" class="input-group-text">Importe</label>
                                                        <input type="text" class="form-control form-control-md" name="importe" value="<?php echo $info->importe?>"readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="input-group">
                                                    <label for="tipo" class="input-group-text">Tipo</label>
                                                    <input type="text" class="form-control form-control-md" name="tipo" value="<?php echo $info->tipo?>"readonly>
                                                </div>
                                            </div>
                                            

                                            <?php
                                            if($info->tipo=="Eventos"){?>
                                                <div class="row mb-4" id="usuario" style="display:block">
                                                    <div class="input-group">
                                                        <label for="tipo" class="input-group-text">Evento</label>
                                                        <select class="form-control" name="evento" readonly>
                                                            <?php foreach($datos['parti_even'] as $pe){
                                                                if($pe->id_participante==$info->id_participante){?>
                                                                    <option> <?php echo $pe->evento?></option>
                                                            <?php }
                                                            }?> 
                                                        </select>
                                                    </div>
                                                </div>   
                                                <div class="row mb-4" id="usuario" style="display:block">
                                                    <div class="input-group">
                                                        <label for="tipo" class="input-group-text">Asociado a</label>
                                                        <select class="form-control" name="socio" readonly>
                                                            <option> <?php echo $info->inputado?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php }elseif (($info->tipo=="Equipacion") or ($info->tipo=="Cuotas") or ($info->tipo=="Entidades") ){?>
                                                <div class="row mb-4" id="usuario" style="display:block">
                                                <div class="input-group">
                                                    <label for="tipo" class="input-group-text">Asociado a</label>
                                                    <select class="form-control" name="socio" readonly>
                                                        <option> <?php echo $info->inputado?></option>
                                                    </select>
                                                </div>
                                            </div>
                                           <?php }?>


                                            <div class="row">
                                                <div class="input-group mb-4">
                                                    <textarea  type="text" style="height:150px" class="form-control" id="observaciones" name="observaciones" value="<?php echo $info->observaciones?>"readonly><?php echo $info->observaciones?></textarea>
                                                </div>
                                            </div>  

                                        </div>
                                        </div>
                
                                </div>
                                </div>
                                </div>  


                                <!-- MODAL EDITAR -->                 
                                <a data-bs-toggle="modal" data-bs-target="#editar<?php echo $info->id_ingreso?>">
                                <img class="icono" src="<?php echo RUTA_Icon ?>editar.svg"></img>
                                </a>

                                <div class="modal" id="editar<?php echo $info->id_ingreso?>">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">


                                        <!-- Modal Header -->
                                        <div class="modal-header azul">
                                            <p class="modal-title ms-3">Edicion</p> 
                                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>


                                         <!-- Modal body -->
                                        <div class="modal-body info mb-4">                         
                                        <div class="container mt-4">

                                        <form action="<?php echo RUTA_URL?>/adminFacturacion/editar_ingreso/<?php echo $info->id_ingreso?>" method="post">

                                            <div class="row mb-4">
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <label for="fecha" class="input-group-text">Fecha</label>
                                                        <input type="date" class="form-control form-control-md" name="fecha" value="<?php echo $info->fecha?>">    
                                                    </div> 
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <label for="importe" class="input-group-text">Importe</label>
                                                        <input type="text" class="form-control form-control-md" name="importe" value="<?php echo $info->importe?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="input-group">
                                                    <label for="tipo" class="input-group-text">Tipo de ingreso <sup>*</sup></label>
                                                    <select class="form-control" name="tipo"  id="tipo_select<?php echo $info->id_ingreso?>" onchange="opcion_edi(<?php echo $info->id_ingreso?>)" required>
                                                        <option value="">-- Selecciona una opcion--</option>
                                                        <option value="Cuotas">Cuotas Socios</option>
                                                        <option value="Equipacion">Equipacion socios</option>
                                                        <option value="Entidades">Entidades colaboradoras</option>
                                                        <option value="Eventos">Participantes a eventos</option>
                                                        <option value="Otros">Otros ingresos</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-4" id="soc<?php echo $info->id_ingreso?>" style="display:none">
                                                <div class="input-group">
                                                    <label for="tipo" class="input-group-text">Asociar ingreso a <sup>*</sup></label>
                                                    <select class="form-control" name="socio">
                                                        <option value="">-- Selecciona un socio --</option>
                                                        <?php foreach ($datos['socios'] as $usu) : ?>
                                                        <option value="<?php echo $usu->id_usuario?>"> <?php echo $usu->nombre.' '.$usu->apellidos?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4" id="enti<?php echo $info->id_ingreso?>" style="display:none">
                                                <div class="input-group">
                                                    <label for="tipo" class="input-group-text">Asociar ingreso a <sup>*</sup></label>
                                                    <select class="form-control" name="entidad">
                                                        <option value="">-- Selecciona una entidad --</option>
                                                        <?php foreach ($datos['entidades'] as $enti) : ?>
                                                        <option value="<?php echo $enti->id_entidad?>" > <?php echo $enti->nombre?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div> 
                                            

                                            <div class="row mb-4" id="even<?php echo $info->id_ingreso?>" style="display:none">
                                                <div class="input-group">
                                                    <label for="tipo" class="input-group-text">Evento <sup>*</sup></label>
                                                    <select class="form-control" name="evento" id="tipo_even<?php echo $info->id_ingreso?>" onchange="op_edi(<?php echo $info->id_ingreso?>)">
                                                        <option value="">-- Selecciona un evento --</option>
                                                        <?php foreach ($datos['eventos'] as $even) : ?>
                                                        <option value="<?php echo $even->id_evento?>"> <?php echo $even->nombre?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-4" id="parti<?php echo $info->id_ingreso?>" style="display:none">
                                                <div class="input-group">
                                                    <label for="tipo" class="input-group-text">Asociar ingreso a <sup>*</sup></label>
                                                    <select class="form-control" name="participante" id="combo<?php echo $info->id_ingreso?>">
                                                        <option value="">-- Selecciona un participante --</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="input-group mb-4">
                                                    <textarea  type="text" style="height:150px" class="form-control" name="concepto" value="<?php echo $info->observaciones?>" ><?php echo $info->observaciones?></textarea>
                                                </div>
                                            </div>  

                                            <div class="d-flex justify-content-end">
                                                <input type="submit" class="btn mt-4 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                                            </div> 

                                            </form>

                                        </div>
                                        </div>
                
                                </div>
                                </div>
                                </div>  





                               <!-- MODAL BORRAR -->
                               <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $info->id_ingreso?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="borrar_<?php echo $info->id_ingreso?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body mt-3">
                                            <p>Estas seguro que quieres <b>BORRAR</b> el ingreso correspondiente a <b><?php echo $info->tipo?></b> con fecha <b><?php echo $info->fecha?></b> ? </p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminFacturacion/borrar_ingreso/<?php echo $info->id_ingreso?>" method="post">
                                                    <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
                                                </form>
                                            </div>

                                    </div>
                                    </div>
                                    </div>


                               
                            </td>
                            <?php endif ?>
                        
                        </tr>
                    
                        <?php
                       
                        endforeach ?>
                    </tbody>

            </table>



        <!-- AÑADIR NUEVO INGRESO-->
        <div class="col text-center mt-5">
            <a data-bs-toggle="modal" data-bs-target="#nuevo">
                <input type="button" id="anadir" class="btn" value="Nuevo Ingreso">
            </a>
        </div>


        <div class="modal" id="nuevo">
        <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                    <p class="modal-title ms-3">Alta de ingresos</p> 
                    <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>


                <!-- Modal body -->
                <div class="modal-body info">                         
                <div class="row ms-1 me-1">                                                                                                           
                                                    
                        <form action="<?php echo RUTA_URL?>/adminFacturacion/nuevo_ingreso" method="post">

                            <div class="row mt-4 mb-4">
                                <div class="col-6">
                                    <div class="input-group">
                                        <label for="fecha" class="input-group-text">Fecha</label>
                                        <input type="date" class="form-control form-control-md" name="fecha">    
                                    </div> 
                                </div>
                                <div class="col-6">
                                    <div class="input-group">
                                        <label for="importe" class="input-group-text">Importe</label>
                                        <input type="text" class="form-control form-control-md" name="importe">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="input-group">
                                    <label for="tipo" class="input-group-text">Tipo de ingreso <sup>*</sup></label>
                                    <select class="form-control" name="tipo"  id="tipo_select" onchange="opciones()" required>
                                        <option value="">-- Selecciona una opcion--</option>
                                        <option value="Cuotas">Cuotas Socios</option>
                                        <option value="Equipacion">Equipacion socios</option>
                                        <option value="Entidades">Entidades colaboradoras</option>
                                        <option value="Eventos">Participantes a eventos</option>
                                        <option value="Otros">Otros ingresos</option>
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="row mb-4" id="soc" style="display:none">
                                <div class="input-group">
                                    <label for="tipo" class="input-group-text">Asociar ingreso a <sup>*</sup></label>
                                    <select class="form-control" name="socio">
                                        <option value="">-- Selecciona un socio --</option>
                                        <?php foreach ($datos['socios'] as $usu) : ?>
                                        <option value="<?php echo $usu->id_usuario?>"> <?php echo $usu->nombre.' '.$usu->apellidos?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4" id="enti" style="display:none">
                                <div class="input-group">
                                    <label for="tipo" class="input-group-text">Asociar ingreso a <sup>*</sup></label>
                                    <select class="form-control" name="entidad">
                                        <option value="">-- Selecciona una entidad --</option>
                                        <?php foreach ($datos['entidades'] as $enti) : ?>
                                        <option value="<?php echo $enti->id_entidad?>"> <?php echo $enti->nombre?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div> 
                            

                            <div class="row mb-4" id="even" style="display:none">
                                <div class="input-group">
                                    <label for="tipo" class="input-group-text">Evento <sup>*</sup></label>
                                    <select class="form-control" name="evento" id="tipo_even" onchange="opcion()">
                                        <option value="">-- Selecciona un evento --</option>
                                        <?php foreach ($datos['eventos'] as $even) : ?>
                                        <option value="<?php echo $even->id_evento?>"> <?php echo $even->nombre?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4" id="parti" style="display:none">
                                <div class="input-group">
                                    <label for="tipo" class="input-group-text">Asociar ingreso a <sup>*</sup></label>
                                    <select class="form-control" name="participante" id="combo">
                                        <option value="">-- Selecciona un participante --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-group mb-4">
                                    <textarea  type="text" style="height:150px" class="form-control" id="observaciones" name="observaciones" placeholder="Concepto"></textarea>
                                </div>
                            </div> 

                            <div class="d-flex justify-content-end">
                                <input type="submit" class="btn mt-4 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                            </div> 

                        </form>

                    </div>
                    </div>

        </div>
        </div>
        </div>


</article>



    

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>



 <script>




   function opciones() {

      var opcion=document.getElementById("tipo_select").value;

      if (opcion=="Cuotas") {
            document.getElementById("soc").style.display ="block";
            document.getElementById("enti").style.display ="none";
            document.getElementById("even").style.display ="none";
            document.getElementById("parti").style.display ="none";
      }else if (opcion=="Equipacion") {
            document.getElementById("soc").style.display ="block";
            document.getElementById("enti").style.display ="none";
            document.getElementById("even").style.display ="none";
            document.getElementById("parti").style.display ="none";
      }else if (opcion=="Entidades") {
            document.getElementById("soc").style.display ="none";
            document.getElementById("enti").style.display ="block";
            document.getElementById("even").style.display ="none";
            document.getElementById("parti").style.display ="none";
      }else if (opcion=="Eventos") {
            document.getElementById("soc").style.display ="none";
            document.getElementById("enti").style.display ="none";
            document.getElementById("even").style.display ="block";
            document.getElementById("parti").style.display ="none";
      }else if (opcion=="Otros") {
            document.getElementById("soc").style.display ="none";
            document.getElementById("enti").style.display ="none";
            document.getElementById("even").style.display ="none";
            document.getElementById("parti").style.display ="none";
      }
      
    }


    function opcion() {
        document.getElementById("parti").style.display ="block";
    
        var evento=document.getElementById("tipo_even").value;
        console.log(evento);
        var parti=document.getElementById("combo");

        parti.innerHTML="";
    
        var part=<?php echo json_encode($datos['participantes']);?>;

        for (let i = 0; i < part.length; i++) {
            if(part[i]['id_evento']==evento){
                var op=document.createElement("option")
                op.setAttribute("value",part[i]['id_participante'])
                op.innerHTML = part[i]['nombre']+" "+ part[i]['apellidos'];
                parti.appendChild(op);
            }
        }   
    }


    function opcion_edi(id) {

        var seleccion="tipo_select"+id;
        var opcion=document.getElementById(seleccion).value;

        if (opcion=="Cuotas") {
            document.getElementById("soc"+id).style.display ="block";
            document.getElementById("enti"+id).style.display ="none";
            document.getElementById("even"+id).style.display ="none";
            document.getElementById("parti"+id).style.display ="none";
        }else if (opcion=="Equipacion") {
            document.getElementById("soc"+id).style.display ="block";
            document.getElementById("enti"+id).style.display ="none";
            document.getElementById("even"+id).style.display ="none";
            document.getElementById("parti"+id).style.display ="none";
        }else if (opcion=="Entidades") {
            document.getElementById("soc"+id).style.display ="none";
            document.getElementById("enti"+id).style.display ="block";
            document.getElementById("even"+id).style.display ="none";
            document.getElementById("parti"+id).style.display ="none";
        }else if (opcion=="Eventos") {
            document.getElementById("soc"+id).style.display ="none";
            document.getElementById("enti"+id).style.display ="none";
            document.getElementById("even"+id).style.display ="block";
            document.getElementById("parti"+id).style.display ="none";
        }else if (opcion=="Otros") {
            document.getElementById("soc"+id).style.display ="none";
            document.getElementById("enti"+id).style.display ="none";
            document.getElementById("even"+id).style.display ="none";
            document.getElementById("parti"+id).style.display ="none";
        }

    }

    function op_edi(id) {
        document.getElementById("parti"+id).style.display ="block";
    
        var even=document.getElementById("tipo_even"+id).value;
        var parti=document.getElementById("combo"+id);
        parti.innerHTML="";
    
        var part=<?php echo json_encode($datos['participantes']);?>;

        for (let i = 0; i < part.length; i++) {
            if(part[i]['id_evento']==even){
                var op=document.createElement("option")
                op.setAttribute("value",part[i]['id_participante'])
                op.innerHTML = part[i]['nombre']+" "+ part[i]['apellidos'];
                parti.appendChild(op);
            }
        }   
    }




</script>
