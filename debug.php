<?php
function d(...$vars){
    echo '<pre>';

    foreach ($vars as $debugVar){
        var_dump($debugVar);
    }

    echo '<pre>';
    die();
}