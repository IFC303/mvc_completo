<?php require_once RUTA_APP . '/vistas/inc/header-tienda.php' ?>


<div class="row text-center inicio" style="font-family: 'Doppio One', sans-serif; ">

  <!-- EQUIPACIONES -->
  <div class="col-xs-12 col-md-6 col-xl-4">
    <div>
      <a href="<?php echo RUTA_URL ?>/tienda/equipaciones">
        <div id="colorMarcas" class="caja mx-auto"><img src="<?php echo RUTA_Icon ?>usuario.svg" width="100" height="100"></div>
      </a>
      <p id="pMarcas" class="mx-auto">EQUIPACIONES </p>
    </div>
  </div>

  <!-- DOS -->
  <div class="col-xs-12 col-md-6 col-xl-4">
    <div>
      <a href="<?php echo RUTA_URL ?>/socio/modificarDatos">
        <div id="colorDatos" class="caja mx-auto"><img src="<?php echo RUTA_Icon ?>euro.svg" width="100" height="100"></div>
      </a>
      <p id="pDatos" class="mx-auto">DOS</p>
    </div>
  </div>

  <!-- TRES -->
  <div class="col-xs-12 col-md-6 col-xl-4">
    <div>
      <div id="colorLicen" class="caja mx-auto"><img src="<?php echo RUTA_Icon ?>euro.svg" width="100" height="100"></div>
      <p id="pLicen" class="mx-auto">TRES</p>
    </div>
  </div>
</div>

</div>


</body>


</html>


<script>
  window.onload = function() {
    vOpciones = [
      ["pDatos", "colorDatos"],
      ["pLicen", "colorLicen"],
      ["pMarcas", "colorMarcas"]
    ];

    for (let i = 0; i < vOpciones.length; i++) {
      var elemento = document.getElementById(vOpciones[i][0]);
      var elemento2 = document.getElementById(vOpciones[i][1]);
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