
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos-inicio.css">
   
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
                            <h4 class="card-title mb-4 text-center"><?php echo $datos['datos_user'][0]->nombre." ".$datos['datos_user'][0]->apellidos?></h4>

                            <p class="card-text" style="margin-bottom:4px">Numero de socio: <?php echo $datos['datos_user'][0]->id_usuario?></p>
                            <p class="card-text" style="margin-bottom:4px">Telefono: <?php echo $datos['datos_user'][0]->telefono?></p> 
                            <p class="card-text" >Email: <?php echo $datos['datos_user'][0]->email?></p>    
                            
                            
                            <!------------------------------ MODAL MODIFICACION DE DATOS -------------------------------->

                            <div class="d-flex justify-content-center ">
                                <a type="button" data-bs-toggle="modal" data-bs-target="#modiDatos" class="d-flex align-center mt-4 mb-4 p-2 px-3 text-white modDatos">
                                <img class="me-2" src="<?php echo RUTA_Icon ?>editar.png" width="25" height="25">Mis datos</a>
                            </div>

                        <div class="modal fade" id="modiDatos">
                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">

                                     <!-- Modal Header -->
                                    <div class="modal-header azul">
                                        <p class="modal-title ms-3">Modificacion</p> 
                                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                    </div>

                                        <!-- Modal body -->
                                        <div class="modal-body info mb-3">  
                                        <form action="<?php echo RUTA_URL?>/admin/modi_datos"  enctype="multipart/form-data" method="post">

                                            <div class="container">
                                                <div class="row mt-4">

                                                    <div class="col-4">
                                                        <div>
                                                            <img id="output" 
                                                            <?php if ($datos['datos_user'][0]->foto==''){
                                                            ?> src='<?php echo RUTA_Icon?>usuario.svg' <?php ;
                                                            }else {?> src='<?php echo RUTA_ImgDatos.$datos['datos_user'][0]->id_usuario.'.jpg';} ?>' width="300" height="320">
                                                        </div>                                    
                                                        <div class="mt-3">
                                                            <input  accept="image/*" type="file"  onchange="loadFile(event)" id="editarFoto" name="editarFoto">
                                                        </div>
                                                    </div>

                                                    <div class="col-8">
                                                        <div class="row mb-4">                         
                                                            <div class="input-group">
                                                                <label for="nombre" class="input-group-text">Nombre <sup>*</sup></label>
                                                                <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $datos['datos_user'][0]->nombre?>" required>    
                                                            </div>                           
                                                        </div> 
                                                        <div class="row mb-4">                     
                                                            <div class="input-group ">
                                                                <label for="apellidos" class="input-group-text">Apellidos <sup>*</sup></label>
                                                                <input type="text" class="form-control form-control-md" id="apellidos" name="apellidos" value="<?php echo $datos['datos_user'][0]->apellidos?>" required>
                                                            </div>            
                                                        </div>  

                                                        <div class="row mb-4">
                                                            <div class="col-5">
                                                                <div class="input-group">
                                                                    <label for="dni" class="input-group-text" id="dniObli">DNI <sup>*</sup></label>
                                                                    <input type="text" class="form-control form-control-md" id="dni" name="dni" value="<?php echo $datos['datos_user'][0]->dni?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-7">
                                                                <div class="input-group">
                                                                    <label for="fecha_naci" class="input-group-text">Fecha Nacimiento <sup>*</sup></label>
                                                                    <input type="date" class="form-control form-control-md" id="fecha_naci" name="fecha_naci" value="<?php echo $datos['datos_user'][0]->fecha_nacimiento?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                
                                                        <div class="row mb-4">
                                                            <div class="input-group">
                                                                <label for="direccion" class="input-group-text">Direccion</label>
                                                                <input type="text" class="form-control form-control-md" id="direccion" name="direccion" value="<?php echo $datos['datos_user'][0]->direccion?>" required>
                                                            </div> 
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-5">
                                                                <div class="input-group">
                                                                    <label for="telefono" class="input-group-text">Telefono <sup>*</sup></label>
                                                                    <input type="text" class="form-control form-control-md" id="telefono" name="telefono" value="<?php echo $datos['datos_user'][0]->telefono?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-7">
                                                                <div class="input-group">
                                                                    <label for="email" class="input-group-text">Email <sup>*</sup></label>
                                                                    <input type="text" class="form-control form-control-md" id="email" name="email" value="<?php echo $datos['datos_user'][0]->email?>" required>
                                                                </div>
                                                            </div>
                                                        </div> 

                                                        <div class="row mb-4">
                                                            <div class="input-group">
                                                                <label for="ccc" class="input-group-text">Numero cuenta</label>
                                                                <input type="text" class="form-control form-control-md" name="ccc" id="ccc" value="<?php echo $datos['datos_user'][0]->cuenta?>"> 
                                                            </div> 
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-7">
                                                            <div class="input-group">
                                                                    <label for="password" class="input-group-text">Contraseña</label>
                                                                    <input type="password" class="form-control form-control-md" id="password" name="password" value="<?php echo $datos['datos_user'][0]->passw?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-5">
                                                                <div class="input-group">
                                                                    <label for="talla" class="input-group-text">Talla</label>
                                                                    <input type="text" class="form-control form-control-md" name="talla" id="talla" value="<?php echo $datos['datos_user'][0]->talla?>" required> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row"> 
                                                    <div class="d-flex justify-content-end">
                                                        <input type="submit" class="btn mt-4 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                                                    </div>
                                                </div>

                                            </div>

                                        </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                    </div>    

                </div>
                </div>

        </nav>

  

    <!------------------------------ CABECERA -------------------------------->
    <header>
        <div class="row mb-5">
            <div class="col-10 d-flex align-items-center justify-content-center ">
                <span id="textoHead">Bienvendido al Club Tragamillas</span>
            </div>
            <div class="col-2 mt-1">
                <a href="<?php echo RUTA_URL ?>/login/logout">
                    <button class="btn" id="btn_logout"><img class="me-2" src="<?php echo RUTA_Icon ?>logout.png">Logout</button>
                </a>
            </div>            
        </div>                                   
    </header>
    <!----------------------------------------------------------------------->
  
    <article class="row d-flex justify-content-center" style="margin-top:75px;">
    

        <div class="row d-flex justify-content-center inicio pt-5">
            <div class="col-4 col-xs-12 col-md-6 me-4" style="width:400px">
                <a href="<?php echo RUTA_URL ?>/entrenador/grupos">
                    <div id="colorGrupos" class="shadow-lg p-3 mb-3 escu" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center" id="dibu" style="background-color:#264475"><img src="<?php echo RUTA_Icon ?>escuela.png"></div>
                            <div class="col-8"><p style="color:#264475" class="nombre">ESCUELA</p><p class="descripcion">Lleva un seguimiento de todos tus atletas y grupos</p></div>
                        </div>                              
                    </div> 
                </a>
            </div>
            <div class="col-4 col-xs-12 col-md-6" style="width:400px">  
                <a href="<?php echo RUTA_URL ?>/entrenador/test">    
                    <div id="colorTest" class="shadow-lg p-3 mb-3 test"  onmouseover="colorear(this);" onmouseleave="decolorear(this);"data-bs-toggle="offcanvas" data-bs-target="#menuSol">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center" id="dibu" style="background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>inscripciones.png"></div>
                            <div class="col-8"><p  style="color:#1e81b0" class="nombre">PRUEBAS Y TEST</p><p class="descripcion">Crea y edita tus propios test y asocia pruebas</p></div>
                        </div>                              
                    </div> 
                </a>    
            </div>
        </div>

        <div class="row d-flex justify-content-center inicio pt-4">
            <div class="col-4 col-xs-12 col-md-6 me-4" style="width:400px">
                <a href="<?php echo RUTA_URL ?>/entrenador/eventos">
                    <div id="colorEventos" class="shadow-lg p-3 mb-3 even"  onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center" id="dibu" style="background-color:#abdbe3"><img src="<?php echo RUTA_Icon ?>eventos.png"></div>
                            <div class="col-8"><p style="color:#abdbe3" class="nombre">EVENTOS</p><p class="descripcion">Lleva el control de las marcas de los participantes</p></div>
                        </div>                              
                    </div> 
                </a>
            </div>
            <div class="col-6 col-xs-12 col-md-6" style="width:400px">    
                <a href="<?php echo RUTA_URL ?>/socio/verMarcas">  
                    <div id="colorEquip" class="shadow-lg p-3 mb-3 marcas"  onmouseover="colorear(this);" onmouseleave="decolorear(this);"data-bs-toggle="offcanvas" data-bs-target="#menuEqui">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center" id="dibu" style="background-color:#0070c6"><img src="<?php echo RUTA_Icon ?>cronometro.png"></div>
                            <div class="col-8"><p class="nombre" style="color: #0070c6">MIS MARCAS</p><p class="descripcion w-100">Registra tus marcas personales y sigue tu evolucion</p></div>
                        </div>                              
                    </div>   
                </a>  
            </div>                     
        </div>

        <div class="row d-flex justify-content-center inicio pt-4 ">           
            <div class="col-6 col-xs-12 col-md-6 me-4" style="width:400px">
                <a href="<?php echo RUTA_URL ?>/entrenador/equipacion">
                    <div id="colorEventos" class="shadow-lg p-3 mb-3 equi" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center" id="dibu" style="background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>carrito.png"></div>
                            <div class="col-8"><p class="nombre" style="color:#1e81b0"> EQUIPACIONES</p><p class="descripcion">Realiza pedidos de la equipacion oficial del club</p></div>
                        </div>                              
                    </div> 
                </a>
            </div>  
            <div class="col-4 col-xs-12 col-md-6" style="width:400px">
                <a href="<?php echo RUTA_URL ?>/entrenador/mensajeria">
                    <div id="colorMensajeria" class="shadow-lg p-3 mb-3 mensajeria"  onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center" id="dibu" style="background-color:#264475"><img src="<?php echo RUTA_Icon ?>mensajeria.png"></div>
                            <div class="col-8"><p style="color:#264475" class="nombre">MENSAJERIA</p><p class="descripcion">Manda mensajes o comunicados a tus grupos</p></div>
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


