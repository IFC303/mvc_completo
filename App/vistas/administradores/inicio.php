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
                                ?> src='<?php echo RUTA_Icon?>usuario.png'<?php ;
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
                <div class="col-10 d-flex align-items-center justify-content-center"><span id="textoHead">Panel del administrador</span></div>
                <div class="col-2 mt-2 ">
                        <a type="button" id="botonLogout" class="btn"  href="<?php echo RUTA_URL ?>/login/logout">
                                <span>Logout</span>
                                <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
                        </a>
                </div>
        </div>                                   
        </header>




<article>

        <div class="row d-flex justify-content-center inicio" style="font-family: 'Doppio One', sans-serif;">

            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">      
                <div id="colorUsu" class="shadow-lg p-3 mb-3" style="height:130px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);"data-bs-toggle="offcanvas" data-bs-target="#menuUsu">
                    <div class="row">
                        <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:80px; height:80px; background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>usuario.png" width="60" height="60"></div>
                        <div class="col-8"><p style="margin-top:10px; margin-left:30px; font-size:20px">USUARIOS</p><p style="font-size:14px;margin-top:-15px;  margin-left:30px;">Altas, bajas y modificaciones de usuarios</p></div>
                    </div>                              
                </div>     
            </div>

            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">      
                <div id="colorSoli" class="shadow-lg p-3 mb-3" style="height:130px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);"data-bs-toggle="offcanvas" data-bs-target="#menuSol">
                    <div class="row">
                        <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:80px; height:80px; background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>solicitudes.png" width="60" height="60"></div>
                        <div class="col-8"><p style="margin-top:10px;  margin-left:30px; font-size:20px">SOLICITUDES</p><p style="font-size:14px; margin-top:-15px;  margin-left:30px;">Confirmacion y anulacion de solicitudes</p></div>
                    </div>                              
                </div>     
            </div>

            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">
                <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminGrupos">
                    <div id="colorMarcas" class="shadow-lg p-3 mb-3" style="height:130px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:80px; height:80px; background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>grupos.png" width="60" height="60"></div>
                            <div class="col-8"><p style="margin-top:10px;  margin-left:30px; font-size:20px">GRUPOS</p><p style="font-size:14px; margin-top:-15px;  margin-left:30px;">Visualiza y registra tus marcas</p></div>
                        </div>                              
                    </div> 
                </a>
            </div>

        </div>


<div class="row d-flex justify-content-center inicio" style="font-family: 'Doppio One', sans-serif;">


            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">
                <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminEventos">
                    <div id="colorMarcas" class="shadow-lg p-3 mb-3" style="height:130px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:80px; height:80px; background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>eventos.png" width="60" height="60"></div>
                            <div class="col-8"><p style="margin-top:10px;  margin-left:30px; font-size:20px">EVENTOS</p><p style="font-size:14px; margin-top:-15px;  margin-left:30px;">Creacion de nuevos eventos</p></div>
                        </div>                              
                    </div> 
                </a>
            </div>


            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">
                <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminLicencias">
                    <div id="colorMarcas" class="shadow-lg p-3 mb-3" style="height:130px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:80px; height:80px; background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>licencias.png" width="60" height="60"></div>
                            <div class="col-8"><p style="margin-top:10px;  margin-left:30px; font-size:20px">LICENCIAS</p><p style="font-size:14px;margin-top:-15px;   margin-left:30px;">Visualiza y registra tus marcas</p></div>
                        </div>                              
                    </div> 
                </a>
            </div>

            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">
                <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminEntidades">
                    <div id="colorMarcas" class="shadow-lg p-3 mb-3" style="height:130px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:80px; height:80px; background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>entidad.png" width="60" height="60"></div>
                            <div class="col-8"><p style="margin-top:10px;  margin-left:30px; font-size:20px">ENTIDADES</p><p style="font-size:14px; margin-top:-15px;  margin-left:30px;">Visualiza y registra tus marcas</p></div>
                        </div>                              
                    </div> 
                </a>
            </div>

</div>


<div class="row d-flex justify-content-center inicio" style="font-family: 'Doppio One', sans-serif;">

            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">      
                <div id="colorEquip" class="shadow-lg p-3 mb-3" style="height:130px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);"data-bs-toggle="offcanvas" data-bs-target="#menuEqui">
                    <div class="row">
                        <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:80px; height:80px; background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>carrito.png" width="60" height="60"></div>
                        <div class="col-8"><p style="margin-top:10px;  margin-left:30px; font-size:20px">EQUIPACIONES</p><p style="font-size:14px; margin-top:-15px;  margin-left:30px;">Gestion de pedidos y de nuevos</p></div>
                    </div>                              
                </div>     
            </div>


            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">
                <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminTemporadas">
                    <div id="colorMarcas" class="shadow-lg p-3 mb-3" style="height:130px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:80px; height:80px; background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>temporadas.png" width="60" height="60"></div>
                            <div class="col-8"><p style="margin-top:10px;  margin-left:30px; font-size:20px">TEMPORADAS</p><p style="font-size:14px;margin-top:-15px;   margin-left:30px;">Visualiza y registra tus marcas</p></div>
                        </div>                              
                    </div> 
                </a>
            </div>

            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">
                <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminRankings">
                    <div id="colorMarcas" class="shadow-lg p-3 mb-3" style="height:130px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:80px; height:80px; background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>ranking.png" width="60" height="60"></div>
                            <div class="col-8"><p style="margin-top:10px;  margin-left:30px; font-size:20px">RANKINGS</p><p style="font-size:14px;margin-top:-15px;   margin-left:30px;">Visualiza y registra tus marcas</p></div>
                        </div>                              
                    </div> 
                </a>
            </div>
            
