<?php require_once RUTA_APP . '/vistas/inc/header_entrenador.php' ?>


<div class="container-fluid">
    <main class="row text-center">

        <!-- MENU GRUPOS -->
        <div class="col-xs-12 col-md-6 col-xl-4 pt-5">
            <div>
                <!-- CAJA ICONO -->
                <div id="colorGrupos" class="caja mx-auto" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <a href="<?php echo RUTA_URL ?>/entrenador/grupos">
                        <div>
                            <img src="<?php echo RUTA_Icon ?>grupos.svg" width="100" height="100"></img>
                        </div>
                    </a>
                </div>
                <!-- CAJA TEXTO -->
                <div id="color" class="caja mx-auto">
                    <a href="<?php echo RUTA_URL ?>/entrenador/grupos">
                        <div>
                            <p id="pGrupos" class="mx-auto" onmouseover="colorear(colorGrupos);" onmouseleave="decolorear(colorGrupos);">GRUPOS</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <!-- MENU TEST -->
        <div class="col-xs-12 col-md-6 col-xl-4 pt-5">
            <div>
                <!-- CAJA ICONO -->
                <div id="colorTest" class="caja mx-auto" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <a href="<?php echo RUTA_URL ?>/entrenador/test">
                        <div>
                            <img src="<?php echo RUTA_Icon ?>cronometro.svg" width="100" height="100"></img>
                        </div>
                    </a>
                </div>
                <!-- CAJA TEXTO -->
                <div id="color" class="caja mx-auto">
                    <a href="<?php echo RUTA_URL ?>/entrenador/test">
                        <div>
                            <p id="pTest" class="mx-auto" onmouseover="colorear(colorTest);" onmouseleave="decolorear(colorTest);">TEST</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <!-- MENU MENSAJERIA -->
        <div class="col-xs-12 col-md-6 col-xl-4 pt-5">
            <div>
                <!-- CAJA ICONO -->
                <div id="colorMensajeria" class="caja mx-auto" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <a href="<?php echo RUTA_URL ?>/entrenador/mensajeria">
                        <div>
                            <img src="<?php echo RUTA_Icon ?>mensajeria.svg" width="100" height="100"></img>
                        </div>
                    </a>
                </div>
                <!-- CAJA TEXTO -->
                <div id="color" class="caja mx-auto">
                    <a href="<?php echo RUTA_URL ?>/entrenador/mensajeria">
                        <div>
                            <p id="pMensajeria" class="mx-auto" onmouseover="colorear(colorMensajeria);" onmouseleave="decolorear(colorMensajeria);">MENSAJERIA</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </main>
</div>



<script>
    function colorear(icono) {
        icono.style.backgroundColor = '#ffbf1c';
    }

    function decolorear(icono) {
        icono.style.backgroundColor = '#f5f5f5';
    }
</script>