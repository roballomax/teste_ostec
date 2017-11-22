<?php 
$id = Helpers::flash_data('id', '', true);
$nome = Helpers::flash_data('nome', '', true);
$endereco = Helpers::flash_data('endereco', '', true);

var_dump([$id, $nome, $endereco]);
?>

<h1>Clientes - Edição</h1>
<ul>
    <li><a href="/client">Voltar</a></li>
</ul>

<form action="/client/update" method="post">
<input type="hidden" name="id" value="<?php echo (!is_null($id) ? $id : "") ?>" /> <br>
<input type="text" name="nome" placeholder="Nome" value="<?php echo (!is_null($nome) ? $nome : "") ?>" /> <br>
<input type="text" name="endereco" placeholder="Endereço" value="<?php echo (!is_null($endereco) ? $endereco : "") ?>" /> <br>
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