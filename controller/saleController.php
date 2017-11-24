<?php 

class SaleController Extends Controller{

    private $saleModel;
    private $clientModel;
    private $productModel;

    public function __construct(){
        $this->saleModel = new SaleModel();
        $this->clientModel = new ClientModel();
        $this->productModel = new ProductModel();
        $this->page_title = "Vendas";
    }

    public function indexAction() {
        return self::view_render('sales', 'index', [
            'sales' => $this->saleModel->get_sales()
        ]);
    }

    public function addAction(){
        return self::view_render('sales', 'add', [
            'clients' => $this->clientModel->get_clients(),
            'products' => $this->productModel->get_products()
        ]);
    }

    public function createAction(){
        if(!empty($_POST)){
            
            $cliente = Helpers::validate_integer($_POST['cliente']);
            $produtos = $_POST['produto'];

            if(empty($produtos) || count($produtos) <= 0){
                Helpers::flash_data("error_form", "Você precisa escolher um produto no mínimo.");
            } else {
                foreach($produtos as $produto){
                    $produto_id = Helpers::validate_integer($produto);
    
                    if($produto_id == 0){
                        Helpers::flash_data("error_form", "Esta não é uma opção válida de produto.");
                    }
                }
            }

            if(empty($cliente) || $cliente == 0){
                Helpers::flash_data("error_form", "Você precisa escolher uma opção valida de cliente.");
            }
            
            if(!empty(Helpers::flash_data("error_form"))) {
                Helpers::flash_data("produtos", $produtos);
                Helpers::flash_data("cliente", $cliente);
                
                Helpers::redirect('sale', 'add');    
            }

            $data_sale_id = $this->saleModel->insert_sale([
                ':cliente_id' => $cliente
            ]);
            
            foreach($produtos as $produto){

                $produto_id = Helpers::validate_integer($produto);

                if($produto_id == 0){
                    continue;
                }

                $this->saleModel->insert_sale_product([
                    ':venda_id' => $data_sale_id['id'], 
                    ':produto_id' => Helpers::validate_integer($produto_id)
                ]);
            }

        }

        Helpers::redirect('sale', 'index');
    }
    
    public function editAction(){
        $id = Helpers::get_url_parameter('id');
        $sale = $this->saleModel->get_sale($id);

        Helpers::flash_data("id", $sale['id']);

        if(empty(Helpers::flash_data("cliente")))
            Helpers::flash_data("cliente", $sale['cliente_id']);
        
        if(empty(Helpers::flash_data("produtos"))){
            $produtos = $this->saleModel->get_products($sale['id']);
            $produtos_array = [];

            foreach($produtos as $produto){
                $produtos_array[] = $produto['produto_id'];
            }
            
            Helpers::flash_data("produtos", $produtos_array);
        }
        return self::view_render('sales', 'edit', [
            'clients' => $this->clientModel->get_clients(),
            'products' => $this->productModel->get_products()
        ]);
    }

    public function updateAction() {
        if(!empty($_POST)){
            
            $id = Helpers::validate_integer($_POST['id']);
            $cliente = Helpers::validate_integer($_POST['cliente']);
            $produtos = $_POST['produto'];
            
            
            if(empty($id) || $id <= 0){
                Helpers::flash_data("error_form", "Ocorreu um erro ao enviar o form");
            }

            if(empty($produtos) || count($produtos) <= 0){
                Helpers::flash_data("error_form", "Você precisa escolher um produto no mínimo.");
            } else {
                foreach($produtos as $produto){
                    $produto_id = Helpers::validate_integer($produto);
    
                    if($produto_id == 0){
                        Helpers::flash_data("error_form", "Esta não é uma opção válida de produto.");
                    }
                }
            }

            if(empty($cliente) || $cliente == 0){
                Helpers::flash_data("error_form", "Você precisa escolher uma opção valida de cliente.");
            }
            
            if(!empty(Helpers::flash_data("error_form"))) {
                Helpers::flash_data("produtos", $produtos);
                Helpers::flash_data("cliente", $cliente);
                
                Helpers::redirect('sale', 'edit', ['id' => $id]);    
            }

            //Helpers::die_dump([$produtos, $cliente]);

            $this->saleModel->update_sale([
                ':id' => $id, 
                ':cliente_id' => $cliente
            ]);
            $this->saleModel->clean_sale_products($id);


            foreach($produtos as $produto){

                $produto_id = Helpers::validate_integer($produto);

                if($produto_id == 0){
                    continue;
                }

                $this->saleModel->insert_sale_product([
                    ':venda_id' => $id, 
                    ':produto_id' => Helpers::validate_integer($produto_id)
                ]);
            }

        }

        Helpers::redirect('sale', 'index');
    }
    
    public function destroyAction(){
        $id = Helpers::get_url_parameter('id');
        $this->saleModel->clean_sale_products($id);
        $this->saleModel->destroy_sale($id);
        Helpers::redirect('sale', 'index');
    }

    public function saleAction(){
        $id = Helpers::get_url_parameter('id');

        return self::view_render('sales', 'sale', [
            'sale' => $this->saleModel->get_sale_view($id)
        ]);
    }

}