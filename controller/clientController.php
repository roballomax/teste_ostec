<?php 

class ClientController Extends Controller{

    public function __construct(){
        $this->page_title = "Home";
    }

    public function indexAction() {
        
        return self::view_render('clients', 'index', [
            'teste1' => 1,
            'teste2' => "hue",
            'teste3' => "1br",
        ]);
    }

}
