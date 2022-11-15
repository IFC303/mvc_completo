<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


        <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Gestion de pedidos</span>
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




            <div style="margin-left:600px; padding-top:100px; margin-bottom:-50px">
                <img class="icono" src="<?php echo RUTA_Icon ?>tramite.png"></img>Pedido en fabrica
                <img class="icono" src="<?php echo RUTA_Icon ?>solicitado.png"></img>Pendiente de recogida
                <img class="icono" src="<?php echo RUTA_Icon ?>confirmado.png"></img>Pedido entregado
                <img class="icono" src="<?php echo RUTA_Icon ?>cancelado.png"></img>Pedido cancelado
            </div>

<article>

        
            <table id="tabla" class="table">

            <!--CABECERA TABLA-->
            <thead>
                <tr>
                    <th>N PEDIDO</th>
                    <th>NOMBRE</th>
                    <th>APELLIDOS</th>
                    <th>FECHA PEDIDO</th>
                    <th>TIPO</th>
                    <th>TALLA</th>
                    <th>CANTIDAD</th>
                    <th>ESTADO</th>
                    <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                        <th>OPCIONES</th>
                    <?php endif ?>
                </tr>
            </thead>

            <!--BODY TABLA-->
            <tbody>
            <?php
            foreach($datos['pedidos'] as $pedido): ?>
            <tr id="manita">
                <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $pedido->id_soli_equi?>"><?php echo $pedido->id_soli_equi?></td>
                <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $pedido->id_soli_equi?>"><?php echo $pedido->nombre?></td>
                <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $pedido->id_soli_equi?>"><?php echo $pedido->apellidos?></td>
                <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $pedido->id_soli_equi?>"><?php echo $pedido->fecha_peticion?></td>
                <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $pedido->id_soli_equi?>"><?php echo $pedido->tipo?></td>
                <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $pedido->id_soli_equi?>"><?php echo $pedido->talla_nombre?></td>
                <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $pedido->id_soli_equi?>"><?php echo $pedido->cantidad?></td>
                <td>
                        <?php if($pedido->estado==0){?>
                            <img style="height:35px;" src="<?php echo RUTA_Icon ?>new.png"></img>
                       <?php }?>

                       <?php if($pedido->estado==1){?>
                            <img class="icono" src="<?php echo RUTA_Icon ?>tramite.png"></img>
                       <?php }?>

                       <?php if($pedido->estado==2){?>
                            <img class="icono" src="<?php echo RUTA_Icon ?>solicitado.png"></img>
                       <?php }?>

                       <?php if($pedido->estado==3){?>
                            <img class="icono" src="<?php echo RUTA_Icon ?>confirmado.png"></img>
                       <?php }?>

                       <?php if($pedido->estado==4){?>
                            <img class="icono" src="<?php echo RUTA_Icon ?>cancelado.png"></img>
                       <?php }?>
            
                </td>
                
                
                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>

                    <td>

                             <!-- MODAL EDITAR-->
                                <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $pedido->id_soli_equi?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a> 

                                <div class="modal" id="editar_<?php echo $pedido->id_soli_equi?>">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">Pedido Nº: <?php echo $pedido->id_soli_equi?></p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form action="<?php echo RUTA_URL?>/adminEquipaciones/cambiar_estado/<?php echo $pedido->id_soli_equi?>" method="post">
                                            <!-- Modal body -->
                                            <div class="modal-body info mt-3">
                                                <div class="row mt-3 mb-3">
                                                    <div class="input-group">
                                                        <label for="nombre" class="input-group-text">Cambiar estado</label>
                                                        <select class="form-control" name="estado" id="">
                                                            <option value="">-- Selecciona una opcion --</option>
                                                            <option value="1">Solicitado a fabrica</option>
                                                            <option value="2">Pendiente de recogida</option>
                                                            <option value="3">Entregado</option>
                                                            <option value="4">Cancelado</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <input type="submit" class="btn mb-5 me-3" name="aceptar" id="confirmar" value="Confirmar"> 
                                            </div> 
                                   
                                            </form>
                                        
                                </div>
                                </div>
                                </div>


                                <!-- MODAL VER-->
                                <!-- Ventana -->
                                <div class="modal" id="ver<?php echo $pedido->id_soli_equi?>">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">Pedido Nº: <?php echo $pedido->id_soli_equi?></p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body info mb-3">                           
                                            <div class="container">

                                                    <div class="col-12 mt-3 mb-4">
                                                        <div>
                                                        <img id="outputVer" width="250px" height="250px" 
                                                        <?php if ($pedido->imagen==''){?> src='<?php echo RUTA_Equipacion?>noFoto.jpg'<?php
                                                                }else {?> src='<?php echo RUTA_Equipacion.$pedido->id_equipacion.'.jpg';} ?>'                                                                                            
                                                        >
                                                        </div>                                    
                                                    </div>

                                                    <div class="row mb-4">   
                                                        <div class="col-6">   
                                                            <div class="input-group ">
                                                                <label for="fecha" class="input-group-text">Pedido</label>
                                                                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $pedido->fecha_peticion?>"  readonly> 
                                                            </div>    
                                                        </div>   
                                                        <div class="col-6">   
                                                            <div class="input-group ">
                                                                <label for="fecha" class="input-group-text">Socio Nº</label>
                                                                <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo $pedido->id_usuario?>"  readonly> 
                                                            </div>    
                                                        </div>                 
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="input-group">
                                                            <label for="nombre" class="input-group-text">Nombre</label>
                                                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $pedido->nombre?> " readonly> 
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="input-group">
                                                            <label for="nombre" class="input-group-text">Apellidos</label>
                                                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $pedido->apellidos?> " readonly> 
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row mb-5">  
                                                        <div class="col-6">                 
                                                            <div class="input-group ">
                                                                <label for="talla" class="input-group-text">Talla</label>
                                                                <select class="form-control" name="talla" readonly>
                                                                    <?php foreach ($datos['talla'] as $talla) : ?>
                                                                    <option value="<?php echo $talla->id_talla?>"><?php echo $pedido->talla_nombre?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div> 
                                                        <div class="col-6">                     
                                                            <div class="input-group ">
                                                                <label for="cantidad" class="input-group-text">Cantidad</label>
                                                                <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $pedido->cantidad?>" readonly> 
                                                            </div>      
                                                        </div>
                                                    </div>      
                                            </div>
                                            </div>
                                    
                                </div>
                                </div>
                                </div>


                              <!-- MODAL BORRAR -->
                              <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $pedido->id_soli_equi?>">
                                    <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                <div class="modal" id="ModalBorrar_<?php echo $pedido->id_soli_equi?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body mt-3">
                                                <p>Estas seguro que quieres <b>BORRAR</b> el pedido <b><?php echo $pedido->id_soli_equi?></b> ? </p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminEquipaciones/borrarPedido/<?php echo $pedido->id_soli_equi?>" method="post">
                                                    <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>           

                    </td>

                    <?php endif ?>
                        </tr>
                        <?php endforeach ?>
                    </tbody>

     </table>


     <!-- AÑADIR NUEVA EQUIPACION-->
        <div class="col text-center mt-5">
            <a data-bs-toggle="modal" data-bs-target="#nuevo">
                <input type="button" id="anadir" class="btn" value="Nuevo pedido">
            </a>
        </div>


        <div class="modal" id="nuevo">
        <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                        <p class="modal-title ms-3">Nuevo pedido</p> 
                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info">                         
                <div class="row ms-1 me-1">                                                                                                           
                                                    
                        <form action="<?php echo RUTA_URL?>/adminEquipaciones/nuevo_pedido" method="post">

                                <div class="row mt-4">
                                    <div class="input-group mb-4">
                                        <label for="equi" class="input-group-text">Equipacion</label>
                                        
                                        <select class="form-control" name="equi" required>
                                            <option value="">-- Selecciona una equipacion --</option>
                                            <?php foreach ($datos['equip'] as $equip) : ?>
                                            <option value="<?php echo $equip->id_equipacion?>"> <?php echo $equip->tipo?></option>
                                            <?php endforeach ?>
                                        </select>
                                        
                                    </div> 
                                </div>
                                <div class="row mb-4">
                                    <div class="input-group">
                                        <label for="usu" class="input-group-text">Usuario</label>
                                        <select class="form-control" name="usu" required>
                                            <option value="">-- Selecciona un usuario --</option>
                                            <?php foreach ($datos['usus'] as $usus) : ?>
                                            <option value="<?php echo $usus->id_usuario?>"> <?php echo $usus->nombre.' '.$usus->apellidos?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div> 
                                </div>
                            
                                <div class="row">
                                    <div class="input-group mb-4">
                                        <label for="cantidad" class="input-group-text">Cantidad<sup>*</sup></label>
                                        <input type="text" class="form-control form-control-md" id="cantidad" name="cantidad" required>    
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="input-group mb-4">
                                        <label for="talla" class="input-group-text">Talla<sup>*</sup></label>
                                        <select class="form-control" name="talla" required>
                                            <option value="">-- Selecciona una talla --</option>
                                            <?php foreach ($datos['talla'] as $talla) : ?>
                                            <option value="<?php echo $talla->id_talla?>"> <?php echo $talla->nombre?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div> 
                                </div>
                               

                                <div class="d-flex justify-content-end">
                                    <input type="submit" class="btn mt-3 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
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


// function filtrar(){
//     var campo=document.getElementById("filtro");
//     var valor=(campo.value).toUpperCase().trim();
//     //console.log(valor););

//     var filas=document.getElementById("tabla").getElementsByTagName("tbody")[0].rows;
//     //console.log(filas);

//        for(var i=0; i<filas.length; i++){
//            console.log(filas[i]);
//            //console.log(filas[i].innerText.toLocaleUpperCase())
//            //console.log(filas[i].cells.namedItem("nombreUsu").innerText.toLocaleUpperCase())
//            if(filas[i].innerText.toLocaleUpperCase().indexOf(valor) !== -1 ){
//                    filas[i].style.display = null;
//                  }else{
//                    filas[i].style.display = 'none';
//                 }




//         //

//     }
// }


// window.onload=function(){
//     var filtro=document.getElementById("filtro");
//     filtro.onkeyup=function(){
//         filtrar();
//     }
//}

    </script>












