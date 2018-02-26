<?php
 require_once './vendor/autoload.php';
 class Controller {
    
private $twig;
     public function view($vista,$datos){
       $loader = new Twig_Loader_Filesystem('vista');
        $this->twig = new Twig_Environment($loader, array('debug' => true));
           echo $this->twig->render($vista."View.html", array('datos' => $datos));
//        require_once  __DIR__ ."/../view/" . $vista . "View.html";

    }
    

}