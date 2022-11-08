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
            background-image: url("<?php echo RUTA_Foto ?>bici3.png");
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

            <div id="fotoBici" class="col-lg-5 col-md-5 col-sm-5 m-0 p-0 min-vh-100" ></div>

            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 m-0 p-0">

                <div class="col-10 mt-5 mb-5 d-flex align-items-center justify-content-center">
                    <span id="textoForm">Inscripcion a eventos</span>
                </div>

                <form action="" onsubmit="return validarSoliSocio()" ENCTYPE="multipart/form-data" method="POST"> 
                <div  class="col-11 info mt-5">
               
                         <div class="row mt-3 mb-3">
                            <div class="col-5">
                                <div class="input-group">
                                   <label for="nombre" class="input-group-text">Nombre <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escribe tu nombre" id="nombre" name="nombre" required onkeypress="return Solo_Texto(event);">
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                  <label for="apellidos" class="input-group-text">Apellidos <sup>*</sup></label>
                                  <input type="text" class="form-control" placeholder="Escribe tus apellidos" id="apellidos" name="apellidos" required onkeypress="return Solo_Texto(event);">
                                </div>
                            </div>
                        </div> 


                        <div class="row mt-4 mb-4">
                            <div class="col-5">
                                <div class="input-group">
                                    <label for="fecha_naci" class="input-group-text">Fecha Nacimiento <sup>*</sup></label>
                                    <input class="form-control" type="date" id="fecha_naci" name="fecha_naci" onchange="mayorEdad()" required>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                    <label for="dni" class="input-group-text" id="dniObli">DNI</label>
                                    <input type="text" class="form-control" placeholder="Escribe tu DNI" id="dni" name="dni">
                                </div>
                            </div>                           
                        </div>

                        <div class="row mt-3 mb-4">
                            <div class="col-12 input-group">
                                <label for="direccion" class="input-group-text">Dirección <sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="Escribe una dirección" id="direccion" name="direccion" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-5">
                                <div class="input-group">
                                    <label for="telefono" class="input-group-text">Telefono <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escribe un telefono" id="telefono" name="telefono" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                    <label for="email" class="input-group-text">Email <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escribe un correo electronico" id="email" name="email" onblur="return correo(this.id)" required>
                                </div>
                            </div>                           
                        </div>


                        <div class="row mt-4 mb-5">
                            <div class="col-6 w-50 input-group">
                                <label for="evento" class="input-group-text">Eventos<sup>* </sup></label>
                                    <select class="form-control" name="evento" id="evento" required>
                                        <option value="">-- Selecciona un evento --</option>
                                        <?php foreach ($datos['eventos'] as $even) : ?>
                                        <option value="<?php echo $even->id_evento?>"><?php echo $even->nombre ?></option>
                                        <?php endforeach ?>
                                    </select>
                            </div>
                        </div>
                    
                        <div class="row mb-1">
                            <p style="font-weight:bold;color:#0070c6;text-decoration:underline">Adjunta justificante de pago (formato foto .jpg)</p>
                        </div>
                        <div id="foto" class="row">
                            <input  accept="image/*" type="file" id="" name="subirFoto" required>
                        </div>
                       
                        <div class="row mt-5"> 
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


<script>

   var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src)
        }
    };


</script>