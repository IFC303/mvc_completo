

<body>
    <!-- <?php
    // $miga1 = "";
    // $miga1Nom = "";
    // $miga2 = "";
    // $miga2Nom = "";
    // $miga3 = "";

    // if (isset($this->datos['miga1'])) {
    //     if ($this->datos['miga1'] == "GRUPOS") {
    //         $miga1Nom = "GRUPOS";
    //     } elseif ($this->datos['miga1'] == "TEST") {
    //         $miga1Nom = "TEST";
    //     } elseif ($this->datos['miga1'] == "MENSAJERIA") {
    //         $miga1Nom = "MENSAJERIA";
    //     }
    // } else {
    //     $miga1Nom = "EN MANTENIMIENTO";
    // }

    // if (isset($this->datos['nuevoMiga'])) {
    //     if ($this->datos['nuevoMiga'] == "TEST") {
    //         $miga1 = RUTA_URL . "/entrenador/test";
    //         $miga1Nom = "TEST";
    //         $miga2Nom = "NUEVO TEST";
    //     } 
    // }
    ?>

    <div class="container-fluid min-vh-100">
        <header class="p-4 row">  

            <div class="col-xs-12 col-md-7 text-center order-3 order-md-2" style="z-index:1">
                
                <ol class="breadcrumb v1 justify-content-center">
                    <li class="breadcrumb-level"><a href="<?php echo RUTA_URL ?>">INICIO</a></li>
                    <li class='breadcrumb-level'><a href="<?php echo $miga1 ?>"><?php echo $miga1Nom ?></a></li>
                    <?php if (isset($this->datos['nuevoMiga'])) {
                        echo "<li class='breadcrumb-level'><a href=" . $miga2 . ">" . $miga2Nom . "</a></li>";
                    }
                    ?>
                </ol>
            </div>       
        </header> -->



                <!--BOTON MENU LATERAL-->
                <nav class="row">            
                <div class="col-12 order-4" id="fotoMenu">
                    <div style="width: 50px; height: 50px; cursor:pointer;" data-bs-toggle="offcanvas" data-bs-target="#menu1">
                        <img src="<?php echo RUTA_Icon ?>menu.svg" width="50" height="50">
                    </div>
                </div>
                </nav>

                <!--MENU LATERAL-->
                <div class="menu1 offcanvas offcanvas-start" id="menu1">                          
                    <!--INICIO-->
                    <div class="offcanvas-header home">
                        <a id="home" href="<?php echo RUTA_URL ?>/socio" class="nav-link align-middle">
                            <div class="row">
                                <div class="col-5"><img class="imgHome" style="width:75px; height:75px" src="<?php echo RUTA_Icon ?>inicio.svg"></div>
                                <div class="col-7 mt-3"><h1 style="color:black">INICIO</h1></div>
                            </div>                      
                        </a>                       
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                    </div>                              
                    <!--OPCIONES-->
                    <a href="<?php echo RUTA_URL ?>/entrenador/grupos" class="nav-link align-middle">
                        <img class="imgMenu" src="<?php echo RUTA_Icon ?>grupos.svg"><span class="tMenu">GRUPOS</span>
                    </a>                          
                    <a href="<?php echo RUTA_URL ?>/entrenador/test" class="nav-link align-middle">
                        <img class="imgMenu" src="<?php echo RUTA_Icon ?>cronometro.svg"><span class="tMenu">TEST</span>
                    </a>                           
                    <a href="<?php echo RUTA_URL ?>/entrenador/mensajeria" class="nav-link  align-middle">                           
                        <img class="imgMenu" src="<?php echo RUTA_Icon ?>mensajeria.svg"><span class="tMenu">MENSAJERIA</span>                                                          
                    </a>                                                              
                </div>

