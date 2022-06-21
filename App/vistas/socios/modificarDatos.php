<?php require_once RUTA_APP . '/vistas/inc/header-socio-paginas.php' ?>


<style>
        label[id^="error"] {
            color: red;
            font-size: 15px;
        }      

</style>

    


<?php foreach ($datos['usuarios'] as $datosUser) : ?>


<div id="ventana" class="card bg-light card-center w-75">
    <h2 class="card-header">Modificacion de datos</h2>
        <form method="POST" class="card-body" ENCTYPE="multipart/form-data" action="<?php echo RUTA_URL ?>/socio/modificarDatos" onsubmit="return validarModifiSocio()">       
            <div class="container">
                <div class="row">

                    <div class="col-3 mt-3 text-center">
                        <div>
                            <img id="output" 
                            <?php if ($datosUser->foto==''){
                                ?> src='<?php echo RUTA_Icon?>usuario.svg'<?php ;
                                }else {?> src='<?php echo RUTA_ImgDatos.$datosUser->id_usuario.'.jpg';} ?>' width="300" height="320">
                        </div>
                        <div class="mt-3">
                            <input  accept="image/*" type="file"  onchange="loadFile(event)" id="editarFoto" name="foto">
                        </div>
                    </div>


                    <div class="col-9">
                        <div class="row">
                            <div class="col-6 mt-3 mb-3">
                                <div class="input-group">
                                <label for="nombre" class="input-group-text"><span class="info">Nombre</span></label>
                                <input type="text" name="nombre" id="nombre" class="form-control form-control-md" value="<?php echo $datosUser->nombre?>" required>
                                </div>
                            </div>
                            <div class="col-6 mt-3 mb-3">
                                <div class="input-group">
                                <label for="apellidos" class="input-group-text info"><span class="info">Apellidos</span></label>
                                <input type="text" name="apellidos" id="apellidos" class="form-control form-control-md" value="<?php echo $datosUser->apellidos?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-3 mb-3">
                                <div class="input-group">
                                <label for="telefono"class="input-group-text info"><span class="info">Telefono</span></label>
                                <input type="text" name="telefono" id="telefono" class="form-control form-control-md" value="<?php echo $datosUser->telefono?>" required>
                                </div>
                            </div>
                            <div class="col-6 mt-3 mb-3">
                                <div class="input-group">
                                <label for="correo"class="input-group-text info"><span class="info">Email</span></label>
                                <input type="text" name="correo" id="correo" class="form-control form-control-md" value="<?php echo $datosUser->email?>" onchange="return validarModifiSocio()" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3 mb-3">
                                <div class="input-group">
                                <label for="direccion"class="input-group-text info"><span class="info">Direccion</span></label>
                                <input type="text" name="direccion" id="direccion" class="form-control form-control-md" value="<?php echo $datosUser->direccion?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-3 mb-3">
                                <div class="input-group">
                                <label for="dniCom"class="input-group-text info"><span class="info">Dni</span></label>
                                <input type="text" name="dni" id="dniCom" class="form-control form-control-md" value="<?php echo $datosUser->dni?>" onchange="return validarModifiSocio()" required>
                                </div>
                            </div>
                            <div class="col-6 mt-3 mb-3">
                                <div class="input-group">
                                <label for="cuenta"class="input-group-text info"><span class="info">CCC</span></label>
                                <input type="text" name="cuenta" id="cuenta" class="form-control form-control-md" value="<?php echo $datosUser->CCC?>" onchange="return validarModifiSocio()" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-3 mb-3">
                                <div class="input-group">
                                <label for="password"class="input-group-text info"><span class="info">Contraseña</span></label>
                                <input type="password" name="password" id="password" class="form-control form-control-md" required>
                                </div>
                            </div>
                            <div class="col-6 mt-3 mb-3">
                                <div class="input-group">
                                <label for="talla"class="input-group-text info"><span class="info">Talla</span></label>
                                <input type="text" name="talla" id="talla" class="form-control form-control-md" value="<?php echo $datosUser->talla?>" required>
                                </div>
                            </div>
                        </div>
                        <!--DIV PARA MOSTRAR ERRORES-->
                        <div class="col-4">
                            <div class="row" style="height: 100%; font-family: 'Inter', sans-serif;">                           
                                    <div class="datos col-12"><label id="error"></label>
                                    <label id="errorMail"></label></div>
                                    <?php endforeach ?>                            
                            </div>                    
                        </div>    
                    </div>
                </div>
            </div>

            <div class="row justify-content-end mb-2">
                <div class="col-1">
                    <input type="submit" id="confirmar" class="btn" value="Confirmar">
                </div>
                <div class="col-1">
                    <a href="<?php echo RUTA_URL?>/socio">
                        <input type="button" class="btn" id="botonVolver" value="Volver">  
                    </a>
                </div>
            </div>
        </form>
</div> 
        


        <?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>

        <script src="<?php echo RUTA_URL ?>/public/js/validar.js"></script>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
  };
</script>