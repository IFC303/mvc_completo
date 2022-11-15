
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
    <title><?php echo NOMBRE_SITIO ?></title>
</head>


<style>


.licen:active, .marcas:active, .equi:active, .ins:active{
  transform: translateY(5px);
}

 .licen:hover, .marcas:hover, .equi:hover, .ins:hover{
    background-color:#ffbf1c;
    color:white;
} 

.dibu{
    width:50px;
    height:50px;
}

.licen{
    width:600px;
    height:75px;
    color: white;
    font-size: 20px;
    font-weight:bold;
    background-color:#264475;
}

.marcas{
    width:275px;
    height:75px;
    color: white;
    font-size: 20px;
    font-weight:bold;
    background-color:#abdbe3;
}

.equi{
    width:275px;
    height:75px;
    color: white;
    font-size: 20px;
    font-weight:bold;
    background-color:#1e81b0;
}


.ins{
    width:275px;
    height:75px;
    color: white;
    font-size: 20px;
    font-weight:bold;
    background-color:#264475;
}





</style>


<body>



    <section>

            <nav id="menuSocio">
                   
                    <a id="home" href="http://www.tragamillasalcaniz.com" class="nav-link ">   
                    <div class="mt-2 ">
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
                                        <p class="modal-title ms-3">Modificacion de datos</p> 
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
                                                            <div class="col-5">                         
                                                                <div class="input-group">
                                                                    <label for="nombre" class="input-group-text">Nombre <sup>*</sup></label>
                                                                    <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $datos['datos_user'][0]->nombre?>" readonly>    
                                                                </div>                           
                                                            </div> 
                                                            <div class="col-7">                     
                                                                <div class="input-group ">
                                                                    <label for="apellidos" class="input-group-text">Apellidos <sup>*</sup></label>
                                                                    <input type="text" class="form-control form-control-md" id="apellidos" name="apellidos" value="<?php echo $datos['datos_user'][0]->apellidos?>" readonly>
                                                                </div>            
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
                                                                    <input type="password" class="form-control form-control-md" id="password" name="password" value="<?php echo $datos['datos_user'][0]->passw?>" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-5">
                                                                <div class="input-group">
                                                                    <label for="talla" class="input-group-text">Talla</label>
                                                                    <select class="form-control form-control-md" name="talla" id="talla" required>
                                                                        <?php foreach ($datos['tallas'] as $talla) : ?>
                                                                        <option id="id_talla" value="<?php echo $talla->id_talla?>" <?php if($talla->id_talla==$datos['datos_user'][0]->talla) echo "selected";?>>
                                                                            <?php echo $talla->nombre?>
                                                                        </option>
                                                                        <?php endforeach ?>
                                                                    </select>
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
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Bienvendido al Club Tragamillas</span>
                </div>
                <div class="col-2 mt-2">
                    <a type="button" id="botonLogout" class="btn" href="<?php echo RUTA_URL ?>/login/logout">
                        <span>Logout</span>
                        <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
                    </a>
                </div>
            </div>                                   
        </header>
    <!----------------------------------------------------------------------->

