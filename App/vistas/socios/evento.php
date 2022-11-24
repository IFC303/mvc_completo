<?php require_once RUTA_APP . '/vistas/inc/nav.php' ?>



      <!------------------------------ CABECERA -------------------------------->
      <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center ">
                    <span id="textoHead">Eventos disponibles</span>
                </div>
                <div class="col-2 mt-1">
                    <a href="<?php echo RUTA_URL ?>/login/logout">
                        <button class="btn" id="btn_logout"><img class="me-2" src="<?php echo RUTA_Icon ?>logout.png">Logout</button>
                    </a>
                </div>            
            </div>                                   
        </header>
    <!----------------------------------------------------------------------->


    <article>
            <table id="tabla" class="table"> 
                <thead>
                    <tr>
                        <th>EVENTO</th>
                        <th>TIPO</th>  
                        <th>PRECIO</th>
                        <th>FECHA REALIZACION</th> 
                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[3])):?>
                                <th>OPCIONES</th>
                        <?php endif ?>                                                   
                    </tr>
                </thead> 
                 <tbody>               
                    <?php foreach ($datos['eventos'] as $evento) :?>
                        <tr id="manita">
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $evento->id_evento?>"><?php echo $evento->nombre?></td>
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $evento->id_evento?>"><?php echo $evento->tipo?></td>
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $evento->id_evento?>"><?php echo $evento->precio?> €</td>
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $evento->id_evento?>"><?php echo date("d/m/Y", strtotime($evento->fecha_ini))?></td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[3])):?>

                            <td>
                                <!-- VER RESULTADOS-->
                                <a data-bs-toggle="modal" data-bs-target="#resultados<?php echo $evento->id_evento?>">
                                    <button type="button" class="btn" id="botonVolver">
                                         Resultados
                                    </button>
                                </a>
                               
                                <!-- Ventana -->
                                <div class="modal fade" id="resultados<?php echo $evento->id_evento?>">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header azul">
                                        <p class="modal-title ms-3">Resultados: <?php echo $evento->nombre?> </p> 
                                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body info mb-3">                           
                                    <div class="container">

                                    <table class="table mb-5 table-responsive" >
                                        <!--CABECERA TABLA-->
                                        <thead>
                                            <tr> 
                                                <th>PARTICIPANTES</th>
                                                <th>DORSAL</th>
                                                <th>MARCA</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php foreach ($datos['resul_eventos'] as $resul){
                                                    if($resul->id_evento==$evento->id_evento){?>
                                                    <tr>
                                                        <td><?php echo $resul->nombre.' '.$resul->apellidos?></td>
                                                        <td><?php echo $resul->dorsal?></td>
                                                        <td><?php echo $resul->marca?></td>
                                                    </tr>
                                                    <?php }
                                                }
                                            
                                                ?>
                                                    
                                            </tbody>
                                    </table>

                                    </div>
                                    </div>
                                    
                                </div>
                                </div>
                                </div>





                                <!-- MODAL VER-->
                                <!-- Ventana -->
                                <div class="modal fade" id="ver<?php echo $evento->id_evento?>">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header azul">
                                        <p class="modal-title ms-3">Evento: <?php echo $evento->nombre?></p> 
                                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body info mb-3">                           
                                    <div class="container">

                                            <div class="row mt-4 mb-4">
                                                <div class="input-group">
                                                    <label for="nombre" class="input-group-text">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $evento->nombre?> " readonly> 
                                                </div>
                                            </div>

                                            <div class="row mt-4 mb-4">
                                                <div class="col-7">
                                                    <div class="input-group">
                                                    <label class="input-group-text">Tipo</label>
                                                        <input type="text" class="form-control" value="<?php echo $evento->tipo?>" readonly> 
                                                    </div>
                                                </div>

                                                <div class="col-5">   
                                                    <div class="input-group ">
                                                        <label class="input-group-text">Precio</label>
                                                        <input type="text" class="form-control" value="<?php echo $evento->precio.' €'?>"  readonly> 
                                                    </div>                     
                                                </div>
                                            </div>

                                            <div class="row mt-4 mb-4">  
                                                <div class="col-6">
                                                <div class="input-group ">
                                                    <label class="input-group-text">Inicio Evento</label>
                                                    <input type="date" class="form-control" value="<?php echo $evento->fecha_ini?>"  readonly> 
                                                </div> 
                                                </div>                     
                                            
                                                <div class="col-6">  
                                                <div class="input-group ">
                                                    <label class="input-group-text">Fin Evento</label>
                                                    <input type="date" class="form-control" value="<?php echo $evento->fecha_fin?>"  readonly> 
                                                </div>  
                                                </div>                   
                                            </div>

                                            <div class="row mt-4 mb-4">
                                                <div class="col-6">   
                                                    <div class="input-group ">
                                                        <label class="input-group-text">Inicio inscripcion</label>
                                                        <input type="date" class="form-control" value="<?php echo $evento->fecha_ini?>"  readonly> 
                                                    </div>                     
                                                </div>
                                                <div class="col-6">   
                                                    <div class="input-group ">
                                                        <label class="input-group-text">Fin inscripcion</label>
                                                        <input type="date" class="form-control" value="<?php echo $evento->fecha_fin?>"  readonly> 
                                                    </div>                     
                                                </div>
                                            </div>

                                            <div class="row mb-4">                         
                                                <div class="input-group">
                                                    <textarea  type="text" style="height:150px" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" readonly><?php echo $evento->descripcion?></textarea>
                                                </div>                           
                                            </div> 

                                            <!-- Modal footer -->
                                            <form enctype="multipart/form-data" action="<?php echo RUTA_URL?>/socio/ins_evento/<?php echo $evento->id_evento?>" method="post">                                                   
                                                <div class="row pt-3 pb-3">
                                                    <div class="col-6"><input  accept="image/*" type="file" name="pago" required></div>
                                                    <div class="col-6 d-flex justify-content-end"><input type="submit" class="btn" name="aceptar" id="confirmar" value="Inscribirse"></div>
                                                </div>
                                            </form>
                                     
                                    </div>
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


        </article>



        


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>