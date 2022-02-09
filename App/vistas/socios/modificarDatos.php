<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="modificarDatos.css">

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
            <div class="col-2"></div>
            <div class="col-8"><img src="img/corredor.png" width="150" onclick="redirect('socio.php')"> <img src="img/letras.png" width="200" onclick="redirect('socio.php')"></div>
            <div class="col-2"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/></svg></div>
            <div class="col-12"><h1 id="titulo" style="font-family: 'Anton',sans-serif; color: #2B2B2B; font: bold; letter-spacing: 5px;">MODIFICAR DATOS</h1></div>
        </header>
        <div class="row">
            <div class="col-4 text-center">
                <div class="row" style="height: 100%;">
                    <div class="col-12"><img src="img/usuario.svg" width="350" height="450" style="border: solid; color: #023EF9;"></div>
                    <div class="col-12" style="padding-bottom: 90px"><label for="editarFoto" class="editarFoto">EDITAR FOTO</label><label class="editarFoto" style="margin-left: 5px;">GUARDAR</label><br><input type="file" style="visibility:hidden;" id="editarFoto" name="editarFoto"> </div>
                </div> 
            
            </div>
            <div class="col-4">
                <div class="row" style="padding-left: 5cm; font-family: 'Inter', sans-serif;">
                    <div class="datos col-12" >DNI</div>
                    <div class="datos col-12" >NOMBRE</div>
                    <div class="datos col-12" >APELLIDOS</div>   
                    <div class="datos col-12" >FECHA NACIMIENTO</div> 
                    <div class="datos col-12" >DIRECCIÓN</div> 
                    <div class="datos col-12" >TELÉFONO</div>
                    <div class="datos col-12" >CORREO</div>
                    <div class="datos col-12" >CCC</div>
                    <div class="datos col-12"><input type="button" id="guardar" name="guardar" value="GUARDAR"></div>
                </div>
            </div>
            <div class="col-4">
                <div class="row" style="height: 100%; font-family: 'Inter', sans-serif;">
                    <form method="post">
                        <div class="datos col-12" > <input type="text" size="30" placeholder="DNI" name="dni"></div>
                        <div class="datos col-12" > <input type="text" size="30" placeholder="NOMBRE" name="nombre"></div>            
                        <div class="datos col-12" > <input type="text" size="30" placeholder="APELLIDOS" name="apellidos"></div>      
                        <div class="datos col-12" > <input type="text" size="30" placeholder="FECHA NACIMIENTO" name="fechaNac"></div>          
                        <div class="datos col-12" > <input type="text" size="30" placeholder="DIRECCIÓN" name="direccion"></div>           
                        <div class="datos col-12" > <input type="text" size="30" placeholder="TELÉFONO" name="telefono"></div>          
                        <div class="datos col-12" > <input type="text" size="30" placeholder="CORREO" name="correo"></div>         
                        <div class="datos col-12" > <input type="text" size="30" placeholder="CCC" name="ccc"></div>
                        <div class="datos col-12" style="padding-left: 273px"><input type="button" id="volver" name="volver" value="VOLVER" onclick="redirect('socio.php')"></div>
                    </form>
                    </div>

            </div>
            
        </div>
    </div>


    
</body>
</html>

