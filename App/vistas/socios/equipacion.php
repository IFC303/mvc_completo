<?php require_once RUTA_APP . '/vistas/inc/header-socio-paginas.php' ?>




<style>
  .border {
    display: inline-block;
    width: 200px;
    height: 200px;
    margin: 7px;
  }
  </style>



                <div class="container mt-3">

                    <?php 
                        foreach($datos['equipacion'] as $equipacion){// var_dump($equipacion);?>
                            
                                <a data-bs-toggle="modal" data-bs-target="#ModalPedido_<?php echo $equipacion->id_equipacion?>"> 
                                                                       
                                        <img class="border" 
                                            <?php if($equipacion->imagen==''){?>
                                                src='<?php echo RUTA_Equipacion?>noFoto.jpg'<?php
                                            }else{?>
                                                src='<?php echo RUTA_Equipacion.$equipacion->id_equipacion.'.jpg';}?>'                                
                                        >
                                        <span><?php echo $equipacion->tipo?></span>
                                                                                                                           
                                </a>
                             
                                    <!-- Ventana -->
                                    <div class="modal" id="ModalPedido_<?php echo $equipacion->id_equipacion?>">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Nuevo pedido: <?php echo $equipacion->tipo?></h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/socio/pedir_equipacion" class="card-body">

                                                    <div class="row">
                                                            <div class="col-5">
                                                                <div>
                                                                    <img id="outputVer" width="300px" height="300px" 
                                                                    <?php if ($equipacion->imagen==''){?> src='<?php echo RUTA_Equipacion?>noFoto.jpg'<?php
                                                                        }else {?> src='<?php echo RUTA_Equipacion.$equipacion->id_equipacion.'.jpg';} ?>'                                                                                             
                                                                    >
                                                                </div>                                                      
                                                            </div>

                                                            <div class="col-7">
                                                                <div class="form-control form-floating mt-3 mb-3"style="height:250px">
                                                                    
                                                                    <div class="row pt-3 ps-3"><div><p><em>Temporada: </em><?php echo $equipacion->temporada?></p></div></div>
                                                                    <div class="row pb-3 ps-3"><div><p><em>Precio: </em><?php echo $equipacion->precio?> €</p></div></div>
                                                                   
                                                                    <div class="row ps-3"><?php echo $equipacion->descripcion?></div>
                                                        
                                                                </div>                                                                                                                                                       
                                                            </div>                                                             
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                                <div class="form-floating mb-3 mt-3">
                                                                    <input autocomplete="off" type="text" class="form-control" id="cantidad" placeholder="Enter cantidad" name="cantidad">
                                                                    <label for="cantidad">Cantidad</label>
                                                                </div>
                                                        </div>
                                                        <div class="col-6">
                                                                <div class="form-floating mt-3 mb-3">
                                                                    <input autocomplete="off" type="talla" class="form-control" id="talla" placeholder="Enter talla" name="talla">
                                                                    <label for="talla">Talla</label>
                                                                </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="idEquipacion" id="idEquipacion" value="<?php echo $equipacion->id_equipacion ?>">
                                                        <input type="submit" class="btn" value="Confirmar">                                               
                                                    </div>

                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    </div>

                        
                   <?php }?>


                </div>






  

        
        <?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>