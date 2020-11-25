<?php

namespace APIRest\libs;

class Init {

    private $controllerName;
    private $controller;

    public function start(){
        $this->loadFiles();
        $this->getParameters();
        $this->loadController();
    }

    /**
     * Carga los archivos necesarios para el funcionamiento del sistema
     *
     * @return void
     */
    private function loadFiles() {
        //Capturamos la ubicación de las carpetas de controladores y modelos
        $dirControllers = dirname(__FILE__)."/../controllers/";
        $dirModels = dirname(__FILE__)."/../models/";

        //Escaneamos los archivos dentro de los directorios anteriores
        $controllers = scandir($dirControllers);
        $models = scandir($dirModels);

        //Incorporamos al sistema uno a uno los controladores
        foreach($controllers as $controller) {
            $file = $dirControllers.$controller;
            if(is_file($file)){
                include_once $file;
            }
        }

        //Incorporamos al sistema uno a uno los modelos
        foreach($models as $model) {
            $file = $dirModels.$model;
            if(is_file($file)){
                include_once $file;
            }
        }
    }

    /**
     * Obtiene los parametros entregados por URL para el procesamiento de datos
     *
     * @return void
     */
    private function getParameters(){
        $destiny = filter_var(rtrim(isset($_GET['destiny']) ? $_GET['destiny'] : null, "/"), FILTER_SANITIZE_URL);
        $destiny = explode('/', ucwords($destiny));
        $this->controllerName = "APIRest\\controllers\\".$destiny[0]."Controller";
    
    }
    
    private function loadController(){
        if(!empty($this->controllerName)){
            if(class_exists($this->controllerName)){
                $this->controller = new $this->controllerName;
            } else {
                //echo "Controlador {$this->controllerName} no existe";
                exit;
            }
        }
    }
}