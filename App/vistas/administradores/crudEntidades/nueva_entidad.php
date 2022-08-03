<?php require_once RUTA_APP.'/vistas/inc/navA.php' ?>

    <style>
 
        #ventana{
            margin: auto;
        }

        label, h2{
           color:#023ef9;
        }
      
        .btn{
            background-color: #023ef9; 
            color:white;
        }

        #botonVolver{
            background-color:white; 
            color:#023ef9;
            border-color:#023ef9;
        }

  
    </style>



<div id="ventana" class="card bg-light w-50 card-cente">
    
        <h2 class="card-header">Nueva entidad</h2>

        <!--FORMULARIO AÑADIR-->
        <form method="post" class="card-body">

                <div class="row">
                    <div class="col-6 mt-3 mb-3">
                        <label for="id_entidad">CIF<sup>*</sup></label>
                        <input type="text" name="id_entidad" id="id_entidad" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-6 mt-3 mb-3">
                        <label for="nombre">Nombre<sup>*</sup></label>
                        <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" required>
                    </div>
                </div>

                <div class="mt-3 mb-3">
                    <label for="direccion">Direccion<sup>*</sup></label>
                    <input type="text" name="direccion" id="direccion" class="form-control form-control-lg" required>
                </div>

                <div class="row">
                    <div class="col-6 mt-3 mb-3">
                        <label for="telefono">Telefono<sup>*</sup></label>
                        <input type="text" name="telefono" id="telefono" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-6 mt-3 mb-3">
                        <label for="email">Email<sup>*</sup></label>
                        <input type="text" name="email" id="email" class="form-control form-control-lg" required>
                    </div>
                </div>

                <div class="mt-3 mb-3">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" name="observaciones" id="observaciones" class="form-control form-control-lg">
                </div>
               
                <br>

                <div class="row">
                    <div class="col-3">
                        <input type="submit" class="btn" value="Confirmar">
                        <a href="<?php echo RUTA_URL?>/adminEntidades">
                            <input type="button" class="btn" id="botonVolver" value="Volver">  
                        </a>
                    </div>
                </div>
                    <br>
        </form>     
            
</div>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>