<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


    <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center ">
                    <span id="textoHead">Gestion de Licencias</span>
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

                    <!--CABECERA TABLA-->
                    <thead>
                        <tr>
                            <th>USUARIO</th>
                            <th>CATEGORIA</th>
                            <th>REGIONAL/NACIONAL</th>
                            <th>IMÁGEN</th>
                   
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <!--BODY TABLA-->
                    <tbody>

                        <?php
                        foreach($datos['licencia'] as $licencia): ?>
                        <tr id="manita">

                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $licencia->id_licencia?>"><?php echo $licencia->nombre." ".$licencia->apellidos?></td>
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $licencia->id_licencia?>"><?php echo $licencia->nombre_categoria?></td>
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $licencia->id_licencia?>"><?php if ($licencia->regional_nacional==''){echo '-';}else {echo $licencia->regional_nacional;}?></td>

                            <td><?php if ($licencia->imagen_licen==''){echo '-';
                                 }else {?> 
                                    <a data-bs-toggle="modal" data-bs-target="#foto<?php echo $licencia->id_licencia?>">
                                        <img class="icono" src="<?php echo RUTA_Icon ?>foto.svg"></img>
                                    </a>
                                    <div class="modal" id="foto<?php echo $licencia->id_licencia?>">
                                    <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header azul">
                                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body info"> 
                                            <div>
                                                <img id="output" src="<?php echo RUTA_Licencia.$licencia->id_licencia.'.jpg'?>">
                                            </div> 
                                        </div>

                                    </div>
                                    </div>
                                    </div>
                                <?php } ?>
                            </td>
                                
                                               

                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                
                            
                            <td>

                            <!-- MODAL VER -->
                                <div class="modal fade" id="ver<?php echo $licencia->id_licencia?>">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header azul">
                                            <p class="modal-title ms-3">Info.Licencia</p> 
                                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>      

                                        <!-- Modal body -->
                                        <div class="modal-body info">                         

                                            <div class="container">

                                                        <div class="row mt-4"> 
                                                            <div class="input-group mb-4">
                                                                <label for="id_usuario" class="input-group-text">Usuario</label>
                                                                <input type="text" class="form-control form-control-md" id="id_usuario" name="id_usuario" value="<?php echo $licencia->nombre ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row"> 
                                                            <div class="input-group mb-4">
                                                                <label for="tipo" class="input-group-text">Categoria</label>
                                                                <input type="text" class="form-control form-control-md" name="tipo" id="tipo" value="<?php echo $licencia->nombre_categoria?>" readonly> 
                                                            </div>
                                                        </div>


                                                <?php 
                                            
                                                if ($licencia->id_categoria==4) {?>

                                                    <div class="row"> 
                                                        <div class="input-group mb-4">
                                                            <label for="dorsal" class="input-group-text">Dorsal</label>
                                                            <input type="text" class="form-control form-control-md" name="dorsal" id="dorsal" value="<?php echo $licencia->dorsal?>" readonly> 
                                                        </div>
                                                    </div>
                                                    <div class="row"> 
                                                        <div class="input-group mb-4">
                                                            <label for="num_licencia" class="input-group-text">N Licencia</label>
                                                            <input type="text" class="form-control form-control-md" name="num_licencia" id="num_licencia" value="<?php echo $licencia->num_licencia?>" readonly> 
                                                        </div>
                                                    </div>
                                                    <div class="row"> 
                                                        <div class="input-group mb-4">
                                                            <label for="fecha_cad" class="input-group-text">Fecha caducidad</label>
                                                            <input type="date" class="form-control form-control-md" name="fecha_cad" id="fecha_cad" value="<?php echo $licencia->fecha_cad?>" readonly> 
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4"> 
                                                        <div class="input-group mb-4">
                                                            <label for="aut_nac" class="input-group-text">Regional/Nacional</label>
                                                            <input type="text" class="form-control form-control-md" name="aut_nac" id="aut_nac" value="<?php 
                                                                if ($licencia->regional_nacional =='Regional'){
                                                                    echo 'Regional';
                                                                }elseif ($licencia->regional_nacional =='Nacional'){
                                                                    echo 'Nacional';
                                                                }else{ echo ''; }?>"readonly>
                                                        </div>
                                                    </div>


                                                <?php }elseif($licencia->id_categoria<4){ ?> 

                                                    <div class="row mb-4"> 
                                                        <div class="input-group">
                                                            <label for="dorsal" class="input-group-text">Dorsal</label>
                                                            <input type="text" class="form-control form-control-md" name="dorsal" id="dorsal" value="<?php echo $licencia->dorsal?>" readonly> 
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4"> 
                                                        <div class="input-group mb-4">
                                                            <label for="gir" class="input-group-text">GIR</label>
                                                            <input type="text" class="form-control form-control-md" id="gir" name="gir" value="<?php echo $licencia->gir?>" readonly>
                                                        </div>
                                                    </div>
                                                    

                                                <?php }?>

                                           

                                            </div>

                                        </div>
                                        
                                </div>
                                </div>
                                </div>



                                <!-- MODAL EDITAR -->
                                <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $licencia->id_licencia?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal fade" id="editar_<?php echo $licencia->id_licencia?>">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content" id="modalEditar">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Edicion de la licencia</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->

                                            <div class="modal-body info">    
                                            <form action="<?php echo RUTA_URL?>/adminLicencias/editar/<?php echo $licencia->id_licencia?>" ENCTYPE="multipart/form-data" method="post">                     

                                            <div class="container">

                                                        <div class="row mt-4"> 
                                                            <div class="input-group mb-4">
                                                                <label for="id_usuario" class="input-group-text">Usuario</label>
                                                                <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $licencia->nombre.' '.$licencia->apellidos?>" readonly>
                                                            </div>
                                                        </div>

                                                        <div id="categoria" class="row">
                                                            <div class="input-group mb-4">
                                                                <label for="categoria" class="input-group-text">Categoria</label>
                                                                <input type="text" class="form-control form-control-md" id="categoria" name="categoria"
                                                                 value="<?php echo $licencia->nombre_categoria?>" readonly>
                                                            </div>
                                                        </div>
                                                
                                                        <div class="row">  
                                                            <div class="input-group mb-4">
                                                                <label for="dorsal" class="input-group-text">Dorsal<sup>*</sup></label>
                                                                <input type="text" class="form-control form-control-md" name="dorsal" id="dorsal" value="<?php echo $licencia->dorsal?>" required> 
                                                            </div>
                                                        </div>


                                                    <!-- CAMPOS ADULTO-->
                                                    <div    <?php if ($licencia->id_categoria==4){
                                                            ?> style="display:block"<?php ;
                                                            }else {?> style="display:none"<?php } ?>                                                                                                                     
                                                        >
                                                        <div class="row"> 
                                                            <div class="input-group mb-4">
                                                                <label for="num_licencia" class="input-group-text">N Licencia</label>
                                                                <input type="text" class="form-control form-control-md" name="num_licencia" id="num_licencia" value="<?php echo $licencia->num_licencia?>"> 
                                                            </div>
                                                        </div>
                                                        <div class="row"> 
                                                            <div class="input-group mb-4">
                                                                <label for="fecha_cad" class="input-group-text">Fecha caducidad</label>
                                                                <input type="date" class="form-control form-control-md" name="fecha_cad" id="fecha_cad" value="<?php echo $licencia->fecha_cad?>"> 
                                                            </div>
                                                        </div>
                                                        <div class="row"> 
                                                            <div class="input-group mb-4">
                                                                <label for="aut_nac" class="input-group-text">Regional/Nacional</label>
                                                                <select name="aut_nac" id="aut_nac" class="form-select form-select-md">
                                                                    <option value="0" selected>-- Selecciona una opcion--</option>
                                                                    <option value="Regional">Regional</option>
                                                                    <option value="Nacional">Nacional</option>
                                                                </select> 
                                                               
                                                            </div>
                                                        </div>
                                                    
                                                    </div>

                                                    <!-- CAMPO ESCOLAR-->
                                                    <div    <?php if ($licencia->id_categoria<4){
                                                            ?> style="display:block"<?php ;
                                                            }else {?> style="display:none"<?php } ?>                                                                                                                     
                                                        >

                                                    <div class="row"> 
                                                        <div class="input-group mb-4">
                                                            <label for="gir" class="input-group-text">GIR</label>
                                                            <input type="text" class="form-control form-control-md" id="gir" name="gir" value="<?php echo $licencia->gir?>">
                                                        </div>
                                                    </div>

                                            </div>

                                                    <div id="foto" class="row">
                                                        <input  accept="image/*" type="file" id="" name="editarFoto" >
                                                    </div>

                                                    <input type="hidden" name="id_usuario" value="<?php echo $licencia->id_usuario?>">
                                                    <input type="hidden" name="foto_ant" value="<?php echo $licencia->imagen_licen?>">

                                                    <div class="row"> 
                                                        <div class="d-flex justify-content-end">
                                                            <input type="submit" class="btn mt-4 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                                                        </div>
                                                    </div>
                                        </div>
                                        
     
                                                </form>

                                            </div> 
                                            
                                        </div>
                                    </div>
                                    </div>



                                <!-- MODAL BORRAR -->
                                <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $licencia->id_licencia ?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                <div class="modal" id="borrar_<?php echo $licencia->id_licencia?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body mt-3">
                                                <p>Estas seguro que quieres <b>BORRAR</b> la licencia del usuario <b><?php echo $licencia->nombre.' '.$licencia->apellidos?></b>?</p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminLicencias/borrar/<?php echo $licencia->id_licencia?>" method="post">
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



        <!-- AÑADIR NUEVA LICENCIA-->
        <div class="col text-center mt-5">
            <a data-bs-toggle="modal" data-bs-target="#nuevo">
                <input type="button" id="anadir" class="btn" value="Nueva Licencia">
            </a>
            <a class="btn bg-warning ms-2" href="<?php echo RUTA_URL?>/adminLicencias/exportarLicencias" >Exportar a Excel</a>
        </div>



        <div class="modal fade" id="nuevo">
        <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                        <p class="modal-title ms-3">Alta de licencias</p> 
                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info">                         
                                                                                                                     
                                                    
                        <form action="<?php echo RUTA_URL?>/adminLicencias/nuevo" ENCTYPE="multipart/form-data" method="post">

                            <div class="container">

                                        <div class="row mt-4"> 
                                            <div class="input-group mb-4">
                                                <label for="usuario" class="input-group-text">Usuario<sup>*</sup></label>
                                                <select class="form-select" name="usuario" id="usuario" required>
                                                    <option value="">-- Selecciona un usuario --</option>
                                                    <?php foreach ($datos['lice_socio'] as $usu) : ?>
                                                    <option value="<?php echo $usu->id_usuario ?>"> <?php echo $usu->nombre.' '.$usu->apellidos?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="categoria" class="row">
                                            <div class="input-group mb-4">
                                                <label for="categoria" class="input-group-text">Categoria<sup>*</sup></label>
                                                <select class="form-select" name="categoria" id="tipo_select" onchange="opcion()" required>
                                                    <option value="">-- Selecciona una categoria --</option>
                                                    <?php foreach ($datos['categorias'] as $cat) : ?>
                                                    <option value="<?php echo $cat->id_categoria?>"> <?php echo $cat->nombre_categoria?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                  
                        
                                      <!-- INPUTS ESCOLAR-->     

                                 
                                        <div id="gDorsal" class="row" style="display:none">
                                            <div class="input-group mb-4">
                                                <label for="dorsal" class="input-group-text">Dorsal<sup>*</sup></label>
                                                <input type="text" class="form-control form-control-md" id="dorsal" name="dorsal">
                                            </div>
                                        </div>
                                        <div id="gGir" class="row" style="display:none">                     
                                            <div class="input-group mb-4">
                                                <label for="gir" class="input-group-text">GIR</label>
                                                <input type="text" class="form-control form-control-md" id="gir" name="gir">
                                            </div> 
                                        </div>

                                        

                                    <!-- MOSTRAR INPUTS ADULTO-->     

                                            <div id="gLice" class="row" style="display:none">                     
                                                <div class="input-group mb-4">
                                                    <label for="num_lic" class="input-group-text">N Licencia</label>
                                                    <input type="text" class="form-control form-control-md" id="num_lic" name="num_lic">
                                                </div> 
                                            </div> 


                                            <div id="gFecha" class="row" style="display:none">                     
                                                <div class="input-group mb-4">
                                                    <label for="fecha" class="input-group-text">Fecha caducidad</label>
                                                    <input type="date" class="form-control form-control-md" id="fecha" name="fecha">
                                                </div> 
                                            </div> 

                                            <div id="gAut" class="row" style="display:none">
                                                <div class="input-group mb-4 ">
                                                    <label for="aut_nac" class="input-group-text">Regional/Nacional</label>
                                                    <select name="aut_nac" id="aut_nac" class="form-select form-select-md">
                                                        <option value="" selected>-- Selecciona una opcion--</option>
                                                        <option value="Regional">Regional</option>
                                                        <option value="Nacional">Nacional</option>
                                                    </select> 
                                                </div>
                                            </div>


                                            <div id="foto" class="row">
                                                <input  accept="image/*" type="file" id="" name="subirFoto" >
                                            </div>
                                    

                                    </div>

                                    <div class="row"> 
                                        <div class="d-flex justify-content-end">
                                            <input type="submit" class="btn mt-4 mb-3" name="aceptar" id="confirmar" value="Confirmar"> 
                                        </div>
                                    </div>
          
                            </div>
                        </form>

                </div>
                 

        </div>
        </div>
        </div>



                  
      
</article>





<script>

        var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src)
        }
    };



     function opcion() {
        var opcion=document.getElementById("tipo_select").value;
        console.log(opcion);
        if(opcion<4){
            document.getElementById("gGir").style.display ="block";
            document.getElementById("gDorsal").style.display ="block";
            document.getElementById("gLice").style.display ="none";
            document.getElementById("gFecha").style.display ="none";
            document.getElementById("gAut").style.display ="none";
        }else {
            document.getElementById("gGir").style.display ="none";
            document.getElementById("gDorsal").style.display ="block";
            document.getElementById("gLice").style.display ="block";
            document.getElementById("gFecha").style.display ="block";
            document.getElementById("gAut").style.display ="block";
        }
    }




</script>




















<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>





