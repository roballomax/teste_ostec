<?php 

class ClientController Extends Controller{

    private $clientModel;

    public function __construct(){
        $this->clientModel = new ClientModel();

        $this->page_title = "Clientes";
    }

    public function indexAction() {
        return self::view_render('clients', 'index', [
            'clients' => $this->clientModel->get_clients()
        ]);
    }

    public function addAction(){
        return self::view_render('clients', 'add');
    }

    public function createAction(){
        if(!empty($_POST)){
            
            $nome = Helpers::validate_string($_POST['nome']);
            $endereco = Helpers::validate_string($_POST['endereco']);

            if(empty($nome)){
                Helpers::flash_data("error_form", "O campo nome deve ser preenchido.");
            }

            if(empty($endereco)){
                Helpers::flash_data("error_form", "O campo endereço deve ser preenchido.");
            }

            if(!empty(Helpers::flash_data("error_form"))){
                Helpers::flash_data("nome", $nome);
                Helpers::flash_data("endereco", $endereco);
                
                Helpers::redirect('client', 'add');    
            }

            $this->clientModel->insert_client([
                ':nome' => $nome, 
                ':endereco' => $endereco
            ]);

            Helpers::redirect('client', 'index');
        }
    }

}