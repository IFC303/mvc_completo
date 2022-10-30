<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


        <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Gestion de gastos</span>
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
                            <th>Nº GASTO</th>
                            <th>FECHA</th>
                            <th>TIPO</th>
                            <th>IMPORTE</th>
                            <th>CONCEPTO</th>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                     <!--BODY TABLA-->
                    <tbody>

                        <?php

                        foreach($datos['gastos'] as $info):   
                           ?>
                        <tr>

                            <td><?php echo $info->id_gastos?></td>
                            <td><?php echo $info->fecha?></td>
                            <td><?php echo $info->tipo?></td>
                            <td><?php echo $info->importe?></td>
                            <td><?php echo $info->observaciones?></td>
                            

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <td>


                                <!-- MODAL VER-->                 
                                <a data-bs-toggle="modal" data-bs-target="#ver<?php echo $info->id_gastos?>">
                                <img class="icono" src="<?php echo RUTA_Icon ?>ojo.svg"></img>
                                </a>

                                <div class="modal" id="ver<?php echo $info->id_gastos?>">
                                <div class="modal-dialog modal-dialog-centered">
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
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <label for="fecha" class="input-group-text">Fecha</label>
                                                        <input type="date" class="form-control form-control-md" name="fecha" value="<?php echo $info->fecha?>"readonly>    
                                                    </div> 
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <label for="importe" class="input-group-text">Importe</label>
                                                        <input type="text" class="form-control form-control-md" name="importe" value="<?php echo $info->importe?>"readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="input-group">
                                                    <label for="tipo" class="input-group-text">Tipo</label>
                                                    <input type="text" class="form-control form-control-md" name="tipo" value="<?php echo $info->tipo?>"readonly>
                                                </div>
                                            </div>


                                            <div class="row mb-4">
                                                    <div class="input-group">
                                                        <label for="imputar" class="input-group-text">Asociado a</label>
                                                        <input type="text" class="form-control form-control-md" name="imputar" value="<?php echo $info->inputado?>"readonly>
                                                    </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-group mb-4">
                                                    <textarea  type="text" style="height:150px" class="form-control" id="observaciones" name="dobservaciones" value="<?php echo $info->observaciones?>"readonly><?php echo $info->observaciones?></textarea>
                                                </div>
                                            </div>  

                                        </div>
                                        </div>
                
                                </div>
                                </div>
                                </div>    


                                     <!-- EDITAR GASTO-->
                                     <a data-bs-toggle="modal" data-bs-target="#editar<?php echo $info->id_gastos?>">
                                        <img class="icono" src="<?php echo RUTA_Icon ?>editar.svg"></img>
                                    </a>


                                    <div class="modal" id="editar<?php echo $info->id_gastos?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">


                                        <!-- Modal Header -->
                                        <div class="modal-header azul">
                                            <p class="modal-title ms-3">Edicion</p> 
                                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>


                                            <!-- Modal body -->
                                            <div class="modal-body info">                         
                                            <div class="row ms-1 me-1">                                                                                                           
                                                                                
                                                    <form action="<?php echo RUTA_URL?>/adminFacturacion/editar_gasto/<?php echo $info->id_gastos?>" method="post">

                                                        <div class="row mt-4 mb-4">
                                                            <div class="col-6">
                                                                <div class="input-group">
                                                                    <label for="fecha" class="input-group-text">Fecha</label>
                                                                    <input type="date" class="form-control form-control-md" name="fecha" value="<?php echo $info->fecha?>">    
                                                                </div> 
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="input-group">
                                                                    <label for="importe" class="input-group-text">Importe</label>
                                                                    <input type="text" class="form-control form-control-md" name="importe" value="<?php echo $info->importe?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="input-group">
                                                                <label for="tipo" class="input-group-text">Tipo</label>
                                                                <input type="text" class="form-control form-control-md" name="tipo" value="<?php echo $info->tipo?>">
                                                            </div>
                                                        </div>


                                                        <div class="row mb-4">
                                                        <div class="input-group">
                                                            <label for="usuario" class="input-group-text">Asociar gasto a</label>
                                                            <select class="form-control" name="imputar">
                                                                <option value="">-- Selecciona una opcion--</option>
                                                                <optgroup label="Usuario">
                                                                    <?php foreach ($datos['usuarios'] as $usu) : ?>
                                                                    <option value="u<?php echo $usu->id_usuario?>"> <?php echo $usu->nombre.' '.$usu->apellidos?></option>
                                                                    <?php endforeach ?>
                                                                </optgroup>
                                                                <optgroup label="Entidad">
                                                                    <?php foreach ($datos['entidades'] as $enti) : ?>
                                                                    <option value="e<?php echo $enti->id_entidad?>"> <?php echo $enti->nombre?></option>
                                                                    <?php endforeach ?>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                        </div> 

                                                        <div class="row">
                                                            <div class="input-group mb-4">
                                                                <textarea  type="text" style="height:150px" class="form-control" id="observaciones" name="observaciones" value="<?php echo $info->observaciones?>"><?php echo $info->observaciones?></textarea>
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


                                 <!-- MODAL BORRAR -->
                                 <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $info->id_gastos?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="borrar_<?php echo $info->id_gastos?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body mt-3">
                                            <p>Estas seguro que quieres <b>BORRAR</b> el gasto correspondiente a  <b><?php echo $info->tipo?></b> ? </p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminFacturacion/borrar_gasto/<?php echo $info->id_gastos?>" method="post">
                                                    <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
                                                </form>
                                            </div>

                                    </div>
                                    </div>
                                    </div>

                                   


                            </td>
                            <?php endif ?>
                        </tr>
                    
                        <?php
                     
                        endforeach ?>


                </tbody>
            </table>


            <!-- AÑADIR NUEVO GASTO-->
        <div class="col text-center mt-5">
            <a data-bs-toggle="modal" data-bs-target="#nuevo">
                <input type="button" id="anadir" class="btn" value="Nuevo Gasto">
            </a>
        </div>


        <div class="modal" id="nuevo">
        <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                    <p class="modal-title ms-3">Alta de gastos</p> 
                    <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>


                <!-- Modal body -->
                <div class="modal-body info">                         
                <div class="row ms-1 me-1">                                                                                                           
                                                    
                        <form action="<?php echo RUTA_URL?>/adminFacturacion/nuevo_gasto" method="post">

                            <div class="row mt-4 mb-4">
                                <div class="col-6">
                                    <div class="input-group">
                                        <label for="fecha" class="input-group-text">Fecha</label>
                                        <input type="date" class="form-control form-control-md" name="fecha">    
                                    </div> 
                                </div>
                                <div class="col-6">
                                    <div class="input-group">
                                        <label for="importe" class="input-group-text">Importe</label>
                                        <input type="text" class="form-control form-control-md" name="importe">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="input-group">
                                    <label for="tipo" class="input-group-text">Tipo</label>
                                    <input type="text" class="form-control form-control-md" name="tipo">
                                </div>
                            </div>


                            <div class="row mb-4">
                            <div class="input-group">
                                <label for="usuario" class="input-group-text">Asociar gasto a</label>
                                <select class="form-control" name="imputar">
                                    <option value="">-- Selecciona una opcion--</option>
                                    <optgroup label="Usuario">
                                        <?php foreach ($datos['usuarios'] as $usu) : ?>
                                        <option value="u<?php echo $usu->id_usuario?>"> <?php echo $usu->nombre.' '.$usu->apellidos?></option>
                                        <?php endforeach ?>
                                    </optgroup>
                                    <optgroup label="Entidad">
                                        <?php foreach ($datos['entidades'] as $enti) : ?>
                                        <option value="e<?php echo $enti->id_entidad?>"> <?php echo $enti->nombre?></option>
                                        <?php endforeach ?>
                                    </optgroup>
                                </select>
                            </div>
                            </div> 

                            <div class="row">
                                <div class="input-group mb-4">
                                    <textarea  type="text" style="height:150px" class="form-control" id="observaciones" name="observaciones" placeholder="Concepto"></textarea>
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


