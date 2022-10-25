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




<article>

            <table id="tabla" class="table">


            <!--CABECERA TABLA-->
            <thead>
                <tr>
                    <th>N SOCIO</th>
                    <th>NOMBRE</th>
                    <th>APELLIDOS</th>
                    <th>FECHA PEDIDO</th>
                    <th>TIPO</th>
                    <th>TALLA</th>
                    <th>CANTIDAD</th>
                    <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                        <th>OPCIONES</th>
                    <?php endif ?>
                </tr>
            </thead>

            <!--BODY TABLA-->
            <tbody>
            <?php
            foreach($datos['pedidos'] as $pedido): ?>
            <tr>
                <td><?php echo $pedido->id_usuario?></td>
                <td><?php echo $pedido->nombre?></td>
                <td><?php echo $pedido->apellidos?></td>
                <td><?php echo $pedido->fecha_peticion?></td>
                <td><?php echo $pedido->tipo?></td>
                <td><?php echo $pedido->talla?></td>
                <td><?php echo $pedido->cantidad?></td>
                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>

                    <td>


                                <!-- MODAL EDITAR-->
                                <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $pedido->id_soli_equi?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                <!-- Ventana -->
                                <div class="modal" id="editar_<?php echo $pedido->id_soli_equi?>">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">edicion</p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body info mb-3">                           
                                            <div class="container">

                                            <form method="post" action="<?php echo RUTA_URL?>/adminEquipaciones/editar_pedido/<?php echo $pedido->id_soli_equi?>">

                                            
                                                <div class="row">
                                                    <div class="col-4 mt-3 mb-4">
                                                        <div>
                                                        <img id="outputVer" width="300px" height="300px" 
                                                        <?php if ($pedido->imagen==''){?> src='<?php echo RUTA_Equipacion?>noFoto.jpg'<?php
                                                                }else {?> src='<?php echo RUTA_Equipacion.$pedido->id_equipacion.'.jpg';} ?>'                                                                                            
                                                        >
                                                        </div>                                    
                                                    </div>

                                                    <div class="col-8 mt-3 mb-4">
                                                        <div class="row mb-4">   
                                                            <div class="col-5">
                                                                <div class="input-group ">
                                                                    <label for="fecha" class="input-group-text">Fecha pedido</label>
                                                                    <input type="date" class="form-control form-control-md" id="fecha" name="fecha" value="<?php echo $pedido->fecha_peticion?>"  readonly> 
                                                                </div>
                                                            </div>  
                                                            <div class="col-7">                         
                                                                <div class="input-group">
                                                                    <label for="nombre" class="input-group-text">Nombre y apellidos</label>
                                                                    <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $pedido->nombre." ".$pedido->apellidos?> " readonly> 
                                                                </div>                           
                                                            </div>  
                                                        </div>
                                                        <div class="row mb-4">   
                                                            <div class="col-5">                         
                                                                <div class="input-group">
                                                                    <label for="telefono" class="input-group-text">Telefono</label>
                                                                    <input type="text" class="form-control form-control-md" id="telefono" name="telefono" value="<?php echo $pedido->telefono?>" readonly> 
                                                                </div>                           
                                                            </div>
                                                            <div class="col-7">                         
                                                                <div class="input-group">
                                                                    <label for="email" class="input-group-text">Email</label>
                                                                    <input type="text" class="form-control form-control-md" id="email" name="email" value="<?php echo $pedido->email?>" readonly> 
                                                                </div>                           
                                                            </div>
                                                        </div>
                                                        <div class="row">  
                                                            <div class="col-6">                 
                                                                <div class="input-group ">
                                                                    <label for="talla" class="input-group-text">Talla</label>
                                                                    <input type="text" class="form-control form-control-md" id="talla" name="talla" value="<?php echo $pedido->talla?>">
                                                                </div>
                                                            </div> 
                                                            <div class="col-6">                     
                                                                <div class="input-group ">
                                                                    <label for="cantidad" class="input-group-text">Cantidad</label>
                                                                    <input type="number" class="form-control form-control-md" id="cantidad" name="cantidad" value="<?php echo $pedido->cantidad?>" > 
                                                                </div>      
                                                            </div>
                                                        </div>
                                                        <div class=" d-flex justify-content-end">
                                                            <input type="submit" class="btn mt-5" name="aceptar" id="confirmar" value="Confirmar">        
                                                        </div> 
                                                    </div>
                                                </div> 
                                                </div> 
                                                
                                                
                                                 
                                                </form>
                                                 
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


                                <!-- MODAL EDITAR -->
                                <!-- <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $pedido->id_soli_equi?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a> -->

                                    <!-- Ventana -->
                                    <!-- <div class="modal" id="ModalEditar_<?php echo $pedido->id_soli_equi?>">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content"> -->

                                            <!-- Header -->
                                            <!-- <div class="modal-header">
                                                <h2 class="modal-title">Edicion del pedido</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div> -->

                                            <!-- Body -->
                                            <!-- <div class="modal-body">

                                                <form method="post" action="<?php echo RUTA_URL?>/adminEquipaciones/editar_equipacion/<?php echo $pedido->id_soli_equi?>" class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                                <div>
                                                                    <img id="outputVer" width="225px" height="225px"
                                                                    <?php if ($pedido->imagen==''){?> src='<?php echo RUTA_Equipacion?>noFoto.jpg'<?php
                                                                        }else {?> src='<?php echo RUTA_Equipacion.$pedido->id_equipacion.'.jpg';} ?>'
                                                                    >
                                                                </div>
                                                        </div>

                                                    <div class="col-6">
                                                        <div class="row w-75 mb-4 ms-3">
                                                                <label class="cantidad mb-2" for="cantidad">Cantidad <sup>*</sup></label>
                                                                <input class="form-control ms-3" type="number" id="cantidad" name="cantidad" value="<?php echo $pedido->cantidad?>" required>
                                                        </div>
                                                        <div class="row w-75 ms-3">
                                                            <label class="talla mb-2" for="talla">Talla <sup>*</sup></label>
                                                            <input class="form-control ms-3" id="talla" name="talla" type="text"value="<?php echo $pedido->talla?> " required>
                                                        </div>
                                                    </div>

                                                    </div>

                                                    <br>
                                                    <input type="submit" class="btn" value="Confirmar">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    </div> -->


                                    <!-- MODAL CAMBIAR ESTADO ENTREGA -->
                                        <?php
                                        if ($pedido->recogido == 1){ ?>
                                            <a data-bs-toggle="modal" data-bs-target="#ModalCambiar_<?php echo $pedido->id_soli_equi?>" href="<?php echo RUTA_URL?>/adminEquipaciones/cambiar_estado/<?php echo $pedido->id_soli_equi?>">
                                                <img class="icono" src="<?php echo RUTA_Icon ?>tick.png" ></img>
                                            </a>
                                            <!-- VENTANA -->
                                            <div class="modal" id="ModalCambiar_<?php echo $pedido->id_soli_equi?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body mt-3">
                                                            <p>Vas a cambiar el estado del pedido a <b>NO ENTREGADO</b>, estas seguro? </p>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <form action="<?php echo RUTA_URL?>/adminEquipaciones/cambiar_estado/<?php echo $pedido->id_soli_equi?>" method="post">
                                                                <input type="hidden" name="estado" value="<?php echo $pedido->recogido?>">
                                                                <input type="submit" class="btn" name="borrar" id="borrar" value="Aceptar">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                        }else{?>
                                            <a data-bs-toggle="modal" data-bs-target="#ModalCambiar_<?php echo $pedido->id_soli_equi?>" href="<?php echo RUTA_URL?>/adminEquipaciones/cambiar_estado/<?php echo $pedido->id_soli_equi?>">
                                                <img class="icono" src="<?php echo RUTA_Icon ?>x1.png"></img>
                                            </a>
                                            <div class="modal" id="ModalCambiar_<?php echo $pedido->id_soli_equi?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body mt-3">
                                                        <p>Vas a cambiar el estado del pedido a <b>ENTREGADO</b>, estas seguro? </p>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <form action="<?php echo RUTA_URL?>/adminEquipaciones/cambiar_estado/<?php echo $pedido->id_soli_equi?>" method="post">
                                                                <input type="hidden" name="estado" value="<?php echo $pedido->recogido?>">
                                                                <input type="submit" class="btn" name="borrar" id="borrar" value="Aceptar">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
            

                    </td>

                    <?php endif ?>
                        </tr>
                        <?php endforeach ?>
                    </tbody>

     </table>


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












