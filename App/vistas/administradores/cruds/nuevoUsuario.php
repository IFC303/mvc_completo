<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php echo RUTA_URL ?>/admin/nuevoUsuario/<?php echo $datos['idTengo']?>" method="post">
        <label for="">DNI </label><input type="text" value="" id="dni" name="dni" style="text-transform:uppercase;">
        <br><br>
        <label for="">Nombre </label><input type="text" value="" id="nombre" name="nombre" required onkeypress="return Solo_Texto(event);">
        <br><br>
        <label for="">Apellidos </label><input type="text" value="" id="apellidos" name="apellidos" required onkeypress="return Solo_Texto(event);">
        <br><br>
        <label for="">Fecha Nacimiento </label><input type="date" value="" id="fecha" name="fecha">
        <br><br>
        <label for="">Telefono </label><input type="text" value="" id="telf" name="telf" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
        <br><br>
        <label for="">Correo </label><input type="text" value="" id="email" name="email" onblur="return correo(this.id)" required> <label id="errorMail"></label>
        <br><br>
        <label for="">Contraseña </label><input type="password" value="" id="pass" name="pass">
        <br><br>
        <input type="submit" value="enviar">
    </form>
</body>

</html>
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