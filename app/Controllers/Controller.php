<?php


namespace App\Controllers;


use App\Core\View;

class Controller
{
    private $params = [];
    protected $view;
    public function __construct($params)
    {
        $this->params = $params;
        $this->view = new View();
    }

}