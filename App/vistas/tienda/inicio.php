<?php require_once RUTA_APP . '/vistas/inc/header-tienda.php' ?>

<div class="container-fluid">
  <main class="row text-center">
    <div class="col-xs-12 col-md-6 col-xl-4">
      <a href="<?php echo RUTA_URL ?>/tienda/equipaciones">
        <div id="icono2">
          <div id="colorTest" class="caja mx-auto" onmouseover="colorear(this);" onmouseleave="decolorear(this);">
            <img src="<?php echo RUTA_Icon ?>usuario.svg" width="100" height="100"></img>
          </div>
          <p id="pTest" class="mx-auto" onmouseover="colorear(colorTest);" onmouseleave="decolorear(colorTest);">EQUIPACIONES</p>
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