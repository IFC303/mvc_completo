<?php require_once RUTA_APP . '/vistas/inc/nav.php' ?>
 
   
        <header>              
            <div class="row">
                <div class="col-10"><span id="tHead">Equipaciones</span></div>     
                <div class="col-2">
                    <a type="button" class="btn" style="background-color:#0b2a85" href="<?php echo RUTA_URL ?>/login/logout">
                        <span style="font-size:25px;color:white">Logout</span>
                        <img class="ms-2" id="salirHeader" src="<?php echo RUTA_Icon ?>logout.png" style="width:35px;height:35px" >
                    </a>
                </div>
            </div>                                 
        </header>


        <article>
        <div class="d-flex align-items-center justify-content-around mt-5 ">
            <?php foreach($datos['equipacion'] as $equipacion){ ?>
                               
                <div class="card float-start mb-4 shadow-lg" style="width: 18rem;">
                    <a data-bs-toggle="modal" data-bs-target="#ModalPedido_<?php echo $equipacion->id_equipacion?>">                        
                        <img style="height:220px; " class="card-img-top" 
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
                                    <div>
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
                                            <input class="form-control" type="number" id="cantidad" name="cantidad" placeholder="Cantidad">
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" id="talla" name="talla" type="text" placeholder="Talla">
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
        </article> 

 
<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>

