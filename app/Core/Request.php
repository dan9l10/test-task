<?php


namespace App\Core;


class Request
{
    private $params = [];
    public function __construct()
    {
        $this->params = $this->setParams($_REQUEST);
    }

    private function setParams($data)
    {
        if (is_array($data)){
            $cleaned = [];
            foreach ($data as $var=>$value){
                $cleaned[$var] = $value;
            }
            return $cleaned;
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if(isset($this->params[$name])){
            return $this->params[$name];
        }
    }


}