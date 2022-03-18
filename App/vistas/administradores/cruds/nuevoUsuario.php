<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>
<div class="container mt-3">

  <form action="<?php echo RUTA_URL ?>/admin/nuevoUsuario/<?php echo $datos['idTengo']?>" method="post">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
            <label for="dni">DNI </label>
            <input type="text" class="form-control" id="dni" placeholder="Escriba el DNI" name="dni" style="text-transform:uppercase;">
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
            <label for="nombre">Nombre </label>
            <input type="text" class="form-control" placeholder="Escriba el nombre" id="nombre" name="nombre" required onkeypress="return Solo_Texto(event);">
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
            <label for="apellidos">Apellidos </label>
            <input type="text" class="form-control" placeholder="Escriba los apellidos" id="apellidos" name="apellidos" required onkeypress="return Solo_Texto(event);">
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
            <label for="fecha">Fecha Nacimiento </label>
            <input type="date" class="form-control" id="fecha" name="fecha">
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
            <label for="telf">Telefono </label>
            <input type="text" class="form-control" placeholder="Escriba el telefono" id="telf" name="telf" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
            <label for="email">Correo </label>
            <input type="text" class="form-control" placeholder="Escriba el correo" id="email" name="email" onblur="return correo(this.id)" required> <label id="errorMail"></label>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
        <label for="direccion">Direccion </label>
            <input type="text" class="form-control" placeholder="Escriba la direccion" id="direccion" name="direccion" required>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
            <label for="pass">Contraseña </label>
            <input type="password" class="form-control" placeholder="Escriba la contraseña" id="pass" name="pass" >
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
            <label for="">Quiere que sea Socio: </label> <span style="margin-left: 10px;"></span>
            <input type="radio" id="siSocio" name="socio" value="si" required><label for="siSocio">SI</label><span style="margin-left: 20px;"></span>
            <input type="radio" id="noSocio" name="socio" value="no" required><label for="noSocio">NO</label>
        </div>
        
        <button type="submit" class="btn btn-primary">Añadir</button>
    </div>
  </form>
</div>
</body>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>
<script>
    function dni(m) {
        var dni = document.getElementById(m).value
        var letraSupuesta
        var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H',
            'L', 'C', 'K', 'E', 'T'
        ];
        let re = new RegExp('[0-9]{8}[A-Z]');
        var numeros = 0;

        if (re.test(dni)) {
            numeros = Number.parseInt(dni.substring(0, 8));
            letraSupuesta = letras[numeros % 23];

            if (letraSupuesta == dni.charAt(dni.length - 1)) {
                document.getElementById("error").innerHTML = "";
                return true;
            } else {
                document.getElementById("error").innerHTML = " ¡LETRA DNI INCORRECTA!";
                //document.getElementById(m).setCustomValidity("'LETRA DNI INCORRECTA!");
                return false;
            }
        } else {
            document.getElementById("error").innerHTML = " ¡DNI INCORRECTO!";
            //document.getElementById(m).setCustomValidity("¡DNI INCORRECTO!");
            return false;
        }

    }

    function correo(n) {
        var cad = "";
        let re = new RegExp('[\\w]*[@]{1}[\\w]*[.]{1}[\\w]*');
        var correo = document.getElementById(n).value;

        if (re.test(correo)) {
            cad = "";
            document.getElementById("errorMail").innerHTML = cad;
            return true;
        } else {
            cad = "Correo con formato incorrecto";
            document.getElementById("errorMail").innerHTML = cad;
            return false;
        }

    }

    function Solo_Texto(e) {
        var code;
        if (!e) var e = window.event;
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        var character = String.fromCharCode(code);
        var AllowRegex = /^[\ba-zA-Z\s-]$/;
        if (AllowRegex.test(character)) return true;
        return false;
    }
</script>