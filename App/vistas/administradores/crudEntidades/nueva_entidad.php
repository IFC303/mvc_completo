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
    
        <h2 class="card-header">Nueva entidad</h2>

        <!--FORMULARIO AÑADIR-->
        <form method="post" class="card-body">

                <div class="mt-3 mb-3">
                    <label for="id_entidad">Numero de entidad<sup>*</sup></label>
                    <input type="text" name="id_entidad" id="id_entidad" class="form-control form-control-lg">
                </div>

                <div class="mt-3 mb-3">
                    <label for="nombre">Nombre<sup>*</sup></label>
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-lg">
                </div>

                <div class="mt-3 mb-3">
                    <label for="tipo">Tipo<sup>*</sup></label>
                    <input type="text" name="tipo" id="tipo" class="form-control form-control-lg">
                </div>
               

                <div class="row">
                    <div class="col-3">
                        <input type="submit" class="btn" value="Confirmar">
                        <a href="<?php echo RUTA_URL?>/adminEntidades">
                            <input type="button" class="btn" id="botonVolver" value="Volver">  
                        </a>
                    </div>
                </div>
                    
        </form>     
            
</div>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>