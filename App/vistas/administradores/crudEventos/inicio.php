<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


        <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Gestion de eventos</span>
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
                            <th>NOMBRE</th>
                            <th>TIPO</th>
                            <th>FECHA INICIO</th>
                            <th>FECHA FIN</th>
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                     <!--BODY TABLA-->
                    <tbody>

                        <?php
                        foreach($datos['evento'] as $evento): ?>
                        <tr>

                            <td><?php echo $evento->nombre?></td>
                            <td><?php echo $evento->tipo?></td>
                            <td><?php echo $evento->fecha_ini?></td>
                            <td><?php echo $evento->fecha_fin?></td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <td>

                                <!-- MODAL VER-->                 
                                <a data-bs-toggle="modal" data-bs-target="#ver<?php echo $evento->id_evento?>">
                                <img class="icono" src="<?php echo RUTA_Icon ?>ojo.svg"></img>
                                </a>

                                <div class="modal" id="ver<?php echo $evento->id_evento?>">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">


                                        <!-- Modal Header -->
                                        <div class="modal-header azul">
                                            <p class="modal-title ms-3">Informacion</p> 
                                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>


                                         <!-- Modal body -->
                                        <div class="modal-body info mb-4">                         
                                        <div class="container mt-4">

                                            <div class="row mb-4">
                                                <div class="col-5">
                                                    <div class="input-group">
                                                        <label for="nombre" class="input-group-text">Nombre</label>
                                                        <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $evento->nombre?>"readonly>    
                                                    </div> 
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-group">
                                                        <label for="tipo" class="input-group-text">Tipo</label>
                                                        <input type="text" class="form-control form-control-md" id="tipo" name="tipo" value="<?php echo $evento->tipo?>"readonly>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="input-group">
                                                        <label for="precio" class="input-group-text">Precio</label>
                                                        <input type="text" class="form-control form-control-md" id="precio" name="precio" value="<?php echo $evento->precio?>"readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <label for="fecha_ini" class="input-group-text">Fecha inicio evento</label>
                                                        <input type="text" class="form-control form-control-md" id="fecha_ini" name="fecha_ini" value="<?php echo $evento->fecha_ini?>"readonly>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <label for="fecha_fin" class="input-group-text">Fecha fin evento</label>
                                                        <input type="text" class="form-control form-control-md" id="fecha_fin" name="fecha_fin" value="<?php echo $evento->fecha_fin?>"readonly>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <label for="fecha_ini_inscrip" class="input-group-text">Fecha inicio inscripcion</label>
                                                        <input type="text" class="form-control form-control-md" id="fecha_ini_inscrip" name="fecha_ini_inscrip" value="<?php echo $evento->fecha_ini_inscrip?>"readonly>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <label for="fecha_fin_inscrip" class="input-group-text">Fecha fin inscripcion</label>
                                                        <input type="text" class="form-control form-control-md" id="fecha_fin_inscrip" name="fecha_fin_inscrip" value="<?php echo $evento->fecha_fin_inscrip?>"readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-group mb-4">
                                                    <textarea  type="text" style="height:150px" class="form-control" id="descripcion" name="descripcion" value="<?php echo $evento->descripcion?>"readonly><?php echo $evento->descripcion?></textarea>
                                                </div>
                                            </div>  

                                        </div>
                                        </div>
                
                                </div>
                                </div>
                                </div>


                                <!-- MODAL EDITAR -->
                                <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $evento->id_evento?>">
                                <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="editar_<?php echo $evento->id_evento ?>">
                                    <div class="modal-dialog  modal-dialog-centered modal-xl">
                                    <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">Edicion</p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body info ">                         
                                            <div class="row ms-1 me-1"> 

                                            <form method="post" action="<?php echo RUTA_URL?>/adminEventos/editar/<?php echo $evento->id_evento?>">
                                                  
                                                <div class="row mt-4 mb-4">
                                                    <div class="col-5">
                                                        <div class="input-group ">
                                                            <label for="nombre" class="input-group-text">Nombre<sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $evento->nombre?>" required>    
                                                        </div> 
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-group ">
                                                            <label for="tipo" class="input-group-text">Tipo<sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="tipo" name="tipo" value="<?php echo $evento->tipo?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="input-group">
                                                            <label for="precio" class="input-group-text">Precio <sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="precio" name="precio" value="<?php echo $evento->precio?>" required>
                                                        </div>
                                                    </div>

                                                </div> 

                                                <div class="row mb-4">
                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <label for="fecha_ini" class="input-group-text">Fecha inicio evento <sup>*</sup></label>
                                                            <input type="date" class="form-control form-control-md" id="fecha_ini" name="fecha_ini" value="<?php echo $evento->fecha_ini?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <label for="fecha_fin" class="input-group-text">Fecha fin evento<sup>*</sup></label>
                                                            <input type="date" class="form-control form-control-md" id="fecha_fin" name="fecha_fin" value="<?php echo $evento->fecha_fin?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <label for="fecha_ini_inscrip" class="input-group-text">Fecha inicio inscripcion<sup>*</sup></label>
                                                            <input type="date" class="form-control form-control-md" id="fecha_ini_inscrip" name="fecha_ini_inscrip" value="<?php echo $evento->fecha_ini_inscrip?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <label for="fecha_fin_inscrip" class="input-group-text">Fecha fin inscripcion<sup>*</sup></label>
                                                            <input type="date" class="form-control form-control-md" id="fecha_fin_inscrip" name="fecha_fin_inscrip" value="<?php echo $evento->fecha_fin_inscrip?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                          
                                                <div class="row mb-4">
                                                    <div class="input-group">
                                                        <textarea  type="text" style="height:150px" class="form-control" id="descripcion" name="descripcion" value="<?php echo $evento->descripcion?>" ><?php echo $evento->descripcion?></textarea>
                                                    </div>
                                                </div>

                                                <div class=" d-flex justify-content-end">
                                                    <input type="submit" class="btn mt-4 mb-4 " name="aceptar" id="confirmar" value="Confirmar">        
                                                </div> 
                  

                                            </form>

                                            </div>
                                            </div>

                                    </div>
                                    </div>
                                    </div>


                                <!-- MODAL BORRAR -->
                                <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $evento->id_evento?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="borrar_<?php echo $evento->id_evento?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body mt-3">
                                            <p>Estas seguro que quieres <b>BORRAR</b> el evento <b><?php echo $evento->nombre?></b> ? </p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminEventos/borrar/<?php echo $evento->id_evento?>" method="post">
                                                    <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
                                                </form>
                                            </div>

                                    </div>
                                    </div>
                                    </div>

                     

                                <!-- PARTICIPANTES -->
                                <a href="<?php echo RUTA_URL?>/adminEventos/participantes/<?php echo $evento->id_evento?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>grupos.svg"></img>
                                </a> 


                        </td>
                            <?php endif ?>
                        </tr>
                        <?php endforeach ?>
                    </tbody>

        </table>




        <!-- AÑADIR NUEVA EVENTO-->
        <div class="col text-center mt-5">
            <a data-bs-toggle="modal" data-bs-target="#nuevo">
                <input type="button" id="anadir" class="btn" value="Nuevo Evento">
            </a>
        </div>


        <div class="modal" id="nuevo">
        <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                        <p class="modal-title ms-3">Alta de eventos</p> 
                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info">                         
                <div class="row ms-1 me-1">                                                                                                           
                                                    
                        <form action="<?php echo RUTA_URL?>/adminEventos/nuevo" method="post">

                                <div class="row mt-4 mb-4">
                                    <div class="col-5">
                                        <div class="input-group">
                                            <label for="nombre" class="input-group-text">Nombre <sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md" id="nombre" name="nombre" required>    
                                        </div> 
                                    </div>

                                    <div class="col-4">
                                        <div class="input-group">
                                            <label for="tipo" class="input-group-text">Tipo<sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md" id="tipo" name="tipo" required >
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <label for="precio" class="input-group-text">Precio <sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md" id="precio" name="precio" required>
                                        </div>
                                    </div>
                                </div>  

           
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="fecha_ini" class="input-group-text">Fecha inicio evento <sup>*</sup></label>
                                            <input type="date" class="form-control form-control-md" id="fecha_ini" name="fecha_ini" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="fecha_fin" class="input-group-text">Fecha fin evento<sup>*</sup></label>
                                            <input type="date" class="form-control form-control-md" id="fecha_fin" name="fecha_fin" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="fecha_ini_inscrip" class="input-group-text">Fecha inicio inscripcion<sup>*</sup></label>
                                            <input type="date" class="form-control form-control-md" id="fecha_ini_inscrip" name="fecha_ini_inscrip" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="fecha_fin_inscrip" class="input-group-text">Fecha fin inscripcion<sup>*</sup></label>
                                            <input type="date" class="form-control form-control-md" id="fecha_fin_inscrip" name="fecha_fin_inscrip" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="input-group">
                                        <textarea  type="text" style="height:150px" placeholder="Descripcion" class="form-control" id="descripcion" name="descripcion"></textarea>
                                    </div>
                                </div>


                                <div class="d-flex justify-content-end">
                                    <input type="submit" class="btn mt-4 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                               </div> 

                        </form>

                    </div>
                    </div>

        </div>
        </div>
        </div>


    </article>





<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>






