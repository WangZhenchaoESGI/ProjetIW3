<?php

class UsersController{

	public function defaultAction(){
		echo "users default";
	}
	
	public function addAction(){
		$user = new Users();
		$form = $user->getRegisterForm();

		$v = new View("addUser", "front");
		$v->assign("form", $form);
	}

	public function saveAction(){

		$user = new Users();
		$form = $user->getRegisterForm();

		//Est ce qu'il y a des données dans POST ou GET($form["config"]["method"])
		$method = strtoupper($form["config"]["method"]);
		$data = $GLOBALS["_".$method];


		if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){
			
			$validator = new Validator($form,$data);
			$form["errors"] = $validator->errors;

			if(empty($form["errors"])){
				$user->setFirstname($data["firstname"]);
				$user->setLastname($data["lastname"]);
				$user->setEmail($data["email"]);
				$user->setPwd($data["pwd"]);
				$user->save();
			}

		}

		$v = new View("homepage", "front");
		$v->assign("form", $form);

	}


	public function loginAction(){

		$user = new Users();
		$form = $user->getLoginForm();

		$method = strtoupper($form["config"]["method"]);
		$data = $GLOBALS["_".$method];
		if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){
			
			$validator = new Validator($form,$data);
			$form["errors"] = $validator->errors;

			if(empty($errors)){
				//Connexion avec token
				//$token = md5(substr(uniqid().time(), 4, 10)."mxu(4il");

			}

		}
	
		$v = new View("loginUser", "front");
		$v->assign("form", $form);
		
	}

    public function logoutAction(){

        unset($_SESSION['accesstoken']);
        $v = new View("homepage", "front");

    }


	public function forgetPasswordAction(){
	
		$v = new View("forgetPasswordUser", "front");
		
	}
}