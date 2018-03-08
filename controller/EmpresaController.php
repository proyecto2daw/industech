<?php

require_once 'ControllerGenerico.php';
require_once 'modelo/Empresa.php';
require_once 'modelo/Empleado.php';

class EmpresaController extends Controller {
    //Función run con switch para redirigir
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
    
    //Función para mostrar los datos de todas las empresas en BD
    function mostrarTodasEmpresas() {
        $empresa = new Empresa();
        $listaEmpresas = $empresa->getAllEmpresas();
        echo json_encode($listaEmpresas);
    }
    
    //Función para mostrar los datos de la empresa seleccionada por el id 
    function mostrarEmpresa() {
        $empresa = new Empresa();
        $empresa->setIdEmpresa($_GET['idEmpresa']);
        $datosEmpresa = $empresa->getEmpresaById();
    }
    
    //Función para mostrar los empleados (contacto) en la empresa seleccionada por el id
    function mostrarEmpleadosByEmpresa() {
        $empresa = new Empleado();
        $empresa->setEmpresa($_GET['idEmpresa']);
        $datosEmpresa = $empresa->getEmpleadosByEmpresa();
        echo json_encode($datosEmpresa);
    }
        
}
