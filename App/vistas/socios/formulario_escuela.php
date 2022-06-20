<?php require_once RUTA_APP . '/vistas/inc/header-socio-paginas.php' ?>
<div class="container mt-3">
    <style>
        /* label[id^="error"] {
            color: red;
            font-size: 15px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
  
        input[type=number] {
            -moz-appearance: textfield;
        } */
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



<div id="ventana" class="card bg-light w-75">
<h2 class="card-header">Formulario escuela</h2>

    <form method="post" ENCTYPE="multipart/form-data" class="card-body">
        <div class="row">

          
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="cat">Categoría<sup>* </sup></label>
                <select class="form-control" name="cat" id="cat" required>
                    <option value=""></option>
                    <?php foreach ($datos['categorias'] as $cat) : ?>
                        <option value="<?php echo $cat->id_categoria ?>"><?php echo $cat->nombre ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="grup">Grupo entrenamiento<sup>*</sup></label>
                <select class="form-control" name="grup" id="grup" required>
                    <option value=""></option>
                    <?php foreach ($datos['grupos'] as $gru) : ?>
                        <option value="<?php echo $gru->id_grupo ?>"><?php echo $gru->nombre ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="">Consiento la toma y el uso de fotos <sup>*</sup></label> <span style="margin-left: 10px;"></span>
                <input type="radio" id="siFotos" name="fotos" value="si" required><label for="siFotos">&nbspSI</label><span style="margin-left: 20px;"></span>
                <input type="radio" id="noFotos" name="fotos" value="no" required><label for="noFotos">&nbspNO</label>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="">He leido y acepto el reglamento <sup>*</sup></label> <span style="margin-left: 10px;"></span>
                <input type="radio" id="siReglamento" name="reglamento" value="si" required><label for="siReglamento">&nbspSI</label>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-5 mt-3">
                <label class="mb-2" for="imagen">Foto reciente tamaño carnet <sup>* </sup></label>
                <input type="file" id="imagen" name="imgCarnet" accept="image/*" required>
            </div>

   

            <div class="row mb-3">
                <div class="col-3">
                    <input type="submit" class="btn" value="Confirmar">
                    <a href="<?php echo RUTA_URL?>/adminEventos">
                        <input type="button" class="btn" id="botonVolver" value="Volver">  
                    </a>
                </div>
            </div>
        </div>
    </form>
    </div>

    <?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>
    <script src="<?php echo RUTA_URL ?>/public/js/validar.js"></script>