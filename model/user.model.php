<?php

class UserModel extends BaseModel {

    public function __construct(){
        parent::__construct();
	$this->table = 'users';
    }

    public function select($field, $value){
        $select = $driver->select()->from($this->table)->where($field, '=', $value);
	$data = $select->execute();
	return $data->fetch();
    }

    public function __call(string $name, array $arguments){
        if(strpos($name, 'selectBy') === true){
            $field = strlower(explode($name, 'By')[1]);
            return $this->select($field, $arguments[0]);
        }
    }
}
