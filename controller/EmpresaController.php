<?php
require_once 'ControllerGenerico.php';
require_once 'modelo/Empresa.php';
class EmpresaController extends Controller {
    function run($action) {
        switch ($action) {
            case 'mostrarTodo' :
                $this->mostrarTodasEmpresas();
                break;
            case 'mostrarUno' :
                $this->mostrarEmpresa();
                break;
            default :
                $this->mostrarTodasEmpresas();
                break;
        }
    }
    
    function mostrarTodasEmpresas() {
        $empresa = new Empresa();
        $listaEmpresas = $empresa->getAllEmpresas();     
    }
    
    function mostrarEmpresa() {
        $empresa = new Empresa();
        $empresa->setIdEmpresa($_GET['idEmpresa']);
        $datosEmpresa = $empresa->getEmpresaById();
    }
        
}
