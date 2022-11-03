<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    
    <title><?php echo NOMBRE_SITIO ?></title>

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
        
        #fotoBici{
            background-image: url("<?php echo RUTA_Foto ?>chicas recortadas.png");
            background-size: 100% 100%;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        @media (max-width: 600px) {
            #fotoBici {
                display: none;
            }
        }
        sup{
            color: #023EF9;
            font-weight: bold;
            font-size: small;
        }
    </style>
</head>

<body style="margin: 0px;">
    <div class="container-fluid min-vh-100 ">
        <div class="row">
            <div id="fotoBici" class="col-lg-5 col-md-5 col-sm-5 m-0 p-0 min-vh-100" >
                <!-- <img src="<?php echo RUTA_Foto ?>chicas recortadas.png" width="100%" height="928px"> -->
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 m-0 p-0">

                <div class="p-3" style="text-align: center;"><a href="<?php echo RUTA_URL ?>/socio"><img src="<?php echo RUTA_Foto ?>corredor.png" width="150"><img src="<?php echo RUTA_Foto ?>letras.png" width="200"></a></div>
                <div class="p-3" style="text-align: center;"><h1>INSCRIPCION ESCUELA</h1></div>

                <form action="" onsubmit="return validarSoliEscuela()" method="POST"> 
                    <div class="row m-3">

                        <div class="row mt-3 mb-3">
                            <div class="col-5">
                                <div class="input-group">
                                    <label for="nomAtl" class="input-group-text">Nombre (atleta) <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escriba el nombre" id="nomAtl" name="nomAtl" required onkeypress="return Solo_Texto(event);">
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                    <label for="apelAtl" class="input-group-text">Apellidos (atleta) <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escriba los apellidos" id="apelAtl" name="apelAtl" required onkeypress="return Solo_Texto(event);">
                                </div>
                            </div>
                        </div>
                        

                        <!-- <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-3 mt-3">
                            <label for="fecha">Fecha Nacimiento <sup>*</sup></label>
                            <input class="form-control" type="date" id="fecha" name="fecha" onchange="mayorEdad()" required>
                        </div> -->

                        <div class="row mb-3">
                            <div class="col-5">
                                <div class="input-group">
                                    <label for="fecha" class="input-group-text">Fecha Nacimiento <sup>*</sup></label>
                                    <input class="form-control" type="date" id="fecha" name="fecha"  required>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                   <label for="dniAtl" id="dniObli" class="input-group-text">DNI (atleta)</label>
                                    <input type="text" class="form-control" placeholder="Escriba el dni" id="dniAtl" name="dniAtl" >
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-5">
                                <div class="input-group">                                          
                                    <label for="cat" class="input-group-text">Categoría</label>
                                        <select class="form-control" name="cat" id="cat" required>
                                            <option value=""></option>
                                                <?php foreach ($datos['categorias'] as $cat) : ?>
                                                <option value="<?php echo $cat->id_categoria ?>"><?php echo $cat->nombre ?></option>
                                                <?php endforeach ?>
                                        </select>                                          
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                    <label for="grup" class="input-group-text">Grupo entrenamiento</label>
                                        <select class="form-control" name="grup" id="grup" required>
                                            <option value=""></option>
                                                <?php foreach ($datos['grupos'] as $gru) : ?>
                                                <option value="<?php echo $gru->id_grupo ?>"><?php echo $gru->nombre ?></option>
                                                <?php endforeach ?>
                                        </select> 
                                </div>
                            </div>                           
                        </div>

                        <div class="row mb-5">                            
                            <div class="col-5">
                                <div class="input-group">
                                    <label for="talla" class="input-group-text">Talla camiseta <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escriba la talla" id="talla" name="talla" required>
                                </div>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                <label for="" class="me-3">¿Es tu primer año como socio? <sup>*</sup></label> <br>
                                <input type="radio" id="siSocio" name="priSocio" value="si" required><label for="siSocio">&nbspSI</label><span style="margin-left: 20px;"></span>
                                <input type="radio" id="noSocio" name="priSocio" value="no" required><label for="noSocio">&nbspNO</label>   
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-5">
                                <div class="input-group">
                                    <label for="nomPa" class="input-group-text">Nombre (padre o tutor) <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escriba el nombre" id="nomPa" name="nomPa" required onkeypress="return Solo_Texto(event);">
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                    <label for="apelPa" class="input-group-text">Apellidos (padre o tutor) <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escriba los apellidos" id="apePa" name="apePa" required onkeypress="return Solo_Texto(event);">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-5">
                                <div class="input-group">
                                    <label for="dniPa" id="dniPa" class="input-group-text">DNI (padreo o tutor)</label>
                                    <input type="text" class="form-control" placeholder="Escriba el dni" id="dniPa" name="dniPa" >
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                    <label for="ccc" class="input-group-text">CCC <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escriba el CCC" id="ccc" name="ccc" maxlength="20" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">                            
                            <div class="col-12 input-group">
                                <label for="direc" class="input-group-text">Dirección <sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="Escriba la dirección" id="direc" name="direc" required>
                            </div>
                        </div>

                        <div class="row mb-3">                            
                            <div class="col-5">
                                <div class="input-group">
                                   <label for="telf" class="input-group-text">Telefono <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escriba el telefono" id="telf" name="telf" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                    <label for="email" class="input-group-text">Correo (atleta o padre) <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escriba el correo" id="email" name="email" onblur="return correo(this.id)" required>
                                </div>
                            </div>
                        </div>


                        <label id="error"></label>
                        <label id="errorMail"></label>

                        <input type="submit" class="btn btn-primary mt-4 ms-3 w-25" value="Enviar">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script src="<?php echo RUTA_URL ?>/public/js/validar.js"></script>