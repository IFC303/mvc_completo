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
            
                  <select name="usuario" id="usuario" class="form-control form-control-lg">
                  <option value="0">Elige un usuario...</option>
                  <?php foreach ($datos['licencia'] as $usu) :?>
                    
                     <option value="<?php echo $usu->id_usuario ?>"><?php echo $usu->nombre ?></option>
                  
                  <?php endforeach ?>
            </select>
             
         </div>


         <div class="mt-3 mb-3">
            <label for="num_lic">Numero de licencia<sup>*</sup></label>
            <input type="text" name="num_lic" id="num_lic" class="form-control form-control-lg" required>
         </div>

         <div class="mt-3 mb-3">
            <label for="aut_nac">Autonómica o Nacional<sup>*</sup></label>
            <select name="aut_nac" id="aut_nac" class="form-control form-control-lg">
                <option selected value="0">Elige una opción</option>
                <option value="1">Autonómica</option>
                <option value="2">Nacional</option>
            </select>
         </div>

         <div class="mt-3 mb-3">
            <label for="dorsal">Dorsal<sup>*</sup></label>
            <input type="number" min="0" name="dorsal" id="dorsal"  class="form-control form-control-lg">
         </div>

         <div class="mt-3 mb-3">
            <label for="fechaCad">Fecha de Caducidad<sup>*</sup></label>
            <input type="date" name="fechaCad" id="fechaCad" class="form-control form-control-lg">
         </div>

         <div class="mt-3 mb-3">
            <label for="imagenLicAdmin">Subir Imágen<sup>*</sup></label><br>
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

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>