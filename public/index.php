<?php

require_once dirname(__DIR__).'/config/config_vars.php';
require_once ROOT.'config/autoload.php';
require_once ROOT.'debug.php';


use App\Core\Router;
$router = new Router();
$router->run();