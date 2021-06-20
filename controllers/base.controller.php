<?php

class BaseController{

    public array $data;
    public object $model;
    public object $tmp;

    public function __construct($provisional_engine = null){
		$this->tmp = (is_null($provisional_engine)) ? $GLOBAL['tmp'] : $provisional_engine;
    }
}
