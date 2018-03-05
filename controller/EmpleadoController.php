<?php

require_once 'ControllerGenerico.php';
require_once 'modelo/Empleado.php';

class EmpleadoController extends Controller {
    function run($action) {
        switch ($action) {
            case 'datosEmpleado' :
                $this->buscarDatosEmpleado();
                break;
           
        }
    }
    
    function buscarDatosEmpleado() {
                
        $empleado = new Empleado();
        $empleado->setIdEmpleado($_GET['id']);
        $empleadoData = $empleado->getEmpleadoById();

       echo json_encode($empleadoData);
    }
}
