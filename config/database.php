<?php 
class Database {
    private $db;

    public function __construct() {
        $this->db = new PDO( 'pgsql:host=localhost;dbname=teste_ostec', 'postgres', 'roballomax');
    }
    public function getConnection(){
        return $this->db;
    }
    public function executeSql($sql, $params){
        $counter = 0;
        $query = self::getConnection()->prepare($sql);
        
        if(count($params) > 0) foreach($params as $param) {
            $query->bindParam(++$counter, $param);
        }
        $query->execute();
    }
}