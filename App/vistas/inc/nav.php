
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">

    <script src="jquery-1.3.2.min.js" type="text/javascript"></script>   
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">
</head>


<body>


    <section>

        <nav class="menu1" id="menuSocio">
      
            <a id="home" href="<?php echo RUTA_URL ?>/socio" class="nav-link">
                <img id="imgHome" src="<?php echo RUTA_Icon ?>inicio.png"><span class="tHome">INICIO</span>                                                 
            </a>      
            <a href="<?php echo RUTA_URL ?>/socio/verMarcas" class="nav-link">                           
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>cronometro.png"><span class="tMenu">MIS MARCAS</span>                                                          
            </a> 
            <a href="<?php echo RUTA_URL ?>/socio/eventos" class="nav-link">                           
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>eventos.png"><span class="tMenu">EVENTOS</span>                                                          
            </a> 
            <a href="<?php echo RUTA_URL ?>/socio/escuela" class="nav-link">                           
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>escuela.png"><span class="tMenu">ESCUELA</span>                                                          
            </a>                                             
            <a data-bs-toggle="modal" data-bs-target="#licencia" class="nav-link" >
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>licencias.png"><span class="tMenu">LICENCIAS</span>
            </a>                                                 
            <a href="<?php echo RUTA_URL ?>/socio/equipacion" class="nav-link">
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>carrito.png"><span class="tMenu">EQUIPACION</span>
            </a>      
        </nav>



         <!-- LICENCIAS-->
         <div class="modal fade" id="licencia">
        <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                    <p class="modal-title ms-3 ">Mis Licencias</p> 
                    <button type="button" class="btn-close me-4 " data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info ">                         
                <div class="row ms-1 me-1 mb-5"> 
                    
                <table class="table">
                    <!--CABECERA TABLA-->
                    <thead>
                        <tr>
                            <th>Numero</th>  
                            <th>GIR</th>
                            <th>Tipo</th>
                            <th>Autonomica/Nacional</th>      
                            <th>Dorsal</th>
                            <th>Fecha caducidad</th>
                            <th>Imagen</th>                                                
                        </tr>
                    </thead>
                    <!--BODY TABLA-->
                    <tbody>               
                        <?php foreach ($datos['usu_licencia'] as $licencias) :?>
                            <tr>
                                <td><?php echo $licencias->num_licencia?></td>
                                <td><?php echo $datos['datos_user'][0]->gir?></td>
                                <td><?php echo $licencias->tipo?></td>
                                <td><?php echo $licencias->regional_nacional?></td>
                                <td><?php echo $licencias->dorsal?></td>
                                <td><?php echo date("d/m/Y", strtotime($licencias->fecha_cad))?></td>
                                <td>
                                        <?php if ($licencias->imagen==''){
                                            echo '-';
                                        }else {?> 

                                            <a href="<?php echo RUTA_URL ?>/socio/ver_lice/<?php echo $licencias->id_licencia?>">
                                                <img class="icono" src="<?php echo RUTA_Icon ?>foto.svg"></img>
                                            </a>

                                        <?php } ?>

                                </td>

                            </tr>                   
                        <?php endforeach ?>                
                    </tbody>      
                </table>
                  
                </div>
                </div>

        </div>
        </div>
        </div>

        


<script>
    function colorear(icono) {
        icono.style.backgroundColor = '#ffbf1c';
    }
    function decolorear(icono) {
        icono.style.backgroundColor = '#ffffff';
    }
</script>