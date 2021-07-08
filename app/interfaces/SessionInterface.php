<?php
namespace App\Interfaces;

interface SessionInterface{
     function has($key);
     function set($key,$value = []);
     function get($key);
     function destroy();
     function flush($key);
}