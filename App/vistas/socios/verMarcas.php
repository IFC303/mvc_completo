<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/estilos-socio.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/estilos-admin.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300&display=swap" rel="stylesheet">   
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">


    <title>VER MARCAS</title>
</head>
<body style="background-color: #F5F5F5;">

    <div class="container-fluid min-vh-100 " style="border: solid; height: 100%;">

        <header class="p-5 row text-center">
            <div class="col-2" style="padding-left: 50px;"><div style="width: 50px; height: 50px; cursor:pointer;"  data-bs-toggle="offcanvas" data-bs-target="#menu1"><img src="<?php echo RUTA_Icon ?>menu.svg" width="50" height="50"></div></div>
            <div class="col-8"><a href="<?php echo RUTA_URL ?>/socio"><img src="<?php echo RUTA_Foto?>corredor.png" width="150"><img src="<?php echo RUTA_Foto?>letras.png" width="200" ></a></div>
            <div class="d-flex col-2 text-center">
                <div class="col-12">
                    <a aria-current="page" href="<?php echo RUTA_URL ?>/login/logout">
                        <img src="<?php echo RUTA_Icon ?>salirUsu.svg" width="50" height="50">
                    </a>
                    <br>
                    <?php echo $datos['usuarioSesion']->nombre ?>
                    <script type="text/javascript">
                        var d = new Date();
                        var minutes = d.getMinutes();
                        minutes = minutes > 9 ? minutes : '0' + minutes;
                        document.write(d.getHours() + ":" + minutes);
                    </script>
                </div>
            </div>
            <div class="col-12"><h1 id="titulo" style="font-family: 'Anton',sans-serif; color: #2B2B2B; font: bold; letter-spacing: 5px;">MARCAS PERSONALES</h1></div>

            <!--MENU-->
            <div class="offcanvas offcanvas-start" id="menu1">
                <div class="offcanvas-header">
                    <a href="<?php echo RUTA_URL ?>/socio"><img src="<?php echo RUTA_Icon ?>inicio.svg" width="50" height="50"></a>
                    <a href="<?php echo RUTA_URL ?>/socio"><h1 class="offcanvas-title">INICIO</h1></a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>

                <!--MENU MODIFICAR DATOS-->
                <ul id="mInicioDatos">
                    <li id="mInicioDatos">
                        <a href="<?php echo RUTA_URL ?>/socio/modificarDatos" class="nav-link px-0 align-middle">
                            <div id="imgMenu"><img src="<?php echo RUTA_Icon?>editar.svg" width="35" height="35"></div>
                            <div class="col-12">MODIFICAR DATOS</div>
                        </a>
                    </li>
                </ul>

                <!--MENU LICENCIAS-->
                <ul id="mInicioLic">
                    <li id="mInicioLic">
                        <a href="<?php echo RUTA_URL ?>/socio/subirLicencias" class="nav-link px-0 align-middle">
                            <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>licencias.svg" width="35" height="35"></div>
                            <div class="col-12">SUBIR LICENCIAS</div>
                        </a>
                    </li>
                </ul>

                <!--MENU VER MARCAS-->
                <ul id="mInicioMarcas">
                    <li id="mInicioMarcas">
                        <a href="<?php echo RUTA_URL ?>/socio/verMarcas" class="nav-link px-0 align-middle">
                            <div id="imgMenu"><img src="<?php echo RUTA_Icon?>cronometro.svg" width="35" height="35"></div>
                            <div class="col-12">VER MARCAS</div>
                        </a>
                    </li>
                </ul>

                <div class="d-flex offcanvas-footer justify-content-center h-100 align-items-end">
                    <a href="<?php echo RUTA_URL ?>/socio"><img class="mi-imagen-abajo-derecha img-fluid w-50" id="logo" src="<?php echo RUTA_Foto ?>/logo_tragamillas.png"></a>
                </div>
            </div>
        </header>    
    
        <div  style="border:solid 1px #023ef9; height: 1%">
        <table class="table table-striped text-center" style = "margin: 0px;"> 
            <thead class="cabezera">
                <tr>
                        <th scope="col">#</th>
                        <th scope="col">Prueba</th>
                        <th scope="col">Tipo prueba</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Tipo Test</th>
                
                </tr>
            </thead>
            <tbody>
                
                <?php $contador = 0 ;
                foreach ($datos['usuarios'] as $marcas) : ?>
                    <?php $contador = $contador +1; ?>
                    <tr>
                        <td scope="row"><?php echo $contador ?></td>
                        <td scope="col"><?php if ($marcas->nombrePrueba==''){echo '-';}else {echo $marcas->nombrePrueba;}?></td>
                        <td scope="col"><?php if ($marcas->tipo==''){echo '-';}else {echo $marcas->tipo;}?></td>
                        <td scope="col"><?php if ($marcas->marca==''){echo '-';}else {echo $marcas->marca;}?></td>
                        <td scope="col"><?php if ($marcas->fecha==''){echo '-';}else {echo $marcas->fecha;}?></td>
                        <td scope="col"><?php if ($marcas->nombreTest==''){echo '-';}else {echo $marcas->nombreTest;}?></td>
                    </tr>
                    
                <?php endforeach ?>
                
            </tbody>
            
        </table>
    
        </div>
        

        
    </div>

    
</body>
</html>