<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>



        <header>
        <div class="row mb-5">
        <div class="col-10 d-flex align-items-center justify-content-center"><span id="textoHead">Solicitudes para eventos</span></div>
        <div class="col-2 mt-2">
        <a type="button" id="botonLogout" class="btn"  href="<?php echo RUTA_URL ?>/login/logout">
        <span>Logout</span>
        <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
        </a>
        </div>
        </div>                                   
        </header>


<!-- <div style="text-align: center;">
        <form method="post" id="radioChe" class="card-body" action="<?php echo RUTA_URL ?>/admin/crud_solicitudes_eventos/">
                <input type="radio" name="opcion" value="socio" id="socio" <?php if ($datos['radioCheck'] == "socio") {
                                                                                        echo "checked";
                                                                                } ?>>&nbsp;<label for="socio">Ver solicitudes socio</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="opcion" value="externo" id="externo" <?php if ($datos['radioCheck'] == "externo") {
                                                                                        echo "checked";
                                                                                } ?>>&nbsp;<label for="externo">Ver solicitudes externo</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input onclick="enviarSociExter()" class="btn" type="submit" name="enviar" value="Cargar">
        </form>
</div> -->

        <article>
                <table id="tabla" class="table">

                        <!--CABECERA TABLA-->
                        <thead>
                        <tr>
                                <th>ID</th>          
                                <th>NOMBRE</th>
                                <th>APELLIDOS</th>
                                <th>EVENTO</th>
                                <th>FECHA SOLICITUD</th>
                                <th>EMAIL</th>
                                <th>TELEFONO</th>
                                

                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                        <th>ACCIONES</th>
                        
                                <?php endif ?>
                        </tr>
                        </thead>


                        <tbody>
                        <?php foreach ($datos['soliEvento'] as $usuarios) : ?>
                                <tr>
                                <td class="datos_tabla"><?php echo $usuarios->id_solicitud?></td>                               
                                <td class="datos_tabla"><?php echo $usuarios->nombre?></td>
                                <td class="datos_tabla"><?php echo $usuarios->apellidos?></td>
                                <td class="datos_tabla"><?php echo $usuarios->nombre_evento?></td>
                                <td class="datos_tabla"><?php echo $usuarios->fecha?></td>
                                <td class="datos_tabla"><?php echo $usuarios->email?></td>
                                <td class="datos_tabla"><?php echo $usuarios->telefono?></td>
                                


                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                <td class="datos_tabla">


                                        <!-- MODAL BORRAR-->
                                        <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $usuarios->id_solicitud?>">
                                        <img src="<?php echo RUTA_Icon ?>x1.png" width="30" height="30"></img>
                                        </a>
                                        <div class="modal" id="ModalBorrar_<?php echo $usuarios->id_solicitud?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                <p>Va a <b>BORRAR</b> la solicitud de <?php echo $usuarios->nombre. " " . $usuarios->apellidos?> al evento <?php echo $usuarios->nombre_evento?></p>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL ?>/externo/borrar_soli_eve/<?php echo $usuarios->id_solicitud?>" method="post">
                                                <button type="submit">Borrar</button>
                                                </form>       
                                                </div>

                                        </div>
                                        </div>
                                        </div>



                                        <!-- MODAL ACEPTAR-->
                                        <a data-bs-toggle="modal" data-bs-target="#ModalConfirmar_<?php echo $usuarios->id_solicitud ?>">
                                        <img src="<?php echo RUTA_Icon ?>tick.png" width="30" height="30"></img>
                                        </a>
                                        

                                        <div class="modal" id="ModalConfirmar_<?php echo $usuarios->id_solicitud ?>">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header mb-3 ">
                                                <p class="modal-title">SOLICITUD Nº: <?php echo $usuarios->id_solicitud?></p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body info">                         
                                        <div class="row ms-1 me-1">                                              
                                                                                                    
                                                    
                                        <form action="<?php echo RUTA_URL ?>/externo/aceptar_soli_even/<?php echo $usuarios->id_solicitud?>" method="post">
                                                
                                        
                                                <div class="row mb-4">
                                                        <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="fecha" class="input-group-text"><span class="info">Fecha solicitud:</span></label>
                                                                <input type="text" class="form-control form-control-md" name="fecha" id="fecha" value="<?php echo $usuarios->fecha?>" readonly> 
                                                        </div> 
                                                        </div> 

                                                        <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="nombre_evento" class="input-group-text"><span class="info">Evento:</span></label>
                                                                <input type="text" class="form-control form-control-md" name="nombre_evento" id="nombre_evento" value="<?php echo $usuarios->nombre_evento?>" readonly> 
                                                        </div>
                                                        </div>
       
                                                </div>
                                                         
                                        
                                                <div class="row">
                                                        <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="nombre" class="input-group-text datInfo"><span class="info">Nombre</span></label>
                                                                <input type="text" class="form-control form-control-md" name="nombre" id="nombre" value="<?php echo $usuarios->nombre?>" >    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="apellidos" class="input-group-text"><span class="info">Apellidos</span></label> 
                                                                <input type="text" class="form-control form-control-md"  name="apellidos" id="apellidos" value="<?php echo $usuarios->apellidos?>" >        
                                                        </div>
                                                        </div>
                                                </div>  

                                                <div class="row">
                                                        <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="dni" class="input-group-text"><span class="info">DNI</span></label>
                                                                <input type="text" class="form-control form-control-md" id="dni" name="dni" value="<?php echo $usuarios->DNI?>" >    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="f_naci" class="input-group-text"><span class="info">Fecha Nacimiento</span></label>
                                                                <input type="date" class="form-control form-control-md" name="f_naci" id="f_naci" value="<?php echo $usuarios->fecha_nacimiento?>" > 
                                                        </div>
                                                        </div>
                                                </div> 


                                                <div class="row">
                                                        <div class="col-12">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="direccion" class="input-group-text"><span class="info">Direccion</span></label>
                                                                <input type="text" class="form-control form-control-md" name="direccion" id="direccion" value="<?php echo $usuarios->direccion?>" > 
                                                        </div> 
                                                        </div> 
                                                </div>


                                                <div class="row">
                                                        <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="telefono" class="input-group-text"><span class="info">Telefono</span></label>
                                                                <input type="text" class="form-control form-control-md" name="telefono" id="telefono" value="<?php echo $usuarios->telefono?>" > 
                                                        </div>
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                <label for="email" class="input-group-text"><span class="info">Email</span></label> 
                                                                <input type="text" class="form-control form-control-md" name="email" id="email"  value="<?php echo $usuarios->email?>" > 
                                                        </div>
                                                        </div>
                                                </div>

                                                                                               
                                        </div>
                                        </div>
                                        
                                        <!-- Modal footer -->
                                        <div class="modal-footer mb-3 me-4">     
                                                
                                                <input type="hidden" name="id_evento" value="<?php echo $usuarios->id_evento?>">
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
        var aceptarBorrar = [];

        function borrarAceptarId(id) {
                if (document.getElementById(id).checked == true) {
                        aceptarBorrar.push(id);
                }
                if (document.getElementById(id).checked == false) {
                        for (let i = 0; i < aceptarBorrar.length; i++) {
                                if (aceptarBorrar[i] == id) {
                                        aceptarBorrar.splice(i, 1);
                                }
                        }

                }
        }



        function enviarSociExter(){
                if(document.getElementById("externo").checked==true){
                        var rutaURL= document.getElementById("radioChe").action;
                        document.getElementById("radioChe").action=rutaURL+"externo";
                }
                if(document.getElementById("socio").checked==true){
                        var rutaURL= document.getElementById("radioChe").action;
                        document.getElementById("radioChe").action=rutaURL+"socio";
                }
                
        }
</script>