<?php

class UserModel extends BaseModel {

    public function __construct(){
        parent::__construct();
        $this->table = 'users';
    }

    public function __call(string $name, array $arguments){
        if(strpos($name, 'selectBy') === true){
            $field = strlower(explode($name, 'By')[1]);
            return $this->select($field, $arguments[0]);
        }
    }
}