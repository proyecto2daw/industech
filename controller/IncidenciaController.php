<?php

require_once 'ControllerGenerico.php';
require_once 'modelo/Incidencia.php';

class IncidenciaController extends Controller {

    function run($action) {
        switch ($action) {
            case 'crear':
                $this->crearIncidencia();
                break;
            case 'ver':
                $this->verIncidencia();
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
        $id=$incidencia->nuevaIncidencia();
        echo $id;
    }
    function getMisIncidencias(){
        $incidencia= new Incidencia();
        $incidencia->setTecnico($_SESSION['idusuario']);
       $misIncidencias= $incidencia->getIncidenciasByTecnico();
       return $misIncidencias;
    }
    function  verIncidencia(){
        $incidencia =new Incidencia();
        $incidencia->setIdIncidencia($_GET['id']);
        $incidenciaDetail=$incidencia->getIncidenciaById();
        $this->view('incidencia',['incidencia'=>$incidenciaDetail]);
    }

}
