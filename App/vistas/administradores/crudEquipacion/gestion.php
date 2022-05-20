<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>



<form enctype="multipart/form-data" action="<?php echo RUTA_URL?>/adminEquipaciones/subirFotos" method="POST"> 
    Añadir equipacion  <input name="foto" id="foto" type="file">
    <input type="submit" value="subir" onclick="cuadroFoto()">
</form>

<div id="fotos">

</div>




 <script>

//     function cuadroFoto(){

//         var fotos=document.getElementById("fotos");

//         //creamos divs de fotos
//         var cuadrosFotos=document.createElement("div");
//         cuadrosFotos.setAttribute("style","border:solid blue; width:150px; height:150px");

//         var img = document.createElement("img");
//         cuadrosFotos.appendChild(img);


//         fotos.appendChild(cuadrosFotos);
   
//     }

// </script>