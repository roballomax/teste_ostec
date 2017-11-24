<?php

class SaleModel extends Database {

    public function get_sales() {
        $sql = "
        SELECT v.id AS id, c.nome AS nome FROM vendas v
        INNER JOIN clientes c ON (c.id = v.cliente_id);";
        return self::executeSql($sql)->fetchAll();
    }

    public function insert_sale($values){
        $sql = 'INSERT INTO vendas (cliente_id) VALUES (' . implode(", ", array_keys($values)) . ') RETURNING id;';
        return self::executeSql($sql, $values)->fetch();
    }

    public function insert_sale_product($values){
        $sql = 'INSERT INTO vendas_produtos (venda_id, produto_id) VALUES (' . implode(", ", array_keys($values)) . ');';
        return self::executeSql($sql, $values)->fetch();
    }

    public function get_sale($id){
        $sql = 'SELECT id, cliente_id FROM vendas WHERE id = :id ';
        return self::executeSql($sql, [':id' => $id])->fetch();
    }
    
    public function get_products($venda_id){
        $sql = 'SELECT produto_id FROM vendas_produtos WHERE venda_id = :venda_id ';
        return self::executeSql($sql, [':venda_id' => $venda_id])->fetchAll();
    }

    public function update_sale($values){
        $sql = 'UPDATE vendas SET cliente_id = :cliente_id WHERE id = :id';
        return self::executeSql($sql, $values);
    }
    
    public function clean_sale_products($sale_id){
        $sql = 'DELETE FROM vendas_produtos WHERE venda_id = :venda_id;';
        return self::executeSql($sql, [':venda_id' => $sale_id]);
    }

    public function destroy_sale($id){
        $sql = 'DELETE FROM vendas WHERE id = :id;';
        return self::executeSql($sql, [':id' => $id]);
    }

    public function get_sale_view($id) {
        $sql = "
        SELECT v.id AS id, c.nome AS nome FROM vendas v
        INNER JOIN clientes c ON (c.id = v.cliente_id)
        WHERE v.id = :id;";
        return self::executeSql($sql, [':id' => $id])->fetch();
    }

}
