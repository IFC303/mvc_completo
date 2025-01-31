<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


       <!------------------------------ CABECERA -------------------------------->
       <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center ">
                    <span id="textoHead">Gestion de equipaciones</span>
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

    <table id="tabla" class="table w-50">


         <!--CABECERA TABLA-->
         <thead>
            <tr>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>TEMPORADA</th>
                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                    <th>OPCIONES</th>
                <?php endif ?>
            </tr>
        </thead>

        <!--BODY TABLA-->
        <tbody>

            <?php
            foreach($datos['equipacion'] as $equipacion): ?>
            <tr id="manita">
                <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $equipacion->id_equipacion?>"
                    style="text-align:left" data-bs-toggle="modal" data-bs-target="#ver_ficha<?php echo $alumnos->id_usuario?>">
                    <img  style="width: 70px;"
                    <?php if ($equipacion->imagen==''){
                        ?> src='<?php echo RUTA_Icon?>noFoto.jpg'<?php ;
                        }else {?> src='<?php  echo RUTA_Equipacion.$equipacion->id_equipacion.'.jpg';} ?>'
                    >
                </td>
                <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $equipacion->id_equipacion?>"><?php echo $equipacion->tipo?></td>
                <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $equipacion->id_equipacion?>"><?php echo $equipacion->precio?>€</td>
                <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $equipacion->id_equipacion?>"><?php echo $datos['temp_actual']->nombre?></td>
                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                    
                <td>

                        <!-- MODAL VER-->                 
                        <div class="modal fade" id="ver<?php echo $equipacion->id_equipacion?>">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header azul">
                                    <p class="modal-title ms-3">Informacion</p> 
                                    <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                </div>

                                    <!-- Modal body -->
                                <div class="modal-body info mb-3">                                                            
                                    <div class="row mt-2">
                                        <div><img id="outputVer" width="400px" height="300px" 
                                        <?php if ($equipacion->imagen==''){?> src='<?php echo RUTA_Equipacion?>noFoto.jpg'<?php ;
                                                }else {?> src='<?php echo RUTA_Equipacion.$equipacion->id_equipacion.'.jpg';} ?>'                                                                                             
                                        >
                                        </div>                                    
                                    </div>
                                    <div class="row mt-3">                  
                                        <div class="input-group">
                                            <label for="nombre" class="input-group-text">Nombre</label>
                                            <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $equipacion->tipo?>" readonly> 
                                        </div>  
                                    </div>   
                                    <div class="row mt-3">                         
                                        <div class="col-5">                 
                                            <div class="input-group">
                                                <label for="precio" class="input-group-text">Precio</label>
                                                <input type="text" class="form-control form-control-md" id="precio" name="precio" value="<?php echo $equipacion->precio?> €" readonly>
                                            </div>
                                        </div> 
                                        <div class="col-7">                 
                                            <div class="input-group">
                                                <label for="precio" class="input-group-text">Temporada</label>
                                                <input type="text" class="form-control form-control-md" id="precio" name="precio" value="<?php echo $datos['temp_actual']->nombre?>" readonly>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="row mt-3 mb-4">                         
                                        <div class="input-group">
                                            <textarea  type="text" style="height:150px" class="form-control" id="descripcion" name="descripcion" readonly><?php echo $equipacion->descripcion?></textarea>
                                        </div>                           
                                    </div> 
                                </div>
                        </div>
                        </div>
                        </div>


                                <!-- MODAL EDITAR -->
                                <a data-bs-toggle="modal" data-bs-target="#editar<?php echo $equipacion->id_equipacion?>">
                                    <img class="icono" src="<?php echo RUTA_Icon ?>editar.svg"></img>
                                </a>

                                <div class="modal fade" id="editar<?php echo $equipacion->id_equipacion?>">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">Edicion</p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div> 

                                            <!-- Modal body -->
                                            <div class="modal-body info">                                                                                                                                                         
                                            <form action="<?php echo RUTA_URL?>/adminEquipaciones/editarEquipacion/<?php echo $equipacion->id_equipacion?>" enctype="multipart/form-data" method="post">  
                                            <div class="container">

                                                <div class="row">  
                                                    <img id="outputEdit<?php echo $equipacion->id_equipacion?>" width="350px" height="350px" 
                                                    <?php if ($equipacion->imagen==''){?> src='<?php echo RUTA_Equipacion?>noFoto.jpg'<?php ;
                                                            }else {?> src='<?php echo RUTA_Equipacion.$equipacion->id_equipacion.'.jpg';} ?>' 
                                                    >                                 
                                                    <div class="mt-3 mb-4">
                                                        <input  accept="image/*" type="file"  onchange="loadFile(event,<?php echo $equipacion->id_equipacion?>)" id="editarFoto" name="editarFoto" value ="<?php echo $equipacion->imagen?>">
                                                    </div>
                                                </div>

                                                <div class="row mt-2 mb-4">                         
                                                    <div class="input-group">
                                                        <label for="nombre" class="input-group-text">Nombre<sup>*</sup></label>
                                                        <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $equipacion->tipo?>" required> 
                                                    </div>                           
                                                </div> 

                                                <div class="row mb-4"> 
                                                    <div class="col-5">                 
                                                        <div class="input-group">
                                                            <label for="precio" class="input-group-text">Precio<sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="precio" name="precio" value="<?php echo $equipacion->precio?>" required>
                                                        </div>
                                                    </div> 
                                                    <div class="col-7">                     
                                                        <div class="input-group">
                                                            <label for="temporada" class="input-group-text">Temporada</label>
                                                        <input type="text" class="form-control form-control-md" id="temporada" name="temporada" value="<?php echo $datos['temp_actual']->nombre?>" readonly>  
                                                        </div>            
                                                    </div>
                                                </div> 

                                                <div class="row mb-4">                         
                                                    <div class="input-group">
                                                        <textarea  type="text" style="height:150px" class="form-control" id="descripcion" name="descripcion"><?php echo $equipacion->descripcion?></textarea>
                                                    </div>                           
                                                </div> 

                                                <div class="row mb-4"> 
                                                    <div class="d-flex justify-content-end">
                                                        <input type="hidden" name="foto_ant" value="<?php echo $equipacion->imagen?>">
                                                        <input type="submit" class="btn" name="aceptar" id="confirmar" value="Confirmar"> 
                                                    </div>
                                                </div>

                                            </div>
                                            </form>
                                            </div>

                                </div>
                                </div>
                                </div>



                                <!-- MODAL BORRAR -->
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $equipacion->id_equipacion?>">
                                    <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                <div class="modal" id="ModalBorrar_<?php echo $equipacion->id_equipacion?>">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body mt-3">
                                    <p>Estas seguro que quieres <b>BORRAR</b> la equipacion <b><?php echo $equipacion->tipo?></b> ? </p>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <form action="<?php echo RUTA_URL?>/adminEquipaciones/borrarEquipacion/<?php echo $equipacion->id_equipacion?>" method="post">
                                            <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
                                        </form>
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




                    <!--AÑADIR EQUIPACION-->
                    <div class="col text-center mt-5">
                        <a data-bs-toggle="modal" data-bs-target="#nuevo">
                            <input type="button" id="anadir" class="btn" value="Nueva Equipacion">
                        </a>
                    </div>

                    <div class="modal fade" id="nuevo">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header azul">
                            <p class="modal-title ms-3">Nueva equipacion</p> 
                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                        </div>

                          <!-- Modal body -->
                        <div class="modal-body info ">                                                                                                                                                       
                        <form action="<?php echo RUTA_URL?>/adminEquipaciones/nuevaEquipacion"  enctype="multipart/form-data" method="post">  
                        <div class="container">

                                    <div class="row mt-3 text-center">
                                        <img id="output" src='<?php echo RUTA_Equipacion?>noFoto.jpg' width="300" height="300" style="border:solid 1px #E8EAEA">                                   
                                        <div class="mt-4">
                                            <input  accept="image/*" type="file"  onchange="loadFile(event)" id="subirFoto" name="subirFoto">
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-4">                         
                                        <div class="input-group mb-4">
                                            <label for="nombre" class="input-group-text">Nombre<sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md" id="nombre" name="nombre" required> 
                                        </div>                           
                                    </div> 

                                    <div class="row mb-4"> 
                                        <div class="col-5">                 
                                            <div class="input-group">
                                                <label for="precio" class="input-group-text">Precio<sup>*</sup></label>
                                                <input type="text" class="form-control form-control-md" id="precio" name="precio" required>
                                            </div>
                                        </div> 
                                        <div class="col-7">                     
                                            <div class="input-group">
                                                <label for="temporada" class="input-group-text">Temporada</label>
                                            <input type="text" class="form-control form-control-md" id="temporada" name="temporada" value="<?php echo $datos['temp_actual']->nombre?>" readonly>  
                                            </div>            
                                        </div>
                                    </div> 
                                    
                                    <div class="row">                         
                                        <div class="input-group">
                                            <textarea  type="text" style="height:150px" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion"></textarea>
                                        </div>                           
                                    </div> 
                                 
                                    <div class="row"> 
                                        <div class="d-flex justify-content-end">
                                            <input type="submit" class="btn mt-3 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                                        </div>
                                    </div>

                         </div>   
                        </form>
                        </div>

                </div>
                </div>
                </div>




</article>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>


<script>

        var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src)
        }
        };

        var loadFile2 = function(event,id) {
        var output = document.getElementById('outputEdit'+id);
        console.log(output);
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src)
        }
        };

</script>







