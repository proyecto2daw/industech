<?php
require_once 'ControllerGenerico.php';
require_once 'modelo/Usuario.php';
class UsuarioController extends Controller {
    //Función run con switch para redirigir
    function run($action) {

        switch ($action){
            case 'login':
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
        }
    }
    
    //Función para confirmar los datos de login
    function login(){
        $user =new Usuario();
        $user->setUsername($_POST['user']);
        $user->setPassword($_POST['pass']);
        $object=$user->getLogin();

       if(@$object->idUsuario==NULL){
           $this->view('login', ['error'=>'login erroneo']);
       }else{
          
            $_SESSION['idusuario']=$object->idUsuario;
             index();
       }  
    }
    
    //Función para desconectarse
    function logout(){
        session_abort();
        $this->view('login',[]);
    }
}
