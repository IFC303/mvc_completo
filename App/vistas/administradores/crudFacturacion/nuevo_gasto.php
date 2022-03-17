<?php require_once RUTA_APP.'/vistas/inc/header-admin-miga.php' ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/css/estilos.css">
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <title><?php echo NOMBRE_SITIO?></title>

    <style>
 
        #ventana{
            margin: auto;
        }

        label, h2{
           color:#023ef9;
        }
      
        .btn{
            background-color: #023ef9; 
            color:white;
        }

        #botonVolver{
            background-color:white; 
            color:#023ef9;
            border-color:#023ef9;
        }

  
    </style>
</head>

<body>
    


<div id="ventana" class="card bg-light w-50 card-cente">
    
        <div class="row card-header">
            <div class="col-4">
                <h2>Nuevo gasto</h2>
            </div>
        </div>

         <!--FORMULARIO AÑADIR-->
         <form action="<?php echo RUTA_URL ?>/adminFacturacion/nuevoGasto" method="post" class="card-body">

            <div class="row">
                <div class="col-6">
                    <label for="fecha">Fecha<sup>*</sup></label>
                </div>   
                <div class="col-6">
                <label for="tipo" class="form-label">Tipo de gasto:</label>
                </div>   
            </div>

            <div class="row">
                <div class="col-6 mt-3 mb-3"> 
                    <input type="date" name="fecha" id="fecha" class="form-control form-control-lg">
                </div>
                <div class="col-6 mt-3 mb-3">    
                    <select class="form-control form-control-lg" name="tipoSelect" id="tipoSelect" onchange="opciones()" required >
                        <option value="">-- Selecciona un tipo de gasto --</option>
                        <option value="personal">De personal</option>
                        <option value="otros">Otros</option>
                    </select>
                </div>  
            </div>
            
            <div class="row">
                <div class="col-6">
                    <label for="importe">Importe<sup>*</sup></label>
                </div>   
                <div class="col-6" id="labelPersonal" style="display:none">
                    <label for="browser" class="form-label">Usuario<sup>*</sup></label>
                </div> 
            </div>


            <div class="row">
                <div class="col-6 mt-3 mb-3">
                    <input type="text" name="importe" id="importe" class="form-control form-control-lg">
                </div>   
              <!--div personal -->
              <div class="col-6 mt-3 mb-3" id="inputPersonal" style="display:none">  
                    <input class="form-control form-control-lg" list="browsers" name="browser" id="browser">
                    <datalist id="browsers" name="inputPersonal">
                        <!-- <?php foreach($datos['socios'] as $socios){
                            ?><option value="<?php echo $socios->nombre?>"></option><?php
                        }?>     -->
                    </datalist>  
                    <input type="hidden" name="idSocios" value="<?php echo $socios->id_socio?>">
                </div>
            </div>



            <div class="row">
                <div class="col-6" >
                    <label for="concepto">Concepto<sup>*</sup></label>
                </div>   
                <div class="col-6" id="labelEntidades" style="display:none" >
                    <label for="browser" class="form-label">Entidades<sup>*</sup></label>
                </div> 
            </div>


            <div class="row">
                <div class="col-6 mt-3 mb-3">  
                    <input type="text" name="concepto" id="concepto" class="form-control form-control-lg">
                </div>
                   <!--div ENTIDADES -->
                   <div class="col-6 mt-3 mb-3" id="inputEntidades" style="display:none">  
                    <input class="form-control form-control-lg" list="browsers3" name="browser3" id="browser3">
                    <datalist id="browsers3" name="entidad">
                        <?php foreach($datos['entidades'] as $entidad){
                            ?><option value="<?php echo $entidad->nombre?>"></option><?php
                        }?>    
                    </datalist>  
                    <input type="hidden" name="idEntidades" value="<?php echo $entidad->id_entidad?>">    
                </div> 
            </div>


     
            <br>
            <div class="row">
                <div class="col-3">
                    <input type="submit" class="btn" value="Confirmar">
                    <a href="<?php echo RUTA_URL?>/adminFacturacion/ingresos">
                        <input type="button" class="btn" id="botonVolver" value="Volver">  
                    </a>
                </div>
            </div>
            <br>
    
        </form>  
</div>





<script>


        function opciones() {

            var opcion=document.getElementById("tipoSelect").value;
            console.log(opcion);
            if(opcion=="actividades"){
                document.getElementById("evento").style.display = "block";
                document.getElementById("inputEvento").style.display = "block";
            }else{
                document.getElementById("evento").style.display = "none";
                document.getElementById("inputEvento").style.display = "none";
            }
        }




        function opciones() {
                var opcion=document.getElementById("tipoSelect").value;
                if(opcion=="personal"){
                    document.getElementById("labelPersonal").style.display ="block";
                    document.getElementById("inputPersonal").style.display = "block";
                    document.getElementById("labelEntidades").style.display="none";
                    document.getElementById("inputEntidades").style.display = "none";  
                }else if(opcion=="otros") {
                    document.getElementById("labelPersonal").style.display="block";
                    document.getElementById("inputPersonal").style.display = "block";
                    document.getElementById("labelEntidades").style.display="block";
                    document.getElementById("inputEntidades").style.display = "block";                   
                }
        }

</script>




<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>
