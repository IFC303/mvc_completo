<?php require_once RUTA_APP . '/vistas/inc/header.php' ?>
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
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">
   


    <title>SOCIO</title>
</head>
<body style="background-color: #F5F5F5;">
    <div class="container-fluid min-vh-100" style="border: solid; height: 100%;">
        <header class="p-5 row"> 
            <div class="col-3" ><img id="logo" src="img/logo_tragamillas.png" width="150"></div>
            <div class="col-7 text-center"><h1 id="titulo" style="font-family: 'Anton',sans-serif; color: #023EF9; font: bold; letter-spacing: 5px;">ZONA SOCIO</h1></div>
            <div class="col-2 text-center"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/></svg></div>
        </header>
        
        <div class="row text-center" style="font-family: 'Doppio One', sans-serif; "> 
                
                <!-- MODIFICAR DATOS -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <div onclick="redirect('modificarDatos.php');" id="colorDatos" class="caja mx-auto"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg></div>
                        <p id="pDatos" class="mx-auto" >MODIFICAR DATOS</p>                      
                    </div>
                </div>

                <!-- SUBIR LICENCIAS -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <div id="colorLicen" class="caja mx-auto"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-postcard-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm8.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM2 5.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5ZM2.5 7a.5.5 0 0 0 0 1H6a.5.5 0 0 0 0-1H2.5ZM2 9.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm8-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-3ZM11 8h2V6h-2v2Z"/></svg></div>
                        <p id="pLicen" class="mx-auto" >SUBIR LICENCIAS</p>
                    </div>
                </div>

                <!-- VER MARCAS -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <div id="colorMarcas" class="caja mx-auto"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-stopwatch-fill" viewBox="0 0 16 16"><path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07A7.001 7.001 0 0 0 8 16a7 7 0 0 0 5.29-11.584.531.531 0 0 0 .013-.012l.354-.354.353.354a.5.5 0 1 0 .707-.707l-1.414-1.415a.5.5 0 1 0-.707.707l.354.354-.354.354a.717.717 0 0 0-.012.012A6.973 6.973 0 0 0 9 2.071V1h.5a.5.5 0 0 0 0-1h-3zm2 5.6V9a.5.5 0 0 1-.5.5H4.5a.5.5 0 0 1 0-1h3V5.6a.5.5 0 1 1 1 0z"/></svg></div>
                        <p id="pMarcas" class="mx-auto" >VER MARCAS</p>
                    </div>
                </div>
        </div>

    </div>


</body>

    
</html>


<script>
		window.onload=function()
		{
            vOpciones=[["pDatos","colorDatos"],["pLicen","colorLicen"],["pMarcas","colorMarcas"]];
            
            for (let i = 0; i < vOpciones.length; i++) {
                var elemento=document.getElementById(vOpciones[i][0]);
                var elemento2=document.getElementById(vOpciones[i][1]);
                elemento.onmouseover = function(e) {
                    document.getElementById(vOpciones[i][1]).style.backgroundColor = '#FFBF1C';
                };
                elemento.onmouseout = function(e) {
                    document.getElementById(vOpciones[i][1]).style.backgroundColor = '#F5F5F5';
                };
                elemento2.onmouseover = function(e) {
                    document.getElementById(vOpciones[i][1]).style.backgroundColor = '#FFBF1C';
                };
                elemento2.onmouseout = function(e) {
                    document.getElementById(vOpciones[i][1]).style.backgroundColor = '#F5F5F5';
                };
                /*elemento.onclick = function(e) {
                    location.href="http://www.elmiradordelaserrania.com"
                };
                elemento2.onclick = function(e) {
                    location.href="http://www.elmiradordelaserrania.com"
                };*/
                
            }
            
		}
        
</script>
<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>