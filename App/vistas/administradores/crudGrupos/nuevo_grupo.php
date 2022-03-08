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

        label, h2,p{
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
    
        <h2 class="card-header">Nuevo grupo</h2>


    <!--FORMULARIO AÑADIR-->
    <form method="post" class="card-body">

            <div class="row">

                    <div class="col-4">
                        
                        <input type="text" name="id_grupo" id="id_grupo" hidden>
                        
                        <div class="row mt-3 mb-3">
                            <label for="nombreTest">Nombre<sup>*</sup></label>
                            <input type="text" name="nombre" id="nombre" class="form-control form-control-lg">
                        </div>
                        <div class="row mt-3 mb-3">
                            <label for="nombreTest">Fecha inicio<sup>*</sup></label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control form-control-lg">
                        </div>
                        <div class="row mt-3 mb-3">
                            <label for="nombreTest">Fecha fin<sup>*</sup></label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg">
                        </div>
                    </div>


                    <div class="col-6"> 
                        <br>  
                        
                        <input type="text" name="id_horario" id="id_horario" hidden>
                    
                        <p>Selecciona dia, hora de inicio y hora de fin</p>
                        <div class="row">
                            <div class="col-3 mb-3">
                                <input type="checkbox" name="lunesDia" value="Lunes"> 
                                <label for="Lunes">Lunes</label>
                            </div>
                            <div class="col-3">
                                <input type="time" name="lunesIni" id="hora_ini" class="form-control form-control-sm">  
                            </div>   
                            <div class="col-3">   
                                <input type="time" name="lunesFin" id="hora_fin" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 mb-3">
                                <input type="checkbox" name="martesDia" value="Martes"> 
                                <label for="Martes">Martes</label>
                            </div>  
                            <div class="col-3">
                                <input type="time" name="martesIni" id="hora_ini" class="form-control form-control-sm">  
                            </div>   
                            <div class="col-3">   
                                <input type="time" name="martesFin" id="hora_fin" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 mb-3">
                                <input type="checkbox" name="miercoles[]" value="Miercoles"> 
                                <label for="Miercoles">Miercoles</label>
                            </div>  
                            <div class="col-3">
                                <input type="time" name="miercoles[]" id="hora_ini" class="form-control form-control-sm">  
                            </div>   
                            <div class="col-3">   
                                <input type="time" name="miercoles[]" id="hora_fin" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 mb-3">
                                <input type="checkbox" name="jueves[]" value="Jueves"> 
                                <label for="Jueves">Jueves</label>
                            </div>
                            <div class="col-3">
                                <input type="time" name="jueves[]" id="hora_ini" class="form-control form-control-sm">  
                            </div>   
                            <div class="col-3">   
                                <input type="time" name="jueves[]" id="hora_fin" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <input type="checkbox" name="viernes[]" value="Viernes"> 
                                <label for="Viernes">Viernes</label>
                            </div>  
                            <div class="col-3">
                                <input type="time" name="viernes[]" id="hora_ini" class="form-control form-control-sm">  
                            </div>   
                            <div class="col-3">   
                                <input type="time" name="viernes[]" id="hora_fin" class="form-control form-control-sm">
                            </div>
                        </div> 
                    </div>

            </div>

          
                <input type="submit" class="btn" value="Confirmar">

                <a href="<?php echo RUTA_URL?>/adminGrupos">
                    <input class="col-1 btn m-3" type="button" id="botonVolver" value="Volver">  
                </a>
  
    </form>  



</div>



<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>