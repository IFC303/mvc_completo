<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/estilos-socio.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">


    <title>SOCIO</title>
</head>
<body style="background-color: #F5F5F5;">
    <div class="container-fluid min-vh-100" style="border: solid; height: 100%;">
        <header class="p-5 row"> 
            <div class="col-3" ><img id="logo" src="<?php echo RUTA_Foto?>logo_tragamillas.png" width="150"></div>
            <div class="col-7 text-center"><h1 id="titulo" style="font-family: 'Anton',sans-serif; color: #023EF9; font: bold; letter-spacing: 5px;">ZONA SOCIO</h1></div>
            <div class="col-2 text-center"><a href="<?php echo RUTA_URL ?>/login/logout"><img src="<?php echo RUTA_Icon?>salirUsu.svg" width="50" height="50"></a><br><?php echo $datos['usuarioSesion']->nombre ?></div>
        </header>