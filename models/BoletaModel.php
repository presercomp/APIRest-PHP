<?php

namespace APIRest\models;

use APIRest\libs\Model;
use APIRest\libs\Utils as Util;

class BoletaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get(array $params = [], array $options = []){
        $result = array();
        switch(count($params)){
            case 1:
                $sql = "SELECT * FROM boleta;";
                $result = $this->db->execute($sql);
            break;
            case 2:
                if(is_numeric($params[1])){
                    $sql = "SELECT * FROM boleta WHERE id_boleta = ".$params[1];
                    $result = $this->db->execute($sql);
                } else {
                    Util::JSONResponse(Util::encodeResponse(400, [], "El identificador debe ser ser numerico"));
                    exit;
                }    
            break;
        }
        return $result;
        
    }
}