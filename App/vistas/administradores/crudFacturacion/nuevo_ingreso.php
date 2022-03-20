<?php require_once RUTA_APP.'/vistas/inc/header-admin-miga.php' ?>

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
    
        <h2 class="card-header">Nuevo ingreso</h2>


        <!--FORMULARIO AÑADIR-->
        <form  method="post" class="card-body">

                <div class="row">
                    <div class="col-6">
                        <label for="fecha">Fecha<sup>*</sup></label>
                    </div>   
                    <div class="col-6">
                      <label for="tipo" class="form-label">Tipo de ingreso:</label>
                    </div>   
                </div>
                

            <div class="row">
                <div class="col-6 mt-3 mb-3"> 
                    <input type="date" name="fecha" id="fecha" class="form-control form-control-lg">
                </div>
                <div class="col-6 mt-3 mb-3">    
                    <select class="form-control form-control-lg" name="tipoSelect" id="tipoSelect" onchange="opciones()" required >
                        <option value="">-- Selecciona un tipo de ingreso --</option>
                        <option value="cuotas">Cuotas</option>
                        <option value="actividades">Actividades</option>
                        <option value="otros">Otros</option>
                    </select>
                </div>  
            </div>
             

            <div class="row">
                <div class="col-6">
                    <label for="importe">Importe<sup>*</sup></label>
                </div>   
                <div class="col-6" id="labelSocios" style="display:none">
                    <label for="browser" class="form-label">Socio<sup>*</sup></label>
                </div> 
                <div class="col-6" id="labelParticipantes" style="display:none">
                    <label for="browser" class="form-label">Participante<sup>*</sup></label>
                </div> 
                <div class="col-6" id="labelEntidades" style="display:none" >
                    <label for="browser" class="form-label">Entidades<sup>*</sup></label>
                </div> 
            </div>

            <div class="row">
                <div class="col-6 mt-3 mb-3">
                    <input type="text" name="importe" id="importe" class="form-control form-control-lg">
                </div>   
                <!--div SOCIOS -->
                 <div class="col-6 mt-3 mb-3" id="inputSocios" style="display:none">  
                    <input class="form-control form-control-lg" list="browsers" name="browser" id="browser">
                    <datalist id="browsers" name="socio">
                        <select>
                        <?php foreach($datos['socios'] as $socios){
                            ?><option  value="<?php echo $socios->id_socio?>"><?php echo $socios->nombre." ".$socios->apellidos?></option><?php
                        }?>    
                        </select>
                    </datalist>  
                </div>
                 <!--div PARTICIPANTES -->
                  <div class="col-6 mt-3 mb-3" id="inputParticipantes" style="display:none">  
                    <input class="form-control form-control-lg" list="browsers2" name="browser2" id="browser2">
                 
                    <datalist id="browsers2" name="participante">
                        <select>
                        <?php foreach($datos['participantes'] as $participante){   
                        
                                ?><option value="<?php echo $participante->id_participante?>-<?php echo $participante->tipoParticipante?>"><?php echo $participante->nombre." ".$participante->apellidos?></option> 
                                <?php   
                        
                        }?>  
                      </select>
                    </datalist>  
              
                </div> 

                  <!--div ENTIDADES -->
                  <div class="col-6 mt-3 mb-3" id="inputEntidades" style="display:none">   
                    <input class="form-control form-control-lg" list="browsers3" name="browser3" id="browser3">
                    <datalist id="browsers3" name="entidad">
                    <select>
                        <?php foreach($datos['entidades'] as $entidad){
                            ?><option name="idEntidades" value="<?php echo $entidad->id_entidad?>"><?php echo $entidad->nombre?></option>                          
                            <?php
                        }?>  
                        </select>  
                    </datalist> 
         
                </div> 
            </div>

            <div class="row">
                <div class="col-6" >
                    <label for="concepto">Concepto<sup>*</sup></label>
                </div>   
                <div class="col-6" id="labelEvento" style="display:none">
                    <label for="labelEvento">Evento<sup>*</sup></label>
                </div>   
            </div>
            <div class="row">
                <div class="col-6 mt-3 mb-3">  
                    <input type="text" name="concepto" id="concepto" class="form-control form-control-lg">
                </div>
                <div class="col-6 mt-3 mb-3" id="inputEvento" style="display:none" >  
                    <input class="form-control form-control-lg" list="browsers4" name="browser4" id="browser4">
                    <datalist id="browsers4" name="inputEvento">
                    <select>
                        <?php foreach($datos['eventos'] as $eventos){
                            ?><option value="<?php echo $eventos->nombre?>"></option><?php
                        }?>  
                    </select>  
                    </datalist>  
                    <input type="hidden" name="idEventos" value="<?php echo $eventos->id_evento?>">   
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


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>


<script>


        function opciones() {

            var opcion=document.getElementById("tipoSelect").value;
          

            if(opcion=="actividades"){

                document.getElementById("labelSocios").style.display ="none";
                document.getElementById("labelParticipantes").style.display="block";
                document.getElementById("labelEntidades").style.display="none";

                document.getElementById("labelEvento").style.display="block";
                document.getElementById("inputEvento").style.display="block";

                document.getElementById("inputParticipantes").style.display = "block";
                document.getElementById("inputEntidades").style.display = "none";
                document.getElementById("inputSocios").style.display = "none";

            }else if (opcion=="cuotas"){

                document.getElementById("labelSocios").style.display ="block";
                document.getElementById("labelParticipantes").style.display="none";
                document.getElementById("labelEntidades").style.display="none";

                document.getElementById("labelEvento").style.display="none";
                document.getElementById("inputEvento").style.display="none";

                document.getElementById("inputParticipantes").style.display = "none";
                document.getElementById("inputEntidades").style.display = "none";
                document.getElementById("inputSocios").style.display = "block";
                
            }else if(opcion=="otros") {

                document.getElementById("labelSocios").style.display ="none";
                document.getElementById("labelParticipantes").style.display="none";
                document.getElementById("labelEntidades").style.display="block";

                document.getElementById("labelEvento").style.display="none";
                document.getElementById("inputEvento").style.display="none";

                document.getElementById("inputParticipantes").style.display = "none";
                document.getElementById("inputEntidades").style.display = "block";
                document.getElementById("inputSocios").style.display = "none";
            }
        
        }


</script>




<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>