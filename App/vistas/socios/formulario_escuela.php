<?php require_once RUTA_APP . '/vistas/inc/header-socio-paginas.php' ?>
<div class="container mt-3">
    <style>
        label[id^="error"] {
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
        }
    </style>


    <form method="post">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="cat">Categoría (2022) <sup>* </sup></label>
                <select class="form-control" name="cat" id="cat" required>
                    <option value=""></option>
                    <?php foreach ($datos['categorias'] as $cat) : ?>
                        <option value="<?php echo $cat->id_categoria ?>"><?php echo $cat->nombre ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="grup">Grupo entrenamiento <sup>*</sup></label>
                <select class="form-control" name="grup" id="grup" required>
                    <option value=""></option>
                    <?php foreach ($datos['grupos'] as $gru) : ?>
                        <option value="<?php echo $gru->id_grupo ?>"><?php echo $gru->nombre ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="">Consiento la toma y el uso de fotos <sup>*</sup></label> <span style="margin-left: 10px;"></span>
                <input type="radio" id="siFotos" name="fotos" value="si" required><label for="siFotos">SI</label><span style="margin-left: 20px;"></span>
                <input type="radio" id="noFotos" name="fotos" value="no" required><label for="noFotos">NO</label>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="">He leido y acepto el reglamento <sup>*</sup></label> <span style="margin-left: 10px;"></span>
                <input type="radio" id="siReglamento" name="reglamento" value="si" required><label for="siReglamento">SI</label>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="">Foto reciente tamaño carnet <sup>* </sup></label>
                <input type="file" name="imgCarnet" accept="image/*" required>
            </div>

            <div class="col-12">
                <input type="submit" value="Enviar" style="background-color: #023ef9; color:white;">
            </div>


        </div>
    </form>

    <?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>
    <script src="<?php echo RUTA_URL ?>/public/js/validar.js"></script>