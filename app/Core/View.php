<?php


namespace App\Core;


class View
{
    /**
     * Генерирует страничку отображения
     * @param $name
     * @param array $data
     */
    public function render($name, $data = []){
        $path = VIEWS.$name.'.php';
        if(file_exists($path)) {
            include_once $path;
        }
    }

    /**
     * Генерирует страницу 404
     */
    public  static function renderNf(){
        echo '404';
    }

}