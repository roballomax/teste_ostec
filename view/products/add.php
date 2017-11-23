<?php 
$nome = Helpers::flash_data('nome', '', true);
$preco = Helpers::flash_data('preco', '', true);
?>

<h1>Produtos - Cadastro</h1>
<ul>
    <li><a href="/product">Voltar</a></li>
</ul>

<form action="/product/create" method="post">
<input type="text" name="nome" placeholder="Nome" value="<?php echo (!is_null($nome) ? $nome : "") ?>" /> <br>
<input type="number" step="0.01" name="preco" placeholder="Preço" value="<?php echo (!is_null($preco) ? $preco : "") ?>" /> <br>
<input type="submit" value="Cadastrar" />
</form>

<?php
$error_form = Helpers::flash_data('error_form', '', true);

if(!empty($error_form)){
    
    echo "<ul>";
    if(count($error_form) > 1) foreach($error_form as $error){
        echo "<li>{$error}</li>";
    } else {
        echo "<li>{$error_form}</li>";
    }
    echo "</ul>";
}

?>