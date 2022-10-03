<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


        <header>
        <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center"><span id="textoHead">Gestion de entrenadores</span></div>
                <div class="col-2 mt-2">
                        <a type="button" id="botonLogout" class="btn"  href="<?php echo RUTA_URL ?>/login/logout">
                                <span>Logout</span>
                                <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
                        </a>
                </div>
        </div>                                   
        </header>



<article>

        <table id="tabla" class="table">


                <!--CABECERA TABLA-->
                <thead>
                        <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>APELLIDOS</th>
                                <th>TELEFONO</th>
                                <th>EMAIL</th>
                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                        <th>OPCIONES</th>
                                <?php endif ?>
                        </tr>
                </thead>


                <tbody>

                        <?php foreach ($datos['usuAdmin'] as $usuarios) : ?>
                        <tr>
                        <td><?php echo $usuarios->id_usuario ?></td>
                        <td><?php echo $usuarios->nombre ?></td>
                        <td><?php echo $usuarios->apellidos ?></td>
                        <td><?php echo $usuarios->telefono ?></td>
                        <td><?php echo $usuarios->email ?></td>

                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                        <td class="datos_tabla">


                        <!-- MODAL VER-->                 
                        <a data-bs-toggle="modal" data-bs-target="#ver<?php echo $usuarios->id_usuario?>">
                        <img class="icono" src="<?php echo RUTA_Icon ?>ojo.svg"></img>
                        </a>
                  

                                <div class="modal" id="ver<?php echo $usuarios->id_usuario?>">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header ">
                                                <p class="modal-title">Ficha usuario Nº: <?php echo  $usuarios->id_usuario?> </p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body info mb-3">                         
                                        <div class="row ms-1 me-1"> 

                                                <div class="row">
                                                        <div class="col-5">
                                                                <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                        <label for="nombre" class="input-group-text datInfo">Nombre <sup>*</sup></label>
                                                                        <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $usuarios->nombre?>"readonly>    
                                                                </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="apellidos" class="input-group-text datInfo">Apellidos <sup>*</sup></label>
                                                                <input type="text" class="form-control form-control-md" id="apellidos" name="apellidos" value="<?php echo $usuarios->apellidos?>"readonly>
                                                        </div>
                                                        </div>
                                                </div>  

                                                <div class="row">
                                                        <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="dniAtl" class="input-group-text datInfo" id="dniObli">DNI </label>
                                                                <input type="text" class="form-control form-control-md" id="dniAtl" value="<?php echo $usuarios->dni?>"readonly name="dniAtl">  
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="fecha" class="input-group-text datInfo">Fecha Nacimiento <sup>*</sup></label>
                                                                <input type="date" class="form-control form-control-md" id="fecha" name="fecha" value="<?php echo $usuarios->fecha_nacimiento?>"readonly>
                                                        </div>
                                                        </div>
                                                </div> 

                                                <div class="row">
                                                        <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="telf" class="input-group-text datInfo">Telefono <sup>*</sup></label>
                                                                <input type="text" class="form-control form-control-md" id="telf" name="telf" value="<?php echo $usuarios->telefono?>"readonly>
                                                        </div>
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="email" class="input-group-text datInfo">Correo <sup>*</sup></label>
                                                                <input type="text" class="form-control form-control-md" id="email" name="email" value="<?php echo $usuarios->email?>"readonly>
                                                        </div>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-12">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="direccion" class="input-group-text datInfo">Direccion <sup>*</sup></label>
                                                                <input type="text" class="form-control form-control-md" id="direccion" name="direccion" value="<?php echo $usuarios->direccion?>"readonly>
                                                        </div> 
                                                        </div> 
                                                </div>

                                                <div class="row">
                                                        <div class="col-6">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="verCCC" class="input-group-text datInfo"><span class="info">Numero cuenta:</span></label>
                                                                <input type="text" class="form-control form-control-md" name="verCCC" id="verCCC" value="<?php echo $usuarios->CCC?>" readonly > 
                                                        </div> 
                                                        </div> 

                                                        <div class="col-3">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="verTalla" class="input-group-text datInfo"><span class="info">Talla:</span></label>
                                                                <input type="text" class="form-control form-control-md" name="verTalla" id="verTalla" value="<?php echo $usuarios->talla?>" readonly> 
                                                        </div>
                                                        </div>

                                                </div>
                                        </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer mb-5">

                                        </div>
                
                                </div>
                                </div>
                                </div>



                                <!-- MODAL EDITAR-->
                                <a data-bs-toggle="modal" data-bs-target="#editar<?php echo $usuarios->id_usuario?>">
                                <img class="icono" src="<?php echo RUTA_Icon ?>editar.svg"></img>
                                </a>

                                <div class="modal" id="editar<?php echo $usuarios->id_usuario?>">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header ">
                                                <p class="modal-title">Edicion usuario Nº: <?php echo  $usuarios->id_usuario?> </p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body info mb-3">                         
                                        <div class="row ms-1 me-1"> 

                                        <form method="post" action="<?php echo RUTA_URL ?>/admin/editarEnt/<?php echo $usuarios->id_usuario?>">
                                                        <div class="row">
                                                                <div class="col-5">
                                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                <label for="nombre" class="input-group-text datInfo">Nombre <sup>*</sup></label>
                                                                                <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $usuarios->nombre?>" required>    
                                                                        </div> 
                                                                </div>

                                                                <div class="col-7">
                                                                <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                        <label for="apellidos" class="input-group-text datInfo">Apellidos <sup>*</sup></label>
                                                                        <input type="text" class="form-control form-control-md" id="apellidos" name="apellidos" value="<?php echo $usuarios->apellidos?>" required>
                                                                </div>
                                                                </div>
                                                        </div>  

                                                        <div class="row">
                                                                <div class="col-5">
                                                                <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                        <label for="dniAtl" class="input-group-text datInfo" id="dniObli">DNI </label>
                                                                        <input type="text" class="form-control form-control-md" id="dniAtl" value="<?php echo $usuarios->dni?>" name="dniAtl" required>  
                                                                </div> 
                                                                </div>

                                                                <div class="col-7">
                                                                <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                        <label for="fecha" class="input-group-text datInfo">Fecha Nacimiento <sup>*</sup></label>
                                                                        <input type="date" class="form-control form-control-md" id="fecha" name="fecha" value="<?php echo $usuarios->fecha_nacimiento?>" required>
                                                                </div>
                                                                </div>
                                                        </div> 

                                                        <div class="row">
                                                                <div class="col-5">
                                                                <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                        <label for="telf" class="input-group-text datInfo">Telefono <sup>*</sup></label>
                                                                        <input type="text" class="form-control form-control-md" id="telf" name="telf" value="<?php echo $usuarios->telefono?>" required>
                                                                </div>
                                                                </div>

                                                                <div class="col-7">
                                                                <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                        <label for="email" class="input-group-text datInfo">Email <sup>*</sup></label>
                                                                        <input type="text" class="form-control form-control-md" id="email" name="email" value="<?php echo $usuarios->email?>" required>
                                                                </div>
                                                                </div>
                                                        </div>

                                                        <div class="row">
                                                                <div class="col-12">
                                                                <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                        <label for="direccion" class="input-group-text datInfo">Direccion <sup>*</sup></label>
                                                                        <input type="text" class="form-control form-control-md" id="direccion" name="direccion" value="<?php echo $usuarios->direccion?>" required>
                                                                </div> 
                                                                </div> 
                                                        </div>

                                                        <div class="row">
                                                                <div class="col-6">
                                                                <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                        <label for="verCCC" class="input-group-text datInfo"><span class="info">Numero cuenta:</span></label>
                                                                        <input type="text" class="form-control form-control-md" name="verCCC" id="verCCC" value="<?php echo $usuarios->CCC?>"> 
                                                                </div> 
                                                                </div> 

                                                                <div class="col-3">
                                                                <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                        <label for="verTalla" class="input-group-text datInfo"><span class="info">Talla:</span></label>
                                                                        <input type="text" class="form-control form-control-md" name="verTalla" id="verTalla" value="<?php echo $usuarios->talla?>"> 
                                                                </div>
                                                                </div>

                                                        </div>

                                                </div>
                                                </div>
                                        
                                                <!-- Modal footer -->
                                                <div class="modal-footer mb-3 me-4">                            
                                                <input type="submit" class="btn" name="aceptar" id="confirmar" value="Confirmar">  
                                                </form>                                    
                                                </div>

                                        </div>
                                        </div>
                                        </div>



                                        <!-- MODAL BORRAR -->                                                                            
                                        <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $usuarios->id_usuario ?>">
                                                <img class="icono" src="<?php echo RUTA_Icon ?>papelera.svg"></img>
                                        </a>

                                        <!-- VENTANA -->
                                        <div class="modal" id="ModalBorrar_<?php echo $usuarios->id_usuario ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                <p>Vas a <b>BORRAR</b> al usuario <b> <?php echo $usuarios->nombre." ". $usuarios->apellidos?></b></p>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL ?>/admin/borrarEnt/<?php echo $usuarios->id_usuario?>" method="post">                                                                                                                                        
                                                <input type="submit" class="btn" name="borrar" id="confirmar" value="Borrar">   
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


        <!-- AÑADIR NUEVO ADMIN-->
        <div class="col text-center mt-5">
        <a data-bs-toggle="modal" data-bs-target="#nuevo">
        <input type="button" style="background-color: #023ef9; color:white" class="btn" value="AÑADIR NUEVO">
        </a>
        </div>

        <div class="modal" id="nuevo">
        <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header ">
                        <p class="modal-title">Alta de entrenadores</p> 
                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info">                         
                <div class="row ms-1 me-1">                                                                                                           
                                                    
                        <form action="<?php echo RUTA_URL?>/admin/nuevoEnt" method="post">
                                <div class="row">
                                        <div class="col-5">
                                                <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                        <label for="nombre" class="input-group-text datInfo">Nombre <sup>*</sup></label>
                                                        <input type="text" class="form-control form-control-md" placeholder="Escriba el nombre" id="nombre" name="nombre" required onkeypress="return Solo_Texto(event);">    
                                                </div> 
                                        </div>

                                        <div class="col-7">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="apellidos" class="input-group-text datInfo">Apellidos <sup>*</sup></label>
                                                <input type="text" class="form-control form-control-md" placeholder="Escriba los apellidos" id="apellidos" name="apellidos" required onkeypress="return Solo_Texto(event);">
                                        </div>
                                        </div>
                                </div>  

                                <div class="row">
                                        <div class="col-5">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="dniAtl" class="input-group-text datInfo" id="dniObli">DNI </label>
                                                <input type="text" class="form-control form-control-md" id="dniAtl" placeholder="Escriba el DNI" name="dniAtl" required>  
                                        </div> 
                                        </div>

                                        <div class="col-7">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="fecha" class="input-group-text datInfo">Fecha Nacimiento <sup>*</sup></label>
                                                <input type="date" class="form-control form-control-md" id="fecha" name="fecha" onchange="mayorEdad()" required>
                                        </div>
                                        </div>
                                </div> 

                                <div class="row">
                                        <div class="col-5">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="telf" class="input-group-text datInfo">Telefono <sup>*</sup></label>
                                                <input type="text" class="form-control form-control-md" placeholder="Escriba el telefono" id="telf" name="telf" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                                        </div>
                                        </div>

                                        <div class="col-7">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="email" class="input-group-text datInfo">Correo <sup>*</sup></label>
                                                <input type="text" class="form-control form-control-md" placeholder="Escriba el correo" id="email" name="email" onblur="return correo(this.id)" required>
                                        </div>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-12">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="direccion" class="input-group-text datInfo">Direccion <sup>*</sup></label>
                                                <input type="text" class="form-control form-control-md" placeholder="Escriba la direccion" id="direccion" name="direccion" required>
                                        </div> 
                                        </div> 
                                </div>

                                <div class="row">
                                        <div class="col-6">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="verCCC" class="input-group-text datInfo"><span class="info">Numero cuenta:</span></label>
                                                <input type="text" class="form-control form-control-md" name="verCCC" id="verCCC" placeholder="Escriba el numero de cuenta" > 
                                        </div> 
                                        </div> 

                                        <div class="col-3">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                <label for="verTalla" class="input-group-text datInfo"><span class="info">Talla:</span></label>
                                                <input type="text" class="form-control form-control-md" name="verTalla" id="verTalla" placeholder="Escriba la talla" > 
                                        </div>
                                        </div>

                                </div>

                                
                                <div class="row">
                                <div class="col-12 mb-3 mt-3">
                                        <label id="error"></label>
                                        <label id="errorMail"></label>
                                </div>
                                </div>
                                                      
                </div>
                </div>


                <!-- Modal footer -->
                <div class="modal-footer mb-3 me-4">     
                        <input type="submit" class="btn" name="aceptar" id="confirmar" value="Confirmar">  
                        </form>                                    
                </div>

        </div>
        </div>
        </div>

</article>





<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>

<script src="<?php echo RUTA_URL ?>/public/js/validar.js"></script>
<script>
    function Solo_Texto(e) {
        var code;
        if (!e) var e = window.event;
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        var character = String.fromCharCode(code);
        var AllowRegex = /^[\ba-zA-Z\s-]$/;
        if (AllowRegex.test(character)) return true;
        return false;
    }
</script>
