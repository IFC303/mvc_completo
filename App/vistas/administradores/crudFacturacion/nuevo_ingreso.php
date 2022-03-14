<?php require_once RUTA_APP.'/vistas/inc/header-admin-miga.php' ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/css/estilos.css">
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <title><?php echo NOMBRE_SITIO?></title>

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
    
        <div class="row card-header">
            <div class="col-4">
                <h2>Nuevo ingreso</h2>
            </div>
        </div>

        <!--FORMULARIO AÑADIR-->
        <form method="post" class="card-body">

            <div class="row">
                <div class="col-6 mt-3 mb-3">
                    <label for="fecha">Fecha<sup>*</sup></label>
                    <input type="date" name="fecha" id="fecha" class="form-control form-control-lg">
                </div>

                <div class="col-6 mt-3 mb-3">
                    <label for="tipo" class="form-label">Tipo de ingreso:</label>
                    <input class="form-control" list="browsers2" name="browser2" id="browser2">
                    <datalist id="browsers2" name="tipo" id="tipo">
                        <option value="Cuotas" name="cuotas" id="cuotas"></option>
                        <option value="Actividades" name="actividades" id="actividades"></option>
                        <option value="Otros" name="otros" id="otros"></option>
                    </datalist>  
                    <input type="hidden" value="" name="selec">    
                </div>  
            </div>
            


            <div class="row">
                <div class="col-6 mt-3 mb-3">
                    <label for="nombre">Importe<sup>*</sup></label>
                    <input type="text" name="importe" id="importe" class="form-control form-control-lg">
                </div>   
                 <div class="col-6 mt-3 mb-3">
                    <label for="browser" class="form-label">Elige un participante:</label>
                    <input class="form-control" list="browsers" name="browser" id="browser">
                    <datalist id="browsers" name="participante" id="participante">
                        <?php foreach($datos['usuarios'] as $usu){
                            ?><option value="<?php echo $usu->nombre?>"></option><?php
                        }?>    
                    </datalist>      
                </div>
            </div>

            <div class="row">
                <div class="col-6 mt-3 mb-3">
                    <label for="concepto">Concepto<sup>*</sup></label>
                    <input type="text" name="concepto" id="concepto" class="form-control form-control-lg">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-3">
                    <input type="submit" class="btn" value="Confirmar">
                    <a href="<?php echo RUTA_URL?>/adminFacturacion/ingresos">
                        <input type="button" class="btn" id="botonVolver" value="Volver">  
                    </a>
                </div>
            </div>
            <br>
          
            
        </form>  

</div>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>

