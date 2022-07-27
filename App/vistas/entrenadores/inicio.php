

<?php require_once RUTA_APP . '/vistas/inc/header.php'?>



<div class="row text-center d-flex justify-content-center mt-5 inicio" style="font-family: 'Doppio One', sans-serif;">

        <!-- MENU GRUPOS -->
        <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">
            <div id="colorGrupos" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/entrenador/grupos">
                <div><img src="<?php echo RUTA_Icon ?>grupos.svg" width="100" height="100"></div>
                <div><p style="margin-top:10px; font-size:20px;">GRUPOS</p></div>
                </a>
            </div>              
        </div>
       
        <!-- MENU TEST -->
        <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">      
            <div id="colorTest" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/entrenador/test">
                <div><img src="<?php echo RUTA_Icon ?>cronometro.svg" width="100" height="100"></div>
                <div><p style="margin-top:10px; font-size:20px">TEST</p></div>
                </a>
            </div>     
        </div>

        <!-- MENU MENSAJERIA -->
        <div class="col-xs-12 col-md-6 pt-5 mx-5" style="width:300px">
            <div id="colorMensajeria" class="shadow p-3 mb-3" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
                <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/entrenador/mensajeria">
                <div><img src="<?php echo RUTA_Icon ?>mensajeria.svg" width="100" height="100"></div>
                <div><p style="margin-top:10px; font-size:20px">MENSAJERIA</p></div>
                </a>
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