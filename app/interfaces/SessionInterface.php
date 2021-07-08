<?php
namespace App\Interfaces;

interface SessionInterface{
    public function has($key);
    public function set($key,$value = []);
    public function get($key);
    public function destroy();


}