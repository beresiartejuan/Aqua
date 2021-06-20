<?php

class BaseModel {

    public object $driver;
    public string $table;

    public function __construct($provisional_driver = null){
		$this->driver = (is_null($provisional_driver)) ? $GLOBAL['pdo'] : $provisional_driver;
    }

    public function select($field, $value){
        $select = $driver->select()->from($this->table)->where($field, '=', $value);
        $data = $select->execute();
        return $data->fetch();
    }
}
