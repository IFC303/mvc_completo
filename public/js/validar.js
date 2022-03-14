function validar() {
    return false;
}

function mayorEdad() {
    
    var fechaDada= document.getElementById("fecha").value;
    var values = fechaDada.split("-");
    var dia = values[2];
    var mes = values[1];
    var ano = values[0];
   

    // cogemos los valores actuales
    var fecha_hoy = new Date();
    var ahora_ano = fecha_hoy.getYear();
    var ahora_mes = fecha_hoy.getMonth() + 1;
    var ahora_dia = fecha_hoy.getDate();

    // realizamos el calculo
    var edad = (ahora_ano + 1900) - ano;
    if (ahora_mes < mes) {
        edad--;
    }
    if ((mes == ahora_mes) && (ahora_dia < dia)) {
        edad--;
    }
    if (edad > 1900) {
        edad -= 1900;
    }

    // calculamos los meses
    var meses = 0;

    if (ahora_mes > mes && dia > ahora_dia)
        meses = ahora_mes - mes - 1;
    else if (ahora_mes > mes)
        meses = ahora_mes - mes
    if (ahora_mes < mes && dia < ahora_dia)
        meses = 12 - (mes - ahora_mes);
    else if (ahora_mes < mes)
        meses = 12 - (mes - ahora_mes + 1);
    if (ahora_mes == mes && dia > ahora_dia)
        meses = 11;

    // calculamos los dias
    var dias = 0;
    if (ahora_dia > dia)
        dias = ahora_dia - dia;
    if (ahora_dia < dia) {
        ultimoDiaMes = new Date(ahora_ano, ahora_mes - 1, 0);
        dias = ultimoDiaMes.getDate() - (dia - ahora_dia);
    }

    if(edad>=18){
        document.getElementById("esMenor").style.display='none';
        document.getElementById("dniPad").required = false;
        document.getElementById("nomPadre").required = false;
        document.getElementById("apelPadre").required = false;
        
    }else{document.getElementById("esMenor").style.display='';
        document.getElementById("dniPad").required = true;
        document.getElementById("nomPadre").required = true;
        document.getElementById("apelPadre").required = true;
    }
    
}

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
            document.getElementById("error").innerHTML="";
            return true;
        } else {
            document.getElementById("error").innerHTML=" ¡LETRA DNI INCORRECTA!";
            //document.getElementById(m).setCustomValidity("'LETRA DNI INCORRECTA!");
            return false;
        }
    } else {
        document.getElementById("error").innerHTML=" ¡DNI INCORRECTO!";
        //document.getElementById(m).setCustomValidity("¡DNI INCORRECTO!");
        return false;
    }

}

function correo(n){
    var cad = "";
    let re = new RegExp('[\\w]*[@]{1}[\\w]*[.]{1}[\\w]*');
    var correo = document.getElementById(n).value;

    if (re.test(correo)) {
        cad="";
        document.getElementById("errorMail").innerHTML = cad;
        return true;
    }else{ 
        cad="Correo con formato incorrecto";
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
    var AllowRegex  = /^[\ba-zA-Z\s-]$/;
    if (AllowRegex.test(character)) return true;     
    return false; 
}