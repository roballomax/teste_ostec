<?php

class ClientModel extends Database {

    public function get_clients(){
        return self::executeSql("SELECT * FROM clientes;")->fetchAll();
    }

    public function insert_client($values){
        $sql = 'INSERT INTO clientes (nome, endereco) VALUES (' . implode(", ", array_keys($values)) . ');';
        return self::executeSql($sql, $values);
    }

    public function get_client($id){
        $sql = 'SELECT id, nome, endereco FROM clientes WHERE id = :id ';
        return self::executeSql($sql, [':id' => $id])->fetch();
    }
    
    public function update_client($values){
        $sql = 'UPDATE clientes SET nome = :nome, endereco = :endereco WHERE id = :id';
        return self::executeSql($sql, $values);
    }
    
    public function destroy_client($id){
        $sql = 'DELETE FROM clientes WHERE id = :id;';
        return self::executeSql($sql, [':id' => $id]);
    }

}
