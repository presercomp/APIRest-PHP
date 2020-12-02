<?php

namespace APIRest\libs;

use PDO;
use PDOException;

class MySQL{
    private $pdo;
    private $connected;
    private $errors;
    private $rows;

    public function __construct(string $server, string $port, string $dbName, string $user, string $pass){
        $strConn = "mysql:host=$server;port=$port;dbname=$dbName;charset=utf8";
        $params = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->pdo = new PDO($strConn, $user, $pass, $params);
            $this->connected = true;
        } catch(\PDOException $X_x){
            $this->connected = false;
            $this->errors = $X_x->getMessage();
        }
    }

    public function execute(string $sql){
        $result = array();
        if($this->connected){
            $sth = $this->pdo->prepare($sql);
            try {
                $sth->execute();
                $this->rows = $sth->rowCount();
            } catch(\PDOException $X_x){
                $this->errors = $X_x->getMessage();
                $this->rows = 0;
            }
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function numRows(){
        return $this->rows;
    }
}