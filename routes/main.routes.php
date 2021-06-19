<?php

$router->get('/', function() use ($tmp){
    if(isset($_SESSION['user'])){
        echo $tmp->render('home/index.html');
    }else{
        echo $tmp->render('index/index.html');
    }
});

$router->post('/login', function(){

    if(isset($_POST['login'])){
        User::login($_POST);
    }elseif(isset($_POST['singup'])){
        User::singup($_POST);
    }else{
        Message::error('Intente de nuevo...');
    }
});