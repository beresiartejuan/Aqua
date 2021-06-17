<?php

class User extends BaseController{

    public static function login($data){
        //echo self::$data;
        $data['password'] = md5(
            $data['password'] . explode('@', $data['email'])[0]
        );

        self::set_model('User', true);
        $_SESSION['USER'] = self::$model->login($data);
        header('Location: /home');
    }
}