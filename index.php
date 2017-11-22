<?php 

function __autoload($className){
    //transforma a primeira letra do nome da classe em minuscula
    $className[0] = strtolower($className[0]);
    
    try{
        //verifica se é um controlador que está instanciando
        if(strpos($className, "Controller")){
            // verifica se o arquivo existe antes de instanciar
            if(!file_exists('controller/' . $className . ".php")){ 
                throw new Exception('Controlador não existe');
            } 
            require_once('controller/' . $className . ".php");
        
        //verifica se é um model que está instanciando
        } elseif(strpos($className, "Model")){
            // verifica se o arquivo existe antes de instanciar
            if(!file_exists('model/' . $className . ".php")){ 
                throw new Exception('Model não existe');
            }
            require_once('model/' . $className . ".php");
        //caso não se encaixe nas configurações anteriores, ele joga para um arquivo de configuração
        } else {
            if(!file_exists('config/' . $className . ".php")){ 
                throw new Exception('Config não existe');
            }
            require_once('config/' . $className . ".php");
        }
            
    } catch (Exception $e){
        //var_dump($e);
        //caso ele não encontre a classe, ele chama a página de 404
        require_once('errorPages/404.html');
        die;
    }
}

session_start();

//separa as barras da url para selecionar controlador e action
$uri = $_SERVER['REQUEST_URI'];

$uri_dashs = explode('/', $uri);
//seta o controlador e action default
$controller = 'HomeController';
$action = 'indexAction';

if(strlen($uri_dashs[1]) > 1){ // seta o controlador caso tenha na url
    $controller = ucfirst($uri_dashs[1]) . "Controller";
}
if(strlen($uri_dashs[2]) > 1){ // seta a action caso tenha na url
    $action = $uri_dashs[2] . "Action";
}

$_SESSION['uri']['host'] = "http://" . $_SERVER['HTTP_HOST'];
$_SESSION['uri']['controller'] = $controller;
$_SESSION['uri']['action'] = $action;
$_SESSION['uri']['parameters'] = [];

if(count($uri_dashs) > 3){
    
    array_shift($uri_dashs);
    array_shift($uri_dashs);
    array_shift($uri_dashs);
    $parameter_name = "";

    foreach($uri_dashs as $parameter_key => $parameter_value){
        if(($parameter_key % 2) == 0)
            $parameter_name = $parameter_value;
        else
            $_SESSION['uri']['parameters'][$parameter_name] = $parameter_value;
    }

}

$controller = new $controller(); //chama o controlador

//caso encontre a classe, ele retorna o layout do site
require_once('view/layout/site.php');