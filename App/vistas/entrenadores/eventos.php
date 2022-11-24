<?php require_once RUTA_APP . '/vistas/inc/navE.php' ?>

      
    <!------------------------------ CABECERA -------------------------------->
    <header>
        <div class="row mb-5">
            <div class="col-10 d-flex align-items-center justify-content-center ">
                <span id="textoHead">Participantes y eventos</span>
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
                        <th>FECHA REALIZACION</th> 
                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                                <th>OPCIONES</th>
                        <?php endif ?>                                                   
                    </tr>
                </thead> 
                 <tbody>               
                    <?php foreach ($datos['eventos'] as $evento) :?>
                        <tr id="manita">
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $evento->id_evento?>"><?php echo $evento->nombre?></td>
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $evento->id_evento?>"><?php echo $evento->tipo?></td>
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $evento->id_evento?>"><?php echo date("d/m/Y", strtotime($evento->fecha_ini))?></td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>

                            <td>
                                <!-- VER RESULTADOS-->
                                <a data-bs-toggle="modal" data-bs-target="#resultados<?php echo $evento->id_evento?>">
                                    <button type="button" class="btn" id="botonVolver">
                                         Anotar marcas
                                    </button>
                                </a>
                               
                                <!-- Ventana -->
                                <div class="modal fade" id="resultados<?php echo $evento->id_evento?>">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header azul">
                                        <p class="modal-title ms-3">Evento: <?php echo $evento->nombre?> </p> 
                                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body info ">                           
                                    <div class="container">

                                        <form action="<?php echo RUTA_URL?>/entrenador/anotar_eventos" method="post">
                                            <table class="table table-responsive" >
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
                                                            <input type="hidden" name="parti[]" value="<?php echo $resul->id_participante?>">
                                                            <td><input class="w-25" type="text" name="dorsal[]" value="<?php echo $resul->dorsal?>"></td>
                                                            <td><input type="time" step="0.001" name="marca[]" value="<?php echo $resul->marca?>"></td>
                                                            <input type="hidden" name="evento" value="<?php echo $evento->id_evento?>">
                                                        </tr>
                                                        <?php }
                                                    }                                                
                                                    ?>
                                                            
                                                </tbody>
                                            </table>

                                            

                                            <div class="mt-5 mb-4 me-4 d-flex justify-content-end">
                                                <input type="submit" class="btn " name="aceptar" id="confirmar" value="Confirmar"> 
                                            </div> 

                                        </form>

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








