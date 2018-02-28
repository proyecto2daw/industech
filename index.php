<?php


require_once 'controller/ControllerGenerico.php';
require_once 'controller/IncidenciaController.php';
require_once 'controller/UsuarioController.php';

session_start();
if (!isset($_SESSION['idusuario']) && !isset($_POST['user']) ) {
   loginView();   
}elseif (isset($_GET['controller']) || isset($_SESSION['idusuario'])) {
    switch (@$_GET['controller']) {
        case 'incidencia':
            $controller = new IncidenciaController();
            action($controller);
            break;
        case 'usuario':
            $controller = new UsuarioController();
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
    $ctrl = new Controller();
    
    $ctrl->view('index', []);
}