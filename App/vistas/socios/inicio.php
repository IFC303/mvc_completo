<?php require_once RUTA_APP . '/vistas/inc/header-socio.php' ?>


<div class="row text-center d-flex justify-content-center mt-5 inicio" style="font-family: 'Doppio One', sans-serif;">

        <!-- MENU MODIFICAR DATOS -->
        <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">
            <div>
                <!-- CAJA ICONO -->
                <div id="colorDatos" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/socio/modificarDatos">
                        <div>
                            <img src="<?php echo RUTA_Icon ?>editar.svg" width="100" height="100">
                        </div>
                         <div>
                            <p style="margin-top:10px; font-size:20px;">MIS DATOS</p>
                        </div>
                    </a>
                </div>              
            </div>
        </div>

        
        <!-- MENU LICENCIAS -->
        <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">
            <div>
                <!-- CAJA ICONO -->
                <div id="colorLicen" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/socio/licencias">
                        <div>
                            <img src="<?php echo RUTA_Icon ?>licencias.svg" width="100" height="100">
                        </div>
                        <div>
                            <p style="margin-top:10px; font-size:20px">LICENCIAS</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <!-- MENU VER MARCAS -->
        <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">
            <div>
                <!-- CAJA ICONO -->
                <div id="colorMarcas" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/socio/verMarcas">
                        <div>
                            <img src="<?php echo RUTA_Icon ?>cronometro.svg" width="100" height="100">
                        </div>
                        <div>
                            <p style="margin-top:10px; font-size:20px">MARCAS</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

 </div>


 <div class="row text-center d-flex justify-content-center mt-5" style="font-family: 'Doppio One', sans-serif;">

        <!-- MENU PEDIR EQUIPACION -->
        <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">
            <div>
                <!-- CAJA ICONO -->
                <div id="colorEquipacion" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/socio/equipacion">
                        <div>
                            <img style="padding-bottom:6px;" src="<?php echo RUTA_Icon ?>carrito.svg" width="100" height="100">
                        </div>
                        <div>
                            <p style="margin-top:10px; font-size:20px">EQUIPACION</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- APUNTAR A Escuela -->
         <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">
            <div>
                <div id="colorEscuela" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                    <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/socio/escuela">
                        <div>
                            <img src="<?php echo RUTA_Icon ?>escuela.png" width="130" height="100">
                        </div> <div>
                            <p style="margin-top:10px; font-size:20px">INSCRIPCION &nbspESCUELA</p>
                        </div>
                    </a>
                </div>
            </div>
        </div> 
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