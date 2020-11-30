<?php


namespace APIRest\libs;

class Controller
{
    protected $HTTPMethod;
    protected $model; 

    public function __construct(){
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
            header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type, Accept, Origin");
            header("Access-Control-Allow-Origin: *");
        } else {
            //Se añaden cabeceras de seguridad adicional en caso de necesitarse
            header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, OPTIONS, HEAD");
            header("Access-Control-Allow-Headers: Content-Type, Accept, Origin");
            header("Access-Control-Allow-Origin: *");
            $this->HTTPMethod = $_SERVER['REQUEST_METHOD'];
        }
    }

    public function isAllow(array $types){
        $types[] = "OPTIONS";
        $method = $_SERVER['REQUEST_METHOD'];
        $allow = in_array($method, $types);
        if(!$allow){
            header("HTTP/1.1 404 Not Found");
            echo "Metodo de solicitud no permitido $method";
            exit;
        }
        return $allow;
    }
}