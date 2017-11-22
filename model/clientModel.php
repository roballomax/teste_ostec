<?php

class ClientModel extends Database {

    public function get_clients(){
        return self::executeSql("SELECT * FROM clientes;")->fetchAll();
    }

    public function insert_client($values){
        return self::executeSql('INSERT INTO clientes (nome, endereco) VALUES (' . implode(", ", array_keys($values)) . ');', $values);
    }

}
