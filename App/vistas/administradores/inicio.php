<?php require_once RUTA_APP . '/vistas/inc/header.php' ?>


<div class="row text-center d-flex justify-content-center mt-5 inicio" style="font-family: 'Doppio One', sans-serif;">

    <!-- USUARIOS -->
    <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">     
        <div id="colorUsu" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);" data-bs-toggle="offcanvas" data-bs-target="#menuUsu">      
            <div><img src="<?php echo RUTA_Icon ?>usuario.svg" width="100" height="100"></div>
            <div><p style="margin-top:10px; font-size:20px">USUARIO</p></div>              
        </div>       
    </div>

    <!-- SOLICITUDES -->
    <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">    
        <div id="colorSoli" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);" data-bs-toggle="offcanvas" data-bs-target="#menuSol">      
            <div><img src="<?php echo RUTA_Icon ?>solicitudes.svg" width="100" height="100"></div>
            <div><p style="margin-top:10px; font-size:20px">SOLICITUDES</p></div>              
        </div>    
    </div>

    <!-- GRUPOS -->
    <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">       
        <div id="colorGrup" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
            <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminGrupos">
                <div><img src="<?php echo RUTA_Icon ?>grupos.svg" width="100" height="100"></div>
                <div><p style="margin-top:10px; font-size:20px">GRUPOS</p></div>
            </a>
        </div>     
    </div> 

    <!-- EVENTOS -->
    <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">   
        <div id="colorEven" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
            <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminEventos">
                <div><img src="<?php echo RUTA_Icon ?>eventos.svg" width="100" height="100"></div>
                <div><p style="margin-top:10px; font-size:20px">EVENTOS</p></div>
            </a>
        </div>
    </div> 
  
    <!-- LICENCIAS -->
    <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">
        <div id="colorLicen" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
            <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminLicencias">
                <div><img src="<?php echo RUTA_Icon ?>licencias.svg" width="100" height="100"></div>
                <div><p style="margin-top:10px; font-size:20px">LICENCIAS</p></div>
            </a>
        </div>
    </div> 
 
    <!-- ENTIDADES -->
    <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px"> 
        <div id="colorEnti" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
            <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminEntidades">
                <div><img src="<?php echo RUTA_Icon ?>entidad.svg" width="100" height="100"></div>
                <div><p style="margin-top:10px; font-size:20px">ENTIDADES</p></div>
            </a>
        </div> 
    </div> 

    <!-- EQUIPACIONES -->
    <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">
        <div id="colorEquip" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);" data-bs-toggle="offcanvas" data-bs-target="#menuEqui">      
            <div><img src="<?php echo RUTA_Icon ?>carrito.svg" width="100" height="100"></div>
            <div><p style="margin-top:10px; font-size:20px">EQUIPACIONES</p></div>              
        </div>
    </div>

    <!-- TEMPORADAS -->
    <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">
        <div id="colorTemp" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
            <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminTemporadas">
                <div><img src="<?php echo RUTA_Icon ?>temporadas.svg" width="100" height="100"></div>
                <div><p style="margin-top:10px; font-size:20px">TEMPORADAS</p></div>
            </a>
        </div>
    </div>

    <!-- RANKINGS-->
    <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">
        <div id="colorRan" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
            <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminRankings">
                <div><img src="<?php echo RUTA_Icon ?>temporadas.svg" width="100" height="100"></div>
                <div><p style="margin-top:10px; font-size:20px">RANKINGS</p></div>
            </a>
        </div>
    </div>

    <!-- FACTURACION -->
    <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">
        <div id="colorFact" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);" data-bs-toggle="offcanvas" data-bs-target="#menuFac">      
            <div><img src="<?php echo RUTA_Icon ?>euro.svg" width="100" height="100"></div>
            <div><p style="margin-top:10px; font-size:20px">FACTURACION</p></div>              
        </div>
    </div>

    <!-- MENSAJERIA -->
    <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">
        <div id="colorMen" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
            <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/adminMensajeria">
                <div><img src="<?php echo RUTA_Icon ?>mensajeria.svg" width="100" height="100"></div>
                <div><p style="margin-top:10px; font-size:20px">MENSAJERIA</p></div>
            </a>
        </div>
    </div>

</div>



<!------------------------------ MENU LATERALES --------------------------->

<!-- USUARIOS -->
 <div class="menu1 offcanvas offcanvas-start" id="menuUsu">
    <div class="offcanvas-header home">
        <img src="<?php echo RUTA_Icon ?>usuario.svg" width="50" height="50">
        <h1 class="offcanvas-title">USUARIOS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>      
    <a href="<?php echo RUTA_URL ?>/admin/crud_admin" class="tMenu nav-link">ADMIN</a>          
    <a href="<?php echo RUTA_URL ?>/admin/crud_entrenadores" class="tMenu nav-link ">ENTRENADORES</a>            
    <a href="<?php echo RUTA_URL ?>/admin/crud_socios" class="tMenu nav-link ">SOCIOS</a>        
</div>

<!-- SOLICITUDES -->
<div class=" menu1 offcanvas offcanvas-start" id="menuSol">
    <div class="offcanvas-header home">
        <img src="<?php echo RUTA_Icon ?>solicitudes.svg" width="50" height="50">
        <h1 class="offcanvas-title">SOLICITUDES</h1>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <a href="<?php echo RUTA_URL ?>/admin/crud_solicitudes_socios" class="tMenu nav-link">SOCIOS<span class="badge bg-danger" id="notSoliGrupos"><?php print_r($datos['notificaciones'][0]);  ?></span></a>
    <a href="<?php echo RUTA_URL ?>/admin/crud_solicitudes_grupos" class=" tMenu nav-link ">GRUPOS<span class="badge bg-danger" id="notSoliGrupos"><?php print_r($datos['notificaciones'][1]);  ?></span></a>         
    <a href="<?php echo RUTA_URL ?>/admin/crud_solicitudes_eventos/socio" class="tMenu nav-link ">EVENTOS<span class="badge bg-danger" id="notSoliGrupos"><?php print_r($datos['notificaciones'][2]);  ?></span></a> 
</div>

<!-- EQUIPACIONES -->
<div class="menu1 offcanvas offcanvas-start" id="menuEqui">
    <div class="offcanvas-header home">
        <img src="<?php echo RUTA_Icon?>carrito.svg" width="50" height="50">
        <h1 class="offcanvas-title">EQUIPACIONES</h1>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <a href="<?php echo RUTA_URL ?>/adminEquipaciones/pedidos" class="tMenu nav-link">PEDIDOS <span class="badge bg-danger" id="notSoliGrupos"><?php print_r($datos['notificaciones'][3]);  ?></span></a>
    <a href="<?php echo RUTA_URL ?>/adminEquipaciones/gestion" class="tMenu nav-link">GESTION</a>   
</div>

<!-- FACTURACION -->
<div class=" menu1 offcanvas offcanvas-start" id="menuFac">
    <div class="offcanvas-header home">
        <img src="<?php echo RUTA_Icon ?>euro.svg" width="50" height="50">
        <h1 class="offcanvas-title">FACTURACION</h1>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>            
    </div> 
    <a href="<?php echo RUTA_URL ?>/adminFacturacion/ingresos" class="tMenu nav-link">INGRESOS</a>          
    <a href="<?php echo RUTA_URL ?>/adminFacturacion/gastos" class="tMenu nav-link">GASTOS</a>      
    <a href="<?php echo RUTA_URL ?>/adminFacturacion/cuotas" class="tMenu nav-link">CUOTAS</a>      
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