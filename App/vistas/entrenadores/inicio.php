

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


<!--#2da9cdbackground-color:#4e83c9  #0f41b9-->

    <section>

            <nav class="menu1" id="menu1">
         
                <a id="home" href="http://www.tragamillasalcaniz.com" class="nav-link">   
                <div class="mt-2">
                    <img style="width:100px; height:60px;"  src="<?php echo RUTA_Icon ?>corredor.png">
                    <img style="width:200px; height:60px;"  src="<?php echo RUTA_Icon ?>todo2.png"> 
                </div>                                        
                </a>   


                <div class="row d-flex align-items-center justify-content-center">
                <div class="card shadow-lg mt-5 w-75 h-75">

                    <img class="card-img mt-3" <?php if ($datos['usuarioSesion']->foto==''){
                                ?> src='<?php echo RUTA_Icon?>usuario.svg'<?php ;
                                }else {?> src='<?php echo RUTA_ImgDatos.$datos['usuarioSesion']->id_usuario.'.jpg';} ?>' width="275" height="275">


                    <div class="card-body">
                        <h4 class="card-title mb-4 text-center"><?php echo $datos['usuarioSesion']->nombre." ".$datos['usuarioSesion']->apellidos?></h4>

                        <p class="card-text" style="margin-bottom:4px">Numero de socio: <?php echo $datos['usuarioSesion']->id_usuario?></p>
                        <p class="card-text" style="margin-bottom:4px">Telefono: <?php echo $datos['usuarioSesion']->telefono?></p> 
                        <p class="card-text" >Email: <?php echo $datos['usuarioSesion']->email?></p>   
                            
                        <div class="d-flex justify-content-center">
                            <a type="button" href="<?php echo RUTA_URL ?>/socio/modificarDatos"  class="d-flex align-center mt-4 mb-4 p-2 px-3 text-white" style="background-color: #0b2a85;text-decoration:none"><img class="me-2" src="<?php echo RUTA_Icon ?>editar.png" width="25" height="25">Mis datos</a>
                        </div>

                    </div>    

                </div>
                </div>

            </nav>

  
        <header>
        <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center"><span id="textoHead">Panel del entrenador</span></div>
                <div class="col-2 mt-2 ">
                        <a type="button" id="botonLogout" class="btn"  href="<?php echo RUTA_URL ?>/login/logout">
                                <span>Logout</span>
                                <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
                        </a>
                </div>
        </div>                                   
        </header>
  

            <article>
                <div class="row d-flex justify-content-center align-items-center mt-5" style="font-family: 'Doppio One', sans-serif;">

                                 
                        <div class="col-6 col-xs-12 col-md-6 pt-5 mx-5" style="width:450px">
                            <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/entrenador/grupos">
                                <div id="colorMarcas" class="shadow-lg p-3 mb-3" style="height:150px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);">                               
                                    <div class="row">
                                        <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:100px; height:100px; background-color:#264475"><img src="<?php echo RUTA_Icon ?>grupos.png" width="60" height="60"></div>
                                        <div class="col-8"><p style="margin-top:25px;  margin-left:30px; font-size:20px">GRUPOS</p><p style="font-size:14px;  margin-left:30px;">Visualiza y registra tus marcas</p></div>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-6 col-xs-12 col-md-6 pt-5 mx-5" style="width:450px">
                            <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/entrenador/test">
                                <div id="colorMarcas" class="shadow-lg p-3 mb-3" style="height:150px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);">                               
                                    <div class="row">
                                        <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:100px; height:100px; background-color:#abdbe3"><img src="<?php echo RUTA_Icon ?>cronometro.png" width="60" height="60"></div>
                                        <div class="col-8"><p style="margin-top:25px;  margin-left:30px; font-size:20px">TEST</p><p style="font-size:14px;  margin-left:30px;">Visualiza y registra tus marcas</p></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                </div>


                <div class="row d-flex justify-content-center inicio" style="font-family: 'Doppio One', sans-serif;">

                        <!-- MENU PEDIR EQUIPACION -->
                        <div class="col-6 col-xs-12 col-md-6 pt-5 mx-5" style="width:450px">
                            <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/entrenador/mensajeria">
                                <div id="colorMarcas" class="shadow-lg p-3 mb-3" style="height:150px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                                    <div class="row">
                                        <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:100px; height:100px; background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>mensajeria.png" width="60" height="60"></div>
                                        <div class="col-8"><p style="margin-top:25px;  margin-left:30px; font-size:20px">MENSAJERIA</p><p style="font-size:14px;  margin-left:30px;">Visualiza y registra tus marcas</p></div>
                                    </div>                              
                                </div> 
                            </a>
                        </div>

                </div>
            </article>
 


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>



<script>
    function colorear(icono) {
        icono.style.backgroundColor = '#ffbf1c';
    }
    function decolorear(icono) {
        icono.style.backgroundColor = '#ffffff';
    }
</script>


