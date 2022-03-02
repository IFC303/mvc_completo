<?php foreach ($datos['usuarios'] as $datosUser) : ?>


<?php 



    if (isset($_POST['guardar'])) {

        if ($_POST['dni']=="") {
        $nuevoDni = $datosUser->dni;
        }else {
        $nuevoDni = $_POST['dni'];
        } 

        if ($_POST['nombre']=="") {
        $nuevoNombre = $datosUser->nombre;
        }else {
        $nuevoNombre = $_POST['nombre'];
        } 

        if ($_POST["apellidos"]=="") {
        $nuevoApellido = $datosUser->apellidos; 
        }else {
        $nuevoApellido = $_POST["apellidos"];
        }

        if ($_POST["telefono"]=="") {
        $nuevoTelefono = $datosUser->telefono;
        }else {
        $nuevoTelefono = $_POST["telefono"];
        }

        if ($_POST["email"]=="") {
        $nuevoEmail = $datosUser->email;
        }else {
        $nuevoEmail = $_POST["email"];
        }

        if ($_POST["ccc"]=="") {
        $nuevoCCC = $datosUser->CCC;
        }else {
        $nuevoCCC = $_POST["ccc"];
        }
        /*
        if ($_POST["passw"]=="") {
        $nuevaContra = $datosUser->passw;
        }else {
        $nuevaContra = $_POST["passw"];
        }*/

        if ($_POST["talla"]=="") {
        $nuevaTalla = $datosUser->talla;
        }else {
        $nuevaTalla = $_POST["talla"];
        }


        echo $nuevoDni.'-'.$nuevoNombre.'-'.$nuevoApellido.'-'.$nuevoTelefono.'-'.$nuevoEmail.'-'.$nuevoCCC.'-'.$nuevaTalla;

    }


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos-socio.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos-admin.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300&display=swap" rel="stylesheet">
    


    <title>MODIFICAR DATOS</title>
</head>
<body style="background-color: #F5F5F5;">

    <div class="container-fluid min-vh-100" style="border: solid; height: 100%;">

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
            <div class="col-12"><h1 id="titulo" style="font-family: 'Anton',sans-serif; color: #2B2B2B; font: bold; letter-spacing: 5px;">MODIFICAR DATOS</h1></div>

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
                        <a href="<?php echo RUTA_URL ?>/socio/licencias" class="nav-link px-0 align-middle">
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
        <div class="row">
            <div class="col-4 text-center">
                <div class="row" style="height: 100%;">
                
                    <div class="col-12"><img id="output" <?php if ($datosUser->foto=='') {?> src='<?php echo RUTA_Icon?>usuario.svg'<?php ;}else { echo $datosUser->foto;} ?> width="350" height="450" style="border: solid; color: #023EF9;"></div>
                    <div class="col-12"><label for="editarFoto" class="editarFoto">EDITAR FOTO</label><br><input  accept="image/*" type="file"  onchange="loadFile(event)" style="visibility:hidden;" id="editarFoto" name="editarFoto"> </div>
                </div> 
            
            </div>
            <div class="col-4">
                <div class="row" style="padding-left: 5cm; font-family: 'Inter', sans-serif;">
                    <div class="datos col-12" >DNI</div>
                    <div class="datos col-12" >NOMBRE</div>
                    <div class="datos col-12" >APELLIDOS</div>   
                    <div class="datos col-12" >TELÉFONO</div>
                    <div class="datos col-12" >CORREO</div>
                    <div class="datos col-12" >CCC</div>
                    <div class="datos col-12" >CONTRASEÑA</div>
                    <div class="datos col-12" >TALLA CAMISETA</div>
               
                </div>
            </div>
            <div class="col-4">
                <div class="row" style="height: 100%; font-family: 'Inter', sans-serif;">
                    <form method="POST" action="modificarDatos">
  
                        
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->dni=="") {echo 'DNI';} else {echo $datosUser->dni;}?>" name="dni"></div>
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->nombre=="") {echo 'NOMBRE';} else {echo $datosUser->nombre;}?>" name="nombre"></div>            
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->apellidos=="") {echo 'APELLIDOS';} else {echo $datosUser->apellidos;}?>" name="apellidos"></div>                     
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->telefono=="") {echo 'TELEFONO';} else {echo $datosUser->telefono;}?>" name="telefono"></div>          
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->email=="") {echo 'EMAIL';} else {echo $datosUser->email;}?>" name="email"></div>         
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->CCC=="") {echo 'CCC';} else {echo $datosUser->CCC;}?>" name="ccc"></div>
                        <div class="datos col-12" > <input type="password" size="30" placeholder="CONTRASEÑA" name="passw"></div>
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->talla=="") {echo 'TALLA CAMISETA';} else {echo $datosUser->talla;}?>" name="talla"></div>                      
                        <div class="datos col-12"><input type="submit" id="guardar" name="guardar" value="GUARDAR"></div>
                        <?php endforeach ?>
                    </form>
                </div>
            
               
            </div>
            
        </div>
    </div>

</body>
</html>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
  };
</script>