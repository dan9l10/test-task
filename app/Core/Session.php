<?php


namespace App\Core;


use App\Interfaces\SessionInterface;

class Session implements SessionInterface
{
    public function __construct()
    {
        session_start();
    }

    public function has($key)
    {
        if(key_exists($key,$_SESSION)){
            return true;
        }
        return false;
    }

    public function set($key,$value = [])
    {
        if(!empty($key) && !key_exists($key,$_SESSION)){
            $_SESSION[$key] = $value;
        }
    }

    public function get($key)
    {
        if ($this->has($key)){
            return $_SESSION[$key];
        }
        return null;
    }

    public function flush($key)
    {
        if(isset($_SESSION[$key])){
            $value = $_SESSION[$key];
        }
        unset($_SESSION[$key]);
        return $value;
    }

    public function destroy(){
        session_destroy();
    }
}