<?php require_once RUTA_APP . '/vistas/inc/nav.php' ?>


      <!------------------------------ CABECERA -------------------------------->
      <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Pedido de equipaciones</span>
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

        <div class="d-flex align-items-center justify-content-around mt-5 ">
            <?php foreach($datos['equipacion'] as $equipacion){ ?>
                               
                <div class="card float-start mb-4 shadow-lg" style="width: 18rem;">
                    <a data-bs-toggle="modal" data-bs-target="#ModalPedido_<?php echo $equipacion->id_equipacion?>">                        
                        <img style="height:220px; " class="card-img mt-2" 
                            <?php if($equipacion->imagen==''){?>
                                src='<?php echo RUTA_Equipacion?>noFoto.jpg'<?php ;                                                  
                            }else{?>
                                src='<?php echo RUTA_Equipacion.$equipacion->id_equipacion.'.jpg';}?>'>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $equipacion->tipo?></h5>
                            <h5><span class="badge bg-primary"><?php echo $equipacion->precio?> €</span></h5>                                         
                        </div>
                    </a>
                </div>
                    

                <!-- Ventana modal-->
                <div class="modal" id="ModalPedido_<?php echo $equipacion->id_equipacion?>">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <!-- Body -->
                    <div class="modal-body">
                    <form method="post" action="<?php echo RUTA_URL?>/socio/pedir_equipacion" class="card-body">

                            <div class="row">

                                <div class="col-5">
                                    <div >
                                        <img id="outputVer" width="300px" height="300px" 
                                            <?php if ($equipacion->imagen==''){?> 
                                                src='<?php echo RUTA_Equipacion?>noFoto.jpg'<?php
                                            }else {?> 
                                                src='<?php echo RUTA_Equipacion.$equipacion->id_equipacion.'.jpg';} ?>'>
                                    </div>                                                      
                                </div>


                                <div class="col-7">  
                                    
                               
                                    <h5 class="card-title"><?php echo $equipacion->tipo?></h5>
                                    <h5><span class="badge bg-primary"><?php echo $equipacion->precio?> €</span></h5>
                                    <div class="row mt-4 ps-3">Temporada <?php echo $equipacion->temporada?></div>
                                    <div class="row mb-5 ps-3"><?php echo $equipacion->descripcion?></div>
                                 

                                    <div class="row mt-5 mb-5">
                                        <div class="col-6">
                                            <input class="form-control" type="number" id="cantidad" name="cantidad" placeholder="Cantidad" required>
                                        </div>
                                        <div class="col-6">
                                            <select name="talla" class="form-control" id="talla" required>
                                                <option value="">-- Talla --</option>
                                                <?php foreach ($datos['talla'] as $talla) : ?>
                                                <option id="id_talla" value="<?php echo $talla->id_talla ?>"><?php echo $talla->nombre ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>    

                                    <input type="hidden" name="idEquipacion" id="idEquipacion" value="<?php echo $equipacion->id_equipacion ?>">
                                        <div class="row justify-content-end mt-5">
                                            <div class="col-3">
                                                <input type="submit" class="btn btn-primary" value="Confirmar">
                                            </div>
                                            <div class="col-3">
                                                <a href="<?php echo RUTA_URL?>/socio/equipacion">
                                                    <input type="button" class="btn" id="botonVolver" value="Cerrar">  
                                                </a>
                                            </div>                                                                                                      
                                        </div>
                                </div>                                                             
                            </div>
                                                                                                     
                    </form>
                    </div>

                </div>
                </div>
                </div>

            <?php }?>
         
            </div>   
            
            
            <div class="d-flex align-items-center justify-content-around mt-5 ">
                <button class="btn bg-primary text-white" data-bs-toggle="modal" data-bs-target="#mis_pedidos">Mis pedidos</button>
            </div>


                <!-- VENTANA -->
                <div class="modal" id="mis_pedidos">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">

                         <!-- Modal Header -->
                         <div class="modal-header azul">
                            <p class="modal-title ms-3">Mis pedidos</p> 
                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                        </div>
                                      

                        <!-- Modal body -->
                        <div class="modal-body info ">                         
                        <div class="row ms-1 me-1"> 
                            <table class="table mb-5">
                                <!--CABECERA TABLA-->
                                <thead>
                                    <tr> 
                                        <th>FECHA PETICION</th>
                                        <th>TIPO</th>
                                        <th>CANTIDAD</th>
                                        <th>TALLA</th>      
                                        <th>PRECIO</th>                                             
                                    </tr>
                                </thead>
                                <!--BODY TABLA-->
                                <tbody>               
                                    <?php foreach ($datos['equi'] as $equi) :?>
                                        <tr>
                                            <td><?php echo $equi->fecha_peticion?></td>
                                            <td><?php echo $equi->tipo?></td>
                                            <td><?php echo $equi->cantidad?></td>
                                            <td><?php echo $equi->talla?></td>
                                            <td><?php echo $equi->precio?></td> 
                                        </tr>                   
                                    <?php endforeach ?>                
                                </tbody>      

                            </table>
                        </div>
                        </div>

                </div>
                </div>
                </div>



        </article> 

 
<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>

