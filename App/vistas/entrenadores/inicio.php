<?php require_once RUTA_APP . '/vistas/inc/header_entrenador.php' ?>


    <div class="container-fluid">
        <main class="row text-center">

            <div class="col-xs-12 col-md-6 col-xl-4">
                <a href="<?php echo RUTA_URL ?>/entrenador/grupos">
                    <div id="icono1">
                        <div id="colorGrupos" class="caja mx-auto" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                            <img src="<?php echo RUTA_Icon ?>grupos.svg" width="100" height="100"></img>
                        </div>
                        <p id="pGrupos" class="mx-auto" onmouseover="colorear(colorGrupos);" onmouseleave="decolorear(colorGrupos);">GRUPOS</p>
                    </div>
                </a>
            </div>


            <div class="col-xs-12 col-md-6 col-xl-4">
                <a href="<?php echo RUTA_URL ?>/entrenador/test">
                    <div id="icono2">
                        <div id="colorTest" class="caja mx-auto" onmouseover="colorear(this);" onmouseleave="decolorear(this);" >
                            <img src="<?php echo RUTA_Icon ?>cronometro.svg" width="100" height="100"></img>
                        </div>
                        <p id="pTest" class="mx-auto" onmouseover="colorear(colorTest);" onmouseleave="decolorear(colorTest);">TEST</p>
                    </div>
                </a>
            </div>


            <div class="col-xs-12 col-md-6 col-xl-4">
                <a href="<?php echo RUTA_URL ?>/entrenador/mensajeria">
                    <div id="icono3">
                        <div id="colorMensajeria" class="caja mx-auto" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                            <img src="<?php echo RUTA_Icon ?>mensajeria.svg" width="100" height="100"></img>
                        </div>
                        <p id="pMensajeria" class="mx-auto" onmouseover="colorear(colorMensajeria);" onmouseleave="decolorear(colorMensajeria);">MENSAJERIA</p>
                    </div>
                </a>
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


