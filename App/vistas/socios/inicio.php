<?php require_once RUTA_APP . '/vistas/inc/header-socio.php' ?>

        
        <div class="row text-center" style="font-family: 'Doppio One', sans-serif; "> 
                
                <!-- MODIFICAR DATOS -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <a href="<?php echo RUTA_URL ?>/socios/modificarDatos"><div id="colorDatos" class="caja mx-auto"><img src="<?php echo RUTA_Icon?>editar.svg" width="100" height="100"></div></a>
                        <p id="pDatos" class="mx-auto" >MODIFICAR DATOS</p>                      
                    </div>
                </div>

                <!-- SUBIR LICENCIAS -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <div id="colorLicen" class="caja mx-auto"><img src="<?php echo RUTA_Icon?>licencias.svg" width="100" height="100"></div>
                        <p id="pLicen" class="mx-auto" >SUBIR LICENCIAS</p>
                    </div>
                </div>

                <!-- VER MARCAS -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <div id="colorMarcas" class="caja mx-auto"><img src="<?php echo RUTA_Icon?>cronometro.svg" width="100" height="100"></div>
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