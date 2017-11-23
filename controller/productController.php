<?php 

class ProductController Extends Controller{

    private $productModel;

    public function __construct(){
        $this->productModel = new ProductModel();
        $this->page_title = "Produtos";
    }

    public function indexAction() {
        return self::view_render('products', 'index', [
            'products' => $this->productModel->get_products()
        ]);
    }

    public function addAction(){
        return self::view_render('products', 'add');
    }

    public function createAction(){
        if(!empty($_POST)){
            
            $nome = Helpers::validate_string($_POST['nome']);
            $preco = $_POST['preco'];

            if(empty($nome)){
                Helpers::flash_data("error_form", "O campo nome deve ser preenchido.");
            }

            if(empty($preco)){
                Helpers::flash_data("error_form", "O campo preço deve ser preenchido.");
            }

            if(!empty(Helpers::flash_data("error_form"))){
                Helpers::flash_data("nome", $nome);
                Helpers::flash_data("preco", $preco);
                
                Helpers::redirect('product', 'add');    
            }

            $this->productModel->insert_product([
                ':nome' => $nome, 
                ':preco' => $preco
            ]);
        }

        Helpers::redirect('product', 'index');
    }
    
    public function editAction(){
        $id = Helpers::get_url_parameter('id');
        $product = $this->productModel->get_product($id);

        Helpers::flash_data("id", $product['id']);

        if(empty(Helpers::flash_data("nome")))
            Helpers::flash_data("nome", $product['nome']);
        
        if(empty(Helpers::flash_data("preco")))
            Helpers::flash_data("preco", $product['preco']);

        return self::view_render('products', 'edit');
    }

    public function updateAction() {
        if(!empty($_POST)){
            
            $id = Helpers::validate_integer($_POST['id']);
            $nome = Helpers::validate_string($_POST['nome']);
            $preco = $_POST['preco'];
            
            
            if(empty($id) || $id <= 0){
                Helpers::flash_data("error_form", "Ocorreu um erro ao enviar o form");
            }

            if(empty($nome)){
                Helpers::flash_data("error_form", "O campo nome deve ser preenchido.");
            }

            if(empty($preco)){
                Helpers::flash_data("error_form", "O campo preço deve ser preenchido.");
            }

            if(!empty(Helpers::flash_data("error_form"))){
                Helpers::flash_data("nome", $nome);
                Helpers::flash_data("preco", $preco);
                
                Helpers::redirect('product', 'edit', ['id' => $id]);    
            }
            

            $this->productModel->update_product([
                ':id' => $id, 
                ':nome' => $nome, 
                ':preco' => $preco
            ]);
        }

        Helpers::redirect('product', 'index');
    }
    
    public function destroyAction(){
        $id = Helpers::get_url_parameter('id');
        $this->productModel->destroy_product($id);
        Helpers::redirect('product', 'index');
    }

}