</div>


<div class="row d-flex justify-content-center inicio" style="font-family: 'Doppio One', sans-serif;">

            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">      
                <div id="colorFact" class="shadow-lg p-3 mb-3" style="height:130px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);"data-bs-toggle="offcanvas" data-bs-target="#menuFac">
                    <div class="row">
                        <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:80px; height:80px; background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>euro.png" width="60" height="60"></div>
                        <div class="col-8"><p style="margin-top:10px;  margin-left:30px; font-size:20px">FACTURACION</p><p style="font-size:14px; margin-top:-15px;  margin-left:30px;">Visualiza y registra tus marcas</p></div>
                    </div>                              
                </div>     
            </div>

            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">
                <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminMensajeria">
                    <div id="colorMarcas" class="shadow-lg p-3 mb-3" style="height:130px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:80px; height:80px; background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>mensajeria.png" width="60" height="60"></div>
                            <div class="col-8"><p style="margin-top:10px;  margin-left:30px; font-size:20px">MENSAJERIA</p><p style="font-size:14px; margin-top:-15px;  margin-left:30px;">Visualiza y registra tus marcas</p></div>
                        </div>                              
                    </div> 
                </a>
            </div>

            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">
           
            </div>
            
</div>


    </article>



<!------------------------------ SUBMENUS LATERALES --------------------------->

<!-- USUARIOS -->
 <div class="menu1 offcanvas offcanvas-start" id="menuUsu" style="background-color:#0070c6;">
    <div id="home" class="offcanvas-header home">
        <img src="<?php echo RUTA_Icon ?>usuario.png" width="50" height="50">
        <h1 class="offcanvas-title text-white">USUARIOS</h1>
        <button style="background-color:white" type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>  
   <div>
    <a href="<?php echo RUTA_URL ?>/admin/crud_admin" class="tMenu nav-link text-white">ADMIN</span> </a>          
    <a href="<?php echo RUTA_URL ?>/admin/crud_entrenadores" class="tMenu nav-link text-white">ENTRENADORES</a>            
    <a href="<?php echo RUTA_URL ?>/admin/crud_socios" class="tMenu nav-link text-white">SOCIOS</a>  
    </div>   
</div>

<!-- SOLICITUDES -->
<div class=" menu1 offcanvas offcanvas-start" id="menuSol" style="background-color:#0070c6;">
    <div id="home" class="offcanvas-header home">
        <img src="<?php echo RUTA_Icon ?>solicitudes.png" width="50" height="50">
        <h1 class="offcanvas-title text-white">SOLICITUDES</h1>
        <button style="background-color:white" type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <a href="<?php echo RUTA_URL ?>/admin/crud_solicitudes_socios" class="tMenu nav-link text-white">SOCIOS<span class="badge bg-danger ms-3" id="notSoliGrupos"><?php print_r($datos['notificaciones'][0]);  ?></span></a>
    <a href="<?php echo RUTA_URL ?>/admin/crud_solicitudes_grupos" class=" tMenu nav-link text-white ">GRUPOS<span class="badge bg-danger ms-3" id="notSoliGrupos"><?php print_r($datos['notificaciones'][1]);  ?></span></a>         
    <!-- <a href="<?php echo RUTA_URL ?>/admin/crud_solicitudes_eventos/socio" class="tMenu nav-link text-white">EVENTOS<span class="badge bg-danger ms-3" id="notSoliGrupos"><?php print_r($datos['notificaciones'][2]);  ?></span></a>  -->
    <a href="<?php echo RUTA_URL ?>/externo/crud_solicitudes_eventos" class="tMenu nav-link text-white">EVENTOS<span class="badge bg-danger ms-3" id="notSoliGrupos"><?php print_r($datos['notificaciones'][2]);  ?></span></a> 
</div>

<!-- EQUIPACIONES -->
<div class="menu1 offcanvas offcanvas-start" id="menuEqui" style="background-color:#0070c6;">
    <div id="home" class="offcanvas-header home">
        <img src="<?php echo RUTA_Icon?>carrito.png" width="50" height="50">
        <h1 class="offcanvas-title text-white">EQUIPACIONES</h1>
        <button style="background-color:white" type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <a href="<?php echo RUTA_URL ?>/adminEquipaciones/pedidos" class="tMenu nav-link text-white">PEDIDOS <span class="badge bg-danger ms-3" id="notSoliGrupos"><?php print_r($datos['notificaciones'][3]);  ?></span></a>
    <a href="<?php echo RUTA_URL ?>/adminEquipaciones/gestion" class="tMenu nav-link text-white">GESTION</a>   
</div>

<!-- FACTURACION -->
<div class=" menu1 offcanvas offcanvas-start" id="menuFac" style="background-color:#0070c6;">
    <div id="home" class="offcanvas-header home">
        <img src="<?php echo RUTA_Icon ?>euro.png" width="50" height="50">
        <h1 class="offcanvas-title text-white">FACTURACION</h1>
        <button style="background-color:white" type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>            
    </div> 
    <a href="<?php echo RUTA_URL ?>/adminFacturacion/ingresos" class="tMenu nav-link text-white">INGRESOS</a>          
    <a href="<?php echo RUTA_URL ?>/adminFacturacion/gastos" class="tMenu nav-link text-white">GASTOS</a>      
    <a href="<?php echo RUTA_URL ?>/adminFacturacion/cuotas" class="tMenu nav-link text-white">CUOTAS</a>      
</div>


      

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>




<script>
    function colorear(icono) {
        icono.style.backgroundColor = '#ffbf1c';
    }

    function decolorear(icono) {
      icono.style.backgroundColor = '#ffffff';
    }
</script>