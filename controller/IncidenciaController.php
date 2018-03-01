<?php

require_once 'ControllerGenerico.php';
require_once 'modelo/Incidencia.php';
require_once 'modelo/Categoria.php';
require_once 'modelo/Empresa.php';
require_once 'modelo/Usuario.php';
//require_once 'modelo/Contacto.php';

class IncidenciaController extends Controller {

    function run($action) {
        switch ($action) {
            case 'crear':
                $this->crearIncidencia();
                break;
            case 'datosModalCategoria':
                $this->obtenerDatosParaRellenarCombosModalCategoria();
                break;
            case 'datosModalTecnico':
                $this->obtenerDatosParaRellenarCombosModalTecnico();
                break;
            case 'datosModalEmpresa':
                $this->obtenerDatosParaRellenarCombosModalEmpresa();
                break;
            case 'datosModalContacto':
                $this->obtenerDatosParaRellenarCombosModalContacto();
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
        $id = $incidencia->nuevaIncidencia();
        echo $id;
    }

    function getMisIncidencias() {
        $incidencia = new Incidencia();
        $incidencia->setTecnico($_SESSION['idusuario']);
        $misIncidencias = $incidencia->getIncidenciasByTecnico();
        return $misIncidencias;
    }

    function verIncidencia() {
        $incidencia = new Incidencia();
        $incidencia->setIdIncidencia($_GET['id']);
        $incidenciaDetail = $incidencia->getIncidenciaById();
        $this->view('incidencia', ['incidencia' => $incidenciaDetail]);
    }

    function obtenerDatosParaRellenarCombosModalCategoria() {
        $categoria = new Categoria();
        $listaCategorias = $categoria->getAllCategorias();
        echo json_encode($listaCategorias);
    }

    function obtenerDatosParaRellenarCombosModalTecnico() {
        $usuario = new Usuario();
        $listaUsuarios = $usuario->getAllUsuarios();
        echo json_encode($listaUsuarios);
    }

    function obtenerDatosParaRellenarCombosModalEmpresa() {
        $empresa = new Empresa();
        $listaEmpresas = $empresa->getAllEmpresas();
        echo json_encode($listaEmpresas);
    }

    function obtenerDatosParaRellenarCombosModalContacto() {
        //$contacto = new Contac;
        $listaEmpresas = $empresa->getAllEmpresas();
        echo json_encode($listaEmpresas);
    }

}
