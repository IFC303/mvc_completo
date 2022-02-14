<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>

               <h1 style="text-align: center;">crud_admin</h1>
        </div>



<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>


<script>
    window.onload = function() {
        vOpciones = [
            ["pUsu", "colorUsu"],
            ["pSolici", "colorSoli"],
            ["pGrupo", "colorGrup"],
            ["pEven", "colorEven"],
            ["pLicen", "colorLice"],
            ["pEnti", "colorEnti"],
            ["pTemp", "colorTemp"],
            ["pFact", "colorFact"],
            ["pMens", "colorMens"]
        ];

        for (let i = 0; i < vOpciones.length; i++) {
            var elemento = document.getElementById(vOpciones[i][0]);
            var elemento2 = document.getElementById(vOpciones[i][1]);
            elemento.onmouseover = function(e) {
                document.getElementById(vOpciones[i][1]).style.backgroundColor = '#FFBF1C';
            };
            elemento.onmouseout = function(e) {
                document.getElementById(vOpciones[i][1]).style.backgroundColor = '#F5F5F5';
            };
            elemento2.onmouseover = function(e) {
                document.getElementById(vOpciones[i][1]).style.backgroundColor = '#FFBF1C';
            };
            elemento2.onmouseout = function(e) {
                document.getElementById(vOpciones[i][1]).style.backgroundColor = '#F5F5F5';
            };
            /*elemento.onclick = function(e) {
                location.href="http://www.elmiradordelaserrania.com"
            };
            elemento2.onclick = function(e) {
                location.href="http://www.elmiradordelaserrania.com"
            };*/

        }

    }
</script>