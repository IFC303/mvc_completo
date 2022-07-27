
<?php require_once RUTA_APP . '/vistas/inc/header.php'?>



 <?php
    $miga1 = "";
    $miga1Nom = "";
    $miga2 = "";
    $miga2Nom = "";
    $miga3 = "";

    if (isset($this->datos['idTengo'])) {
        if ($this->datos['idTengo'] == "1") {
            $miga1Nom = "ADMIN";
        } elseif ($this->datos['idTengo'] == "2") {
            $miga1Nom = "ENTRENADORES";
        } elseif ($this->datos['idTengo'] == "3") {
            $miga1Nom = "SOCIOS";
        } elseif ($this->datos['idTengo'] == "4") {
            $miga1Nom = "TIENDAS";
        }
    } elseif (isset($this->datos['radioCheck'])) {
        if ($this->datos['radioCheck'] == "socio") {
            $miga1Nom = "SOLICITUD EVENTOS SOCIO";
        } elseif ($this->datos['radioCheck'] == "externo") {
            $miga1Nom = "SOLICITUD EVENTOS EXTERNO";
        }
    } elseif (isset($this->datos['notificaciones'][3])) {
        if ($this->datos['notificaciones'][3] == "EVENTOS") {
            $miga1Nom = "EVENTOS";
        }elseif ($this->datos['notificaciones'][3] == "LICENCIA") {
            $miga1Nom = "LICENCIA";
        }elseif ($this->datos['notificaciones'][3] == "MENSAJERIA") {
            $miga1Nom = "MENSAJERIA";
        }elseif ($this->datos['notificaciones'][3] == "ENTIDADES") {
            $miga1Nom = "ENTIDADES";
        }elseif ($this->datos['notificaciones'][3] == "GRUPOS") {
            $miga1Nom = "GRUPOS";
        }elseif ($this->datos['notificaciones'][3] == "INGRESOS") {
            $miga1Nom = "INGRESOS";
        }elseif ($this->datos['notificaciones'][3] == "GASTOS") {
            $miga1Nom = "GASTOS";
        }elseif ($this->datos['notificaciones'][3] == "SOCIOSSOL") {
            $miga1Nom = "SOCIOS";
        }elseif ($this->datos['notificaciones'][3] == "GRUPOSSOL") {
            $miga1Nom = "GRUPOS";
        }elseif ($this->datos['notificaciones'][3] == "EVENTOSSOL") {
            $miga1Nom = "EVENTOS";
        }elseif ($this->datos['notificaciones'][3] == "PEDIDOS") {
            $miga1Nom = "PEDIDOS";
        }elseif ($this->datos['notificaciones'][3] == "GESTION") {
            $miga1Nom = "GESTION";
        }
    } else {
        $miga1Nom = "CUOTAS";
    }

    if (isset($this->datos['nuevo'])) {
        if (isset($this->datos['idTengo'])) {
            if ($this->datos['idTengo'] == "1") {
                $miga1 = RUTA_URL . "/admin/crud_admin";
                $miga1Nom = "ADMIN";
                $miga2Nom = "NUEVO ADMIN";
            } elseif ($this->datos['idTengo'] == "2") {
                $miga1 = RUTA_URL . "/admin/crud_entrenadores";
                $miga1Nom = "ENTRENADORES";
                $miga2Nom = "NUEVO ENTRENADOR";
            } elseif ($this->datos['idTengo'] == "3") {
                $miga1 = RUTA_URL . "/admin/crud_socios";
                $miga1Nom = "SOCIOS";
                $miga2Nom = "NUEVO SOCIO";
            } elseif ($this->datos['idTengo'] == "4") {
                $miga1 = RUTA_URL . "/admin/crud_tiendas";
                $miga1Nom = "TIENDAS";
                $miga2Nom = "NUEVA TIENDA";
            }
        } elseif ($this->datos['nuevo'] == "EVENTO") {
            $miga1 = RUTA_URL . "/adminEventos";
            $miga1Nom = "EVENTO";
            $miga2Nom = "NUEVO EVENTO";
        }elseif ($this->datos['nuevo'] == "PARTICIPANTES") {
            $miga1 = RUTA_URL . "/adminEventos";
            $miga1Nom = "PARTICIPANTES";
            $miga2Nom = "NUEVo PARTICIPANTES";
        }elseif ($this->datos['nuevo'] == "LICENCIA") {
            $miga1 = RUTA_URL . "/adminLicencias";
            $miga1Nom = "LICENCIA";
            $miga2Nom = "NUEVA LICENCIA";
        }elseif ($this->datos['nuevo'] == "ENTIDADES") {
            $miga1 = RUTA_URL . "/adminEntidades";
            $miga1Nom = "ENTIDADES";
            $miga2Nom = "NUEVA ENTIDADES";
        }elseif ($this->datos['nuevo'] == "GRUPOS") {
            $miga1 = RUTA_URL . "/adminGrupos";
            $miga1Nom = "GRUPOS";
            $miga2Nom = "NUEVA GRUPOS";
        }elseif ($this->datos['nuevo'] == "FACTURACION") {
            $miga1 = RUTA_URL . "/adminFacturacion/ingresos";
            $miga1Nom = "INGRESOS";
            $miga2Nom = "NUEVA INGRESO";
        }elseif ($this->datos['nuevo'] == "FACTURACION2") {
            $miga1 = RUTA_URL . "/adminFacturacion/gastos";
            $miga1Nom = "GASTOS";
            $miga2Nom = "NUEVO GASTO";
        }
    }
    ?> 


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
}

