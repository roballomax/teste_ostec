<?php

class ClientModel extends Database {

    public function get_clients(){
        return self::executeSql("SELECT * FROM clientes;")->fetchAll();
    }

}
