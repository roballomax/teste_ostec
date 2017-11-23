<?php

class ProductModel extends Database {

    public function get_products(){
        return self::executeSql("SELECT * FROM produtos;")->fetchAll();
    }

    public function insert_product($values){
        $sql = 'INSERT INTO produtos (nome, preco) VALUES (' . implode(", ", array_keys($values)) . ');';
        return self::executeSql($sql, $values);
    }

    public function get_product($id){
        $sql = 'SELECT id, nome, preco FROM produtos WHERE id = :id ';
        return self::executeSql($sql, [':id' => $id])->fetch();
    }
    
    public function update_product($values){
        $sql = 'UPDATE produtos SET nome = :nome, preco = :preco WHERE id = :id';
        return self::executeSql($sql, $values);
    }
    
    public function destroy_product($id){
        $sql = 'DELETE FROM produtos WHERE id = :id;';
        return self::executeSql($sql, [':id' => $id]);
    }

}
