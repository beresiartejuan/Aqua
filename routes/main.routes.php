<?php

$router->get('/', function() use ($tmp){
    if(isset($_SESSION['USER'])){
        echo $tmp->render('home.html');
    }else{
        echo $tmp->render('index.html');
    }
});

$router->post('/login', function(){

    if(isset($_POST['login'])){
        $u = new UserController();
        $u->login($_POST);
    }elseif(isset($_POST['singup'])){
        $u = new UserController();
        $u->singup($_POST);
    }else{
        Message::error('Intente de nuevo...');
    }
});
