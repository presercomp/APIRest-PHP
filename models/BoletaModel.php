<?php

namespace APIRest\models;

use APIRest\libs\Model;

class BoletaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get(array $params = [], array $options = []){
        $result = array();
        switch(count($params)){
            case 0:
                $sql = "SELECT * FROM boleta;";
                $result = $this->db->execute($sql);
            break;
            case 1:
                $sql = "SELECT * FROM boleta WHERE id_boleta = ".$params[0];
            break;
        }
        return $result;
        
    }
}