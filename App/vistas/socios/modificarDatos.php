<?php foreach ($datos['usuarios'] as $datosUser) : ?>


<?php require_once RUTA_APP . '/vistas/inc/header-socio-paginas.php' ?>

        <form method="POST" ENCTYPE="multipart/form-data" action="<?php echo RUTA_URL ?>/socio/modificarDatos" >
            <div class="row">
        
                <div class="col-4 text-center">
                    <div class="row" style="height: 100%;">
                    
                        <div class="col-12"><img id="output" <?php if ($datosUser->foto=='') {?> src='<?php echo RUTA_Icon?>usuario.svg'<?php ;}else {?> src='<?php echo RUTA_ImgDatos.'fotosPerfil/'.$datosUser->foto;} ?>' width="360" height="400" style="border: solid; color: #023EF9;"></div>
                        <div class="col-12"><label for="editarFoto" class="editarFoto">EDITAR FOTO</label><br><input  accept="image/*" type="file"  onchange="loadFile(event)" style="visibility:hidden;" id="editarFoto" name="foto"> </div>
                    </div> 
                
                </div>
                <div class="col-4">
                    <div class="row" style="padding-left: 5cm; font-family: 'Inter', sans-serif;">
                        <div class="datos col-12" >DNI</div>
                        <div class="datos col-12" >NOMBRE</div>
                        <div class="datos col-12" >APELLIDOS</div>   
                        <div class="datos col-12" >TELÉFONO</div>
                        <div class="datos col-12" >CORREO</div>
                        <div class="datos col-12" >CCC</div>
                        <div class="datos col-12" >CONTRASEÑA</div>
                        <div class="datos col-12" >TALLA CAMISETA</div>
                
                    </div>
                </div>
                <div class="col-4">
                    <div class="row" style="height: 100%; font-family: 'Inter', sans-serif;">
                    
                            
                            <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->dni=="") {echo 'DNI';} else {echo $datosUser->dni;}?>" name="dni"></div>
                            <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->nombre=="") {echo 'NOMBRE';} else {echo $datosUser->nombre;}?>" name="nombre"></div>            
                            <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->apellidos=="") {echo 'APELLIDOS';} else {echo $datosUser->apellidos;}?>" name="apellidos"></div>                     
                            <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->telefono=="") {echo 'TELEFONO';} else {echo $datosUser->telefono;}?>" name="telefono"></div>          
                            <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->email=="") {echo 'EMAIL';} else {echo $datosUser->email;}?>" name="email"></div>         
                            <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->CCC=="") {echo 'CCC';} else {echo $datosUser->CCC;}?>" name="ccc" id="ccc"></div>
                            <div class="datos col-12" > <input type="password" size="30" placeholder="CONTRASEÑA" name="passw"></div>
                            <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->talla=="") {echo 'TALLA CAMISETA';} else {echo $datosUser->talla;}?>" name="talla"></div>                      
                            <div class="datos col-12"><input type="submit" id="guardar" name="guardar" value="GUARDAR"></div>
                            <?php endforeach ?>
                        
                    </div>
                
                
                </div>
                
            </div>
        </form>
        
<?php require_once RUTA_APP . '/vistas/inc/header-socio-paginas.php' ?>


<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
  };
</script>