<?php

require_once 'ControllerGenerico.php';
require_once 'modelo/Seguimiento.php';
require_once 'modelo/Incidencia.php';

class SeguimientoController extends Controller {
    function run($action) {
        switch ($action) {
            case 'crear' :
                $this->crearSeguimiento();
                break;
        }
    }
    
    function crearSeguimiento() {
        $seguimiento = new Seguimiento();
        $seguimiento->setDescripcion($descripcion);
        $seguimiento->setUsuario($usuario);
        $seguimiento->setIncidencia($incidencia);
        $seguimiento->setFecha($fecha);
        $nuevoSeguimiento = $seguimiento->nuevoSeguimiento();
        
        //Buscamos el idEmpresa
        $incidencia = new Incidencia();
        $incidencia->setIdIncidencia($idIncidencia);
        $empresaIncidencia = $incidencia->getIncidenciaById()->empresa;
        echo 'a ver si--> '. $empresaIncidencia;
    }
}
