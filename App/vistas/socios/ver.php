<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">
</head>
<body>

<div class="container mt-5">
    <img src='<?php echo RUTA_Licencia.$datos['usu_licen'][0]->id_licencia.'.jpg';?>' class="mx-auto d-block" style="width:70%" > 
</div>


        <div class="col text-center mt-5">
            <a id="botonVolver" class="btn" href="<?php echo RUTA_URL?>/socio">Cerrar imagen</a>
        </div>

</body>
</html>


