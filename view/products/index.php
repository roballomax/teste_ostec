<h1>Produtos</h1>
<ul>
    <li><a href="/product/add">Cadastrar Produto</a></li>
</ul>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Preço</th>
            <th colspan='2'>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(count($products) > 0) foreach($products as $product) {
        ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['nome']; ?></td>
                    <td><?php echo Helpers::number_format($product['preco']); ?></td>
                    <td><a href='/product/edit/id/<?php echo $product['id']; ?>'>Atualizar</a></td>
                    <td><a href='/product/destroy/id/<?php echo $product['id']; ?>'>Excluir</a></td>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>