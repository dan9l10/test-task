<?php


namespace App\Core;


class Router
{
    /**
     * @var array
     */
    protected $params = [];
    protected $routes = [];

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->routes = include ROOT.'config/routes.php';
    }

    /**
     * Разбивает URI
     * @return string
     */
    private function getUri(){
        $uri = $_SERVER['REQUEST_URI'];
        return trim($uri,'/');

    }

    /**
     * Ищет совпадения URI с маршрутами
     * @return bool
     */
    private function getMatches(){
        $uri = $this->getUri();
        foreach ($this->routes as $path=>$executor){
            if(preg_match("~^$path$~",$uri,$matches)){
                $data = preg_replace("~^$path~",$executor,$uri);
                $dataExploded = explode('/',$data);
                $this->params['controller'] = ucfirst(array_shift($dataExploded)).'Controller';
                $this->params['action'] = array_shift($dataExploded);
                $this->params['params'] = array_shift($dataExploded);
                return true;
            }
        }
        return false;
    }

    /**
     * Вызывает метод контроллера
     * @throws \Exception
     */
    public function run(){
        if ($this->getMatches()){
            $pathController = 'App\\Controllers\\'.$this->params['controller'];
            $action = $this->params['action'];
            if(class_exists($pathController)){
                $controllerObj = new $pathController($this->params);
                if(method_exists($controllerObj,$action)){
                    call_user_func([$controllerObj,$action],$this->params['params']);
                }else{
                    throw new \Exception("Method $action not found in $pathController");
                }
            }else{
                throw new \Exception("Controller $pathController not found");
            }
        }else{
            View::renderNf();
        }
    }

}