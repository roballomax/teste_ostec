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
//caso encontre a classe, ele retorna o layout do site
require_once('view/layout/site.php');