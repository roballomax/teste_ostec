<h1>Vendas - Ver Venda</h1>
<ul>
    <li><a href="/sale">Voltar</a></li>
</ul>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Comprador</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!empty($sale)) {
        ?>
                <tr>
                    <td><?php echo $sale['id']; ?></td>
                    <td><?php echo $sale['nome']; ?></td>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>