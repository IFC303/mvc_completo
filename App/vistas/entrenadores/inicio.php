<?php require_once RUTA_APP . '/vistas/inc/header_entrenador.php' ?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css" integrity="sha384-7ynz3n3tAGNUYFZD3cWe5PDcE36xj85vyFkawcF6tIwxvIecqKvfwLiaFdizhPpN" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/estilos.css">
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <title><?php echo NOMBRE_SITIO ?></title>

</head>

<body>

    <div class="container-fluid">

        <main class="row">

            <div class="col text-center">
                <a href="<?php echo RUTA_URL ?>/entrenador/grupos">
                    <div id="icon">
                        <div id="iconColor" onmouseover="colorear();" onmouseout="decolorear();">
                            <img src="<?php echo RUTA_Icon ?>grupos.svg" width="100" height="100"></img>
                        </div>
                        <p id="pIcon" onmouseover="colorear();" onmouseout="decolorear();">GRUPOS</p>
                    </div>
                </a>
            </div>


            <div class="col text-center">
                <a href="<?php echo RUTA_URL ?>/entrenador/test">
                    <div id="icon">
                        <div id="iconColor2">
                            <img src="<?php echo RUTA_Icon ?>cronometro.svg" width="100" height="100"></img>
                        </div>
                        <p id="pIcon">TEST</p>
                    </div>
                </a>
            </div>


            <div class="col text-center">
                <a href="<?php echo RUTA_URL ?>/entrenador/mensajeria">
                    <div id="icon">
                        <div id="iconColor2">
                            <img src="<?php echo RUTA_Icon ?>mensajeria.svg" width="100" height="100"></img>
                        </div>
                        <p id="pIcon">MENSAJERIA</p>
                    </div>
                </a>
            </div>



        </main>


    </div>



    <script>
        function colorear() {
            document.getElementById('iconColor').style.backgroundColor = '#ffbf1c';
        }

        function decolorear() {
            document.getElementById('iconColor').style.backgroundColor = '#f5f5f5';
        }
    </script>




    <?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>




