<?php

class Externo extends Controlador
{
    public function enviado()
    {
        $this->vista('externo/enviado', $this->datos);
    }


    public function formulario_socio()
    {
        $this->ExternoModelo = $this->modelo('ExternoModelo');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            var_dump($_POST);

            $anaSoli = [
                
                'nomUsuAna' => trim($_POST["nomAtl"]),
                'apelUsuAna' => trim($_POST["apelAtl"]),               
                'fecUsuAna' => trim($_POST["fecha"]),
                'dniUsuAna' => trim($_POST["dniAtl"]),
                'nom_pa' =>  trim($_POST['nomPa']),
                'ape_pa' => trim ($_POST['apePa']),
                'dni_pa' => trim ($_POST['dniPa']),
                'emaUsuAna' => trim($_POST["email"]),
                'direccionUsuAna' => trim($_POST["direc"]),
                'telUsuAna' => trim($_POST["telf"]),                
                'cccUsuAna' => trim($_POST["ccc"]),
                'tallaUsuAna' => trim($_POST["talla"]),
                'primerAnoSocio' => trim($_POST["priSocio"]),

            ];

            if ($this->ExternoModelo->anadirSoliSocio($anaSoli)) {
                redireccionar('/externo/enviado');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->vista('externo/formulario_socio', $this->datos);
        }
    }


    public function form_es()
    {
        $this->ExternoModelo = $this->modelo('ExternoModelo');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            var_dump($_POST);

            $anaSoli = [
                
                'nomUsuAna' => trim($_POST["nomAtl"]),
                'apelUsuAna' => trim($_POST["apelAtl"]),               
                'fecUsuAna' => trim($_POST["fecha"]),
                'dniUsuAna' => trim($_POST["dniAtl"]),
                'nom_pa' =>  trim($_POST['nomPa']),
                'ape_pa' => trim ($_POST['apePa']),
                'dni_pa' => trim ($_POST['dniPa']),
                'emaUsuAna' => trim($_POST["email"]),
                'direccionUsuAna' => trim($_POST["direc"]),
                'telUsuAna' => trim($_POST["telf"]),                
                'cccUsuAna' => trim($_POST["ccc"]),
                'tallaUsuAna' => trim($_POST["talla"]),
                'primerAnoSocio' => trim($_POST["priSocio"]),

            ];

            if ($this->ExternoModelo->anadirSoliSocio($anaSoli)) {
                redireccionar('/externo/enviado');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->vista('externo/form_es', $this->datos);
        }
    }





    public function formulario_evento()
    {
        $this->ExternoModelo = $this->modelo('ExternoModelo');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $anaSoli = [
                'dniUsuAna' => trim($_POST["dniAtl"]),
                'nomUsuAna' => trim($_POST["nomAtl"]),
                'apelUsuAna' => trim($_POST["apelAtl"]),
                'fecUsuAna' => trim($_POST["fecha"]),
                'direccionUsuAna' => trim($_POST["direc"]),
                'telUsuAna' => trim($_POST["telf"]),
                'emaUsuAna' => trim($_POST["email"]),
                'evenUsuAna' => trim($_POST["even"]),
                
            ];

            if ($this->ExternoModelo->anadirSoliEven($anaSoli)) {
                redireccionar('/externo/enviado');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $eventos = $this->ExternoModelo->obtenerEventos();
            $this->datos['eventos'] = $eventos;
            $this->vista('externo/formulario_evento', $this->datos);
        }
    }
}