</style>


        
          
            <div class="col-xs-12 col-md-7 text-center order-3 order-md-2">
                <ol class="breadcrumb v1 justify-content-center">
                    <li class="breadcrumb-level"><a href="<?php echo RUTA_URL ?>/admin">INICIO</a></li>
                    <li class='breadcrumb-level'><a href="<?php echo $miga1 ?>"><?php echo $miga1Nom ?></a></li>
                    <?php if (isset($this->datos['nuevo'])) {
                        echo "<li class='breadcrumb-level'><a href=" . $miga2 . ">" . $miga2Nom . "</a></li>";
                    }
                    ?>
                </ol>
            </div>
       


            <!--BOTON MENU LATERAL-->                         
            <div class="col-12 order-4" id="fotoMenu">
                <div style="width: 50px; height: 50px; cursor:pointer;" data-bs-toggle="offcanvas" data-bs-target="#menu1">
                    <img src="<?php echo RUTA_Icon ?>menu.svg" width="50" height="50">
                </div>
            </div>              
    
            <!--MENU-->
            <div class="menu1 offcanvas offcanvas-start" id="menu1">

                    <!--INICIO-->
                    <div class="offcanvas-header home">
                        <a id="home" href="<?php echo RUTA_URL ?>/admin" class="nav-link align-middle">
                        <div class="row">
                            <div class="col-4">
                                <img class="imgHome" style="width:75px; height:75px" src="<?php echo RUTA_Icon ?>inicio.svg">
                            </div>
                            <div class="col-7 mt-3"><h1>INICIO</h1></div>                                
                        </div>                      
                        </a>                       
                        <button type="button" class="btn-close text-reset me-3" data-bs-dismiss="offcanvas"></button>
                    </div>  
            
                    <!--MENU USUARIOS-->
                    <div class="sidenav">
                        <a class="dropdown-btn">
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>usuario.svg"><span class="tMenu">USUARIOS</span>
                        </a>
                        <div class="dropdown-container">
                            <a href="<?php echo RUTA_URL ?>/admin/crud_admin" class="nav-link"><span class="ms-5 ps-5">ADMIN</span></a>
                            <a href="<?php echo RUTA_URL ?>/admin/crud_entrenadores" class="nav-link "><span class="ms-5 ps-5">ENTRENADORES</span></a>
                            <a href="<?php echo RUTA_URL ?>/admin/crud_socios" class="nav-link "><span class="ms-5 ps-5">SOCIOS</span></a>
                        </div>
                    </div>
      
                    <!--MENU SOLICITUDES-->
                    <div class="sidenav">
                        <a class="dropdown-btn">
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>solicitudes.svg"><span class="tMenu">SOLICITUDES</span>
                        </a>
                        <div class="dropdown-container">
                        <a href="<?php echo RUTA_URL ?>/admin/crud_solicitudes_socios" class="nav-link">
                            <span class=" ms-5 ps-5">SOCIOS</span>
                            <span class="badge bg-danger" id="notSoliGrupos"><?php print_r($datos['notificaciones'][0]);?></span>
                        </a>
                        <a href="<?php echo RUTA_URL ?>/admin/crud_solicitudes_grupos" class="nav-link "><span class="ms-5 ps-5">GRUPOS</span><span class="badge bg-danger" id="notSoliGrupos"><?php print_r($datos['notificaciones'][1]);  ?></span></a>
                        <a href="<?php echo RUTA_URL ?>/admin/crud_solicitudes_eventos/socio" class="nav-link "><span class="ms-5 ps-5">EVENTOS</span><span class="badge bg-danger" id="notSoliGrupos"><?php print_r($datos['notificaciones'][2]);  ?></span></a>
                        </div>
                    </div>


                        <a href="<?php echo RUTA_URL ?>/adminGrupos" class="nav-link align-middle">
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>grupos.svg"><span class="tMenu">GRUPOS</span>
                        </a>   

                        <a href="<?php echo RUTA_URL ?>/adminEventos" class="nav-link align-middle">
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>eventos.svg"><span class="tMenu">EVENTOS</span>
                        </a>    

                        <a href="<?php echo RUTA_URL ?>/adminLicencias" class="nav-link  align-middle">                           
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>licencias.svg"><span class="tMenu">LICENCIAS</span>                                                          
                        </a>                           

                        <a href="<?php echo RUTA_URL ?>/adminEntidades" class="nav-link align-middle">
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>entidad.svg"><span class="tMenu">ENTIDADES</span>
                        </a>

                         <!--MENU EQUIPACIONES-->
                        <div class="sidenav">
                                <a class="dropdown-btn">
                                    <img class="imgMenu" src="<?php echo RUTA_Icon ?>carrito.svg"><span class="tMenu">EQUIPACIONES</span>
                                </a>
                                <div class="dropdown-container">
                                    <a href="<?php echo RUTA_URL ?>/adminEquipaciones/pedidos" class="nav-link"><span class="ms-5 ps-5">PEDIDOS</span></a>
                                    <a href="<?php echo RUTA_URL ?>/adminEquipaciones/gestion" class="nav-link"><span class="ms-5 ps-5">GESTION</span></a>
                                </div>
                        </div>

                        <a href="<?php echo RUTA_URL ?>/adminTemporadas" class="nav-link align-middle">
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>temporadas.svg"><span class="tMenu">TEMPORADAS</span>
                        </a> 

                         <a href="<?php echo RUTA_URL ?>/adminRankings" class="nav-link align-middle">
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>escuela.png"><span class="tMenu">RANKINGS</span>
                        </a> 

                        <!--MENU FACTURACION-->
                        <div class="sidenav">
                                <a class="dropdown-btn">
                                    <img class="imgMenu" src="<?php echo RUTA_Icon ?>euro.svg"><span class="tMenu">FACTURACION</span>
                                </a>
                                <div class="dropdown-container">
                                    <a href="<?php echo RUTA_URL ?>/adminFacturacion/ingresos" class="nav-link"><span class="ms-5 ps-5">INGRESOS</span></a>
                                    <a href="<?php echo RUTA_URL ?>/adminFacturacion/gastos" class="nav-link "><span class="ms-5 ps-5">GASTOS</span></a>
                                    <a href="<?php echo RUTA_URL ?>/adminFacturacion/cuotas/" class="nav-link "><span class="ms-5 ps-5">CUOTAS</span></a>
                                </div>
                        </div>


                        <a href="<?php echo RUTA_URL ?>/adminMensajeria/mensajeria" class="nav-link align-middle">
                            <img class="imgMenu" src="<?php echo RUTA_Icon ?>mensajeria.svg"><span class="tMenu">MENSAJERIA</span>
                        </a>     

                </div>
                   


        
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