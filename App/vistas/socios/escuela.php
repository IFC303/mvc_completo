<?php require_once RUTA_APP . '/vistas/inc/nav.php' ?>



        <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Grupos disponibles</span>
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
                <thead>
                    <tr>
                        <th>GRUPO</th>
                        <th>FECHA INICIO</th> 
                        <th>CUOTA</th>
                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[3])):?>
                                <th>OPCIONES</th>
                        <?php endif ?>                                                   
                    </tr>
                </thead> 
                 <tbody>               
                    <?php foreach ($datos['grupos'] as $grupos) :?>
                        <tr id="manita">
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $grupos->id_grupo?>"><?php echo $grupos->nombre?></td>
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $grupos->id_grupo?>"><?php echo $grupos->fecha_ini?></td>
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $grupos->id_grupo?>"><?php echo $grupos->cuota?></td>
                         

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[3])):?>

                                <td>

                                  <!-- MODAL VER-->
                                <!-- Ventana -->
                                <div class="modal" id="ver<?php echo $grupos->id_grupo?>">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header azul">
                                        <p class="modal-title ms-3">Grupo: <?php echo $grupos->id_grupo?></p> 
                                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body info mb-3">                           
                                    <div class="container">

                                            <div class="row mt-4 mb-4">
                                                <div class="input-group">
                                                    <label for="nombre" class="input-group-text">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $grupos->nombre?> " readonly> 
                                                </div>
                                            </div>

                                            <div class="row mt-4 mb-4">   
                                                <div class="input-group ">
                                                    <label class="input-group-text">Cuota</label>
                                                    <input type="text" class="form-control" value="<?php echo $grupos->cuota?>"  readonly> 
                                                </div>                     
                                            </div>

                                            <div class="row mt-4 mb-4">  
                                                <div class="col-6">
                                                <div class="input-group ">
                                                    <label class="input-group-text">Inicio</label>
                                                    <input type="date" class="form-control" value="<?php echo $grupos->fecha_ini?>"  readonly> 
                                                </div> 
                                                </div>                     
                                            
                                                <div class="col-6">  
                                                <div class="input-group ">
                                                    <label class="input-group-text">Fin</label>
                                                    <input type="date" class="form-control" value="<?php echo $grupos->fecha_fin?>"  readonly> 
                                                </div>  
                                                </div>                   
                                            </div>

                                            <div class="row mb-4">                         
                                                <div class="input-group">
                                                    <textarea  type="text" style="height:150px" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" readonly><?php echo $evento->descripcion?></textarea>
                                                </div>                           
                                            </div> 
                                        
                                            <!-- Modal footer -->
                                            <div class="row"> 
                                                <div class="d-flex justify-content-end">
                                                    <form action="<?php echo RUTA_URL?>/socio/ins_evento/<?php echo $evento->id_evento?>" method="post">
                                                        <input type="submit" class="btn" name="aceptar" id="confirmar" value="Inscribirse">
                                                    </form>
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
        


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>