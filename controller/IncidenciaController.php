<?php

require_once 'ControllerGenerico.php';
require_once 'modelo/Incidencia.php';
require_once 'modelo/Seguimiento.php';
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
            case 'estadisticas' :
                $this->estadisticas();
                break;
            case 'getEstadisticas' :
                $this->getEstadisticas();
                break;
            case 'todas' :
                $this->verTodas();
                break;
            case 'update' :
                $this->modificarIncidencia();
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

    function  verIncidencia(){
        $incidencia =new Incidencia();
        $incidencia->setIdIncidencia($_GET['id']);
        $incidenciaDetail = $incidencia->getIncidenciaById();
        
        //Buscamos los datos del Seguimiento de la Incidencia
        $seguimiento = new Seguimiento();
        $seguimiento->setIncidencia($_GET['id']);
        $seguimientoIncidencia = $seguimiento->getSeguimientosByIncidencia();
        
        $this->view('incidencia',['incidencia'=>$incidenciaDetail, 'seguimientos'=>$seguimientoIncidencia]);
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
    
    function estadisticas() {
        
        $this->view('estadisticas',[]);
    }
    
    function getEstadisticas(){
         $incidencia = new Incidencia();
        $statsCategoria=$incidencia->getEstadisticaByCategoria();
        $statsEmpresa=$incidencia->getEstadisticaByEmpresa();
        $statsPrioridad=$incidencia->getEstadisticaByPrioridad();
       
        foreach ($statsPrioridad as &$value) {
           
                 switch ($value){
                     case "0":
                         $value='leve';
                         break;
                     case "1":
                         $value='medio';
                         break;
                      case "2":
                         $value='alta';
                         break;
                      case "3":
                         $value='grave';
                         break;
                 }  
            
           
        } 
        echo json_encode(["categoria"=>$statsCategoria,"empresa"=>$statsEmpresa,"prioridad"=>$statsPrioridad]);
    }
    
    function verTodas(){
         $incidencia = new Incidencia();
         $incidencias=$incidencia->getAllIncidencias();
         $this->view('todasIncidencias', ['incidencias'=>$incidencias]);
         
    }
    
    function modificarIncidencia(){
        if($_POST['descripcion'] == '' || $_POST['descripcion'] == ' ') {
            $descripcion = $_POST['viejoDescripcion'];
        }
        else {
            $descripcion = $_POST['descripcion'];
        }
        
        $incidencia = new Incidencia();
        $incidencia->setIdIncidencia($_GET['id']);
        $incidencia->setTitulo($_POST['titulo']);
        $incidencia->setDescripcion($descripcion);
        $incidencia->setFecha($_POST['fecha']);
        $incidencia->setPrioridad($_POST['prioridad']);
        $incidencia->setEstado(0);
        $incidencia->setCategoria($_POST['categoria']);
        $incidencia->setEmpresa($_POST['empresa']);
        $incidencia->setTecnico($_POST['tecnico']);
        $incidencia->setContacto($_POST['contacto']);        
        $updateIncidencia = $incidencia->updateIncidencia();
        
        header('Location: index.php?controller=incidencia&action=ver&id='. $incidencia->getIdIncidencia());
    }

}
