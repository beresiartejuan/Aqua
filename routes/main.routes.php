<?php

$router->get('/', function() use ($tmp){
    if(isset($_SESSION['USER'])){
        echo $tmp->render('home/index.html');
    }else{
        echo $tmp->render('index/index.html');
    }
});

$router->post('/login', function(){

    if(isset($_POST['login'])){
        new User()->login($_POST);
    }elseif(isset($_POST['singup'])){
        new User()->singup($_POST);
    }else{
        Message::error('Intente de nuevo...');
    }
});