<article style="margin-top:100px;">


        <div class="row d-flex justify-content-center inicio">
            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">    
                <a href="<?php echo RUTA_URL ?>/socio/verMarcas">  
                    <div id="colorEquip" class="shadow-lg p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);"data-bs-toggle="offcanvas" data-bs-target="#menuEqui">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center" id="dibu" style="background-color:#abdbe3"><img src="<?php echo RUTA_Icon ?>cronometro.png"></div>
                            <div class="col-8"><p class="nombre">MIS MARCAS</p><p class="descripcion">Añade nuevos modelos y gestiona pedidos</p></div>
                        </div>                              
                    </div>   
                </a>  
            </div>
            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">
                <a href="<?php echo RUTA_URL ?>/socio/eventos">
                    <div id="colorMarcas" class="shadow-lg p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " id="dibu" style="background-color:#1e81b0"><img src="<?php echo RUTA_Icon ?>eventos.png"></div>
                            <div class="col-8"><p class="nombre">EVENTOS</p><p class="descripcion">Inicia o cierra una temporada</p></div>
                        </div>                              
                    </div> 
                </a>
            </div>
            <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">
                <a href="<?php echo RUTA_URL ?>/socio/escuela">
                    <div id="colorMarcas" class="shadow-lg p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                        <div class="row">
                            <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center" id="dibu" style="background-color:#264475"><img src="<?php echo RUTA_Icon ?>escuela.png"></div>
                            <div class="col-8"><p class="nombre">ESCUELA</p><p class="descripcion">Visualiza informes y rankings</p></div>
                        </div>                              
                    </div> 
                </a>
            </div>           
        </div>
    
    <div class="row d-flex justify-content-center inicio">
        <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">
            <a data-bs-toggle="modal" data-bs-target="#licencia" >
                <div id="colorGrupos" class="shadow-lg p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <div class="row">
                        <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center" id="dibu" style="background-color:#264475"><img src="<?php echo RUTA_Icon ?>licencias.png"></div>
                        <div class="col-8"><p class="nombre">LICENCIAS</p><p class="descripcion">Crea y gestiona nuevos usuarios de la aplicacion</p></div>
                    </div>                              
                </div> 
            </a>
        </div>


        <div class="col-4 col-xs-12 col-md-6 pt-5 mx-5" style="width:400px">
            <a href="<?php echo RUTA_URL ?>/socio/equipacion">
                <div id="colorEventos" class="shadow-lg p-3 mb-3"  onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <div class="row">
                        <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center" id="dibu" style="background-color:#0070c6"><img src="<?php echo RUTA_Icon ?>carrito.png"></div>
                        <div class="col-8"><p class="nombre">EQUIPACIONES</p><p class="descripcion">Forma grupos y organiza sus alumnos</p></div>
                    </div>                              
                </div> 
            </a>
        </div>
                 
    </div>

</article>

      
                                           
     <!-- LICENCIAS-->
    <div class="modal fade" id="licencia">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
    <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                    <p class="modal-title ms-3 ">Mis Licencias</p> 
                    <button type="button" class="btn-close me-4 " onclick="cerrar();"  data-bs-dismiss="modal"></button>
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
                                <td><?php echo $licencias->fecha_cad?></td>
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



<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>



<script>

    function colorear(icono) {
        icono.style.backgroundColor = '#ffbf1c';
    }

    function decolorear(icono) {
        icono.style.backgroundColor = '#ffffff';
    }


    // function abrir() {
    //     var modal = document.getElementById('licencia');
    //     var body = document.getElementsByTagName("body")[0];
    //     modal.style.display = "block";
    //     body.style.overflow = "hidden";
    // }

    // function cerrar() {
    //     var modal = document.getElementById('licencia');
    //     var body = document.getElementsByTagName("body")[0];
    //     modal.style.display = "none";
    //     body.style.overflow = "visible";
    // }
    
</script>

<!-- 

<div class="container mt-5" style="border:solid red">


    <div class="row mt-5 mb-5 "style="border:solid red">
        <div class="col-6 mt-5 mb-5 d-flex justify-content-center" style="border:solid red">
        <a style="text-decoration:none; color:white;" href="<?php echo RUTA_URL ?>/socio/licencias"><button class="btn shadow-lg licen"><img class=" dibu me-4" src="<?php echo RUTA_Icon ?>licencias.png">LICENCIAS</button></a>
        </div>

        <div class="col-6 mt-5 mb-5 d-flex justify-content-center"style="border:solid red">
        <a style="text-decoration:none; color:white;" href="<?php echo RUTA_URL ?>/socio/verMarcas"><button class="btn shadow-lg marcas"><img class="dibu me-4" src="<?php echo RUTA_Icon ?>cronometro.png">MARCAS</button></a>
        </div>
    </div>


        <div class="row mt-5 mb-5 "style="border:solid red">

        <div class="col-6 mt-5 mb-5 d-flex justify-content-center"style="border:solid red">
        <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/socio/equipacion"> <button class="btn shadow-lg equi"><img class="dibu me-4" src="<?php echo RUTA_Icon ?>carrito.png">EQUIPACIONES</button></a>
        </div>
        <div class="col-6 mt-5 mb-5 d-flex justify-content-center"style="border:solid red">
        <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/socio/escuela"> <button class="btn shadow-lg ins"><img class=" dibu me-4" src="<?php echo RUTA_Icon ?>inscripciones.png">INSCRIPCIONES</button></a>
        </div>
                
        </div>

</div> 
                       

 -->




