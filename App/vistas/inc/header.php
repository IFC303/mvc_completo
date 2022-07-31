<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">
    <title><?php echo NOMBRE_SITIO ?></title>
</head>


<body>
<div class="container-fluid min-vh-100">
        <header class="p-4 row" id="header">

                <!--LOGO -->
                <div class="col-6 col-md-3 order-1 order-md-1"><img id="logoHeader" src="<?php echo RUTA_Foto ?>/logo_tragamillas.png" ></div>
                
                <!--TEXTO -->
                <div class="col-xs-12 col-md-7 text-center order-3 order-md-2">
                    <h1 id="tituloHeader">Bienvenid@ <?php echo $datos['usuarioSesion']->nombre?></h1>
                </div>

                <!--LOGIN Y RELOJ-->
                <div class="d-flex col-6 col-md-2 justify-content-end order-2 order-md-3 text-center">
                    <div class="col-12">
                        <a aria-current="page" href="<?php echo RUTA_URL ?>/login/logout">
                            <img id="salirHeader" src="<?php echo RUTA_Icon ?>salirUsu.svg">
                        </a>
                        <br>
                        <?php echo $datos['usuarioSesion']->nombre?>
                        <span id="reloj"></span>
                        <script type="text/javascript">
                            setInterval("verHora()", 500);
                            function verHora(){
                                let d = new Date();
                                let minutes = d.getMinutes();
                                minutes = minutes > 9 ? minutes : '0' + minutes;
                                let reloj = d.getHours() + ":" + minutes
                                document.getElementById("reloj").innerHTML = reloj;
                            }
                        </script>
                    </div>
                </div>
        </header> 

 
