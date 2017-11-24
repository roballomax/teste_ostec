<?php 
$id = Helpers::flash_data('id', '', true);
$cliente = Helpers::flash_data('cliente', '', true);
$produtos = Helpers::flash_data('produtos', '', true);

//Helpers::die_dump([$id, $produtos, $cliente]);
?>

<h1>Vendas - Edição</h1>
<ul>
    <li><a href="/sale">Voltar</a></li>
</ul>

<form action="/sale/update" method="post">
<input type="hidden" name="id" value="<?php echo (!is_null($id) ? $id : "") ?>" /> <br>
<select name="cliente">
    <option value="">Selecione um cliente</option>
    <?php 
        foreach($clients as $client){
    ?>
        <option value="<?php echo $client['id']; ?>" <?php echo (!is_null($cliente) && $client['id'] == $cliente ? "selected" : "") ?>><?php echo $client['nome']; ?></option>
    <?php
        }
    ?>
</select>

<select name="produto[]">
    <option value="">Selecione um produto</option>
    <?php 
        foreach($products as $product){
            
    ?>
        <option value="<?php echo $product['id']; ?>" <?php echo (!is_null($produtos) && (array_search($product['id'], $produtos) !== false) ? "selected" : "") ?>><?php echo $product['nome']; ?></option>
    <?php
        }
    ?>
</select>
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