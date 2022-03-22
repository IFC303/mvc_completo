<?php require_once RUTA_APP.'/vistas/inc/header-admin-miga.php' ?>

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
    
        <h2 class="card-header">Nuevo evento</h2>

        <!--FORMULARIO AÑADIR-->
        <form method="post" class="card-body">

            <div class="row">
                <div class="col-6 mt-3 mb-3">
                    <label for="nombre">Nombre<sup>*</sup></label>
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" required>
                </div>

                <div class="col-6 mt-3 mb-3">
                    <label for="tipo">Tipo<sup>*</sup></label>
                    <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" required>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mt-3 mb-3">
                    <label for="fecha_ini">Fecha inicio<sup>*</sup></label>
                    <input type="date" name="fecha_ini" id="fecha_ini" class="form-control form-control-lg" required>
                </div>

                <div class="col-6 mt-3 mb-3">
                    <label for="fecha_fin">Fecha fin<sup>*</sup></label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg" required>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mt-3 mb-3">
                    <label for="precio">Precio<sup>*</sup></label>
                    <input type="text" name="precio" id="precio" class="form-control form-control-lg" required>
                </div>

                <div class="col-6 mt-3 mb-3">
                    <label for="descuento">Descuento<sup>*</sup></label>
                    <input type="text" name="descuento" id="descuento" class="form-control form-control-lg" required>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mt-3 mb-3">
                    <label for="fecha_ini_inscrip">Fecha inicio inscripcion<sup>*</sup></label>
                    <input type="date" name="fecha_ini_inscrip" id="fecha_ini_inscrip" class="form-control form-control-lg" required>
                </div>

                <div class="col-6 mt-3 mb-3">
                    <label for="fecha_fin_inscrip">Fecha fin inscripcion<sup>*</sup></label>
                    <input type="date" name="fecha_fin_inscrip" id="fecha_fin_inscrip" class="form-control form-control-lg" required>
                </div>
            </div>
        <br>

            <div class="row">
                <div class="col-3">
                    <input type="submit" class="btn" value="Confirmar">
                    <a href="<?php echo RUTA_URL?>/adminEventos">
                        <input type="button" class="btn" id="botonVolver" value="Volver">  
                    </a>
                </div>
            </div>
          <br>
            
        </form>  

</div>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>