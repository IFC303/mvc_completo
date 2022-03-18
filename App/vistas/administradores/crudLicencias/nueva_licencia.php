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

 <h2 class="card-header">Nueva licencia</h2>

 <!--FORMULARIO AÑADIR-->
 <form method="post" class="card-body" ENCTYPE="multipart/form-data">

         <div class="mt-3 mb-3">
            <label for="usuario">Usuario<sup>*</sup></label>
            
                  <select name="usuario" id="usuario" class="form-control form-control-lg" required>
                  <option value="">Elige un usuario...</option>
                  <?php foreach ($datos['licencia'] as $usu) :?>
                    
                     <option value="<?php echo $usu->id_usuario ?>"><?php echo $usu->nombre ?></option>
                  
                  <?php endforeach ?>
            </select>
             
         </div>

         <div class="mt-3 mb-3">
            <label for="tipo">Tipo de licencia<sup>*</sup></label>
            <select name="tipo" id="tipo" class="form-control form-control-lg" onchange="opciones()" required>
                <option selected value="">Elige una opción...</option>
                <option value="Escolar">Escolar</option>
                <option value="Adulto">Adulto</option>
            </select>
         </div>


            <div id="labelGir"class="mt-3 mb-3" style="display:none">
               <label for="gir">GIR<sup>*</sup></label>
               <input type="text" name="gir" id="gir" class="form-control form-control-lg" >
            </div>

            <div id="labelNumLic" class="mt-3 mb-3" style="display:none">
               <label for="num_lic">Numero de licencia<sup>*</sup></label>
               <input type="text" name="num_lic" id="num_lic" class="form-control form-control-lg" >
            </div>

            <div id="labelAutNac" class="mt-3 mb-3" style="display:none">
               <label for="aut_nac">Autonómica o Nacional</label>
               <select name="aut_nac" id="aut_nac" class="form-control form-control-lg">
                  <option selected value="0">Elige una opción</option>
                  <option value="1">Autonómica</option>
                  <option value="2">Nacional</option>
               </select>
            </div>

            <div id="labelDorsal" class="mt-3 mb-3" style="display:none">
               <label for="dorsal">Dorsal</label>
               <input type="number" min="0" name="dorsal" id="dorsal"  class="form-control form-control-lg">
            </div>

            <div id="labelFechaCad" class="mt-3 mb-3" style="display:none">
               <label for="fechaCad">Fecha de Caducidad</label>
               <input type="date" name="fechaCad" id="fechaCad" class="form-control form-control-lg">
            </div>

            <div id="labelImg" class="mt-3 mb-3" style="display:none">
               <label for="imagenLicAdmin">Subir Imágen Licencia</label><br>
               <input  accept="image/*" type="file" id="" name="imagenLicAdmin" >
            </div>
         

         <div class="row">
            <div class="col-3">
                <input type="submit" class="btn" value="Confirmar">
                <a href="<?php echo RUTA_URL?>/adminLicencias">
                    <input type="button" class="btn" id="botonVolver" value="Volver">  
                 </a>
            </div>
        </div>
             
</form>     
     
</div>

<script>


        function opciones() {

            var opcion=document.getElementById("tipo").value;
            console.log(opcion);
            if(opcion=="Escolar"){
                document.getElementById("labelGir").style.display ="block";
                document.getElementById("gir").required = true;
                document.getElementById("labelDorsal").style.display="block";
                document.getElementById("labelImg").style.display="block";

                document.getElementById("labelNumLic").style.display ="none";
                document.getElementById("num_lic").required = false;
                document.getElementById("labelAutNac").style.display="none";
                document.getElementById("labelFechaCad").style.display = "none";
                            
            }else if (opcion=="Adulto"){
                document.getElementById("labelNumLic").style.display ="block";
                document.getElementById("num_lic").required = true;
                document.getElementById("labelAutNac").style.display="block";
                document.getElementById("labelDorsal").style.display="block";
                document.getElementById("labelFechaCad").style.display = "block";
                document.getElementById("labelImg").style.display = "block";
                
                document.getElementById("labelGir").style.display ="none";
                document.getElementById("gir").required = false;
  
              
         
            }else if (opcion==""){
                document.getElementById("labelGir").style.display ="none";
                document.getElementById("gir").required = false;
                document.getElementById("labelDorsal").style.display="none";
                document.getElementById("labelImg").style.display="none";
                document.getElementById("labelNumLic").style.display ="none";
                document.getElementById("num_lic").required = false;
                document.getElementById("labelAutNac").style.display="none";
                document.getElementById("labelFechaCad").style.display = "none";

               
            }
        
        }




</script>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>




