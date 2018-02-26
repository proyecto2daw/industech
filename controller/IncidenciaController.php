<?php

require_once './ControllerGenerico.php';
class IncidenciaController extends Controller{
    function run($action) {
        switch ($action) {
            case 'c':
                $this->crearIncidencia();
                break;
        }
    }
    function crearIncidencia(){
        
    }
}
