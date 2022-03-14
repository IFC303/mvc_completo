function ereSocio(){
    //document.write(document.getElementsByName("socio").value);
    if(document.getElementById("siSocio").checked == true){
        document.getElementById("borTallaLabel").style.display='none';
        document.getElementById("borTalla").style.display='none';
        document.getElementById("borSocioLabel").style.display='none';
        document.getElementById("siHasSocio").style.display='none';
        document.getElementById("noHasSocio").style.display='none';
        document.getElementById("borSiLabel").style.display='none';
        document.getElementById("borNoLabel").style.display='none';
    }
    if(document.getElementById("noSocio").checked == true){
        document.getElementById("borTallaLabel").style.display='';
        document.getElementById("borTalla").style.display='';
        document.getElementById("borSocioLabel").style.display='';
        document.getElementById("siHasSocio").style.display='';
        document.getElementById("noHasSocio").style.display='';
        document.getElementById("borSiLabel").style.display='';
        document.getElementById("borNoLabel").style.display='';
    }
    //document.getElementById("siSocio").checked = true;
    //document.getElementById("prueba").innerHTML="aaaaaaaaaaaaaaaa si";
}

function validar() {
    return false;
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