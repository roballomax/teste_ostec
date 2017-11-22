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
        }

        Helpers::redirect('client', 'index');
    }
    
    public function editAction(){
        $id = Helpers::get_url_parameter('id');
        $client = $this->clientModel->get_client($id);

        Helpers::flash_data("id", $client['id']);

        if(empty(Helpers::flash_data("nome")))
            Helpers::flash_data("nome", $client['nome']);
        
        if(empty(Helpers::flash_data("endereco")))
            Helpers::flash_data("endereco", $client['endereco']);

        return self::view_render('clients', 'edit');
    }

    public function updateAction(){
        if(!empty($_POST)){
            
            $id = Helpers::validate_integer($_POST['id']);
            $nome = Helpers::validate_string($_POST['nome']);
            $endereco = Helpers::validate_string($_POST['endereco']);

            if(empty($id) || $id <= 0){
                Helpers::flash_data("error_form", "Ocorreu um erro ao enviar o form");
            }

            if(empty($nome)){
                Helpers::flash_data("error_form", "O campo nome deve ser preenchido.");
            }

            if(empty($endereco)){
                Helpers::flash_data("error_form", "O campo endereço deve ser preenchido.");
            }

            if(!empty(Helpers::flash_data("error_form"))){
                Helpers::flash_data("nome", $nome);
                Helpers::flash_data("endereco", $endereco);
                
                Helpers::redirect('client', 'edit', ['id' => $id]);    
            }

            $this->clientModel->update_client([
                ':id' => $id, 
                ':nome' => $nome, 
                ':endereco' => $endereco
            ]);
        }

        Helpers::redirect('client', 'index');
    }
    
    public function destroyAction(){
        $id = Helpers::get_url_parameter('id');
        $this->clientModel->destroy_client($id);
        Helpers::redirect('client', 'index');
    }

}