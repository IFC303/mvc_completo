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
                        foreach($datos['equipacion'] as $equipacion){ //var_dump($equipacion);?>
                            
                                <a data-bs-toggle="modal" data-bs-target="#ModalPedido">
                                 <span class="border border-primary"><?php echo $equipacion->tipo?></span>
                                </a>
                                
                                    <!-- Ventana -->
                                    <div class="modal" id="ModalPedido">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Nuevo pedido</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/tienda/nueva_equipacion" class="card-body">

                                                    <div class="row">
                                                        <div class="col-6 mt-3 mb-3">
                                                            <label for="tipo">Cantidad</label>
                                                            <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" required>
                                                        </div>

                                                        <div class="col-6 mt-3 mb-3">
                                                            <label for="talla">Talla</label>
                                                            <input type="text" name="talla" id="talla" class="form-control form-control-lg" required>
                                                        </div>
                                                    </div>

                                                      <input type="hidden" name="usu" value="<?php echo $tienda->id_usuario?>">

                                                    <br>
                                                    <div class="row">
                                                    <div class="col-3">
                                                        <input type="submit" class="btn" value="Confirmar">
                                                        <!-- <a href="<?php echo RUTA_URL?>/tienda">
                                                            <input type="button" class="btn" id="botonVolver" value="Volver">  
                                                        </a> -->
                                                    </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    </div>

                        
                   <?php }?>


                </div>






  

        
        <?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>