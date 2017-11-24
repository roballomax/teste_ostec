<h1>Vendas</h1>
<ul>
    <li><a href="/sale/add">Cadastrar Venda</a></li>
</ul>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Comprador</th>
            <th colspan='3'>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(count($sales) > 0) foreach($sales as $sale) {
        ?>
                <tr>
                    <td><?php echo $sale['id']; ?></td>
                    <td><?php echo $sale['nome']; ?></td>
                    <td><a href='/sale/sale/id/<?php echo $sale['id']; ?>'>Ver</a></td>
                    <td><a href='/sale/edit/id/<?php echo $sale['id']; ?>'>Atualizar</a></td>
                    <td><a href='/sale/destroy/id/<?php echo $sale['id']; ?>'>Excluir</a></td>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>