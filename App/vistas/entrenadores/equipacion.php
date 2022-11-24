<?php require_once RUTA_APP . '/vistas/inc/navE.php' ?>

<style>

.flip-card {
  background-color: transparent;
  width: 300px;
  height: 350px;
  perspective: 1000px;
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}

.flip-card-front {
  background-color: light-grey;
  color: black;
}

.flip-card-back {
  background-color:rgb(235, 245, 255);
  text-align:center;
  padding-top:20px;
  transform: rotateY(180deg);
}
</style>

    <!------------------------------ CABECERA -------------------------------->
           <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center ">
                    <span id="textoHead">Pedidos de equipaciones</span>
                </div>
                <div class="col-2 mt-1">
                    <a href="<?php echo RUTA_URL ?>/login/logout">
                        <button class="btn" id="btn_logout"><img class="me-2" src="<?php echo RUTA_Icon ?>logout.png">Logout</button>
                    </a>
                </div>            
            </div>                                   
        </header>
    <!----------------------------------------------------------------------->

    <article class="pt-4">

        <div class="d-flex align-items-center justify-content-center mt-5">
            <?php foreach($datos['equipacion'] as $equipacion){ ?>
                               
                <div class="flip-card float-start mb-4 me-5 shadow-lg" style="width: 18rem;">
                    <a data-bs-toggle="modal" data-bs-target="#ModalPedido_<?php echo $equipacion->id_equipacion?>">                        
                        <img style="height:220px; " class="card-img mt-2" 
                            <?php if($equipacion->imagen==''){?>
                                src='<?php echo RUTA_Equipacion?>noFoto.jpg'<?php ;                                                  
                            }else{?>
                                src='<?php echo RUTA_Equipacion.$equipacion->id_equipacion.'.jpg';}?>'>
                        <div class="card-body">
                            <h5><span class="badge bg-primary me-3"><?php echo $equipacion->precio?> €</span><?php echo $equipacion->tipo?></h5>
                            <h6><span class="badge bg-primary"><?php echo $equipacion->descripcion?></span></h6>                                             
                        </div>
                    </a>    
                </div>


                <!-- Ventana modal-->
                <div class="modal fade" id="ModalPedido_<?php echo $equipacion->id_equipacion?>">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">

                     <!-- Modal Header -->
                    <div class="modal-header azul">
                        <p class="titulito ms-3 mt-2 mb-2">Nuevo pedido</p> 
                        <button type="button" class="btn-close me-1" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body info">
                        <form method="post" action="<?php echo RUTA_URL?>/entrenador/pedir_equipacion" class="card-body">                           
                            <div class="row mt-3 mb-4">            
                                <div class="input-group">
                                    <label for="cantidad" class="input-group-text"><span class="info">Cantidad<sup>*</sup></span></label>
                                    <input class="form-control" type="number" id="cantidad" name="cantidad" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="input-group">
                                    <label for="talla" class="input-group-text"><span class="info">Talla<sup>*</sup></span></label>
                                    <select name="talla" class="form-control" id="talla" required>
                                        <option value="">-- Elige talla --</option>
                                        <?php foreach ($datos['talla'] as $talla) : ?>
                                        <option id="id_talla" value="<?php echo $talla->id_talla ?>"><?php echo $talla->nombre ?></option>
                                        <?php endforeach ?>
                                    </select>
                            </div>
                            </div>

                            <input type="hidden" name="idEquipacion" id="idEquipacion" value="<?php echo $equipacion->id_equipacion ?>">
                            <div class="d-flex justify-content-end">
                                <input type="submit" class="btn mt-4 mb-3" name="aceptar" id="confirmar" value="Confirmar"> 
                            </div>                                                                     
                        </form>
                    </div>

                </div>
                </div>
                </div>

            <?php }?>
         
            </div> 
            
            
            <div class="d-flex align-items-center justify-content-around mt-5 ">
                <button class="btn text-white" id="anadir" data-bs-toggle="modal" data-bs-target="#mis_pedidos">Mis pedidos</button>
            </div>


                <!-- VENTANA -->
                <div class="modal fade" id="mis_pedidos">
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


                        <div class="mt-4 mb-5">
                            <img class="icono" src="<?php echo RUTA_Icon ?>tramite.png"></img> En tramite
                            <img class="icono" src="<?php echo RUTA_Icon ?>solicitado.png"></img> Pendiente de recogida
                            <img class="icono" src="<?php echo RUTA_Icon ?>confirmado.png"></img> Entregado
                            <img class="icono" src="<?php echo RUTA_Icon ?>cancelado.png"></img> Cancelado
                        </div>


                            <table class="table mb-5">
                                <!--CABECERA TABLA-->
                                <thead>
                                    <tr> 
                                        <th>FECHA PETICION</th>
                                        <th>TIPO</th>
                                        <th>CANTIDAD</th>
                                        <th>TALLA</th>      
                                        <th>PRECIO</th> 
                                        <th>ESTADO</th>                                               
                                    </tr>
                                </thead>
                                <!--BODY TABLA-->
                                <tbody>               
                                    <?php foreach ($datos['equi'] as $equi) :?>
                                        <tr>
                                            <td><?php echo date("d/m/Y", strtotime($equi->fecha_peticion))?></td>
                                            <td><?php echo $equi->tipo?></td>
                                            <td><?php echo $equi->cantidad?></td>
                                            <td><?php echo $equi->nombre?></td>
                                            <td><?php echo $equi->precio?> €</td> 
                                            <td>
                                                <?php if($equi->estado==0){?>
                                                        <img style="height:35px;" src="<?php echo RUTA_Icon ?>new.png"></img>
                                                        <a href="<?php echo RUTA_URL?>/entrenador/borrar_pedido/<?php echo $equi->id_soli_equi?>">
                                                            <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                                        </a>
                                                <?php }?>

                                                <?php if($equi->estado==1){?>
                                                        <img class="icono" src="<?php echo RUTA_Icon ?>tramite.png"></img>
                                                <?php }?>

                                                <?php if($equi->estado==2){?>
                                                        <img class="icono" src="<?php echo RUTA_Icon ?>solicitado.png"></img>
                                                <?php }?>

                                                <?php if($equi->estado==3){?>
                                                        <img class="icono" src="<?php echo RUTA_Icon ?>confirmado.png"></img>
                                                <?php }?>

                                                <?php if($equi->estado==4){?>
                                                        <img class="icono" src="<?php echo RUTA_Icon ?>cancelado.png"></img>
                                                <?php }?>

                                            </td>
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

