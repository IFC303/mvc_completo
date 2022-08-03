<?php require_once RUTA_APP.'/vistas/inc/navA.php' ?>


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


<div id="ventana" class="card bg-light w-50 card-cente">
    
        <h2 class="card-header">Nuevo gasto</h2>
    
         <!--FORMULARIO AÑADIR-->
         <form action="<?php echo RUTA_URL ?>/adminFacturacion/nuevoGasto" method="post" class="card-body">

            <div class="row">
                <div class="col-6">
                    <label for="fecha">Fecha<sup>*</sup></label>
                </div>   
                <div class="col-6">
                <label for="tipo" class="form-label">Tipo de gasto</label>
                </div>   
            </div>

            <div class="row">
                <div class="col-6 mt-3 mb-3"> 
                    <input type="date" name="fecha" id="fecha" class="form-control form-control-lg" required>
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
                    <label for="browser" class="form-label">Entrenadores<sup>*</sup></label>
                </div> 
                <div class="col-6" id="labelSocios" style="display:none">
                    <label for="browser" class="form-label">Socios</label>
                </div> 
            </div>


            <div class="row">
                <div class="col-6 mt-3 mb-3">
                    <input type="text" name="importe" id="importe" class="form-control form-control-lg"required>
                </div>   
              <!--div personal -->
                <div class="col-6 mt-3 mb-3" id="inputPersonal" style="display:none">  
                    <input class="form-control form-control-lg" list="browsers1" name="browser1" id="browser1">
                    <datalist id="browsers1" name="inputPersonal">
                        <?php foreach($datos['entrenadores'] as $entrenadores){
                            ?><option value="<?php echo $entrenadores->id_usuario?>"> <?php echo $entrenadores->nombre." ".$entrenadores->apellidos?> </option><?php
                        }?>  
                    </datalist>  
                    
                </div>
                <!--div socios -->
                <div class="col-6 mt-3 mb-3" id="inputSocios" style="display:none">  
                    <input class="form-control form-control-lg" list="browsers2" name="browser2" id="browser2">
                    <datalist id="browsers2" name="inputSocios2">
                        <?php foreach($datos['socios'] as $socios){
                            ?><option value="<?php echo $socios->id_socio?>"><?php echo $socios->nombre." ".$socios->apellidos?></option><?php
                        }?>  
                    </datalist>  
                </div>
            </div>



            <div class="row">
                <div class="col-6" >
                    <label for="concepto">Concepto<sup>*</sup></label>
                </div>   
                <div class="col-6" id="labelEntidades" style="display:none" >
                    <label for="browser" class="form-label">Entidades</label>
                </div> 
            </div>


            <div class="row">
                <div class="col-6 mt-3 mb-3">  
                    <input type="text" name="concepto" id="concepto" class="form-control form-control-lg" required>
                </div>
                   <!--div ENTIDADES -->
                   <div class="col-6 mt-3 mb-3" id="inputEntidades" style="display:none">  
                    <input class="form-control form-control-lg" list="browsers3" name="browser3" id="browser3">
                    <datalist id="browsers3" name="inputEntidad" >
                        <?php foreach($datos['entidades'] as $entidad){
                            ?><option value="<?php echo $entidad->id_entidad?>"><?php echo $entidad->nombre?></option><?php
                        }?>    
                    </datalist>  
                </div> 
            </div>


     
            <br>
            <div class="row">
                <div class="col-3">
                    <input type="submit" class="btn" value="Confirmar">
                    <a href="<?php echo RUTA_URL?>/adminFacturacion/gastos">
                        <input type="button" class="btn" id="botonVolver" value="Volver">  
                    </a>
                </div>
            </div>
            <br>
    
        </form>  
</div>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>


<script>



        function opciones() {
                var opcion=document.getElementById("tipoSelect").value;
                if(opcion=="personal"){
                    document.getElementById("labelPersonal").style.display ="block";
                    document.getElementById("inputPersonal").style.display = "block";
                    var soc1=document.getElementById("browser1");
                    soc1.setAttribute("required",true);

                    document.getElementById("labelEntidades").style.display="none";
                    document.getElementById("inputEntidades").style.display = "none";

                    document.getElementById("labelSocios").style.display ="none";
                    document.getElementById("inputSocios").style.display = "none";

                }else if(opcion=="otros") {
                    document.getElementById("labelPersonal").style.display="none";
                    document.getElementById("inputPersonal").style.display = "none";

                    document.getElementById("labelEntidades").style.display="block";
                    document.getElementById("inputEntidades").style.display = "block"; 
                    var soc3=document.getElementById("browser3");
                    soc3.setAttribute("required",true);

                    document.getElementById("labelSocios").style.display ="block";
                    document.getElementById("inputSocios").style.display = "block"; 
                    var soc2=document.getElementById("browser2");
                    soc2.setAttribute("required",true);
                }
        }

</script>




<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>
