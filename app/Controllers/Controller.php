<?php


namespace App\Controllers;


class Controller
{
    private $params = [];
    public function __construct($params)
    {
        $this->params = $params;
    }

}