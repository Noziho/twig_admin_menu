<?php

use RedBeanPHP\R;
use App\Router;
use Symfony\Component\ErrorHandler\Debug;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Router.php';

Debug::enable();

R::setup('mysql:host=localhost;dbname=admin-menu', 'dev', 'dev');


session_start();

try {
    Router::route();
} catch (ReflectionException $e) {
}