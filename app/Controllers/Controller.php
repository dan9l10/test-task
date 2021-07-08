<?php


namespace App\Controllers;


use App\Core\Request;
use App\Core\View;


class Controller
{
    protected $params = [];
    protected $view;
    protected $request;

    public function __construct(Request $request,$params)
    {
        $this->params = $params;
        $this->request = $request;
        $this->view = new View();

    }

    /**
     * Загружает указанную модель
     * @param $model
     * @return mixed|null
     */
    protected function model($model){
        $modelName = 'App\\Models\\'.ucfirst($model);
        $modelObj = null;
        if(class_exists($modelName)){
            $modelObj = new $modelName();
        }
        return $modelObj;
    }

}