<?php


require_once 'controller/ControllerGenerico.php';
require_once 'controller/IncidenciaController.php';
require_once 'controller/UsuarioController.php';
require_once 'controller/EmpleadoController.php';

session_start();

//crearDatos();

if (!isset($_SESSION['idusuario']) && !isset($_POST['user']) ) {
   loginView();   
}elseif (isset($_GET['controller']) || isset($_SESSION['idusuario']) || isset($_POST['user'])) {
    switch (@$_GET['controller']) {
        case 'incidencia':
            $controller = new IncidenciaController();
            action($controller);
            break;
        case 'usuario':
            $controller = new UsuarioController();
            action($controller);
            break;
        case 'empleado':
            $controller= new EmpleadoController();
            action($controller);
            break;
        default:
            index();
            break;
    }
} 

function action($objController) {
    $objController->run($_GET['action']);
}

function loginView() {
    $ctrl = new Controller();
    $ctrl->view('login', ['prueba' => 'dasda']);
}

function index() {
    
    $ctrl = new IncidenciaController();
    $incidencias=$ctrl->getMisIncidencias();
    $ctrl->view('index', ["incidencias"=>$incidencias]);
}
function crearDatos(){
    $titulos=['roto','estropeado','no funciona','no conecta','no enciende'];
    $descripcion=['ordenador','cabezal','refrigerador','cableado','circuitos','impresora','internet'];
    
    
    for($x=0;$x<100;$x++){
    $fecha="2018-".rand(1,12)."-5 0:0:00";
    
    $incidencia = new Incidencia();

        $incidencia->setTitulo($titulos[rand(0, sizeof($titulos)-1)]);
        $incidencia->setDescripcion($titulos[rand(0, sizeof($titulos)-1)]." ".$descripcion[rand(0, sizeof($descripcion)-1)]);
        $incidencia->ponerFecha($fecha);
        $incidencia->setEstado(0);
        $incidencia->setPrioridad(rand(0,3));
        $incidencia->setCategoria(rand(1,3));
        $incidencia->setEmpresa(rand(1,2));
        $incidencia->setTecnico(rand(2,4));
        $incidencia->setContacto(1);
        $id = $incidencia->nuevaIncidencia();
        echo $id;
    }
    
}