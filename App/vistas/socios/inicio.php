<?php require_once RUTA_APP . '/vistas/inc/header-socio.php' ?>


<div class="row text-center inicio" style="font-family: 'Doppio One', sans-serif; ">

        <!-- MENU MODIFICAR DATOS -->
        <div class="col-xs-12 col-md-6 col-xl-4 pt-5">
            <div>
                <!-- CAJA ICONO -->
                <div id="colorDatos" class="caja mx-auto shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <a href="<?php echo RUTA_URL ?>/socio/modificarDatos">
                        <div>
                            <img src="<?php echo RUTA_Icon ?>editar.svg" width="100" height="100">
                        </div>
                    </a>
                </div>
                <!-- CAJA TEXTO -->
                <div id="color" class="caja mx-auto ">
                    <a href="<?php echo RUTA_URL ?>/socio/modificarDatos">
                        <div>
                            <p id="pDatos" class="mx-auto" onmouseover="colorear(colorDatos);" onmouseleave="decolorear(colorDatos);">MIS DATOS</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <!-- MENU LICENCIAS -->
        <div class="col-xs-12 col-md-6 col-xl-4 pt-5">
            <div>
                <!-- CAJA ICONO -->
                <div id="colorLicen" class="caja mx-auto shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <a href="<?php echo RUTA_URL ?>/socio/licencias">
                        <div>
                            <img src="<?php echo RUTA_Icon ?>licencias.svg" width="100" height="100">
                        </div>
                    </a>
                </div>
                <!-- CAJA TEXTO -->
                <div id="color" class="caja mx-auto">
                    <a href="<?php echo RUTA_URL ?>/socio/licencias">
                        <div>
                            <p id="pLicen" class="mx-auto" onmouseover="colorear(colorLicen);" onmouseleave="decolorear(colorLicen);">LICENCIAS</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <!-- MENU VER MARCAS -->
        <div class="col-xs-12 col-md-6 col-xl-4 pt-5" >
            <div>
                <!-- CAJA ICONO -->
                <div id="colorMarcas" class="caja mx-auto shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <a href="<?php echo RUTA_URL ?>/socio/verMarcas">
                        <div>
                            <img src="<?php echo RUTA_Icon ?>cronometro.svg" width="100" height="100">
                        </div>
                    </a>
                </div>
                <!-- CAJA TEXTO -->
                <div id="color" class="caja mx-auto">
                    <a href="<?php echo RUTA_URL ?>/socio/verMarcas">
                        <div>
                            <p id="pMarcas" class="mx-auto" onmouseover="colorear(colorMarcas);" onmouseleave="decolorear(colorMarcas);">MARCAS</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <!-- MENU PEDIR EQUIPACION -->
        <div class="col-xs-12 col-md-6 col-xl-4 pt-5" >
            <div>
                <!-- CAJA ICONO -->
                <div id="colorEquipacion" class="caja mx-auto shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <a href="<?php echo RUTA_URL ?>/socio/equipacion">
                        <div>
                            <img style="padding-bottom:6px" src="<?php echo RUTA_Icon ?>carrito.svg" width="100" height="100">
                        </div>
                    </a>
                </div>
                <!-- CAJA TEXTO -->
                <div id="color" class="caja mx-auto">
                    <a href="<?php echo RUTA_URL ?>/socio/equipacion">
                        <div>
                            <p id="pMarcas" class="mx-auto" onmouseover="colorear(colorEquipacion);" onmouseleave="decolorear(colorEquipacion);">EQUIPACION</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- APUNTAR A Escuela -->
         <div class="col-xs-12 col-md-6 col-xl-4 pt-5">
            <div>
                <div id="colorEscuela" class="caja mx-auto shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <a href="<?php echo RUTA_URL ?>/socio/escuela">
                        <div>
                            <img src="<?php echo RUTA_Icon ?>escuela.png" width="100" height="100">
                        </div>
                    </a>
                </div>
                <div id="color" class="caja mx-auto">
                    <a href="<?php echo RUTA_URL ?>/socio/escuela">
                        <div>
                            <p id="pEscuela" class="mx-auto" onmouseover="colorear(colorEscuela);" onmouseleave="decolorear(colorEscuela);">INSCRIPCION ESCUELA</p>
                        </div>
                    </a>
                </div>
            </div>
        </div> 

        <!-- Apuntate Evento -->
         <!-- <div class="col-xs-12 col-md-6 col-xl-4 pt-5">
            <div>
                <div id="colorEvento" class="caja mx-auto">
                    <a href="<?php echo RUTA_URL ?>/socio/eventoSolicitud">
                        <div>
                            <img src="<?php echo RUTA_Icon ?>eventos.svg" width="100" height="100">
                        </div>
                    </a>
                </div>
                <div id="color" class="caja mx-auto">
                    <a href="<?php echo RUTA_URL ?>/socio/eventoSolicitud">
                        <div>
                            <p id="pEvento" class="mx-auto">EVENTO</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>  -->
    </div>

</div>




    <script>
        function colorear(icono) {
            icono.style.backgroundColor = '#ffbf1c';
        }

        function decolorear(icono) {
            icono.style.backgroundColor = '#ffffff';
        }
    </script>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>