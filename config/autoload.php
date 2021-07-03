<?php

spl_autoload_register(function ($classname){

    $replacementName = str_replace('\\',DIRECTORY_SEPARATOR,$classname);
    $path = ROOT.$replacementName.'.php';
    if(file_exists($path)){
        require_once $path;
    }
});