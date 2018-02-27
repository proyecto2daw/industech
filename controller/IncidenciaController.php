<?php

require_once 'ControllerGenerico.php';
require_once 'modelo/Incidencia.php';

class IncidenciaController extends Controller {

    function run($action) {
        switch ($action) {
            case 'c':
                $this->crearIncidencia();
                break;
        }
    }

    function crearIncidencia() {
        $incidencia = new Incidencia();

        $incidencia->setTitulo($_POST['titulo']);
        $incidencia->setDescripcion($_POST['descripcion']);
        $incidencia->setFecha();
        $incidencia->setEstado(0);
        $incidencia->setPrioridad($_POST['prioridad']);
        $incidencia->setCategoria($_POST['categoria']);
        $incidencia->setEmpresa($_POST['empresa']);
        $incidencia->setTecnico($_POST['tecnico']);
        $incidencia->setContacto($_POST['contacto']);
        $incidencia->nuevaIncidencia();
    }

}
