<?php

class UserController extends BaseController{

    public function login($data){

        $data['password'] = md5(
            $data['password'] . explode('@', $data['email'])[0]
        );

        $this->model = new UserModel;

	if($this->model->login($data['email'], $data['password'])){

		$_SESSION['USER'] = $this->model->selectByEmail($data['email']);
		header('location: /home');

	}else{
		Message::error('Correo o contraseña incorrectos');
	}
    }

    public function singup($data){

    }
}
