<?php


require_once 'controller/ControllerGenerico.php';

session_start();
if (!isset($_SESSION['idusuario']) ) {
    loginView();
} elseif (isset($_GET['controller']) || isset($_SESSION['idusuario'])) {
    switch (@$_GET['controller']) {
        case 'usuario':
            $controller = new UsuarioController();
            action($controller);
            break;
        case 'proyecto':
            $controller = new ProyectoController();
            action($controller);
            break;
        case 'tareas':
            $controller = new TareasController();
            action($controller);
            break;
        case 'muro':
            $controller = new MuroController();
            action($controller);
            break;
        case 'mensaje':
            $controller = new MensajesController();
            action($controller);
            break;
        case 'archivo':
            $controller = new ArchivosController();
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