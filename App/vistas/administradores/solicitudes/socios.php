<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


        <header>
        <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center"><span id="textoHead">Solicitudes para socio</span></div>
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
                        <td class="datos_tabla">


                                <!--MODAL BORRAR-->
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $usuarios->id_solicitud_soc ?>">
                                        <img class="icono" src="<?php echo RUTA_Icon ?>x1.png"></img>
                                </a>

                                <div class="modal" id="ModalBorrar_<?php echo $usuarios->id_solicitud_soc ?>">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                                <p>Vas a <b>BORRAR</b> la solicitud para socio <b> <?php echo $usuarios->nombre . " " . $usuarios->apellidos ?> </b></p>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL ?>/admin/borrar_solicitudes_socios/<?php echo $usuarios->id_solicitud_soc ?>" method="post">
                                                        <input type="submit" class="btn" name="borrar" id="confirmar" value="Borrar">    
                                                </form>
                                        </div>

                                </div>
                                </div>
                                </div>



                                <!--MODAL ACEPTAR-->
                                <!-- <a data-bs-toggle="modal" data-bs-target="#ModalAceptar_<?php echo $usuarios->id_solicitud_soc ?>">
                                        <img class="icono" src="<?php echo RUTA_Icon ?>tick.png"></img>
                                </a>

                                <div class="modal" id="ModalAceptar_<?php echo $usuarios->id_solicitud_soc ?>">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content"> -->

                                        <!-- Modal Header -->
                                        <!-- <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div> -->

                                        <!-- Modal body -->
                                        <!-- <div class="modal-body">
                                                <p>Va a <b>CONFIRMAR </b> la solicitud para socio <b> <?php echo $usuarios->nombre . " " . $usuarios->apellidos ?> </b></p>
                                        </div> -->

                                        <!-- Modal footer -->
                                        <!-- <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL ?>/admin/aceptar_solicitudes_socios/<?php $datBorrar = $usuarios->id_solicitud_soc?>" method="post">
                                                        <input type="hidden" name="datAceptar" value="<?php $datBorrar = $usuarios->id_solicitud_soc . "_" . $usuarios->DNI . "_" 
                                                                                                . $usuarios->nombre . "_" . $usuarios->apellidos . "_" 
                                                                                                . $usuarios->CCC . "_" . $usuarios->talla . "_" 
                                                                                                . $usuarios->fecha_nacimiento . "_" . $usuarios->email 
                                                                                                . "_" . $usuarios->telefono . "_" . $usuarios->direccion 
                                                                                                . "_" . $usuarios->ha_sido . "_" . $usuarios->nom_pa 
                                                                                                . " _ " .$usuarios->ape_pa . " _ " . $usuarios->dni_pa;
                                                                                                echo $datBorrar ?>">
                                                                                                
                                                        <input type="submit" class="btn" name="aceptar" id="confirmar" value="Aceptar">  
                                                </form>
                                        </div>
                                
                                </div>
                                </div>
                                </div> -->


                                <!--MODAL CONFIRMAR-->                                                   
                                <a data-bs-toggle="modal" data-bs-target="#ModalConfirmar_<?php echo $usuarios->id_solicitud_soc ?>">
                                        <img class="icono" src="<?php echo RUTA_Icon ?>tick.png"></img>
                                </a>

                                <div class="modal" id="ModalConfirmar_<?php echo $usuarios->id_solicitud_soc ?>">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header ">
                                                <p class="modal-title">SOLICITUD Nº: <?php echo $usuarios->id_solicitud_soc?></p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body info">                         
                                        <div class="row ms-1 me-1">                                              
                                                       
                                                <p class="mt-3 mb-3 titulito">Datos del atleta</p>                                                     
                                                    
                                        <form action="<?php echo RUTA_URL ?>/admin/aceptar_solicitudes_socios/<?php echo $usuarios->id_solicitud_soc?>" method="post">
                                                <div class="row">
                                                        <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="verNombre" class="input-group-text datInfo"><span class="info">Nombre</span></label>
                                                                <input type="text" class="form-control form-control-md" name="verNombre" id="verNombre" value="<?php echo $usuarios->nombre?>" >    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="verApellidos" class="input-group-text"><span class="info">Apellidos</span></label> 
                                                                <input type="text" class="form-control form-control-md"  name="verApellidos" id="verApellidos" value="<?php echo $usuarios->apellidos?>" >        
                                                        </div>
                                                        </div>
                                                </div>  

                                                <div class="row">
                                                        <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="verDni" class="input-group-text"><span class="info">DNI</span></label>
                                                                <input type="text" class="form-control form-control-md" id="verDni" name="verDni" value="<?php echo $usuarios->DNI?>" >    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="verFecha" class="input-group-text"><span class="info">Fecha Nacimiento</span></label>
                                                                <input type="date" class="form-control form-control-md" name="verFecha" id="verFecha" value="<?php echo $usuarios->fecha_nacimiento?>" > 
                                                        </div>
                                                        </div>
                                                </div> 

                                                <div class="row">
                                                        <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="verTlf" class="input-group-text"><span class="info">Telefono</span></label>
                                                                <input type="text" class="form-control form-control-md" name="verTlf" id="verTlf" value="<?php echo $usuarios->telefono?>" > 
                                                        </div>
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="verEmail" class="input-group-text"><span class="info">Email</span></label> 
                                                                <input type="text" class="form-control form-control-md" name="verEmail" id="verEmail"  value="<?php echo $usuarios->email?>" > 
                                                        </div>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-12">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="verDirec" class="input-group-text"><span class="info">Direccion</span></label>
                                                                <input type="text" class="form-control form-control-md" name="verDirec" id="verDirec" value="<?php echo $usuarios->direccion?>" > 
                                                        </div> 
                                                        </div> 
                                                </div>

                                                <div class="row">
                                                        <div class="col-6">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="verCCC" class="input-group-text"><span class="info">Numero cuenta:</span></label>
                                                                <input type="text" class="form-control form-control-md" name="verCCC" id="verCCC" value="<?php echo $usuarios->CCC?>" > 
                                                        </div> 
                                                        </div> 

                                                        <div class="col-3">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="verTalla" class="input-group-text"><span class="info">Talla:</span></label>
                                                                <input type="text" class="form-control form-control-md" name="verTalla" id="verTalla" value="<?php echo $usuarios->talla?>" > 
                                                        </div>
                                                        </div>

                                                        <div class="col-3">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="verEsSocio" class="input-group-text"><span class="info">Ha sido socio:</span></label>
                                                                <input type="text" class="form-control form-control-md" name="verEsSocio" id="verEsSocio" 
                                                                        value="<?php if ($usuarios->ha_sido == 0) {
                                                                                        echo "No";
                                                                                } else{
                                                                                        echo "Si";
                                                                                }?>" readonly> 
                                                        </div>
                                                        </div>
                                                </div>


                                                <p class="mt-4 mb-3 titulito">Datos padre / tutor <span >(solo si es menor)</span></p> 

                                                <div class="row">
                                                        <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="nom_pa" class="input-group-text"><span class="info">Nombre</span></label>
                                                                <input type="text" class="form-control form-control-md"  name="nom_pa" id="nom_pa" value="<?php echo $usuarios->nom_pa?>" >    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="ape_pa" class="input-group-text"><span class="info">Apellidos</span></label> 
                                                                <input type="text" class="form-control form-control-md"  name="ape_pa" id="ape_pa" value="<?php echo $usuarios->ape_pa?>" >        
                                                        </div>
                                                        </div>
                                                </div>  


                                                <div class="row">
                                                        <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="dni_pa" class="input-group-text"><span class="info">DNI</span></label>
                                                                <input type="text" class="form-control form-control-md" id="dni_pa" name="dni_pa" value="<?php echo $usuarios->dni_pa?>">    
                                                        </div> 
                                                        </div>
                                                </div>
                                                                                               
                                        </div>
                                        </div>
                                        
                                        <!-- Modal footer -->
                                        <div class="modal-footer mb-3 me-4">     
                                                
                                                <input type="hidden" name="id_soli" value="<?php echo $usuarios->id_solicitud_soc?>">
                                                        <input type="submit" class="btn" name="aceptar" id="confirmar" value="Confirmar">  
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

</article>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>




<script>


        var aceptarBorrar=[];
        function borrarAceptarId(id){
                if(document.getElementById(id).checked==true){
                        aceptarBorrar.push(id);
                }
                if(document.getElementById(id).checked==false){
                        for (let i = 0; i < aceptarBorrar.length; i++) {
                                if(aceptarBorrar[i]==id){
                                        aceptarBorrar.splice(i,1);
                                }
                        }
                        
                }
        }


</script>