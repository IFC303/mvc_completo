
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


    <section>

        <nav class="menu1" id="menu1">
      
            <a id="home" href="<?php echo RUTA_URL ?>/socio" class="nav-link">
                <img id="imgHome" src="<?php echo RUTA_Icon ?>inicio.png"><span class="tHome">INICIO</span>                                                 
            </a>                                     

            <a href="<?php echo RUTA_URL ?>/socio/modificarDatos" class="nav-link">
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>editar.png"><span class="tMenu">MIS DATOS</span>
            </a>                          
            <a href="<?php echo RUTA_URL ?>/socio/licencias" class="nav-link" >
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>licencias.png"><span class="tMenu">LICENCIAS</span>
            </a>                           
            <a href="<?php echo RUTA_URL ?>/socio/verMarcas" class="nav-link">                           
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>cronometro.png"><span class="tMenu">MARCAS</span>                                                          
            </a>                           
            <a href="<?php echo RUTA_URL ?>/socio/equipacion" class="nav-link">
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>carrito.png"><span class="tMenu">EQUIPACION</span>
            </a>
            <a href="<?php echo RUTA_URL ?>/socio/escuela" class="nav-link">
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>inscripciones.png"><span class="tMenu">INSCRIPCIONES</span>
            </a>   
       
        </nav>


        

