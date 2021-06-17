<?php

class BaseController{

    public static array $data;
    public static object $model;

    public static function set_model($model, $static = false){
        unset(self::$model);
        self::$model = ($static) ? $model : new $model;
    }
}