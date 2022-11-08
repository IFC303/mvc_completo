
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


<style>

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width:100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}


/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: rgb(142, 193, 231 );
}

</style>

<body>


    <section>

        <nav class="menu1" id="menu1">
      
            <a id="home" href="<?php echo RUTA_URL ?>/socio" class="nav-link">
                <img id="imgHome" src="<?php echo RUTA_Icon ?>inicio.png"><span class="tHome">INICIO</span>                                                 
            </a>                                       
            

            <a href="<?php echo RUTA_URL ?>/adminUsuarios" class="nav-link">                           
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>grupos.png"><span class="tMenu">USUARIOS</span>                                                          
            </a> 
            

              <!--DESPLEGABLE SOLICITUDES-->
                <div class="sidenav">
                    <a class="dropdown-btn">
                        <img class="imgMenu" src="<?php echo RUTA_Icon ?>solicitudes.png"><span class="tMenu">SOLICITUDES</span>
                    </a>
                    <div class="dropdown-container">
                        <a href="<?php echo RUTA_URL ?>/adminSolicitudes/socios" class="nav-link"><span class="tMenu ms-5 ps-5">SOCIOS</span></span><span class="badge bg-danger ms-3" id="notSoliGrupos"><?php print_r($datos['notificaciones'][0]);?></span></a>
                        <a href="<?php echo RUTA_URL ?>/adminSolicitudes/grupos" class="nav-link "><span class="tMenu ms-5 ps-5">ESCUELA</span></span><span class="badge bg-danger ms-3" id="notSoliGrupos"><?php print_r($datos['notificaciones'][1]);?></span></a>
                        <a href="<?php echo RUTA_URL ?>/adminSolicitudes/eventos" class="nav-link "><span class="tMenu ms-5 ps-5">EVENTOS</span></span><span class="badge bg-danger ms-3" id="notSoliGrupos"><?php print_r($datos['notificaciones'][2]);?></span></a>
                        
                    </div>
                </div>
            
                          
            <a href="<?php echo RUTA_URL ?>/adminGrupos" class="nav-link">                           
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>escuela.png"><span class="tMenu">ESCUELA</span>                                                          
            </a>   

            <a href="<?php echo RUTA_URL ?>/adminEventos" class="nav-link">
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>eventos.png"><span class="tMenu">EVENTOS</span>
            </a>       

            <a href="<?php echo RUTA_URL ?>/adminLicencias" class="nav-link" >
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>licencias.png"><span class="tMenu">LICENCIAS</span>
            </a>     

            <a href="<?php echo RUTA_URL ?>/adminEntidades" class="nav-link">                           
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>entidad.png"><span class="tMenu">ENTIDADES</span>                                                          
            </a>         

            <!--DESPLEGABLE EQUIPACIONES-->
            <div class="sidenav">
                <a class="dropdown-btn">
                    <img class="imgMenu" src="<?php echo RUTA_Icon ?>carrito.png"><span class="tMenu">EQUIPACIONES</span>
                </a>
                <div class="dropdown-container">
                    <a href="<?php echo RUTA_URL ?>/adminEquipaciones/pedidos" class="nav-link"><span class="tMenu ms-5 ps-5">PEDIDOS</span><span class="badge bg-danger ms-3" id="notSoliGrupos"><?php print_r($datos['notificaciones'][3]);?></span></a>
                    <a href="<?php echo RUTA_URL ?>/adminEquipaciones/gestion" class="nav-link "><span class="tMenu ms-5 ps-5">GESTION</span></a>
                </div>
            </div>
                         
            <a href="<?php echo RUTA_URL?>/adminTemporadas" class="nav-link" >
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>temporadas.png"><span class="tMenu">TEMPORADAS</span>
            </a>    

            <a href="<?php echo RUTA_URL?>/adminInformes" class="nav-link">                           
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>ranking.png"><span class="tMenu">INFORMES</span>                                                          
            </a>     


            <!--DESPLEGABLE FACTURACION-->
            <div class="sidenav">
                <a class="dropdown-btn">
                    <img class="imgMenu" src="<?php echo RUTA_Icon ?>euro.png"><span class="tMenu">FACTURACION</span>
                </a>
                <div class="dropdown-container">
                    <a href="<?php echo RUTA_URL ?>/adminFacturacion/ingresos" class="nav-link"><span class="tMenu ms-5 ps-5">INGRESOS</span></a>
                    <a href="<?php echo RUTA_URL ?>/adminFacturacion/gastos" class="nav-link "><span class="tMenu ms-5 ps-5">GASTOS</span></a>
                </div>
            </div>
                       
            <a href="<?php echo RUTA_URL ?>/adminMensajeria" class="nav-link" >
                <img class="imgMenu" src="<?php echo RUTA_Icon ?>mensajeria.png"><span class="tMenu">MENSAJERIA</span>
            </a>                           
                          
       
        </nav>


<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
        } else {
        dropdownContent.style.display = "block";
        }
    });
    }
</script>