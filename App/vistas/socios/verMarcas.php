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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300&display=swap" rel="stylesheet">
    


    <title>VER MARCAS</title>
</head>
<body style="background-color: #F5F5F5;">

    <div class="container-fluid min-vh-100 " style="border: solid; height: 100%;">

        <header class="p-5 row text-center">
        <div class="col-2"></div>
            <div class="col-8"><a href="<?php echo RUTA_URL ?>/socio/index"><img src="<?php echo RUTA_Foto?>corredor.png" width="150"><img src="<?php echo RUTA_Foto?>letras.png" width="200" ></a></div>
            <div class="col-2 text-center"><a href="<?php echo RUTA_URL ?>/login/logout"><img src="<?php echo RUTA_Icon?>salirUsu.svg" width="50" height="50"></a><br><?php echo $datos['usuarioSesion']->nombre ?></div>
            <div class="col-12"><h1 id="titulo" style="font-family: 'Anton',sans-serif; color: #2B2B2B; font: bold; letter-spacing: 5px;">MARCAS PERSONALES</h1></div>
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
                        <td scope="col"><?php echo $marcas->nombre ?></td>
                        <td scope="col"><?php echo $marcas->tipo ?></td>
                        <td scope="col"><?php echo $marcas->marca ?></td>
                        <td scope="col"><?php echo $marcas->fecha ?></td>
                        <td scope="col"><?php echo $marcas->nombreTest ?></td>
                    </tr>
                    
                <?php endforeach ?>
                
            </tbody>
            
        </table>
    
        </div>
        

        
    </div>

    
</body>
</html>