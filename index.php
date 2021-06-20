<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/helpers/import.helper.php';

$_CONFIG = parse_ini_file('config.ini', true);

$router = new \Bramus\Router\Router();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/views');

$tmp = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/cache',
    'debug' => true
]);

// $tmp->addFunction(new \Twig\TwigFunction('')); así se agrega una función en twig

$dsn = 'mysql:host='. $_CONFIG['Database']['host'] .';dbname='. $_CONFIG['Database']['name'] .';charset='. $_CONFIG['Database']['charset'];

//$pdo = new \FaaPz\PDO\Database($dsn, $_CONFIG['Database']['user'], $_CONFIG['Database']['password']);

import([
    'path' => 'helpers',
    'extension' => 'helper.php'
]);

import([
    'path' => 'models',
    'extension' => 'model.php',
    'data' => $GLOBALS
]);

import([
    'path' => 'controllers',
    'extension' => 'controller.php',
    'first' => 'base',
    'data' => $GLOBALS
]);

import([
    'path' => 'presenters',
    'extension' => 'presenter.php',
    'data' => $GLOBALS
]);

import([
    'path' => 'routes',
    'extension' => 'routes.php',
    'data' => $GLOBALS
]);

$router->run('session_start');