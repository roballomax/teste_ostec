<h1>Clientes</h1>
<ul>
    <li><a href="/client/add">Cadastrar Cliente</a></li>
</ul>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th colspan='2'>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($clients as $client) {
        ?>
                <tr>
                    <td><?php echo $client['id']; ?></td>
                    <td><?php echo $client['nome']; ?></td>
                    <td><?php echo $client['endereco']; ?></td>
                    <td><a href='/client/edit/id/<?php echo $client['id']; ?>'>Atualizar</a></td>
                    <td><a href='/client/destroy/id/<?php echo $client['id']; ?>'>Excluir</a></td>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>