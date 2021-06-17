<?php

$router->before('GET', '/', function(){
    if(isset($_SESSION['user'])){
        header('location: /home');
    }
});

$router->before('GET', '/login', function(){
    if(isset($_SESSION['user'])){
        header('location: /home');
    }
});

$router->before('POST', '/login', function(){
    if(!isset($_SESSION['user'])){
        User::login($_POST);
    }
});

$router->before('GET', '/login', function(){
    if(isset($_SESSION['user'])){
        header('location: /home');
    }
});

$router->before('GET', '/home', function(){
    if(!isset($_SESSION['user'])){
        header('location: /');
    }
});