<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


    <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Solicitudes socios</span>
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
                <th>FECHA SOLICITUD</th>
                <th>NOMBRE</th>
                <th>APELLIDOS</th>
                <th>EMAIL</th>
                <th>TELEFONO</th>
                <th>HA SIDO SOCIO</th>
                <th>ACCIONES</th>
                </tr>
           </thead>


                <!--BODY TABLA-->
                <tbody>
                <?php foreach ($datos['soliSocio'] as $usuarios) : ?>
                <tr>
                        <td><?php echo $usuarios->id_solicitud_soc ?></td>
                        <td><?php echo $usuarios->fecha_soli ?></td>
                        <td><?php echo $usuarios->nombre ?></td>
                        <td><?php echo $usuarios->apellidos ?></td>
                        <td><?php echo $usuarios->email ?></td>
                        <td><?php echo $usuarios->telefono ?></td>
                        <td><?php if ($usuarios->ha_sido == 1) {
                                                        echo "SI";
                                                } else{
                                                        echo "NO";
                                                } ?></td>


                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                        <td>




                                <!-- MODAL EDITAR -->
                                <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $usuarios->id_solicitud_soc?>" >
                                <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="editar_<?php echo $usuarios->id_solicitud_soc?>">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">SOLICITUD Nº: <?php echo $usuarios->id_solicitud_soc?></p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>
                                      
                                            <!-- Body -->
                                            <div class="modal-body info ">                         
                                            <div class="row ms-1 me-1"> 
                                            <p class="mt-4 mb-3 titulito">Datos del atleta</p>  

                                            <form method="post" action="<?php echo RUTA_URL?>/adminSolicitudes/editar_socio/<?php echo $usuarios->id_solicitud_soc?>">

                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                        <label for="fecha" class="input-group-text">Fecha solicitud</label>
                                                        <input type="date" class="form-control form-control-md" name="fecha" value="<?php echo $usuarios->fecha_soli?>" readonly > 
                                                        </div> </div>
                                                </div>
                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="nombre" class="input-group-text">Nombre</label>
                                                                <input type="text" class="form-control form-control-md" name="nombre" value="<?php echo $usuarios->nombre?>" >    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="apellidos" class="input-group-text">Apellidos</label> 
                                                                <input type="text" class="form-control form-control-md"  name="apellidos" value="<?php echo $usuarios->apellidos?>" >        
                                                        </div>
                                                        </div>
                                                </div> 
                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="dni" class="input-group-text">DNI</label>
                                                                <input type="text" class="form-control form-control-md"  name="dni" value="<?php echo $usuarios->DNI?>" >    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="fecha_naci" class="input-group-text">Fecha Nacimiento</label>
                                                                <input type="date" class="form-control form-control-md" name="fecha_naci" value="<?php echo $usuarios->fecha_nacimiento?>" > 
                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="tlf" class="input-group-text">Telefono</label>
                                                                <input type="text" class="form-control form-control-md" name="tlf" value="<?php echo $usuarios->telefono?>" > 
                                                        </div>
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="email" class="input-group-text">Email</label> 
                                                                <input type="text" class="form-control form-control-md" name="email"  value="<?php echo $usuarios->email?>" > 
                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="row mb-3">
                                                        <div class="input-group">
                                                        <label for="direccion" class="input-group-text">Direccion</label>
                                                        <input type="text" class="form-control form-control-md" name="direccion" value="<?php echo $usuarios->direccion?>" > 
                                                        </div> 
                                                </div>
                                                <div class="row mb-4">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="cuenta" class="input-group-text">Numero cuenta</label>
                                                                <input type="text" class="form-control form-control-md" name="cuenta" value="<?php echo $usuarios->CCC?>" > 
                                                        </div> 
                                                        </div> 

                                                        <div class="col-4">
                                                        <div class="input-group">
                                                                <label for="talla" class="input-group-text">Talla</label>
                                                                <select name="talla" id="talla" class="form-control" required>
                                                                <option value="">-- Selecciona una talla --</option>
                                                                <?php foreach ($datos['tallas'] as $tallas) : ?>
                                                                <option value="<?php echo $tallas->id_talla?>" <?php if($tallas->id_talla==$usuarios->talla) echo "selected";?>> <?php echo $tallas->nombre ?></option>
                                                                <?php endforeach ?>
                                                                </select>
                                                        </div>
                                                        </div>

                                                        <div class="col-3">
                                                                <div class="input-group mb-4">
                                                                    <label for="" class="me-3">¿Has sido socio alguna vez? <sup>*</sup></label> <br>
                                                                    <input type="radio" class="me-2" id="siSocio" name="pri_socio" value="1" <?php if($usuarios->ha_sido=="1"){echo "checked";} ;?> required ><label for="siSocio">&nbspSI</label><span style="margin-left: 20px;"></span>
                                                                    <input type="radio" class="me-2" id="noSocio" name="pri_socio" value="0" <?php if($usuarios->ha_sido=="0"){echo "checked";} ;?> ><label for="noSocio">&nbspNO</label> 
                                                                </div>
                                                        </div>
                                                </div>

                                                <p class="mt-3 mb-3 titulito">Datos padre / tutor <span >(solo si es menor)</span></p> 

                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="nom_pa" class="input-group-text">Nombre</label>
                                                                <input type="text" class="form-control form-control-md"  name="nom_pa" id="nom_pa" value="<?php echo $usuarios->nom_pa?>" >    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="ape_pa" class="input-group-text">Apellidos</label> 
                                                                <input type="text" class="form-control form-control-md"  name="ape_pa" id="ape_pa" value="<?php echo $usuarios->ape_pa?>" >        
                                                        </div>
                                                        </div>
                                                </div>  


                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="dni_pa" class="input-group-text">DNI</label>
                                                                <input type="text" class="form-control form-control-md" id="dni_pa" name="dni_pa" value="<?php echo $usuarios->dni_pa?>">    
                                                        </div> 
                                                        </div>
                                                </div>

                                                <div class=" d-flex justify-content-end">
                                                    <input type="submit" class="btn mt-3 mb-4 " name="aceptar" id="confirmar" value="Guardar cambios">        
                                                </div> 
                  

                                            </form>

                                            </div>
                                            </div>

                                    </div>
                                    </div>
                                    </div>


                                <!--MODAL BORRAR-->
                                <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $usuarios->id_solicitud_soc ?>">
                                        <img class="icono" src="<?php echo RUTA_Icon ?>x1.png"></img>
                                </a>

                                <div class="modal" id="borrar_<?php echo $usuarios->id_solicitud_soc ?>">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                                <p>Estas seguro que quieres <b>BORRAR</b> la solicitud para socio de <b> <?php echo $usuarios->nombre . " " . $usuarios->apellidos ?> ? </b></p>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL ?>/adminSolicitudes/borrar_socio/<?php echo $usuarios->id_solicitud_soc ?>" method="post">
                                                <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
                                                </form>
                                        </div>

                                </div>
                                </div>
                                </div>



                                <!--MODAL CONFIRMAR-->                                                   
                                <a data-bs-toggle="modal" data-bs-target="#confirmar_<?php echo $usuarios->id_solicitud_soc ?>">
                                        <img class="icono" src="<?php echo RUTA_Icon ?>tick.png"></img>
                                </a>

                                <div class="modal" id="confirmar_<?php echo $usuarios->id_solicitud_soc ?>">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header azul">
                                                <p class="modal-title">SOLICITUD Nº: <?php echo $usuarios->id_solicitud_soc?></p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body info">                         
                                        <div class="row ms-1 me-1">                                              
                                                       
                                        <p class="mt-3 mb-3 titulito">Datos del atleta</p>                                                     
                                                    
                                        <form action="<?php echo RUTA_URL ?>/adminSolicitudes/aceptar_socio/<?php echo $usuarios->id_solicitud_soc?>" method="post">
                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                        <label for="fecha" class="input-group-text">Fecha solicitud</label>
                                                        <input type="date" class="form-control form-control-md" name="fecha" value="<?php echo $usuarios->fecha_soli?>" readonly > 
                                                        </div> </div>
                                                </div>
                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="verNombre" class="input-group-text">Nombre</label>
                                                                <input type="text" class="form-control form-control-md" name="verNombre" id="verNombre" value="<?php echo $usuarios->nombre?>" readonly >    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="verApellidos" class="input-group-text">Apellidos</label> 
                                                                <input type="text" class="form-control form-control-md"  name="verApellidos" id="verApellidos" value="<?php echo $usuarios->apellidos?>" readonly  >        
                                                        </div>
                                                        </div>
                                                </div>  

                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="verDni" class="input-group-text">DNI</label>
                                                                <input type="text" class="form-control form-control-md" id="verDni" name="verDni" value="<?php echo $usuarios->DNI?>" readonly >    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="verFecha" class="input-group-text">Fecha Nacimiento</label>
                                                                <input type="date" class="form-control form-control-md" name="verFecha" id="verFecha" value="<?php echo $usuarios->fecha_nacimiento?>" readonly > 
                                                        </div>
                                                        </div>
                                                </div> 

                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="verTlf" class="input-group-text">Telefono</label>
                                                                <input type="text" class="form-control form-control-md" name="verTlf" id="verTlf" value="<?php echo $usuarios->telefono?>" readonly > 
                                                        </div>
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="verEmail" class="input-group-text">Email</label> 
                                                                <input type="text" class="form-control form-control-md" name="verEmail" id="verEmail"  value="<?php echo $usuarios->email?>" readonly > 
                                                        </div>
                                                        </div>
                                                </div>

                                                <div class="row mb-3">
                                                        <div class="input-group">
                                                                <label for="verDirec" class="input-group-text">Direccion</label>
                                                                <input type="text" class="form-control form-control-md" name="verDirec" id="verDirec" value="<?php echo $usuarios->direccion?>" readonly > 
                                                        </div> 
                                                </div>

                                                <div class="row mb-3">
                                                        <div class="col-6">
                                                        <div class="input-group">
                                                                <label for="verCCC" class="input-group-text">Numero cuenta</label>
                                                                <input type="text" class="form-control form-control-md" name="verCCC" id="verCCC" value="<?php echo $usuarios->CCC?>" readonly > 
                                                        </div> 
                                                        </div> 
                                                        <div class="col-3">
                                                        <div class="input-group">
                                                                <label for="verTalla" class="input-group-text">Talla</label>
                                                                <select name="verTalla" id="verTalla" class="form-control" readonly>
                                                                <option value="">-- Selecciona una talla --</option>
                                                                <?php foreach ($datos['tallas'] as $tallas) : ?>
                                                                <option value="<?php echo $tallas->id_talla?>" <?php if($tallas->id_talla==$usuarios->talla) echo "selected";?>> <?php echo $tallas->nombre ?></option>
                                                                <?php endforeach ?>
                                                                </select>
                                                              
                                                        </div>
                                                        </div>

                                                        <div class="col-3">
                                                        <div class="input-group">
                                                                <label for="verEsSocio" class="input-group-text">Ha sido socio</label>
                                                                <input type="text" class="form-control form-control-md" name="verEsSocio" id="verEsSocio" 
                                                                        value="<?php if ($usuarios->ha_sido == 0) {
                                                                                        echo "No";
                                                                                } else{
                                                                                        echo "Si";
                                                                                }?>" readonly> 
                                                        </div>
                                                        </div>
                                                </div>


                                                <p class="mt-5 mb-3 titulito">Datos padre / tutor <span >(solo si es menor)</span></p> 

                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="nom_pa" class="input-group-text">Nombre</label>
                                                                <input type="text" class="form-control form-control-md"  name="nom_pa" id="nom_pa" value="<?php echo $usuarios->nom_pa?>" readonly >    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="ape_pa" class="input-group-text">Apellidos</label> 
                                                                <input type="text" class="form-control form-control-md"  name="ape_pa" id="ape_pa" value="<?php echo $usuarios->ape_pa?>"  readonly >        
                                                        </div>
                                                        </div>
                                                </div>  


                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="dni_pa" class="input-group-text">DNI</label>
                                                                <input type="text" class="form-control form-control-md" id="dni_pa" name="dni_pa" value="<?php echo $usuarios->dni_pa?>" readonly >    
                                                        </div> 
                                                        </div>
                                                </div>

                                                <div class=" d-flex justify-content-end">
                                                        <input type="submit" class="btn mt-3 mb-4 " name="aceptar" id="confirmar" value="Confirmar solicitud">        
                                                </div> 
                                                                                               
                                        </div>
                                        </div>


                                </form>                                    
                                   

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

