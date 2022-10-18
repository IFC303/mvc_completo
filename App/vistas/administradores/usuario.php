<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>



 <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Gestion de usuarios</span>
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
                            <th>ID</th>
                            <th>ROL</th>
                            <th>NOMBRE</th>
                            <th>APELLIDOS</th>
                            <th>TELEFONO</th>
                            <th>EMAIL</th>
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <!--BODY TABLA-->
                    <tbody>

                    <?php
                    foreach($datos['usuarios'] as $usuario): ?>
                    <tr>

                        <td><?php echo $usuario->id_usuario?></td>
                        <td>
                            <?php if ($usuario->id_rol =="1"){
                                    echo "Administrador";
                                }elseif($usuario->id_rol =="2"){
                                    echo "Entrenador";
                                }else{
                                    echo "Socio";
                                }
                            ?>
                        </td>
                        <td><?php echo $usuario->nombre?></td>
                        <td><?php echo $usuario->apellidos?></td>
                        <td><?php echo $usuario->telefono?></td>
                        <td><?php echo $usuario->email?></td>

                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            
                        <td>


                            <!-- MODAL VER-->                 
                            <a data-bs-toggle="modal" data-bs-target="#ver<?php echo $usuario->id_usuario?>">
                                <img class="icono" src="<?php echo RUTA_Icon ?>ojo.svg"></img>
                            </a>

                                <div class="modal" id="ver<?php echo $usuario->id_usuario?>">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">Informacion</p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>      

                                            <!-- Modal body -->
                                            <div class="modal-body info mb-3"> 

                                                <div class="container">

                                                    <div class="row mt-4">

                                                        <div class="col-4">
                                                            <div><img id="output" 
                                                                <?php if ($usuario->foto==''){
                                                                ?> src='<?php echo RUTA_Icon?>usuario.svg'<?php ;
                                                                }else {?> src='<?php echo RUTA_ImgDatos.$usuario->id_usuario.'.jpg';} ?>' width="300" height="320" readonly>
                                                            </div>                                    
                                                        </div>

                                                        <div class="col-8">
                                                            <div class="row mt-2">                         
                                                                <div class="input-group mb-4">
                                                                    <label for="nombre" class="input-group-text">Nombre</label>
                                                                    <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $usuario->nombre?>"readonly>    
                                                                </div>                           
                                                            </div> 
                                                            <div class="row">                     
                                                                <div class="input-group mb-4">
                                                                    <label for="apellidos" class="input-group-text">Apellidos</label>
                                                                    <input type="text" class="form-control form-control-md" id="apellidos" name="apellidos" value="<?php echo $usuario->apellidos?>"readonly>
                                                                </div>            
                                                            </div>  
                                                            <div class="row">
                                                                <div class="input-group mb-4">
                                                                    <label for="direccion" class="input-group-text">Direccion</label>
                                                                    <input type="text" class="form-control form-control-md" id="direccion" name="direccion" value="<?php echo $usuario->direccion?>"readonly>
                                                                </div> 
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-5">
                                                                    <div class="input-group mb-4">
                                                                        <label for="telefono" class="input-group-text">Telefono</label>
                                                                        <input type="text" class="form-control form-control-md" id="telefono" name="telefono" value="<?php echo $usuario->telefono?>"readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-7">
                                                                    <div class="input-group mb-4">
                                                                        <label for="email" class="input-group-text">Email</label>
                                                                        <input type="text" class="form-control form-control-md" id="email" name="email" value="<?php echo $usuario->email?>"readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-5">
                                                                    <div class="input-group mb-4">
                                                                        <label for="dni" class="input-group-text" id="dniObli">DNI</label>
                                                                        <input type="text" class="form-control form-control-md" id="dni" name="dni" value="<?php echo $usuario->dni?>"readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-7">
                                                                    <div class="input-group mb-4">
                                                                        <label for="fecha_naci" class="input-group-text">Fecha Nacimiento</label>
                                                                        <input type="date" class="form-control form-control-md" id="fecha_naci" name="fecha_naci" value="<?php echo $usuario->fecha_nacimiento?>"readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row ms-2 mt-4">                            
                                                        <div class="col-7">
                                                            <div class="input-group mb-4">
                                                                <label for="ccc" class="input-group-text">Numero cuenta</label>
                                                                <input type="text" class="form-control form-control-md" name="ccc" id="ccc" value="<?php echo $usuario->CCC?>"readonly> 
                                                            </div> 
                                                        </div> 

                                                        <div class="col-5">
                                                            <div class="input-group mb-4">
                                                                <label for="talla" class="input-group-text">Talla</label>
                                                                <input type="text" class="form-control form-control-md" name="talla" id="talla" value="<?php echo $usuario->talla?>"readonly> 
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row ms-2 mt-2"> 
                                                        <div class="col-6">
                                                            <div class="input-group mb-5">
                                                                <label for="rol" class="input-group-text">Rol</label>
                                                                <input type="text" class="form-control form-control-md" name="rol" id="rol" value="<?php 
                                                                    if ($usuario->id_rol =='1'){
                                                                        echo 'Administrador';
                                                                    }elseif($usuario->id_rol =='2'){
                                                                        echo 'Entrenador';
                                                                    }else{
                                                                        echo 'Socio';
                                                                    }?>"readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="input-group mb-5">
                                                                <label for="rol" class="input-group-text">Ha sido socio alguna vez</label>
                                                                <input type="text" class="form-control form-control-md" name="rol" id="rol" value="<?php 
                                                                    if ($usuario->ha_sido =='1'){
                                                                        echo 'Si';
                                                                    }else{
                                                                        echo 'No';
                                                                    }?>"readonly>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- MOSTRAR INPUTS SOCIOS-->  
                                                        <?php 
                                                            if($usuario->id_rol=="3"){?> 

                                                                <div class="row ms-2"> 
                                                                    <div class="d-flex text-left"><p style="font-weight:bold;color:#0070c6;text-decoration:underline">Informacion del padre o tutor</p></div>  
                                                                </div>

                                                                <div class="row ms-2 mt-2">                     
                                                                    <div class="col-5">
                                                                        <div class="input-group mb-4">
                                                                            <label for="nomPa" class="input-group-text">Nombre</label>
                                                                            <input type="text" class="form-control form-control-md" id="nomPa" name="nomPa" value="<?php echo $usuario->nom_pa?>" readonly>
                                                                        </div> 
                                                                    </div> 

                                                                    <div class="col-7">
                                                                        <div class="input-group mb-4">
                                                                            <label for="apelPa" class="input-group-text">Apellidos</label>
                                                                            <input type="text" class="form-control form-control-md" id="apePa" name="apePa" value="<?php echo $usuario->ape_pa?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row ms-2 mt-2 mb-4">                     
                                                                    <div class="col-5">
                                                                        <div class="input-group mb-4">
                                                                            <label for="dniPa" id="dniPa" class="input-group-text">DNI</label>
                                                                            <input type="text" class="form-control form-control-md" id="dniPa" name="dniPa" value="<?php echo $usuario->dni_pa?>" readonly>
                                                                        </div> 
                                                                    </div> 
                                                                </div>
                                                                
                                                           <?php }             
                                                        ?>
                                                </div>   
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            <!-- MODAL EDITAR-->            
                            
                            <a data-bs-toggle="modal" data-bs-target="#editar<?php echo $usuario->id_usuario?>">
                                <img class="icono" src="<?php echo RUTA_Icon ?>editar.svg"></img>
                            </a>

                                <div class="modal" id="editar<?php echo $usuario->id_usuario?>">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">Edicion</p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>  
                            
                                            <!-- Modal body -->
                                            <div class="modal-body info mb-3">  
                                                <form action="<?php echo RUTA_URL?>/adminUsuarios/editar_usuario/<?php echo $usuario->id_usuario?>" method="post">

                                                    <div class="container">

                                                        <div class="row mt-4">

                                                            <div class="col-4">
                                                                <div><img id="output" 
                                                                    <?php if ($usuario->foto==''){
                                                                        ?> src='<?php echo RUTA_Icon?>usuario.svg'<?php ;
                                                                        }else {?> src='<?php echo RUTA_ImgDatos.$usuario->id_usuario.'.jpg';} ?>' width="300" height="320">
                                                                </div>                             
                                                            </div>

                                                            <div class="col-8">

                                                                <div class="row mt-2">                         
                                                                    <div class="input-group mb-4">
                                                                        <label for="nombre" class="input-group-text">Nombre<sup>*</sup></label>
                                                                        <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $usuario->nombre?>" required>    
                                                                    </div>                           
                                                                </div> 

                                                                <div class="row">                     
                                                                    <div class="input-group mb-4">
                                                                        <label for="apellidos" class="input-group-text">Apellidos<sup>*</sup></label>
                                                                        <input type="text" class="form-control form-control-md" id="apellidos" name="apellidos" value="<?php echo $usuario->apellidos?>" required>
                                                                    </div>            
                                                                </div>  
                                                        
                                                                <div class="row">
                                                                    <div class="input-group mb-4">
                                                                        <label for="direccion" class="input-group-text">Direccion</label>
                                                                        <input type="text" class="form-control form-control-md" id="direccion" name="direccion" value="<?php echo $usuario->direccion?>">
                                                                    </div>  
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-5">
                                                                        <div class="input-group mb-4">
                                                                            <label for="telefono" class="input-group-text">Telefono <sup>*</sup></label>
                                                                            <input type="text" class="form-control form-control-md" id="telefono" name="telefono" value="<?php echo $usuario->telefono?>" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-7">
                                                                        <div class="input-group mb-4">
                                                                            <label for="email" class="input-group-text">Email <sup>*</sup></label>
                                                                            <input type="text" class="form-control form-control-md" id="email" name="email" value="<?php echo $usuario->email?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row ">
                                                                    <div class="col-5">
                                                                        <div class="input-group mb-4">
                                                                            <label for="dni" class="input-group-text">Dni</label>
                                                                            <input type="text" class="form-control form-control-md" id="dni" name="dni" value="<?php echo $usuario->dni?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-7">
                                                                        <div class="input-group mb-4">
                                                                            <label for="fecha_naci" class="input-group-text">Fecha Nacimiento <sup>*</sup></label>
                                                                            <input type="date" class="form-control form-control-md" id="fecha_naci" name="fecha_naci" value="<?php echo $usuario->fecha_nacimiento?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row ms-2 mt-4">                            
                                                            <div class="col-8">
                                                                <div class="input-group mb-4">
                                                                    <label for="ccc" class="input-group-text">Numero cuenta</label>
                                                                    <input type="text" class="form-control form-control-md" name="ccc" id="ccc" value="<?php echo $usuario->CCC?>" > 
                                                                </div> 
                                                            </div> 

                                                            <div class="col-4">
                                                                <div class="input-group mb-4">
                                                                    <label for="talla" class="input-group-text">Talla</label>
                                                                    <input type="text" class="form-control form-control-md" name="talla" id="talla" value="<?php echo $usuario->talla?>" > 
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row ms-2"> 
                                                            <div class="col-6">
                                                                <div class="input-group mb-4">
                                                                    <label for="rol" class="input-group-text">Rol*</label>
                                                                    <select class="form-control" name="rol" id="tipo_select<?php echo $usuario->id_usuario?>" onchange="opciones(<?php echo $usuario->id_usuario?>)" required>
                                                                            <option value="">-- Selecciona un rol --</option>
                                                                            <?php foreach ($datos['roles'] as $rol) : ?>
                                                                            <option value="<?php echo $rol->id_rol?>" <?php if($rol->id_rol==$usuario->id_rol) echo "selected";?>> <?php echo $rol->nombre ?></option>
                                                                            <?php endforeach ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="input-group mb-4">
                                                                    <label for="" class="me-3">¿Has sido socio alguna vez? <sup>*</sup></label> <br>
                                                                    <input type="radio" class="me-2" id="siSocio" name="pri_socio" value="1" <?php if($usuario->ha_sido=="1") echo "checked";?> required><label for="siSocio">&nbspSI</label><span style="margin-left: 20px;"></span>
                                                                    <input type="radio" class="me-2" id="noSocio" name="pri_socio" value="0" <?php if($usuario->ha_sido=="0") echo "checked";?> required><label for="noSocio">&nbspNO</label> 
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- MOSTRAR INPUTS SOCIOS-->     

                                                        <div id="campos<?php echo $usuario->id_usuario?>" 
                                                            <?php if ($usuario->id_rol=='3'){
                                                            ?> style="display:block"<?php ;
                                                            }else {?> style="display:none"<?php } ?>                                                                                                                     
                                                        >

                                                                <div class="row mt-4 ms-2"> 
                                                                    <div class="d-flex text-left"><p style="font-weight:bold;color:#0070c6;text-decoration:underline">Informacion del padre o tutor (rellenar solo si es menor de edad)</p></div>  
                                                                </div>
                                                                
                                                                <div class="row ms-2 mt-2">                     
                                                                    <div class="col-5">
                                                                        <div class="input-group mb-4">
                                                                            <label for="nomPa" class="input-group-text">Nombre</label>
                                                                            <input type="text" class="form-control form-control-md" id="nomPa" name="nomPa" value="<?php echo $usuario->nom_pa?>">
                                                                        </div> 
                                                                    </div> 

                                                                    <div class="col-7">
                                                                        <div class="input-group mb-4">
                                                                            <label for="apelPa" class="input-group-text">Apellidos</label>
                                                                            <input type="text" class="form-control form-control-md" id="apePa" name="apePa" value="<?php echo $usuario->ape_pa?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row ms-2">                     
                                                                    <div class="col-5">
                                                                        <div class="input-group">
                                                                            <label for="dniPa" id="dniPa" class="input-group-text">DNI</label>
                                                                            <input type="text" class="form-control form-control-md" id="dniPa" name="dniPa" value="<?php echo $usuario->dni_pa?>">
                                                                        </div> 
                                                                    </div> 
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



                            <!-- MODAL BORRAR -->
                            <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $usuario->id_usuario?>">
                                <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                            </a>

                                <div class="modal" id="borrar_<?php echo $usuario->id_usuario?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body mt-3">
                                                <p>Estas seguro que quieres <b>BORRAR</b> al usuario <b><?php echo $usuario->nombre.' '. $usuario->apellidos?></b> ? </p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminUsuarios/borrarUsuario/<?php echo $usuario->id_usuario?>" method="post">
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


        <!-- AÑADIR NUEVO USUARIO -->
        <div class="col text-center mt-5">
            <a data-bs-toggle="modal" data-bs-target="#nuevo">
                <input type="button" id="anadir" class="btn" value="Nuevo Usuario">
            </a>
        </div>

            <div class="modal" id="nuevo">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header azul">
                            <p class="modal-title ms-3">Alta de usuarios</p> 
                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body info">                                                                                                                                 
                                                            
                            <form action="<?php echo RUTA_URL?>/adminUsuarios/nuevo_usuario" method="post">

                                <div class="container">

                                    <div class="row mt-4">

                                        <div class="col-4">
                                            <div>
                                                <img id="output" src='<?php echo RUTA_Icon?>usuario.svg' width="300" height="320">
                                            </div>                                    
                                        </div>

                                        <div class="col-8">
                                            <div class="row mt-2">                         
                                                <div class="input-group mb-4">
                                                    <label for="nombre" class="input-group-text">Nombre <sup>*</sup></label>
                                                    <input type="text" class="form-control form-control-md" id="nombre" name="nombre" required onkeypress="return Solo_Texto(event);">    
                                                </div>                           
                                            </div> 
                                            <div class="row">                     
                                                <div class="input-group mb-4">
                                                    <label for="apellidos" class="input-group-text">Apellidos <sup>*</sup></label>
                                                    <input type="text" class="form-control form-control-md" id="apellidos" name="apellidos" required onkeypress="return Solo_Texto(event);">
                                                </div>            
                                            </div>  
                                    
                                            <div class="row">
                                                <div class="input-group mb-4">
                                                    <label for="direccion" class="input-group-text">Direccion</label>
                                                    <input type="text" class="form-control form-control-md" id="direccion" name="direccion">
                                                </div> 
                                            </div>

                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="input-group mb-4">
                                                        <label for="telefono" class="input-group-text">Telefono <sup>*</sup></label>
                                                        <input type="text" class="form-control form-control-md" id="telefono" name="telefono" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="input-group mb-4">
                                                        <label for="email" class="input-group-text">Email <sup>*</sup></label>
                                                        <input type="text" class="form-control form-control-md" id="email" name="email" onblur="return correo(this.id)" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="input-group mb-4">
                                                        <label for="dni" class="input-group-text" id="dniObli">DNI</label>
                                                        <input type="text" class="form-control form-control-md" id="dni" name="dni">
                                                    </div>
                                                </div>

                                                <div class="col-7">
                                                    <div class="input-group mb-4">
                                                        <label for="fecha_naci" class="input-group-text">Fecha Nacimiento<sup>*</sup></label>
                                                        <input type="date" class="form-control form-control-md" id="fecha_naci" name="fecha_naci" onchange="mayorEdad()" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row ms-2">                            
                                        <div class="col-8">
                                            <div class="input-group mb-4">
                                                <label for="ccc" class="input-group-text">Numero cuenta</label>
                                                <input type="text" class="form-control form-control-md" name="ccc" id="ccc"> 
                                            </div> 
                                        </div> 

                                        <div class="col-4">
                                            <div class="input-group mb-4">
                                                <label for="talla" class="input-group-text">Talla</label>
                                                <input type="text" class="form-control form-control-md" name="talla" id="talla"> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row ms-2"> 
                                        <div class="col-5">
                                            <div class="input-group mb-4">
                                                <label for="rol" class="input-group-text">Rol<sup>*</sup></label>
                                                <select class="form-control" name="rol" id="tipo_select" onchange="opcion()" required>
                                                    <option value="">-- Selecciona un rol --</option>
                                                    <?php foreach ($datos['roles'] as $rol) : ?>
                                                    <option value="<?php echo $rol->id_rol?>"> <?php echo $rol->nombre ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="input-group mb-4">
                                                <label for="" class="me-3">¿Has sido socio alguna vez? <sup>*</sup></label> <br>
                                                <input type="radio" class="me-2" id="siSocio" name="pri_socio" value="1" required><label for="siSocio">&nbspSI</label><span style="margin-left: 20px;"></span>
                                                <input type="radio" class="me-2" id="noSocio" name="pri_socio" value="0" required><label for="noSocio">&nbspNO</label> 
                                            </div>
                                        </div>
                                    </div>


                                    <!-- MOSTRAR INPUTS SOCIOS-->     

                                    <div id="campos" style="display:none">

                                        <div class="row mt-4 ms-2"> 
                                            <div class="d-flex text-left"><p style="font-weight:bold;color:#0070c6;text-decoration:underline">Informacion del padre o tutor (rellenar solo si es menor de edad)</p></div>  
                                        </div>

                                        <div class="row ms-2 mt-2">                     
                                            <div class="col-5">
                                                <div class="input-group mb-4">
                                                    <label for="nomPa" class="input-group-text">Nombre</label>
                                                    <input type="text" class="form-control form-control-md" id="nomPa" name="nomPa">
                                                </div> 
                                            </div> 

                                            <div class="col-7">
                                                <div class="input-group mb-4">
                                                    <label for="apelPa" class="input-group-text">Apellidos</label>
                                                    <input type="text" class="form-control form-control-md" id="apePa" name="apePa">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row ms-2 mt-2 ">                     
                                            <div class="col-5">
                                                <div class="input-group mb-4">
                                                    <label for="dniPa" id="dniPa" class="input-group-text">DNI</label>
                                                    <input type="text" class="form-control form-control-md" id="dniPa" name="dniPa">
                                                </div> 
                                            </div> 
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


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>

<script>

  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
  };



   function opciones(id) {
     var seleccion="tipo_select"+id;
     var opcion=document.getElementById(seleccion).value;

      if(opcion=="3"){
        document.getElementById("campos"+id).style.display ="block";
      }else if ((opcion=="2") || (opcion=="1")) {
        document.getElementById("campos"+id).style.display ="none";
     }
    }


     function opcion() {
        var opcion=document.getElementById("tipo_select").value;
        if(opcion=="3"){
            document.getElementById("campos").style.display ="block";
        }else {
            document.getElementById("campos").style.display ="none";
        }
    }


</script>



