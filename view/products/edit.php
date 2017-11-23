<?php 
$id = Helpers::flash_data('id', '', true);
$nome = Helpers::flash_data('nome', '', true);
$preco = Helpers::flash_data('preco', '', true);
?>

<h1>Produtos - Edição</h1>
<ul>
    <li><a href="/product">Voltar</a></li>
</ul>

<form action="/product/update" method="post">
<input type="hidden" name="id" value="<?php echo (!is_null($id) ? $id : "") ?>" /> <br>
<input type="text" name="nome" placeholder="Nome" value="<?php echo (!is_null($nome) ? $nome : "") ?>" /> <br>
<input type="number" step="0.01" name="preco" placeholder="Preço" value="<?php echo (!is_null($preco) ? $preco : "") ?>" /> <br>
<input type="submit" value="Editar" />
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