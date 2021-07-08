<?php


namespace App\Core;


use App\Interfaces\SessionInterface;

class Session implements SessionInterface
{
    //private $session;
    public function __construct()
    {
        session_start();
        //$this->session = $_SESSION;
    }

    public function has($key){
        if(key_exists($key,$_SESSION)){
            return true;
        }
        return false;
    }

    public function set($key,$value = []){
        if(!empty($key) && !key_exists($key,$_SESSION)){
            $_SESSION[$key] = $value;
        }
    }
    public function get($key){
        if ($this->has($key)){
            return $_SESSION[$key];
        }
        return null;
    }
    public function destroy(){

        session_destroy();
    }
}