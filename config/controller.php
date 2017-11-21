<?php 

class Controller {

    public $page_title;

    public function __construct(){
        $this->page_title = "";
    }
    
    public function view_render($folder, $view = "index", $parameters = []){
        
        $url_view = "view/" . $folder . "/" . $view . '.php';
        $code_view = "";

        
        if(count($parameters) > 0){
            
            foreach($parameters as $parameter_name => $parameter_value){
                $$parameter_name = $parameter_value;
            }
            
        }
        
        require_once($url_view);

        return $code_view;
    }

}