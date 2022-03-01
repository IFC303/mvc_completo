<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/estilos-socio.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/estilos-admin.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">
    


    <title>SUBIR LICENCIAS</title>
</head>

<body>  
    <form name="form" method="post">
        <label for="">Num Licencia</label><input type="text" value="" id="numLicencia" name="NumLicencia">
        <br><br>
        <label for="">Tipo Licencia</label>
            <select name="tipoLicencia" id="tipoLicencia" onchange="cargarFederativas();">
                <option selected value="0">Elige una opción</option>
                <option value="1">Federativa</option>
                <option value="2">Escolar</option>
            </select>


        <select name="federativas"> 
            <option value="">
        </select>
        
        <br><br>
        <label for="">Dorsal</label><input type="number" min="0" value="" id="dorsal" name="Dorsal">
        <br><br>
        <label for="">Fecha Caducidad</label><input type="date" value="" id="fechaCaducidad" name="FechaCaducidad">
        <br><br>
        <label for="">Imagen Licencia</label><input  accept="image/*" type="file" id="imagenLicencia" name="ImagenLicencia">
        <br><br>
       
        
        <input type="submit" name ="enviar" value="AGREGAR LICENCIA">
    </form>

    <?php 
    
        if (isset($_POST['enviar'])) {
            $numLicencia = $_POST['NumLicencia'];
            echo $numLicencia.'<br>';

            $tipoLicencia = $_POST['tipoLicencia'];

            if ($tipoLicencia == 0) {
                $tipoLicencia = "";
            }if ($tipoLicencia == 1) {
                $tipoLicencia = "Federativa";
            }if ($tipoLicencia == 2) {
                $tipoLicencia = "Escolar";
            }
            echo $tipoLicencia.'<br>';

            $federativas = $_POST['federativas'];
            if ($federativas == "Elige...") {
                $federativas = "";
            }
            echo $federativas;

            $dorsal = $_POST['Dorsal'];
            echo $dorsal.'<br>';

            $fechaCaducidad = $_POST['FechaCaducidad'];
            echo $fechaCaducidad.'<br>';

            $imagenLicencia = $_POST['ImagenLicencia'];
            echo $imagenLicencia.'<br>';
            
        }
    
    ?>
  
</body>

</html>
<script>
    var licencia1=new Array("Elige...","Nacional","Regional");
    var licencia2=new Array("");

    var todasLicencias = [
        [],
        licencia1,
        licencia2
    ];

  function cargarFederativas(){ 
   	
   	var tipoLicencia 
   	tipoLicencia = document.form.tipoLicencia[document.form.tipoLicencia.selectedIndex].value 
  
   	if (tipoLicencia == 1) { 
      	
      	mis_licencias=todasLicencias[tipoLicencia]
      	
      	num_licencia = mis_licencias.length 
      	
      	document.form.federativas.length = num_licencia 
      	
      	for(i=0;i<num_licencia;i++){ 
         	document.form.federativas.options[i].value=mis_licencias[i] 
         	document.form.federativas.options[i].text=mis_licencias[i] 
      	}	
 
   	}else{ 
      	
      	document.form.federativas.length = 1 
      	
      	document.form.federativas.options[0].value = "" 
      	document.form.federativas.options[0].text = "" 
   	} 
   
   	document.form.federativas.options[0].selected = true 
}

</script>