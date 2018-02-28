<?php
require_once 'ControllerGenerico.php';
require_once 'modelo/Usuario.php';
class UsuarioController extends Controller {
    function run($action) {

        switch ($action){
            case 'login':
                $this->login();
                break;
        }
    }
    function login(){
        $user =new Usuario();
        $user->setUsername($_POST['user']);
        $user->setPassword($_POST['pass']);
        $object=$user->getLogin();

       if($object->idUsuario==NULL){
           $this->view('login', ['error'=>'login erroneo']);
       }else{
            $this->view('index', []);
            $_SESSION['idusuario']=$object->idUsuario;
       }
       
    
    }
}
