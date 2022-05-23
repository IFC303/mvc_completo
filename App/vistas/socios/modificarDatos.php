<?php foreach ($datos['usuarios'] as $datosUser) : ?>


<?php require_once RUTA_APP . '/vistas/inc/header-socio-paginas.php' ?>

<style>
        label[id^="error"] {
            color: red;
            font-size: 15px;
        }

        #ventana{
            margin: auto;
        }
</style>




<div id="ventana" class="card bg-light card-center">

        <form method="POST" class="card-body" ENCTYPE="multipart/form-data" action="<?php echo RUTA_URL ?>/socio/modificarDatos" onsubmit="return validarModifiSocio()">       
        <div class="container">
        <div class="row">

                <div class="col-4 text-center">
                    <div>
                        <img id="output" <?php if ($datosUser->foto=='') {?> src='<?php echo RUTA_Icon?>usuario.svg'<?php ;}else {?> src='<?php echo RUTA_ImgDatos.'fotosPerfil/'.$datosUser->foto;} ?>' width="360" height="400" style="border: solid; color: #023EF9;">
                    </div>
                    <div>
                        <label title="Cambia tu foto de perfil" for="editarFoto" class="editarFoto">EDITAR FOTO</label><br>
                        <input  accept="image/*" type="file"  onchange="loadFile(event)" style="visibility:hidden;" id="editarFoto" name="foto">
                    </div>
                </div>

                <div class="col-8">
                    <div class="row">
                        <div class="col-6 mt-3 mb-3">
                            <label for="dni">DNI<sup>*</sup></label>
                            <input type="text" name="dni" id="dni" class="form-control form-control-lg" placeholder="<?php if ($datosUser->dni=="") {echo 'DNI';} else {echo $datosUser->dni;}?>" name="dni" id="dniCom" onchange="return validarModifiSocio()">
                        </div>
                        <div class="col-6 mt-3 mb-3">
                            <label for="nombre">Nombre<sup>*</sup></label>
                            <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" placeholder="<?php if ($datosUser->nombre=="") {echo 'NOMBRE';} else {echo $datosUser->nombre;}?>" name="nombre">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mt-3 mb-3">
                            <label for="apellidos">Apellidos<sup>*</sup></label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control form-control-lg" placeholder="<?php if ($datosUser->apellidos=="") {echo 'APELLIDOS';} else {echo $datosUser->apellidos;}?>" name="apellidos">
                        </div>
                        <div class="col-6 mt-3 mb-3">
                            <label for="telefono">Telefono<sup>*</sup></label>
                            <input type="text" name="telefono" id="telefono" class="form-control form-control-lg" placeholder="<?php if ($datosUser->telefono=="") {echo 'TELEFONO';} else {echo $datosUser->telefono;}?>" name="telefono">
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-6 mt-3 mb-3">
                            <label for="correo">Email<sup>*</sup></label>
                            <input type="text" name="correo" id="correo" class="form-control form-control-lg" placeholder="<?php if ($datosUser->email=="") {echo 'EMAIL';} else {echo $datosUser->email;}?>" name="email" id="emailCom" onchange="return validarModifiSocio()">
                        </div>
                        <div class="col-6 mt-3 mb-3">
                            <label for="cuenta">CCC<sup>*</sup></label>
                            <input type="text" name="cuenta" id="cuenta" class="form-control form-control-lg" placeholder="<?php if ($datosUser->CCC=="") {echo 'CCC';} else {echo $datosUser->CCC;}?>" name="ccc" id="ccc">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mt-3 mb-3">
                            <label for="password">Contraseña<sup>*</sup></label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg">
                        </div>
                        <div class="col-6 mt-3 mb-3">
                            <label for="talla">TALLA<sup>*</sup></label>
                            <input type="text" name="talla" id="talla" placeholder="<?php if ($datosUser->talla=="") {echo 'TALLA CAMISETA';} else {echo $datosUser->talla;}?>" name="talla" class="form-control form-control-lg">
                        </div>
                    </div> 


                     <div class="col-4">
                        <div class="row" style="height: 100%; font-family: 'Inter', sans-serif;">
                        
                            
                                <div class="datos col-12"><label id="error"></label>
                                <label id="errorMail"></label></div>

                                <div class="datos col-12"><input title="Guardar cambios" class="btn" type="submit" id="guardar" name="guardar" value="GUARDAR"></div>
                                <?php endforeach ?>
                            
                        </div>
                    
                    </div>    
                </div>
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