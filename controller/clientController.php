<?php 

class ClientController Extends Controller{

    public function __construct(){
        $this->page_title = "Clientes";
    }

    public function indexAction() {
        $model = new ClientModel();
        
        return self::view_render('clients', 'index', [
            'clients' => $model->get_clients()
        ]);
    }

    public function addAction(){
        $model = new ClientModel();
        return self::view_render('clients', 'add', []);
    }

    public function createAction(){
        if(!empty($_POST)){
            var_dump($_POST);
        }
    }

}