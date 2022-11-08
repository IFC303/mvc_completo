<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">
    
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

        
         #fotoBici{
             background-image: url("<?php echo RUTA_Foto ?>chicas recortadas.png"); 
            background-size: 100% 100%;
           
        } 


        @media (max-width: 600px) {
            #fotoBici {
                display: none;
            }
        }

    </style>
</head>

<body style="margin: 0px;">
    <div class="container-fluid min-vh-100 ">
        <div class="row">
            <div id="fotoBici" class="col-lg-5 col-md-5 col-sm-5 m-0 p-0 min-vh-100" >
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 m-0 p-0">

                <div class="col-10 mt-3 mb-3 d-flex align-items-center justify-content-center">
                    <span id="textoForm">Inscripcion escuela</span>
                </div>

                <form action="" onsubmit="return validarSoliEscuela()"  ENCTYPE="multipart/form-data" method="POST"> 
                    <div class="row m-3 info">

                        <div class="row mt-3 mb-3">
                            <div class="col-5">
                                <div class="input-group">
                                    <label for="nomAtl" class="input-group-text">Nombre <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escribe tu nombre" id="nomAtl" name="nomAtl" required onkeypress="return Solo_Texto(event);">
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                    <label for="apelAtl" class="input-group-text">Apellidos<sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escribe tus apellidos" id="apelAtl" name="apelAtl" required onkeypress="return Solo_Texto(event);">
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
                                   <label for="dniAtl" id="dniObli" class="input-group-text">DNI</label>
                                    <input type="text" class="form-control" placeholder="Escribe tu DNI" id="dniAtl" name="dniAtl" >
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">                            
                            <div class="col-12 input-group">
                                <label for="direc" class="input-group-text">Dirección <sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="Escribe una direccion" id="direc" name="direc" required>
                            </div>
                        </div>

                        <div class="row mb-3">                            
                            <div class="col-5">
                                <div class="input-group">
                                   <label for="telf" class="input-group-text">Telefono <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escribe un telefono" id="telf" name="telf" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                    <label for="email" class="input-group-text">Email <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escribe un correo electronico" id="email" name="email" onblur="return correo(this.id)" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">   
                            <div class=" col-12 input-group">
                                <label for="ccc" class="input-group-text">CCC <sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="Escribe un numero cuenta corriente" id="ccc" name="ccc" maxlength="20" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">
                                <div class="input-group">                                          
                                    <label for="cat" class="input-group-text">Categoría</label>
                                        <select class="form-control" name="cat" id="cat" required>
                                            <option value="">-- Selecciona una categoria --</option>
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
                                            <option value="">-- Selecciona una grupo --</option>
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
                                    <label for="gir" class="input-group-text">GIR</label>
                                    <input type="text" class="form-control" placeholder="Escribe tu numero GIR" id="gir" name="gir">
                                </div>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                <label for="" class="me-3">¿Eres socio? <sup>*</sup></label> <br>
                                <input type="radio" id="siSocio" name="priSocio" value="1" required><label for="siSocio">&nbspSI</label><span style="margin-left: 20px;"></span>
                                <input type="radio" id="noSocio" name="priSocio" value="0" required><label for="noSocio">&nbspNO</label>   
                            </div>
                        </div>

                        <div class="row mb-1">
                            <p style="font-weight:bold;color:#0070c6;text-decoration:underline">Rellena los siguientes campos solo si eres menor de edad</p>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">
                                <div class="input-group">
                                    <label for="nomPa" class="input-group-text">Nombre</label>
                                    <input type="text" class="form-control" placeholder="Del padre, madre o tutor" id="nomPa" name="nomPa"  onkeypress="return Solo_Texto(event);">
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                    <label for="apelPa" class="input-group-text">Apellidos</label>
                                    <input type="text" class="form-control" placeholder="Del padre, madre o tutor" id="apePa" name="apePa"  onkeypress="return Solo_Texto(event);">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-5">
                                <div class="input-group">
                                    <label for="dniPa" id="dniPa" class="input-group-text">DNI</label>
                                    <input type="text" class="form-control" placeholder="Del padre, madre o tutor" id="dniPa" name="dniPa" >
                                </div>
                            </div>
                        </div>

                                        

                        <div class="row mb-5 mt-3 d-flex justify-content-start">
                            <div class="col-5">
                                <p style="font-weight:bold;color:#0070c6;text-decoration:underline; margin-bottom:10px">Justificante de pago</p>
                                <input id="pago"type="file" name="pago" required>
                            </div>
                            <div class="col-5">
                                <p style="font-weight:bold;color:#0070c6;text-decoration:underline; margin-bottom:10px">Foto carnet</p>
                                <input id="foto" type="file" name="foto" required>
                            </div>
                        </div>

                        
                        <div class="row mt-4"> 
                            <div >
                                <input type="submit" class="btn" name="aceptar" id="confirmar" value="Enviar solicitud"> 
                            </div>
                        </div>


                        <label id="error"></label>
                        <label id="errorMail"></label>

                      
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script src="<?php echo RUTA_URL ?>/public/js/validar.js"></script>