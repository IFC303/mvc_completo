
<?php require_once RUTA_APP . '/vistas/inc/header.php'?>
<link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">



                 <!--BOTON MENU LATERAL-->
                <nav class="row">            
                <div class="col-12 order-4" id="fotoMenu">
                    <div style="width: 50px; height: 50px; cursor:pointer;" data-bs-toggle="offcanvas" data-bs-target="#menu1">
                        <img src="<?php echo RUTA_Icon ?>menu.svg" width="50" height="50">
                    </div>
                </div>
                </nav>

                <!--MENU LATERAL-->
                <div class="menu1 offcanvas offcanvas-start" id="menu1">    

                        <!--INICIO-->
                        <div class="offcanvas-header home">
                            <a id="home" href="<?php echo RUTA_URL ?>/socio" class="nav-link align-middle">
                            <div class="row">
                                <div class="col-4">
                                    <img class="imgHome" style="width:75px; height:75px" src="<?php echo RUTA_Icon ?>inicio.svg">
                                </div>
                                <div class="col-7 mt-3"><h1>INICIO</h1></div>                                
                            </div>                      
                            </a>                       
                            <button type="button" class="btn-close text-reset me-3" data-bs-dismiss="offcanvas"></button>
                        </div>                              
                        <!--OPCIONES-->
                        <a href="<?php echo RUTA_URL ?>/socio/modificarDatos" class="nav-link align-middle" >
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>editar.svg"><span class="tMenu">MIS DATOS</span>
                        </a>                          
                        <a href="<?php echo RUTA_URL ?>/socio/licencias" class="nav-link align-middle">
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>licencias.svg"><span class="tMenu">LICENCIAS</span>
                        </a>                           
                        <a href="<?php echo RUTA_URL ?>/socio/verMarcas" class="nav-link  align-middle">                           
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>cronometro.svg"><span class="tMenu">MARCAS</span>                                                          
                        </a>                           
                        <a href="<?php echo RUTA_URL ?>/socio/equipacion" class="nav-link align-middle">
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>carrito.svg"><span class="tMenu">EQUIPACION</span>
                        </a>
                        <a href="<?php echo RUTA_URL ?>/socio/escuela" class="nav-link align-middle">
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>escuela.svg"><span class="tMenu">ESCUELA</span>
                        </a>   
                                                          
                </div>


               